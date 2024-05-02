@extends('layouts.layout')

@section('title', 'мои вакансии')

@section('content')
    <link href="{{ asset('css/recruiter_vacancies.css?v=').time() }}" rel="stylesheet">
    
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

    <div class="content">

        <div class="title">
            <h2>мои вакансии</h2>
            <p>Редактируйте и создавайте новые вакансии<br>
            привлекайте новых соискателей и отбирайте лучших из них</p>
            <button class="outline-btn"><img src="{{ asset('icons/chunk/brush.svg') }}" alt="pencil"><a href="/new_vacancy">создать вакансию</a></button>
        </div>
        <div class="vacancies">
            
            <div class="vacancy">
                <div class="creation-date">
                    <p class="date">30.04.2024 | 21:23</p>
                </div>
                <a href="/vacancy_detail" class="vacancy-data">
                    <div class="d1">
                        <img src="{{ asset('images/job_prev.jpg') }}" class="job-prev">
                        <p>Наименование вакансии</p>
                    </div>
                    <div class="d2">
                        <div class="tag">
                            <img src="{{ asset('icons/chunk/map-pin.svg') }}" >
                            <p>Санкт-Петербург</p>
                        </div>
                        <div class="tag">
                            <img src="{{ asset('icons/chunk/toolbox.svg') }}">
                            <p>Опыт от 1 года</p>
                        </div>
                    </div>
                </a>
                <button class="outline-btn"><img src="{{ asset('icons/chunk/trash.svg') }}" alt="pencil">удалить</button>
            </div>

            <div class="vacancy">
                <div class="creation-date">
                    <p class="date">30.04.2024 | 21:23</p>
                </div>
                <a href="/vacancy_detail" class="vacancy-data">
                    <div class="d1">
                        <img src="{{ asset('images/job_prev.jpg') }}" class="job-prev">
                        <p>Наименование вакансии</p>
                    </div>
                    <div class="d2">
                        <div class="tag">
                            <img src="{{ asset('icons/chunk/map-pin.svg') }}" >
                            <p>Санкт-Петербург</p>
                        </div>
                        <div class="tag">
                            <img src="{{ asset('icons/chunk/toolbox.svg') }}">
                            <p>Опыт от 1 года</p>
                        </div>
                    </div>
                </a>
                <button class="outline-btn"><img src="{{ asset('icons/chunk/trash.svg') }}" alt="pencil">удалить</button>
            </div>

            <div class="vacancy">
                <div class="creation-date">
                    <p class="date">30.04.2024 | 21:23</p>
                </div>
                <a href="/vacancy_detail" class="vacancy-data">
                    <div class="d1">
                        <img src="{{ asset('images/job_prev.jpg') }}" class="job-prev">
                        <p>Наименование вакансии</p>
                    </div>
                    <div class="d2">
                        <div class="tag">
                            <img src="{{ asset('icons/chunk/map-pin.svg') }}" >
                            <p>Санкт-Петербург</p>
                        </div>
                        <div class="tag">
                            <img src="{{ asset('icons/chunk/toolbox.svg') }}">
                            <p>Опыт от 1 года</p>
                        </div>
                    </div>
                </a>
                <button class="outline-btn"><img src="{{ asset('icons/chunk/trash.svg') }}" alt="pencil">удалить</button>
            </div>

        </div>
    </div>
@endsection