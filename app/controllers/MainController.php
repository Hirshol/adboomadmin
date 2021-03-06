<?php

class MainController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/
	
	protected $layout = "layouts.main";
	
	public function getIndex()
	{
		$this->layout->content = View::make('hello');
		
	}
	
	public function getInfo()
	{
		$this->layout->content = View::make('info');
		
	}
}