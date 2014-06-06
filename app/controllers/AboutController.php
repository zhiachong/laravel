<?php

class AboutController extends BaseController {
	
	public function showAbout($value='')
	{ 
		return View::make('about');
	}

	public function showInvestment()
	{
		return View::make('investment');
	}

	public function showTradingReport()
	{
		return View::make('tradingReport');
	}

	public function showFaq()
	{
		return View::make('faq');
	}

	public function showContact()
	{
		return View::make('contact');
	}
}
