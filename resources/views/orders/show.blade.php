@extends('adminlte::page')

@section('title', __('orders.title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('orders.header') }}</h1>
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
                <strong>{{ __('orders.name') }} :</strong>
                {{ $order->member->user->name }}
            </div>
         </div>
         <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ __('members.phone') }} :</strong>
                {{ $order->member->user->phone }}
            </div>
         </div>
         <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ __('members.line_id') }} :</strong>
                {{ $order->member->user->line_id }}
            </div>
         </div>
         <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ __('members.address') }} :</strong>
                {{ $order->member->address }}
            </div>
         </div>
         <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ __('members.pid') }} :</strong>
                {{ $order->member->pid }}
            </div>
         </div>
         @if (auth()->user()->role <= App\Enums\UserRole::Accounter)
         <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ __('members.creadit_card') }} :</strong>
                {{ $order->member->creadit_card }}
            </div>
         </div>
         <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ __('members.creadit_expire') }} :</strong>
                {{ $order->member->creadit_expire }}
            </div>
         </div>
         @endif
         <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ __('orders.prepaid_paid') }} :</strong>
                {{ $order->prepaid_paid }}
            </div>
         </div>
         <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ __('orders.paid_date') }} :</strong>
                {{ $order->paid_date }}
            </div>
         </div>
         <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ __('orders.prepaid_unpaid') }} :</strong>
                {{ $order->prepaid_unpaid }}
            </div>
         </div>
         <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ __('orders.flow_status') }} :</strong>
                @if ($order->flow_status < 7)
                    {{ trans_choice('orders.flow_statuses', $order->flow_status) }}
                @elseif ($order->flow_status == 7)
                    {{ __('orders.bonuschecked') }}
                @elseif ($order->flow_status == 8)
                    {{ __('orders.bonustransfered') }}
                @endif
            </div>
         </div>
         <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ __('orders.completed') }} :</strong>
                {{ $order->completed ? __('tables.yes') : __('tables.no') }}
            </div>
         </div>
         <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ __('orders.created_by') }} :</strong>
                {{ $order->member->creator->name }}
            </div>
         </div>
         <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ __('orders.memo') }} :</strong>
                {{ $order->memo }}
            </div>
         </div>
         <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ __('orders.created_at') }} :</strong>
                {{ $order->created_at->toDateString() }}
            </div>
         </div>
     </div>
@endsection
