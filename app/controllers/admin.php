<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once APPROOT . '/middleware/AuthMiddleware.php';
class Admin extends Controller
{

    private $db;
    public function __construct()
    {
        AuthMiddleware::adminOnly();
        $this->db = new Database();
    }

    public function home()
    {
        $allowedStatuses = ['Active', 'Inactive']; // Exclude 'Suspended'
        $allUserData = $this->db->getByRoleAndStatus('user_full_info', 'AGENT', $allowedStatuses);
        $alldeliveryData = $this->db->readAll('view_deliveries_detailed');
        $data = [
            'allUserData' => $allUserData,
            'allDeliveryData' => $alldeliveryData
        ];

        $this->view('admin/home', $data);
    }

    public function deliveryhistory()
    {

        $user = $this->db->readAll('view_deliveries_detailed');
        $data = [
            'alldeliverydata' => $user
        ];
        $this->view('admin/deliveryhistory', $data);
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

    public function pickuphistory()
    {
        $user = $this->db->readAll('pickup_requests_view');
        $data = [
            'pickups' => $user
        ];
        $this->view('admin/pickuphistory', $data);
    }

    public function pro()
    {
        $this->view('admin/pro');
    }

    public function access_code()
    {
        $allowedStatuses = ['Suspended']; // Exclude 'Suspended'
        $allUserData = $this->db->getByRoleAndStatus('user_full_info', 'AGENT', $allowedStatuses);

        $data = [
            'allUserData' => $allUserData
        ];
        $this->view('admin/access_code', $data);
    }

    public function route()
    {
        $code = $this->db->readAll('route_full_info');
        $data = [
            'allroutedata' => $code
        ];
        $this->view('admin/route', $data);
    }

    public function pickupagentlist()
    {
        $pickupagent = $this->db->readAll('user_full_info');
        $pickupAgentsOnly = array_filter($pickupagent, function ($user) {
            return isset($user['role_name']) && strtolower($user['role_name']) === 'pickup agent';
        });
        $data = [
            'pickupagent' => $pickupAgentsOnly,
        ];
        $this->view('admin/pickupagentlist', $data);
    }



    // public function search()
    // {
    //     $this->view('admin/search');
    // }

}