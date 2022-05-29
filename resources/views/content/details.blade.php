@extends('master')
@section('title')
SubPost
@endsection
@section('content')
 <!-- Post content-->
                <article>
                    <!-- Post header-->
                    <header class="mb-4">
                                <!-- Post title-->
                                    <h1 class="fw-bolder mb-1">
                                        {{$post->title}}
                                    </h1>
                                    <div class="text-muted fst-italic mb-2">Posted on {{$post->created_at}}<strong>/category:</strong>{{$post->category->name}}</div>
                                    <p class="fs-5 mb-4">{{$post->body}}</p>  
                                    <!-- Post meta content-->
                                    
                                        <!-- Post categories-->
                                </header>
                                <!-- Preview image figure-->
                                    <p><img src="/img/{{ $post->path }}"></p>   
                                <!-- Post content--> 
                </article>
                <!-- Comments section-->
                <section class="mb-5">
                        <div class="card bg-light">
                            <div class="card-body">
                                <div class="d-flex mb-4">
                                        <!-- Parent comment-->
                                        <div class="ms-3">
                                        @foreach($comments as $comment)
                                            <div class="d-flex mt-4">
                                                <div class="flex-shrink-0"><img class="rounded-circle" src="https://dummyimage.com/50x50/ced4da/6c757d.jpg" alt="..." /></div>
                                                <div class="ms-3">                                             
                                                    <div class="fw-bold">Commenter Name</div>
                                                         <div >{{$comment->body}}</div> 
                                                </div>                                         
                                            </div>
                                        @endforeach
                                        </div>
                                    </div>
                                    @if($stop_comment ==1)
                                    <h3>Comment Are Closed currently..!!</h3>
                                    @else
                                        <form action="/posts/{{$post->id}}/store" method="POST" enctype="multipart/form-data">
                                                {{csrf_field()}}   
                                                <h4 >Add Your Comment :</h4>
                                                <div class="form-group">
                                                    <textarea type="body" placeholder="write some thing..." class="form-control" id="body" name="body"></textarea>
                                                    <input type="hidden" name="post_id" id="post_id" value="{{$post->id}}">
                                                </div>                     
                                                <button type="submit" class="btn btn-primary">Add comment</button>
                                        </form>  
                                    @endif
                            </div>
                        </div>
                </section>                  
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