@extends('site.layout')

@section('title', 'Test')

@section('content')
<!-- bradcam_area  -->
    <div class="bradcam_area bradcam_bg_1">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="bradcam_text">
                        <h3>{{$page['title']}}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /bradcam_area  -->

<div class="container">
    {!! $page['body'] !!} 
</div>
@endsection