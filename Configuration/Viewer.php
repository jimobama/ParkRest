<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Viewer
 *
 * @author obaro
 */
class Viewer {
    //put your code here
    protected $content=null;
    
    function Display()
    {
      header("Content-Type:application/json");
      echo $this->content;  
    }
    
    function SetContent( $jsonObject=null)
    {
        if($jsonObject!=null && is_object($jsonObject) || is_array($jsonObject))
        {
           $this->content= json_encode($jsonObject);  
           return ;
        }
        $this->buildEmpty();       
       
    }
    
    
    
private function buildEmpty()
 {
     $this->content=  json_encode(array("status:200,value:"));
 }
    
}
