<?php

class MidssheetController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default User Controller
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
	
	public function __construct() {
		//$this->beforeFilter('csrf', array('on'=>'post'));
		$this->beforeFilter('auth');
	}
	
	public function getIndex() {
		$this->layout->content = View::make('midssheet.home');
	}
	
	
}