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


}
