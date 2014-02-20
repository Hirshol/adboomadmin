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
        $portals = DB::select('select * from portals');
        $this->layout->content = View::make('scraper.home', array('portals' => $portals));
    }
    
    /**
     * Gets all account for a portal
     */
    public function getPortalDetail() {
        
        $id = $_REQUEST['id'];
        $accounts = DB::select('select * from portal_accounts where portal_id = ?', array($id));
        $this->layout = View::make('scraper.portalDetail', 
                          array('accounts' => $accounts));
        $this->layout->searchForm = View::make('scraper.portal.mymerchinfo');
    }
    
    /**
     * Updates portal search form parameters
     */
    public function getPortalSearchForm() {
        $id = $_REQUEST['id'];
        $accounts = DB::select('select * from portal_accounts where portal_id = ?', array($id));
        $this->layout = View::make('scraper.portalDetail', array('accounts' => $accounts));
    }
    
    /**
     * Updates portal search form parameters
     */
    public function postPortalSearchForm() {
        //$id = $_REQUEST['id'];
        $portalSearchParams = new PortalSearchParams();
        $portalSearchParams->loadPortal('1');
        
        $accounts = DB::select('select * from portal_accounts where portal_id = ?', array($id));
        $this->layout = View::make('scraper.portalDetail', array('accounts' => $accounts));
    }
    
    /**
     * Gets all accounts for a portal
     */
    public function getAccounts() {
        $id = $_REQUEST['id'];
        $accounts = DB::select('select * from portal_accounts where portal_id = ?', array($id));
        $this->layout = View::make('scraper.accounts', array('accounts' => $accounts));
    }
    
    /**
     * Gets a single account
     */
    public function getAccount() {
        $id = $_REQUEST['id'];
        $account = DB::select('select * from portal_accounts where id = ?', array($id));
        $this->layout = View::make('scraper.account', array('account' => $account[0]));
    }
    
    /**
     * Retrieves the html display form for adding an account.
     *
     */
    public function getAddAccount() {
        die('addAccount');
    }
    
    /**
     * Performs the validation and updates the database.
     */
    public function postAddAccount() {
    
    }
    
    /**
     * This takes scraped data from our injected scraper and sends to processing.
     */
    public function postScrape() {
        
    }
}
