@extends('layouts.layout')

@section('title', 'мои вакансии')

@section('content')
    <link href="{{asset('css/av-cover.css?v=').time()}}" rel="stylesheet">
    <link href="{{asset('css/av-list.css?v=').time()}}" rel="stylesheet">
    <link href="{{asset('css/av-form.css?v=').time()}}" rel="stylesheet">
    <link href="{{ asset('css/recruiter_vacancies.css?v=').time() }}" rel="stylesheet">

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
                }

                if (file) {
                    reader.readAsDataURL(file);
                }
            });
        }
        
        $(document).ready(function() {
            $('.edit-btn').click(function() {
                $('.av-form').fadeIn().css('display', 'flex');
                $('.blur-bg').fadeIn();
                $('body').addClass('no-scroll'); // Добавить класс к body
            });

            $('.cancel-btn, .x-btn').click(function() {
                $('.av-form').fadeOut();
                $('.blur-bg').fadeOut();
                $('body').removeClass('no-scroll'); // Удалить класс из body
            });

            $(document).mouseup(function (e) {
                var container = $(".av-form");
                if (container.has(e.target).length === 0){
                    container.fadeOut();
                    $('.blur-bg').fadeOut();
                    $('body').removeClass('no-scroll'); // Удалить класс из body
                }
            });
        });

    </script>

    <div class="content">

        <div class="blur-bg"></div>

        <div class="title">
            <h2 style="--i: 0">мои вакансии</h2>
            <p style="--i: 1">редактируйте и создавайте новые вакансии<br>
            привлекайте новых соискателей и отбирайте лучших из них</p>
            {{-- <button class="fill-btn"><img src="{{ asset('icons/light/brush.svg') }}" alt="icon"><a href="/recruiter_vacancies/new_vacancy/">создать вакансию</a></button> --}}
            <a href="/recruiter_vacancies/new_vacancy/" class="new-vacancy-btn" style="--i: 2">
                <img src="{{ asset('icons/light/brush.svg') }}" alt="icon">
                создать вакансию
            </a>
        </div>

        @if($vacancies->isEmpty())
            <p class="hint-text" style="--i: 3">у вас еще нет вакансий</p>
        @else
        <div class="av-list" style="--i: 3">
                
            @forelse ($vacancies as $index => $vacancy)
                <div class="l-row" style="--i:{{ $index + 3}}">
                    <div class="set">

                        <div class="elem">
                            <p class="hint-text">{{ $vacancy->created_at }}</p>
                        </div>

                        <a href="/vacancy_detail/{{ $vacancy->id }}" class="elem">
                            @if($vacancy->cover)
                                <div class="cover">
                                    <img src="{{ Storage::url($vacancy->cover) }}" alt="cover">
                                </div>
                                {{-- <img src="{{ Storage::url($vacancy->cover) }}" class="av-img"> --}}
                            @else
                                {{-- <div class="av-img"></div> --}}
                                <div class="cover"></div>
                            @endif
                            <p>{{ $vacancy->title }}</p>
                        </a>

                    </div>

                    <div class="double-btn">

                        {{-- <div class="outline-btn" id="v-edit-{{ $vacancy->id }}">
                            <img src="{{ asset('icons/black/pencil.svg') }}" alt="icon">
                            редактировать
                        </div> --}}

                            <button type="button" class="outline-btn edit-btn" id="edit-btn" data-toggle="modal" data-target="#edit-modal">
                                <img src="{{ asset('icons/black/pencil.svg') }}" alt="icon">
                                редактировать
                            </button>
 
                            <form action="/recruiter_vacancies/vacancy_delete/{{ $vacancy->id }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="delete-btn square-btn">
                                    <img src="{{ asset('icons/black/trash.svg') }}" alt="icon">
                                </button>
                            </form>
                        </div>
                    </div>

                @empty
                    <p>У вас пока нет вакансий.</p>
                @endforelse

            </div>
            @forelse ($vacancies as $vacancy)            
                <form class="av-form" method="POST" enctype="multipart/form-data" action="/recruiter_vacancies/{{ $vacancy->id }}/vacancy_update" style="display: none">
                    @csrf
                    @method('PUT')

                    <button type="submit" class="x-btn">
                        <img src="{{ asset('icons/black/x.svg') }}" alt="icon">
                    </button>
                    <div class="form-title">
                        <h3>Редактировать вакансию</h3>
                    </div>

                    <div class="av-form-module" id="module_1">
                        <div class="inputs-block">
            
                            <div class="input-block">
                                <label for="title">название вакансии</label>
                                <input type="text" name="title" value="{{ $vacancy->title }}" placeholder="введите текст...">
                                
                                @error('title')
                                    <p class="error-text">{{ $message }}</p>
                                @enderror
                                
                            </div>
            
                            <div class="input-block">
                                <label for="company">компания (ИП)</label>
                                <input type="text" name="company"  value="{{ $vacancy->company }}" placeholder="введите текст...">
                                
                                @error('company')
                                    <p class="error-text">{{ $message }}</p>
                                @enderror
                            
                            </div>
            
                            <div class="input-block">
                                <label for="city">город</label>
                                <input type="text" name="city"  value="{{ $vacancy->city }}" placeholder="введите текст...">
                                
                                @error('city')
                                    <p class="error-text">{{ $message }}</p>
                                @enderror
                            
                            </div>

                            <div class="input-block">
                                <label for="salary">заработная плата (₽)</label>
            
                                <div class="double-block">
                                    <div class="input-block">
                                        <input type="text" name ="salary-from"  value="{{ $vacancy->salary_from }}" placeholder="от 10 000">
                                    </div>
            
                                    <div>—</div>
            
                                    <div class="input-block">
                                        <input type="text" name ="salary-to"  value="{{ $vacancy->salary_to }}" placeholder="до 100 000">
                                    </div>
                                </div>
            
                            </div>
            
                            <div class="input-block">
                                <label for="experience">опыт работы (год)</label>
                                <input type="number" name="experience" value="{{ $vacancy->experience }}" placeholder="введите число">
                            </div>

                        </div>
            
                        <div class="form-nav">
                            <button class="fill-btn">дальше<img src="{{ asset('icons/light/angle-right.svg') }}" alt="icon"></button>
                        </div>
                    </div>

                    <div class="av-form-module" id="module_2">
                        <div class="inputs-block">
            
                            <div class="input-block">
                                <label for="responsibilities">обязанности</label>
                                <textarea name="responsibilities" placeholder="введите текст...">{{ $vacancy->responsibilities }}</textarea>
                            </div>

                            <div class="input-block">
                                <label for="requirements">требования</label>
                                <textarea name="requirements" placeholder="введите текст...">{{ $vacancy->requirements }}</textarea>
                            </div>

                            <div class="input-block">
                                <label for="conditions">условия</label>
                                <textarea name="conditions" placeholder="введите текст...">{{ $vacancy->conditions }}</textarea>
                            </div>

                            <div class="input-block">
                                <label for="skills">навыки</label>
                                <p class="hint-text">введите навыки через запятую</p>
                                <textarea name="skills" placeholder="введите текст...">{{ $vacancy->skills }}</textarea>
                            </div>
                            
                        </div>
            
                        <div class="form-nav">
                            <button class="outline-btn">назад</button>
                            <button class="fill-btn">дальше<img src="{{ asset('icons/light/angle-right.svg') }}" alt="icon"></button>
                        </div>
                    </div>    

                    <div class="av-form-module" id="module_3">
                        <div class="inputs-block">
            
                            <div class="input-block">

                                <label for="cover">обложка вакансии</label>
                                <p class="hint-text" id="file_cover-text">желательный формат .png или .jpg</p>
                                
                                <div class="cover">
                                    <img src="{{ Storage::url($vacancy->cover) }}" alt="">
                                </div>

                                <input type="file" class="file-cover" name="cover" accept=".png, .jpg, .jpeg"/>

                                <p class="error-text cover-error"></p>

                            </div>

                        </div>
            
                        <div class="form-nav">
                            <button type="button" class="outline-btn">
                                назад
                            </button>
                            <button type="submit" class="fill-btn" id="edit-submit">
                                сохранить
                            </button>
                        </div>

                    </div>

                </form>
            @empty
            @endforelse
        @endisset

    </div>
@endsection