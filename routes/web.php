<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LeadController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('/leads', [LeadController::class, 'store'])->name('leads.store');

Auth::routes();
Route::get('email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect()
        ->route('home');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back();
})->middleware(['auth', 'throttle:6,1'])->name('verification.resend');

Route::group([
    'middleware' => ['auth']
], function () {
    Route::get('/leads/{lead}/edit', [LeadController::class, 'edit'])->name('leads.edit');
    Route::put('/leads/{lead}', [LeadController::class, 'update'])->name('leads.update');
    Route::delete('/leads/{lead}', [LeadController::class, 'delete'])->name('leads.delete');
    Route::put('/leads/update-status/{lead}', [LeadController::class, 'updateStatus'])->name('leads.updateStatus');
});

Route::fallback(function(){
    return view('errors.404');
});
