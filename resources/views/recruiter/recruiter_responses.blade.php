@extends('layouts.layout')

@section('title', 'список соискателей')

@section('content')
    <link href="{{asset('css/recruiter_responses.css?v=').time()}}" rel="stylesheet">

    @section('menu')
        <div class="w-head-btn">
            <a href="/login">войти</a>
        </div>
        <div>
            <a href="/applicant_register">зарегистрироваться как соискатель</a>
        </div>
        <div>
            <a href="/recruiter_responses">отклики</a>
        </div>
        <div>
            <a href="/new_vacancy">новая вакансия</a>
        </div>
        <div>
            <a href="/profile">имя</a>
        </div>
    @endsection
@endsection