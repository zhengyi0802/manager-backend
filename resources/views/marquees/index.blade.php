@extends('adminlte::page')

@section('title', __('marquees.title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('marquees.header') }}</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('marquees.create') }}">{{ __('tables.new') }}</a>
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
            <th>{{ __('marquees.id') }}</th>
            <th>{{ __('marquees.type') }}</th>
            <th>{{ __('marquees.project') }}</th>
            <th>{{ __('marquees.serialno') }}</th>
            <th>{{ __('marquees.content') }}</th>
            <th>{{ __('marquees.status') }}</th>
            <th width="280px">{{ __('tables.action') }}</th>
        </tr>
        @foreach ($marquees as $marquee)
        <tr>
            <td>{{ $marquee->id }}</td>
            <td>
                @if ($marquee->type == 1)
                    {{ __('marquees.type_single') }}
                @elseif ($marquee->type == 2)
                    {{ __('marquees.type_project') }}
                @else
                    {{ __('marquees.type_all') }}
                @endif
            </td>
            <td>{{ $marquee->project_name ?? '' }}</td>
            <td>{{ $marquee->serialno ?? '' }}</td>
            <td>{{ $marquee->content }}</td>
            <td>{{ ($marquee->status==1) ?  __('tables.status_on') : __('tables.status_off') }}</td>
            <td>
                <form action="{{ route('marquees.destroy',$marquee->id) }}" method="POST">
                    <a class="btn btn-info" href="{{ route('marquees.show',$marquee->id) }}">{{ __('tables.details') }}</a>
                    <a class="btn btn-primary" href="{{ route('marquees.edit',$marquee->id) }}">{{ __('tables.edit') }}</a>
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">{{ __('tables.delete') }}</button>
                </form>
            </td>
        </tr>
        @endforeach

    </table>
    {!! $marquees->links() !!}
@endsection
