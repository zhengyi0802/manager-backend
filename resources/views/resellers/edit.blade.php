@extends('adminlte::page')

@section('title', __('resellers.title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('resellers.header') }}</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h1>{{ __('tables.edit') }}</h1>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('resellers.index') }}">返回</a>
            </div>
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

    <form action="{{ route('resellers.update',$reseller->id) }}" method="POST">
        @csrf
        @method('PUT')
         <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>{{ __('resellers.company') }} :</strong>
                    <input type="text" name="company" value="{{ $reseller->company }}" class="form-control">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>{{ __('resellers.account') }} :</strong>
                    <input type="text" name="account" value="{{ $reseller->account }}" class="form-control">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>{{ __('resellers.password') }} :</strong>
                    <input type="text" name="password" value="{{ $reseller->password }}" class="form-control">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>{{ __('resellers.contact') }} :</strong>
                    <input type="text" name="contact" value="{{ $reseller->contact }}" class="form-control">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>{{ __('resellers.cotype') }} :</strong>
                    <input type="text" name="cotype" value="{{ $reseller->cotype }}" class="form-control">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>{{ __('resellers.country') }} :</strong>
                    <input type="text" name="country" value="{{ $reseller->country }}" class="form-control">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>{{ __('resellers.zipcode') }} :</strong>
                    <input type="text" name="zipcode" value="{{ $reseller->zipcode }}" class="form-control">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>{{ __('resellers.address') }} :</strong>
                    <input type="text" name="address" value="{{ $reseller->address }}" class="form-control">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>{{ __('resellers.phones') }} :</strong>
                    <input type="text" name="phones" value="{{ $reseller->phones }}" class="form-control">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>{{ __('resellers.status') }} : </strong>
                    <input type="radio" name="status" value="1" {{ ($reseller->status==1) ? "checked":null }} >{{ __('tables.status_on') }}
                    <input type="radio" name="status" value="0" {{ ($reseller->status!=1) ? "checked":null }} >{{ __('tables.status_off') }}
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
              <button type="submit" class="btn btn-primary">{{ __('tables.submit') }}</button>
            </div>
        </div>
    </form>
@endsection
