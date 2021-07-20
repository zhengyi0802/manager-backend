@extends('adminlte::page')

@section('title', __('voicesettings.title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('voicesettings.header') }}</h1>
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
            <a class="btn btn-primary" href="{{ route('voicesettings.index') }}">{{ __('tables.back') }}</a>
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

<form name="vform" action="{{ route('voicesettings.store') }}" method="POST" enctype="multipart/form-data" >
    @csrf
     <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ __('voicesettings.project') }} : </strong>
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
                <strong>{{ __('voicesettings.keywords') }} :</strong>
                <input type="text" name="keywords" class="form-control" placeholder="Keywords">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ __('voicesettings.package_from') }} :</strong>
                <input type="radio" name="from" value="1" checked>{{ __('voicesettings.internal_package') }}
                <input type="radio" name="from" value="0">{{ __('voicesettings.external_package') }}
            </div>
        </div>
        <script>
            var rad=document.vform.from;
            for (var i=0; i<rad.length; i++) {
                 rad[i].addEventListener('change', function() {
                     //alert('check box = ' + this.value);
                     if (this.value == 1) {
                         document.getElementById('div-upload').style.display='';
                         document.getElementById('div-label').style.display='none';
                         document.getElementById('div-package').style.display='none';
                         document.getElementById('div-link').style.display='none';
                     } else {
                         document.getElementById('div-upload').style.display='none';
                         document.getElementById('div-label').style.display='';
                         document.getElementById('div-package').style.display='';
                         document.getElementById('div-link').style.display='';
                     }
                 });
            }
        </script>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group" id="div-upload" >
                <strong>{{ __('voicesettings.upload_apk') }} :</strong>
                <input type="file" name="app_file" class="form-control">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group" id="div-label" style="display:none" >
                <strong>{{ __('voicesettings.label') }} :</strong>
                <input type="text" name="label" class="form-control">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group" id="div-package" style="display:none" >
                <strong>{{ __('voicesettings.package') }} :</strong>
                <input type="text" name="package" class="form-control">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group" id="div-link" style="display:none" >
                <strong>{{ __('voicesettings.link_url') }} :</strong>
                <input type="text" name="link_url" class="form-control">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ __('voicesettings.status') }} :</strong>
                <input type="radio" name="status" value="1" checked>{{ __('tables.status_on') }}
                <input type="radio" name="status" value="0">{{ __('tables.status_off') }}
            </div>
         </div>
         <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="progress">
                <div class="bar"></div>
                <div class="percent">0%</div>
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
                                    window.location.href="/voicesettings";
                                }
                          });
                     });
            </script>
@endsection

