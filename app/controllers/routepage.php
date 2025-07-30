<?php 

class routepage extends Controller{
    private $db ;
    public function __construct(){
        $this->model('RouteModel');
        $this->model('notification');
        $this->db = new Database();
    }


    public function getCities()
    {
        $regionId = $_GET['region_id'] ?? null;
        if ($regionId) {
            $cities = $this->db->columnFilterAll('cities', 'region_id', $regionId);
            // var_dump($cities);
            // die();
            echo json_encode($cities);
        }
    }

    public function addroute()
    {

        $region = $this->db->readAll('regions');
        $cities = $this->db->readAll('cities'); // Fetch all cities from DB
        
        $data = [
            'regions' => $region,
            'cities' => $cities
        ];

        $this->view('admin/addroute', $data); // Pass to your view
    }


    public function createroute()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $regions = $this->db->readAll('regions');
            return $this->view('admin/addroute', ['regions' => $regions]);
        }

        $input = array_map('trim', $_POST);
        ['fromCity' => $fromCity, 'toCity' => $toCity, 'distance' => $distance, 'time' => $time, 'user_id' => $userId] = $input + [null, null, null, null, null];

        if (!$fromCity || !$toCity || !$distance || !$time) {
            die("Missing required fields.");
        }

        $from = $this->db->columnFilter('cities', 'name', $fromCity);
        $to = $this->db->columnFilter('cities', 'name', $toCity);

        if (!$from || !$to) {
            die("Invalid city name(s).");
        }

        $price = $this->db->getCalculatedPrice($distance);


        $route = new RouteModel();
        $route->setFromcity($from['id']);
        $route->setTocity($to['id']);
        $route->setDistance($distance);
        $route->setPrice($price);
        $route->setTime($time);
        $route->setStatus('active');
        $route->setCreatedat(date('Y-m-d H:i:s'));
        $route->setUpdatedat(null);

        if (!$this->db->create('route', $route->toArray())) {
            die("Error saving route");
        }

        $agents = $this->db->columnFilterAll('user_full_info', 'role_name', 'Agent') ?: [];

        foreach ($agents as $agent) {
            $notification = new Notification();
            $notification->setFromagentid($userId);
            $notification->setToagentid($agent['id']);
            $notification->setTypeid(4);
            $notification->setTitle("Route Activated");
            $notification->setMessage("Route from $fromCity to $toCity has been activated. You can now start deliveries on this route.");
            $notification->setCreatedAt(date('Y-m-d H:i:s'));
            $this->db->create('agent_notifications', $notification->toArray());
        }

        header('Location: ' . URLROOT . '/routepage/createroute?success=1');
        exit;
    }

    
}


?>