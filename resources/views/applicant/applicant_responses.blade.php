@extends('layouts.layout')

@section('title', 'отклики')

@section('content')
    <link href="{{asset('css/applicant_responses.css?v=').time()}}" rel="stylesheet">

    @section('menu')
        <a href="/login" class="w-head-btn">войти</a>
        <a href="/register">зарегистрироваться</a>
        <a href="/favorite_vacancies">избранное</a>
        <a href="/applicant_responses">отклики</a>
        <a href="/profile">имя</a>
    @endsection

    <div class="content">
        <div class="title">
            <h2>отклики</h2>
            <p>ваши отклики за последнее время</p>
        </div>

        <div class="responses">
            <div class="response">
                <div class="status">
                    <p class="stat0">не рассмотрено</p>
                </div>

                <a href="/vacancy_detail" class="vacancy-data">
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

                <button class="outline-btn"><img src="{{  asset('icons/chunk/trash.svg') }}" alt="pencil">удалить</button>
        
            </div>
            <div class="response">
                <div class="status">
                    <p class="stat0">не рассмотрено</p>
                </div>

                <a href="/vacancy_detail" class="vacancy-data">
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

                <button class="outline-btn"><img src="{{  asset('icons/chunk/trash.svg') }}" alt="pencil">удалить</button>
        
            </div>
            <div class="response">
                <div class="status">
                    <p class="stat0">не рассмотрено</p>
                </div>

                <a href="/vacancy_detail" class="vacancy-data">
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

                <button class="outline-btn"><img src="{{  asset('icons/chunk/trash.svg') }}" alt="pencil">удалить</button>
        
            </div>
        </div>
    
    </div>

    {{-- <div class="pagination">
        <div class="page">1</div>
        <div class="page">2</div>
        <div class="page">3</div>
    </div> --}}
@endsection