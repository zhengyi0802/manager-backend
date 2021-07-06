@extends('adminlte::page')

@section('title', __('qalists.title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('qalists.header') }}</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h1>{{ __('tables.edit') }}</h1>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('qalists.index') }}">{{ __('tables.back') }}</a>
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

    <form action="{{ route('qalists.update',$qalist->id) }}" method="POST">
        @csrf
        @method('PUT')
         <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>{{ __('qalists.catagory') }} :</strong>
                    <select id="catagory_id" name="catagory_id">
                        @foreach($qacatagories as $qacatagory)
                           <option value="{{ $qacatagory->id }}" {{ ($qacatagory->id == $qalist->catagory_id) ? "selected" : null }} >{{ $qacatagory->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>{{ __('qalists.question') }} :</strong>
                    <input type="text" name="question" value="{{ $qalist->question }}" class="form-control" placeholder="Question">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>{{ __('qalists.type') }} :</strong>
                    <select id="type" name="type">
                        <option value="video" {{ ($qalist->type == "video") ? "selected" : null }} >{{ __('qalists.video') }}</option>
                        <option value="youtube" {{ ($qalist->type == "youtube") ? "selected" : null }} >{{ __('qalists.youtube_id') }}</option>
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>{{ __('qalists.answer') }} :</strong>
                    <input type="text" name="answer" value="{{ $qalist->answer }}" class="form-control">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>{{ __('qalists.status') }} :</strong>
                    <input type="radio" name="status" value="1" {{ ($qalist->status==1) ? "checked":null }} >{{ __('tables.status_on') }}
                    <input type="radio" name="status" value="0" {{ ($qalist->status!=1) ? "checked":null }} >{{ __('tables.status_off') }}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
              <button type="submit" class="btn btn-primary">{{ __('tables.submit') }}</button>
            </div>
        </div>
    </form>
@endsection
