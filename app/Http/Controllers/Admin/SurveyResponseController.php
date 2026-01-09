<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SavingsSubmission;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SurveyResponseController extends Controller
{
    /**
     * Display survey responses dashboard
     */
    public function index(Request $request)
    {
        // Base query
        $submissionsQuery = SavingsSubmission::query();

        // Date filters (anonymous-safe)
        if ($request->filled('dateFrom')) {
            $submissionsQuery->whereDate('submitted_at', '>=', $request->dateFrom);
        }

        if ($request->filled('dateTo')) {
            $submissionsQuery->whereDate('submitted_at', '<=', $request->dateTo);
        }

        // Paginated responses table
        $submissions = $submissionsQuery
            ->latest('submitted_at')
            ->paginate(20)
            ->withQueryString();

        // Global KPI: Average Satisfaction (Q8 only)
        // Satisfaction summary (Q8)
        $totalQ8Responses = 0;
        $satisfiedCount = 0;

        SavingsSubmission::whereNotNull('answers')
            ->cursor()
            ->each(function ($submission) use (&$totalQ8Responses, &$satisfiedCount) {
                $value = $submission->answers['q8'] ?? null;

                if (!$value) {
                    return;
                }

                $totalQ8Responses++;

                if (in_array($value, ['very_satisfied', 'satisfied'])) {
                    $satisfiedCount++;
                }
            });

        $q8Config = config('survey_analytics.q8');

        $avgSatisfactionQ8 = null;
        $q8Count = 0;
        $q8Total = 0;

        if ($q8Config && isset($q8Config['options'])) {
            SavingsSubmission::whereNotNull('answers')
                ->cursor()
                ->each(function ($submission) use (&$q8Total, &$q8Count, $q8Config) {
                    $value = $submission->answers['q8'] ?? null;

                    if ($value && isset($q8Config['options'][$value])) {
                        $q8Total += $q8Config['options'][$value];
                        $q8Count++;
                    }
                });

            if ($q8Count > 0) {
                $avgSatisfactionQ8 = round($q8Total / $q8Count, 1);
            }
        }

        // Survey questions config
        $questions = config('survey_analytics');

        // Selected question (default = q8)
        $selectedQuestion = $request->get('question', 'q8');

        // Fallback safety
        if (!isset($questions[$selectedQuestion])) {
            logger()->warning('Invalid survey question requested', [
                'requested' => $request->get('question'),
                'available' => array_keys($questions),
            ]);

            $selectedQuestion = 'q8';
        }

        // Resolve label AFTER selection is known
        $selectedQuestionLabel = $questions[$selectedQuestion]['label'] ?? 'Question';

        $questionConfig = $questions[$selectedQuestion];


        // HARD guard
        // if (!isset($questionConfig['options']) || !is_array($questionConfig['options'])) {
        //     abort(500, "Survey question [$selectedQuestion] is missing options configuration");
        // }

        // KPI: total responses
        $totalCount = SavingsSubmission::count();

        // Dynamic distribution + average score
        $averageSatisfaction = 0;
        $satisfactionCount = 0;

        $satisfactionDistribution = array_fill_keys(
            array_keys($questionConfig['options']),
            0
        );

        // $allSubmissions = SavingsSubmission::whereNotNull('answers')->get();
        $allSubmissions = SavingsSubmission::whereNotNull('answers')->cursor();

        foreach ($allSubmissions as $submission) {
            if (!isset($submission->answers[$selectedQuestion])) {
                continue;
            }

            $value = $submission->answers[$selectedQuestion];

            if (!isset($satisfactionDistribution[$value])) {
                continue;
            }

            $satisfactionDistribution[$value]++;

            // Numeric scoring (generic)
            $averageSatisfaction += $questionConfig['options'][$value] ?? 0;
            $satisfactionCount++;
        }

        if ($satisfactionCount > 0) {
            $averageSatisfaction = round($averageSatisfaction / $satisfactionCount, 1);
        }

        // Timeline (responses per day)
        $range = $request->get('range', 'all');

        $timelineQuery = SavingsSubmission::select(
            DB::raw('DATE(submitted_at) as date'),
            DB::raw('COUNT(*) as total')
        );

        if ($range !== 'all') {
            $timelineQuery->where(
                'submitted_at',
                '>=',
                Carbon::now()->subDays((int) $range)
            );
        }

        $timeline = $timelineQuery
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        return view('admin.survey.index', [
            'submissions' => $submissions,
            'avgSatisfactionQ8' => $avgSatisfactionQ8,
            'selectedQuestionLabel' => $selectedQuestionLabel,
            'questions' => $questions,
            'selectedQuestion' => $selectedQuestion,
            'totalCount' => $totalCount,
            'averageSatisfaction' => $averageSatisfaction,
            'satisfactionDistribution' => $satisfactionDistribution,
            'timelineLabels' => $timeline->pluck('date'),
            'timelineCounts' => $timeline->pluck('total'),
            'satisfiedCount' => $satisfiedCount,
            'totalQ8Responses' => $totalQ8Responses,
        ]);
    }

    // public function index(Request $request)
    // {
    //     // Base query
    //     $submissionsQuery = SavingsSubmission::query();

    //     // Date filters (anonymous-safe)
    //     if ($request->filled('dateFrom')) {
    //         $submissionsQuery->whereDate('submitted_at', '>=', $request->dateFrom);
    //     }

    //     if ($request->filled('dateTo')) {
    //         $submissionsQuery->whereDate('submitted_at', '<=', $request->dateTo);
    //     }

    //     // Paginated responses table
    //     $submissions = $submissionsQuery
    //         ->latest('submitted_at')
    //         ->paginate(20)
    //         ->withQueryString();

    //     $questions = config('survey_questions');

    //     // KPI: total responses
    //     $totalCount = SavingsSubmission::count();

    //     // Satisfaction calculations (Question 8)
    //     $averageSatisfaction = 0;
    //     $satisfactionCount = 0;

    //     $satisfactionDistribution = [
    //         'very_satisfied' => 0,
    //         'satisfied' => 0,
    //         'dissatisfied' => 0,
    //         'very_dissatisfied' => 0,
    //     ];

    //     $allSubmissions = SavingsSubmission::whereNotNull('answers')->get();

    //     foreach ($allSubmissions as $submission) {
    //         if (!isset($submission->answers['q8'])) {
    //             continue;
    //         }

    //         $value = $submission->answers['q8'];

    //         if (isset($satisfactionDistribution[$value])) {
    //             $satisfactionDistribution[$value]++;
    //         }

    //         // Numeric scoring
    //         match ($value) {
    //             'very_satisfied' => $averageSatisfaction += 5,
    //             'satisfied' => $averageSatisfaction += 4,
    //             'dissatisfied' => $averageSatisfaction += 2,
    //             'very_dissatisfied' => $averageSatisfaction += 1,
    //             default => null,
    //         };

    //         if (isset($satisfactionDistribution[$value])) {
    //             $satisfactionCount++;
    //         }
    //     }

    //     if ($satisfactionCount > 0) {
    //         $averageSatisfaction = round($averageSatisfaction / $satisfactionCount, 1);
    //     }

    //     // Timeline (responses per day)
    //     $range = $request->get('range', 'all');

    //     $timelineQuery = SavingsSubmission::select(
    //         DB::raw('DATE(submitted_at) as date'),
    //         DB::raw('COUNT(*) as total')
    //     );

    //     if ($range !== 'all') {
    //         $timelineQuery->where(
    //             'submitted_at',
    //             '>=',
    //             Carbon::now()->subDays((int) $range)
    //         );
    //     }

    //     $timeline = $timelineQuery
    //         ->groupBy('date')
    //         ->orderBy('date')
    //         ->get();

    //     return view('admin.survey.index', [
    //         'submissions' => $submissions,
    //         'questions' => $questions,
    //         'totalCount' => $totalCount,
    //         'averageSatisfaction' => $averageSatisfaction,
    //         'satisfactionDistribution' => $satisfactionDistribution,
    //         'timelineLabels' => $timeline->pluck('date'),
    //         'timelineCounts' => $timeline->pluck('total'),
    //     ]);
    // }

    /**
     * View a single anonymous response
     */
    public function show(SavingsSubmission $submission)
    {
        return view(
            'admin.survey.partials.response-detail',
            compact('submission')
        );
    }

    /**
     * Export a single response as PDF
     */
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
}
