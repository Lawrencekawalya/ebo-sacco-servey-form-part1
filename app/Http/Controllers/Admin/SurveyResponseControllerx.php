<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\ConfirmSavingsSubmissionMail;
use App\Models\SavingsSubmission;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;


class SurveyResponseControllerx extends Controller
{
    /**
     * Display a table of all survey responses
     */
    // public function index()
    // {
    //     $submissions = SavingsSubmission::latest()->get();
    //     $questions = config('survey_questions');

    //     // Calculate the missing counts
    //     $confirmedCount = $submissions->where('status', 'confirmed')->count();
    //     $pendingCount = $submissions->where('status', 'pending')->count();
    //     $totalCount = $submissions->count();

    //     // Calculate completion rate
    //     $completionRate = $totalCount > 0 ? round(($confirmedCount / $totalCount) * 100, 1) : 0;

    //     // Calculate average satisfaction score
    //     $averageSatisfaction = 0;
    //     $satisfactionCount = 0;

    //     foreach ($submissions as $submission) {
    //         if (isset($submission->answers['q9'])) {
    //             $satisfaction = $submission->answers['q9'];
    //             // Convert satisfaction to numeric score
    //             if (str_contains($satisfaction, 'very_satisfied'))
    //                 $score = 5;
    //             elseif (str_contains($satisfaction, 'satisfied'))
    //                 $score = 4;
    //             elseif (str_contains($satisfaction, 'dissatisfied'))
    //                 $score = 2;
    //             elseif (str_contains($satisfaction, 'very_dissatisfied'))
    //                 $score = 1;
    //             else
    //                 $score = 3; // neutral

    //             $averageSatisfaction += $score;
    //             $satisfactionCount++;
    //         }
    //     }

    //     if ($satisfactionCount > 0) {
    //         $averageSatisfaction = round($averageSatisfaction / $satisfactionCount, 1);
    //     }

    //     return view('admin.survey.index', [
    //         'submissions' => $submissions,
    //         'questions' => $questions,
    //         'confirmedCount' => $confirmedCount,
    //         'pendingCount' => $pendingCount,
    //         'totalCount' => $totalCount,
    //         'completionRate' => $completionRate,
    //         'averageSatisfaction' => $averageSatisfaction,
    //     ]);
    // }
    // public function index()
    // {
    //     // Use paginate() instead of get()
    //     $submissions = SavingsSubmission::latest()->paginate(20); // 20 items per page
    //     $questions = config('survey_questions');

    //     // Calculate the missing counts - use separate queries since pagination only returns a subset
    //     $confirmedCount = SavingsSubmission::where('status', 'confirmed')->count();
    //     $pendingCount = SavingsSubmission::where('status', 'pending')->count();
    //     $totalCount = SavingsSubmission::count();

    //     // Calculate completion rate
    //     $completionRate = $totalCount > 0 ? round(($confirmedCount / $totalCount) * 100, 1) : 0;

    //     // Calculate average satisfaction score
    //     $averageSatisfaction = 0;
    //     $satisfactionCount = 0;

    //     // Get all submissions with answers for calculation
    //     $allSubmissions = SavingsSubmission::whereNotNull('answers')->get();

    //     foreach ($allSubmissions as $submission) {
    //         if (isset($submission->answers['q9'])) {
    //             $satisfaction = $submission->answers['q9'];
    //             // Convert satisfaction to numeric score
    //             if (str_contains($satisfaction, 'very_satisfied'))
    //                 $score = 5;
    //             elseif (str_contains($satisfaction, 'satisfied'))
    //                 $score = 4;
    //             elseif (str_contains($satisfaction, 'dissatisfied'))
    //                 $score = 2;
    //             elseif (str_contains($satisfaction, 'very_dissatisfied'))
    //                 $score = 1;
    //             else
    //                 $score = 3; // neutral

    //             $averageSatisfaction += $score;
    //             $satisfactionCount++;
    //         }
    //     }

    //     if ($satisfactionCount > 0) {
    //         $averageSatisfaction = round($averageSatisfaction / $satisfactionCount, 1);
    //     }

