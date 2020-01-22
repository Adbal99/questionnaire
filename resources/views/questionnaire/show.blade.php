@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ $questionnaire->title }}</div>


                <div class="card-body align-self-center">
                    <a class="btn btn-dark" href="{{$questionnaire->path()}}/questions/create">Add new question</a>
                    <a class="btn btn-dark ml-2"
                        href="/surveys/{{ $questionnaire->id }}-{{ Str::slug($questionnaire->title) }}">Take Survey</a>

                </div>
            </div>
            @foreach ($questionnaire->questions as $question)
            <div class="card mt-4">
                <div class="card-header">{{ $question->question }}</div>

                <div class="card-body">
                    <ul class="list-group">
                        @foreach ($question->answers as $answer)
                        <li class="list-group-item d-flex justify-content-between">

                            <div>{{$answer->answer}}</div>
                            <div>
                                @if ($question->responses->count())
                                {{ round((($answer->responses->count() / $question->responses->count() )*100), 0) }}%
                                @endif
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>

                <div class="card-footer">
                    <form action="/questionnaires/{{$questionnaire->id}}/questions/{{$question->id}}" method="post">
                        @method('DELETE')
                        @csrf

                        <button type="submit" class="btn-sm btn-outline-danger">
                            Delete Question
                        </button>

                    </form>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

@endsection