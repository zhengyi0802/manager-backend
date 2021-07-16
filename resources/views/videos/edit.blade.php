@extends('adminlte::page')

@section('title', __('videos.title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('videos.header') }}</h1>
@stop

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h1>{{ __('tables.new') }}</h1>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('videos.index') }}">{{ __('tables.back') }}</a>
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

<form action="{{ route('videos.store') }}" method="POST">
     @csrf
     <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ __('videos.catagory') }} :</strong>
                <select name="catagory_id">
                    <option value="0" }}>{{ __('videocatagories.root') }}</option>
                    @foreach($catagories as $catagory)
                      <option value="{{ $catagory->id }}" {{ ($catagory->id == $video->catagory_id) ? "selected" : null }}>{{ $catagory->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ __('videos.video_title') }} :</strong>
                <input type="text" name="title" class="form-control" value="{{ $video->title }}" >
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ __('videos.description') }} :</strong>
                <textarea class="form-control" style="height:150px" name="description" >{{ $video->description }}</textarea>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ __('videos.status') }} :</strong>
                <input type="radio" name="status" value="1" {{ ($video->status) ? "checked" : null }}>{{ __('tables.status_on') }}
                <input type="radio" name="status" value="0" {{ (!$video->status) ? "checked" : null }}>{{ __('tables.status_off') }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">{{ __('tables.submit') }}</button>
        </div>
    </div>
</form>
@endsection
