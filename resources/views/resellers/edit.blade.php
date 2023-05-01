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

    <form action="{{ route('resellers.update',$reseller->id) }}" method="POST" enctype="multipart/form-data">
        @method('PUT')
        @csrf
         <div class="row">
           <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group col-md-4">
                    <strong>{{ __('resellers.name') }} :</strong>
                    {{ $reseller->user->name }}
                </div>
                <div class="form-group col-md-4">
                    <strong>{{ __('resellers.phone') }} : {{ __('tables.must') }}</strong>
                    <input type="text" name="phone" value="{{ $reseller->user->phone }}" class="form-control">
                </div>
                <div class="form-group col-md-4">
                    <strong>{{ __('resellers.line_id') }} : {{ __('tables.must') }}</strong>
                    <input type="text" name="line_id" value="{{ $reseller->user->line_id }}" class="form-control">
                </div>
                <div class="form-group col-md-4">
                    <strong>{{ __('resellers.password') }} :</strong>
                    <input type="text" name="newpassword" class="form-control">
                </div>
                <div class="form-group col-md-4">
                    <strong>{{ __('resellers.address') }} : {{ __('tables.must') }}</strong>
                    <input type="text" name="address" value="{{ $reseller->address }}" class="form-control">
                </div>
                <div class="form-group col-md-4">
                    <strong>{{ __('resellers.pidnumbers') }} : {{ __('tables.must') }}</strong>
                    <input type="text" name="pid" value="{{ $reseller->pid }}" class="form-control">
                </div>
                <div class="form-group col-md-4">
                    <strong>{{ __('resellers.pid_image_1') }} : {{ __('tables.must') }}</strong>
                    <input type="file" name="pid_image_1" class="form-control">
                </div>
                <div class="form-group col-md-4">
                    <strong>{{ __('resellers.pid_image_2') }} : {{ __('tables.must') }}</strong>
                    <input type="file" name="pid_image_2" class="form-control">
                </div>
                <div class="form-group col-md-4">
                    <strong>{{ __('resellers.bank') }} : {{ __('tables.must') }}</strong>
                    <input type="text" name="bank" value="{{ $reseller->bank }}" class="form-control">
                </div>
                <div class="form-group col-md-4">
                    <strong>{{ __('resellers.bank_name') }} : {{ __('tables.must') }}</strong>
                    <input type="text" name="bank_name" value="{{ $reseller->bank_name }}" class="form-control">
                </div>
                <div class="form-group col-md-4">
                    <strong>{{ __('resellers.account') }} : {{ __('tables.must') }}</strong>
                    <input type="text" name="account" value="{{ $reseller->account }}" class="form-control">
                </div>
                @if (auth()->user()->role == App\Enums\UserRole::Manager)
                <div class="form-group col-md-4">
                    <strong>{{ __('resellers.bonus') }} : {{ __('tables.must') }}</strong>
                    <input type="text" name="bonus" value="{{ $reseller->bonus }}" class="form-control">
                </div>
                <div class="form-group col-md-4">
                    <strong>{{ __('resellers.share') }} : {{ __('tables.must') }}</strong>
                    <input type="text" name="share" value="{{ $reseller->share }}" class="form-control">
                </div>
                @endif
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>{{ __('resellers.memo') }}:</strong>
                    <textarea class="form-control" style="height:150px" name="memo" >{{ $reseller->memo }}</textarea>
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

