@extends('layout.main')

@section('content')
	<form action=" {{ URL::route('account-change-password-post') }} " method="POST">
		<div class="field">
			Old password: <input type="password" name="oldPassword"/>
			@if($errors->has('oldPassword'))
				{{ $errors->first('oldPassword') }}
			@endif
		</div>
		<div class="field">
			New password: <input type="password" name="password" />
			@if($errors->has('password'))
				{{ $errors->first('password') }}
			@endif
		</div>
		<div class="field">
			New password again: <input type="password" name="passwordAgain" />
			@if($errors->has('passwordAgain'))
				{{ $errors->first('passwordAgain') }}
			@endif
		</div>
		<input type="submit" value="Change password" />
		{{ Form::token() }}
	</form>
@stop