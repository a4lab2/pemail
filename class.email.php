<?php
class PEMAIL{
    private $email;
    //Have an error array to store errors
    function __construct($email)
    {   
        $this->email=$email;
        
    }
    //FILTER_SANTIZE_EMAIL first. Then use FILTER_VALIDATE_EMAIL
    public function isEmail($email){
        $sEmail=$this->sanitize($email);
        if($this->validateMail($email)){
            return true;
        }
        else{
            return false;
        }
    }
    public function getTld($email)
    {
        return $this->splitMail($email,2);
    }
    public function splitMail($email,$part)
    {
        if(isEmail($email)){
            $parts=explode('@',$email);
            $result=$parts[$part];
            return $result;
        }else{
            return "$email is not a valid email";
        }
    }
    public function getUsername($email)
    {
        return $this->splitMail($email,1);
    }

    public function checkTldDns($email)
    {
        $tld=$this->getTld($email);
        if(checkdnsrr($tld,"MX")){
            return true;
        }
        return false;
    }
    public function sanitize($email){
        $sanitized=filter_var($email, FILTER_SANITIZE_EMAIL);
        return $sanitized;
    }
    public function validateMail($email){
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        } else {
        return false;
        }
    }
}
