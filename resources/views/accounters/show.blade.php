@extends('adminlte::page')

@section('title', __('accounters.title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('accounters.header') }}</h1>
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
            <x-adminlte-card title="{{ __('accounters.name') }}" theme="info" icon="fas fa-lg">
                {{ $accounter->name }}
            </x-adminlte-card>
            <x-adminlte-card title="{{ __('accounters.phone') }}" theme="info" icon="fas fa-lg">
                {{ $accounter->phone }}
            </x-adminlte-card>
            <x-adminlte-card title="{{ __('accounters.line_id') }}" theme="info" icon="fas fa-lg">
                {{ $accounter->line_id }}
            </x-adminlte-card>
            <x-adminlte-card title="{{ __('accounters.created_by') }}" theme="info" icon="fas fa-lg">
                {{ $accounter->creator->name }}
            </x-adminlte-card>
            <x-adminlte-card title="{{ __('accounters.status') }}" theme="info" icon="fas fa-lg">
                <strong>{{ __('accounters.status') }} :</strong>
                {{ ($accounter->status==1) ? __('tables.status_on'):__('tables.status_off') }}
            </x-adminlte-card>
         </div>
    </div>
@endsection
