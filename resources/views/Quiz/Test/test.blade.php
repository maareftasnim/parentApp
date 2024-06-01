{{--@extends('layouts.admin')--}}

{{--@section('content')--}}
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ trans('panel.site_title') }}</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet" />
    <link href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/buttons/1.2.4/css/buttons.dataTables.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/select/1.3.0/css/select.dataTables.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css" rel="stylesheet" />
    <link href="https://unpkg.com/@coreui/coreui@2.1.16/dist/css/coreui.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css" rel="stylesheet" />
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet" />
</head>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Test</div>

                    <div class="card-body">
                        @if(session('status'))
                            <div class="row">
                                <div class="col-12">
                                    <div class="alert alert-success" role="alert">
                                        {{ session('status') }}
                                    </div>
                                </div>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('test.store') }}">
                            @csrf
                            <input hidden type="text"  name="user_id" id="user_id" value="{{$etudiant->id}}">

                            @if(isset($_GET["page"]))
                                @php
                                    $currentPage = $_GET["page"];
                                    $categories = $categories->slice(($currentPage - 1) * 1, 1);
                                @endphp
                                @foreach($categories as $category)
                                    <div class="card mb-3">
                                        <span class="badge badge-danger" style="color: white; font-size: 140%;">Question {{ $currentPage }}</span>
                                        <div class="badge badge-dark" id="countdown" style="color: white; font-size: 140%;">Starting the Counter</div><br><br>

                                        <div class="card-header">{{ $category->name }}</div>

                                        <div class="card-body">

                                            @foreach($category->categoryQuestions as $question)
                                                <div class="card @if(!$loop->last)mb-3 @endif">
                                                    <div class="card-header">{{ $question->question_text }}</div>

                                                    <div class="card-body">
                                                        <input type="hidden" name="questions[{{ $question->id }}]" value="">
                                                        @foreach($question->questionOptions as $option)
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio" name="questions[{{ $question->id }}]" id="option-{{ $option->id }}" value="{{ $option->id }}"@if(old("questions.$question->id") == $option->id) checked @endif>
                                                                <label class="form-check-label" for="option-{{ $option->id }}">
                                                                    {{ $option->option_text }}
                                                                </label>
                                                            </div>
                                                        @endforeach

                                                        @if($errors->has("questions.$question->id"))
                                                            <span style="margin-top:.25rem; font-size: 80%; color: #e3342f;" role="alert">
                                                            <strong>{{ $errors->first("questions.$question->id") }}</strong>
                                                        </span>
                                                        @endif
                                                    </div>
                                                </div>

                                            @endforeach

                                            @if($currentPage <= $categories->count() )
                                                <nav role="navigation" aria-label="Pagination Navigation" class="flex justify-between">
                                                    <a id="btn" href="?page={{ $currentPage + 1 }}" rel="next" class="btn btn-primary btn-lg btn-block">
                                                        Next Question &raquo;
                                                    </a>
                                                </nav>

                                            @else
                                                <div class="form-group row mb-0">
                                                    <div class="col-md-6">
                                                        <button type="submit" class="btn btn-primary">
                                                            Submit
                                                        </button>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <span class="badge badge-dark" style="color: white; font-size: 140%;">
                                Welcome to the Quiz System.
                                </span><br><br>
                                <span class="badge badge-success" style="color: white; font-size: 140%;">
                                You will be given {{ $categories->count() }} questions in total.
                                </span><br><br>
                                <span class="badge badge-success" style="color: white; font-size: 140%;">
                                You will have 60 seconds to answer each question.
                                </span><br><br>
                                <span class="badge badge-dark" style="color: white; font-size: 140%;">
                                Good luck.
                                </span><br><br><br>

                                <a href="{{url('quiz/test',$etudiant->id)}}?page=1" class="btn btn-primary btn-lg btn-block">Let's Start</a>
                            @endif

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

{{--@endsection--}}

{{--@section('scripts')--}}
    @if(isset($_GET["page"]) && $_GET["page"] >= 1)
        <script>
            let timeLeft = 5; // Declare timeLeft as a global variable
            const page = {{ $_GET["page"] }};
            const totalPages = {{ $categories->count() }};
            const questions = @json($categories->first()->categoryQuestions);
            const radioButtons = document.querySelectorAll('input[name="questions[{{ $question->id }}]"]');

            let timerInterval;

            function startTimer() {
             let  timerInterval = setInterval(() => {

                    if(sessionStorage.getItem({{$question->id}} + "time") >= 0) {
                        timeLeft--;
                        updateTimer();
                    }else{
                        document.getElementById("countdown").innerHTML = " Your time is up!";
                    }


                }, 1000);

            }

            function updateTimer() {
                const timerElement = document.getElementById('countdown');
                if (timeLeft > 0) {
                    timerElement.innerHTML = timeLeft + ' seconds remaining';
                } else if(sessionStorage.getItem({{$question->id}} + "time") <= 0){
                    timerElement.innerHTML = 'Finished';
                    sessionStorage.setItem('question' + page, 'out');
                    radioButtons.forEach(button => button.disabled = true);
                    sessionStorage.setItem({{$question->id}}, "empty");
                    //document.getElementById("countdown").innerHTML = " Your time is up!";


                }else{
                    document.getElementById("countdown").innerHTML = " Your time is up!";
                }
            }

            function updateUserInput() {
                radioButtons.forEach(button => {
                    if (button.checked) {
                        sessionStorage.setItem('question' + page, button.value);
                    }
                });
            }

            document.addEventListener('DOMContentLoaded', () => {
                if (sessionStorage.getItem('question' + page)!== null) {
                    radioButtons.forEach(button => {
                        if (button.value === sessionStorage.getItem('question' + page)) {
                            button.checked = true;
                        }
                    });
                }
                startTimer();
            });

            const btn = document.querySelector('#btn');
            btn.addEventListener("click", () => {
                updateUserInput();
                clearInterval(timerInterval);

                if (page < totalPages) {
                    window.location.href = '?page=' + (page + 1);
                } else {
                    document.querySelector('form').submit();
                }
            });
        </script>
    @endif
{{--@endsection--}}
