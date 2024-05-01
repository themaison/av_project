@extends('layouts.layout')

@section('title', 'вакансия')

@section('content')
    <link href="{{asset('css/vacancy_detail.css?v=').time()}}" rel="stylesheet">

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
        <div class="break-points">
            <a href="/vacancy_list">вакансии</a> / UI/UX Дизайнер
        </div>
        <div class="vacancy-content">
            <img src="{{  asset('images/vacancy_cover.jpg') }}" alt="обложка" class="vacancy-cover">
            <h2>UI/UX Дизайнер</h2>
            <button class="av-btn-v4"><img src="{{  asset('icons/chunk/brush.svg') }}" alt="pencil"><a>редактировать</a></button>
            <div class="vacancy-description">
                <div class="inline-boxes">
                    <div class="salary">
                        <h3>Заработная плата</h3>
                        <p>80 000 — 100 000₽</p>
                    </div>
                    <div class="company">
                        <h3>Компания</h3>
                        <p>
                            <a>Бассейны Атлантика</a>
                            <a class="location"><img src="{{  asset('icons/chunk/map-pin.svg') }}" alt="map-pin">Москва</a>
                        </p>
                    </div>
                </div>
                <div class="responsibilities">
                    <h3>Обязанности</h3>
                    <p> • Разработка сайтов и лендингов на Tilda<br>
                        • Поддержка существующих сайтов<br>
                        • Работа с визуальной составляющей сайтов<br>
                        • Интеграция сайта с Email, Yandex Direct, Google Adwords, VK, Facebook, Instagram, Telegram</p>
                </div>
                <div class="requirements">
                    <h3>Требования</h3>
                    <p> • Подтвержденный опыт работы на Tilda не менее 3 лет<br>
                        • Наличие сертификатов на прохождение курсов работы на Tilda и других обучающих программ<br>
                        • Опыт прототипирования сайта</p>
                </div>
                <div class="conditions">
                    <h3>Условия</h3>
                    <p> • Разработка сайтов и лендингов на Tilda<br>
                        • Белая заработная плата (оклад + премия)<br>
                        • График работы 5/2</p>
                </div>
                <div class="skills">
                    <h3>Навыки</h3>
                    <div class="tags">
                        <a>Figma</a> <a>Figma</a> <a>Figma</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection        
