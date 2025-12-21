<?php

use App\Http\Controllers\Admin\SurveyResponseController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SavingsSubmissionController;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [SavingsSubmissionController::class, 'showForm'])
    ->name('survey.form');

Route::post('/submission/check-email', [SavingsSubmissionController::class, 'checkEmailStatus'])
    ->name('submission.check-email');

// Handle savings submission
Route::post('/savings-submissions', [SavingsSubmissionController::class, 'store'])
    ->name('savings-submissions.store');

// Handle email confirmation
Route::get('/confirm-submission/{token}', [SavingsSubmissionController::class, 'confirm'])
    ->name('savings-submissions.confirm');

// Showing the user that they have received to confirm their submission
Route::get('/submission/email-sent', function () {
    return view('submission.email-sent');
})->name('submission.email-sent');
// Shows the user if they have successful submitted their survey date
Route::get('/submission/confirmation-result', function () {
    return view('submission.confirmation-result');
})->name('submission.confirmation-result');
//Admin dashboard
Route::get('/admin/survey-responses', [SurveyResponseController::class, 'index'])
    ->name('admin.survey.index');