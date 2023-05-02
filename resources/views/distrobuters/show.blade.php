@extends('adminlte::page')

@section('title', __('distrobuters.title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('distrobuters.header') }}</h1>
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
            <x-adminlte-card title="{{ __('distrobuters.reseller') }}" theme="info" icon="fas fa-lg">
                {{ $distrobuter->introducer->name }}
            </x-adminlte-card>
            <x-adminlte-card title="{{ __('distrobuters.name') }}" theme="info" icon="fas fa-lg">
                {{ $distrobuter->user->name }}
            </x-adminlte-card>
            <x-adminlte-card title="{{ __('distrobuters.phone') }}" theme="info" icon="fas fa-lg">
                {{ $distrobuter->user->phone }}
            </x-adminlte>
            <x-adminlte-card title="{{ __('distrobuters.line_id') }}" theme="info" icon="fas fa-lg">
                {{ $distrobuter->user->line_id }}
            </x-adminlte-card>
            <x-adminlte-card title="{{ __('distrobuters.address') }}" theme="info" icon="fas fa-lg">
                {{ $distrobuter->address }}
            </x-adminlte-card>
            <x-adminlte-card title="{{ __('distrobuters.pidnumbers') }}" theme="info" icon="fas fa-lg">
                {{ $distrobuter->pid }}
            </x-adminlte-card>
         @if (auth()->user()->role == App\Enums\UserRole::Accounter || auth()->user()->role == App\Enums\UserRole::Administrator)
            <x-adminlte-card title="{{ __('distrobuters.pid_image_1') }}" theme="info" icon="fas fa-lg">
                <img src="{{ '../'.$distrobuter->pid_image_1 }}">
            </x-adminlte-card>
            <x-adminlte-card title="{{ __('distrobuters.pid_image_2') }}" theme="info" icon="fas fa-lg">
                <img src="{{ '../'.$distrobuter->pid_image_2 }}">
            </x-adminlte-card>
            <x-adminlte-card title="{{ __('distrobuters.bank') }}" theme="info" icon="fas fa-lg">
                {{ $distrobuter->bank }}
            </x-adminlte-card>
            <x-adminlte-card title="{{ __('distrobuters.bank_name') }}" theme="info" icon="fas fa-lg">
                {{ $distrobuter->bank_name }}
            </x-adminlte-card>
            <x-adminlte-card title="{{ __('distrobuters.account') }}" theme="info" icon="fas fa-lg">
                {{ $distrobuter->account }}
            </x-adminlte-card>
            <x-adminlte-card title="{{ __('distrobuters.bonus') }}" theme="info" icon="fas fa-lg">
                {{ $distrobuter->bonus }}
            </x-adminlte-card>
         @endif
            <x-adminlte-card title="{{ __('distrobuters.created_by') }}" theme="info" icon="fas fa-lg">
                {{ $distrobuter->creator->name }}
            </x-adminlte-card>
            <x-adminlte-card title="{{ __('distrobuters.memo') }}" theme="info" icon="fas fa-lg">
                {{ $distrobuter->memo }}
            </x-adminlte-card>
            <x-adminlte-card title="{{ __('distrobuters.status') }}" theme="info" icon="fas fa-lg">
                <strong>{{ __('distrobuters.status') }} :</strong>
                {{ ($distrobuter->status==1) ? __('tables.status_on'):__('tables.status_off') }}
            </x-adminlte-card>
            <x-adminlte-card title="{{ __('distrobuters.created_at') }}" theme="info" icon="fas fa-lg">
                {{ $distrobuter->created_at->toDateString() }}
            </x-adminlte-card>
            <x-adminlte-card title="{{ __('distrobuters.order_ap') }}" theme="info" icon="fas fa-lg">
                <p>{{ __('tables.order_application_url' ).$distrobuter->user->line_id }}</p>
                <p>{{ QrCode::size(300)->generate(__('tables.order_application_url' ).$distrobuter->user->line_id) }}</p>
            </x-adminlte-card>
         </div>
     </div>
@endsection
