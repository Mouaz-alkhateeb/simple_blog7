@extends('master')
@section('title')
CategoryPost
@endsection
@section('content')
            <!-- Post content-->
                <article>
                    <!-- Post header-->
                    @foreach($posts as $post)
                            <header class="mb-4">
                            <!-- Post title-->
                                <h1 class="fw-bolder mb-1">
                                    <a href="/posts/{{$post->id}}">{{$post->title}}</a>
                                </h1>
                                <div class="text-muted fst-italic mb-2">Posted on {{$post->created_at}}<strong>/category:</strong>{{$post->category->name}}</div>
                                <p class="fs-5 mb-4">{{$post->body}}</p>  
                            </header>
                            <!-- Preview image figure-->  
                            @if($post->path)
                                <p>                             
                                    <img src="/img/{{ $post->path }}">
                                </p>  
                            @endif
                            <!-- Post content-->                                 
                    @endforeach                  
                </article>
                <br>
                   
                           
@stop
@section('sidebar')
                <div class="card mb-4">
                    <div class="card-header">Categories</div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-6">
                                @foreach ($categorys as $category)
                                    <ul class="list-unstyled mb-0">
                                        <li>{{$category->name}}</li>
                                    </ul>
                                @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

@endsection
