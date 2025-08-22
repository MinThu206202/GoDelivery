<?php
class Pages extends Controller
{

    private $db;

    public function __construct()
    {
        $this->db = new Database();
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
        $this->view('user/pickuphistory');
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
