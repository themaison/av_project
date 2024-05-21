@extends('layouts.layout')

@section('title', 'профиль')

@section('content')
    <link href="{{asset('css/profile.css?v=').time()}}" rel="stylesheet">

    <script src="{{ asset('js/axios.min.js') }}"></script>
    <script>
        // $(window).on('load', function() {
        //     $(document).ready(function() {
        //         $('.add-btn, .edit-btn').on('click', async function() {
        //             var field = $(this).data('field');
        //             var text = $('#' + field + '-text');
        //             var input = $('#' + field + '-input');
        //             var doubleBtn = $('.double-btn[data-field="' + field + '"]');

        //             // Скрываем кнопку "добавить"/"изменить" и отображаем кнопки "сохранить" и "отмена"
        //             $(this).hide();
        //             doubleBtn.show();

        //             // Если кнопка "добавить" была нажата, то отображаем текстовое поле для ввода
        //             // и скрываем поле с данными
        //             if ($(this).hasClass('add-btn')) {
        //                 input.show();
        //                 text.hide();
        //             }
        //             // Если кнопка "изменить" была нажата, то отображаем текстовое поле для ввода
        //             // с текущими данными и скрываем поле с данными
        //             else {
        //                 input.val(text.text()).show();
        //                 text.hide();
        //             }
        //         });

        //         $('.cancel-btn').on('click', function() {
        //             var field = $(this).parent().data('field');
        //             var text = $('#' + field + '-text');
        //             var input = $('#' + field + '-input');
        //             var addBtn = $('.add-btn[data-field="' + field + '"]');
        //             var editBtn = $('.edit-btn[data-field="' + field + '"]');
        //             var doubleBtn = $('.double-btn[data-field="' + field + '"]');

        //             // Скрываем кнопки "сохранить" и "отмена" и отображаем кнопку "добавить"/"изменить"
        //             doubleBtn.hide();
        //             if (text.text().trim() === '') {
        //             addBtn.show();
        //             } else {
        //             editBtn.show();
        //             }

        //             // Скрываем текстовое поле для ввода и отображаем поле с данными
        //             input.hide();
        //             text.show();
        //         });

        //         $('.save-btn').on('click', async function() {
        //             var field = $(this).parent().data('field');
        //             var text = $('#' + field + '-text');
        //             var input = $('#' + field + '-input');
        //             var addBtn = $('.add-btn[data-field="' + field + '"]');
        //             var editBtn = $('.edit-btn[data-field="' + field + '"]');
        //             var doubleBtn = $('.double-btn[data-field="' + field + '"]');

        //             // Сохраняем введённые данные в поле с данными
        //             text.text(input.val());

        //             // Отправляем асинхронный запрос на сервер для сохранения данных в базе данных
        //             await axios.post('/profile/profile->id/update-profile', {
        //             field: field,
        //             value: input.val()
        //             });

        //             // Скрываем кнопки "сохранить" и "отмена" и отображаем кнопку "добавить"/"изменить"
        //             doubleBtn.hide();
        //             if (text.text().trim() === '') {
        //             addBtn.show();
        //             } else {
        //             editBtn.show();
        //             }

        //             // Скрываем текстовое поле для ввода и отображаем поле с данными
        //             input.hide();
        //             text.show();
        //         });
        //     });
        // });

        $(window).on('load', function() {
            $(document).ready(function() {
                $('.add-btn, .edit-btn').click(function() {
                    var field = $(this).data('field');

                    $('#' + field + '-text').hide();
                    $('#' + field + '-input').val($('#' + field + '-text').text()).fadeIn();
                    
                    $(this).hide();
                    $('.double-btn[data-field="' + field + '"]').fadeIn();
                });

                $('.cancel-btn').click(function() {
                    var field = $(this).parent().data('field');

                    $('#' + field + '-text').fadeIn();
                    $('#' + field + '-input').hide();

                    $('.double-btn[data-field="' + field + '"]').hide();
                    if ($('#' + field + '-text').text().trim() === '') {
                        $('.add-btn[data-field="' + field + '"]').fadeIn();
                    } else {
                        $('.edit-btn[data-field="' + field + '"]').fadeIn();
                    }
                });

                $('.save-btn').click(function() {      
                    var field = $(this).parent().data('field');
                    var newValue = $('#' + field + '-input').val().trim();
                    var currentValue = $('#' + field + '-text').text().trim();

                    // Если новое значение совпадает с текущим, скрываем поле ввода и показываем текстовый блок
                    if (newValue === currentValue) {
                        $('#' + field + '-input').hide();
                        $('#' + field + '-text').fadeIn();
                        $('.double-btn[data-field="' + field + '"]').hide();
                        if (newValue === '') {
                            $('.add-btn[data-field="' + field + '"]').fadeIn();
                        } else {
                            $('.edit-btn[data-field="' + field + '"]').fadeIn();
                        }
                        return;
                    }

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
                            $('#' + field + '-text').text(newValue).fadeIn();
                            $('.double-btn[data-field="' + field + '"]').hide();

                            $('.add-btn[data-field="' + field + '"]').fadeIn();
                            if (newValue !== '') {
                                $('.edit-btn[data-field="' + field + '"]').fadeIn();
                            // } else {
                            }
                        }
                    });
                });

                $('textarea').on('input', function () {
                    this.style.height = 'auto';
                    this.style.height = (this.scrollHeight) + 'px';
                });
            });
        });
    </script>

    <div class="content">

        <div class="profile-main">
            <img src="{{  asset('images/pa2.png') }}" alt="аватар" class="profile-avatar" style="--i: 0">
            <h2 style="--i: 1">{{ $user->name }}</h2>
        </div>

        <div class="profile-data">
            @foreach(array_keys(['contacts' => 'Контакты', 'description' => 'Навыки', 'resume' => 'Резюме']) as $index => $key)
            @php
                $field = ['contacts' => 'Контакты', 'description' => 'Навыки', 'resume' => 'Резюме'][$key];
            @endphp
            <div class="p-block" style="--i: {{ $index + 2 }}">
                <div class="p-block-title">
                    <h3>{{ $field }}</h3>

                    @if ($user->id === auth()->user()->id)
                        @if(!empty($user->profile->$key))
                        <button class="outline-btn edit-btn" data-field="{{ $key }}">
                            <img src="{{  asset('icons/black/brush.svg') }}" alt="icon">
                            изменить
                        </button>
                        @else
                        <button class="fill-btn add-btn" data-field="{{ $key }}">
                            <img src="{{  asset('icons/light/brush.svg') }}" alt="icon">
                            добавить
                        </button>
                        @endif

                        <div class="double-btn" data-field="{{ $key }}" style="display: none;">
                            <button class="fill-btn save-btn">
                                сохранить
                            </button>
                            <button class="outline-btn cancel-btn">
                                отмена
                            </button>
                        </div>
                    @endif
        
                </div>
        
                <div class="p-block-data">
                    <p id="{{ $key }}-text">{{ $user->profile->$key }}</p>
                    <textarea 
                    id="{{ $key }}-input" 
                    style="display: none;" 
                    placeholder="Введите текст..."></textarea>
                </div>
        
            </div>
            @endforeach
        </div>
    </div>
@endsection