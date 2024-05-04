@extends('layouts.layout')

@section('title', 'запрос')

@section('content')
    <link href="{{asset('css/vacancy_list.css?v=').time()}}" rel="stylesheet">

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
            <h2>«Наименование вакансии»</h2>
            <p>найдено <span>N вакансий<span></p>

            <form action="" method="GET">
                <div class="input-group">
                    <input 
                    type="text" 
                    name="query" 
                    class="search" 
                    placeholder="Какая вакансия вас интересует?">
                    <button class="fill-btn" type="submit">найти</button>
                </div>
            </form>
        </div>

        <div class="vacancies-sort">
            <img src="{{ asset('icons/blue/filter.svg') }}" alt="icon">
            <select class="list">
                <option value="new" selected>сначала новые</option>
                <option value="old">сначала старые</option>
                <option value="responses">по откликам</option>
            </select>
        </div>

        <div class="vacancies">
            <div class="v-grid">

                <div class="v-card">
                    <a href="/vacancy_detail" class="l1-data">
                        <img src="{{ asset('images/job_prev.jpg') }}" alt="img" class="av-img">
                        <div class="text-content">
                            <h3>UX/UI Дизайнер</h3>
                            <p>40 000 — 100 000₽</p>
                        </div>
                    </a>
                    
                    <div class="l2-data">
                        <div class="icon-block">
                            <img src="{{ asset('icons/blue/castle.svg') }}" alt="icon">
                            It Pelag
                        </div>
                        <div class="icon-block">
                            <img src="{{ asset('icons/blue/map-pin.svg') }}" alt="icon">
                            Севастополь
                        </div>
                        <div class="icon-block">
                            <img src="{{ asset('icons/blue/toolbox.svg') }}" alt="icon">
                            Опыт от 1 года
                        </div>
                    </div>
    
                    <div class="l3-data">
                        <div class="actions">
                            <button class="fill-btn">откликнуться</button>
                            <button class="outline-btn square-btn"><img src="{{ asset('icons/black/gem.svg') }}" alt="gem"></button>
                        </div>
                        <p>26.04.2024</p>
                    </div>
                </div>

                <div class="v-card">
                    <a href="/vacancy_detail" class="l1-data">
                        <img src="{{ asset('images/job_prev.jpg') }}" alt="img" class="av-img">
                        <div class="text-content">
                            <h3>UX/UI Дизайнер</h3>
                            <p>40 000 — 100 000₽</p>
                        </div>
                    </a>
                    
                    <div class="l2-data">
                        <div class="icon-block">
                            <img src="{{ asset('icons/blue/castle.svg') }}" alt="icon">
                            It Pelag
                        </div>
                        <div class="icon-block">
                            <img src="{{ asset('icons/blue/map-pin.svg') }}" alt="icon">
                            Севастополь
                        </div>
                        <div class="icon-block">
                            <img src="{{ asset('icons/blue/toolbox.svg') }}" alt="icon">
                            Опыт от 1 года
                        </div>
                    </div>
    
                    <div class="l3-data">
                        <div class="actions">
                            <button class="fill-btn">откликнуться</button>
                            <button class="outline-btn square-btn"><img src="{{ asset('icons/black/gem.svg') }}" alt="gem"></button>
                        </div>
                        <p>26.04.2024</p>
                    </div>
                </div>

                <div class="v-card">
                    <a href="/vacancy_detail" class="l1-data">
                        <img src="{{ asset('images/job_prev.jpg') }}" alt="img" class="av-img">
                        <div class="text-content">
                            <h3>UX/UI Дизайнер</h3>
                            <p>40 000 — 100 000₽</p>
                        </div>
                    </a>
                    
                    <div class="l2-data">
                        <div class="icon-block">
                            <img src="{{ asset('icons/blue/castle.svg') }}" alt="icon">
                            It Pelag
                        </div>
                        <div class="icon-block">
                            <img src="{{ asset('icons/blue/map-pin.svg') }}" alt="icon">
                            Севастополь
                        </div>
                        <div class="icon-block">
                            <img src="{{ asset('icons/blue/toolbox.svg') }}" alt="icon">
                            Опыт от 1 года
                        </div>
                    </div>
    
                    <div class="l3-data">
                        <div class="actions">
                            <button class="fill-btn">откликнуться</button>
                            <button class="outline-btn square-btn"><img src="{{ asset('icons/black/gem.svg') }}" alt="gem"></button>
                        </div>
                        <p>26.04.2024</p>
                    </div>
                </div>

            </div>
        </div>

        

        <div class="pagination">
            <a href="" class="arrow-btn">
                <img src="{{ asset('icons/black/angle-left.svg') }}" alt="icon">
            </a>

            <a href="" class="page">1</a>
            <a href="" class="page">2</a>
            <a href="" class="page">3</a>
            <a href="" class="page">...</a>
            <a href="" class="page">5</a>

            <a href="" class="arrow-btn">
                <img src="{{ asset('icons/black/angle-right.svg') }}" alt="icon">
            </a>
        </div>
    </div>
            
@endsection