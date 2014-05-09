@extends('layout.main')

@section('content')
	@if(Auth::check())
		<p>Hello, {{ Auth::user()->username }} </p>
	@else
		<p>Please login</p>
	@endif
@stop