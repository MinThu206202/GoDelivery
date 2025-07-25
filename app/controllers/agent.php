<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once APPROOT . '/middleware/AuthMiddleware.php';

class Agent extends Controller
{

    private $db;
    public function __construct()
    {
        AuthMiddleware::agentOnly();
        $this->db = new Database();
    }

    public function home()
    {
        $this->view('agent/home');
    }

    public function mydelivery()
    {
        $this->view('agent/mydelivery');
    }

    public function profile()
    {
        $this->view('agent/profile');
    }

    public function voucher()
    {
        $this->view('agent/voucher');
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
