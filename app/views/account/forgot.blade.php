@extends('layout.main')
@section('content')

<form action=" {{ URL::route('account-forgot-password-post') }}" method="POST">
	<div class="field">
		<label for="email">Email: </label>
		<input type="text" name="email" {{Input::old('email') ? 'value="' . e(Input::old('email')) . '"' : '' }}/>
		@if($errors->has('email'))
				{{ $errors->first('email') }}
		@endif
	</div>
	<input type="submit" value="Recover password" />
	{{ Form::token() }}
</form>

@stop