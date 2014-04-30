<?php

class AboutController extends BaseController {
	
	public function show($value='')
	{ 
		return View::make('about');
	}
}
