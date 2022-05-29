@extends('master')
@section('title')
category
@endsection
@section('content')
            <!-- Post content-->
                <article>
                        <table class="table">
                            <thead class="thead-dark">
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i=0 ?>
                            @foreach($categorys as $category)
                                <?php $i++ ?>
                                <tr>
                                    <td>{{$i}}</td>
                                    <td>
                                        <a
                                            href="{{ url('categoryPosts') }}/{{$category->id}}">{{$category->name}}
                                        </a>
                                    </td>
                                    <td>{{$category->description}}</td>
                                </tr> 
                            @endforeach                       
                            </tbody>
                        </table>
                    <hr>
                    <div class="card bg-light" style=" margin-top:130px!important;">
                        <div class="card-body">
                            <h4 class="text-center">Add New Category</h4>
                            <form action="/category/store" method="POST" enctype="multipart/form-data">
                                {{csrf_field()}}
                                <div class="form-group">
                                    <label for="name">name</label>
                                    <input type="text" class="form-control" id="name" name="name">
                                </div>
                                    <br>
                                    <div class="form-group">
                                        <label for="description">description</label>
                                        <textarea type="text" class="form-control" id="description" name="description"></textarea>
                                    </div>   
                                    <button type="submit" class="btn btn-primary">Add category</button>
                                </form>
                            <br>
                                <div>
                                    @foreach($errors->all() as $error)
                                    {{$error}}<br>
                                    @endforeach
                                </div>
                            </div>
                        </div>  
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