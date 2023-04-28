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
            <div class="form-group">
                <strong>{{ __('resellers.name') }} :</strong>
                {{ $reseller->user->name }}
            </div>
         </div>
         <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ __('resellers.phone') }} :</strong>
                {{ $reseller->user->phone }}
            </div>
         </div>
         <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ __('resellers.line_id') }} :</strong>
                {{ $reseller->user->line_id }}
            </div>
         </div>
         <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ __('resellers.address') }} :</strong>
                {{ $reseller->address }}
            </div>
         </div>
         <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ __('resellers.pid') }} :</strong>
                {{ $reseller->pid }}
            </div>
            <div class="form-group">
                <strong>{{ __('resellers.pid_image_1') }} :</strong>
                {{ $reseller->pid_image_1 }}
            </div>
            <div class="form-group">
                <strong>{{ __('resellers.pid_image_2') }} :</strong>
                {{ $reseller->pid_image_2 }}
            </div>
         </div>
         @if (auth()->user()->role <= App\Enums\UserRole::Accounter)
         <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ __('resellers.bank') }} :</strong>
                {{ $reseller->bank }}
            </div>
         </div>
         <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ __('resellers.bank_name') }} :</strong>
                {{ $reseller->bank_name }}
            </div>
         </div>
         <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ __('resellers.account') }} :</strong>
                {{ $reseller->account }}
            </div>
         </div>
         <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ __('resellers.bonus') }} :</strong>
                {{ $reseller->bonus }}
            </div>
         </div>
         <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ __('resellers.share') }} :</strong>
                {{ $reseller->share }}
            </div>
         </div>
         <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ __('resellers.creadit_card') }} :</strong>
                {{ $reseller->creadit_card }}
            </div>
         </div>
         <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ __('resellers.creadit_expire') }} :</strong>
                {{ $reseller->creadit_expire }}
            </div>
         </div>
         @endif
         <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ __('resellers.created_by') }} :</strong>
                {{ $reseller->creator->name }}
            </div>
         </div>
         <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ __('resellers.memo') }} :</strong>
                {{ $reseller->memo }}
            </div>
         </div>
         <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ __('resellers.status') }} :</strong>
                {{ ($reseller->status==1) ? __('tables.status_on'):__('tables.status_off') }}
            </div>
        </div>
     </div>
@endsection
