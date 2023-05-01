@extends('adminlte::page')

@section('title', __('managers.title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('managers.header') }}</h1>
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

    <form action="{{ route('managers.update',$manager->id) }}" method="POST">
        @method('PUT')
        @csrf
         <div class="row">
           <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group col-md-4">
                    <strong>{{ __('managers.name') }} :</strong>
                    {{ $manager->user->name }}
                </div>
                <div class="form-group col-md-4">
                    <strong>{{ __('managers.phone') }} : {{ __('tables.must') }}</strong>
                    <input type="text" name="phone" value="{{ $manager->user->phone }}" class="form-control">
                </div>
                <div class="form-group col-md-4">
                    <strong>{{ __('managers.line_id') }} : {{ __('tables.must') }}</strong>
                    <input type="text" name="line_id" value="{{ $manager->user->line_id }}" class="form-control">
                </div>
                <div class="form-group col-md-4">
                    <strong>{{ __('managers.company') }} :</strong>
                    <input type="text" name="company" value="{{ $manager->company }}" class="form-control">
                </div>
                <div class="form-group col-md-4">
                    <strong>{{ __('managers.password') }} :</strong>
                    <input type="text" name="password" class="form-control">
                </div>
                <div class="form-group col-md-4">
                    <strong>{{ __('managers.address') }} : {{ __('tables.must') }}</strong>
                    <input type="text" name="address" value="{{ $manager->address }}" class="form-control">
                </div>
                <div class="form-group col-md-4">
                    <strong>{{ __('managers.cid') }} :</strong>
                    <input type="text" name="cid" value="{{ $manager->cid }}" class="form-control">
                </div>
                <div class="form-group col-md-4">
                    <strong>{{ __('managers.pid') }} :</strong>
                    <input type="text" name="pid" value="{{ $manager->pid }}" class="form-control">
                </div>
                @if (auth()->user()->role == App\Enums\UserRole::Administrator)
                <div class="form-group col-md-4">
                    <strong>{{ __('managers.share') }} :</strong>
                    <input type="number" name="share" value="{{ $manager->share }}" class="form-control">
                </div>
                <div class="form-group col-md-4">
                    <strong>{{ __('managers.bonus') }} :</strong>
                    <input type="text" name="bonus" value="{{ $manager->bonus }}" class="form-control">
               </div>
               @endif
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>{{ __('managers.memo') }}:</strong>
                    <textarea class="form-control" style="height:150px" name="memo" >{{ $manager->memo }}</textarea>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>{{ __('managers.status') }} : </strong>
                    <input type="radio" name="status" value="1" {{ ($manager->status==1) ? "checked":null }} >{{ __('tables.status_on') }}
                    <input type="radio" name="status" value="0" {{ ($manager->status!=1) ? "checked":null }} >{{ __('tables.status_off') }}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
              <button type="submit" class="btn btn-primary">{{ __('tables.submit') }}</button>
            </div>
        </div>
    </form>
@endsection
