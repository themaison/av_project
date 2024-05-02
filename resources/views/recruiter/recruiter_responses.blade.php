@extends('layouts.layout')

@section('title', 'список соискателей')

@section('content')
    <link href="{{asset('css/recruiter_responses.css?v=').time()}}" rel="stylesheet">

    @section('menu')
        <a href="/login" class="w-head-btn">войти</a>
        <a href="/register">зарегистрироваться</a>
        <a href="/recruiter_responses">отклики</a>
        <a href="/recruiter_vacancies">мои вакансии</a>
        <a href="/profile">имя</a>
    @endsection
@endsection