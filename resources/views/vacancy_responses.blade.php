@extends('layouts.layout')

@section('title', 'Отклики')

@section('content')
    <link href="{{asset('css/vacancy_responses.css?v=').time()}}" rel="stylesheet">

    @section('menu')
        <div class="av-btn-v1">
            <a href="/login">войти</a>
        </div>
        <div>
            <a href="/register">зарегистрироваться</a>
        </div>
        <div>
            <a href="/favorite_vacancies">избранное</a>
        </div>
        <div>
            <a href="/vacancy_responses">отклики</a>
        </div>
        <div>
            <a href="/profile">имя</a>
        </div>
    @endsection

        <div class="content">
            <div class="title">
                <h2>отклики</h2>
                <p>ваши вакансии за последнее время</p>
            </div>

            <div class="responses">
                <div class="response">
                    <div class="status">
                        <p class="stat0">не рассмотрено</p>
                    </div>

                    <a href="/" class="vacancy-data">
                        <div class="d1">
                            <img src="{{  asset('images/job_prev.jpg') }}" class="job-prev">
                            <p>Наименование вакансии</p>
                        </div>
                        <div class="d2">
                            <div class="tag">
                                <img src="{{  asset('icons/chunk/map-pin.svg') }}" >
                                <p>Санкт-Петербург</p>
                            </div>
                            <div class="tag">
                                <img src="{{  asset('icons/chunk/toolbox.svg') }}">
                                <p>Опыт от 1 года</p>
                            </div>
                        </div>
                    </a>

                    <button class="av-btn-v3"><img src="{{  asset('icons/chunk/trash.svg') }}" alt="pencil">удалить</button>
            
                </div>
                <div class="response">
                    <div class="status">
                        <p class="stat0">не рассмотрено</p>
                    </div>

                    <a href="/" class="vacancy-data">
                        <div class="d1">
                            <img src="{{  asset('images/job_prev.jpg') }}" class="job-prev">
                            <p>Наименование вакансии</p>
                        </div>
                        <div class="d2">
                            <div class="tag">
                                <img src="{{  asset('icons/chunk/map-pin.svg') }}" >
                                <p>Санкт-Петербург</p>
                            </div>
                            <div class="tag">
                                <img src="{{  asset('icons/chunk/toolbox.svg') }}">
                                <p>Опыт от 1 года</p>
                            </div>
                        </div>
                    </a>

                    <button class="av-btn-v3"><img src="{{  asset('icons/chunk/trash.svg') }}" alt="pencil">удалить</button>
            
                </div>
                <div class="response">
                    <div class="status">
                        <p class="stat0">не рассмотрено</p>
                    </div>

                    <a href="/" class="vacancy-data">
                        <div class="d1">
                            <img src="{{  asset('images/job_prev.jpg') }}" class="job-prev">
                            <p>Наименование вакансии</p>
                        </div>
                        <div class="d2">
                            <div class="tag">
                                <img src="{{  asset('icons/chunk/map-pin.svg') }}" >
                                <p>Санкт-Петербург</p>
                            </div>
                            <div class="tag">
                                <img src="{{  asset('icons/chunk/toolbox.svg') }}">
                                <p>Опыт от 1 года</p>
                            </div>
                        </div>
                    </a>

                    <button class="av-btn-v3"><img src="{{  asset('icons/chunk/trash.svg') }}" alt="pencil">удалить</button>
            
                </div>
            </div>
       
        </div>

        <div class="pagination">
            <div class="page">1</div>
            <div class="page">2</div>
            <div class="page">3</div>
        </div>
@endsection