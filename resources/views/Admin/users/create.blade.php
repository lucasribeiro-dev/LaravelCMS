@extends('adminlte::page')

@section('title', 'Add New User')

@section('content_header')
    <h1>Add New User</h1>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
         <!-- Alert -->
              @if($errors->any())
                <div class="alert alert-danger alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h5><i class="icon fas fa-ban"></i> Alert!</h5>
                    @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                    @endforeach
                </div>
                @endif
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Form Register</h3>
              </div>
              <!-- /.card-header -->
             
                <!-- form start -->
              <form action="{{route('users.store')}}"method="POST">
                    @csrf
                    <div class="card-body">
                    <div class="form-group">
                        <label> User Name</label>
                        <input name="name"type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Enter User">
                    </div>
                    <div class="form-group">
                        <label> Email address</label>
                        <input name="email"type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Enter email">
                    </div>
                    <div class="form-group">
                        <label >Password</label>
                        <input name="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password">
                    </div>
                    <div class="form-group">
                        <label >Confirm Password</label>
                        <input name="password_confirmation" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password">
                    </div>
                    </div>    
                    <!-- /.card-body -->
                    <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
              </form>
            </div>
            <!-- /.card -->
          </div>
    </div>
@endsection