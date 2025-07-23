<?php 

class UserModel{
    private $name;
    private $phone;
    private $email;
    private $region_id;
    private $city_id;
    private $township_id;
    private $ward_id;
    private $address;
    private $password;
    private $role_id;
    private $created_at;
    private $status_id;

    private $otp_code;
    private $otp_expiry;
    private $security_code;


    //call get and set for name
    public function setName($name){
        $this->name = $name;
    }

    public function getName(){
        return $this->name;
    }

    //call get and set for phone
    public function setPhone($phone){
        $this->phone = $phone;
    }

    public function getPhone(){
        return $this->phone;
    }

    //call get and set for email
    public function setEmail($email){
        $this->email = $email;
    }

    public function getEmail(){
        return $this->email;
    }

    //call get and set for region
    public function setRegion($region_id)
    {
        $this->region_id = $region_id;
    }

    public function getRegion()
    {
        return $this->region_id;
    }

    //call get and set for city
    public function setCity($city_id)
    {
        $this->city_id = $city_id;
    }

    public function getCity()
    {
        return $this->city_id;
    }

    //call get and set for township
    public function setTownship($township_id)
    {
        $this->township_id = $township_id;
    }

    public function getTownship()
    {
        return $this->township_id;
    }

    //call get and set for ward
    public function setWard($ward_id)
    {
        $this->ward_id = $ward_id;
    }

    public function getWard()
    {
        return $this->ward_id;
    }

    //call get and set for address
    public function setAddress($address)
    {
        $this->address = $address;
    }

    public function getAddress()
    {
        return $this->address;
    }

    //call get and set for password
    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getPassword()
    {
        return $this->password;
    }


    //call get and set for created_at
    public function setCreated_at($created_at)
    {
        $this->created_at = $created_at;
    }

    public function getCreated_at()
    {
        return $this->created_at;
    }

    //call get and set for status_id
    public function setStatus_id($status_id)
    {
        $this->status_id = $status_id;
    }

    public function getStatus_id()
    {
        return $this->status_id;
    }
    public function setRole_id($role_id)
    {
        $this->role_id = $role_id;
    }

    public function getRole_id()
    {
        return $this->role_id;
    }

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

    public function toArray(){
        return [
            "name" => $this->getName(),
            "phone" => $this->getPhone(),
            "email" => $this->getEmail(),
            "password" => $this->getPassword(),
            "region_id" => $this->getRegion(),
            "city_id" => $this->getCity(),
            "township_id" => $this->getTownship(),
            "ward_id" => $this->getWard(),
            "address" => $this->getAddress(),
            "created_at" => $this->getCreated_at(),
            "status_id" => $this->getStatus_id(),
            "role_id" => $this->getRole_id(),
            "otp_code" => $this->getOtp_code(),
            "otp_expiry" => $this->getOtp_expiry(),
            "security_code" => $this->getSecurity_code(),

        ];
    }


}

?>