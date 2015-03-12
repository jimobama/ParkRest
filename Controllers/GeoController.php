<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of GeoController
 *
 * @author obaro
 */
class GeoController  {
    //put your code here
    
 private    $db=null;
 
 function __construct() {
       $this->db = new Database();       
       //create the table if not exist
       $this->db->createFields("geo_long", "varchar(10)", "");
       $this->db->createFields("geo_lat", "varchar(10)", "");
       $this->db->createFields("streetname", "varchar(11)","");
       $this->db->createFields("creatorId", "varchar(20)", "");
       $this->db->createFields("approval_count", "int", "");
       $this->db->createFields("status", "int", "");
        $this->db->createFields("image_path", "varchar(50)", "");
       $this->db->createFields("id", "varchar(16)", "primary key");      
       $this->db->createFields("add_registered", "varchar(50)", "");
       //create the table
       $this->db->createTable("tbl_parklocation");
       
       include_once ("Includes/ParkLocation.php");
      // include_once("Models/UserModel.php");
 }
 
 
   function Index()
   {
       return "";
   }
}
