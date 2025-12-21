<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SavingsSubmission;

class SurveyResponseController extends Controller
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
    public function index()
    {
        // Use paginate() instead of get()
        $submissions = SavingsSubmission::latest()->paginate(20); // 20 items per page
        $questions = config('survey_questions');

        // Calculate the missing counts - use separate queries since pagination only returns a subset
        $confirmedCount = SavingsSubmission::where('status', 'confirmed')->count();
        $pendingCount = SavingsSubmission::where('status', 'pending')->count();
        $totalCount = SavingsSubmission::count();

        // Calculate completion rate
        $completionRate = $totalCount > 0 ? round(($confirmedCount / $totalCount) * 100, 1) : 0;

        // Calculate average satisfaction score
        $averageSatisfaction = 0;
        $satisfactionCount = 0;

        // Get all submissions with answers for calculation
        $allSubmissions = SavingsSubmission::whereNotNull('answers')->get();

        foreach ($allSubmissions as $submission) {
            if (isset($submission->answers['q9'])) {
                $satisfaction = $submission->answers['q9'];
                // Convert satisfaction to numeric score
                if (str_contains($satisfaction, 'very_satisfied'))
                    $score = 5;
                elseif (str_contains($satisfaction, 'satisfied'))
                    $score = 4;
                elseif (str_contains($satisfaction, 'dissatisfied'))
                    $score = 2;
                elseif (str_contains($satisfaction, 'very_dissatisfied'))
                    $score = 1;
                else
                    $score = 3; // neutral

                $averageSatisfaction += $score;
                $satisfactionCount++;
            }
        }

        if ($satisfactionCount > 0) {
            $averageSatisfaction = round($averageSatisfaction / $satisfactionCount, 1);
        }

        return view('admin.survey.index', [
            'submissions' => $submissions,
            'questions' => $questions,
            'confirmedCount' => $confirmedCount,
            'pendingCount' => $pendingCount,
            'totalCount' => $totalCount,
            'completionRate' => $completionRate,
            'averageSatisfaction' => $averageSatisfaction,
        ]);
    }
}