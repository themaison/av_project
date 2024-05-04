@extends('layouts.layout')

@section('title', 'имя фамилия отчество')

@section('content')
<link href="{{asset('css/profile.css?v=').time()}}" rel="stylesheet">

    <div class="content">

        <div class="profile-main">
            <img src="{{  asset('images/pa2.png') }}" alt="аватар" class="profile-avatar">
            <h2>{{ auth()->user()->name }}</h2>
        </div>

        <div class="profile-data">
            <div class="dblock">
                <div class="text-block">
                    <h3>Контакты</h3>
                    <p>Телефон: +7(978) 888-88-88<br>Телега: the_maison</p>    
                </div>

                <button class="outline-btn"><img src="{{  asset('icons/black/brush.svg') }}" alt="pencil">Изменить</button>
            </div>
    
            <div class="dblock">
                <div class="text-block">
                    <h3>Навыки</h3>
                    <p>Figma, Adobe Photoshop, Miro</p>
                </div>
                
                <button class="outline-btn"><img src="{{  asset('icons/black/brush.svg') }}" alt="pencil">Изменить</button>
            </div>

            <div class="dblock">
                <div class="text-block">
                    <h3>Резюме</h3>
                    <p>Сертифицированный специалист с успешно реализованными коммерческими проектами
                        <br>Хорошо владею Adobe Photoshop
                        <br>Отлично владею Figma и Tilda</p>
                </div>
                
                <button class="outline-btn"><img src="{{  asset('icons/black/brush.svg') }}" alt="pencil">Изменить</button>
            </div>
    
        </div>

    </div>
@endsection