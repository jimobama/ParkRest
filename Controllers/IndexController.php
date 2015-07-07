<?php

require_once("Controllers/IController.php");
require_once("Configuration/JsonViewer.php");


class IndexController implements IController {
    //put your code here
    private $db;
    function __construct() {
       
       
     }
    
      function Index()
      {
      $jsonViewer = new    JsonViewer();
      
      $response["name"]= array();
       $jsonViewer->SetContent($response) ;     
        
      
      
      
      
      return  $jsonViewer; 
      }
      
  
     
}
