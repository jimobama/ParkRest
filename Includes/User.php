<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of User
 *
 * @author obaro
 */
class User extends Object{
    
    public $firstname;
    public $lastname;
    public $gender;
    public $email;
    public $phone;
    public $id;
    
    private $password;
    
    function __construct() {
        $this->id = Validator::UniqueKey(10);
    }
    function setPassword($password)
    {
        $this->password=$password;
    }
    
    function getPassword()
    {
        return $this->password;
    }
    
   function validateLogin()
    {
       $okay=false;
        if (!Validator::IsEmail($this->email))
        {
           $this->setError("Invalid email format input"); 
        }else if(strlen(trim($this->password)) <=5)
        {
             $this->setError("Invalid password entry input"); 
        }else
        {
            $okay=true;
        }
        return $okay;
    }
    public function validated() {
        $okay=false;
        
        if(!Validator::IsWord(trim($this->firstname)))
        {
            $this->setError("Invalid firstname");
        }else if(!Validator::IsWord($this->lastname))
        {
            $this->setError("invalid lastname"); 
        }else if(!($this->gender =="m" || $this->gender=="f" || $this->gender==='o'))
        {
            $this->setError("Invalid gender input");
        }else if (!Validator::IsEmail($this->email))
        {
           $this->setError("Invalid email format input"); 
        }else if(!Validator::IsNumber($this->phone))
        {
             $this->setError("Invalid phone format input"); 
        }else
        {
            $okay=true;
        }
        
        return $okay;
    }

}
