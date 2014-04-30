<?php

class HomeController extends BaseController {
	public function showWelcome($value='')
	{ 
		return View::make('home');
	}
}
