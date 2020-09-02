@extends('adminlte::page')

@section('title', 'Pages')

@section('content_header')
    <h1>My Pages</h1>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
                <table class="table table-hover">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Title</th>
                        <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    <a href="{{route('pages.create')}}"class="btn btn-success">Add Page</a>
                    <br/><br/>
                        @foreach($pages as $page)
                        <tr>
                        <th scope="row">{{$page->id}}</th>
                        <td>{{$page->title}}</td>
                        <td>
                        <a href="{{"/".$page->slug}}" class="btn btn-success">Go to the page</a> 
                        <a href="{{route('pages.edit', ['page'=>$page->id])}}" class="btn btn-warning">Edit</a> 
                        <form class="d-inline"action="{{route('pages.destroy', ['page'=>$page->id])}}" method="POST">
                            @method('DELETE')
                            @csrf
                            <button class="btn btn-danger">Delete</button> 
                        </form>
                        </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            {{$pages->links()}}

        </div>
    </div>

@endsection