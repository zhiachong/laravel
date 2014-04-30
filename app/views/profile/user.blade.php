@extends('layout.main')

@section('content')
	<i>
		Username:
	</i>
	<p>
		{{ $user->username }}
	</p>
	<i>
		Email:
	</i>
	<p>
		{{ $user->email }}
	</p>
@stop