    //     return view('admin.survey.index', [
    //         'submissions' => $submissions,
    //         'questions' => $questions,
    //         'confirmedCount' => $confirmedCount,
    //         'pendingCount' => $pendingCount,
    //         'totalCount' => $totalCount,
    //         'completionRate' => $completionRate,
    //         'averageSatisfaction' => $averageSatisfaction,
    //     ]);
    // }
    public function index()
    {
        // Paginated submissions for table
        $submissions = SavingsSubmission::latest()->paginate(20);
        $questions = config('survey_questions');

        // KPI counts
        $confirmedCount = SavingsSubmission::where('status', 'confirmed')->count();
        $pendingCount = SavingsSubmission::where('status', 'pending')->count();
        $totalCount = SavingsSubmission::count();

        // Completion rate
        $completionRate = $totalCount > 0
            ? round(($confirmedCount / $totalCount) * 100, 1)
            : 0;

        // Satisfaction calculations (Question 8)
        $averageSatisfaction = 0;
        $satisfactionCount = 0;

        // Distribution for chart
        $satisfactionDistribution = [
            'very_satisfied' => 0,
            'satisfied' => 0,
            'dissatisfied' => 0,
            'very_dissatisfied' => 0,
        ];

        // Timeline range (7, 30, or all)
        $range = request('range', 'all');

        $query = SavingsSubmission::select(
            DB::raw('DATE(created_at) as date'),
            DB::raw('COUNT(*) as total')
        );

        if ($range !== 'all') {
            $query->where(
                'created_at',
                '>=',
                Carbon::now()->subDays((int) $range)
            );
        }

        $responseTimeline = $query
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        $timelineLabels = $responseTimeline->pluck('date');
        $timelineCounts = $responseTimeline->pluck('total');

        $allSubmissions = SavingsSubmission::whereNotNull('answers')->get();

        foreach ($allSubmissions as $submission) {
            if (isset($submission->answers['q8'])) {
                $value = $submission->answers['q8'];

                // Count distribution
                if (isset($satisfactionDistribution[$value])) {
                    $satisfactionDistribution[$value]++;
                }

                // Convert to numeric score for average
                if ($value === 'very_satisfied') {
                    $score = 5;
                } elseif ($value === 'satisfied') {
                    $score = 4;
                } elseif ($value === 'dissatisfied') {
                    $score = 2;
                } elseif ($value === 'very_dissatisfied') {
                    $score = 1;
                } else {
                    continue;
                }

                $averageSatisfaction += $score;
                $satisfactionCount++;
            }
        }

        if ($satisfactionCount > 0) {
            $averageSatisfaction = round(
                $averageSatisfaction / $satisfactionCount,
                1
            );
        }

        return view('admin.survey.index', [
            'submissions' => $submissions,
            'questions' => $questions,
            'confirmedCount' => $confirmedCount,
            'pendingCount' => $pendingCount,
            'totalCount' => $totalCount,
            'completionRate' => $completionRate,
            'averageSatisfaction' => $averageSatisfaction,
            'satisfactionDistribution' => $satisfactionDistribution,
            'timelineLabels' => $timelineLabels,
            'timelineCounts' => $timelineCounts,
        ]);
    }

    public function show(SavingsSubmission $submission)
    {
        return view('admin.survey.partials.response-detail', compact('submission'));
    }

    public function exportPdf(SavingsSubmission $submission)
    {
        $pdf = Pdf::loadView(
            'admin.survey.pdf.response-detail',
            compact('submission')
        );

        return $pdf->download(
            'survey-response-' . $submission->id . '.pdf'
        );
    }

    public function resendConfirmation(SavingsSubmission $submission)
    {
        if ($submission->status !== 'pending') {
            return response()->json([
                'message' => 'This submission is already confirmed.'
            ], 400);
        }

        // Re-send confirmation email
        Mail::to($submission->email)
            ->send(new ConfirmSavingsSubmissionMail($submission));

        return response()->json([
            'message' => 'Confirmation email resent successfully.'
        ]);
    }

}