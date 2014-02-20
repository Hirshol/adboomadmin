<?php

class PortalSearchParams {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'portals';
    
    public function loadPortal($id) {
        $sql = 'select id, search_params from portals where id = ?';
        $fieldsJSON = DB::select($sql, array($id));
        
        die(print_r($fieldsJSON));
    }

}