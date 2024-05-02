@extends('layouts.layout')

@section('title', 'новая вакансия')

@section('content')
    <link href="{{asset('css/new_vacancy.css?v=').time()}}" rel="stylesheet">

    @section('menu')
        <div class="w-head-btn">
            <a href="/login">войти</a>
        </div>
        <div>
            <a href="/applicant_register">зарегистрироваться как соискатель</a>
        </div>
        <div>
            <a href="/new_vacancy">новая вакансия</a>
        </div>
        <div>
            <a href="/recruiter_responses">отклики</a>
        </div>
        <div>
            <a href="/profile">имя</a>
        </div>
    @endsection

    <div class="content">

        <div class="breakpoints">
            <a href="/recruiter_vacancies">мои вакансии</a>
            <p>/</p>
            <a href="" id="current-page">новая вакансия</a>
        </div>

        <div class="title">
            <h2>новая вакансия</h2>
            <p>для добавления новой вакансии заполните все поля</p>
        </div>

        <form class="av-form" method="POST" action="/create-vacancy">
            <div class="form-section" id="part1">
                
                <h3>Создание · Основное</h3>
                <div class="progress-bar">
                    <div class="progress-status" id="current">
                        1
                    </div>
                    <div class="progress-status" id="">
                        2
                    </div>
                    <div class="progress-status" id="">
                        3
                    </div>
                </div>

                <div class="inputs">

                    <div class="input-block">
                        <label for="title">название вакансии</label>
                        <input type="text" name="title" placeholder="введите текст...">
                    </div>

                    <div class="input-block">
                        <label for="company">компания (ИП)</label>
                        <input type="text" name="company" placeholder="введите текст...">
                    </div>

                    <div class="input-block">
                        <label for="city">город</label>
                        <input type="text" name="city" placeholder="введите текст...">
                    </div>

                    <div class="input-block">
                        <label for="salary">заработная плата (₽)</label>

                        <div class="salary-float">
                            <div class="input-block">
                                <input type="text" name ="salary-from" placeholder="от 10 000">
                            </div>

                            <div>—</div>
    
                            <div class="input-block">
                                <input type="text" name ="salary-to" placeholder="до 100 000">
                            </div>
                        </div>
                    </div>

                    <div class="input-block">
                        <label for="experience">опыт работы</label>
                        <input type="text" name="experience" placeholder="введите число">
                    </div>

                </div>

                <div class="form-navigation">
                    {{-- <button class="outline-btn">назад</button> --}}
                    <button class="fill-btn">дальше<img src="{{ asset('icons/light/angle-right.svg') }}" alt="icon"></button>
                </div>
            </div>
        
            <div class="form-section" id="part2">
                
                <h3>Создание · Описание</h3>
                <div class="progress-bar">
                    <div class="progress-status" id="filled">
                        1
                    </div>
                    <div class="progress-status" id="current">
                        2
                    </div>
                    <div class="progress-status" id="">
                        3
                    </div>
                </div>

                <div class="inputs">

                    <div class="input-block">
                        <label for="responsibilities">обязанности</label>
                        <textarea name="responsibilities" placeholder="введите текст..."></textarea>
                    </div>

                    <div class="input-block">
                        <label for="requirements">требования</label>
                        <textarea name="requirements" placeholder="введите текст..."></textarea>
                    </div>

                    <div class="input-block">
                        <label for="conditions">условия</label>
                        <textarea name="conditions" placeholder="введите текст..."></textarea>
                    </div>

                    <div class="input-block">
                        <label for="skills">навыки</label>
                        <p>введите навыки через запятую</p>
                        <textarea name="skills" placeholder="введите текст..."></textarea>
                    </div>

                </div>

                <div class="form-navigation">
                    <button class="fill-btn">дальше<img src="{{ asset('icons/light/angle-right.svg') }}" alt="icon"></button>
                    <button class="outline-btn">назад</button>
                </div>
            </div>
        
            <div class="form-section" id="part3">
                
                <h3>Создание · Обложка</h3>
                <div class="progress-bar">
                    <div class="progress-status" id="filled">
                        1
                    </div>
                    <div class="progress-status" id="filled">
                        2
                    </div>
                    <div class="progress-status" id="current">
                        3
                    </div>
                </div>

                <div class="inputs">

                    <div class="input-block">
                        <label for="preview">превью вакансии</label>
                        <p>желательный формат : 1520x420 (.png или .jpg)</p>
                        <input type="file" id="preview" name="preview" accept=".png, .jpg">
                    </div>

                </div>

                <div class="form-navigation">
                    <button type="sybmit" class="fill-btn">опубликовать вакансию<img src="{{ asset('icons/light/arrow-up-from-line.svg') }}" alt="icon"></button>
                    <button class="outline-btn">назад</button>
                </div>
            </div>

        </form>

    </div>
@endsection