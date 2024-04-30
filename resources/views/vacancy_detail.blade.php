@extends('layouts.layout')

@section('title', 'вакансия')

@section('content')
    <link href="{{asset('css/vacancy_detail.css?v=').time()}}" stylesheet>

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
            <img src="" alt="обложка">
            <h2>UI/UX Дизайнер</h2>
            <div class="edit-btn">редактировать</div>
            <div class="vacancy-description">
                <div class="inline-boxes">
                    <div class="salary">
                        <h3>Заработная плата</h3>
                        <p>80 000 - 100 000</p>
                    </div>
                    <div class="company">
                        <h3>Компания</h3>
                        <p>Бассейн Атлантика</p>
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
                        • </p>
                </div>
            </div>
        </div>
    </div>
@endsection        
