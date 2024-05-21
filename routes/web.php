<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VacancyController;
use App\Http\Controllers\ResponseController;
use App\Http\Controllers\FavoriteController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::fallback(function () {
    return redirect()->route('vacancy_search');
});

Route::get('/logout', [UserController::class, 'logout']);

Route::get('/login', [UserController::class, 'login'])->name('login');
Route::post('/login/confirm', [UserController::class, 'login_confirm']);

Route::get('/register', [UserController::class, 'register'])->name('register');
Route::post('/register/confirm', [UserController::class, 'register_confirm']);

// Route::get('/recruiter_vacancies', [VacancyController::class, 'recruiter_vacancies_index']);
// Route::get('/recruiter_vacancies/new_vacancy', [VacancyController::class, 'new_vacancy_index']);
// Route::post('/recruiter_vacancies/new_vacancy/create', [VacancyController::class, 'create_vacancy']);

// Route::put('/vacancy/{id}/update', [VacancyController::class, 'vacancy_update']);
// Route::delete('/vacancy/{id}/delete', [VacancyController::class, 'vacancy_delete']);

Route::get('/vacancy_detail/{id}', [VacancyController::class, 'vacancy_detail_index']);

Route::get('/vacancy_search', [VacancyController::class, 'vacancy_search_index'])->name('vacancy_search');;
Route::get('/vacancy_list', [VacancyController::class, 'search']);

Route::get('/applicant_list', [UserController::class, 'search']);

Route::get('/profile/{id}', [ProfileController::class, 'index']);
Route::post('/profile/{id}/update-profile', [ProfileController::class, 'update_profile']);

// Route::post('/vacancy/{id}/create_response', [ResponseController::class, 'create_response']);


// Route::get('/applicant_responses', [ResponseController::class, 'applicant_responses_index']);
// Route::get('/recruiter_responses', [ResponseController::class, 'recruiter_responses_index']);
// Route::post('/response/{id}/set_status', [ResponseController::class, 'set_status']);
// Route::delete('/responses/delete_response/{id}', [ResponseController::class, 'delete_response']);

// Route::get('/favorite_vacancies', [FavoriteController::class, 'favorite_vacancies_index']);
// Route::post('/vacancy/{id}/toggle_favorite', [FavoriteController::class, 'toggle_favorite']);

Route::group(['middleware' => ['auth', 'role:recruiter']], function () {
    Route::get('/recruiter_vacancies', [VacancyController::class, 'recruiter_vacancies_index']);
    Route::get('/recruiter_vacancies/new_vacancy', [VacancyController::class, 'new_vacancy_index']);
    Route::post('/recruiter_vacancies/new_vacancy/create', [VacancyController::class, 'create_vacancy']);

    Route::put('/vacancy/{id}/update', [VacancyController::class, 'vacancy_update']);
    Route::delete('/vacancy/{id}/delete', [VacancyController::class, 'vacancy_delete']);

    Route::get('/recruiter_responses', [ResponseController::class, 'recruiter_responses_index']);
    Route::post('/response/{id}/set_status', [ResponseController::class, 'set_status']);

});

Route::group(['middleware' => ['auth', 'role:applicant']], function () {
    Route::get('/applicant_responses', [ResponseController::class, 'applicant_responses_index']);
    
    Route::post('/vacancy/{id}/create_response', [ResponseController::class, 'create_response']);
    Route::delete('/responses/delete_response/{id}', [ResponseController::class, 'delete_response']);
    
    Route::get('/favorite_vacancies', [FavoriteController::class, 'favorite_vacancies_index']);
    Route::post('/vacancy/{id}/toggle_favorite', [FavoriteController::class, 'toggle_favorite']);
});