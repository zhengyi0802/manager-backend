@extends('adminlte::page')

@section('title', __('bulletinitems.title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('bulletinitems.header') }}</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h1>{{ __('bulletinitems.title') }}</h1>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('bulletinitems.create') }}">{{ __('tables.new') }}</a>
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
            <th>{{ __('bulletinitems.id') }}</th>
            <th>{{ __('bulletinitems.bulletin') }}</th>
            <th>{{ __('bulletinitems.type') }}</th>
            <th>{{ __('bulletins.status') }}</th>
            <th width="280px">{{ __('tables.action') }}</th>
        </tr>
        @foreach ($bulletinitems as $bulletinitem)
        <tr>
            <td>{{ $bulletinitem->id }}</td>
            <td>{{ $bulletinitem->bulletin }}</td>
            <td>
              @if ($bulletinitem->type == "image")
                  {{ __('bulletinitems.type_image') }}
              @elseif ($bulletinitem->type == "video")
                  {{ __('bulletinitems.type_video') }}
              @elseif ($bulletinitem->type == "youtube")
                  {{ __('bulletinitems.type_youtube') }}
              @endif
            </td>
            <td>{{ ($bulletinitem->status==1) ? __('tables.status_on'):__('tables.status_off') }}</td>
            <td>
                <form action="{{ route('bulletinitems.destroy',$bulletinitem->id) }}" method="POST">
                    <a class="btn btn-info" href="{{ route('bulletinitems.show',$bulletinitem->id) }}">{{ __('tables.details') }}</a>
                    <a class="btn btn-primary" href="{{ route('bulletinitems.edit',$bulletinitem->id) }}">{{ __('tables.edit') }}</a>
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">{{ __('tables.delete') }}</button>
                </form>
            </td>
        </tr>
        @endforeach

    </table>
    {!! $bulletinitems->links() !!}
@endsection
