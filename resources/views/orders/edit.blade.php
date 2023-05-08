@extends('adminlte::page')

@section('title', __('orders.title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('orders.header') }}</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h1>{{ __('tables.edit') }}</h1>
            </div>
            @include('layouts.back')
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <style>
        div.cancel {
           margin-top   : 5px;
           color        : blue;
           font-weight  ; bold;
        }
    </style>
    <form action="{{ route('orders.update',$order->id) }}" method="POST">
        @method('PUT')
        @csrf
         <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group col-md-4">
                    <strong>{{ __('orders.phone') }} :</strong>
                    <input type="text" name="phone" value="{{ $order->phone }}" class="form-control">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group col-md-4">
                    <strong>{{ __('orders.address') }} :</strong>
                    <input type="text" name="address" value="{{ $order->address }}" class="form-control">
                </div>
            </div>
            @if (auth()->user()->role == App\Enums\UserRole::Accounter)
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group col-md-4">
                    <strong>{{ __('orders.paid_1') }} :</strong>
                    <input type="number" name="paid_1" value="{{ $order->paid_1 }}" class="form-control">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group col-md-4">
                    <strong>{{ __('orders.paid_date_1') }} :</strong>
                    <input type="date" name="paid_date_1" value="{{ $order->paid_date_1 }}" class="form-control">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group col-md-4">
                    <strong>{{ __('orders.paid_2') }} :</strong>
                    <input type="number" name="paid_2" value="{{ $order->paid_2 }}" class="form-control">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group col-md-4">
                    <strong>{{ __('orders.paid_date_2') }} :</strong>
                    <input type="date" name="paid_date_2" value="{{ $order->paid_date_2 }}" class="form-control">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>{{ __('orders.flow_status') }} : </strong>
                    <div>
                       <input type="radio" name="flow_status" value="0" {{ ($order->flow_status==0) ? "checked":null }} >{{ __('orders.cancel') }}
                    </div>
                    <div>
                      <input type="radio" name="flow_status" value="1" {{ ($order->flow_status==1) ? "checked":null }} >{{ __('orders.unchecked') }}
                    </div>
                    <div>
                      <input type="radio" name="flow_status" value="2" {{ ($order->flow_status==2) ? "checked":null }} >{{ __('orders.checked') }}
                    </div>
                    <div>
                      <input type="radio" name="flow_status" value="3" {{ ($order->flow_status==3) ? "checked":null }} >{{ __('orders.prepaid_paided') }}
                    </div>
                    <div>
                      <input type="radio" name="flow_status" value="4" {{ ($order->flow_status==4) ? "checked":null }} >{{ __('orders.transfering') }}
                    </div>
                    <div>
                      <input type="radio" name="flow_status" value="5" {{ ($order->flow_status==5) ? "checked":null }} >{{ __('orders.installed') }}
                    </div>
                    <div>
                      <input type="radio" name="flow_status" value="6" {{ ($order->flow_status==6) ? "checked":null }} >{{ __('orders.completed') }}
                    </div>
                    <div>
                      <input type="radio" name="flow_status" value="7" {{ ($order->flow_status==7) ? "checked":null }} >{{ __('orders.bonuschecked') }}
                    </div>
                    <div>
                      <input type="radio" name="flow_status" value="8" {{ ($order->flow_status==8) ? "checked":null }} >{{ __('orders.bonustransfered') }}
                    </div>
                </div>
            </div>
            @else
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>{{ __('orders.flow_status') }} : </strong>
                    <div>
                       {{ trans_choice('orders.flow_statuses', $order->flow_status) }}
                    </div>
                    <div class="cancel">
                       {{ __('orders.cancel') }}<input type="checkbox" name="cancel_flag" value="1">
                    </div>
                </div>
            </div>
            <input type="hidden" name="flow_status" value="{{ $order->flow_status }}">
            @endif
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
              <button type="submit" class="btn btn-primary">{{ __('tables.submit') }}</button>
            </div>
        </div>
    </form>
@endsection

