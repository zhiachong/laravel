@extends('layout.main')

@section('content')
	Sign In Here
	<form action="{{ URL::route('account-sign-in-post') }}" method="post">
		
		<div class="field">
			Username: <input type="text" name="username" {{Input::old('username') ? 'value="' . e(Input::old('username')) . '"' : '' }} >
			@if($errors->has('username'))
				{{ $errors->first('username') }}
			@endif
		</div>
		<div class="field">
			Password: <input type="password" name="password" />
			@if($errors->has('password'))
				{{ $errors->first('password') }}
			@endif
		</div>
		<div class="field">
			<input type="checkbox" name="remember"/>
			<label for="remember">Remember me</label>
		</div>
	
		<input type="submit" value="Sign In"/>
		{{ Form::token() }}
	</form>
@stop