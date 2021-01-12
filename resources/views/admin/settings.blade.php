@extends('adminlte::page')

@section('title', __('admin.title') )

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('admin.header') }}</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <p class="mb-0">{{ __('admin.login') }}</p>
                </div>
            </div>
        </div>
    </div>
@stop
