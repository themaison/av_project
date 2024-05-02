@extends('layouts.layout')

@section('title', 'авторизация')

@section('content')
    <link href="{{asset('css/login.css?v=').time()}}" stylesheet>

    @section('menu')
        <div class="w-head-btn">
            <a href="/login">войти</a>
        </div>
        <div>
            <a href="/applicant_register">зарегистрироваться как соискатель</a>
        </div>
        <div>
            <a href="/recruiter_register">зарегистрироваться как работодатель</a>
        </div>
    @endsection
@endsection