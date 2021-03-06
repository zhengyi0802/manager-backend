@extends('adminlte::page')

@section('title', __('appmenus.title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('appmenus.header') }}</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h1>{{ __('tables.edit') }}</h1>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('appmenus.index') }}">{{ __('tables.back') }}</a>
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

    <form action="{{ route('appmenus.update',$appmenu->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div name="project_group" id="project_group" class="form-group">
                    <strong>{{ __('appmenus.project') }} : </strong>
                    <select id="proj_id" name="proj_id" >
                          <option value="0" {{ ($appmenu->proj_id == 0) ? "selected" : null }}>------</option>
                        @foreach($projects as $project)
                           <option value="{{ $project->id }}" {{ ($appmenu->proj_id == $project->id) ? "selected" : null }}>{{ $project->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>{{ __('appmenus.position') }} : </strong>
                    <select id="position" name="position" >
                          <option value="1" {{ ($appmenu->position == 1) ? "selected" : null }}>1</option>
                          <option value="2" {{ ($appmenu->position == 2) ? "selected" : null }}>2</option>
                          <option value="3" {{ ($appmenu->position == 3) ? "selected" : null }}>3</option>
                          <option value="4" {{ ($appmenu->position == 4) ? "selected" : null }}>4</option>
                          <option value="5" {{ ($appmenu->position == 5) ? "selected" : null }}>5</option>
                          <option value="6" {{ ($appmenu->position == 6) ? "selected" : null }}>6</option>
                          <option value="7" {{ ($appmenu->position == 7) ? "selected" : null }}>7</option>
                          <option value="8" {{ ($appmenu->position == 8) ? "selected" : null }}>8</option>
                          <option value="9" {{ ($appmenu->position == 9) ? "selected" : null }}>9</option>
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>{{ __('appmenus.name') }} :</strong>
                    <input type="text" name="name" value="{{ $appmenu->name }}" class="form-control">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <div id="div-url-name"><strong>{{ __('appmenus.thumbnail') }} : </strong></div>
                    <div id="div-image">
                        <input type="file" id="image" name="image" accept="image/*" onchange="loadImage(event)" >
                    </div>
                    <div id="div-preview">
                        <img name="preview" id="preview" src="{{ $appmenu->thumbnail }}">
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
                    <strong>{{ __('appmenus.url') }} :</strong>
                    <input type="text" name="url" value="{{ $appmenu->url }}" class="form-control">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>{{ __('appmenus.status') }} :</strong>
                    <input type="radio" name="status" value="1" {{ ($appmenu->status==1) ? "checked":null }} >{{ __('tables.status_on') }}
                    <input type="radio" name="status" value="0" {{ ($appmenu->status!=1) ? "checked":null }} >{{ __('tables.status_off') }}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                  <button type="submit" class="btn btn-primary">{{ __('tables.submit') }}</button>
            </div>
        </div>
    </form>
@endsection
