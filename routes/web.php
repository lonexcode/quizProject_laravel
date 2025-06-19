<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;





Route::get('/', [UserController::class, 'welcome']);
Route::get('/mcq/{id}/{name}', [UserController::class, 'mcq']);
Route::post('/submit-next/{id}', [UserController::class, 'submitAndNext']);



Route::get('user-quiz-list/{id}/{category}', [UserController::class, 'userQuizList']);
Route::get('start-quiz/{id}/{category}', [UserController::class, 'startQuiz']);
Route::view('user-signup', 'user-signup');
Route::view('user-login', 'user-login');
Route::post('user-signup', [UserController::class, 'userRegister']);
Route::post('user-login', [UserController::class, 'userLogin']);
Route::get('user-signup-start-page', [UserController::class, 'userRegisterStartQuiz']);
Route::get('user-login-start-page', [UserController::class, 'userLoginStartQuiz']);



Route::get('user-logout', [UserController::class, 'logoutUser']);





// ===============================
// Public Routes
// ===============================

//Route::view('/', 'admin-login'); // Redirect root to admin login view
Route::view('admin-login', 'admin-login'); // Admin login page
Route::post('admin-login', [AdminController::class, 'login']); // Handle admin login

// ===============================
// Admin Dashboard & Logout
// ===============================

Route::get('dashboard', [AdminController::class, 'dashboard']); // Admin dashboard
Route::get('admin-logout', [AdminController::class, 'logout']); // Admin logout

// ===============================
// Category Management
// ===============================

Route::get('cateogaries', [AdminController::class, 'cateogaries']); // List categories
Route::post('add-category', [AdminController::class, 'AddCategory']); // Add new category
Route::get('category/delete/{id}', [AdminController::class, 'delCategory']); // Delete category by ID
Route::get('category/list/{id}/{category}', [AdminController::class, 'QuizList']); // List quizzes by category

// ===============================
// Quiz Management
// ===============================

Route::get('add-quiz', [AdminController::class, 'addQuiz']); // Show add quiz page
Route::get('end-quiz', [AdminController::class, 'endQuiz']); // End active quiz
Route::get('show-quiz/{id}/{quizname}', [AdminController::class, 'showQuiz']); // Show quiz details by ID
Route::post('add-mcq', [AdminController::class, 'AddMcq']); // Add multiple choice question (MCQ)
