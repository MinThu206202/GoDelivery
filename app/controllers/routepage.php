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

        foreach ($required as $field) {
            if (empty($data[$field])) {
                die("Missing required field: $field");
            }
        }

        $fromCity = $this->db->columnFilter('cities', 'id', $data['from_city_id']);
        $toCity   = $this->db->columnFilter('cities', 'id', $data['to_city_id']);

        if (!$fromCity || !$toCity) {
            die("Invalid city ID(s).");
        }


        $checkroute = $this->db->filterDoubleColumn('route', $_POST['from_township_id'], $_POST['to_township_id']);

        if ($checkroute) {
            setMessage('error', 'Route is already exit');
            redirect('routepage/createroute');
        } else {







            // $params = [
            //     $data['from_city_id'],
            //     $data['from_township_id'],
            //     $data['to_city_id'],
            //     $data['to_township_id'],
            //     $data['distance'],
            //     $price,
            //     'active',
            //     $data['time']
            // ];

            // try{
            //     $insertroute = $this->db->insertRoute(...$params);
            //     echo "route is successful";
            // }catch (Exception $e){
            //     echo "ERROR".$e->getMessage();
            // }


            // $route = new RouteModel();
            // $route->setFromcity($data['from_city_id']);
            // $route->setFromtownship($data['from_township_id']);
            // $route->setTocity($data['to_city_id']);
            // $route->setTotownship($data['to_township_id']);
            // $route->setDistance($data['distance']);
            // $route->setTime($data['time']);
            // $route->setPrice($price);
            // $route->setStatus('active');
            // $route->setCreatedat(date('Y-m-d H:i:s'));
            // $route->setUpdatedat(null);

            $finalprice = $this->db->getCalculatedPrice($data['distance']);


            $route = new RouteModel();


            $route->from_city_id = $data['from_city_id'];
            $route->from_township_id = $data['from_township_id'];
            $route->to_city_id = $data['to_city_id'];
            $route->to_township_id = $data['to_township_id'];
            $route->distance = $data['distance']; // fixed property name
            $route->price = $finalprice;
            $route->status = 'active';
            $route->time = $data['time'];




            if (!$this->db->create('route', $route->toArray())) {
                die("Failed to create route.");
            }

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


            header('Location: ' . URLROOT . '/routepage/createroute?success=1');
            exit;
        }
    }
}
