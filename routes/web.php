<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VacancyController;
use App\Http\Controllers\ResponseController;

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

Route::get('/logout', [UserController::class, 'logout']);

Route::get('/login_form', [UserController::class, 'login_form'])->name('login_form');
Route::post('/login_form/login', [UserController::class, 'login']);

Route::get('/register_form', [UserController::class, 'register_form'])->name('register_form');
Route::post('/register_form/register', [UserController::class, 'register']);

Route::get('/recruiter_vacancies', [VacancyController::class, 'recruiter_vacancies_index']);
Route::delete('/recruiter_vacancies/vacancy_delete/{id}', [VacancyController::class, 'vacancy_delete']);
Route::get('/recruiter_vacancies/new_vacancy', [VacancyController::class, 'new_vacancy_index']);
Route::post('/recruiter_vacancies/new_vacancy/create', [VacancyController::class, 'create_vacancy']);
Route::put('/recruiter_vacancies/{id}/vacancy_update', [VacancyController::class, 'vacancy_update']);
// Route::post('/recruiter_vacancies/new_vacancy/create/upload_cover', [VacancyController::class, 'upload_cover']);

Route::get('/vacancy_detail/{id}', [VacancyController::class, 'vacancy_detail_index']);

Route::get('/vacancy_search', [VacancyController::class, 'vacancy_search_index']);
Route::get('/vacancy_list', [VacancyController::class, 'search']);

Route::get('/profile/{id}', [ProfileController::class, 'index']);
Route::post('/profile/{id}/update-profile', [ProfileController::class, 'update_profile']);

Route::post('/vacancy_detail/{id}/create_response', [ResponseController::class, 'create_response']);


Route::get('/recruiter_responses', function () {
    return view('recruiter/recruiter_responses');
});

Route::get('/favorite_vacancies', function () {
    return view('applicant/favorite_vacancies');
});

Route::get('/applicant_responses', function () {
    return view('applicant/applicant_responses');
});
