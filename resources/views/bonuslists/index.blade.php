@extends('adminlte::page')

@section('title', __('bonuslists.title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('bonuslists.header') }}</h1>
@stop

@section('content')
    @if (auth()->user()->role <= App\Enums\UserRole::Accounter)
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('bonuslists.check') }}">{{ __('bonuslists.check') }}</a>
                {{ __('bonuslists.check_message') }}{{ now()->subDays(2)->toDateString() }}
            </div>
        </div>
    </div>
    @endif

    @include('bonuslists.table')

@endsection
