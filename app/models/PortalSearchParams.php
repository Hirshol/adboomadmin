<?php

class PortalSearchParams {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    public $id;
    
    /**
     * Gets the form field values from the database
     * @param unknown $id
     */
    public function load($id) {
        $this->id = $id;
        
        // Get params from db
        $sql = 'select * from portals where id = ?';
        $recs = DB::select($sql, array($id));
        $params = $recs{0}->search_params;
        
        // Convert them to this object's properties
        // you could to $this = json_decode($params)...
        $params = json_decode($params);
        foreach($params as $k => $v) {
            $this->$k = $v;
        }
    }
    
    /**
     * Save form values as JSON in our database.
     */
    public function save() {
        $params = json_encode($this);
        $sql = 'update portals set search_params = ? where id = ?';
        DB::update($sql, array($params, $this->id));
    }
}
