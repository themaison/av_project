@extends('layouts.layout')

@section('title', 'отклики')

@section('content')
    <link href="{{asset('css/av-list.css?v=').time()}}" rel="stylesheet">
    <link href="{{asset('css/recruiter_responses.css?v=').time()}}" rel="stylesheet">

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

        <div class="title">
            <h2>отклики</h2>
            <p>отклики на ваши вакансии за последнее время</p>
        </div>

        <div class="av-list">   
            <div class="l-row">
                <div class="set">

                    <div class="elem">
                        <p class="hint-text">30.04.2024 | 21:23</p>
                    </div>

                    <a href="/" class="elem">
                        <div class="prev"></div>
                        {{-- <img src="{{ asset('images/job_prev.jpg') }}" class="prev"> --}}
                        <p>Имя Фамилия Отчество</p>
                    </a>

                    <div class="elem">
                        <img src="{{ asset('icons/blue/envelope.svg') }}" alt="icon">
                        <p>сообщение</p>
                    </div>

                    <a href="/" class="elem">
                        <img src="{{ asset('images/job_prev.jpg') }}" class="prev">
                        <p>Наименование вакансии</p>
                    </a>

                </div>

                <button class="outline-btn square-btn"><img src="{{ asset('icons/gray/3-dots-vertical.svg') }}" alt="icon"></button>
            </div>
        </div>
    </div>
@endsection