<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SavingsSubmissionController;
use App\Http\Controllers\Admin\SurveyResponseController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ResponseExportController;

/*
|--------------------------------------------------------------------------
| Public Survey Routes (NO AUTH)
|--------------------------------------------------------------------------
*/

// Survey landing page
Route::get('/', [SavingsSubmissionController::class, 'showForm'])
    ->name('survey.form');

// Check email status (AJAX)
Route::post('/submission/check-email', [SavingsSubmissionController::class, 'checkEmailStatus'])
    ->name('submission.check-email');

// Submit survey
Route::post('/savings-submissions', [SavingsSubmissionController::class, 'store'])
    ->name('savings-submissions.store');

// Email confirmation
Route::get('/confirm-submission/{token}', [SavingsSubmissionController::class, 'confirm'])
    ->name('savings-submissions.confirm');

// Email sent notice
Route::get('/submission/email-sent', function () {
    return view('submission.email-sent');
})->name('submission.email-sent');

// Confirmation result page
Route::get('/submission/confirmation-result', function () {
    return view('submission.confirmation-result');
})->name('submission.confirmation-result');


/*
|--------------------------------------------------------------------------
| Admin Routes (AUTH REQUIRED)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    // Admin dashboard
    Route::get('/admin/survey-responses', [SurveyResponseController::class, 'index'])
        ->name('admin.survey.index');

    // View a single response
    Route::get('/admin/survey/{submission}', [SurveyResponseController::class, 'show'])
        ->name('admin.survey.show');

    // Export individual response PDF
    Route::get(
        '/admin/survey/{submission}/export-pdf',
        [SurveyResponseController::class, 'exportPdf']
    )->name('admin.survey.export.pdf');

    // Resend confirmation email
    Route::post(
        '/admin/survey/{submission}/resend-confirmation',
        [SurveyResponseController::class, 'resendConfirmation']
    )->name('admin.survey.resend');

    // Export CSV (filtered)
    Route::get('/responses/export/{type}', [ResponseExportController::class, 'export'])
        ->name('responses.export');
    //Logout
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
});


/*
|--------------------------------------------------------------------------
| Breeze Auth Routes
|--------------------------------------------------------------------------
*/
require __DIR__ . '/auth.php';
