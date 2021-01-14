@extends('adminlte::page')

@section('title', __('frontend_views.title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('frontend_views.header') }}</h1>
@stop

@section('content')
    <style type="text/css">
      img {
         width  : 90%;
         height : 90%;
      }
      #view {
         width     : 100%;
         height    : 100%;
         background-image : url('images/background.png');
      }
      #topside {
            width  : 100%;
            height : 80px;
      }
      #block1 {
            text-align: center;
            vertical-align: middle;
            width  : 15%;
            height : 100%;
            border : 1px #101010 solid;
            float  : left;
      }
      #block2 {
            text-align: center;
            vertical-align: middle;
            width  : 70%;
            height : 100%;
            border : 1px #1010101 solid;
            float  : left;
      }
      #block3 {
            text-align: center;
            vertical-align: middle;
            background-image : url('');
            width  : 15%;
            height : 100%;
            border : 1px #101010 solid;
            float  : left;
      }
      #middleside {
            width  : 100%;
            height : 400px;
      }
      #leftside {
            width  : 15%;
            height : 400px;
            float  : left;
      }
      #rightside {
            width  : 15%;
            height : 400px;
            float  : left;
      }
      #block4 {
            text-align: center;
            background-image : url('');
            width  : 100%;
            height : 80px;
            border : 1px #101010 solid;
      }
      #block5 {
            text-align: center;
            width  : 70%;
            height : 400px;
            border : 1px #101010 solid;
            background-color : #101010;
            color : #F0F0F0;
            float  : left;
      }
      #block6 {
            text-align: center;
            background-image : url('');
            width  : 100%;
            height : 80px;
            border : 1px #101010 solid;
            float  : left;
      }
      #block7 {
            text-align: center;
            backgroud-image : url('');
            width  : 100%;
            height : 320px;
            border : 1px #101010 solid;
      }
      #block8 {
            text-align: center;
            background-image : url('');
            width  : 33%;
            height : 26%;
            border : 1px #101010 solid;
            float  : left;
      }
      #block9 {
            text-align: center;
            background-image : url('');
            width  : 33%;
            height : 26%;
            border : 1px #101010 solid;
            float  : left;
      }
      #block10 {
            text-align: center;
            background-image : url('');
            width  : 33%;
            height : 26%;
            border : 1px #101010 solid;
            float  : left;
      }
      #block11 {
            text-align: center;
            background-image : url('');
            width  : 33%;
            height : 26%;
            border : 1px #101010 solid;
            float  : left;
      }
      #block12 {
            text-align: center;
            background-image : url('');
            width  : 33%;
            height : 26%;
            border : 1px #101010 solid;
            float  : left;
      }
      #block13 {
            text-align: center;
            background-image : url('');
            width  : 33%;
            height : 26%;
            border : 1px #101010 solid;
            float  : left;
      }
      #block14 {
            text-align: center;
            background-image : url('');
            width  : 33%;
            height : 26%;
            border : 1px #101010 solid;
            float  : left;
      }
      #block15 {
            text-align: center;
            background-image : url('');
            width  : 33%;
            height : 26%;
            border : 1px #101010 solid;
            float  : left;
      }
      #block16 {
            text-align: center;
            background-image : url('');
            width  : 33%;
            height : 26%;
            border : 1px #101010 solid;
            float  : left;
      }
      #bottomside {
            width  : 100%;
            height : 80px;
      }
      #block17 {
            text-align: center;
            background-image : url('');
            width  : 15%;
            height : 100%;
            border : 1px #101010 solid;
            float  : left;
      }
      #block18 {
            text-align: center;
            background-image : url('');
            width  : 70%;
            height : 100%;
            border : 1px #101010 solid;
            float  : left;
      }
      #block19 {
            text-align: center;
            background-image : url('');
            width  : 15%;
            height : 100%;
            border : 1px #101010 solid;
            float  : left;
      }
   </style>
   <div id="view" name="view">
      <div id="topside">
          <div id="block1">
             <img src="images/block01.png">
          </div>
          <div id="block2">
             <img src="images/block02.png">
          </div>
          <div id="block3">
             <img src="images/block03.png">
          </div>
      </div>
      <div id="middleside">
          <div id="leftside">
              <div id="block4">
                 <img src="images/block04.png">
              </div>
              <div id="block7">
                 <img src="images/block07.png">
              </div>
          </div>
          <div id="block5" class="block5">
              <img src="images/block05.png">
          </div>
          <div id="rightside">
              <div id="block6">
                 <img src="images/block06.png">
              </div>
              <div id="block8">
                 <img src="images/block08.png">
              </div>
              <div id="block9">
                 <img src="images/block09.png">
              </div>
              <div id="block10">
                 <img src="images/block10.png">
              </div>
              <div id="block11">
                 <img src="images/block11.png">
              </div>
              <div id="block12">
                 <img src="images/block12.png">
              </div>
              <div id="block13">
                 <img src="images/block13.png">
              </div>
              <div id="block14">
                 <img src="images/block14.png">
              </div>
              <div id="block15">
                 <img src="images/block15.png">
              </div>
              <div id="block16">
                 <img src="images/block16.png">
              </div>
          </div>
      </div>
      <div id="bottomside">
          <div id="block17">
             <img src="images/block17.png">
          </div>
          <div id="block18">
             <img src="images/block18.png">
          </div>
          <div id="block19">
             <img src="images/block19.png">
          </div>
      </div>
    </div>
@endsection
