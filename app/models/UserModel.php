<?php

require_once __DIR__ . '/BaseModel.php';

class UserModel extends BaseModel
{
    protected  $name;
    protected $phone;
    protected $email;
    protected $region_id;
    protected $city_id;
    protected $township_id;
    protected $ward_id;
    protected $address;
    protected $password;
    protected $role_id;
    protected $created_at;
    protected $status_id;
    protected $otp_code;
    protected $otp_expiry;
    protected $security_code;
    protected $is_login;
    protected $user_type_id;
    protected $access_code;
    protected $vehicle_id;
    protected $created_by_agent;
}
