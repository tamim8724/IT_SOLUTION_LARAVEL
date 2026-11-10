<?php

use App\Http\Controllers\ChatController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\EnquiryController;
use Illuminate\Support\Facades\Route;

// Site pages (resources/views/site). Light pages: home, about, audit, privacy, terms. Navy: the rest.
Route::view('/', 'site.home')->name('home');
Route::view('/about', 'site.about')->name('about');
Route::view('/services', 'site.services')->name('services');
Route::view('/projects', 'site.projects')->name('projects');
Route::view('/team', 'site.team')->name('team');
Route::view('/assistant', 'site.assistant')->name('assistant');
Route::view('/contact', 'site.contact')->name('contact');
Route::view('/audit', 'site.audit')->name('audit');
Route::view('/privacy', 'site.privacy')->name('privacy');
Route::view('/terms', 'site.terms')->name('terms');

// Free website audit form
Route::post('/audit', [\App\Http\Controllers\AuditController::class, 'send'])->middleware('throttle:5,10')->name('audit.send');
// "Get launch updates" (Our Innovation)
Route::post('/api/launch-updates', \App\Http\Controllers\LaunchUpdatesController::class)->middleware('throttle:5,10')->name('launch.updates');

// Contact form: max 5 submissions per minute per visitor
Route::post('/contact', [ContactController::class, 'send'])
    ->middleware('throttle:5,1')
    ->name('contact.send');

// Free AI assistant (fair-use limits are inside the controller)
Route::post('/api/chat', ChatController::class)->name('chat');
// AI chat leads: save details and email a 6-digit code, then confirm it
Route::post('/api/lead', [\App\Http\Controllers\LeadController::class, 'start'])->middleware('throttle:5,10')->name('lead.start');
Route::post('/api/lead/verify', [\App\Http\Controllers\LeadController::class, 'verify'])->middleware('throttle:15,10')->name('lead.verify');

// Old or short URLs
Route::redirect('/blog', '/');
Route::redirect('/testimonials', '/');
Route::redirect('/3d', '/');
Route::redirect('/dorkari', '/#innovation', 301);
Route::redirect('/innovation', '/#innovation', 301);
Route::redirect('/privacy-policy', '/privacy', 301);
Route::redirect('/terms-of-service', '/terms', 301);
Route::redirect('/service', '/services', 301);
Route::redirect('/project', '/projects', 301);
Route::redirect('/ai', '/assistant', 301);
Route::redirect('/chat', '/assistant', 301);

// Admin: enquiries from the contact form (login required)
Route::get('/admin/login', [AuthController::class, 'show'])->name('login');
Route::post('/admin/login', [AuthController::class, 'login'])->middleware('throttle:5,1')->name('admin.login');
Route::middleware('auth')->prefix('admin')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('admin.logout');
    Route::get('/', fn () => redirect()->route('admin.enquiries'));
    Route::get('/enquiries', [EnquiryController::class, 'index'])->name('admin.enquiries');
    Route::get('/enquiries/export', [EnquiryController::class, 'export'])->name('admin.enquiries.export');
    Route::get('/enquiries/{enquiry}', [EnquiryController::class, 'show'])->name('admin.enquiries.show');
    Route::patch('/enquiries/{enquiry}', [EnquiryController::class, 'update'])->name('admin.enquiries.update');
});
