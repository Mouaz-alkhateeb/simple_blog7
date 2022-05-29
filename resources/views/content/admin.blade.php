@extends('master')
@section('title')
control panel
@endsection
@section('content')
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Admin</th>                     
                        <th>Editor</th>
                        <th>User</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i=0 ?>
                        @foreach($users as $user)
                        <form method="POST" action="/add_role">
                            <input type="hidden" name="id" value="{{$user->id}}">
                            {{csrf_field()}}
                            <?php $i++ ?>
                                <tr>
                                    <td>{{$i}}</td>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>
                                       <input type="checkbox" name="admin_role" onchange="this.form.submit()" {{$user->hasRole('Admin') ? 'checked' : ""}}>
                                    </td>
                                    <td>
                                        <input type="checkbox" name="editor_role" onchange="this.form.submit()" {{$user->hasRole('Editor') ? 'checked' :''}}>
                                    </td>
                                    <td>
                                        <input type="checkbox" name="user_role" onchange="this.form.submit()" {{$user->hasRole('User') ? 'checked' :''}}>
                                    </td>
                                </tr>                                      
                        </form>
                        @endforeach          
                </tbody>
             </table> 
             <div>
                 <h2>Setting</h2>
                 <form method="POST" action="/setting">
                 {{csrf_field()}}
                 Stop Comment:  <input type="checkbox" name="stop_comment" onchange="this.form.submit()" {{$stop_comment== 1 ? 'checked' :''}}>  
                 </form>
             </div>               
@stop
