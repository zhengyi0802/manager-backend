@extends('adminlte::page')

@section('title', __('members.title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('members.header') }}</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h1>{{ __('tables.edit') }}</h1>
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
    <form id="member-form" action="{{ route('members.update',$member->id) }}" method="POST" enctype="multipart/form-data">
        @method('PUT')
        @csrf
         <div class="row">
           <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group col-md-4">
                    <strong>{{ __('members.introducer') }} :</strong>
                    {{ $member->introducer->name }}
                </div>
                <div class="form-group col-md-4">
                    <strong>{{ __('members.name') }} :</strong>
                    {{ $member->user->name }}
                </div>
                <div class="form-group col-md-4">
                    <strong>{{ __('members.phone') }} :<span class="must">{{ __('tables.must') }}</span></strong>
                    <input type="text" name="phone" value="{{ $member->user->phone }}" class="form-control">
                </div>
                <div class="form-group col-md-4">
                    <strong>{{ __('members.line_id') }} :<span class="must">{{ __('tables.must') }}</span></strong>
                    <input type="text" name="line_id" value="{{ $member->user->line_id }}" class="form-control">
                </div>
                <div class="form-group col-md-4">
                    <strong>{{ __('members.email') }} :<span class="must">{{ __('tables.must') }}</span></strong>
                    <input type="text" name="email" value="{{ $member->user->phone }}" class="form-control"
                     placeholder="user@email.com">
                </div>
           </div>
           <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>{{ __('members.address') }} :<span class="must">{{ __('tables.must') }}</span></strong>
                    <input type="text" name="address" value="{{ $member->user->line_id }}" class="form-control">
                </div>
           </div>
           <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group col-md-4">
                    <strong>{{ __('members.password') }} :<span class="must">{{ __('tables.password') }}</span></strong>
                    <input type="password" name="newpassword" class="form-control">
                </div>
                @if (auth()->user()->role == App\Enums\UserRole::Accounter)
                <div class="form-group col-md-4">
                    <strong>{{ __('members.pid_image_1') }} :</strong>
                    <input type="file" name="pid_image_1" class="form-control">
                </div>
                <div class="form-group col-md-4">
                    <strong>{{ __('members.pid_image_2') }} :</strong>
                    <input type="file" name="pid_image_2" class="form-control">
                </div>
                <div class="form-group col-md-4">
                    <strong>{{ __('members.creadit_card') }} :</strong>
                    <input type="text" name="creadit_card" value="{{ $member->creadit_card }}" class="form-control">
                </div>
                <div class="form-group col-md-4">
                    <strong>{{ __('members.creadit_expire') }} :</strong>
                    <input type="date" name="creadit_expire" value="{{ $member->creadit_expire }}" class="form-control">
                </div>
                @endif
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>{{ __('members.memo') }}:</strong>
                    <textarea class="form-control" style="height:150px" name="memo" >{{ $member->memo }}</textarea>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>{{ __('members.status') }} : </strong>
                    <input type="radio" name="status" value="1" {{ ($member->status==1) ? "checked":null }} >{{ __('tables.status_on') }}
                    <input type="radio" name="status" value="0" {{ ($member->status!=1) ? "checked":null }} >{{ __('tables.status_off') }}
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
        $('#member-form').validate({
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
               address: {
                  required: true,
                  minlength: 20
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
               address: {
                  required: '地址必填',
                  minlength: '地址格式錯誤'
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

