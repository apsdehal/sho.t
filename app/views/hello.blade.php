@extends('master')

@section('heading')
URL Shortener: aps.dev
@stop

@section('form')
	
	{{Form::open(array(
		'url'=>'/',
		'method'=>'post'
		))}}
	{{Form::label('url','Your URL')}}	
	{{Form::text('url',null,array('placeholder'=>'Your long URL here'))}}
	{{Form::submit('Short IT!')}}	
	{{Form::close()}}
	{{'<br/>'}}
	
	@if($errors->count()>0)
	{{$errors->first('url')}}
	@endif	

@stop