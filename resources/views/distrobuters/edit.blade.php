@extends('adminlte::page')

@section('title', __('distrobuters.title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('distrobuters.header') }}</h1>
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

    <form action="{{ route('distrobuters.update',$distrobuter->id) }}" method="POST" enctype="multipart/form-data">
        @method('PUT')
        @csrf
         <div class="row">
           <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group col-md-4">
                    <strong>{{ __('distrobuters.name') }} :</strong>
                    {{ $distrobuter->user->name }}
                </div>
                <div class="form-group col-md-4">
                    <strong>{{ __('distrobuters.reseller') }} :</strong>
                    {{ $distrobuter->introducer->name }}
                </div>
                <div class="form-group col-md-4">
                    <strong>{{ __('distrobuters.phone') }} : {{ __('tables.must') }}</strong>
                    <input type="text" name="phone" value="{{ $distrobuter->user->phone }}" class="form-control">
                </div>
                <div class="form-group col-md-4">
                    <strong>{{ __('distrobuters.line_id') }} : {{ __('tables.must') }}</strong>
                    <input type="text" name="line_id" value="{{ $distrobuter->user->line_id }}" class="form-control">
                </div>
                <div class="form-group col-md-4">
                    <strong>{{ __('distrobuters.password') }} :</strong>
                    <input type="text" name="newpassword" class="form-control">
                </div>
                <div class="form-group col-md-4">
                    <strong>{{ __('distrobuters.address') }} : {{ __('tables.must') }}</strong>
                    <input type="text" name="address" value="{{ $distrobuter->user->line_id }}" class="form-control">
                </div>
                <div class="form-group col-md-4">
                    <strong>{{ __('distrobuters.pidnumbers') }} : {{ __('tables.must') }}</strong>
                    <input type="text" name="pid" value="{{ $distrobuter->pid }}" class="form-control">
                </div>
                <div class="form-group col-md-4">
                    <strong>{{ __('distrobuters.pid_image_1') }} : {{ __('tables.must') }}</strong>
                    <input type="file" name="pid_image_1" class="form-control">
                </div>
                <div class="form-group col-md-4">
                    <strong>{{ __('distrobuters.pid_image_2') }} : {{ __('tables.must') }}</strong>
                    <input type="file" name="pid_image_2" class="form-control">
                </div>
                <div class="form-group col-md-4">
                    <strong>{{ __('distrobuters.bank') }} : {{ __('tables.must') }}</strong>
                    <input type="text" name="bank" value="{{ $distrobuter->bank }}" class="form-control">
                </div>
                <div class="form-group col-md-4">
                    <strong>{{ __('distrobuters.bank') }} : {{ __('tables.must') }}</strong>
                    <input type="text" name="bank_name" value="{{ $distrobuter->bank_name }}" class="form-control">
                </div>
                <div class="form-group col-md-4">
                    <strong>{{ __('distrobuters.account') }} : {{ __('tables.must') }}</strong>
                    <input type="text" name="account" value="{{ $distrobuter->account }}" class="form-control">
                </div>
                <div class="form-group col-md-4">
                    <strong>{{ __('distrobuters.bonus') }} : {{ __('tables.must') }}</strong>
                    <input type="number" name="bonus" value="{{ $distrobuter->bonus }}" class="form-control">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>{{ __('distrobuters.memo') }}:</strong>
                    <textarea class="form-control" style="height:150px" name="memo" >{{ $distrobuter->memo }}</textarea>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>{{ __('distrobuters.status') }} : </strong>
                    <input type="radio" name="status" value="1" {{ ($distrobuter->status==1) ? "checked":null }} >{{ __('tables.status_on') }}
                    <input type="radio" name="status" value="0" {{ ($distrobuter->status!=1) ? "checked":null }} >{{ __('tables.status_off') }}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
              <button type="submit" class="btn btn-primary">{{ __('tables.submit') }}</button>
            </div>
        </div>
    </form>
@endsection

