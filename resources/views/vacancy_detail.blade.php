@extends('layouts.layout')

@section('title', 'вакансия')

@section('content')
    <link href="{{ asset('css/av-form.css?v=') . time() }}" rel="stylesheet">
    <link href="{{ asset('css/av-cover.css?v=') . time() }}" rel="stylesheet">
    <link href="{{ asset('css/vacancy_detail.css?v=') . time() }}" rel="stylesheet">

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
        };

        $(document).ready(function() {
            // var vacancyId = $(this).data('vacancy-id');
            // $('#edit-form').attr('action', '/acancy/' + vacancyId + '/update');


            var previousUrl = document.referrer;
            var linkText;

            if (previousUrl.includes('vacancy_list')) {
                linkText = 'список вакансий';
            } else if (previousUrl.includes('recruiter_vacancies')) {
                linkText = 'мои вакансии';
            } else if (previousUrl.includes('response')) {
                linkText = 'отклики';
            } else if (previousUrl.includes('favorite')) {
                linkText = 'избранное';
            } else {
                linkText = 'вакансии';
            }

            if ('{{ $errors->any() }}') {
                $('#edit-form').css('display', 'flex');
                $('.blur-bg').fadeIn();
                $('body').addClass('no-scroll');
            }

            $('#previous-page').text(linkText);

            $('.cancel-btn, .x-btn').click(function() {
                $('.av-form').hide();
                $('.blur-bg').fadeOut();
                $('body').removeClass('no-scroll');
            });

            $('#response-btn').click(function() {
                $('#response-form').attr('action', '/vacancy/' + {{ $vacancy->id }} +
                    '/create_response');
                $('#response-form').fadeIn().css('display', 'flex');
                $('.blur-bg').fadeIn();
            });


            $('#response-form').on('submit', function(e) {
                e.preventDefault();

                $.ajax({
                    url: $(this).attr('action'),
                    method: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        if (response.success) {
                            $('#response-form').hide();
                            $('#response-btn').replaceWith(
                                '<div class="hint-btn">уже откликнулись</div>');
                            $('.blur-bg').fadeOut();
                            $('body').removeClass('no-scroll');
                        } else {
                            // Обработка ошибок
                        }
                    }
                });
            });

            $('#favorite-btn').click(function(event) {
                event.preventDefault();

                var vacancyId = $(this).data('vacancy-id');

                $.ajax({
                    url: '/vacancy/' + vacancyId + '/toggle_favorite',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(data) {
                        if (data.favorite) {
                            $('#favorite-btn').removeClass('outline-btn').addClass(
                                'fill-btn');
                            $('#favorite-icon').attr('src',
                                '{{ asset('icons/light/bookmark.svg') }}');
                        } else {
                            $('#favorite-btn').removeClass('fill-btn').addClass(
                                'outline-btn');
                            $('#favorite-icon').attr('src',
                                '{{ asset('icons/black/bookmark.svg') }}');
                        }
                    }
                });
            });

            // Проверить, есть ли параметр 'edit' в URL
            var urlParams = new URLSearchParams(window.location.search);
            if (urlParams.has('edit')) {
                // var vacancyId = $(this).data('vacancy-id');
                // $('#edit-form').attr('action', '/vacancy/' + vacancyId + '/update');

                $('#edit-form').fadeIn().css('display', 'flex');
                $('.blur-bg').fadeIn();
                $('body').addClass('no-scroll'); // Добавить класс к b
            }

            $('#edit-btn').click(function() {
                // var vacancyId = $(this).data('vacancy-id');
                // $('#edit-form').attr('action', '/vacancy/' + vacancyId + '/update');
                $('#edit-form').fadeIn().css('display', 'flex');
                $('.blur-bg').fadeIn();
                $('body').addClass('no-scroll'); // Добавить класс к body
            });

        });
    </script>


    <div class="content">

        <div class="blur-bg"></div>

        <form id="edit-form" class="av-form" method="POST" action="/vacancy/{{ $vacancy->id }}/update"
            enctype="multipart/form-data" style="{{ $errors->any() ? 'display: flex' : 'display: none' }}">
            @csrf

            @method('PUT')

            <div class="x-btn">
                <img src="{{ asset('icons/black/x.svg') }}" alt="icon">
            </div>


            <div class="av-form-module" id="module_1">
                <div class="form-title">
                    <h3>Редактирование</h3>

                    <div class="av-icon">
                        <img src="{{ asset('icons/black/brush.svg') }}" alt="icon">
                    </div>

                </div>

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
                        <input type="text" name="company" value="{{ $vacancy->company }}"
                            placeholder="введите текст...">

                        @error('company')
                            <p class="error-text">{{ $message }}</p>
                        @enderror

                    </div>

                    <div class="input-block">
                        <label for="city">город</label>
                        <input type="text" name="city" value="{{ $vacancy->city }}" placeholder="введите текст...">

                        @error('city')
                            <p class="error-text">{{ $message }}</p>
                        @enderror

                    </div>

                    <div class="input-block">
                        <label for="salary">заработная плата (₽)</label>

                        <div class="double-block">
                            <div class="input-block">
                                <input type="number" name ="salary-from" value="{{ $vacancy->salary_from }}"
                                    placeholder="от 10 000">
                            </div>

                            <div>—</div>

                            <div class="input-block">
                                <input type="number" name ="salary-to" value="{{ $vacancy->salary_to }}"
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
                        <input type="number" name="experience" value="{{ $vacancy->experience }}"
                            placeholder="введите число">
                    </div>

                </div>

                <div class="form-nav">
                    <button class="fill-btn next-btn">дальше<img src="{{ asset('icons/light/angle-right.svg') }}"
                            alt="icon"></button>
                </div>
            </div>

            <div class="av-form-module" id="module_2">

                <div class="form-title">
                    <h3>Редактирование</h3>

                    <div class="av-icon">
                        <img src="{{ asset('icons/black/brush.svg') }}" alt="icon">
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
                    <h3>Редактирование</h3>

                    <div class="av-icon">
                        <img src="{{ asset('icons/black/brush.svg') }}" alt="icon">
                    </div>

                </div>

                <div class="inputs-block">

                    <div class="input-block">

                        <label for="cover">обложка вакансии</label>
                        <p class="hint-text" id="file_cover-text">желательный формат .png или .jpg</p>

                        <div class="cover">
                            @if ($vacancy->cover)
                                <img src="{{ Storage::url($vacancy->cover) }}" alt="cover">
                            @else
                                <img src="{{ asset('images/vacancy_cover.jpg') }}" alt="v-cover">
                            @endif

                        </div>

                        <input type="file" class="file-cover" name="cover" accept=".png, .jpg, .jpeg" />

                        <p class="error-text cover-error"></p>

                    </div>

                </div>


                <div class="form-nav">
                    <button class="outline-btn prev-btn">
                        назад
                    </button>

                    <button class="fill-btn" type="submit">
                        сохранить
                    </button>
                </div>

            </div>

        </form>

        <form id="response-form" class="av-form" method="POST" action="/vacancy/{{ $vacancy->id }}/create_response"
            enctype="multipart/form-data" style="display: none">
            @csrf

            <div class="x-btn">
                <img src="{{ asset('icons/black/x.svg') }}" alt="icon">
            </div>

            <div class="form-title">
                <h3>Отклик</h3>
                <div class="av-icon">
                    <img src="{{ asset('icons/black/hand-tap.svg') }}" alt="icon">
                </div>
            </div>

            <div class="inputs-block">

                <div class="input-block">
                    <label for="cover_letter">сопроводительное письмо</label>
                    <textarea name="cover_letter" placeholder="введите текст...">{{ old('cover_letter') }}</textarea>

                    @error('cover_letter')
                        <p class="error-text">{{ $message }}</p>
                    @enderror

                </div>

            </div>

            <div class="form-nav">
                <div class="outline-btn cancel-btn">отменить</div>
                <button type="submit" class="fill-btn">откликнуться</button>
            </div>

        </form>

        <div class="breakpoints" style="--i: 0">
            <a href="{{ url()->previous() }}" id="previous-page"></a>
            <p>/</p>
            <a href="/vacancy_detail/{{ $vacancy->id }}" id="current-page">{{ $vacancy->title }}</a>
        </div>

        <div class="vacancy-column-content">

            <div class="cover" style="--i: 1">
                @if ($vacancy->cover)
                    <img src="{{ Storage::url($vacancy->cover) }}" alt="cover">
                @else
                    <img src="{{ asset('images/vacancy_cover.jpg') }}" alt="v-cover">
                @endif
            </div>

            {{-- @if ($vacancy->cover)
                <div class="cover" style="--i: 1">
                    <img src="{{ Storage::url($vacancy->cover) }}" alt="cover">
                </div>
            @else
                <div class="cover" style="--i: 1"></div>
            @endif --}}

            <div class="vacancy-actions">
                <h2 class="vacancy-title" style="--i: 2">{{ $vacancy->title }}</h2>
                @auth

                    <div class="double-btn" style="--i: 3">
                        @if (auth()->user()->hasRole('applicant'))
                            @if (auth()->user()->responses()->where('vacancy_id', $vacancy->id)->exists())
                                <div class="hint-btn">уже откликнулись</div>
                            @else
                                <div class="fill-btn" id="response-btn">откликнуться</div>
                            @endif

                            @php
                                $isFavorite = Auth::user()
                                    ->favorites()
                                    ->where('vacancy_id', $vacancy->id)
                                    ->exists();
                            @endphp

                            <div id="favorite-btn" href="/vacancy/{{ $vacancy->id }}/toggle_favorite"
                                class="{{ $isFavorite ? 'fill-btn square-btn' : 'outline-btn square-btn' }}"
                                data-vacancy-id="{{ $vacancy->id }}">

                                <img id="favorite-icon"
                                    src="{{ $isFavorite ? asset('icons/light/bookmark.svg') : asset('icons/black/bookmark.svg') }}"
                                    alt="icon">
                            </div>
                        @elseif(auth()->user()->hasRole('recruiter'))
                            <div id="edit-btn" class="fill-btn" data-vacancy-id="{{ $vacancy->id }}">
                                <img src="{{ asset('icons/light/pencil.svg') }}" alt="icon">
                                изменить
                            </div>
                        @endif
                    </div>

                @endauth
            </div>

            <div class="vacancy-description">

                <div class="double-block">
                    <div class="inline-block" id="salary-block" style="--i: 4">
                        <h3>Заработная плата</h3>

                        <div class="v-block-detail">
                            @if ($vacancy->experience <= 0)
                                <p>Без опыта</p>
                            @else
                                <p>Опыт от {{ $vacancy->experience }} лет</p>
                            @endif

                            @if ($vacancy->salary_from && $vacancy->salary_to)
                                <p>{{ number_format($vacancy->salary_from, 0, ',', ' ') }} —
                                    {{ number_format($vacancy->salary_to, 0, ',', ' ') }}₽</p>
                            @elseif($vacancy->salary_from)
                                <p class="tag">от {{ number_format($vacancy->salary_from, 0, ',', ' ') }}₽</p>
                            @elseif($vacancy->salary_to)
                                <p class="tag">до {{ number_format($vacancy->salary_to, 0, ',', ' ') }}₽</p>
                            @else
                                <p class="tag">Не указана</p>
                            @endif
                        </div>
                    </div>

                    <div class="inline-block" id="company-block" style="--i: 5">
                        <h3>Компания</h3>

                        <div class="v-block-detail">
                            <p class="line-limit">{{ $vacancy->company }}</p>
                            <p class="tag line-limit"><img src="{{ asset('icons/black/map-pin.svg') }}"
                                    alt="map-pin">{{ $vacancy->city }}</p>
                        </div>
                    </div>

                </div>

                @if ($vacancy->responsibilities)
                    <div class="vacancy-content-block" style="--i: 6">
                        <h3>Обязанности</h3>
                        <p>{!! $vacancy->responsibilities !!}</p>
                    </div>
                @endif

                @if ($vacancy->requirements)
                    <div class="vacancy-content-block" style="--i: 7">
                        <h3>Требования</h3>
                        <p>{!! $vacancy->requirements !!}</p>
                    </div>
                @endif

                @if ($vacancy->conditions)
                    <div class="vacancy-content-block" style="--i: 8">
                        <h3>Условия</h3>
                        <p>{!! $vacancy->conditions !!}</p>
                    </div>
                @endif

                @if ($vacancy->skills)
                    <div class="vacancy-content-block" style="--i: 9">
                        <h3>Навыки</h3>
                        <div class="tags">
                            @foreach (explode(',', $vacancy->skills) as $skill)
                                <div class="tag">{{ $skill }}</div>
                            @endforeach
                        </div>
                    </div>
                @endif

            </div>
        </div>
    </div>
@endsection
