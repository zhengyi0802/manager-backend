@extends('adminlte::page')

@section('title', __('product_types.title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('product_types.header') }}</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h1>{{ __('product_types.title') }}</h1>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('product_types.create') }}">{{ __('tables.new') }}</a>
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
            <th>{{ __('product_types.id') }}</th>
            <th>{{ __('product_types.catagory') }}</th>
            <th>{{ __('product_types.name') }}</th>
            <th>{{ __('product_types.description') }}</th>
            <th>{{ __('product_types.status') }}</th>
            <th width="280px">{{ __('tables.action') }}</th>
        </tr>
        @foreach ($productTypes as $productType)
        <tr>
            <td>{{ $productType->id }}</td>
            <td>{{ $productType->catagory_name }}</td>
            <td>{{ $productType->name }}</td>
            <td>{{ $productType->descriptions }}</td>
            <td>{{ ($productType->status==1) ? __('tables.status_on'):__('tables.status_off') }}</td>
            <td>
                <form action="{{ route('product_types.destroy',$productType->id) }}" method="POST">
                    <a class="btn btn-info" href="{{ route('product_types.show',$productType->id) }}">{{ __('tables.details') }}</a>
                    <a class="btn btn-primary" href="{{ route('product_types.edit',$productType->id) }}">{{ __('tables.edit') }}</a>
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">{{ __('tables.delete') }}</button>
                </form>
            </td>
        </tr>
        @endforeach

    </table>
    {!! $productTypes->links() !!}
@endsection
