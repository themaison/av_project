@extends('layouts.layout')

@section('title', 'имя фамилия отчество')

@section('content')
<link href="{{asset('css/profile.css?v=').time()}}" rel="stylesheet">

    @section('menu')
        <div class="w-head-btn">
            <a href="/login">войти</a>
        </div>
        <div>
            <a href="/recruiter_register">рег. рекрутёром</a>
        </div>
        <div>
            <a href="/applicant_register">рег. соискателем</a>
        </div>
        <div>
            <a href="/favorite_vacancies">избранное</a>
        </div>
        <div>
            <a href="/recruiter_responses">отклики рекрутёра</a>
        </div>
        <div>
            <a href="/applicant_responses">отклики соискателя</a>
        </div>
        <div>
            <a href="/new_vacancy">новая вакансия</a>
        </div>
        <div>
            <a href="/profile">имя</a>
        </div>
    @endsection

    <div class="content">

        <div class="profile-main">
            <img src="{{  asset('images/pa2.png') }}" alt="аватар" class="profile-avatar">
            <h2>Имя Фамилия Отчество</h2>
        </div>

        <div class="profile-data">
            <div class="dblock">
                <div class="text-block">
                    <h3>Контакты</h3>
                    <p>Телефон: +7(978) 888-88-88<br>Телега: the_maison</p>    
                </div>

                <button class="outline-btn"><img src="{{  asset('icons/chunk/brush.svg') }}" alt="pencil">Изменить</button>
            </div>
    
            <div class="dblock">
                <div class="text-block">
                    <h3>Навыки</h3>
                    <p>Figma, Adobe Photoshop, Miro</p>
                </div>
                
                <button class="outline-btn"><img src="{{  asset('icons/chunk/brush.svg') }}" alt="pencil">Изменить</button>
            </div>

            <div class="dblock">
                <div class="text-block">
                    <h3>Резюме</h3>
                    <p>Сертифицированный специалист с успешно реализованными коммерческими проектами
                        <br>Хорошо владею Adobe Photoshop
                        <br>Отлично владею Figma и Tilda</p>
                </div>
                
                <button class="outline-btn"><img src="{{  asset('icons/chunk/brush.svg') }}" alt="pencil">Изменить</button>
            </div>
    
        </div>

    </div>
@endsection