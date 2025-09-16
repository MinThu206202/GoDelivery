<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
class RoutePage extends Controller
{
    private $db;
    public function __construct()
    {
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

    public function getTownships()
    {
        $cityId = $_GET['city_id'] ?? null;
        if ($cityId) {
            $townships = $this->db->columnFilterAll('townships', 'city_id', $cityId);
            echo json_encode($townships);
        }
    }

    // public function addroute()
    // {
    //     echo "Test addroute function";
    // }

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
            return $this->view('admin/addroute', [
                'regions' => $this->db->readAll('regions')
            ]);
        }

        $data = array_map('trim', $_POST);
        $required = ['from_city_id', 'from_township_id', 'to_city_id', 'to_township_id', 'distance', 'time', 'user_id'];

        // Check required fields
        foreach ($required as $field) {
            if (empty($data[$field])) {
                setMessage('error', "Missing required field: $field");
                redirect('routepage/createroute');
                return;
            }
        }

        // Validate city IDs
        $fromCity = $this->db->columnFilter('cities', 'id', $data['from_city_id']);
        $toCity   = $this->db->columnFilter('cities', 'id', $data['to_city_id']);

        if (!$fromCity || !$toCity) {
            setMessage('error', 'Invalid city selection.');
            redirect('routepage/createroute');
            return;
        }

        // Check if route already exists
        $checkroute = $this->db->filterDoubleColumn('route', $data['from_township_id'], $data['to_township_id']);

        if ($checkroute) {
            setMessage('error', 'Route already exists.');
            redirect('routepage/createroute');
            return;
        }

        // Calculate price
        $finalprice = $this->db->getCalculatedPrice($data['distance']);

        // Create route object
        $route = new RouteModel();
        $route->from_city_id = $data['from_city_id'];
        $route->from_township_id = $data['from_township_id'];
        $route->to_city_id = $data['to_city_id'];
        $route->to_township_id = $data['to_township_id'];
        $route->distance = $data['distance'];
        $route->price = $finalprice;
        $route->status = 'active';
        $route->time = $data['time'];

        // Insert into DB
        if (!$this->db->create('route', $route->toArray())) {
            setMessage('error', 'Failed to create route. Please try again.');
            redirect('routepage/createroute');
            return;
        }

        // Notify agents
        $agents = $this->db->columnFilterAll('user_full_info', 'role_name', 'Agent') ?: [];
        foreach ($agents as $agent) {
            $this->db->create('agent_notifications', [
                'from_agent_id' => $data['user_id'],
                'to_agent_id'   => $agent['id'],
                'type_id'       => 2,
                'title'         => 'Route Activated',
                'message'       => "Route from {$fromCity['name']} to {$toCity['name']} is now active.",
                'created_at'    => date('Y-m-d H:i:s')
            ]);
        }

        setMessage('success', 'Route created successfully!');
        redirect('routepage/createroute');
    }
}