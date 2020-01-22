@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <h1>{{ $questionnaire->title }}</h1>

            <form action="/surveys/{{$questionnaire->id}} - {{Str::slug($questionnaire->title)}}" method="post">
                @csrf

                @foreach ($questionnaire->questions as $key => $question)

                <div class="card mt-4">
                    <div class="card-header"><strong>{{$key + 1}}</strong> {{ $question->question }}</div>

                    <div class="card-body">


                        @error('responses.' . $key . '.answer_id')
                        <!-- for example responses.0.someAnswer -->
                        <small class="text-danger">{{ $message }}</small>
                        @enderror


                        <ul class="list-group">
                            @foreach ($question->answers as $answer)
                            <label for="answer{{$answer->id}}">
                                <li class="list-group-item">
                                    <input type="radio" class="mr-2" name="responses[{{ $key }}][answer_id]"
                                        {{ (old('responses.' . $key . '.answer_id') == $answer->id) ? 'checked' : '' }}
                                        id="answer{{ $answer->id }}" value="{{$answer->id}}">
                                    {{$answer->answer}}
                                    <input type="hidden" name="responses[{{ $key }}][question_id]"
                                        value="{{$question->id}}">
                                </li>
                            </label>
                            @endforeach
                        </ul>
                    </div>
                </div>
                @endforeach


                <div class="card mt-4">
                    <div class="card-header">Your information</div>

                    <div class="card-body">

                        @csrf
                        <div class="form-group">
                            <label for="name">Your name</label>
                            <input name="survey[name]" type="text" class="form-control" id="name"
                                aria-describedby="nameHelp" placeholder="Enter name">
                            <small id="nameHelp" class="form-text text-muted">What's your name?</small>

                            @error('survey.name')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="email">email</label>
                            <input name="survey[email]" type="email" class="form-control" id="email"
                                aria-describedby="emailHelp" placeholder="Enter email">
                            <small id="emailHelp" class="form-text text-muted">What's your email?</small>

                            @error('survey.email')
                            <small class="text-danger">Your email is incorrect</small>
                            @enderror
                        </div>
                        <button class="btn btn-dark mt-2" type="submit">Complete Survey</button>
                    </div>
            </form>
        </div>
    </div>
</div>
@endsection