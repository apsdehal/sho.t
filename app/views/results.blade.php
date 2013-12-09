@extends('master')

@section('heading')

Your shortened URL is:
@stop
@section('form')

{{link_to(url($shortened))}}

@stop