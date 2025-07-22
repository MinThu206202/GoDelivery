<?php

class SecurityCodeModel
{
    private $user_id;
    private $otp_code;
    private $otp_expiry;
    private $security_code;


    //call get and set for name
    public function setUser_id($user_id)
    {
        $this->user_id = $user_id;
    }

    public function getUser_id()
    {
        return $this->user_id;
    }

    //call get and set for phone
    public function setOtp_code($otp_code)
    {
        $this->otp_code = $otp_code;
    }

    public function getOtp_code()
    {
        return $this->otp_code;
    }

    //call get and set for email
    public function setOtp_expiry($otp_expiry)
    {
        $this->otp_expiry = $otp_expiry;
    }

    public function getOtp_expiry()
    {
        return $this->otp_expiry;
    }

    //call get and set for region
    public function setSecurity_code($security_code)
    {
        $this->security_code = $security_code;
    }

    public function getSecurity_code()
    {
        return $this->security_code;
    }

    public function toArray()
    {
        return [
            "user_id" => $this->getUser_id(),
            "otp_code" => $this->getOtp_code(),
            "otp_expiry" => $this->getOtp_expiry(),
            "security_code" => $this->getSecurity_code(),
        ];
    }
}
