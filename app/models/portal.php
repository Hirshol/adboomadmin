<?php

class Portal extends Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'portals';

    /**
     * The validation rules
     * @var unknown
     */
    public static $rules = array(
            'name'=>'required|alpha|min:2',
            'url'=>'required|min:5',
    );
    
}