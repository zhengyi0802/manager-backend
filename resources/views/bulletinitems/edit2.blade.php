@extends('adminlte::page')

@section('title', __('bulletinitems.title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('bulletinitems.header') }}</h1>
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
                <a class="btn btn-primary" href="{{ route('bulletinitems.index2', $bulletin->id) }}">{{ __('tables.back') }}</a>
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

    <form action="{{ route('bulletinitems.update2', ['bulletin' => $bulletin, 'bulletinitem' => $bulletinitem]) }}" method="POST" enctype="multipart/form-data">
        <div class="form-group"><input type="number" id="bulletin_id" name="bulletin_id" value="{{ $bulletin->id }}" hidden></div>
        @csrf
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div  class="form-group">
                    <strong>{{ __('bulletins.ftitle') }} : {{ $bulletin->title }}</strong>
                </div>
                <div  class="form-group">
                    <strong>{{ __('bulletins.message') }} : </strong> {{ $bulletin->message }}
                </div>
                <div  class="form-group">
                    <strong>{{ __('bulletins.date') }} : {{ $bulletin->date }}</strong>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>{{ __('bulletinitems.type') }} :</strong>
                    <select id="mime_type" name="mime_type" onchange="changeInput(this)" >
                        <option value="image" {{ ($bulletinitem->mime_type == "image") ? "selected" : null }} >{{ __('bulletinitems.type_image') }}</option>
                        <option value="i_video" {{ ($bulletinitem->mime_type == "i_video") ? "selected" : null }} >{{ __('bulletinitems.type_ivideo') }}</option>
                        <option value="e_video" {{ ($bulletinitem->mime_type == "e_video") ? "selected" : null }} >{{ __('bulletinitems.type_evideo') }}</option>
                        <option value="youtube" {{ ($bulletinitem->mime_type == "youtube") ? "selected" : null }} >{{ __('bulletinitems.type_youtube') }}</option>
                    </select>
                </div>
                <script>
                  var changeInput = function(select) {
                      if (select.value == 'image') {
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
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <div id="div-url-name"><strong>{{ __('bulletinitems.url') }} : </strong></div>
                    <div id="div-url" style="display:none">
                        <input type="text" id="url" name="url" class="form-control" value="{{ $bulletinitem->url }}">
                    </div>
                    <div id="div-image">
                        <input type="file" id="file" name="file" onchange="loadImage(event)" >
                    </div>
                    <div id="div-preview">
                        @if ($bulletinitem->mime_type == 'image' )
                            <img name="preview" id="preview" src="{{ $bulletinitem->url }}">
                        @elseif (($bulletinitem->mime_type == 'i_video') || ($bulletitem->mime_type == 'e_video'))
                            <iframe name="preview" id="preview" src="{{ $bulletinitem->url }}"></iframe>
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
                                    var bid=document.getElementById('bulletin_id').value;
                                    window.location.href="/bulletinitems/" + bid + "/index2";
                                }
                          });
                     });
            </script>
@endsection
