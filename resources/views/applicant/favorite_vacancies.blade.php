@extends('layouts.layout')

@section('title', 'избранное')

@section('content')
    <link href="{{asset('css/favorite_vacancies.css?v=').time()}}" rel="stylesheet">

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
            <h2>избранное</h2>
            <p>сохранено <span>N вакансий<span></p>
        </div>

        <div class="job-sort">
            <select class="list">
                <option value="new" selected>сначала новые</option>
                <option value="old">сначала старые</option>
                <option value="responses">по откликам</option>
            </select>
        </div>

        <div class="vacancy-block">
            <div class="jobs">
                <div class="job-card">
                    <a href="/vacancy_detail" class="l1-data">
                        <img src="{{ asset('images/job_prev.jpg') }}" alt="preview" class="job-img">
                        <div class="text-content">
                            <h3>Middle+ Front-end Dev...</h3>
                            <p>40 000 — 100 000₽</p>
                        </div>
                    </a>
                    
                    <div class="l2-data">
                        <div class="tag">
                            <img src="{{ asset('icons/blue/map-pin.svg') }}" alt="gem">
                            Севастополь
                        </div>
                        <div class="tag">
                            <img src="{{ asset('icons/blue/toolbox.svg') }}" alt="gem">
                            Опыт от 1 года
                        </div>
                    </div>
    
                    <div class="l3-data">
                        <div class="actions">
                            <button class="fill-btn">откликнуться</button>
                            <button class="outline-btn"><img src="{{ asset('icons/black/trash.svg') }}" alt="trash"></button>
                        </div>
                        <p>26.04.2024</p>
                    </div>
                </div>
                <div class="job-card">
                    <a href="/vacancy_detail" class="l1-data">
                        <img src="{{ asset('images/job_prev.jpg') }}" alt="preview" class="job-img">
                        <div class="text-content">
                            <h3>Middle+ Front-end Dev...</h3>
                            <p>40 000 — 100 000₽</p>
                        </div>
                    </a>
                    
                    <div class="l2-data">
                        <div class="tag">
                            <img src="{{ asset('icons/blue/map-pin.svg') }}" alt="gem">
                            Севастополь
                        </div>
                        <div class="tag">
                            <img src="{{ asset('icons/blue/toolbox.svg') }}" alt="gem">
                            Опыт от 1 года
                        </div>
                    </div>
    
                    <div class="l3-data">
                        <div class="actions">
                            <button class="fill-btn">откликнуться</button>
                            <button class="outline-btn"><img src="{{ asset('icons/black/trash.svg') }}" alt="trash"></button>
                        </div>
                        <p>26.04.2024</p>
                    </div>
                </div>
                <div class="job-card">
                    <a href="/vacancy_detail" class="l1-data">
                        <img src="{{ asset('images/job_prev.jpg') }}" alt="preview" class="job-img">
                        <div class="text-content">
                            <h3>Middle+ Front-end Dev...</h3>
                            <p>40 000 — 100 000₽</p>
                        </div>
                    </a>
                    
                    <div class="l2-data">
                        <div class="tag">
                            <img src="{{ asset('icons/blue/map-pin.svg') }}" alt="gem">
                            Севастополь
                        </div>
                        <div class="tag">
                            <img src="{{ asset('icons/blue/toolbox.svg') }}" alt="gem">
                            Опыт от 1 года
                        </div>
                    </div>
    
                    <div class="l3-data">
                        <div class="actions">
                            <button class="fill-btn">откликнуться</button>
                            <button class="outline-btn"><img src="{{ asset('icons/black/trash.svg') }}" alt="trash"></button>
                        </div>
                        <p>26.04.2024</p>
                    </div>
                </div>
            </div>
        </div>

        

        {{-- <div class="pagination">
            <div class="page">1</div>
            <div class="page">2</div>
            <div class="page">3</div>
        </div> --}}
    </div>
            
@endsection