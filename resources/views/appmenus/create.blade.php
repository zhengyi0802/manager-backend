@extends('adminlte::page')

@section('title', __('appmenus.title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('appmenus.header') }}</h1>
@stop

@section('content')

    <style>
      .progress { position:relative; width:100%; border: 1px solid #7F98B2; padding: 1px; border-radius: 3px; }
      .bar { background-color: #B4F5B4; width:0%; height:25px; border-radius: 3px; }
      .percent { position:absolute; display:inline-block; top:3px; left:48%; color: #7F98B2;}
    </style>

<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h1>{{ __('tables.new') }}</h1>
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

<form name="vform" action="{{ route('appmenus.store') }}" method="POST" enctype="multipart/form-data" >
     @csrf
     <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ __('appmenus.project') }} : </strong>
                <select id="proj_id" name="proj_id" >
                    <option value="0">------</option>
                    @foreach($projects as $project)
                       <option value="{{ $project->id }}">{{ $project->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ __('appmenus.position') }} : </strong>
                <select id="position" name="position" >
                       <option value="1" selected >1</option>
                       <option value="2" >2</option>
                       <option value="3" >3</option>
                       <option value="4" >4</option>
                       <option value="5" >5</option>
                       <option value="6" >6</option>
                       <option value="7" >7</option>
                       <option value="8" >8</option>
                       <option value="9" >9</option>
                </select>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ __('appmenus.package_from') }} :</strong>
                <input type="radio" name="from" value="1" checked>{{ __('appmenus.internal_package') }}
                <input type="radio" name="from" value="0">{{ __('appmenus.external_package') }}
            </div>
        </div>
        <script>
            var rad=document.vform.from;
            for (var i=0; i<rad.length; i++) {
                 rad[i].addEventListener('change', function() {
                     //alert('check box = ' + this.value);
                     if (this.value == 1) {
                         document.getElementById('div-upload').style.display='';
                         document.getElementById('div-progress').style.display='';
                         document.getElementById('div-external1').style.display='none';
                         document.getElementById('div-external2').style.display='none';
                         document.getElementById('div-external3').style.display='none';
                     } else {
                         document.getElementById('div-upload').style.display='none';
                         document.getElementById('div-progress').style.display='none';
                         document.getElementById('div-external1').style.display='';
                         document.getElementById('div-external2').style.display='';
                         document.getElementById('div-external3').style.display='';
                     }
                 });
            }
        </script>
        <div class="col-xs-12 col-sm-12 col-md-12" id="div-upload">
            <div class="form-group">
                <strong>{{ __('appmenus.upload_apk') }} :</strong>
                <input type="file" name="app_file" class="form-control">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12" id="div-progress">
            <div class="progress">
                <div class="bar"></div>
                <div class="percent">0%</div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12" id="div-external1" style="display:none">
            <div class="form-group">
                <strong>{{ __('appmenus.name') }} :</strong>
                <input type="text" name="name" class="form-control" placeholder="Name">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12" id="div-external2" style="display:none">
            <div class="form-group">
                <div id="div-url-name"><strong>{{ __('appmenus.thumbnail') }} : </strong></div>
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
        <div class="col-xs-12 col-sm-12 col-md-12" id="div-external3" style="display:none">
            <div class="form-group">
                <strong>{{ __('appmenus.url') }} :</strong>
                <input type="text" name="url" class="form-control" >
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ __('appmenus.status') }} :</strong>
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

@section('adminlte_js')
           <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js"></script> 
           <script type="text/javascript">
                     $(document).ready(function() {
                          var bar = $('.bar');
                          var percent = $('.percent');
                          $('vform').ajaxForm({
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
                                    window.location.href="/appmenus";
                                }
                          });
                     });
            </script>
@endsection
