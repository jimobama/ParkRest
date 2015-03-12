<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Database
 *
 * @author obaro
 */




class Database extends PDO {
    //put your code here
            //put your code here
      private $queryString="";
       public function __construct() {
       //connect to the server and to the specific database
           
            try
            {
                 parent::__construct("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USERNAME, DB_PASSWORD);
            }
            catch(PDOException $err)
            {
                $response =array();
                $response["Status"]="200";
                
                $error= array();
                $error["message"]= $err->getMessage();
                $error["code"]=$err->getCode();               
                $response["error"]= $error;  
                $json= json_encode($response);
                die("<pre>$json</pre>");
            }
       }//end functions
       
       public function createFields($name, $type, $constraints)
       {
           if(Validator::IsWord(trim($name)))
           {
                $fields ="$name  $type  $constraints";
                $this->buildQuery($fields);
           }
           
           
       }
       public function createTable($tablename)
       {
          $query= "Create Table If Not Exists $tablename (".$this->queryFields().")";        
         
          $stmt= $this->prepare($query);         
         $abool= $stmt->execute();
         if(!$abool)
         {
              print_r($stmt->errorInfo());
         }
        
       }
      
     function buildQuery($field)
     {
         if(is_string($field))
         {
             $this->queryString= $this->queryString."$field ,";
         }
     }
     function  queryFields()
       {
           $this->queryString = trim( $this->queryString,",") ;
           return  $this->queryString;
       }
       
     
}
