<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return redirect('/vacancy_search');
});

Route::get('/vacancy_search', function () {
    return view('vacancy_search');
});

Route::get('/vacancy_list', function () {
    return view('vacancy_list');
});

Route::get('/vacancy_detail', function () {
    return view('vacancy_detail');
});

Route::get('/profile', function () {
    return view('profile');
});

Route::get('/login', function () {
    return view('login');
});

Route::get('/new_vacancy', function () {
    return view('recruiter/new_vacancy');
});

Route::get('/recruiter_vacancies', function () {
    return view('recruiter/recruiter_vacancies');
});

Route::get('/recruiter_register', function () {
    return view('recruiter/recruiter_register');
});

Route::get('/recruiter_responses', function () {
    return view('recruiter/recruiter_responses');
});

Route::get('/favorite_vacancies', function () {
    return view('applicant/favorite_vacancies');
});

Route::get('/applicant_register', function () {
    return view('applicant/applicant_register');
});

Route::get('/applicant_responses', function () {
    return view('applicant/applicant_responses');
});
