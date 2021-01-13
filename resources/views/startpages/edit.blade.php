@extends('adminlte::page')

@section('title', '朕臨首頁設計')

@section('content_header')
    <h1 class="m-0 text-dark">首頁管理系統</h1>
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
    <div class="row">
       <div class="col-xs-12 col-sm-12 col-md-12">
           <strong>專案名稱 : {{ $project->name }}</strong>
       </div>
    </div>

    <form action="{{ route('startpages.newstore', $project->id) }}" method="POST" enctype="multipart/form-data" >
         @csrf
         <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>起始頁面名稱:</strong>
                    <input type="text" name="name" value="{{ $startpage->name }}" class="form-control" placeholder="起始頁面名稱">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>類型:</strong>
                    <select name="mime_type" id="mime_type" onchange="changeInput(this)">
                      <option value="image" selected >圖片</option>
                      <option value="video" >影片</option>
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
                    <strong>圖片/影片:</strong>
                    <div id="div-url" style="display:none">
                        <input type="url" id="url" name="url" class="form-control">
                    </div>
                    <div id="div-image">
                        <input type="file" id="image" name="image" accept="image/*" onchange="loadImage(event)" >
                    </div>
                    <div id="div-preview">
                        <img src="{{ $startpage->url }}" name="preview" id="preview" >
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
                    <strong>描述:</strong>
                    <textarea class="form-control" style="height:150px" name="detail" placeholder="描述">{{ $startpage->detail }}</textarea>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>狀態:  </strong>
                    <input type="radio" name="status" value="1" {{ ($startpage->status==1) ? "checked":null }} >啟用
                    <input type="radio" name="status" value="0" {{ ($startpage->status!=1) ? "checked":null }} >不啟用
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>起始時間:</strong>
                    <input type="datetime_local" name="start_datetime" value="{{ $startpage->start_datetime }}" class="form-control" placeholder="YYYY-MM-DD hh:mm:ss">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>終止時間:</strong>
                    <input type="datetime_local" name="stop_datetime" value="{{ $startpage->stop_datetime }}" class="form-control" placeholder="YYYY-MM-DD hh:mm:ss">
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
              <button type="submit" class="btn btn-primary">提交</button>
            </div>
        </div>
    </form>
@endsection
