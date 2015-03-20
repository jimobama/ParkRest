<?php

class IndexController {
    //put your code here
    private $db;
    function __construct() {
       $this->db = new Database();
       
       //create the table if not exist
       $this->db->createFields("firstname", "varchar(20)", "");
       $this->db->createFields("lastname", "varchar(20)", "");
       $this->db->createFields("id", "varchar(11)", "Primary key");
       $this->db->createFields("gender", "varchar(2)", "");
       $this->db->createFields("active", "int", "");
       $this->db->createFields("email", "varchar(50)", "");
       $this->db->createFields("phone", "varchar(16)", "unique");
       $this->db->createFields("code", "varchar(20)", "not null");
        $this->db->createFields("password", "varchar(50)", "not null");
       $this->db->createFields("date_registered", "varchar(50)", "");
       //create the table
       $this->db->createTable("tbl_user");
       
       include_once ("Includes/User.php");
       include_once("Models/UserModel.php");
       
    }
    
      function Index()
      {
          return  null;
      }
      
   
      function Login($username,$password)
      {
                
          $response = array();
          $response["success"]="0";         
          $userdb= new User();
          $userdb->email=$username;
          $userdb->setPassword($password);
          
          if($userdb->validateLogin())
          {
              $model = new UserModel($userdb,$this->db);
              if($model->IsAccountExists())
              {
                 $userdb= new User();
                 $userdb=  $model->GetUser(); 
                
                 $response["content"]="user exists";
                
              }else
              {
               $response["success"]="-1";   
               $response["content"]="username or password does not exists";
                            
              
              }
          }  else {
              $response["success"]="-1";
              $response["content"]=$userdb->getError();
             
          }
                   
          
          return $response;
      }
      
      function Update($id,$firstname,$lastname,$gender,$email,$phone)
      {
         $response["success"]="0";
        $response["content"]="";
        $response["message"]="";
          $user = new User();
          $user->firstname= $firstname;
          $user->lastname=$lastname;
          $user->gender = $gender;
          $user->email=$email;
          $user->phone=$phone;
          $user->id=$id;
          $response= array();
          if($user->validated())
          {
              
              $model= new UserModel($user);
              if($model->IsExists())
              {
                 $status= $model->Update($id, $user);
                 if($status)
                 {
                   
                    $response["message"]="Account information successfully updated";
                 }  else {
                    $response["success"] =-1;
                    $response["message"]="Re-send this request again ,if presist contact administrator";
                 }
                  
              }  else {
                    $response["success"] =-1;
                    $response["message"]="Error request not account with the give  $user->email";
              }
          }  else {
               $response["success"] =-1;
              $response["message"]=$user->getError();
          }
          
         return $response; 
      }
      
      
      
      function Search($id,$firstname,$lastname,$gender,$email,$phone)
      {
          $response["success"]="0";
          $response["content"]="";
          $response["message"]="";
          
          $user = new User();
          $user->firstname= $firstname;
          $user->lastname=$lastname;
          $user->gender = $gender;
          $user->email=$email;
          $user->phone=$phone;
          $user->id=$id; 
          $response= array();
          
         
         $model = new UserModel($user,$this->db);
         $content = $model->Search( $user);       
         $response["content"]= $content;
                
           
         
          
        return  $response; 
          
      }
      
      
      function Create($email,$password,$firstname,$lastname,$gender,$phone)
      {
          
          $response = array();  
          $response["success"]="0";
          $response["content"]="";
          $response["message"]="";
          $user = new User();
          $user->firstname= $firstname;
          $user->lastname=$lastname;
          $user->gender = $gender;
          $user->email=$email;
          $user->phone=$phone;
          $user->setPassword($password);
          if($user->validated())
          {
          
            $model = new UserModel($user,$this->db);
            if(!$model->IsExists())
            {
                $abool = $model->Create();
              
                if($abool)
                {
                     $response["success"]=1;
                     $response["content"]  =  $user;
                     $response["message"] = "user account successfully created";
                }else
                {
                    $response["success"]=0;
                    $response["content"]="";
                    $response["message"]=$model->getError();
                    
                }
            }
            else
            {            
                $user= $model->GetUser();
                $response["success"]=0;
                $response["content"]=$user;             
                $response["message"]="user already exist in database";
            }
          }else{
                
                $response["success"]=0;
                $response["content"]=$user->getError();             
              
          }
          
          return $response;
      }
}
