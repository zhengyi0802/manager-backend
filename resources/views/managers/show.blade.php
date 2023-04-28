@extends('adminlte::page')

@section('title', __('managers.title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('managers.header') }}</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h1>{{ __('tables.details') }}</h1>
            </div>
            @include('layouts.back')
        </div>
    </div>

    <div class="row">
         <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ __('managers.name') }} :</strong>
                {{ $manager->user->name }}
            </div>
         </div>
         <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ __('managers.phone') }} :</strong>
                {{ $manager->user->phone }}
            </div>
         </div>
         <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ __('managers.line_id') }} :</strong>
                {{ $manager->user->line_id }}
            </div>
         </div>
         <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ __('managers.company') }} :</strong>
                {{ $manager->company }}
            </div>
         </div>
         <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ __('managers.address') }} :</strong>
                {{ $manager->address }}
            </div>
         </div>
         <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ __('managers.cid') }} :</strong>
                {{ $manager->cid }}
            </div>
         </div>
         <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ __('managers.pid') }} :</strong>
                {{ $manager->pid }}
            </div>
         </div>
         <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ __('managers.created_by') }} :</strong>
                {{ $manager->creator->name }}
            </div>
         </div>
         <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ __('managers.memo') }} :</strong>
                {{ $manager->memo }}
            </div>
         </div>
         <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ __('managers.status') }} :</strong>
                {{ ($manager->status==1) ? __('tables.status_on'):__('tables.status_off') }}
            </div>
        </div>
     </div>
@endsection
