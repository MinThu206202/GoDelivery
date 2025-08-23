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
        $this->view('user/calculator');
    }

    public function forgetpassword()
    {
        $this->view('pages/forgetpassword');
    }

    public function ournetwork()
    {
        $this->view('user/ournetwork');
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

    public function pickup()
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
        $this->view('user/notification');
    }
    public function Dashboard()
    {
        $this->view('pickupagent/Dashboard');
    }
}
