<?php 


class Available_place extends Controller{
    private $db;

    public function __construct(){
        $this->db = new Database();
    }

    public function available(){
        $this->view('/admin/available_place/place');
    }
}



?>