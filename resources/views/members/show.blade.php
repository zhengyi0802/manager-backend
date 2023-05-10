@extends('adminlte::page')

@section('title', __('members.title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('members.header') }}</h1>
@stop
<style>
    div.upgrade {
        margin-bottom : 20px;
    }
</style>
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h1>{{ __('tables.details') }}</h1>
            </div>
            @include('layouts.back')
            @if ( (auth()->user()->role == App\Enums\UserRole::Administrator
                || auth()->user()->role == App\Enums\UserRole::Manager)
                && (auth()->user()->id == $member->introducer->id))
            <div class="upgrade">
                <a class="btn btn-info" href="{{ route('members.upgradeR', $member->id) }}">{{ __('members.be_reseller') }}</a>
                <a class="btn btn-info" href="{{ route('members.upgradeD', $member->id) }}">{{ __('members.be_distrobuter') }}</a>
            </div>
            @endif
        </div>
    </div>

    <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-12">
        <x-adminlte-card title="{{ __('members.introducer') }}" theme="info" icon="fas fa-lg">
                {{ $member->introducer->name }}
        </x-adminlte>
        <x-adminlte-card title="{{ __('members.name') }}" theme="info" icon="fas fa-lg">
                {{ $member->user->name }}
        </x-adminlte-card>
        <x-adminlte-card title="{{ __('members.phone') }}" theme="info" icon="fas fa-lg">
                {{ $member->user->phone }}
        </x-adminlte-card>
        <x-adminlte-card title="{{ __('members.line_id') }}" theme="info" icon="fas fa-lg">
                {{ $member->user->line_id }}
        </x-adminlte-card>
        <x-adminlte-card title="{{ __('members.email') }}" theme="info" icon="fas fa-lg">
                {{ $member->user->email }}
        </x-adminlte-card>
        <x-adminlte-card title="{{ __('members.address') }}" theme="info" icon="fas fa-lg">
                {{ $member->address }}
        </x-adminlte-card>
        <x-adminlte-card title="{{ __('members.created_by') }}" theme="info" icon="fas fa-lg">
                {{ $member->creator->name }}
        </x-adminlte-card>
        <x-adminlte-card title="{{ __('members.memo') }}" theme="info" icon="fas fa-lg">
                {{ $member->memo }}
        </x-adminlte-card>
        <x-adminlte-card title="{{ __('members.status') }}" theme="info" icon="fas fa-lg">
                {{ ($member->status==1) ? __('tables.status_on'):__('tables.status_off') }}
        </x-adminlte-card>
        <x-adminlte-card title="{{ __('members.created_at') }}" theme="info" icon="fas fa-lg">
                {{ $member->created_at->toDateString() }}
        </x-adminlte-card>
     </div>
   </div>
    <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-12">
        <x-adminlte-card title="{{ __('members.orders') }}" theme="info" icon="fas fa-lg">
          @include('members.orders')
        </x-adminlte-card>
      </div>
    </div>
@endsection
