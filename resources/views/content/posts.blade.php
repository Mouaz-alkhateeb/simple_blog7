@extends('master')
@section('title')
posts
@endsection
@section('content')
            <!-- Post content-->
            <h1>Welcome To Our Blog</h1>
                <article>
                    <!-- Post header-->
                    @foreach($posts as $post)
                            <header class="mb-4">
                            <!-- Post title-->
                                <h1 class="fw-bolder mb-1">
                                    <a href="/posts/{{$post->id}}">{{$post->title}}</a>
                                </h1>
                                <div class="text-muted fst-italic mb-2">Posted on {{$post->created_at}}<strong>/category:</strong>
                                <a
                                    href="{{ url('categoryPosts') }}/{{$post->category->id}}"> {{$post->category->name}}
                                </a>
                            </div>
                                <p class="fs-5 mb-4">{{$post->body}}</p>  
                            </header>
                            <!-- Preview image figure-->  
                            @if($post->path)
                                <p>                             
                                    <img src="/img/{{ $post->path }}">
                                </p>  
                            @endif
                            <a href="/posts/{{$post->id}}" type="submit" class="btn btn-primary"> read more...</a>
                    @php
                        $like_count = 0;
                        $dislike_count = 0;
                        $like_status = "btn-secondary";
                        $dislike_status = "btn-secondary";
                    @endphp
                    @foreach($post->likes as $like)  
                        @php
                            if($like->like == 1)
                                $like_count++; 
                            if($like->like == 0)
                                $dislike_count++;
                    if(Auth::check())
                    {
                        if($like->like == 1 && $like->user_id == Auth::user()->id)
                            $like_status = "btn-success";
                        if($like->like == 0 && $like->user_id == Auth::user()->id)
                            $dislike_status = "btn-danger";
                    }
                        @endphp
                    @endforeach
                            <button  type="button" data-post_id="{{$post->id}}_l" data-like="{{ $like_status}}" class="like btn {{ $like_status}}"><b><span class="like_count">{{ $like_count}}</span></b> Like &nbsp;<i class="fas fa-thumbs-up"></i></button>
                            <button  type="button" data-post_id="{{$post->id}}_d" data-like="{{$dislike_status}}" class="dislike btn {{$dislike_status}}"><b><span  class="dislike_count">{{ $dislike_count}}</span></b> DisLike  &nbsp;<i class="fas fa-thumbs-down"></i></button>
                   
                            <hr>
                            <!-- Post content-->                            
                    @endforeach
                    @if(Auth::check())
                        @if(Auth::user()->hasRole('Admin') || Auth::user()->hasRole('Editor'))
                            <div class="card bg-light">
                                <div class="card-body">
                                <h4 class="text-center">Add New Post</h4>
                                    <form action="/posts/store" method="POST" enctype="multipart/form-data">
                                        {{csrf_field()}}
                                        <div class="form-group">
                                            <label for="title">title</label>
                                            <input type="title" class="form-control" id="title" name="title">
                                        </div>
                                            <label class="my-1 mr-2" for="inlineFormCustomSelectPref">category</label>
                                            <select name="category_id" id="category_id" class="form-control" required>
                                                <option value="" selected disabled> --Choose category --</option>
                                                @foreach ($categorys as $category)
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                            <br>
                                            <div class="form-group">
                                                <label for="body">body</label>
                                                <textarea type="body" class="form-control" id="body" name="body"></textarea>
                                            </div>  
                                            <div class="form-group">
                                            
                                                <input type="file"  id="path" name="path">
                                            </div>           
                                            <button type="submit" class="btn btn-primary">Add post</button>
                                    </form>
                                    <br>
                                        <div>
                                            @foreach($errors->all() as $error)
                                            {{$error}}<br>
                                            @endforeach
                                        </div>
                                    </div>
                            </div> 
                        @endif
                    @endif
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