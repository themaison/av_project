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

Route::get('/job_search', function () {
    return view('job_search');
});

Route::get('/job_list', function () {
    return view('job_list');
});

Route::get('/favourite_jobs', function () {
    return view('favourite_jobs');
});

Route::get('/job_detail', function () {
    return view('job_detail');
});

Route::get('/job_responses', function () {
    return view('job_responses');
});

Route::get('/profile', function () {
    return view('profile');
});
