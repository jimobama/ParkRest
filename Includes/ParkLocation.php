<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ParkLocation
 *
 * @author obaro
 */


class GeoPosition
{
    public $longtitude;
    public $latitude;
    
    function __construct($long,$lat) {
        $this->longtitude=$long;
        $this->latitude=$lat;
    }
    
}
class ParkLocation extends Object {
    //put your code here
    
    public $geolocation;
    public $streetname;
    public $streetImage;
    public $creator_id;
    public $parkUniqueId;
    
    
    function __construct()
    {  
       $this->parkUniqueId=Validator::UniqueKey(10);
    }
    
    function setLocation($long,$lat)
    {
        $this->geolocation= new GeoPosition($long,$lat);
    }

    public function validated() {
        $okay=false;
        
        
        return $okay;
    }

}
