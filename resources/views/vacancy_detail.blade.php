@extends('layouts.layout')

@section('title', 'вакансия')

@section('content')
    <link href="{{asset('css/vacancy_detail.css?v=').time()}}" rel="stylesheet">

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

        <div class="breakpoints">
            <a href="/vacancy_list">вакансии</a>
            <p>/</p>
            <a href="" id="current-page">UI/UX Дизайнер</a>
        </div>

        <div class="title">
            <img src="{{  asset('images/vacancy_cover.jpg') }}" alt="preview" class="vacancy-cover">
            <h2>Дизайнер сайтов на Tilda</h2>

            @auth
                <div class="double-btn">
                    @if(auth()->user()->hasRole('applicant'))
                        <button class="fill-btn">откликнуться</button>
                        <button class="outline-btn square-btn"><img src="{{  asset('icons/black/gem.svg') }}" alt="icon"></button>
                    @elseif(auth()->user()->hasRole('recruiter'))
                        <button class="fill-btn"><img src="{{  asset('icons/light/pencil.svg') }}" alt="icon">редактировать</button>
                    @endif
                </div>
            @endauth
        </div>

        <div class="vacancy-description">

            <div class="double-block">
                <div class="inline-block" id="salary-block">
                    <h3>Заработная плата</h3>
                    <p class="tag">80 000 — 100 000₽</p>
                </div>

                <div class="inline-block" id="company-block">
                    <h3>Компания</h3>
                    <div class="company-detail">
                        <p>Бассейны Атлантика</p>
                        <p class="tag"><img src="{{  asset('icons/black/map-pin.svg') }}" alt="map-pin">Москва</p>
                    </div>
                </div>

            </div>

            <div class="vacancy-content-block">
                <h3>Обязанности</h3>
                <p> • Разработка сайтов и лендингов на Tilda<br>
                    • Поддержка существующих сайтов<br>
                    • Работа с визуальной составляющей сайтов<br>
                    • Интеграция сайта с Email, Yandex Direct, Google Adwords, VK, Facebook, Instagram, Telegram</p>
            </div>

            <div class="vacancy-content-block">
                <h3>Требования</h3>
                <p> • Подтвержденный опыт работы на Tilda не менее 3 лет<br>
                    • Наличие сертификатов на прохождение курсов работы на Tilda и других обучающих программ<br>
                    • Опыт прототипирования сайта</p>
            </div>

            <div class="vacancy-content-block">
                <h3>Условия</h3>
                <p> • Разработка сайтов и лендингов на Tilda<br>
                    • Белая заработная плата (оклад + премия)<br>
                    • График работы 5/2</p>
            </div>

            <div class="vacancy-content-block">
                <h3>Навыки</h3>
                <div class="tags">
                    <div class="tag">Figma</div>
                    <div class="tag">Adobe Photoshop</div>
                    <div class="tag">Tilda</div>
                    <div class="tag">Adobe Illustrator</div>
                    <div class="tag">Miro</div>
                </div>
            </div>
            
        </div>
    </div>
@endsection        
