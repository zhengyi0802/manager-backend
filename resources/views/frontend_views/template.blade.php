@extends('adminlte::page')

@section('title', __('frontend_views.title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('frontend_views.header') }}</h1>
@stop

@section('content')
    <style type="text/css">
      .view {
         width     : 100%;
         height    : 100%;
      }
      #topside {
            width  : 100%;
            height : 80px;
      }
      #block1 {
            text-align: center;
            vertical-align: middle;
            background-image : url('');
            width  : 15%;
            height : 100%;
            border : 1px #101010 solid;
            float  : left;
      }
      #block2 {
            text-align: center;
            vertical-align: middle;
            background-image : url('');
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
   <div id="view">
      <div id="topside">
          <div id="block1">
             {{ __('frontend_views.logo') }}
          </div>
          <div id="block2">
             {{ __('frontend_views.banner') }}
          </div>
          <div id="block3">
             {{ __('frontend_views.datetime') }}
          </div>
      </div>
      <div id="middleside">
          <div id="leftside">
              <div id="block4">
                 {{ __('frontend_views.logo2') }}
              </div>
              <div id="block7">
                 {{ __('frontend_views.advertisting') }}
              </div>
          </div>
          <div id="block5" class="block5">
             <h1> Video </h1>
          </div>
          <div id="rightside">
              <div id="block6">
                 {{ __('frontend_views.announce') }}
              </div>
              <div id="block8">
                 {{ __('frontend_views.app') }}1
              </div>
              <div id="block9">
                 {{ __('frontend_views.app') }}2
              </div>
              <div id="block10">
                 {{ __('frontend_views.app') }}3
              </div>
              <div id="block11">
                 {{ __('frontend_views.app') }}4
              </div>
              <div id="block12">
                 {{ __('frontend_views.app') }}5
              </div>
              <div id="block13">
                 {{ __('frontend_views.app') }}6
              </div>
              <div id="block14">
                 {{ __('frontend_views.app') }}7
              </div>
              <div id="block15">
                 {{ __('frontend_views.app') }}8
              </div>
              <div id="block16">
                 {{ __('frontend_views.app') }}9
              </div>
          </div>
      </div>
      <div id="bottomside">
          <div id="block17">
             {{ __('frontend_views.network') }}
          </div>
          <div id="block18">
             {{ __('frontend_views.marquee') }}
          </div>
          <div id="block19">
             {{ __('frontend_views.system') }}
          </div>
      </div>
    </div>
@endsection
