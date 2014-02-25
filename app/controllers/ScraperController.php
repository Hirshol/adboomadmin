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
    
    /**
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
        
        // Get the portal's search form
        // This will be different for each portal
        $psp = new PortalSearchParams();
        $psp->load($_GET['id']);
        $this->layout->searchForm = View::make('scraper.portal.mymerchinfo', (array)$psp);
    }
    
    /**
     * Updates portal search form parameters
     * 
     * Warning: AJAX ONLY
     */
    public function postPortalSearchForm() {
        
        // Otherwise, perform validation and update db record
        $psp = new PortalSearchParams();
        
        foreach ($_POST as $k => $v) {
            if(substr($k, 0, 1) == '_')
                continue;
            $psp->$k = $v;
        }
        
        $psp->save();
        
        $response['message'] = 'Record Saved';
        return json_encode($response);
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
        $account = $account{0};
        
        // Get the portal
        $portal = DB::select('select * from portals where id = ?', array($account->portal_id));
        $portal = $portal{0};
        
        // Create filepath to scrape files
        $filepath = "files/scrapes/" . $portal->name . "/" . $account->name;
        
        if (!file_exists($filepath))
            mkdir($filepath, 0777, true);

        // Get the directory listing of previous scrapes
        $scrapeFiles = array();
        if ($handle = opendir($filepath)) {
            while (false !== ($entry = readdir($handle))) {
                if(!preg_match('/^[.]{1,2}$/', $entry)) {
                    $scrapeFiles[] = $entry;
                }
            }
        }
        
        // Get the list of scrape files for this account
        $this->layout = View::make('scraper.account', array('account' => $account, 
                                'filepath' => $filepath,
                                'scrapeFiles' => $scrapeFiles));
        
    }
    
    public function getDownloadScrape() {
        
        $headers = array(
                'Content-Type: text/plain',
        );
        return Response::download($_GET['file'], '', $headers);
    }
    
    /**
     * Retrieves the html display form for adding an account.
     *
     */
    public function getAddAccount() {
        
    }
    
    /**
     * Performs the validation and updates the database.
     */
    public function postAddAccount() {
    
    }
    
    /**
     * This starts the manual scraping for an account
     * 
     * AJAX ONLY
     */
    public function postScrape() {
        // Launch the scraper
        $scraper = new Scraper();
        $response = $scraper->start($_POST['id']);
        
        return json_encode($response);
    }
}
