<?php

class Scraper {
    public function __construct() {
    	
    }
    
    /**
     * Start the scraper for the ACCOUNT id passed
     */
    public function start ($id) {
        
        // Get Account
        $sql = 'select * from portal_accounts where id = ?';
        $result = DB::select($sql, array($id));
        $account = $result[0];
        
        // Get Portal for Account
        $sql = 'select * from portals where id = ?';
        $result = DB::select($sql, array($account->portal_id));
        $portal = $result[0];
        
        // Get the form params
        $fields = json_decode($portal->search_params);
        
        // Build a filename based on the following conventions:
        //   - public/files/scrapes/<portal>/<account>/<time>
        
        
        // Build the execution string
        // If we're on the server...
        $execStr = "";
        
        $result = exec("php -i | grep 'Host'");
        
        // Need this if we're running on the server
        if (preg_match('/x86_64-pc-linux-gnu/', $result) == 1) {
            $execStr .= "xvfb-run ";
        }
        
        // Put together call with uid & pwd
        // TODO: Determine scraper name by portal name
        //$execStr .= "python /Users/hirshol/scripts/scraper.py --uid " . $account->uid . " --pwd " . $account->password;
        $execStr .= "python scraper.py --uid " . $account->uid . " --pwd " . $account->password;
        
        // Loop through the fields, skipping id.
        foreach ($fields as $k => $v) {
            if ($k == 'id')
                continue;
            
            $execStr .= " --" . $k . " '" . $v . "'";
        }
        
        // Set the path
        $path = $_SERVER["DOCUMENT_ROOT"] . "/files/scrapes/" . $portal->name . "/" . $account->name;
        $execStr .= " --path '" . $path . "' &";
        
        
        // Execute it!
        $response['execResult'] = `$execStr`;
        
        $response['execStr'] = $execStr;
        
        return $response;
    }
}