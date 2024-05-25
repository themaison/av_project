@extends('layouts.layout')

@section('title', 'профиль')

@section('content')
    <link href="{{ asset('css/profile.css?v=') . time() }}" rel="stylesheet">

    <script>
        $(document).ready(function() {
            $('.add-btn, .edit-btn').click(function() {
                var field = $(this).data('field');

                $('#' + field + '-text').hide();
                // $('#' + field + '-input').val($('#' + field + '-text').text()).fadeIn();
                $('#' + field + '-input').val($('#' + field + '-text').html().replace(/<br>/g, '\n')).fadeIn();

                $(this).hide();
                $('.double-btn[data-field="' + field + '"]').fadeIn();
            });

            $('.cancel-btn').click(function() {
                var field = $(this).parent().data('field');

                $('#' + field + '-text').fadeIn();
                $('#' + field + '-input').hide();

                $('.double-btn[data-field="' + field + '"]').hide();
                // if ($('#' + field + '-text').text().trim() === '') {
                //     $('.add-btn[data-field="' + field + '"]').fadeIn();
                // } else {
                //     $('.edit-btn[data-field="' + field + '"]').fadeIn();
                // }
                $('.edit-btn[data-field="' + field + '"]').fadeIn();
            });

            $('.save-btn').click(function() {
                var field = $(this).parent().data('field');
                var newValue = $('#' + field + '-input').val().trim();

                // Обновляем текстовый блок сразу после нажатия кнопки "сохранить"
                // $('#' + field + '-text').text(newValue);

                // Обновляем текстовый блок сразу после нажатия кнопки "сохранить"
                $('#' + field + '-text').html(newValue.replace(/\n/g, '<br>'));

                $.ajax({
                    url: '/profile/' + {{ $user->id }} + '/update-profile',
                    method: 'POST',
                    data: {
                        field: field,
                        value: newValue,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function() {
                        $('#' + field + '-input').hide();
                        $('#' + field + '-text').fadeIn();
                        $('.double-btn[data-field="' + field + '"]').hide();
                        // console.log(newValue);
                        // console.log(newValue==='');

                        // if (newValue === '') {
                        //     $('.add-btn[data-field="' + field + '"]').fadeIn();
                        // } else {
                        //     $('.edit-btn[data-field="' + field + '"]').fadeIn();
                        // }
                        $('.edit-btn[data-field="' + field + '"]').fadeIn();
                    }
                });
            });

            $('textarea').on('input', function() {
                this.style.height = 'auto';
                this.style.height = (this.scrollHeight) + 'px';
            });
        });
    </script>

    <div class="content">

        <div class="profile-main">
            <img src="{{ asset('images/pa2.png') }}" alt="аватар" class="profile-avatar" style="--i: 0">
            <h2 style="--i: 1">{{ $user->name }}</h2>
        </div>

        <div class="profile-data">
            @foreach (array_keys(['contacts' => 'Контакты', 'description' => 'Навыки', 'resume' => 'Резюме']) as $index => $key)
                @php
                    $field = ['contacts' => 'Контакты', 'description' => 'Навыки', 'resume' => 'Резюме'][$key];
                @endphp
                <div class="p-block" style="--i: {{ $index + 2 }}">
                    <div class="p-block-title">
                        <h3>{{ $field }}</h3>

                        @auth
                            @if ($user->id === auth()->user()->id)
                                {{-- @if (!empty($user->profile->$key))
                                <button class="outline-btn edit-btn" data-field="{{ $key }}">
                                    <img src="{{ asset('icons/black/brush.svg') }}" alt="icon">
                                    изменить
                                </button>
                            @else
                                <button class="fill-btn add-btn" data-field="{{ $key }}">
                                    <img src="{{ asset('icons/light/brush.svg') }}" alt="icon">
                                    добавить
                                </button>
                            @endif --}}

                                <button class="outline-btn edit-btn" data-field="{{ $key }}">
                                    <img src="{{ asset('icons/black/brush.svg') }}" alt="icon">
                                    изменить
                                </button>

                                <div class="double-btn" data-field="{{ $key }}" style="display: none;">
                                    <button class="fill-btn save-btn">
                                        сохранить
                                    </button>
                                    <button class="outline-btn cancel-btn">
                                        отмена
                                    </button>
                                </div>
                            @endif
                        @endauth

                    </div>

                    <div class="p-block-data">
                        <p id="{{ $key }}-text">{!! $user->profile->$key !!}</p>
                        <textarea id="{{ $key }}-input" style="display: none;" placeholder="Введите текст..."></textarea>
                    </div>

                </div>
            @endforeach
        </div>
    </div>
@endsection
