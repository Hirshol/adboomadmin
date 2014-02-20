<?php

class PortalSearchParams {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'portals';
    public $fields;
    
    public function __construct() {
        $this->fields = new stdClass();
    }
    
    public function load($id) {
//         $sql = 'select id, search_params from portals where id = ?';
//         $recs = DB::select($sql, array($id));
//         $rec = $recs[0];
//         $fv = new stdClass();
//         $fv = json_decode($rec->search_params);
        
        // TODO: When we're saving form data to the database, use the above
        // code, but for now let's hard code to get the page working.
        // TODO: keep more information with the field, like sort order, label, input type, etc.
        // REFER TO LARAVEL FORMS FOR FORM DOCUMENTATION AND WHY WE'RE KEEPING DATA IN THIS FORMAT.
        // We can probably just use the Laravel elements
        
        $field = array('type' => 'text',
                        'attr' => array('class' => 'input-block-level', 
                                         'placeholder'=>'Max Records'),
                        'label' => 'Max Records');
        
        $this->fields->max_records = $field;
        
        $field = array('type' => 'text',
                'attr' => array('class' => 'input-block-level',
                                'placeholder'=>'Start Date',
                                'data-role'=>'date'),
                'label' => 'Max Records',
                'value' => '1/1/2014');
        
        $this->fields->start_date = $field;
        
        
    }
    
    public function form() {
        $html = Form::open(array('url'=>'scraper/portal-search-form/', 'class'=>'form-search'));
        
        foreach ($this->fields as $field => $params) {
            
            
        }
        
        
    }
    public function save() {
        
    }
    
}