<?php

class ScraperController extends BaseController {

    /*
    |--------------------------------------------------------------------------
    | Scraper Controller
    |--------------------------------------------------------------------------
    |
    |
    */

    protected $layout = "layouts.main";
    
    public function __construct() {
        //$this->beforeFilter('csrf', array('on'=>'post'));
        $this->beforeFilter('auth');
    }
    
    /*
     * Gets the portal and merchant list.
     * Merchant list might trigger on open for speed
     */
    public function getIndex() {
        $portal = new Portal();
        $portals = DB::select('select * from portals');
        $this->layout->content = View::make('scraper.home', array('portals' => $portals));
    }
    
    public function getAccounts() {
        $id = $_REQUEST['id'];
        $accounts = DB::select('select * from portal_accounts where portal_id = ?', array($id));
        $this->layout = View::make('scraper.accounts', array('accounts' => $accounts));
    }
}
