@extends('adminlte::page')

@section('title', __('admins.title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('admins.header') }}</h1>
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
        <x-adminlte-card title="{{ __('admins.name') }}" theme="info" icon="fas fa-lg">
          {{ $admin->name }}
        </x-adminlte-card>
        <x-adminlte-card title="{{ __('admins.phone') }}" theme="info" icon="fas fa-lg">
          {{ $admin->phone }}
        </x-adminlte-card>
        <x-adminlte-card title="{{ __('admins.line_id') }}" theme="info" icon="fas fa-lg">
          {{ $admin->line_id }}
        </x-adminlte-card>
        <x-adminlte-card title="{{ __('admins.created_by') }}" theme="info" icon="fas fa-lg">
          {{ $admin->creator ? $admin->creator->name : null }}
        </x-adminlte-card>
        <x-adminlte-card title="{{ __('admins.status') }}" theme="info" icon="fas fa-lg">
          {{ ($admin->status==1) ? __('tables.status_on'):__('tables.status_off') }}
        </x-adminlte-card>
        <x-adminlte-card title="{{ __('admins.created_by') }}" theme="info" icon="fas fa-lg">
          {{ $admin->created_at }}
        </x-adminlte-card>
      </div>
    </div>
@endsection
