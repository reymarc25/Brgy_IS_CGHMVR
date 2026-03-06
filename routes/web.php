<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AidDistributionController;
use App\Http\Controllers\AuditLogController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlotterCaseController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DemographicController;
use App\Http\Controllers\DocumentRequestController;
use App\Http\Controllers\PurokController;
use App\Http\Controllers\ResidentController;
use Illuminate\Support\Facades\Route;

Route::get('/favicon.png', function () {
    $path = public_path('favicon.png');
    abort_unless(file_exists($path), 404);
    return response()->file($path);
});

Route::get('/images/{path}', function (string $path) {
    $fullPath = public_path('images/'.$path);
    abort_unless(file_exists($fullPath), 404);
    return response()->file($fullPath);
})->where('path', '.*');

Route::get('/build/assets/{path}', function (string $path) {
    $fullPath = public_path('build/assets/'.$path);
    abort_unless(file_exists($fullPath), 404);

    $extension = strtolower(pathinfo($fullPath, PATHINFO_EXTENSION));
    $mimeType = match ($extension) {
        'css' => 'text/css; charset=UTF-8',
        'js', 'mjs' => 'application/javascript; charset=UTF-8',
        'json', 'map' => 'application/json; charset=UTF-8',
        default => mime_content_type($fullPath) ?: 'application/octet-stream',
    };

    return response(file_get_contents($fullPath), 200, [
        'Content-Type' => $mimeType,
        'Cache-Control' => 'public, max-age=31536000, immutable',
        'Content-Length' => (string) filesize($fullPath),
    ]);
})->where('path', '.*');

Route::get('/', function () {
    return auth()->check()
        ? redirect()->route('admin.dashboard')
        : redirect()->route('login');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.authenticate');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/admin/dashboard', DashboardController::class)->name('admin.dashboard');
    Route::resource('residents', ResidentController::class);
    Route::put('/residents/{resident}/status', [ResidentController::class, 'updateStatus'])->name('residents.status.update');
    Route::get('/purok', [PurokController::class, 'index'])->name('purok.index');
    Route::get('/purok/{number}', [PurokController::class, 'show'])->name('purok.show');
    Route::get('/demographic', [DemographicController::class, 'index'])->name('demographic.index');
    Route::resource('documents', DocumentRequestController::class)->only(['index', 'create', 'store', 'show']);
    Route::put('/documents/{document}/payment', [DocumentRequestController::class, 'updatePayment'])->name('documents.payment.update');
    Route::put('/documents/{document}/cancel', [DocumentRequestController::class, 'cancel'])->name('documents.cancel');
    Route::delete('/documents/{document}', [DocumentRequestController::class, 'destroy'])->name('documents.destroy');
    Route::resource('blotter', BlotterCaseController::class)->only(['index', 'create', 'store']);
    Route::put('/blotter/{blotter}/status', [BlotterCaseController::class, 'updateStatus'])->name('blotter.status.update');
    Route::get('/aid-distribution', [AidDistributionController::class, 'index'])->name('aid.index');
    Route::post('/aid-distribution', [AidDistributionController::class, 'store'])->name('aid.store');
    Route::get('/admin/audit-logs', [AuditLogController::class, 'index'])->name('audit.index')->middleware('can:admin-only');

    Route::get('/auth/change-password', [AccountController::class, 'editPassword'])->name('password.change');
    Route::put('/auth/change-password', [AccountController::class, 'updatePassword'])->name('password.update');
});
