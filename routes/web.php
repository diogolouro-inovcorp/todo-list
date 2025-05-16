<?php

use App\Http\Controllers\TaskController;
use App\Notifications\TestPushNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('tasks', TaskController::class)->except(['create', 'edit']);
});

Route::get('/manifest.webmanifest', function () {
    return response()
        ->file(public_path('manifest.webmanifest'))
        ->header('Content-Type', 'application/manifest+json');
});

Route::get('/notificar', function () {
    if (auth()->check()) {
        Notification::send(auth()->user(), new TestPushNotification());
        return 'Notificação enviada!';
    }

    return 'Precisas de fazer login!';
});
Route::post('/push/subscribe', function (Request $request) {
    $request->user()->updatePushSubscription(
        $request->input('endpoint'),
        $request->input('keys.p256dh'),
        $request->input('keys.auth')
    );

    return response()->json(['success' => true]);
});

Route::middleware(['auth'])->group(function () {
    Route::get('/settings/push-notifications/status', function () {
        return response()->json([
            'wantsPush' => auth()->user()->wants_push_notifications,
        ]);
    });

    Route::post('/settings/push-notifications/toggle', function (Request $request) {
        $request->validate([
            'wantsPush' => 'required|boolean',
        ]);

        $user = auth()->user();
        $user->wants_push_notifications = $request->wantsPush;
        $user->save();

        return response()->json(['success' => true]);
    });
});
Route::middleware('auth')->group(function () {
    Route::get('/notifications', function () {
        $user = auth()->user();
        return response()->json([
            'notifications' => $user->notifications->take(10),
            'unread' => $user->unreadNotifications->count(),
        ]);
    });

    Route::post('/notifications/mark-as-read', function () {
        auth()->user()->unreadNotifications->markAsRead();
        return response()->json(['success' => true]);
    });
});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';

