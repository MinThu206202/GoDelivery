<?php
class Pages extends Controller
{

    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function Dashboard()
    {
        $this->view('pickupagent/Dashboard');
    }

    public function calculator()
    {
        $this->view('user/calculator');
    }
}
