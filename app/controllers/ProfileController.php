<?php

class ProfileController extends BaseController
{
	public function getUser($username)
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

    public function postChangeProfile()
    {
        $validator = Validator::make(Input::all(),
                                     array(
                                         'stp' => 'min:6'
                                     ));

        if ($validator->fails())
        {
            return Redirect::route('home')
                           ->withErrors($validator);
        }
        else
        {
            $stp = Input::get('stp');
            $egoPay = Input::get('egopay');

            $user = User::find(Auth::user()->id);

            if ($user)
            {
                if (isset($egoPay))
                {
                    $user->egopay_acc = $egoPay;
                }

                if (isset($stp))
                {
                    $user->solidtrustpay_acc = $stp;
                }

                if ($user->save())
                {
                    return "Successfully saved";
                }
                else
                {
                    return "An error occurred while trying to save your changes. Please try again.";
                }
            }

        }

        return "Done";
    }
}