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
            <x-adminlte-card title="{{ __('managers.name') }}" theme="info" icon="fas fa-lg">
                {{ $manager->user ? $manager->user->name : null }}
            </x-adminlte-card>
            <x-adminlte-card title="{{ __('managers.phone') }}" theme="info" icon="fas fa-lg">
                {{ $manager->user ? $manager->user->phone : null }}
            </x-adminlte-card>
            <x-adminlte-card title="{{ __('managers.line_id') }}" theme="info" icon="fas fa-lg">
                {{ $manager->user ? $manager->user->line_id : null }}
            </x-adminlte-card>
            <x-adminlte-card title="{{ __('managers.company') }}" theme="info" icon="fas fa-lg">
                {{ $manager->company }}
            </x-adminlte-card>
            <x-adminlte-card title="{{ __('managers.address') }}" theme="info" icon="fas fa-lg">
                {{ $manager->address }}
            </x-adminlte-card>
            <x-adminlte-card title="{{ __('managers.cid') }}" theme="info" icon="fas fa-lg">
                {{ $manager->cid }}
            </x-adminlte-card>
            <x-adminlte-card title="{{ __('managers.pid') }}" theme="info" icon="fas fa-lg">
                {{ $manager->pid }}
            </x-adminlte-card>
            <x-adminlte-card title="{{ __('managers.pid') }}" theme="info" icon="fas fa-lg">
                <img src="../{{ $manager->pid_image_1 }}" width="40%">
                <img src="../{{ $manager->pid_image_2 }}" width="40%">
            </x-adminlte-card>
            <x-adminlte-card title="{{ __('managers.share') }}" theme="info" icon="fas fa-lg">
                {{ $manager->share }}
            </x-adminlte-card>
            <x-adminlte-card title="{{ __('managers.bonus') }}" theme="info" icon="fas fa-lg">
                {{ $manager->bonus }}
            </x-adminlte-card>
            <x-adminlte-card title="{{ __('managers.created_by') }}" theme="info" icon="fas fa-lg">
                {{ $manager->creator ? $manager->creator->name : null }}
            </x-adminlte-card>
            <x-adminlte-card title="{{ __('managers.memo') }}" theme="info" icon="fas fa-lg">
                {{ $manager->memo }}
            </x-adminlte-card>
            <x-adminlte-card title="{{ __('managers.status') }}" theme="info" icon="fas fa-lg">
                {{ ($manager->status==1) ? __('tables.status_on'):__('tables.status_off') }}
            </x-adminlte-card>
            <x-adminlte-card title="{{ __('managers.created_at') }}" theme="info" icon="fas fa-lg">
                {{ $manager->created_at }}
            </x-adminlte-card>
            <x-adminlte-card title="{{ __('managers.reseller_ap') }}" theme="info" icon="fas fa-lg">
                <p>{{ __('tables.reseller_application_url' ).$manager->user->line_id }}</p>
                <p>{{ QrCode::size(300)->generate(__('tables.reseller_application_url' ).$manager->user->line_id) }}</p>
            </x-adminlte-card>
            <x-adminlte-card title="{{ __('managers.distrobuter_ap') }}" theme="info" icon="fas fa-lg">
                <p>{{ __('tables.distrobuter_application_url' ).$manager->user->line_id }}</p>
                <p>{{ QrCode::size(300)->generate(__('tables.distrobuter_application_url' ).$manager->user->line_id) }}</p>
            </x-adminlte-card>
            <x-adminlte-card title="{{ __('managers.order_ap') }}" theme="info" icon="fas fa-lg">
                <p>{{ __('tables.order_application_url' ).$manager->user->line_id }}</p>
                <p>{{ QrCode::size(300)->generate(__('tables.order_application_url' ).$manager->user->line_id) }}</p>
            </x-adminlte-card>
         </div>
     </div>

    <div class="row">
         <div class="col-xs-12 col-sm-12 col-md-12">
            <x-adminlte-card title="{{ __('managers.resellers') }}" theme="info" icon="fas fa-lg">
              @include('managers.resellers')
            </x-adminlte-card>
            <x-adminlte-card title="{{ __('managers.distrobuters') }}" theme="info" icon="fas fa-lg">
              @include('managers.distrobuters')
            </x-adminlte-card>
            <x-adminlte-card title="{{ __('managers.customers') }}" theme="info" icon="fas fa-lg">
              @include('managers.customers')
            </x-adminlte-card>
         </div>
     </div>

@endsection
