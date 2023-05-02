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
            <x-adminlte-card title="{{ __('resellers.name') }}" theme="info" icon="fas fa-lg">
                {{ $reseller->user->name }}
            </x-adminlte-card>
            <x-adminlte-card title="{{ __('resellers.phone') }}" theme="info" icon="fas fa-lg">
                {{ $reseller->user->phone }}
            </x-adminlte-card>
            <x-adminlte-card title="{{ __('resellers.line_id') }}" theme="info" icon="fas fa-lg">
                {{ $reseller->user->line_id }}
            </x-adminlte-card>
            <x-adminlte-card title="{{ __('resellers.address') }}" theme="info" icon="fas fa-lg">
                {{ $reseller->address }}
            </div>
            <x-adminlte-card title="{{ __('resellers.pid') }}" theme="info" icon="fas fa-lg">
                {{ $reseller->pid }}
            </x-adminlte-card>
            <x-adminlte-card title="{{ __('resellers.pid_image_1') }}" theme="info" icon="fas fa-lg">
                {{ $reseller->pid_image_1 }}
            </x-adminlte-card>
            <x-adminlte-card title="{{ __('resellers.pid_image_2') }}" theme="info" icon="fas fa-lg">
                {{ $reseller->pid_image_2 }}
            </x-adminlte-card>
         @if (auth()->user()->role <= App\Enums\UserRole::Accounter)
            <x-adminlte-card title="{{ __('resellers.bank') }}" theme="info" icon="fas fa-lg">
                {{ $reseller->bank }}
            </x-adminlte-card>
            <x-adminlte-card title="{{ __('resellers.bank_name') }}" theme="info" icon="fas fa-lg">
                {{ $reseller->bank_name }}
            </x-adminlte-card>
            <x-adminlte-card title="{{ __('resellers.account') }}" theme="info" icon="fas fa-lg">
                {{ $reseller->account }}
            </x-adminlte-card>
            <x-adminlte-card title="{{ __('resellers.bonus') }}" theme="info" icon="fas fa-lg">
                {{ $reseller->bonus }}
            </x-adminlte-card>
            <x-adminlte-card title="{{ __('resellers.share') }}" theme="info" icon="fas fa-lg">
                {{ $reseller->share }}
            </x-adminlte-card>
         @endif
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
@endsection
