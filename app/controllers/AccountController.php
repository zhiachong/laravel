 <?php

class AccountController extends BaseController
{
	public function getRecovery($code)
	{
		$user = User::where('code', '=', $code);
		if ($user->count())
		{
			$user                = $user->first();
			$user->password      = $user->password_temp;
			$user->password_temp = '';
			$user->code          = '';

			if ($user->save())
			{
				return Redirect::route('home')
				->with('global', 'We successfully reset your password.');
			}
			else
			{
				return Redirect::route('home')
				->with('global', 'We could not save your new recovered account info');
			}
		}

		return Redirect::route('home')
		->with('global', 'We could not recover your account');
	}

	public function getForgotPassword()
	{
		return View::make('account.forgot');
	}

	public function postForgotPassword()
	{
		$validator = Validator::make(Input::all(),
			array(
				'email' => 'required|email'
				));

		if ($validator->fails())
		{
			return Redirect::route('account-forgot-password')
			->withErrors($validator)
			->withInput();
		}
		else
		{
			$email = Input::get('email');
			$user  = User::where('email', '=', $email);

			if ($user->count())
			{
				$user                = $user->first();
				$code                = str_random(60);
				$password            = str_random(10);

				$user->code          = $code;
				$user->password_temp = Hash::make($password);

				if ($user->save())
				{
					Mail::send('emails.auth.forgot', array(
					'link' => URL::route('account-recovery', $code),
					'username' => $user->username,
					'password' => $password
					),
					function($message) use ($user)
					{
						// user is accessibe
						$message->to(
							$user->email, // email to send to
							$user->username) // username
							->subject('Recover your account');
					});

					return Redirect::route('home')
					->with('global', 'We have sent you an email to recover your account');
				}
				else
				{
					return Redirect::route('home')
					->with('global', 'Some error occurred');
				}
			}
		}

		return Redirect::route('home')
		->with('global', 'We could not reset your password');
	}

	public function getChangePassword()
	{
		return View::make('account.password');
	}

	public function postChangePassword()
	{
		$validator = Validator::make(Input::all(),
			array(
				'oldPassword'   => 'required',
				'password'      => 'required|min:6',
				'passwordAgain' => 'required|same:password'
				));

		if ($validator->fails())
		{
			return Redirect::route('account-change-password')
			->withErrors($validator);
		}
		else
		{
			$user        = User::find(Auth::user()->id);

			$oldPassword = Input::get('oldPassword');
			$newPassword = Input::get('password');

			// check if old pwd matches current pwd
			if (Hash::check($oldPassword, $user->getAuthPassword()))
			{
				$user->password = Hash::make($newPassword);

				if ($user->save())
				{
					return Redirect::route('account-change-password')
		->with('global', 'Your password has been successfully changed');
				}
				else
				{
					return Redirect::route('account-change-password')
		->with('global', 'Your password cannot be saved.');
				}
			}
		}

		return Redirect::route('account-change-password')
		->with('global', 'Your password cannot be changed');
	}

	public function getSignIn()
	{
		return View::make('account.signin');
	}

	public function postSignIn()
	{
		# code...
		$validator = Validator::make(Input::all(),
			array(
				'username' => 'required',
				'password' => 'required'
				));

		if ($validator->fails())
		{
			return Redirect::route('account-sign-in')
			->withErrors($validator)
			->withInput();
		}
		else
		{
			$rememberMe = (Input::has('remember')) ? 1 : 0;

			$auth = Auth::attempt(array(
				'username' => Input::get('username'),
				'password' => Input::get('password'),
				'active' => 1
				), $rememberMe);

			if ($auth)
			{
				// Redirect to your intended page
				return Redirect::route('home');
			}
			else
			{
				return Redirect::route('account-sign-in')
				->with('global', 'Wrong username/password or account not activated. Please try again.');
			}
		}

		return Redirect::route('account-sign-in')
		->with('global', 'There was a problem signing you in. Have you activated?');
	}

	public function getSignOut()
	{
		if (Auth::check())
		{
			Auth::logout();
			return Redirect::route('account-sign-in')->with('global', 'You have been logged out.');
		}
        else
        {
            return Redirect::route('account-sign-in');
        }
	}

	public function getCreate()
	{
		return View::make('account.create');
	}

	public function postCreate()
	{
		$validator = Validator::make(Input::all(),
			array(
				'username' 			=> 'required|max:20|min:3|unique:users',
				'email' 			=> 'required|max:50|email|unique:users',
				'password' 			=> 'required|min:6',
				'password_again' 	=> 'required|same:password'
			)
		);

		if ($validator->fails())
		{
			return Redirect::route('account-create')
			->withErrors($validator)
			->withInput();
		}
		else
		{
			$email = Input::get('email');
			$username = Input::get('username');
			$password = Input::get('password');

			// Activation code
			$code = str_random(60);
			$user = User::create(array(
				'email' => $email,
				'username' => $username,
				'password' => Hash::make($password),
				'code' => $code,
				'active' => 0
				));

			if ($user)
			{
				// Send an email to the user
				Mail::send('emails.auth.activate', array(
					'link' => URL::route('account-activate', $code),
					'username' => $username
					),
				function($message) use ($user)
				{
					// user is accessibe
					$message->to(
						$user->email, // email to send to
						$user->username) // username
						->subject('Activate your account');
				});

				// send a variable and pass in the variable, global with the value for it
				return Redirect::route('home')
				->with('global', 'Your account has been created! We have sent you an email to activate your account');
			}
		}
	}

	public function getActivate($code)
	{
		$user = User::where('code', '=', $code)->where('active', '=', 0);
		if ($user->count())
		{
			$user = $user->first();

			$user->active = 1;
			$user->code = '';

			if ($user->save())
			{
				return Redirect::route('home')->with('global', 'We have successfully activated your account!');
			}
		}

		return Redirect::route('home')
		->with('global', 'We could not activate your account. Try again later.');
	}
}
