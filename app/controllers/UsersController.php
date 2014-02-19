<?php

class UsersController extends BaseController {

    /*
    |--------------------------------------------------------------------------
    | Default User Controller
    |--------------------------------------------------------------------------
    |
    | You may wish to use controllers instead of, or in addition to, Closure
    | based routes. That's great! Here is an example controller method to
    | get you started. To route to this controller, just add the route:
    |
    |    Route::get('/', 'HomeController@showWelcome');
    |
    */

    protected $layout = "layouts.main";
    
    public function __construct() {
        //$this->beforeFilter('csrf', array('on'=>'post'));
        $this->beforeFilter('auth', array('only'=>array('getDashboard')));
    }
    
    public function getIndex() {
        $this->layout->content = View::make('users.login');
    }
    
    public function getLogin() {
        $this->layout->content = View::make('users.login');
    }
    
    public function postSignin() {
        if (Auth::attempt(array('email'=>Input::get('email'), 'password'=>Input::get('password')))) {
            return Redirect::to('/dashboard/')->with('message', 'You are now logged in!');
        } else {
            return Redirect::to('/users/login')
            ->with('message', 'Your username/password combination was incorrect')
            ->withInput();
        }
    }
    
    public function getLogout() {
        Auth::logout();
        return Redirect::to('/users/login')->with('message', 'Your are now logged out!');
    }
    public function getRegister() {
        $this->layout->content = View::make('users.register');
    }
    
    /*
     * Return the user registration form
     */
    public function postCreate()
    {
        $validator = Validator::make(Input::all(), User::$rules);
        
        if ($validator->passes()) {
            // validation has passed, save user in DB
            $user = new User;
            $user->firstname = Input::get('firstname');
            $user->lastname = Input::get('lastname');
            $user->email = Input::get('email');
            $user->password = Hash::make(Input::get('password'));
            $user->save();
            
            return Redirect::to('/users/login')->with('message', 'Thanks for registering!');
            
        } else {
            // validation has failed, display error messages
            return Redirect::to('/users/register')->with('message', 'The following errors occurred')->withErrors($validator)->withInput();
        }
    }
}



