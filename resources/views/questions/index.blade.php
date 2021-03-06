@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col">
            <div class="card">
                <div class="card-header header-question">
                    <div class="d-flex align-items-center ">
                        <h3>All Questions </h3>
                        <div class="ml-auto">
                            <a href="{{route('questions.create')}}" class="btn btn-outline-success">Ask Question</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @include('layouts._alert')
                    @foreach ($questions as $question)
                   
                    <div class="media">
                        <div class="d-flex flex-column counters" >       
                        </div>
                        <div class="media-body">
                            <div class="d-flex align-items-center ">
                                 <h3 class="mt-0">
                                     <a {{-- href="{{ route('questions.show',$question->id)}}" --}} href="{{$question->url}}">{{$question->title }}</a>
                                </h3>
                                <div class="ml-auto">
                                    <div class="d-flex justify-content-center rounded">
                                        @can('update', $question) 
                                        <div class="edit mr-2">
                                            <a href="{{route('questions.edit',[$question->id])}}" class="btn btn-outline-success">Edit </a>
                                        </div>
                                        @endcan
                                        @can('delete', $question)                                         
                                        <div class="delete">
                                            <form action="{{route('questions.destroy',[$question->id])}}" method="post" class="form-delete">
                                                @method('delete')
                                                @csrf
                                                <button type="submit" class="btn btn-outline-danger" onclick="return confirm('Are you sure ?')">Delete </button>
                                            </form> 
                                        </div>
                                        @endcan
                                    </div>
                                </div>
                            </div>
                           <p class="lead">
                            Asked by
                           <a href="{{$question->user->url}}">{{ $question->user->name }}</a>
                           <small class="text-muted ml-2">{{$question->created_date}}</small>
                        </p>
                            <p> {{Str::limit($question->body,200)}}</p>
                        </div>
                        
                    </div>
                    <div class="flex-container d-flex justify-content-center rounded">
                       
                            <div class="vote">
                            <strong>{{$question->votes_count}}</strong>
                            {{Str::plural('vote',$question->votes_count)}}
                            </div>
                   
                            <div class="answer {{$question->status}}{{--  unanswered answered   answered-accepted  --}}">
                                <strong>{{$question->answers_count}}</strong>
                                {{Str::plural('answer',$question->answers_count)}}
                            </div>
                       
                            <div class="view">
                            <strong>{{$question->views}}</strong>
                                {{Str::plural('view',$question->views)}} 
                            </div>    
                       
                    </div>
                    <hr>
                     @endforeach
               {{ $questions->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
