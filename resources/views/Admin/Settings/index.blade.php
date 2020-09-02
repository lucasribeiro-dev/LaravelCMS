@extends('adminlte::page')

@section('title', 'Settings')

@section('content_header')
    <h1>Settings</h1>
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
                 @if(session('warning'))
                <div class="alert alert-success alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  {{session('warning')}}
                </div>
                @endif
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Site Settings</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
         
              <form action="{{route('settings.update')}}"method="POST">
                    @method('PUT')
                    @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label> Title </label>
                        <input name="title"type="text" class="form-control @error('title') is-invalid @enderror" value="{{$settings['title']}}" >
                    </div> 
                    <div class="form-group">
                        <label> Subtitle</label>
                        <input name="subtitle"type="text" class="form-control @error('subtitle') is-invalid @enderror" value="{{$settings['subtitle']}}" >
                    </div>
                     <div class="form-group">
                        <label> Contact Email </label>
                        <input name="email"type="email" class="form-control @error('email') is-invalid @enderror" value="{{$settings['email']}}" >
                    </div>
                     <div class="form-group">
                        <label> Bg Color</label>
                        <input name="bgcolor"type="color" class="form-control @error('bgcolor') is-invalid @enderror" value="{{$settings['bgcolor']}}" >
                    </div>
                     <div class="form-group">
                        <label> Text Color</label>
                        <input name="textcolor"type="color" class="form-control @error('textcolor') is-invalid @enderror" value="{{$settings['textcolor']}}" >
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