<?php

use Laravel\Fortify\Features;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Crypt;
use App\Mail\WelcomeEmail;
use Illuminate\Support\Facades\Mail;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Two Factor Authentication Settings
    Route::get('/profile/two-factor', function () {
        return view('profile.two-factor');
    })->name('profile.two-factor');
});

// Admin only routes
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin', function () {
        return view('dashboard');
    })->name('admin.dashboard');
});

// Manager+ routes
Route::middleware(['auth', 'role:manager'])->group(function () {
    Route::get('/reports', function () {
        return view('dashboard');
    })->name('reports');
});

// Team+ routes  
Route::middleware(['auth', 'role:team'])->group(function () {
    Route::get('/projects', function () {
        return view('dashboard');
    })->name('projects');
});

//Test helper
Route::get('/test-helpers', function () {
    echo '<h1>Laravel Helpers Demo</h1>';

    echo '<h3>String Helpers</h3>';
    echo '<pre>';
    echo 'Str::slug("Hello World"): ' . Str::slug('Hello World') . "\n";
    echo 'Str::limit("This is a very long text", 10): ' . Str::limit('This is a very long text', 10) . "\n";
    echo 'Str::contains("Hello World", "World"): ' . (Str::contains('Hello World', 'World') ? 'true' : 'false') . "\n";
    echo 'Str::random(10): ' . Str::random(10) . "\n";
    echo 'Str::title("hello world"): ' . Str::title('hello world') . "\n";
    echo '</pre>';

    echo '<h3>Array Helpers</h3>';
    $data = ['name' => 'John', 'email' => 'john@example.com', 'password' => 'secret'];
    echo '<pre>';
    echo 'Arr::get($data, "name"): ' . Arr::get($data, 'name') . "\n";
    echo 'Arr::only($data, ["name", "email"]): ' . print_r(Arr::only($data, ['name', 'email']), true) . "\n";
    echo 'Arr::except($data, ["password"]): ' . print_r(Arr::except($data, ['password']), true) . "\n";
    echo '</pre>';

    echo '<h3>Path Helpers</h3>';
    echo '<pre>';
    echo 'base_path(): ' . base_path() . "\n";
    echo 'storage_path(): ' . storage_path() . "\n";
    echo 'public_path(): ' . public_path() . "\n";
    echo '</pre>';

    echo '<h3>Date Helpers</h3>';
    echo '<pre>';
    echo 'now(): ' . now() . "\n";
    echo 'now()->format("Y-m-d"): ' . now()->format('Y-m-d') . "\n";
    echo 'now()->subDays(7): ' . now()->subDays(7) . "\n";
    echo 'now()->diffForHumans(): ' . now()->diffForHumans() . "\n";
    echo '</pre>';

    echo '<h3>Other Helpers</h3>';
    echo '<pre>';
    echo 'config("app.name"): ' . config('app.name') . "\n";
    echo 'collect([1,2,3,4,5])->sum(): ' . collect([1, 2, 3, 4, 5])->sum() . "\n";
    echo '</pre>';

    return '';
});

//encrytion
Route::get('/test-encryption', function () {
    $original = 'My sensitive data';
    $encrypted = Crypt::encryptString($original);
    $decrypted = Crypt::decryptString($encrypted);
    
    return [
        'original' => $original,
        'encrypted' => $encrypted,
        'decrypted' => $decrypted,
    ];
});

//email
Route::get('/test-email', function () {
    Mail::to('test@example.com')->send(new WelcomeEmail('John Doe'));
    return 'Email sent! Check storage/logs/laravel.log';
});

require __DIR__ . '/auth.php';

// Fortify 2FA Routes
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    if (Features::enabled(Features::twoFactorAuthentication())) {
        Route::get('/user/two-factor-authentication', function () {
            return view('auth.two-factor-challenge');
        })->name('two-factor.login');
    }
});

// Debug route - remove after testing
Route::get('/debug-role', function () {
    if (!auth()->check()) {
        return 'Not logged in';
    }
    return 'Role: ' . auth()->user()->role . ' | IsAtLeast manager? ' . (auth()->user()->isAtLeast('manager') ? 'YES' : 'NO');
})->middleware('auth');

// MCP Routes
Route::post('/mcp', function () {
    return response()->json([
        'status' => 'MCP Server is running',
        'tools' => [
            'get_user' => '/api/mcp/get-user',
            'create_user' => '/api/mcp/create-user',
        ]
    ]);
});
