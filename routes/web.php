<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\DestinationController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\SmartMapController;
use App\Http\Controllers\TouristRouteController;
use App\Http\Middleware\EnsureUserIsAdmin;
use Illuminate\Support\Facades\Route;

// Home & Overview
Route::get('/', [HomeController::class, 'index'])->name('home');

// Routes (المسارات السياحية)
Route::get('/routes', [TouristRouteController::class, 'index'])->name('routes.index');
Route::get('/routes/{slug}', [TouristRouteController::class, 'show'])->name('routes.show');

// Destinations (الوجهات السياحية)
Route::get('/destinations', [DestinationController::class, 'index'])->name('destinations.index');
Route::get('/destinations/{slug}', [DestinationController::class, 'show'])->name('destinations.show');

// Smart Map & AI Trip Planner (الخريطة الذكية ومخطط الرحلات)
Route::get('/smart-map', [SmartMapController::class, 'index'])->name('map.index');
Route::redirect('/map', '/smart-map');
Route::get('/api/map-points', [SmartMapController::class, 'apiPoints'])->name('map.points');
Route::post('/api/ai-plan', [SmartMapController::class, 'aiPlan'])->name('map.ai-plan');
Route::post('/api/save-trip', [SmartMapController::class, 'saveTrip'])->name('map.save-trip');

// Events (الفعاليات والمهرجانات)
Route::get('/events', [EventController::class, 'index'])->name('events.index');
Route::get('/events/{slug}', [EventController::class, 'show'])->name('events.show');

// Booking Flow (إتمام الحجز)
Route::get('/booking', [BookingController::class, 'create'])->name('booking.create');
Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');
Route::get('/booking/{code}', [BookingController::class, 'show'])->name('booking.show');

// Pages: About & Contact (من نحن وتواصل معنا)
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::post('/contact', [PageController::class, 'submitContact'])->name('contact.submit');

// Reviews
Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');

// Authentication & Demo Fast-Login
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/auth/demo/{role}', [AuthController::class, 'demoLogin'])->name('auth.demo');

// User Account (حسابي)
Route::middleware('auth')->group(function () {
    Route::get('/account', [AccountController::class, 'index'])->name('account.index');
    Route::post('/account/profile', [AccountController::class, 'updateProfile'])->name('account.profile.update');
    Route::post('/account/bookings/{id}/cancel', [AccountController::class, 'cancelBooking'])->name('account.bookings.cancel');

    // Admin Dashboard (لوحة التحكم)
    Route::prefix('admin')->middleware(EnsureUserIsAdmin::class)->group(function () {
        Route::get('/', [AdminDashboardController::class, 'index'])->name('admin.index');
        Route::post('/bookings/{id}/status', [AdminDashboardController::class, 'updateBookingStatus'])->name('admin.bookings.status');
        Route::post('/contacts/{id}/read', [AdminDashboardController::class, 'markContactRead'])->name('admin.contacts.read');
    });
});
