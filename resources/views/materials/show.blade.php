@extends('adminlte::page')

@section('title', __('materials.title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('materials.header') }}</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h1>{{ __('tables.details') }}</h1>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('materials.index') }}">{{ __('tables.back') }}</a>
            </div>
        </div>
    </div>

    <div class="row">
         <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ __('materials.name') }} :</strong>
                {{ $material->name }}
            </div>
         </div>
         <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ __('materials.project_name') }} :</strong>
                {{ $project->name ?? '--------' }}
            </div>
         </div>
         <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ __('materials.position') }} :</strong>
                {{ trans_choice('materials.blocks', $material->position) }}
            </div>
         </div>
         <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ __('materials.previous_name') }} :</strong>
                {{ $prev_name ?? '' }}
            </div>
         </div>
         <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ __('materials.mime_type') }} :</strong>
                {{ $material->mime_type }}
            </div>
         </div>
         <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ __('materials.content') }} :</strong>
                {{ $material->content }}
            </div>
         </div>
         <div class="col-xs-12 col-sm-12 col-md-12" id="video_field" {{ ($material->mime_type == 'image') ? 'hidden': null }} >
            <div class="form-group">
                <strong>{{ __('materials.video_url') }} :</strong>
                {{ $material->video_url }}
            </div>
         </div>
         <div class="col-xs-12 col-sm-12 col-md-12" id="image_field" {{ ($material->mime_type == 'video') ? 'hidden': null }}>
            <div class="form-group">
                <strong>{{ __('materials.image_url') }} :</strong>
                <img src="{{ $material->image_url }}"> {{ $material->image_url }} </img>
            </div>
         </div>
         <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ __('materials.url_link') }} :</strong>
                {{ $material->url_link }}
            </div>
         </div>

         <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ __('materials.status') }} :</strong>
                {{ ($material->status==1) ? __('tables.status_on'):__('tables.status_off') }}
            </div>
        </div>
     </div>
@endsection
