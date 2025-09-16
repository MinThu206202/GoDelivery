<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
class Pages extends Controller
{

    private $db;
    private $customer;

    public function __construct()
    {
        $this->db = new Database();
        if (session_id() === '') {
            session_start();
        }
        $this->customer = $_SESSION['customer'] ?? null;
    }

    public function index()
    {
        $this->view('pages/index');
    }

    public function calculator()
    {
        $township = $this->db->readAll('townships');
        $data = [
            'township' => $township,
        ];
        $this->view('user/calculator', $data);
    }

    public function forgetpassword()
    {
        $this->view('pages/forgetpassword');
    }

    // Get cities by region
    public function getCities()
    {
        $regionId = $_GET['region_id'] ?? null;

        if ($regionId) {
            $cities = $this->db->columnFilterAll('cities', 'region_id', $regionId);
            echo json_encode($cities);
        } else {
            echo json_encode([]);
        }
    }

    // Get townships by city
    public function getTownships()
    {
        $cityId = $_GET['city_id'] ?? null;

        if ($cityId) {
            $townships = $this->db->columnFilterAll('townships', 'city_id', $cityId);
            echo json_encode($townships);
        } else {
            echo json_encode([]);
        }
    }


    public function ournetwork()
    {
        $regions = $this->db->readAll('regions');
        $places  = $this->db->readAll('view_available_locations'); // all locations

        $data = [
            'regions' => $regions,
            'places'  => $places,
        ];

        $this->view('user/ournetwork', $data);
    }



    public function register()
    {
        $this->view('pages/register');
    }

    public function login()
    {
        $this->view('pages/login');
    }



    public function otp()
    {
        $this->view('pages/otp');
    }

    public function changepassword()
    {
        $this->view('pages/changepassword');
    }

    public function requestpickup()
    {
        $region = $this->db->readAll('regions');
        $cities = $this->db->readAll('cities'); // Fetch all cities from DB

        $data = [
            'regions' => $region,
            'cities' => $cities
        ];

        $this->view('user/pickup', $data);
    }

    public function pickuphistory()
    {
        $allPickup = $this->db->readAll('pickup_requests_view');

        $pickup = array_filter($allPickup, function ($row) {
            return $row['sender_email'] === $this->customer['email'];
        });
        $data = [
            'pickup' => $pickup,
        ];
        $this->view('user/pickuphistory', $data);
    }

    public function user_tracking()
    {
        $code = $_POST['code'];
        $tracking_code = $this->db->columnFilter('view_deliveries_detailed', 'tracking_code', $code);
        $update_status = $this->db->columnFilterAll('view_delivery_status_history', 'tracking_code', $code);
        $data = [
            'code' => $code,
            'tracking_code' => $tracking_code,
            'update_status' => $update_status
        ];

        $this->view('pages/user_tracking', $data);
    }

    public function who()
    {
        $this->view(('pages/whoami'));
    }

    public function customerlogin()
    {
        $this->view('pages/customerlogin');
    }

    public function customerregister()
    {
        $this->view('pages/customerregister');
    }

    public function notification()
    {
        $noti = $this->db->columnFilterAll('view_agent_messages', 'to_agent_id', $this->customer['id']);
        $data = [
            'noti' => $noti,
        ];
        $this->view('user/notification', $data);
    }
    public function Dashboard()
    {
        $this->view('pickupagent/Dashboard');
    }
}
