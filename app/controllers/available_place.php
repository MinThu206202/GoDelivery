<?php 


class Available_place extends Controller{
    private $db;

    public function __construct(){
        $this->db = new Database();
    }

    public function available()
    {
        $alldata = $this->db->readAll('view_available_location');
        $data = [
            'availabel_place' => $alldata
        ];
        $this->view('/admin/available_place/place',$data);
    }

    public function addplace() 
    {
        $this->view(('/admin/available_place/addplace'));
    }

    public function place_detail()
    {
        $id = $_GET['id']; 
        $location = $this->db->columnFilter('view_available_location','id',$id);
        $pendingagent = $this->db->getAgentsByTownship($location['township_name']);
        $data = [
            "location" => $location,
            "pendingagent" => $pendingagent
        ];
        $this->view('/admin/available_place/confirm_place',$data);
        
    }

    public function confrim_place()
    {
        $this->view('/admin/available_place/confirm_place');
    }

}



?>