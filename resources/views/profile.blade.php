@extends('layouts.layout')

@section('title', 'поиск работы')

@section('content')
<link href="{{asset('css/profile.css?v=').time()}}" rel="stylesheet">

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

        <div class="profile-main">
            <img src="{{  asset('images/job_prev.jpg') }}" alt="аватар" class="profile-avatar">
            <h2>Имя Фамилия Отчество</h2>
        </div>

        <div class="profile-data">
            <div class="dblock">
                <div class="text-block">
                    <h3>Контакты</h3>
                    <p>Телефон: +7(978) 888-88-88<br>Телега: the_maison</p>    
                </div>

                <button class="av-btn-v2"><img src="{{  asset('icons/chunk/pencil.svg') }}" alt="pencil">Изменить</button>
            </div>
    
            <div class="dblock">
                <div class="text-block">
                    <h3>Навыки</h3>
                    <p>Figma, Adobe Photoshop, Miro</p>
                </div>
                
                <button class="av-btn-v2"><img src="{{  asset('icons/chunk/pencil.svg') }}" alt="pencil">Изменить</button>
            </div>
    
            <div class="dblock">
                <div class="text-block">
                    <h3>Резюме</h3>
                    <p> Изучаю веб-дизайн более трех лет, постоянно совершенствую свои навыки просмотром вебинаров, онлайн-конференций, формуов, анализу продуктов на рынке (исследованию их плюсов или минусов, возможности оптимизации и усовершенствования). <br>
                        Читаю литературу.Проходил курс по веб-дизайну от МТС. Разрабатывал дизайн макеты для практики в компаннию Крым-Диджитал. <br>
                        Разрабатывал моб. дизайн приложения для сети библиотек Литкомс (1-е в городе, работа выставлена на конкурс IT-планета). Проводил UX исследования, анализ ЦА, разрабатывал несколько вариантов прототипов, вместе с заказчиком принимали решения.
                        Имею опыт работы в команде. Быстро адаптируюсь. Готов к прохождению тестовых заданий.
                        Ответственный, коммуникабельный, исполнительный.
                    </p>
                </div>

                <button class="av-btn-v2"><img src="{{  asset('icons/chunk/pencil.svg') }}" alt="pencil">Изменить</button>
            </div>
        </div>

    </div>
@endsection