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
            <div class="form-group">
                <strong>{{ __('distrobuters.reseller') }} :</strong>
                {{ $distrobuter->introducer->name }}
            </div>
            <div class="form-group">
                <strong>{{ __('distrobuters.name') }} :</strong>
                {{ $distrobuter->user->name }}
            </div>
         </div>
         <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ __('distrobuters.phone') }} :</strong>
                {{ $distrobuter->user->phone }}
            </div>
         </div>
         <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ __('distrobuters.line_id') }} :</strong>
                {{ $distrobuter->user->line_id }}
            </div>
         </div>
         <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ __('distrobuters.address') }} :</strong>
                {{ $distrobuter->address }}
            </div>
         </div>
         <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ __('distrobuters.pid') }} :</strong>
                {{ $distrobuter->pid }}
            </div>
            <div class="form-group">
                <strong>{{ __('distrobuters.pid_image_1') }} :</strong>
                {{ $distrobuter->pid_image_1 }}
            </div>
            <div class="form-group">
                <strong>{{ __('distrobuters.pid_image_2') }} :</strong>
                {{ $distrobuter->pid_image_2 }}
            </div>
         </div>
         @if (auth()->user()->role <= App\Enums\UserRole::Accounter)
         <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ __('distrobuters.bank') }} :</strong>
                {{ $distrobuter->bank }}
            </div>
         </div>
         <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ __('distrobuters.bank_name') }} :</strong>
                {{ $distrobuter->bank_name }}
            </div>
         </div>
         <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ __('distrobuters.account') }} :</strong>
                {{ $distrobuter->account }}
            </div>
         </div>
         <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ __('distrobuters.bonus') }} :</strong>
                {{ $distrobuter->bonus }}
            </div>
         </div>
         <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ __('distrobuters.creadit_card') }} :</strong>
                {{ $distrobuter->creadit_card }}
            </div>
         </div>
         <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ __('distrobuters.creadit_expire') }} :</strong>
                {{ $distrobuter->creadit_expire }}
            </div>
         </div>
         @endif
         <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ __('distrobuters.created_by') }} :</strong>
                {{ $distrobuter->creator->name }}
            </div>
         </div>
         <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ __('distrobuters.memo') }} :</strong>
                {{ $distrobuter->memo }}
            </div>
         </div>
         <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ __('distrobuters.status') }} :</strong>
                {{ ($distrobuter->status==1) ? __('tables.status_on'):__('tables.status_off') }}
            </div>
        </div>
     </div>
@endsection
