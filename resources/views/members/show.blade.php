@extends('adminlte::page')

@section('title', __('members.title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('members.header') }}</h1>
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
                <strong>{{ __('members.introducer') }} :</strong>
                {{ $member->introducer->name }}
            </div>
         </div>
         <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ __('members.name') }} :</strong>
                {{ $member->user->name }}
            </div>
         </div>
         <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ __('members.phone') }} :</strong>
                {{ $member->user->phone }}
            </div>
         </div>
         <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ __('members.line_id') }} :</strong>
                {{ $member->user->line_id }}
            </div>
         </div>
         <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ __('members.address') }} :</strong>
                {{ $member->address }}
            </div>
         </div>
         <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ __('members.pid') }} :</strong>
                {{ $member->pid }}
            </div>
            <div class="form-group">
                <strong>{{ __('members.pid_image_1') }} :</strong>
                {{ $member->pid_image_1 }}
            </div>
            <div class="form-group">
                <strong>{{ __('members.pid_image_2') }} :</strong>
                {{ $member->pid_image_2 }}
            </div>
         </div>
         @if (auth()->user()->role <= App\Enums\UserRole::Accounter)
         <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ __('members.bank') }} :</strong>
                {{ $member->bank }}
            </div>
         </div>
         <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ __('members.bank_name') }} :</strong>
                {{ $member->bank_name }}
            </div>
         </div>
         <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ __('members.account') }} :</strong>
                {{ $member->account }}
            </div>
         </div>
         <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ __('members.creadit_card') }} :</strong>
                {{ $member->creadit_card }}
            </div>
         </div>
         <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ __('members.creadit_expire') }} :</strong>
                {{ $member->creadit_expire }}
            </div>
         </div>
         @endif
         <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ __('members.created_by') }} :</strong>
                {{ $member->creator->name }}
            </div>
         </div>
         <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ __('members.memo') }} :</strong>
                {{ $member->memo }}
            </div>
         </div>
         <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ __('members.status') }} :</strong>
                {{ ($member->status==1) ? __('tables.status_on'):__('tables.status_off') }}
            </div>
        </div>
         <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ __('orders.created_at') }} :</strong>
                {{ $member->created_at->toDateString() }}
            </div>
         </div>
     </div>
@endsection
