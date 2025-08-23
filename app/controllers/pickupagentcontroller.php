<?php
class pickupagentcontroller extends Controller
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

    public function mypick()
    {
        $this->view('pickupagent/mypickup');
    }

    public function completepickup()
    {
        $this->view('pickupagent/completepickup');
    }

    public function pickupagentprofile()
    {
        $this->view('pickupagent/agentpickupprofile');
    }

    public function notification()
    {
        $this->view('pickupagent/pickupagentnotification');
    }

    public function pickupdetail()
    {
        $this->view('pickupagent/pickupdetail');
    }
}
