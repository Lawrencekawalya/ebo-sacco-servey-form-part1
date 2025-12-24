<?php

namespace App\Http\Controllers;

use App\Models\SavingsSubmission;
use Illuminate\Http\Request;

class SavingsSubmissionController extends Controller
{
    /**
     * Show the survey form
     */
    public function showForm()
    {
        return view('welcome');
    }

    /**
     * Store an anonymous savings submission
     */
    public function store(Request $request)
    {
        // Optional: basic validation if some fields are required
        // Adjust rules to match your actual form fields
        $request->validate([
            // Example:
            // 'question_1' => ['required'],
            // 'question_2' => ['required'],
        ]);

        // Collect all survey answers
        $answers = collect($request->except('_token'))
            ->filter(fn($value) => $value !== null && $value !== '')
            ->map(function ($value) {
                return is_array($value) ? array_values($value) : $value;
            });

        // Save anonymously
        SavingsSubmission::create([
            'answers' => $answers,
            'submitted_at' => now(),
        ]);

        // Redirect to a simple thank-you page
        return redirect()->route('submission.thank-you');
    }
}
