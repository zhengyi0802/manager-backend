@extends('adminlte::page')

@section('title', __('distrobuters.title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('distrobuters.header') }}</h1>
@stop

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h1>{{ __('tables.new') }}</h1>
        </div>
        @include('layouts.back')
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
<style>
  .error {
      color       : red;
      margin-left : 5px;
      font-size   : 12px;
  }
  label.error {
      display     : inline;
  }
  span.must {
      color     : red;
      font-size : 12px;
  }
</style>
<form id="distrobuter-form" action="{{ route('distrobuters.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
     <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group col-md-4">
                <strong>{{ __('distrobuters.reseller') }} :<span class="must">{{ __('tables.must') }}</span></strong>
                @if (auth()->user()->role == App\Enums\UserRole::Reseller)
                   <input type="text" name="introducer" value="{{ auth()->user()->line_id }}" class="form-control" disabled>
                @else
                   <input type="text" name="introducer" class="form-control">
                @endif
            </div>
            <div class="form-group col-md-4">
                <strong>{{ __('distrobuters.name') }} :<span class="must">{{ __('tables.must') }}</span></strong>
                <input type="text" name="name" class="form-control">
            </div>
            <div class="form-group col-md-4">
                <strong>{{ __('distrobuters.line_id') }} :<span class="must">{{ __('tables.must') }}</span></strong>
                <input type="text" name="line_id" class="form-control">
            </div>
            <div class="form-group col-md-4">
                <strong>{{ __('distrobuters.phone') }} :<span class="must">{{ __('tables.must') }}</span></strong>
                <input type="text" name="phone" class="form-control">
            </div>
            <div class="form-group col-md-4">
                <strong>{{ __('distrobuters.email') }} :<span class="must">{{ __('tables.must') }}</span></strong>
                <input type="text" name="email" class="form-control" placeholder="user@email.com">
            </div>
            <div class="form-group col-md-4">
                <strong>{{ __('distrobuters.address') }} :<span class="must">{{ __('tables.must') }}</span></strong>
                <input type="text" name="address" class="form-control">
            </div>
            <div class="form-group col-md-4">
                <strong>{{ __('distrobuters.password') }} :<span class="must">{{ __('tables.password') }}</span></strong>
                <input type="password" name="password" class="form-control">
            </div>
            <div class="form-group col-md-4">
                <strong>{{ __('distrobuters.pidnumbers') }} :<span class="must">{{ __('tables.must') }}</span></strong>
                <input type="text" name="pid" class="form-control">
            </div>
            <div class="form-group col-md-4">
                <strong>{{ __('distrobuters.bonus') }} :</strong>
                <input type="number" name="bonus" value="2500" class="form-control">
            </div>
            <div class="form-group">
                <strong>{{ __('managers.memo') }}:</strong>
                <textarea class="form-control" style="height:150px" name="memo" ></textarea>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">{{ __('tables.submit') }}</button>
        </div>
    </div>
</form>

<script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
<script>
    $(document).ready(function(){
        $('#distrobuter-form').validate({
           onkeyup: function(element, event) {
               var value = this.elementValue(element).replace(/^\s+/g, "");
               $(element).val(value);
           },
           rules: {
               name: {
                  required: true
               },
               phone: {
                  required: true
               },
               line_id: {
                  required: true
               },
               email: {
                  required: true,
                  email: true
               },
               password: {
                  required: true,
                  minlength: 8
               },
           },
           messages: {
               name: {
                  required: '姓名必填'
               },
               phone: {
                  required: '電話必填'
               },
               line_id: {
                  required: 'Line ID必填'
               },
               email: {
                  required: '電子信箱必填',
                  email: '電子信箱格式錯誤'
               },
               password: {
                  required: '密碼必須填寫',
                  minlength: '密碼設置至少8個字元'
               },
           },
           submitHandler: function(form) {
                form.submit();
           }
        });
    });
</script>
@section('plugins.jqueryValidation', true)

@endsection
