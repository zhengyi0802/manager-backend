@extends('adminlte::page')

@section('title', __('distrobuters.title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('distrobuters.header') }}</h1>
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
    <form id="distrobuter-form" action="{{ route('distrobuters.update',$distrobuter->id) }}" method="POST" enctype="multipart/form-data">
        @method('PUT')
        @csrf
         <div class="row">
           <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group col-md-4">
                    <strong>{{ __('distrobuters.name') }} :</strong>
                    <input type="text" name="name" value="{{ $distrobuter->user->name }}" class="form-control" disabled>
                </div>
                <div class="form-group col-md-4">
                    <strong>{{ __('distrobuters.reseller') }} :</strong>
                    <input type="text" name="introducer" value="{{ $distrobuter->introducer->line_id }}" class="form-control">
                </div>
                <div class="form-group col-md-4">
                    <strong>{{ __('distrobuters.phone') }} :<span class="must">{{ __('tables.must') }}</span></strong>
                    <input type="text" name="phone" value="{{ $distrobuter->user->phone }}" class="form-control">
                </div>
                <div class="form-group col-md-4">
                    <strong>{{ __('distrobuters.line_id') }} :<span class="must">{{ __('tables.must') }}</span></strong>
                    <input type="text" name="line_id" value="{{ $distrobuter->user->line_id }}" class="form-control">
                </div>
                <div class="form-group col-md-4">
                    <strong>{{ __('distrobuters.email') }} :</strong>
                    <input type="text" name="email" value="{{ $distrobuter->user->email }}"
                     class="form-control" placeholder="user@email.com">
                </div>
                <div class="form-group col-md-4">
                    <strong>{{ __('distrobuters.password') }} :<span class="must">{{ __('tables.password') }}</span></strong>
                    <input type="password" name="newpassword" class="form-control">
                </div>
                <div class="form-group col-md-4">
                    <strong>{{ __('distrobuters.address') }} :<span class="must">{{ __('tables.must') }}</span></strong>
                    <input type="text" name="address" value="{{ $distrobuter->address }}" class="form-control">
                </div>
                <div class="form-group col-md-4">
                    <strong>{{ __('distrobuters.pidnumbers') }} :<span class="must">{{ __('tables.must') }}</span></strong>
                    <input type="text" name="pid" value="{{ $distrobuter->pid }}" class="form-control">
                </div>
                <div class="form-group col-md-4">
                    <strong>{{ __('distrobuters.pid_image_1') }} :</strong>
                    <input type="file" name="pid_image_1" class="form-control">
                </div>
                <div class="form-group col-md-4">
                    <img id="preview1" name="preview1">
                </div>
                <div class="form-group col-md-4">
                    <strong>{{ __('distrobuters.pid_image_2') }} :</strong>
                    <input type="file" name="pid_image_2" class="form-control">
                </div>
                <div class="form-group col-md-4">
                    <img id="preview2" name="preview2">
                </div>
                <script>
                    var loadImage1 = function(event) {
                        var output = document.getElementById('preview1');
                        output.src = URL.createObjectURL(event.target.files[0]);
                        output.onload = function() {
                           URL.revokeObjectURL(output.src) // free memory
                        }
                   };
                    var loadImage2 = function(event) {
                        var output = document.getElementById('preview2');
                        output.src = URL.createObjectURL(event.target.files[0]);
                        output.onload = function() {
                           URL.revokeObjectURL(output.src) // free memory
                        }
                   };
                </script>
                <div class="form-group col-md-4">
                    <strong>{{ __('distrobuters.bank') }} :</strong>
                    <input type="text" name="bank" value="{{ $distrobuter->bank }}" class="form-control">
                </div>
                <div class="form-group col-md-4">
                    <strong>{{ __('distrobuters.bank_name') }} :</strong>
                    <input type="text" name="bank_name" value="{{ $distrobuter->bank_name }}" class="form-control">
                </div>
                <div class="form-group col-md-4">
                    <strong>{{ __('distrobuters.account') }} :</strong>
                    <input type="text" name="account" value="{{ $distrobuter->account }}" class="form-control">
                </div>
                @if (auth()->user()->role <= App\Enums\UserRole::Manager)
                <div class="form-group col-md-4">
                    <strong>{{ __('distrobuters.bonus') }} : {{ __('tables.must') }}</strong>
                    <input type="number" name="bonus" value="{{ $distrobuter->bonus }}" class="form-control">
                </div>
                @endif
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>{{ __('distrobuters.memo') }}:</strong>
                    <textarea class="form-control" style="height:150px" name="memo" >{{ $distrobuter->memo }}</textarea>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>{{ __('distrobuters.status') }} : </strong>
                    <input type="radio" name="status" value="1" {{ ($distrobuter->status==1) ? "checked":null }} >{{ __('tables.status_on') }}
                    <input type="radio" name="status" value="0" {{ ($distrobuter->status!=1) ? "checked":null }} >{{ __('tables.status_off') }}
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
           },
           submitHandler: function(form) {
                form.submit();
           }
        });
    });
</script>
@section('plugins.jqueryValidation', true)

@endsection
