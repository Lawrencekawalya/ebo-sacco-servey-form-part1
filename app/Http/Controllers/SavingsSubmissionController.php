<?php

namespace App\Http\Controllers;

use App\Models\SavingsSubmission;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\ConfirmSavingsSubmissionMail;
use Illuminate\Support\Facades\DB;
use Throwable;

class SavingsSubmissionController extends Controller
{
    /**
     * Store a new savings submission (pending)
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'email' => ['required', 'email:rfc,dns'],
        ]);

        $email = strtolower($validated['email']);

        // 1. Enforce EBO email domain
        if (!str_ends_with($email, '@ebo.co.ug')) {
            return back()->withErrors([
                'email' => 'Please use your official EBO email address.',
            ]);
        }

        // 2. Block duplicate confirmed submissions
        $alreadyConfirmed = SavingsSubmission::where('email', $email)
            ->where('status', 'confirmed')
            ->exists();

        if ($alreadyConfirmed) {
            return back()->withErrors([
                'email' => 'A submission has already been confirmed for this email.',
            ]);
        }

        // 3. Collect survey answers (everything except email + token)
        $answers = collect($request->except([
            '_token',
            'email',
        ]))
            ->filter(fn($value) => $value !== null && $value !== '')
            ->map(function ($value) {
                return is_array($value) ? array_values($value) : $value;
            });

        try {
            DB::beginTransaction();
            // 4. Create pending submission with answers
            $submission = SavingsSubmission::create([
                'email' => $email,
                'status' => 'pending',
                'answers' => $answers,
                'confirmation_token' => Str::uuid()->toString(),
                'token_expires_at' => now()->addHours(2),
                'submitted_at' => now(),
            ]);


            // 5. Send confirmation email
            Mail::to($email)->send(new ConfirmSavingsSubmissionMail($submission));

            DB::commit();

            return redirect()->route('submission.email-sent')->with([
                'email' => $email,
            ]);
        } catch (Throwable $th) {
            DB::rollBack();
            return back()->with([
                'error' => 'Please use your official EBO email address.' . $th->getMessage(),
            ]);
        }
    }

    // public function store(Request $request)
    // {
    //     $validated = $request->validate([
    //         'email' => ['required', 'email'],
    //     ]);

    //     $email = strtolower($validated['email']);

    //     // 1. Enforce SACCO email domain
    //     if (!str_ends_with($email, '@ebo.co.ug')) {
    //         return back()->withErrors([
    //             'email' => 'Please use your official SACCO email address.',
    //         ]);
    //     }

    //     // 2. Block duplicate confirmed submissions
    //     $alreadyConfirmed = SavingsSubmission::where('email', $email)
    //         ->where('status', 'confirmed')
    //         ->exists();

    //     if ($alreadyConfirmed) {
    //         return back()->withErrors([
    //             'email' => 'A submission has already been confirmed for this email.',
    //         ]);
    //     }

    //     // 3. Create pending submission
    //     $submission = SavingsSubmission::create([
    //         'email' => $email,
    //         'status' => 'pending',
    //         'confirmation_token' => Str::uuid()->toString(),
    //         'token_expires_at' => now()->addHours(2),
    //     ]);

    //     // 4. Send confirmation email (we wire this next)
    //     Mail::to($email)->send(new ConfirmSavingsSubmissionMail($submission));

    //     // return back()->with([
    //     //     'success' => 'Please check your email and confirm your submission.',
    //     // ]);
    //     return redirect()->route('submission.email-sent')->with([
    //         'email' => $email,
    //     ]);
    // }

    public function showForm()
    {
        // If email is already in session (from previous submit)
        $email = session('email');

        if ($email) {
            $submission = SavingsSubmission::where('email', $email)->first();

            if ($submission && $submission->status === 'confirmed') {
                return redirect()
                    ->route('submission.confirmation-result')
                    ->with('status', 'already_confirmed')
                    ->with('confirmed_at', $submission->confirmed_at);
            }
        }

        return view('welcome');
    }

    public function checkEmailStatus(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        $email = strtolower($request->email);

        // Enforce domain here too
        if (!str_ends_with($email, '@ebo.co.ug')) {
            return response()->json([
                'status' => 'invalid_domain',
                'message' => 'Please use your official EBO email address.',
            ], 422);
        }

        $submission = SavingsSubmission::where('email', $email)->latest()->first();

        if (!$submission) {
            return response()->json([
                'status' => 'new',
            ]);
        }

        if ($submission->status === 'confirmed') {
            return response()->json([
                'status' => 'confirmed',
                'confirmed_at' => $submission->confirmed_at,
            ]);
        }

        // Pending but not expired
        if ($submission->status === 'pending' && $submission->tokenIsValid()) {
            return response()->json([
                'status' => 'pending',
            ]);
        }

        // Pending but expired → treat as new
        return response()->json([
            'status' => 'new',
        ]);
    }



    /**
     * Confirm a savings submission via token
     */
    public function confirm(string $token)
    {
        $submission = SavingsSubmission::where('confirmation_token', $token)->first();

        if (!$submission) {
            return redirect()->route('submission.confirmation-result')
                ->with('status', 'invalid');
        }

        if ($submission->isConfirmed()) {
            return redirect()->route('submission.confirmation-result')
                ->with('status', 'already_confirmed');
        }

        if (!$submission->tokenIsValid()) {
            return redirect()->route('submission.confirmation-result')
                ->with('status', 'expired');
        }

        try {
            $submission->update([
                'status' => 'confirmed',
                'confirmed_at' => now(),
                'confirmed_email' => $submission->email, // 🔑 DB uniqueness trigger
                'confirmation_token' => null,
                'token_expires_at' => null,
            ]);
        } catch (\Illuminate\Database\QueryException $e) {
            // Another confirmed row already exists for this email
            return redirect()->route('submission.confirmation-result')
                ->with('status', 'already_confirmed');
        }

        return redirect()->route('submission.confirmation-result')
            ->with([
                'status' => 'success',
                'confirmed_at' => now(),
            ]);
    }
}
