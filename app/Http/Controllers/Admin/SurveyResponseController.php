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

        $questions = config('survey_questions');

        // KPI: total responses
        $totalCount = SavingsSubmission::count();

        // Satisfaction calculations (Question 8)
        $averageSatisfaction = 0;
        $satisfactionCount = 0;

        $satisfactionDistribution = [
            'very_satisfied' => 0,
            'satisfied' => 0,
            'dissatisfied' => 0,
            'very_dissatisfied' => 0,
        ];

        $allSubmissions = SavingsSubmission::whereNotNull('answers')->get();

        foreach ($allSubmissions as $submission) {
            if (!isset($submission->answers['q8'])) {
                continue;
            }

            $value = $submission->answers['q8'];

            if (isset($satisfactionDistribution[$value])) {
                $satisfactionDistribution[$value]++;
            }

            // Numeric scoring
            match ($value) {
                'very_satisfied' => $averageSatisfaction += 5,
                'satisfied' => $averageSatisfaction += 4,
                'dissatisfied' => $averageSatisfaction += 2,
                'very_dissatisfied' => $averageSatisfaction += 1,
                default => null,
            };

            if (isset($satisfactionDistribution[$value])) {
                $satisfactionCount++;
            }
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
            'questions' => $questions,
            'totalCount' => $totalCount,
            'averageSatisfaction' => $averageSatisfaction,
            'satisfactionDistribution' => $satisfactionDistribution,
            'timelineLabels' => $timeline->pluck('date'),
            'timelineCounts' => $timeline->pluck('total'),
        ]);
    }

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
