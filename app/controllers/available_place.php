<?php 


class Available_place extends Controller{
    private $db;

    public function __construct(){
        $this->db = new Database();
    }

    public function available()
    {
        $alldata = $this->db->readAll('view_available_locations');
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
        $location = $this->db->columnFilter('view_available_locations','id',$id);

        $pendingagent = $this->db->getAgentsByTownship($location['township_name']);

        $msgType = $_GET['message_type'] ?? null;
        $msgText = $_GET['message'] ?? null;

        $data = [
            "location" => $location,
            "pendingagent" => $pendingagent,
            "message_type" => $msgType,
            "message" => $msgText
        ];
        $this->view('/admin/available_place/confirm_place',$data);
        
    }

    public function confrim_place()
    {
        $this->view('/admin/available_place/confirm_place');
    }

    

}



?>