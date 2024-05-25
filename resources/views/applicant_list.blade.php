@extends('layouts.layout')

@section('title', 'список резюме')

@section('content')
    <link href="{{ asset('css/av-cover.css?v=') . time() }}" rel="stylesheet">
    <link href="{{ asset('css/applicant_list.css?v=') . time() }}" rel="stylesheet">
    <link href="{{ asset('css/av-pagination.css?v=') . time() }}" rel="stylesheet">

    <script></script>

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

            @if (isset($users) && $users->count() > 0)
                <h2 style="--i: 0">«{{ $query }}»</h2>
                <p style="--i: 1">{{ getWordForm($users->count(), ['найдено', 'найдены', 'найдены']) }}
                    <span>{{ $users->count() }} резюме</span>
                </p>
            @else
                <h2 style="--i: 0">Пусто</h2>
                <p class="hint-text" style="--i: 1">по запросу ничего не найдено</span></p>
            @endif

            <form action="/applicant_list" method="GET" style="--i: 3">
                <div class="input-group">
                    <input type="text" name="query" class="search" placeholder="Какое резюме вас интересует?">
                    <button class="fill-btn" type="submit">найти</button>
                </div>
            </form>
        </div>

        @if (isset($users))
            <div class="users" id="users">
                <div class="a-grid">
                    @forelse($users as $index => $user)
                        <div class="a-card" style="--i: {{ $index + 2 }}">
                            <a href="/profile/{{ $user->id }}" class="l1-data">

                                @if ($user->profile->avatar)
                                    <div class="cover">
                                        <img src="{{ Storage::url($user->profile->avatar) }}" alt="avatar">
                                    </div>
                                @else
                                    <div class="cover"></div>
                                @endif

                                <div class="profile-head">
                                    <h3>{{ $user->name }}</h3>
                                    @if ($user->profile->contacts)
                                        <div class="icon-block">
                                            <img src="{{ asset('icons/blue/paper-plane.svg') }}" alt="icon">
                                            {{ $user->profile->contacts }}
                                        </div>
                                    @endif
                                </div>

                                {{-- <a class="fill-btn" href="/profile/{{ $user->id }}">
                            в профиль
                        </a> --}}

                            </a>

                            @if ($user->profile->resume || $user->profile->description)
                                <div class="l2-data">

                                    @if ($user->profile->resume)
                                        <div class="text-content">
                                            <h4>Резюме</h4>
                                            <p>{!! $user->profile->resume !!}</p>
                                        </div>
                                    @endif

                                    @if ($user->profile->description)
                                        <div class="text-content">
                                            <h4>Навыки</h4>
                                            <p>{!! $user->profile->description !!}</p>
                                        </div>
                                    @endif

                                </div>
                            @endif

                            {{-- <div class="l3-data">
                        <a class="fill-btn" href="/profile/{{ $user->id }}">
                            в профиль
                        </a>
                    </div> --}}
                        </div>
                    @empty
                        {{-- <p>Ничего не найдено</p> --}}
                    @endforelse
                </div>
            </div>

            <div class="pagination" style="--i: 3">
                {{-- {{ $users->links('vendor.pagination.custom_pagination') }} --}}
                {{ $users->appends(['query' => $query])->links('vendor.pagination.custom_pagination') }}

            </div>
        @endif
    </div>

@endsection
