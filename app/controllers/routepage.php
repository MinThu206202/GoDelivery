<?php 

class routepage extends Controller{
    private $db ;
    public function __construct(){
        $this->model('RouteModel');
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
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $input = array_map('trim', $_POST);

            $fromCity = $input['fromCity'] ?? null;
            $toCity = $input['toCity'] ?? null;
            $distance = $input['distance'] ?? null;
            $price = $input['price'] ?? null;

            if (!$fromCity || !$toCity || !$distance || !$price) {
                echo "Missing required fields.";
                return;
            }

            $from = $this->db->columnFilter('cities', 'name', $fromCity);
            $to = $this->db->columnFilter('cities', 'name', $toCity);

            if (!$from || !$to) {
                echo "Invalid city name(s).";
                return;
            }

            $route = new RouteModel();
            $route->setFromcity($from['id']);
            $route->setTocity($to['id']);
            $route->setDistance($distance);
            $route->setPrice($price);
            $route->setStatus('active');
            $route->setCreatedat(date('Y-m-d H:i:s'));
            $route->setUpdatedat(null);

            $created = $this->db->create('route', $route->toArray());

            if ($created) {
                // Redirect to GET with success param to trigger notification modal
                header('Location: ' . URLROOT . '/routepage/createroute?success=1');
                exit;
            } else {
                die("Error saving route");
            }
        } else {
            // GET request, just load form with regions
            $regions = $this->db->readAll('regions');
            $this->view('admin/addroute', [
                'regions' => $regions
            ]);
        }
    }

    
}


?>