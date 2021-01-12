@extends('adminlte::page')

@section('title', '朕臨首頁設計')

@section('content_header')
    <h1 class="m-0 text-dark">專案管理系統</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h1>專案</h1>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('projects.create') }}">新增專案</a>
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
            <th>編號</th>
            <th>專案名稱</th>
            <th>描述</th>
            <th>Mac位址</th>
            <th>狀態</th>
            <th>啟用時間</th>
            <th>終止時間</th>
            <th width="280px">動作</th>
        </tr>
        @foreach ($projects as $project)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $project->name }}</td>
            <td>{{ $project->detail }}</td>
            <td>{{ $project->mac_address }}</td>
            <td>{{ ($project->status==1) ? "啟用":"不啟用" }}</td>
            <td>{{ $project->start_datetime }}</td>
            <td>{{ $project->stop_datetime }}</td>
            <td>
                <form action="{{ route('projects.destroy',$project->id) }}" method="POST">
                    <a class="btn btn-info" href="{{ route('projects.show',$project->id) }}">詳情</a>
                    <a class="btn btn-primary" href="{{ route('projects.edit',$project->id) }}">編輯</a>
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">刪除</button>
                </form>
            </td>
        </tr>
        @endforeach

    </table>
    {!! $projects->links() !!}
@endsection
