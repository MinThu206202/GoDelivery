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
        $delivery = $this->db->columnFilterAll('delivery_info','sender_id',$this->agent['id']);
        $data = [
            'delivery' => $delivery,
        ];
        $this->view('agent/home',$data);
    }

    public function mydelivery()
    {
        $delivery = $this->db->columnFilterAll('delivery_info', 'sender_id', $this->agent['id']);
        $data = [
            'delivery' => $delivery,
        ];
        $this->view('agent/mydelivery',$data);
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
    public function voucher()
    {
        $getregion = $this->db->readAll('regions');
        $data = [
            'region' => $getregion
        ];
        $this->view('agent/voucher',$data);
    }

    public function notification()
    {
        $this->view('agent/notification');
    }

    public function request()
    {
        $this->view('agent/request');
    }

    public function voucher_detail()
    {
        $this->view('agent/voucher_detail');
    }

    public function update_status()
    {
        $this->view('agent/update_status');
    }

}
