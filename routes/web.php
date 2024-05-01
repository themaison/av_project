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
    return view('welcome');
});

Route::get('/vacancy_search', function () {
    return view('vacancy_search');
});

Route::get('/vacancy_list', function () {
    return view('vacancy_list');
});

Route::get('/favorite_vacancies', function () {
    return view('favorite_vacancies');
});

Route::get('/vacancy_detail', function () {
    return view('vacancy_detail');
});

Route::get('/vacancy_responses', function () {
    return view('vacancy_responses');
});

Route::get('/profile', function () {
    return view('profile');
});

Route::get('/recruiter_vacancies', function () {
    return view('recruiter_vacancies');
});
