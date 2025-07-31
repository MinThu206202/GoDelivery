<?php 


class Availablecontroller extends Controller {
    private $db;
    public function __construct(){
        $this->db = new Database();
        $this->model('notification');
    }

    public function deployresult(){
        $id = $_POST['agent_id'];
        $location_id = $_POST['location_id'];

        $data = [
            'status_id' => 1
        ];
        $activeagent = $this->db->update('users', $id, $data);
        $activeplace = $this->db->update('available_location',$location_id , ['agent_id' => $id , 'status_location_id' => 1]);
        $activeagent = $this->db->update('users',$id,$data);
        var_dump($activeagent);
        var_dump($activeplace);
        die();

    }


    public function updateLocationStatus()
    {
        session_start();
        $name = $_SESSION['user'];
        $userId = $name['id'];
        $id = $_POST['location_id'];
        $status = $_POST['current_status'];

        
        if($status == 'active'){
            $activelocation = $this->db->update('available_location',$id,['status_location_id' => 2]);
            $msgType = 'success';
            $newstatus = 'inactive';
            $msgText = 'Location status changed to ' . ucfirst($newstatus);

            $city = $this->db->columnFilter('view_available_locations' , 'id',$id);
            $changeroute = $this->db->changefromcitystatus('route',$city['city_id'],['status' => 'inactive']);
            $changeroute = $this->db->changetocitystatus('route', $city['city_id'], ['status' => 'inactive']);

            $agents = $this->db->columnFilterAll('user_full_info', 'role_name', 'Agent') ?: [];

            foreach ($agents as $agent) {
                $notification = new Notification();
                $notification->setFromagentid($userId);
                $notification->setToagentid($agent['id']);
                $notification->setTypeid(4);
                $notification->setTitle("Township Activated");
                $notification->setMessage("Activation complete: ". $city['city_name'] ." is now live in the system.");
                $notification->setCreatedAt(date('Y-m-d H:i:s'));
                $create = $this->db->create('agent_notifications', $notification->toArray());
                
            }

            header("Location: " . URLROOT . "/available_place/place_detail?id=" . urlencode($id) .
                "&message_type=" . urlencode($msgType) .
                "&message=" . urlencode($msgText));
            exit();
                   
        }elseif($status === 'inactive' || $status === "pending"){
            $activelocation = $this->db->update('available_location', $id, ['status_location_id' => 1]);
            $msgType = 'success';
            $newstatus = 'active';
            $msgText = 'Location status changed to ' . ucfirst($newstatus);

            $city = $this->db->columnFilter('view_available_locations', 'id', $id);
            $changeroute = $this->db->changefromcitystatus('route', $city['city_id'], ['status' => 'active']);
            $changeroute = $this->db->changetocitystatus('route', $city['city_id'], ['status' => 'active']);

            $agents = $this->db->columnFilterAll('user_full_info', 'role_name', 'Agent') ?: [];

            foreach ($agents as $agent) {
                $notification = new Notification();
                $notification->setFromagentid($userId);
                $notification->setToagentid($agent['id']);
                $notification->setTypeid(4);
                $notification->setTitle("Township deactivated.");
                $notification->setMessage("The township of " . $city['city_name'] . " has been deactivated and is no longer available for new deliveries.");
                $notification->setCreatedAt(date('Y-m-d H:i:s'));
                $create = $this->db->create('agent_notifications', $notification->toArray());
            }

            header("Location: " . URLROOT . "/available_place/place_detail?id=" . urlencode($id) .
                "&message_type=" . urlencode($msgType) .
                "&message=" . urlencode($msgText));
            exit();
        }


    }

}




?>