@extends('layouts.layout')

@section('title', 'список вакансий')

@section('content')
    <link href="{{ asset('css/av-cover.css?v=') . time() }}" rel="stylesheet">
    <link href="{{ asset('css/av-form.css?v=') . time() }}" rel="stylesheet">
    <link href="{{ asset('css/vacancy_list.css?v=') . time() }}" rel="stylesheet">
    <link href="{{ asset('css/av-pagination.css?v=') . time() }}" rel="stylesheet">

    <script>
        $(document).ready(function() {
            $('.response-btn').click(function() {
                var vacancyId = $(this).data('vacancy-id');
                var vacancyTitle = $(this).data('vacancyTitle');
                var clickedButton = $(this); // Сохраняем ссылку на нажатую кнопку

                $('.av-form').attr('action', '/vacancy/' + vacancyId + '/create_response');

                $('.av-form').fadeIn().css('display', 'flex');
                $('.blur-bg').fadeIn();

                $('.av-form').on('submit', function(e) {
                    e.preventDefault();
                    $.ajax({
                        url: $(this).attr('action'),
                        method: 'POST',
                        data: $(this).serialize(),
                        success: function(response) {
                            if (response.success) {
                                $('.av-form').hide();
                                $('.blur-bg').fadeOut();
                                clickedButton.replaceWith(
                                    '<div class="hint-btn">уже откликнулись</div>'
                                ); // Заменяем только нажатую кнопку
                            } else {
                                // Обработка ошибок
                            }
                        }
                    });
                });
            });

            $('.favorite-btn').click(function(event) {
                event.preventDefault();

                var vacancyId = $(this).data('vacancy-id');
                var toggleFavoriteBtn = $(this);
                var favoriteIcon = toggleFavoriteBtn.find('#favorite-icon');

                $.ajax({
                    url: '/vacancy/' + vacancyId + '/toggle_favorite',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(data) {
                        if (data.favorite) {
                            toggleFavoriteBtn.removeClass('outline-btn').addClass('fill-btn');
                            favoriteIcon.attr('src', '{{ asset('icons/light/bookmark.svg') }}');
                            // toggleFavoriteBtn.html('<img id="favorite-icon" src="{{ asset('icons/gray/gem.svg') }}" alt="icon"> в избранном');
                        } else {
                            toggleFavoriteBtn.removeClass('fill-btn').addClass('outline-btn');
                            favoriteIcon.attr('src', '{{ asset('icons/black/bookmark.svg') }}');
                            // toggleFavoriteBtn.html('<img id="favorite-icon" src="{{ asset('icons/black/gem.svg') }}" alt="icon">');
                        }
                    }
                });
            });

            $('.cancel-btn, .x-btn').click(function() {
                $('.av-form').hide();
                $('.blur-bg').fadeOut();
                $('.av-form textarea[name="cover_letter"]').val('');
            });
        });
    </script>

    <div class="content">
        <div class="search-box">
            @php
                function getWordForm($number, $words)
                {
                    $cases = [2, 0, 1, 1, 1, 2];
                    $index = $number % 100 > 4 && $number % 100 < 20 ? 2 : $cases[min($number % 10, 5)];
                    return $words[$index];
                }
            @endphp

            @if (isset($vacancies) && $vacancies->count() > 0)
                <h2 style="--i: 0">«{{ $query }}»</h2>
                <p style="--i: 1">{{ getWordForm($vacancies->total(), ['найдена', 'найдены', 'найдено']) }}
                    <span>{{ $vacancies->total() }}
                        {{ getWordForm($vacancies->total(), ['вакансия', 'вакансии', 'вакансий']) }}</span>
                </p>
            @else
                <h2 style="--i: 0">Пусто</h2>
                <p class="hint-text" style="--i: 1">по запросу ничего не найдено</span></p>
            @endif

            <form action="/vacancy_list" method="GET" style="--i: 3">
                <div class="input-group">
                    <input type="text" name="query" class="search" placeholder="Какая вакансия вас интересует?">
                    <button class="fill-btn" type="submit">найти</button>
                </div>
            </form>
        </div>

        <div class="blur-bg"></div>

        <form class="av-form" method="POST" action="/vacancy/vacancy->id/create_response" enctype="multipart/form-data"
            style="display: none">
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
                <button type="sybmit" class="fill-btn">откликнуться</button>
            </div>

        </form>

        @if (isset($vacancies))
            <div class="vacancies" id="vacancies">
                <div class="v-grid">

                    @php

                        function getWord($number, $variants)
                        {
                            $cases = [2, 0, 1, 1, 1, 2];
                            $index = $number % 100 > 4 && $number % 100 < 20 ? 2 : $cases[min($number % 10, 5)];
                            return $variants[$index];
                        }

                        function getDayWord($days)
                        {
                            $lastDigit = $days % 10;
                            if ($days >= 11 && $days <= 14) {
                                return 'дней';
                            } elseif ($lastDigit == 1) {
                                return 'день';
                            } elseif ($lastDigit >= 2 && $lastDigit <= 4) {
                                return 'дня';
                            } else {
                                return 'дней';
                            }
                        }

                        function getWeekWord($weeks)
                        {
                            $lastDigit = $weeks % 10;
                            if ($weeks >= 11 && $weeks <= 14) {
                                return 'недель';
                            } elseif ($lastDigit == 1) {
                                return 'неделю';
                            } elseif ($lastDigit >= 2 && $lastDigit <= 4) {
                                return 'недели';
                            } else {
                                return 'недель';
                            }
                        }

                        function getMonthWord($months)
                        {
                            $lastDigit = $months % 10;
                            if ($months >= 11 && $months <= 14) {
                                return 'месяцев';
                            } elseif ($lastDigit == 1) {
                                return 'месяц';
                            } elseif ($lastDigit >= 2 && $lastDigit <= 4) {
                                return 'месяца';
                            } else {
                                return 'месяцев';
                            }
                        }
                    @endphp

                    @forelse($vacancies as $index => $vacancy)
                        @php
                            $now = \Carbon\Carbon::now();
                            $created = \Carbon\Carbon::parse($vacancy->created_at);
                            $diffInSeconds = $created->diffInSeconds($now);
                            $diffInMinutes = $created->diffInMinutes($now);
                            $diffInHours = $created->diffInHours($now);
                            $diffInDays = $created->diffInDays($now);
                            $diffInWeeks = $created->diffInWeeks($now);
                            $diffInMonths = $created->diffInMonths($now);
                        @endphp

                        <div class="v-card" style="--i: {{ $index + 2 }}">
                            <a href="/vacancy_detail/{{ $vacancy->id }}" class="l1-data">

                                @if ($vacancy->cover)
                                    <div class="cover">
                                        <img src="{{ Storage::url($vacancy->cover) }}" alt="cover">
                                    </div>
                                @else
                                    <div class="cover"></div>
                                @endif

                                <div class="text-content">
                                    <h3>{{ $vacancy->title }}</h3>
                                
                                    @if($vacancy->salary_from && $vacancy->salary_to)
                                        <p>{{ number_format($vacancy->salary_from, 0, ',', ' ') }} — {{ number_format($vacancy->salary_to, 0, ',', ' ') }}₽</p>
                                    @elseif($vacancy->salary_from)
                                        <p>от {{ number_format($vacancy->salary_from, 0, ',', ' ') }}₽</p>
                                    @elseif($vacancy->salary_to)
                                        <p>до {{ number_format($vacancy->salary_to, 0, ',', ' ') }}₽</p>
                                    @else
                                        <p>Не указана</p>
                                    @endif
                                </div>

                            </a>

                            <div class="l2-data">
                                <div class="icon-block">
                                    <img src="{{ asset('icons/blue/castle.svg') }}" alt="icon">
                                    <p>{{ $vacancy->company }}</p>
                                </div>
                                <div class="icon-block">
                                    <img src="{{ asset('icons/blue/map-pin.svg') }}" alt="icon">
                                    <p>{{ $vacancy->city }}</p>
                                </div>
                                <div class="icon-block">
                                    <img src="{{ asset('icons/blue/toolbox.svg') }}" alt="icon">
                                    @if ($vacancy->experience <= 0)
                                        Без опыта
                                    @else
                                        Опыт от {{ $vacancy->experience }}
                                        {{ getWord($vacancy->experience, ['года', 'года', 'лет']) }}
                                    @endif
                                </div>
                            </div>

                            <div class="l3-data">
                                @auth

                                    @if (auth()->user()->hasRole('applicant'))
                                        <div class="actions">
                                            @if (auth()->user()->responses()->where('vacancy_id', $vacancy->id)->exists())
                                                <div class="hint-btn">уже откликнулись</div>
                                            @else
                                                <div class="fill-btn response-btn" data-vacancy-id="{{ $vacancy->id }}">
                                                    откликнуться</div>
                                            @endif

                                            @php
                                                $isFavorite = Auth::user()
                                                    ->favorites()
                                                    ->where('vacancy_id', $vacancy->id)
                                                    ->exists();
                                            @endphp

                                            <div class="favorite-btn {{ $isFavorite ? 'fill-btn square-btn' : 'outline-btn square-btn' }}"
                                                data-vacancy-id="{{ $vacancy->id }}">
                                                <img id="favorite-icon"
                                                    src="{{ $isFavorite ? asset('icons/light/bookmark.svg') : asset('icons/black/bookmark.svg') }}"
                                                    alt="icon">
                                                {{-- @if ($isFavorite)
                                    в избранном
                                @endif --}}
                                            </div>

                                        </div>
                                        {{-- @else
                        <div class="actions">
                            <div class="hint-btn">откликнуться</div>
                            <div class="hint-btn square-btn"><img src="{{ asset('icons/gray/gem.svg') }}" alt="icon"></div>
                        </div> --}}
                                    @endif

                                @endauth

                                @guest
                                    <div class="actions">
                                        <div class="hint-btn">откликнуться</div>
                                        <div class="hint-btn square-btn"><img src="{{ asset('icons/gray/bookmark.svg') }}"
                                                alt="icon"></div>
                                    </div>
                                @endguest

                                @if ($diffInSeconds < 60)
                                    <p>{{ $diffInSeconds }}
                                        {{ getWord($diffInSeconds, ['секунда', 'секунды', 'секунд']) }} назад</p>
                                @elseif ($diffInMinutes < 60)
                                    <p>{{ $diffInMinutes }} {{ getWord($diffInMinutes, ['минута', 'минуты', 'минут']) }}
                                        назад</p>
                                @elseif ($diffInHours < 24)
                                    <p>{{ $diffInHours }} {{ getWord($diffInHours, ['час', 'часа', 'часов']) }} назад</p>
                                @elseif ($diffInDays < 7)
                                    <p>{{ $diffInDays }} {{ getWord($diffInDays, ['день', 'дня', 'дней']) }} назад</p>
                                @elseif ($diffInDays >= 7 && $diffInMonths < 1)
                                    <p>{{ $diffInWeeks }} {{ getWord($diffInWeeks, ['неделя', 'недели', 'недель']) }}
                                        назад</p>
                                @else
                                    <p>{{ $diffInMonths }} {{ getWord($diffInMonths, ['месяц', 'месяца', 'месяцев']) }}
                                        назад</p>
                                @endif

                                {{-- <p>{{ $vacancy->created_at->format('d.m.Y') }}</p> --}}
                            </div>
                        </div>
                    @empty
                        {{-- <p>Ничего не найдено</p> --}}
                    @endforelse
                </div>
            </div>

            <div class="pagination" style="--i: 3">
                {{-- {{ $vacancies->links('vendor.pagination.custom_pagination') }} --}}
                {{ $vacancies->appends(['query' => $query])->links('vendor.pagination.custom_pagination') }}
            </div>
        @endif
    </div>

@endsection
