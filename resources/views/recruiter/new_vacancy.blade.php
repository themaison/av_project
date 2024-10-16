@extends('layouts.layout')

@section('title', 'новая вакансия')

@section('content')

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset('css/av-cover.css?v=') . time() }}" rel="stylesheet">
    <link href="{{ asset('css/av-form.css?v=') . time() }}" rel="stylesheet">
    <link href="{{ asset('css/new_vacancy.css?v=') . time() }}" rel="stylesheet">

    <script>
        window.onload = function() {
            var modules = document.getElementsByClassName('av-form-module');
            var nextButtons = document.getElementsByClassName('next-btn');
            var prevButtons = document.getElementsByClassName('prev-btn');
            var currentModule = 0;

            // Начальное состояние: показываем только первый модуль
            for (var i = 0; i < modules.length; i++) {
                modules[i].style.display = 'none';
            }
            modules[currentModule].style.display = 'flex';

            // Обработчики событий для кнопок "Дальше"
            for (var i = 0; i < nextButtons.length; i++) { // Исключаем последнюю кнопку "Дальше"
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
            for (var i = 0; i < prevButtons.length; i++) {
                prevButtons[i].addEventListener('click', function(e) {
                    e.preventDefault();
                    if (currentModule > 0) {
                        modules[currentModule].style.display = 'none';
                        currentModule--;
                        modules[currentModule].style.display = 'flex';
                    }
                });
            }

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var cover_input = document.querySelector('.file-cover');

            // Обработчик события изменения input
            cover_input.addEventListener('change', function(e) {
                var file = e.target.files[0];
                var reader = new FileReader();

                reader.onloadend = function() {
                    // Удаляем старый элемент .cover, если он существует
                    var old_cover = document.querySelector('.cover');
                    if (old_cover) {
                        old_cover.remove();
                    }

                    // Создаем новый элемент div и img
                    var cover_div = document.createElement('div');
                    cover_div.className = 'cover';
                    var cover_img = document.createElement('img');
                    cover_img.src = reader.result;

                    // Добавляем img в div
                    cover_div.appendChild(cover_img);

                    // Добавляем div в DOM после .hint-text
                    var anchor = document.querySelector('#file_cover-text');
                    anchor.insertAdjacentElement('afterend', cover_div);

                    // Отправка файла на сервер
                    // var formData = new FormData();
                    // formData.append('cover', file);

                    // $.ajax({
                    //     url: '/recruiter_vacancies/new_vacancy/upload_cover',
                    //     type: 'POST',
                    //     data: formData,
                    //     processData: false,
                    //     contentType: false,
                    //     success: function(data) {
                    //         if (data.success) {
                    //             console.log('Файл успешно загружен');
                    //         } else {
                    //             console.error('Ошибка при загрузке файла');
                    //         }
                    //     },
                    //     error: function(error) {
                    //         console.error('Ошибка при отправке файла', error);
                    //     }
                    // });
                }

                if (file) {
                    reader.readAsDataURL(file);
                }
            });
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

        <form class="av-form" method="POST" action="/recruiter_vacancies/new_vacancy/create" enctype="multipart/form-data">
            @csrf

            <div class="av-form-module" id="module_1">
                <div class="form-title">
                    <h3>Создание · Основное</h3>

                    <div class="av-icon">
                        <img src="{{ asset('icons/black/brush.svg') }}" alt="icon">
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
                        <input type="text" name="title" value="{{ old('title') }}" placeholder="введите текст...">

                        @error('title')
                            <p class="error-text">{{ $message }}</p>
                        @enderror

                    </div>

                    <div class="input-block">
                        <label for="company">компания (ИП)</label>
                        <input type="text" name="company" value="{{ old('company') }}" placeholder="введите текст...">

                        @error('company')
                            <p class="error-text">{{ $message }}</p>
                        @enderror

                    </div>

                    <div class="input-block">
                        <label for="city">город</label>
                        <input type="text" name="city" value="{{ old('city') }}" placeholder="введите текст...">

                        @error('city')
                            <p class="error-text">{{ $message }}</p>
                        @enderror

                    </div>

                    <div class="input-block">
                        <label for="salary">заработная плата (₽)</label>

                        <div class="double-block">
                            <div class="input-block">
                                <input type="number" name ="salary-from" value="{{ old('salary-from') }}"
                                    placeholder="от 10 000">
                            </div>

                            <div>—</div>

                            <div class="input-block">
                                <input type="number" name ="salary-to" value="{{ old('salary-to') }}"
                                    placeholder="до 100 000">

                            </div>
                        </div>

                        @error('salary-from')
                            <p class="error-text">{{ $message }}</p>
                        @enderror

                        @error('salary-to')
                            <p class="error-text">{{ $message }}</p>
                        @enderror

                    </div>

                    <div class="input-block">
                        <label for="experience">опыт работы (год)</label>
                        <input type="number" name="experience" value="{{ old('experience') }}"
                            placeholder="введите число">
                    </div>

                </div>

                {{-- @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <p class="error-text">{{ $error }}</p>
                            @endforeach
                        </ul>
                    </div>
                @endif --}}

                <div class="form-nav">
                    <button class="fill-btn next-btn">дальше<img src="{{ asset('icons/light/angle-right.svg') }}"
                            alt="icon"></button>
                </div>
            </div>

            <div class="av-form-module" id="module_2">

                <div class="form-title">
                    <h3>Создание · Описание</h3>

                    <div class="av-icon">
                        <img src="{{ asset('icons/black/brush.svg') }}" alt="icon">
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
                        <textarea name="responsibilities" placeholder="введите текст...">{{ old('responsibilities') }}</textarea>

                        @error('responsibilities')
                            <p class="error-text">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="input-block">
                        <label for="requirements">требования</label>
                        <textarea name="requirements" placeholder="введите текст...">{{ old('requirements') }}</textarea>

                        @error('requirements')
                            <p class="error-text">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="input-block">
                        <label for="conditions">условия</label>
                        <textarea name="conditions" placeholder="введите текст...">{{ old('conditions') }}</textarea>

                        @error('conditions')
                            <p class="error-text">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="input-block">
                        <label for="skills">навыки</label>
                        <p class="hint-text">введите навыки через запятую</p>
                        <textarea name="skills" placeholder="введите текст...">{{ old('skills') }}</textarea>

                        @error('skills')
                            <p class="error-text">{{ $message }}</p>
                        @enderror
                    </div>


                </div>


                <div class="form-nav">
                    <button class="outline-btn prev-btn">
                        назад
                    </button>
                    <button class="fill-btn next-btn">
                        дальше
                        <img src="{{ asset('icons/light/angle-right.svg') }}" alt="icon">
                    </button>
                </div>
            </div>

            <div class="av-form-module" id="module_3">

                <div class="form-title">
                    <h3>Создание · Обложка</h3>

                    <div class="av-icon">
                        <img src="{{ asset('icons/black/brush.svg') }}" alt="icon">
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

                        <label for="cover">обложка вакансии</label>
                        <p class="hint-text" id="file_cover-text">желательный формат .png или .jpg</p>

                        {{-- @if (session('cover_path'))
                            <div class="cover">
                                <img src="{{ Storage::url(session('cover_path')) }}" alt="cover">
                            </div>
                        @endif --}}

                        <input type="file" class="file-cover" name="cover" accept=".png, .jpg, .jpeg" />

                        <p class="error-text cover-error"></p>

                    </div>

                </div>


                <div class="form-nav">
                    <button class="outline-btn prev-btn">
                        назад
                    </button>
                    <button class="fill-btn" type="submit">
                        опубликовать
                    </button>
                </div>

            </div>

        </form>
    </div>
@endsection
