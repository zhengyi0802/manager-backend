@extends('adminlte::page')

@section('title', __('projectsettings.title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('projectsettings.header') }}</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h1>{{ __('tables.edit') }}</h1>
            </div>
            @include('layouts.back')
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
    <style>
       .error {
          color       : red;
          margin-left : 5px;
          font-size   : 14px;
       }
       label.error {
          display     : inline;
       }
       span.must {
          color     : red;
          font-size : 12px;
       }
    </style>
    <form id="projectsetting-form" action="{{ route('projectsettings.update',$manager->id) }}" method="POST" enctype="multipart/form-data">
        @method('POST')
        @csrf
        <div class="row">
           <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group col-md-4">
                    <strong>{{ __('projectsettings.company') }} :</strong>
                    <input id="company" name="company" value="{{ $manager->company }}" disabled>
                </div>
           </div>
        </div>
        <div class="row">
           <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group col-md-4">
                    <strong>{{ __('projectsettings.name') }} :</strong>
                    <input id="name" name="name" value="{{ $manager->user->name }}" disabled>
                </div>
           </div>
        </div>
        <div class="row">
           <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group col-md-4">
                    <strong>{{ __('projectsettings.project') }} :</strong>
                    <select id="proj_id" name="proj_id" >
                        <option value="0" style="background-color: blue">{{ __('projectsettings.project_none') }}</option>
                        @foreach($projects as $project)
                           <option value="{{ $project->id }}">{{ $project->name }}</option>
                        @endforeach
                    </select>
                </div>
           </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
              <button type="submit" class="btn btn-primary">{{ __('tables.submit') }}</button>
            </div>
        </div>
    </form>
@stop
