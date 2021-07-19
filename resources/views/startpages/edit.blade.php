@extends('adminlte::page')

@section('title', __('startpages.title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('startpages.header') }}</h1>
@stop

@section('content')
    <style>
      img { width: 60%; height: 60%; }
      .progress { position:relative; width:100%; border: 1px solid #7F98B2; padding: 1px; border-radius: 3px; }
      .bar { background-color: #B4F5B4; width:0%; height:25px; border-radius: 3px; }
      .percent { position:absolute; display:inline-block; top:3px; left:48%; color: #7F98B2;}
    </style>

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h1>{{ __('tables.edit') }}</h1>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('startpages.index') }}">{{ __('tables.back') }}</a>
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
    <div class="row">
       <div class="col-xs-12 col-sm-12 col-md-12">
           <strong>{{ __('startpages.project_name') }} : {{ $project->name ?? '--------' }}</strong>
       </div>
    </div>

    <form action="{{ route('startpages.update', $startpage->id) }}" method="POST" enctype="multipart/form-data" >
         @csrf
         @method('PUT')
         <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>{{ __('startpages.name') }} :</strong>
                    <input type="text" name="name" value="{{ $startpage->name }}" class="form-control">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>{{ __('startpages.mime_type') }} : </strong>
                    <select name="mime_type" id="mime_type" onchange="changeInput(this)">
                      <option value="image" {{ ($startpage->mime_type == "image") ? "selected" : null }} >{{ __('startpages.image') }}</option>
                      <option value="i_video" {{ ($startpage->mime_type == "i_video") ? "selected" :null }} >{{ __('startpages.upload_video') }}</option>
                      <option value="e_video" {{ ($startpage->mimd_type == "e_video") ? "selected" : null }} >{{ __('startpages.external_video') }}</option>
                      <option value="youtube" {{ ($startpage->mime_type == "youtube") ? "selected" : null }} >{{ __('startpages.youtube_id') }}</option>
                    </select>
                    <script>
                      var changeInput = function(select) {
                          if (select.value == 'image')  {
                              document.getElementById('div-url').style.display='none';
                              document.getElementById('div-image').style.display='';
                              document.getElementById('div-preview').style.display='';
                          } else if (select.value == 'i_video') {
                              document.getElementById('div-url').style.display='none';
                              document.getElementById('div-image').style.display='';
                              document.getElementById('div-preview').style.display='none';
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
                    <strong>{{ __('startpages.url') }} : </strong>
                    <div id="div-url" style="display:none">
                        <input type="url" id="url" name="url" class="form-control" value="{{ $startpage->url }}">
                    </div>
                    <div id="div-image">
                        <input type="file" id="file" name="file" onchange="loadImage(event)" >
                    </div>
                    <div id="div-preview">
                        @if ( $startpage->mime_type == 'image' )
                              <img src="{{ $startpage->url }}" name="preview" id="preview" >
                        @elseif ($startpage->mime_type == 'i_video' || $startpage->mime_type == 'e_video')
                              <iframe src="{{ $startpage->url }}" name="preview" id="preview"></iframe>
                        @endif
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
                <div class="progress">
                    <div class="bar"></div>
                    <div class="percent">0%</div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>{{ __('startpages.description') }} : </strong>
                    <textarea class="form-control" style="height:150px" name="descriptions" placeholder="描述">{{ $startpage->descriptions }}</textarea>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>{{ __('startpages.status') }} : </strong>
                    <input type="radio" name="status" value="1" {{ ($startpage->status==1) ? "checked":null }} >{{ __('tables.status_on') }}
                    <input type="radio" name="status" value="0" {{ ($startpage->status!=1) ? "checked":null }} >{{ __('tables.status_off') }}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>{{ __('startpages.start_time') }} : </strong>
                    <input type="datetime_local" name="start_time" value="{{ $startpage->start_time }}" class="form-control" placeholder="YYYY-MM-DD hh:mm:ss">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>{{ __('startpages.stop_time') }} : </strong>
                    <input type="datetime_local" name="stop_time" value="{{ $startpage->stop_time }}" class="form-control" placeholder="YYYY-MM-DD hh:mm:ss">
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
              <button type="submit" class="btn btn-primary">{{ __('tables.submit') }}</button>
            </div>
        </div>
    </form>
@endsection

@section('adminlte_js')
           <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js"></script> 
           <script type="text/javascript">
                     $(document).ready(function() {
                          var bar = $('.bar');
                          var percent = $('.percent');
                          $('form').ajaxForm({
                                beforeSend: function() {
                                    var percentVal = '0%';
                                    bar.width(percentVal)
                                    percent.html(percentVal);
                                },
                                uploadProgress: function(event, position, total, percentComplete) {
                                    var percentVal = percentComplete + '%';
                                    bar.width(percentVal)
                                    percent.html(percentVal);
                                },
                                complete: function(xhr) {
                                    //alert('File Has Been Uploaded Successfully');
                                    console.log("uploaded");
                                    window.location.href="/startpages";
                                }
                          });
                     });
            </script>
@endsection
