@extends('adminlte::page')

@section('title', __('logos.title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('logos.header') }}</h1>
@stop

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h1>{{ __('tables.new') }}</h1>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('frontend_views.edit', $project->id) }}">{{ __('tables.back') }}</a>
        </div>
    </div>
</div>

@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('logos.store2', [ 'logo' => $logo, 'project' => $project]) }}" method="POST" enctype="multipart/form-data" >
     @csrf
     <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group" id="proj_id" name="proj_id" value="$project->id" >
                <strong>{{ __('logos.project') }} : {{ $project->name }}</strong>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ __('logos.name') }} :</strong>
                <input type="text" name="name" class="form-control" >
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <div id="div-url-name"><strong>{{ __('logos.image') }} : </strong></div>
                <div id="div-image">
                    <input type="file" id="image" name="image" accept="image/*" onchange="loadImage(event)" >
                </div>
                <div id="div-preview">
                    <img name="preview" id="preview" >
                </div>
            </div>
            <script>
                    var loadImage = function(event) {
                        var output = document.getElementById('preview');
                        output.src = URL.createObjectURL(event.target.files[0]);
                        output.onload = function() {
                           URL.revokeObjectURL(output.src) // free memory
                        }
                    };
            </script>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ __('logos.link_url') }} :</strong>
                <input type="text" name="link_url" class="form-control">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ __('logos.status') }} :</strong>
                <input type="radio" name="status" value="1" checked>{{ __('tables.status_on') }}
                <input type="radio" name="status" value="0">{{ __('tables.status_off') }}
            </div>
         </div>
         <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">{{ __('tables.submit') }}</button>
         </div>
     </div>
</form>
@endsection
