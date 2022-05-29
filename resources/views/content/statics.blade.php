@extends('master')
@section('title')
statics
@endsection
@section('content')
  <div class="col-md-8">
      <h1 class="page-header">Statics<small>\Admin statics</small></h1>
  </div>  
  <div>
      <table class="table table-hover">
          <tr>
              <td>All Users</td>
              <td>{{$statics['users']}}</td>
          </tr>
          <tr>
              <td>All Posts</td>
              <td>{{$statics['posts']}}</td>
          </tr>
          <tr>
              <td>All Comments</td>
              <td>{{$statics['comments']}}</td>
          </tr>
          <tr>
              <td>Most Active Users</td>
              <td><b>{{$statics['active_user']}} </b>, Like({{$statics['active_user_like']}}) , Comment({{$statics['active_user_comment']}})</td>
          </tr>
          <tr>
              <td>Most Active Posts</td>
              <td><b>{{$statics['active_post']}} </b>, Like({{$statics['active_post_like']}}) , Comment({{$statics['active_post_comment']}})</td>
          </tr>
      </table>
  </div>           
@stop
