<?php

use App\Http\Controllers\Api\AuthController;
use Illuminate\Support\Facades\Route;

// Public authentication routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Authenticated routes
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/profile', [AuthController::class, 'profile']);
    Route::post('/logout', [AuthController::class, 'logout']);

    // Shared endpoint for Admin and Student
    Route::middleware('role:admin,student')->get('/students', function () {
        return response()->json([
            ['id' => 1, 'name' => 'John Doe', 'role' => 'student'],
            ['id' => 2, 'name' => 'Jane Smith', 'role' => 'student']
        ]);
    });

    // Admin only dashboard
    Route::middleware('admin')->get('/admin/dashboard', function () {
        return response()->json(['message' => 'Welcome Admin!']);
    });

    // Student only dashboard
    Route::middleware('role:student')->get('/student/dashboard', function () {
        return response()->json(['message' => 'Welcome Student!']);
    });
});
