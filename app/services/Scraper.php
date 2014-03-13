<?php

class Scraper {
    public function __construct() {
    	
    }
    
    /**
     * Requests a scrape
     * 
     * The scraper daemon will pick up the request files for processing.
     */
    public function start($id) {
        
        // Get Account
        $sql = 'select * from portal_accounts where id = ?';
        $result = DB::select($sql, array($id));
        $account = $result[0];
        
        // Get Portal for Account
        $sql = 'select * from portals where id = ?';
        $result = DB::select($sql, array($account->portal_id));
        $portal = $result[0];
        
        $json['portal'] = $portal->portal_name;
        $json['uid'] = $account->uid;
        $json['pwd'] = $account->pwd;
        $json['path'] = $_SERVER["DOCUMENT_ROOT"] . "/files/scrapes/" . $portal->name . "/" . $account->uid;
        
        // Make sure write permissions are set for our daemon
        chmod($json['path'], 0777);
        
        // Get the form params and 
        // Loop through the fields, skipping ID.
        $fields = json_decode($portal->search_params);
        foreach ($fields as $k => $v) {
            if ($k == 'id')
                continue;
            
            $json[$k] = $v;
        }
        
        // Get current time
        
        // Write the request file to /temp (where the daemon will be waiting for it.
        $json['request_time'] = date('Ymd-H_i_s'); 
        $filename = '/temp/' . $json['request_time'] . '.request.json';
        $contents = json_encode($json);
        
        try {
            $fp = fopen($filename, 'w');
            fwrite($fp, $contents);
            fclose($fp);
        } catch (Exception $e) {
            $response['status'] = -1;
            $response['message'] = $e->getMessage();
            return $response;
        }
        
        $response['status'] = 1;
        $response['message'] = 'Scrape requested... Reload the page in a few minutes to see scraped file link.';
        return $response;
    }
    
    /**
     * Start the scraper for the ACCOUNT id passed
     */
    public function start_old ($id) {
    
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
            $path = $_SERVER["DOCUMENT_ROOT"] . "/files/scrapes/" . $portal->name . "/" . $account->uid;
                    $execStr .= " --path '" . $path . "' &";
    
    
                    // Execute it!
                            $response['execResult'] = `$execStr`;
    
                            $response['execStr'] = $execStr;
    
                            return $response;
    }
    
}