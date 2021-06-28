@extends('adminlte::page')

@section('title', __('bulletinitems.title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('bulletinitems.header') }}</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h1>{{ __('tables.edit') }}</h1>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('bulletinitems.index') }}">{{ __('tables.back') }}</a>
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

    <form action="{{ route('bulletinitems.update',$bulletinitem->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div  class="form-group">
                    <strong>{{ __('bulletinitems.bulletin') }} : </strong>
                    <select id="bulletin_id" name="bulletin_id" >
                        @foreach($bulletins as $bulletin)
                           <option value="{{ $bulletin->id }}" {{ ($bulletinitem->bulletin_id == $bulletin->id) ? "selected" : null }}>{{ $bulletin->title }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>{{ __('bulletinitems.type') }} :</strong>
                    <select id="type" name="type" onchange="changeInput(this)" >
                        <option value="image" {{ ($bulletinitem->type == "image") ? "selected" : null }} >{{ __('bulletinitems.type_image') }}</option>
                        <option value="video" {{ ($bulletinitem->type == "video") ? "selected" : null }} >{{ __('bulletinitems.type_video') }}</option>
                        <option value="youtube" {{ ($bulletinitem->type == "youtube") ? "selected" : null }} >{{ __('bulletinitems.type_youtube') }}</option>
                    </select>
                </div>
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
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <div id="div-url-name"><strong>{{ __('bulletinitems.url') }} : </strong></div>
                    <div id="div-url" style="display:none">
                        <input type="url" id="url" name="url" class="form-control" >
                    </div>
                    <div id="div-image">
                        <input type="file" id="image" name="image" accept="image/*" onchange="loadImage(event)" >
                    </div>
                    <div id="div-preview">
                        <img name="preview" id="preview" src="{{ $bulletinitem->url }}">
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
                    <strong>{{ __('bulletinitems.status') }} :</strong>
                    <input type="radio" name="status" value="1" {{ ($bulletinitem->status==1) ? "checked":null }} >{{ __('tables.status_on') }}
                    <input type="radio" name="status" value="0" {{ ($bulletinitem->status!=1) ? "checked":null }} >{{ __('tables.status_off') }}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                  <button type="submit" class="btn btn-primary">{{ __('tables.submit') }}</button>
            </div>
        </div>
    </form>
@endsection
