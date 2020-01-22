@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">My questionnaires</div>

                <div class="card-body">
                    <ul class="list-group">
                        @foreach ($questionnaires as $questionnaire)
                        <li class="list-group-item">
                            <!-- replace rest later -->
                            <a href={{$questionnaire->path()}}>{{$questionnaire->title}}</a>

                            <div>
                                <small class="font-weight-bolder">Share url</small>
                                <p><a href="{{$questionnaire->publicPath()}}">{{$questionnaire->publicPath()}}</a></p>
                            </div>

                        </li>
                        @endforeach
                    </ul>
                </div>
                <div class="card-footer">
                    <a  class="btn-sm btn-dark" href="/questionnaires/create">Create new questionnaire</a>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection