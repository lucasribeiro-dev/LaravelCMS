@extends('adminlte::page')

@section('title', 'Users')

@section('content_header')
    <h1>Users</h1>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
                <table class="table table-hover">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">User</th>
                        <th scope="col">Email</th>
                        <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    <a href="{{route('users.create')}}"class="btn btn-success">Add User</a>
                    <br/><br/>
                        @foreach($users as $user)
                        <tr>
                        <th scope="row">{{$user->id}}</th>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td><a href="{{route('users.edit', ['user'=>$user->id])}}" class="btn btn-warning">Edit</a> 
                        @if($loggedId !== intval($user->id))
                        <form class="d-inline"action="{{route('users.destroy', ['user'=>$user->id])}}" method="POST">
                            @method('DELETE')
                            @csrf
                            <button class="btn btn-danger">Delete</button> 
                        </form>
                        @endif
                        </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            {{$users->links()}}

        </div>
    </div>

@endsection