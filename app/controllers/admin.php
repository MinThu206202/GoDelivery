<?php

class Admin extends Controller
{

    private $db;
    public function __construct()
    {
        $this->db = new Database();
    }

    public function home()
    {
        $code = $this->db->getByRoleIdWithNames('users');
        $data = [
            'code' => $code
        ];
        $this->view('admin/home', $data);
    }

    public function deliveryhistory()
    {
        $this->view('admin/deliveryhistory');
    }

    public function managedelivery()
    {
        $this->view('admin/managedelivery');
    }

    public function agent_profile()
    {
        $this->view('admin/agent_profile');
    }

    public function agent()
    {
        $code = $this->db->getByRoleIdWithNames('users');
        // Each item in $code must include: name, email, city_name, access_code, status_name

        $data = [
            'code' => $code
        ];

        $this->view('admin/agent', $data);
    }

    public function profile()
    {
        $this->view('admin/profile');
    }
}
