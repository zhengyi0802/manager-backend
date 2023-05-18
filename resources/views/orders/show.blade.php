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
            <div class="pull-left">
              {{ $sms ?? '' }}
            </div>
        </div>
    </div>

    <div class="row">
         <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ __('orders.sms_send') }} :</strong>
                <a class="btn btn-info" href="{{ route('orders.smssend',$order->id) }}">傳送通知</a>
            </div>
         </div>
         <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ __('orders.introducer') }} :</strong>
                {{ ($order->is_manager) ? $order->manager->user->name : $order->member->introducer->name }}
            </div>
         </div>
         <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ __('orders.name') }} :</strong>
                {{ ($order->is_manager) ? $order->manager->user->name : $order->member->user->name }}
            </div>
         </div>
         <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ __('orders.phone') }} :</strong>
                {{ $order->phone }}
            </div>
         </div>
         <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ __('orders.model') }} :</strong>
                {{ ($order->model == 1) ? __('orders.model_75') : __('orders.model_65') }}
            </div>
         </div>
         <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ __('orders.line_id') }} :</strong>
                {{ ($order->is_manager) ? $order->manager->user->line_id : $order->member->user->line_id }}
            </div>
         </div>
         <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ __('orders.address') }} :</strong>
                {{ $order->address }}
            </div>
         </div>
         <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ __('orders.paid_1') }} :</strong>
                {{ $order->paid_1 }}
            </div>
         </div>
         <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ __('orders.paid_date_1') }} :</strong>
                {{ $order->paid_date_1 }}
            </div>
         </div>
         <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ __('orders.paid_2') }} :</strong>
                {{ $order->paid_2 }}
            </div>
         </div>
         <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ __('orders.paid_date_2') }} :</strong>
                {{ $order->paid_date_2 }}
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
