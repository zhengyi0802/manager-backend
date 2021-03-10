@extends('adminlte::page')

@section('title', __('members.title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('members.header') }}</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('members.create') }}">{{ __('tables.new') }}</a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-bordered">
        <tr>
            <th>{{ __('members.id') }}</th>
            <th>{{ __('members.name') }}</th>
            <th>{{ __('members.account') }}</th>
            <th>{{ __('members.country') }}</th>
            <th>{{ __('members.phones') }}</th>
            <th>{{ __('members.status') }}</th>
            <th width="280px">{{ __('tables.action') }}</th>
        </tr>
        @foreach ($members as $member)
        <tr>
            <td>{{ $member->id }}</td>
            <td>{{ $member->name }}</td>
            <td>{{ $member->account }}</td>
            <td>{{ $member->country }}</td>
            <td>{{ $member->phones }}</td>
            <td>{{ ($member->status==1) ? __('tables.status_on'):__('tables.status_off') }}</td>
            <td>
                <form action="{{ route('members.destroy',$member->id) }}" method="POST">
                    <a class="btn btn-info" href="{{ route('members.show',$member->id) }}">{{ __('tables.details') }}</a>
                    <a class="btn btn-primary" href="{{ route('members.edit',$member->id) }}">{{ __('tables.edit') }}</a>
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">{{ __('tables.delete') }}</button>
                </form>
            </td>
        </tr>
        @endforeach

    </table>
    {!! $members->links() !!}
@endsection
