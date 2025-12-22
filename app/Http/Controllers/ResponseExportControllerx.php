<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Response;
use App\Models\SavingsSubmission;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ResponseExportControllerx extends Controller
{
    public function export(Request $request, string $type)
    {
        abort_unless(in_array($type, ['excel', 'csv']), 404);

        $query = SavingsSubmission::query();

        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        if ($request->filled('dateFrom')) {
            $query->whereDate('created_at', '>=', $request->dateFrom);
        }

        if ($request->filled('dateTo')) {
            $query->whereDate('created_at', '<=', $request->dateTo);
        }

        $rows = $query->get();

        return match ($type) {
            'csv' => $this->exportCsv($rows),
            'excel' => $this->exportExcel($rows),
        };
    }

    // protected function exportCsv($rows)
    // {
    //     return response()->stream(function () use ($rows) {
    //         if ($rows->isEmpty()) {
    //             return;
    //         }

    //         $handle = fopen('php://output', 'w');

    //         // Collect all unique answer keys across submissions
    //         $answerKeys = collect($rows)
    //             ->flatMap(fn($row) => array_keys($row->answers ?? []))
    //             ->unique()
    //             ->values()
    //             ->all();

    //         // Header row
    //         fputcsv($handle, array_merge(
    //             ['ID', 'Email', 'Status', 'Submitted At'],
    //             $answerKeys
    //         ));

    //         // Data rows
    //         foreach ($rows as $row) {
    //             $answers = $row->answers ?? [];

    //             fputcsv($handle, array_merge(
    //                 [
    //                     $row->id,
    //                     $row->email,
    //                     $row->status,
    //                     optional($row->submitted_at)->format('Y-m-d H:i'),
    //                 ],
    //                 array_map(
    //                     fn($key) => is_array($answers[$key] ?? null)
    //                     ? json_encode($answers[$key])
    //                     : ($answers[$key] ?? ''),
    //                     $answerKeys
    //                 )
    //             ));
    //         }

    //         fclose($handle);
    //     }, 200, [
    //         'Content-Type' => 'text/csv',
    //         'Content-Disposition' => 'attachment; filename=savings_submissions.csv',
    //     ]);
    // }
    protected function exportCsv($rows)
    {
        return response()->stream(function () use ($rows) {
            if ($rows->isEmpty()) {
                return;
            }

            $handle = fopen('php://output', 'w');

            // Step 1: Collect all answer keys (excluding *_reason)
            $questionKeys = collect($rows)
                ->flatMap(fn($row) => array_keys($row->answers ?? []))
                ->filter(fn($key) => !str_ends_with($key, '_reason'))
                ->unique()
                ->sort()
                ->values();

            // Step 2: Build grouped headers
            $headers = ['ID', 'Email', 'Status', 'Submitted At'];

            foreach ($questionKeys as $key) {
                $headers[] = "{$key}_answer";

                // Only add reason column if it exists in any row
                $hasReason = $rows->contains(
                    fn($row) => array_key_exists("{$key}_reason", $row->answers ?? [])
                );

                if ($hasReason) {
                    $headers[] = "{$key}_reason";
                }
            }

            fputcsv($handle, $headers);

            // Step 3: Write data rows
            foreach ($rows as $row) {
                $answers = $row->answers ?? [];

                $rowData = [
                    $row->id,
                    $row->email,
                    $row->status,
                    optional($row->submitted_at)->format('Y-m-d H:i'),
                ];

                foreach ($questionKeys as $key) {
                    $rowData[] = $answers[$key] ?? '';

                    if (array_key_exists("{$key}_reason", $answers)) {
                        $value = $answers["{$key}_reason"];

                        $rowData[] = is_array($value)
                            ? json_encode($value)
                            : $value;
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


    protected function exportExcel($rows)
    {
        return response()->json([
            'message' => 'Excel export coming next'
        ]);
    }
}
