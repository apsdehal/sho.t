@extends('master')

@section('heading')
URL Shortener: aps.dev
@stop

@section('form')
	
	{{Form::open(array(
		'url'=>'/',
		'method'=>'post'
		))}}	
	{{Form::text('url',null,array('placeholder'=>'Your URL here',"autofocus"=>"autofocus"))}}
	{{--Form::submit('Short IT!')--}}	
	{{Form::close()}}
	
	@if($errors->count()>0)
	{{$errors->first('url','<p class="errors">:message</p>')}}
	@endif

@stop