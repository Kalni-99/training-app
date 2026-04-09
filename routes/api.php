<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
use Illuminate\Http\Request;

Route::get('/test', function () {
    return response()->json(['message' => 'API is working!']);
});

// GET version for browser testing
Route::get('/mcp/get-user', function (Request $request) {
    $email = $request->query('email');
    
    $user = User::where('email', $email)->first();
    
    if (!$user) {
        return response()->json(['error' => 'User not found: ' . $email], 404);
    }
    
    return response()->json([
        'id' => $user->id,
        'name' => $user->name,
        'email' => $user->email,
        'role' => $user->role,
    ]);
});

// POST version for API calls
Route::post('/mcp/get-user', function (Request $request) {
    $email = $request->input('email');
    
    $user = User::where('email', $email)->first();
    
    if (!$user) {
        return response()->json(['error' => 'User not found: ' . $email], 404);
    }
    
    return response()->json([
        'id' => $user->id,
        'name' => $user->name,
        'email' => $user->email,
        'role' => $user->role,
    ]);
});

Route::post('/mcp/create-user', function (Request $request) {
    $name = $request->input('name');
    $email = $request->input('email');
    $role = $request->input('role', 'user');
    
    $existing = User::where('email', $email)->first();
    if ($existing) {
        return response()->json(['error' => 'User already exists'], 422);
    }
    
    $user = User::create([
        'name' => $name,
        'email' => $email,
        'password' => bcrypt('password123'),
        'role' => $role,
    ]);
    
    return response()->json([
        'id' => $user->id,
        'name' => $user->name,
        'email' => $user->email,
        'role' => $user->role,
        'message' => 'User created. Default password: password123',
    ]);
});