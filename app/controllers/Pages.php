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

    public function calculator(){
        $this->view('pages/calculator');
    }

    public function forgetpassword()
    {
        $this->view('pages/forgetpassword');
    }

    public function ournetwork()
    {
        $this->view('pages/ournetwork');
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

   
}
