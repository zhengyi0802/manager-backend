@extends('adminlte::page')

@section('title', __('materials.title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('materials.header') }}</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('materials.create') }}">{{ __('tables.new') }}</a>
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
            <th>{{ __('materials.id') }}</th>
            <th>{{ __('materials.name') }}</th>
            <th>{{ __('materials.project_name') }}</th>
            <th>{{ __('materials.position') }}</th>
            <th>{{ __('materials.previous_name') }}</th>
            <th>{{ __('materials.image_url') }}</th>
            <th>{{ __('materials.status') }}</th>
            <th width="280px">{{ __('tables.action') }}</th>
        </tr>
        @foreach ($materials as $material)
        <tr>
            <td>{{ $material->id }}</td>
            <td>{{ $material->name }}</td>
            <td>{{ ($material->project_name) ? $material->project_name : '--------'  }}</td>
            <td>{{ trans_choice('materials.blocks', $material->position) }}</td>
            <td>{{ ($material->prev_id > 0 ) ? $material->prev_id : '--------'}}</td>
            <td><img src="{{ $material->image_url }}" width="20%" height="20%" ></td>
            <td>{{ ($material->status==1) ? __('tables.status_on'):__('tables.status_off') }}</td>
            <td>
                <form action="{{ route('materials.destroy',$material->id) }}" method="POST">
                    <a class="btn btn-info" href="{{ route('materials.show',$material->id) }}">{{ __('tables.details') }}</a>
                    <a class="btn btn-primary" href="{{ route('materials.edit',$material->id) }}">{{ __('tables.edit') }}</a>
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">{{ __('tables.delete') }}</button>
                </form>
            </td>
        </tr>
        @endforeach

    </table>
    {!! $materials->links() !!}
@endsection
