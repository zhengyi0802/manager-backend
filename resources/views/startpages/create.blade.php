@extends('adminlte::page')

@section('title', __('startpages.title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('startpages.header') }}</h1>
@stop

@section('content')
    <style>
      img {
        width: 60%;
        height: 60%;
      }
    </style>

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

    <form action="{{ route('startpages.store') }}" method="POST" enctype="multipart/form-data" >
         @csrf
         <div class="row">\
            <div class="col-xs-12 col-sm-12 col-me-12">
                <div class="form-group">
                   <strong>{{ __('startpages.project_name') }} : </strong>
                   <select id="proj_id" name="proj_id" >
                         <option value="0" selected>--------</option>
                      @foreach ($projects as $project)
                         <option value="{{ $project->id }}" >{{ $project->name }}</option> 
                      @endforeach
                   </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>{{ __('startpages.name') }} :</strong>
                    <input type="text" name="name" class="form-control">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>{{ __('startpages.mime_type') }} : </strong>
                    <select name="mime_type" id="mime_type" onchange="changeInput(this)">
                      <option value="image" selected >{{ __('startpages.image') }}</option>
                      <option value="video" >{{ __('startpages.video') }}</option>
                    </select>
                    <script>
                      var changeInput = function(select) {
                          if (select.value == 'image') {
                              document.getElementById('div-url').style.display='none';
                              document.getElementById('div-image').style.display='';
                              document.getElementById('div-preview').style.display='';
                          } else {
                              document.getElementById('div-url').style.display='';
                              document.getElementById('div-image').style.display='none';
                              document.getElementById('div-preview').style.display='none';
                          }
                      };
                    </script>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <div id="div-url-name"><strong>{{ __('startpages.url') }} : </strong></div>
                    <div id="div-url" style="display:none">
                        <input type="url" id="url" name="url" class="form-control">
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
                    <strong>{{ __('startpages.description') }} : </strong>
                    <textarea class="form-control" style="height:150px" name="descriptions" ></textarea>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>{{ __('startpages.status') }} : </strong>
                    <input type="radio" name="status" value="1" checked>{{ __('tables.status_on') }}
                    <input type="radio" name="status" value="0" >{{ __('tables.status_off') }}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>{{ __('startpages.start_time') }} : </strong>
                    <input type="datetime_local" name="start_time" class="form-control" placeholder="YYYY-MM-DD hh:mm:ss">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>{{ __('startpages.stop_time') }} : </strong>
                    <input type="datetime_local" name="stop_time" class="form-control" placeholder="YYYY-MM-DD hh:mm:ss">
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
              <button type="submit" class="btn btn-primary">{{ __('tables.submit') }}</button>
            </div>
        </div>
    </form>
@endsection
