<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once APPROOT . '/middleware/AuthMiddleware.php';

class Agent extends Controller
{

    private $db;
    private $agent;
    public function __construct()
    {
        AuthMiddleware::agentOnly();
        $this->db = new Database();
        $this->agent = $_SESSION['user'];
    }

    public function home()
    {
        $delivery = $this->db->columnFilterAll('view_deliveries_detailed', 'sender_agent_id', $this->agent['id']);
        $data = [
            'delivery' => $delivery,
        ];
        $this->view('agent/home', $data);
    }

    public function incoming()
    {
        $status = ['Delivered', 'In Transit', 'Cancelled', 'Returned'];
        $delivery = $this->db->getByDeliveryIdAndStatuses('view_deliveries_detailed',  $this->agent['id'], $status);
        // $delivery = $this->db->columnFilterAll('view_deliveries_detailed', 'receiver_agent_id', $this->agent['id']);

        $data = [
            'delivery' => $delivery,
        ];
        $this->view('agent/incoming', $data);
    }

    public function mydelivery()
    {
        $delivery = $this->db->columnFilterAll('view_deliveries_detailed', 'sender_agent_id', $this->agent['id']);
        $data = [
            'delivery' => $delivery,
        ];
        $this->view('agent/mydelivery', $data);
    }

    public function profile()
    {
        $this->view('agent/profile');
    }


    public function getCitiesByRegion()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $regionId = $_GET['region_id'] ?? null;
            if ($regionId) {
                $cities = $this->db->columnFilterAll('cities', 'region_id', $regionId);
                echo json_encode($cities);
            }
        }
    }

    public function getTownshipsByCity()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $cityId = $_GET['city_id'] ?? null;
            if ($cityId) {
                $townships = $this->db->columnFilterAll('townships', 'city_id', $cityId);
                echo json_encode($townships);
            }
        }
    }



    public function voucher()
    {
        $getregion = $this->db->readAll('regions');
        $data = [
            'region' => $getregion
        ];
        $this->view('agent/voucher', $data);
    }

    public function notification()
    {
        $noti = $this->db->getNotificationsByAgentId($this->agent['id']);
        $data = [
            'noti' => $noti
        ];

        $this->view('agent/notification', $data);
    }

    public function request()
    {
        $status = ['Awaiting Acceptance'];
        $accept = $this->db->getByDeliveryIdAndStatuses('view_deliveries_detailed', $this->agent['id'], $status);
        $data = [
            "request_delivery" => $accept
        ];
        // var_dump($data);
        // die();
        $this->view('agent/request', $data);
    }

    public function available_route()
    {
        $township = $this->db->columnFilter('townships', 'id', $this->agent['township_id']);
        $available_route = $this->db->columnFilterAll('route_full_info', 'from_township', $township['name']);
        $data = [
            'available_routes' => $available_route
        ];
        $this->view('agent/available_route', $data);
    }

    public function update_status()
    {
        $this->view('agent/update_status');
    }

    public function result()
    {
        $this->view('agent/result');
    }

    public function pickup()
    {
        $allpickup = $this->db->readAll('pickup_requests_view');

        $filteredPickup = array_filter($allpickup, function ($pickup) {
            return $pickup['agent_id'] == $this->agent['id'];
        });
        $data = [
            'pickup_requests' => $filteredPickup,
        ];
        $this->view('agent/pickuprequest', $data);
    }

    public function pickup_detail()
    {
        $request_code = $_GET['request_code'];
        $alldata = $this->db->columnFilter('pickup_requests_view', 'request_code', $request_code);
        $data = [
            'pickup' => $alldata,
        ];
        $this->view('agent/pickuprequestdetail', $data);
    }

    public function action()
    {
        $request_code = $_GET['request_code'];
        $allrequestdata = $this->db->columnFilter('pickup_requests_view', 'request_code', $request_code);
        $checkadmin = $this->db->columnFilter('user_full_info', 'id', $allrequestdata['agent_id']);
        $checklocation = $this->db->columnFilter('view_available_locations', 'township_name', $allrequestdata['receiver_township']);
        $checkroute = $this->db->checkroutename('route_full_info', $allrequestdata['sender_township'], $allrequestdata['receiver_township']);
        $data = [
            'pickup' => $allrequestdata,
            'admin' => $checkadmin,
            'location' => $checklocation,
            'route' => $checkroute,
        ];
        // var_dump($checklocation);
        // var_dump($checkroute);
        // die();
        $this->view('agent/pickuprequestaction', $data);
    }

    public function edit_pickup()
    {
        $request_code = $_GET['request_code'];
        $allrequestdata = $this->db->columnFilter('pickup_requests_view', 'request_code', $request_code);
        $checkadmin = $this->db->columnFilter('user_full_info', 'id', $allrequestdata['agent_id']);
        $checklocation = $this->db->columnFilter('view_available_locations', 'township_name', $allrequestdata['receiver_township']);
        $checkroute = $this->db->checkroutename('route_full_info', $allrequestdata['sender_township'], $allrequestdata['receiver_township']);
        $availablepickupagent = $this->db->columnFilterAll('users', 'created_by_agent', $this->agent['id']);
        $data = [
            'pickup' => $allrequestdata,
            'admin' => $checkadmin,
            'location' => $checklocation,
            'route' => $checkroute,
            'availableAgents' => $availablepickupagent,
        ];
        $this->view('agent/pickupaction', $data);
    }

    public function pickupagentlist()
    {
        $allUsers = $this->db->readAll('user_full_info');
        $agentId = $this->agent['id'] ?? 0;
        $pickupAgents = array_filter($allUsers, function ($user) use ($agentId) {
            return $user['role_name'] === 'Pickup Agent' && $user['created_by_agent'] == $agentId;
        });
        $data = [
            'pickupAgents' => $pickupAgents
        ];
        $this->view('agent/pickupagentlist', $data);
    }

    public function addpickupagent()
    {
        $this->view('agent/pickupagentadd');
    }

    public function pickupagentdetail()
    {
        $access_code = $_GET['access_code'];
        $pickupagent = $this->db->columnFilter('user_full_info', 'access_code', $access_code);
        $data = [
            'pickupagent' => $pickupagent,
        ];
        $this->view('agent/pickupagentdetail', $data);
    }
}
