@extends('layouts.layout')

@section('title', 'отклики')

@section('content')
    <link href="{{asset('css/av-list.css?v=').time()}}" rel="stylesheet">
    <link href="{{asset('css/recruiter_responses.css?v=').time()}}" rel="stylesheet">

    @section('menu')
        <a href="/login" class="w-head-btn">войти</a>
        <a href="/register">зарегистрироваться</a>
        <a href="/recruiter_responses">отклики</a>
        <a href="/recruiter_vacancies">мои вакансии</a>
        <a href="/profile">имя</a>
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
                        <img src="{{ asset('icons/gray/message.svg') }}" alt="icon">
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