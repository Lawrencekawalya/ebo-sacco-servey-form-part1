<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SavingsSubmission;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\SavingsSubmissionsExport;

class ResponseExportController extends Controller
{
    public function export(Request $request, string $type)
    {
        abort_unless(in_array($type, ['csv', 'excel']), 404);

        $query = SavingsSubmission::query();

        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        if ($request->filled('dateFrom')) {
            $query->whereDate('submitted_at', '>=', $request->dateFrom);
        }

        if ($request->filled('dateTo')) {
            $query->whereDate('submitted_at', '<=', $request->dateTo);
        }

        $rows = $query->get();

        if ($type === 'csv') {
            return $this->exportCsv($rows);
        }

        // return Excel::download(
        //     new SavingsSubmissionsExport($rows),
        //     'savings_submissions.xlsx'
        // );
    }

    protected function exportCsv($rows): StreamedResponse
    {
        $fields = config('survey_form');

        // Build ordered question map from config
        $questions = [];

        foreach ($fields as $field) {
            $key = $field['key'];

            if (str_ends_with($key, '_reason')) {
                $baseKey = str_replace('_reason', '', $key);
                $questions[$baseKey]['reason'] = $field;
            } else {
                $questions[$key]['answer'] = $field;
            }
        }

        return response()->stream(function () use ($rows, $questions) {
            if ($rows->isEmpty()) {
                return;
            }

            $handle = fopen('php://output', 'w');

            // Headers
            $headers = ['ID', 'Email', 'Status', 'Submitted At'];

            foreach ($questions as $question) {
                if (isset($question['answer'])) {
                    $headers[] = $question['answer']['label'];
                }
                if (isset($question['reason'])) {
                    $headers[] = $question['reason']['label'];
                }
            }

            fputcsv($handle, $headers);

            // Rows
            foreach ($rows as $row) {
                $answers = $row->answers ?? [];

                $rowData = [
                    $row->id,
                    $row->email,
                    $row->status,
                    optional($row->submitted_at)->format('Y-m-d H:i'),
                ];

                foreach ($questions as $question) {
                    if (isset($question['answer'])) {
                        $key = $question['answer']['key'];
                        $rowData[] = $answers[$key] ?? '';
                    }

                    if (isset($question['reason'])) {
                        $key = $question['reason']['key'];
                        $rowData[] = $answers[$key] ?? '';
                    }
                }

                fputcsv($handle, $rowData);
            }

            fclose($handle);
        }, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename=savings_submissions.csv',
        ]);
    }
}
