@extends('adminlte::page')

@section('title', 'Add New Page')

@section('content_header')
    <h1>Add New Page</h1>
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
                <h3 class="card-title">Form for creat new page</h3>
              </div>
              <!-- /.card-header -->
             
                <!-- form start -->
              <form action="{{route('pages.store')}}"method="POST">
                    @csrf
                    <div class="card-body">
                    <div class="form-group">
                        <label> Title</label>
                        <input name="title"type="text" class="form-control @error('title') is-invalid @enderror" placeholder="Enter Title">
                    </div>
                    <div class="form-group">
                        <label >Body</label>
                        <textarea name="body" type="text" class="form-control bodyfield @error('password') is-invalid @enderror" placeholder="Body"></textarea>
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
  

<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script>
tinymce.init({
  selector:'textarea.bodyfield',
  heigh:300,
  menubar:false,
  plugins:['link', 'table', 'image', 'autoresize','lists'],
  toolbar:'undo redo | formatselect | bold italic backcolor | alignleft alignright aligncenter alignjustify | table | link image | bullist numlist',
  images_upload_url:'{{route('imageupload')}}',
  images_upload_credentials:true,
  convert_urls:false



})
</script>
@endsection