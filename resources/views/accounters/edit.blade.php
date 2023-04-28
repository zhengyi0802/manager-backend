@extends('adminlte::page')

@section('title', __('accounters.title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('accounters.header') }}</h1>
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

    <form action="{{ route('accounters.update',$accounter->id) }}" method="POST">
        @method('PUT')
        @csrf
         <div class="row">
           <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group col-md-4">
                    <strong>{{ __('accounters.name') }} :</strong>
                    {{ $accounter->name }}
                </div>
                <div class="form-group col-md-4">
                    <strong>{{ __('accounters.phone') }} : {{ __('tables.must') }}</strong>
                    <input type="text" name="phone" value="{{ $accounter->phone }}" class="form-control">
                </div>
                <div class="form-group col-md-4">
                    <strong>{{ __('accounters.line_id') }} : {{ __('tables.must') }}</strong>
                    <input type="text" name="line_id" value="{{ $accounter->line_id }}" class="form-control">
                </div>
                <div class="form-group col-md-4">
                    <strong>{{ __('accounters.password') }} :</strong>
                    <input type="text" name="new_password" class="form-control">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>{{ __('accounters.status') }} : </strong>
                    <input type="radio" name="status" value="1" {{ ($accounter->status==1) ? "checked":null }} >{{ __('tables.status_on') }}
                    <input type="radio" name="status" value="0" {{ ($accounter->status!=1) ? "checked":null }} >{{ __('tables.status_off') }}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
              <button type="submit" class="btn btn-primary">{{ __('tables.submit') }}</button>
            </div>
        </div>
    </form>
@endsection
