<?php

use App\Http\Controllers\ChatController;
use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;

// 3D site. Each page has its own theme and 3D scene (resources/views/pages3d).
// The previous Bootstrap pages are kept in resources/views/pages (not routed).
Route::view('/', 'pages3d.home');
Route::view('/about', 'pages3d.about');
Route::view('/services', 'pages3d.services');
Route::view('/projects', 'pages3d.projects');
Route::view('/dorkari', 'pages3d.dorkari');
Route::view('/team', 'pages3d.team');
Route::view('/assistant', 'pages3d.assistant');
Route::view('/contact', 'pages3d.contact');

// Contact form: max 5 submissions per minute per visitor
Route::post('/contact', [ContactController::class, 'send'])
    ->middleware('throttle:5,1')
    ->name('contact.send');

// Free AI assistant (fair-use limits are inside the controller)
Route::post('/api/chat', ChatController::class)->name('chat');

// Old or short URLs
Route::redirect('/blog', '/');
Route::redirect('/testimonials', '/');
Route::redirect('/3d', '/');
Route::redirect('/service', '/services', 301);
Route::redirect('/project', '/projects', 301);
Route::redirect('/ai', '/assistant', 301);
Route::redirect('/chat', '/assistant', 301);
