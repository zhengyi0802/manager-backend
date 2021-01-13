@extends('adminlte::page')

@section('title', __('materials.title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('materials.header') }}</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h1>{{ __('tables.edit') }}</h1>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('materials.index') }}">返回</a>
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

    <form action="{{ route('materials.update',$material->id) }}" method="POST"  enctype="multipart/form-data" >
        @csrf
        @method('PUT')
         <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>{{ __('materials.name') }} :</strong>
                    <input type="text" name="name" value="{{ $material->name }}" class="form-control">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>{{ __('materials.project_name') }} :</strong>
                    <select class="" id="proj_id" name="proj_id" >
                         <option value="0" {{ ($material->proj_id == 0) ? "selected" : null }}>-----------</option>
                      @foreach($projects as $project)
                         <option value={{ $project->id }} {{ ($material->proj_id == $project->id) ? "selected" : null }} >{{ $project->name }}</option>
                      @endforeach
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>{{ __('materials.position') }} :</strong>
                    <select class="" name="position">
                      <option value="1" {{ ($material->position == 1) ? "selected" : null }}>{{ trans_choice('materials.blocks', 1) }}</option>
                      <option value="2" {{ ($material->position == 2) ? "selected" : null }}>{{ trans_choice('materials.blocks', 2) }}</option>
                      <option value="4" {{ ($material->position == 4) ? "selected" : null }}>{{ trans_choice('materials.blocks', 4) }}</option>
                      <option value="5" {{ ($material->position == 5) ? "selected" : null }}>{{ trans_choice('materials.blocks', 5) }}</option>
                      <option value="6" {{ ($material->position == 6) ? "selected" : null }}>{{ trans_choice('materials.blocks', 6) }}</option>
                      <option value="7" {{ ($material->position == 7) ? "selected" : null }}>{{ trans_choice('materials.blocks', 7) }}</option>
                      <option value="8" {{ ($material->position == 8) ? "selected" : null }}>{{ trans_choice('materials.blocks', 8) }}</option>
                      <option value="9" {{ ($material->position == 9) ? "selected" : null }}>{{ trans_choice('materials.blocks', 9) }}</option>
                      <option value="10" {{ ($material->position == 10) ? "selected" : null }}>{{ trans_choice('materials.blocks', 10) }}</option>
                      <option value="11" {{ ($material->position == 11) ? "selected" : null }}>{{ trans_choice('materials.blocks', 11) }}</option>
                      <option value="12" {{ ($material->position == 12) ? "selected" : null }}>{{ trans_choice('materials.blocks', 12) }}</option>
                      <option value="13" {{ ($material->position == 13) ? "selected" : null }}>{{ trans_choice('materials.blocks', 13) }}</option>
                      <option value="14" {{ ($material->position == 14) ? "selected" : null }}>{{ trans_choice('materials.blocks', 14) }}</option>
                      <option value="15" {{ ($material->position == 15) ? "selected" : null }}>{{ trans_choice('materials.blocks', 15) }}</option>
                      <option value="16" {{ ($material->position == 16) ? "selected" : null }}>{{ trans_choice('materials.blocks', 16) }}</option>
                      <option value="18" {{ ($material->position == 18) ? "selected" : null }}>{{ trans_choice('materials.blocks', 18) }}</option>
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>{{ __('materials.previous_name') }} :</strong>
                    <select class="" name="prev_id" >
                             <option value="0" {{ ($material->proj_id == 0) ? "selected" : null }}>{{ __('materials.start') }}</option>
                        @foreach($materials as $mater)
                             <option value={{ $mater->id }} {{ ($material->prev_id == $mater->id) ? "selected" : null  }}>{{ $mater->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                     <strong>{{ __('materials.mime_type') }} :</strong>
                     <select name="mime_type" id="mime_type" onchange="changeInput(this)">
                       <option value="image" {{ ($material->mime_type =='image') ? "selected" : null }} >{{ __('materials.image') }}</option>
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
                        <input type="url" id="video_url" name="video_url" class="form-control" value="{{ $material->video_url }}">
                    </div>
                    <div id="div-image">
                        <input type="file" id="image" name="image" accept="image/*" onchange="loadImage(event)" >
                    </div>
                    <div id="div-preview">
                        <img name="preview" id="preview" src="{{ $material->image_url }}" >
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
                    <input type="text" name="content" value="{{ $material->content }}" class="form-control">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>{{ __('materials.url_link') }} :</strong>
                    <input type="text" name="url_link" value="{{ $material->url_link }}" class="form-control">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>{{ __('materials.status') }} : </strong>
                    <input type="radio" name="status" value="1" {{ ($material->status==1) ? "checked":null }} >{{ __('tables.status_on') }}
                    <input type="radio" name="status" value="0" {{ ($material->status!=1) ? "checked":null }} >{{ __('tables.status_off') }}
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
              <button type="submit" class="btn btn-primary">{{ __('tables.submit') }}</button>
            </div>
        </div>
    </form>
@endsection
