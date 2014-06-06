@extends('layout.main')

@section('content')
	@if(Auth::check())
		<p>Hello, {{ Auth::user()->username }} </p>
	@else
		<p>You are not logged in.</p>
	@endif
@stop