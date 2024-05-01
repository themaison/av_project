@extends('layouts.layout')

@section('title', 'вакансия')

@section('content')
    <link href="{{asset('css/vacancy_detail.css?v=').time()}}" rel="stylesheet">

    @section('menu')
        <div class="w-head-btn">
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

        <div class="breakpoints">
            <a href="">вакансии</a>
            <p>/</p>
            <a href="" id="current-page">UI/UX Дизайнер</a>
        </div>

        <div class="title">
            <img src="{{  asset('images/vacancy_cover.jpg') }}" alt="preview" class="vacancy-cover">
            <h2>Дизайнер сайтов на Tilda</h2>
            <button class="outline-btn"><img src="{{  asset('icons/chunk/brush.svg') }}" alt="pencil"><a>редактировать</a></button>
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
                        <p class="tag"><img src="{{  asset('icons/chunk/map-pin.svg') }}" alt="map-pin">Москва</p>
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
