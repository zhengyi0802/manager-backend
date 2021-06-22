@extends('adminlte::page')

@section('title', __('elearningcatagories.title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('elearningcatagories.header') }}</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h1>{{ __('tables.edit') }}</h1>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('elearningcatagories.index') }}">{{ __('tables.back') }}</a>
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

    <form action="{{ route('elearningcatagories.update',$elearningcatagory->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div name="project_group" id="project_group" class="form-group">
                    <strong>{{ __('elearningcatagories.project') }} : </strong>
                    <select id="proj_id" name="proj_id" >
                          <option value="0" {{ ($elearningcatagory->proj_id == 0) ? "selected" : null }}>------</option>
                        @foreach($projects as $project)
                           <option value="{{ $project->id }}" {{ ($elearningcatagory->proj_id == $project->id) ? "selected" : null }}>{{ $project->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div name="project_group" id="project_group" class="form-group">
                    <strong>{{ __('elearningcatagories.parent') }} : </strong>
                    <select id="parent_id" name="parent_id" >
                          <option value="0" {{ ($elearningcatagory->parent_id == 0) ? "selected" : null }}>------</option>
                        @foreach($elearningcatagories as $catagory)
                           <option value="{{ $catagory->id }}" {{ ($elearningcatagory->proj_id == $catagory->id) ? "selected" : null }}>{{ $catagory->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>{{ __('elearningcatagories.type') }} : </strong>
                    <select id="type" name="type" >
                          <option value="catagory" {{ ($elearningcatagory->type == "catagory") ? "selected" : null }}>{{ __($elearningcatagories.type_catagory) }}</option>
                          <option value="contents" {{ ($elearningcatagory->type == "contents") ? "selected" : null }}>{{ __($elearningcatagories.type_contents) }}</option>
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>{{ __('elearningcatagories.name') }} :</strong>
                    <input type="text" name="name" value="{{ $elearningcatagory->name }}" class="form-control">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>{{ __('elearningcatagories.descriptions') }} :</strong>
                    <textarea class="form-control" style="height:150px" name="description"></textarea>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <div id="div-url-name"><strong>{{ __('elearningcatagories.thumbnail') }} : </strong></div>
                    <div id="div-image">
                        <input type="file" id="image" name="image" accept="image/*" onchange="loadImage(event)" >
                    </div>
                    <div id="div-preview">
                        <img name="preview" id="preview" src="{{ $elearningcatagory->preview }}">
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
                    <strong>{{ __('elearningcatagories.status') }} :</strong>
                    <input type="radio" name="status" value="1" {{ ($elearningcatagory->status==1) ? "checked":null }} >{{ __('tables.status_on') }}
                    <input type="radio" name="status" value="0" {{ ($elearningcatagory->status!=1) ? "checked":null }} >{{ __('tables.status_off') }}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                  <button type="submit" class="btn btn-primary">{{ __('tables.submit') }}</button>
            </div>
        </div>
    </form>
@endsection
