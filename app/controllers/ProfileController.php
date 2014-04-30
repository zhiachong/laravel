<?php

class ProfileController extends BaseController
{
	public function user($username)
	{	
		$user = User::where('username', '=', $username);

		if ($user->count())
		{
			$user = $user->first();

			return View::make('profile.user')
			->with('user', $user);
		}

		return View::make('404')
		->with('username', $username);
	}
}