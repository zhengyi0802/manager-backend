@extends('adminlte::page')

@section('title', __('resellers.title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('resellers.header') }}</h1>
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
            <x-adminlte-card title="{{ __('resellers.introducer') }}" theme="info" icon="fas fa-lg">
                {{ $reseller->introducer->name }}
            </x-adminlte-card>
            <x-adminlte-card title="{{ __('resellers.name') }}" theme="info" icon="fas fa-lg">
                {{ $reseller->user->name }}
            </x-adminlte-card>
            <x-adminlte-card title="{{ __('resellers.phone') }}" theme="info" icon="fas fa-lg">
                {{ $reseller->user->phone }}
            </x-adminlte-card>
            <x-adminlte-card title="{{ __('resellers.line_id') }}" theme="info" icon="fas fa-lg">
                {{ $reseller->user->line_id }}
            </x-adminlte-card>
            <x-adminlte-card title="{{ __('resellers.email') }}" theme="info" icon="fas fa-lg">
                {{ $reseller->user->email }}
            </x-adminlte-card>
            <x-adminlte-card title="{{ __('resellers.address') }}" theme="info" icon="fas fa-lg">
                {{ $reseller->address }}
            </x-adminlte-card>
            <x-adminlte-card title="{{ __('resellers.pid') }}" theme="info" icon="fas fa-lg">
                {{ $reseller->pid }}
            </x-adminlte-card>
            @if (auth()->user()->id == $reseller->user->id
                 || auth()->user()->role == App\Enums\UserRole::Accounter
                 || auth()->user()->role == App\Enums\UserRole::Administrator)
            <x-adminlte-card title="{{ __('resellers.pid') }}" theme="info" icon="fas fa-lg">
                <img src="{{ '../'.$reseller->pid_image_1 }}" width="40%">
                <img src="{{ '../'.$reseller->pid_image_2 }}" width="40%">
            </x-adminlte-card>
            <x-adminlte-card title="{{ __('resellers.bank') }}" theme="info" icon="fas fa-lg">
                {{ $reseller->bank }}
            </x-adminlte-card>
            <x-adminlte-card title="{{ __('resellers.bank_name') }}" theme="info" icon="fas fa-lg">
                {{ $reseller->bank_name }}
            </x-adminlte-card>
            <x-adminlte-card title="{{ __('resellers.account') }}" theme="info" icon="fas fa-lg">
                {{ $reseller->account }}
            </x-adminlte-card>
            @endif
            <x-adminlte-card title="{{ __('resellers.bonus') }}" theme="info" icon="fas fa-lg">
                {{ $reseller->bonus }}
            </x-adminlte-card>
            <x-adminlte-card title="{{ __('resellers.share') }}" theme="info" icon="fas fa-lg">
                {{ $reseller->share }}
            </x-adminlte-card>
            <x-adminlte-card title="{{ __('resellers.created_by') }}" theme="info" icon="fas fa-lg">
                {{ $reseller->creator->name }}
            </x-adminlte-card>
            <x-adminlte-card title="{{ __('resellers.memo') }}" theme="info" icon="fas fa-lg">
                {{ $reseller->memo }}
            </x-adminlte-card>
            <x-adminlte-card title="{{ __('resellers.status') }}" theme="info" icon="fas fa-lg">
                <strong>{{ __('resellers.status') }} :</strong>
                {{ ($reseller->status==1) ? __('tables.status_on'):__('tables.status_off') }}
            </x-adminlte-card>
            <x-adminlte-card title="{{ __('resellers.created_by') }}" theme="info" icon="fas fa-lg">
                {{ $reseller->created_at->toDateString() }}
            </x-adminlte-card>
            <x-adminlte-card title="{{ __('resellers.distrobuter_up') }}" theme="info" icon="fas fa-lg">
                <p>{{ __('tables.distrobuter_application_url' ).$reseller->user->line_id }}</p>
                <p>{{ QrCode::size(300)->generate(__('tables.distrobuter_application_url' ).$reseller->user->line_id) }}</p>
            </x-adminlte-card>
            <x-adminlte-card title="{{ __('resellers.order_up') }}" theme="info" icon="fas fa-lg">
                <p><strong>{{ __('resellers.order_ap') }} :</strong></p>
                <p>{{ __('tables.order_application_url' ).$reseller->user->line_id }}</p>
                <p>{{ QrCode::size(300)->generate(__('tables.order_application_url' ).$reseller->user->line_id) }}</p>
            </x-adminlte-card>
         </div>
     </div>

    <div class="row">
         <div class="col-xs-12 col-sm-12 col-md-12">
            <x-adminlte-card title="{{ __('resellers.distrobuters') }}" theme="info" icon="fas fa-lg">
              @include('resellers.distrobuters')
            </x-adminlte-card>
         </div>
     </div>

    <div class="row">
         <div class="col-xs-12 col-sm-12 col-md-12">
            <x-adminlte-card title="{{ __('resellers.customers') }}" theme="info" icon="fas fa-lg">
              @include('resellers.customers')
            </x-adminlte-card>
         </div>
     </div>

@endsection
