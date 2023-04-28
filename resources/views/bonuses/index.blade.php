@extends('adminlte::page')

@section('title', __('bonuses.title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('bonuses.header') }}</h1>
@stop

@section('content')

    @include('bonuses.table')

@endsection
