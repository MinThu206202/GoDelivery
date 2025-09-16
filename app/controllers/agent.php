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
        $pickup = $this->db->columnFilterAll('pickup_requests_view', 'agent_id', $this->agent['id']);
        $delivery = $this->db->columnFilterAll('view_deliveries_detailed', 'sender_agent_id', $this->agent['id']);
        $data = [
            'pickup_requests' => $pickup,
            'delivery' => $delivery,
        ];
        $this->view('agent/home', $data);
    }

    public function incoming()
    {
        $status = ['Delivered', 'In Transit', 'Cancelled', 'Returned', 'On the Way', 'Delivery at Office', 'Return Back'];
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
        $fullinfo = $this->db->getById('user_full_info', $this->agent['id']);
        $data = [
            'fullinfo' => $fullinfo,
        ];
        $this->view('agent/profile', $data);
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

    public function deliveryrequest()
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

    public function requestpickup()
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
        require_once APPROOT . '/helpers/Voucher_helper.php';

        $request_code = $_GET['request_code'];
        $allrequestdata = $this->db->columnFilter('pickup_requests_view', 'request_code', $request_code);
        // $checkadmin = $this->db->columnFilter('view_available_locations', 'agent_id', $allrequestdata['agent_id']);
        $checklocation = $this->db->columnFilter('view_available_locations', 'township_name', $allrequestdata['receiver_township']);
        $checkroute = $this->db->checkroutename('route_full_info', $allrequestdata['sender_township'], $allrequestdata['receiver_township']);

        $data = [
            'pickup' => $allrequestdata,
            'location' => $checklocation,
            'route' => $checkroute,
        ];
        // var_dump($checkadmin);
        // var_dump($checklocation);
        // var_dump($checkroute);
        // die();
        $this->view('agent/pickuprequestaction', $data);
    }

    public function edit_pickup()
    {
        $request_code = $_GET['request_code'];
        $allrequestdata = $this->db->columnFilter('pickup_requests_view', 'request_code', $request_code);
        // $checkadmin = $this->db->columnFilter('user_full_info', 'id', $allrequestdata['agent_id']);
        $checklocation = $this->db->columnFilter('view_available_locations', 'township_name', $allrequestdata['receiver_township']);
        $checkroute = $this->db->checkroutename('route_full_info', $allrequestdata['sender_township'], $allrequestdata['receiver_township']);
        $availablepickupagent = $this->db->columnFilterAll('users', 'created_by_agent', $this->agent['id']);

        // Keep only active users
        $availablepickupagent = array_filter($availablepickupagent, function ($agent) {
            return isset($agent['status_id']) && $agent['status_id'] === 1;
        });
        $data = [
            'pickup' => $allrequestdata,
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

    public function paymentlist()
    {
        // Read all pickup requests from the view
        $allPayments = $this->db->readAll('pickup_requests_view');

        // Filter only where payment_method is not null/empty
        $agentId = $this->agent['id'];

        $payment = array_filter($allPayments, function ($row) use ($agentId) {
            // Only include rows where agent matches and status_id is 6, 7, or 14
            return $row['agent_id'] == $agentId && in_array($row['status_id'] ?? null, [6, 7, 13, 14]);
        });

        $alldeliverypayment = $this->db->readAll('payment_history_view');
        $paymentdelivery = array_filter($alldeliverypayment, function ($row) use ($agentId) {
            return  $row['agent_id'] == $agentId;
        });



        // Pass to view
        $data = [
            'payment' => $payment,
            'paymentdelivery' => $paymentdelivery,
        ];

        $this->view('agent/paymentlist', $data);
    }

    public function paymenttype()
    {
        $agentId = $this->agent['id'];
        $allmethod = $this->db->readAll('payment_methods_view');
        $agentMethods = array_filter($allmethod, function ($method) use ($agentId) {
            return $method['create_by_agent_id'] == $agentId;
        });
        $data = [
            'allmethod' => $agentMethods,
        ];
        $this->view('agent/paymenttype', $data);
    }
    public function outfordelivery()
    {
        $allDeliveries = $this->db->readAll('view_deliveries_detailed');

        $statusesToShow = [3, 8, 9, 10, 11, 12, 14];

        $deliveriesOutForDelivery = array_filter($allDeliveries, function ($delivery) use ($statusesToShow) {
            return in_array($delivery['delivery_status_id'], $statusesToShow)
                && $delivery['receiver_agent_id'] == $this->agent['id'];
        });

        $data = [
            'deliveries' => $deliveriesOutForDelivery,
        ];

        $this->view('agent/out_for_delivery', $data);
    }

    public function outfordeliveryaction()
    {

        $request_code = $_GET['delivery_code'];
        $allrequestdata = $this->db->columnFilter('view_deliveries_detailed', 'tracking_code', $request_code);
        $availablepickupagent = $this->db->columnFilterAll('users', 'created_by_agent', $this->agent['id']);
        $availablepickupagent = array_filter($availablepickupagent, function ($agent) {
            return isset($agent['status_id']) && $agent['status_id'] === 1;
        });

        $data = [
            'pickup' => $allrequestdata,
            'availableAgents' => $availablepickupagent,
        ];
        $this->view('agent/out_for_delivery_action', $data);
    }
}