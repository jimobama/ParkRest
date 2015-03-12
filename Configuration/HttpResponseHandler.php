<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of HttpResponseHandler
 *
 * @author obaro
 */
class HttpResponseHandler {
    //put your code here
     private  $request=null;
     private $controller=null;
     private $action =null;
    function __construct(HttpResquestHandler &$handler) {
        $this->request= $handler;       
    }
    
    
    function GetAllJsonContentViewer()
    {
        $viewer = new JsonViewer();     
        $jsonObject= $this->_process();
        if($jsonObject ==null){
             $viewer->SetContent();
        }else
        {
             $viewer->SetContent($jsonObject);
        }
        return $viewer;
    }
    
    
private function _process()
    {
        if($this->request->IsValid())
        {
           $this->controller =$this->request->Controller();
           $this->action = $this->request->Action();
           return   $this->_run();
        }
        return array();
    }
    
   
private  function _run()
    {
    if(class_exists($this->controller))
        {
            $clsObject = new $this->controller();          
            if(is_object($clsObject))
            {
              return $this->_exec($clsObject);
            }
        }
        
        return array();
    }
    
 // return Array objects  
private function _exec($clsObject)
    {
         $method = new ReflectionMethod($this->controller,$this->action);
         $jsonObject =  $method->invokeArgs($clsObject, $this->request->Parameters());
         return $jsonObject;
    }


}
