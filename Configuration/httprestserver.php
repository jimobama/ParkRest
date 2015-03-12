<?php

class HttpRestServer {
   
    private $requestHandler=null;
    
    
    function __construct($url=null) 
    {   
       $this->requestHandler= new HttpResquestHandler($url);
      
    }
    
    //The method handle the httprequest and the display Json contents
    public function Handle()
    {
     $this->requestHandler->Run();
     $response = new HttpResponseHandler($this->requestHandler);
     $viewer=  $response->GetAllJsonContentViewer();
     $viewer->Display(); 
    }
}
