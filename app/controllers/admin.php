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
        $allowedStatuses = ['Active', 'Inactive']; // Exclude 'Suspended'
        $allUserData = $this->db->getByRoleAndStatus('user_full_info', 'AGENT', $allowedStatuses);

        $data = [
            'allUserData' => $allUserData
        ];

        $this->view('admin/home', $data);
    }

    public function deliveryhistory()
    {

        $user = $this->db->readAll('delivery_info');
        $data = [
            'alldeliverydata' => $user
        ];
        $this->view('admin/deliveryhistory',$data);
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
        $allowedStatuses = ['Active', 'Inactive']; // Exclude 'Suspended'
        $allUserData = $this->db->getByRoleAndStatus('user_full_info', 'AGENT', $allowedStatuses);

        $data = [
            'allUserData' => $allUserData
        ];
        $this->view('admin/agent', $data);
    }

    public function profile()
    {
        $this->view('admin/profile');
    }

    public function access_code()
    {
        $allowedStatuses = ['Suspended']; // Exclude 'Suspended'
        $allUserData = $this->db->getByRoleAndStatus('user_full_info', 'AGENT', $allowedStatuses);

        $data = [
            'allUserData' => $allUserData
        ];
        $this->view('admin/access_code',$data);
    }

    public function route()
    {
        $code = $this->db->readAll('route_full_info');
        $data = [
            'allroutedata' =>$code
        ];
        $this->view('admin/route',$data);
    }

}
