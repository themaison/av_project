<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VacancyController;

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
Route::delete('/recruiter_vacancies/{id}', [VacancyController::class, 'vacancy_destroy'])->name('vacancy_destroy');
Route::get('/recruiter_vacancies/new_vacancy', [VacancyController::class, 'new_vacancy_index']);
Route::post('/recruiter_vacancies/new_vacancy/create', [VacancyController::class, 'create_vacancy']);
Route::post('/recruiter_vacancies/new_vacancy/create/upload_cover', [VacancyController::class, 'upload_cover']);

Route::get('/vacancy_detail/{id}', [VacancyController::class, 'vacancy_detail_index']);

Route::get('/vacancy_search', function () {
    return view('vacancy_search');
})->name('vacancy_search');

Route::get('/vacancy_list', function () {
    return view('vacancy_list');
});

Route::get('/profile', function () {
    return view('profile');
});

Route::get('/recruiter_responses', function () {
    return view('recruiter/recruiter_responses');
});

Route::get('/favorite_vacancies', function () {
    return view('applicant/favorite_vacancies');
});

Route::get('/applicant_responses', function () {
    return view('applicant/applicant_responses');
});
