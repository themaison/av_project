@extends('layouts.layout')

@section('title', 'мои вакансии')

@section('content')
    <link href="{{ asset('css/recruiter_vacancies.css?v=').time() }}" rel="stylesheet">
    
    @section('menu')
        <a href="/login" class="w-head-btn">войти</a>
        <a href="/register">зарегистрироваться</a>
        <a href="/recruiter_responses">отклики</a>
        <a href="/recruiter_vacancies">мои вакансии</a>
        <a href="/profile">имя</a>
    @endsection

    <div class="content">

        <div class="title">
            <h2>мои вакансии</h2>
            <p>редактируйте и создавайте новые вакансии<br>
            привлекайте новых соискателей и отбирайте лучших из них</p>
            <button class="outline-btn"><img src="{{ asset('icons/chunk/brush.svg') }}" alt="pencil"><a href="/new_vacancy">создать вакансию</a></button>
        </div>

        <div class="vacancies">
            
            <div class="vacancy">
                <div class="v-group">

                    <div class="v-data-block">
                        <p class="hint-text">30.04.2024 | 21:23</p>
                    </div>

                    <a href="/" class="v-data-block">
                        <img src="{{ asset('images/job_prev.jpg') }}" class="vac-prev">
                        <p>Наименование вакансии</p>
                    </a>

                </div>

                <button class="outline-btn"><img src="{{ asset('icons/chunk/trash.svg') }}" alt="pencil">удалить</button>
            </div>

            <div class="vacancy">
                <div class="v-group">

                    <div class="v-data-block">
                        <p class="hint-text">30.04.2024 | 21:23</p>
                    </div>

                    <a href="/" class="v-data-block">
                        <img src="{{ asset('images/job_prev.jpg') }}" class="vac-prev">
                        <p>Наименование вакансии</p>
                    </a>

                </div>

                <button class="outline-btn"><img src="{{ asset('icons/chunk/trash.svg') }}" alt="pencil">удалить</button>
            </div>

        </div>
    </div>
@endsection