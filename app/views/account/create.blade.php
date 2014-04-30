@extends('layout.main')

@section('content')
	Create Account Here
	<form action="{{ URL::route('account-create-post') }}" method="post">
		
		<div class="field">
			Username: <input type="text" name="username" {{Input::old('username') ? 'value="' . e(Input::old('username')) . '"' : '' }} >
			@if($errors->has('username'))
				{{ $errors->first('username') }}
			@endif
		</div>
		<div class="field">
			Email: <input type="text" name="email" {{Input::old('email') ? 'value="' . e(Input::old('email')) . '"' : '' }} />
			@if($errors->has('email'))
				{{ $errors->first('email') }}
			@endif
		</div>
		<div class="field">
			Password: <input type="password" name="password" />
		</div>
		<div class="field">
			Confirm password: <input type="password" name="password_again" />
		</div>

		<input type="submit" value="Sign Up"/>
		{{ Form::token() }}
	</form>
@stop