@extends('layouts.layout')

@section('title', 'новая вакансия')

@section('content')
    <link href="{{asset('css/av-form.css?v=').time()}}" rel="stylesheet">
    <link href="{{asset('css/new_vacancy.css?v=').time()}}" rel="stylesheet">

    @section('menu')
        <a href="/login" class="w-head-btn">войти</a>
        <a href="/register">зарегистрироваться</a>
        <a href="/recruiter_responses">отклики</a>
        <a href="/recruiter_vacancies">мои вакансии</a>
        <a href="/profile">имя</a>
    @endsection

    <script>
        window.onload = function() {
            var modules = document.getElementsByClassName('av-form-module');
            var nextButtons = document.getElementsByClassName('fill-btn');
            var backButtons = document.getElementsByClassName('outline-btn');
            var currentModule = 0;

            // Начальное состояние: показываем только первый модуль
            for (var i = 0; i < modules.length; i++) {
                modules[i].style.display = 'none';
            }
            modules[currentModule].style.display = 'flex';

            // Обработчики событий для кнопок "Дальше"
            for (var i = 0; i < nextButtons.length - 1; i++) { // Исключаем последнюю кнопку "Дальше"
                nextButtons[i].addEventListener('click', function(e) {
                    e.preventDefault();
                    if (currentModule < modules.length - 1) {
                        modules[currentModule].style.display = 'none';
                        currentModule++;
                        modules[currentModule].style.display = 'flex';
                    }
                });
            }

            // Обработчики событий для кнопок "Назад"
            for (var i = 0; i < backButtons.length; i++) {
                backButtons[i].addEventListener('click', function(e) {
                    e.preventDefault();
                    if (currentModule > 0) {
                        modules[currentModule].style.display = 'none';
                        currentModule--;
                        modules[currentModule].style.display = 'flex';
                    }
                });
            }
        }

    </script>

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

        <form class="av-form" method="POST" action="/create_vacancy">

            <div class="av-form-module" id="module_1">
                <div class="form-title">
                    <h3>Создание · Основное</h3>
    
                    <div class="av-icon">
                        <img src="{{  asset('icons/chunk/brush.svg') }}" alt="icon">
                    </div>
                    
                </div>
    
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
    
    
                <div class="inputs-block">
    
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
    
                        <div class="double-block">
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
    
    
                <div class="form-nav">
                    <button class="fill-btn">дальше<img src="{{ asset('icons/light/angle-right.svg') }}" alt="icon"></button>
                </div>
            </div>

            <div class="av-form-module" id="module_2">

                <div class="form-title">
                    <h3>Создание · Описание</h3>
    
                    <div class="av-icon">
                        <img src="{{  asset('icons/chunk/brush.svg') }}" alt="icon">
                    </div>
                    
                </div>
    
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
    
    
                <div class="inputs-block">
    
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
                        <p class="hint-text">введите навыки через запятую</p>
                        <textarea name="skills" placeholder="введите текст..."></textarea>
                    </div>
                    
                </div>
    
    
                <div class="form-nav">
                    <button class="fill-btn">дальше<img src="{{ asset('icons/light/angle-right.svg') }}" alt="icon"></button>
                    <button class="outline-btn">назад</button>
                </div>
            </div>

            <div class="av-form-module" id="module_3">

                <div class="form-title">
                    <h3>Создание · Основное</h3>
    
                    <div class="av-icon">
                        <img src="{{  asset('icons/chunk/brush.svg') }}" alt="icon">
                    </div>
                    
                </div>
    
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
    
    
                <div class="inputs-block">
    
                    <div class="input-block">
                        <label for="preview">превью вакансии</label>
                        <p class="hint-text">желательный формат .png или .jpg</p>
                        <input type="file" class="preview" name="preview" accept=".png, .jpg">
                    </div>

                </div>
    
    
                <div class="form-nav">
                    <button class="fill-btn" type="submit">опубликовать</button>
                    <button class="outline-btn">назад</button>
                </div>

            </div>

        </form>
    </div>
@endsection