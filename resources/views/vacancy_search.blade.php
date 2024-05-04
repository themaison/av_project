@extends('layouts.layout')

@section('title', 'поиск работы')

@section('content')

    <link href="{{asset('css/vacancy_search.css?v=').time()}}" rel="stylesheet">

    @section('menu')

        @guest
            <a href="/login_form" class="w-head-btn">войти</a>
            <a href="/register_form">зарегистрироваться</a>
        @endguest

        @auth
            <a href="/logout" class="w-head-btn">выйти</a>

            @if(auth()->user()->hasRole('applicant'))
                <a href="/favorite_vacancies">избранное</a>
                <a href="/applicant_responses">отклики</a>
                <a href="/profile">имя</a>
            @elseif(auth()->user()->hasRole('recruiter'))
                <a href="/recruiter_responses">отклики</a>
                <a href="/recruiter_vacancies">мои вакансии</a>
                <a href="/profile">имя</a>
            @endif
        @endauth

    @endsection

    <div class="content">

        <div class="search-box">
            <div class="user-role">
                <div class="role-btn" id="active-role">
                    я соискатель
                </div>
                <div class="role-btn">
                    я работодатель
                </div>
            </div>

            <h1>найди работу своей мечты</h1>
            <p>Более <span>1000</span> актуальных вакансий для всех</p>

            <form action="/vacancy_list" method="GET">
                <div class="input-group">
                    <input type="text" name="query" class="search" placeholder="Какая вакансия вас интересует?">
                    <button class="fill-btn" type="submit">найти</button>
                </div>
            </form>
        </div>
    </div>

@endsection