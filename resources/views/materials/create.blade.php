@extends('adminlte::page')

@section('title', __('materials.title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('materials.header') }}</h1>
@stop

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h1>{{ __('tables.new') }}</h1>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('materials.index') }}">{{ __('tables.back') }}</a>
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

<form action="{{ route('materials.store') }}" method="POST" enctype="multipart/form-data" >
    @csrf
     <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ __('materials.name') }} :</strong>
                <input type="text" name="name" class="form-control" placeholder="Name">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ __('materials.project_name') }} :</strong>
                <select class="" id="proj_id" name="proj_id" >
                         <option value="0" selected>-----------</option>
                    @foreach($projects as $project)
                         <option value={{ $project->id }}>{{ $project->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ __('materials.position') }} :</strong>
                <select class="" name="position">
                     <option value="1">公司Logo</option>
                     <option value="2">公司公告</option>
                     <option value="4">廠商橫幅</option>
                     <option value="5">影片</option>
                     <option value="6">廠商公告</option>
                     <option value="7">廠商廣告</option>
                     <option value="8">App 1</option>
                     <option value="9">App 2</option>
                     <option value="10">App 3</option>
                     <option value="11">App 4</option>
                     <option value="12">App 5</option>
                     <option value="13">App 6</option>
                     <option value="14">App 7</option>
                     <option value="15">App 8</option>
                     <option value="16">App 9</option>
                     <option value="18">廠商跑馬燈</option>
                </select>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ __('materials.previous_name') }} :</strong>
                <select class="" name="prev_id" >
                         <option value="0">{{ __('materials.start') }}</option>
                    @foreach($materials as $material)
                         <option value={{ $material->id }}>{{ $material->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ __('materials.mime_type') }} :</strong>
                <select name="mime_type" id="mime_type" onchange="changeInput(this)">
                  <option value="image" selected >{{ __('materials.image') }}</option>
                  <option value="video" >{{ __('materials.video') }}</option>
                </select>
                <script>
                  var changeInput = function(select) {
                      if (select.value == 'image') {
                          document.getElementById('div-url').style.display='none';
                          document.getElementById('div-image').style.display='';
                          document.getElementById('div-preview').style.display='';
                          document.getElementById('div-title').innerHTML
                            = "<strong>{{ __('materials.image_url') }} </strong>";
                      } else {
                          document.getElementById('div-url').style.display='';
                          document.getElementById('div-image').style.display='none';
                          document.getElementById('div-preview').style.display='none';
                          document.getElementById('div-title').innerHTML
                            = "<strong>{{ __('materials.video_url') }} </strong>";
                      }
                  };
                </script>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <div id="div-title">
                    <strong>圖片:</strong>
                </div>
                <div id="div-url" style="display:none">
                    <input type="url" id="video_url" name="video_url" class="form-control">
                </div>
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
                <strong>{{ __('materials.content') }} :</strong>
                <input type="text" name="content" class="form-control" >
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ __('materials.url_link') }} :</strong>
                <input type="text" name="url_link" class="form-control" >
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ __('projects.status') }} :</strong>
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
