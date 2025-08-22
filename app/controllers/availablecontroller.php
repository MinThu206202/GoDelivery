<?php


class Availablecontroller extends Controller
{
    private $db;
    public function __construct()
    {
        $this->db = new Database();
        $this->model('notification');
        $this->model('CityModel');
        $this->model('TownshipModel');
        $this->model('Available_locationModel');
    }

    public function deployresult()
    {
        $id = $_POST['agent_id'];
        $location_id = $_POST['location_id'];
        $email = $_POST['agent_email'];
        $location_id = $_POST['location_id'];


        $assignedid = $this->db->columnFilter('available_location', 'id', $location_id);
        if ($assignedid['agent_id']) {
            $change_assign_agent_status = $this->db->update('users', $assignedid['agent_id'], ['status_id' => 3]);
        }

        $data = [
            'status_id' => 1
        ];

        $activeagent = $this->db->update('users', $id, $data);
        $activeplace = $this->db->update('available_location', $location_id, ['agent_id' => $id, 'status_location_id' => 1]);
        $activeagent = $this->db->update('users', $id, $data);
        if ($activeagent) {

            $sendmailuser = $this->db->columnFilter('user_full_info', 'id', $id);

            $user =  new Mail();
            $new = $user->acceptagentbytownshhip($sendmailuser['email'], $sendmailuser['name'], $sendmailuser['township_name'], $sendmailuser['security_code']);
            $successMessage = urlencode('Agent is successfully assigned');
            header("Location: " . URLROOT . "/available_place/place_detail?id=" . urlencode($location_id) .
                "&message_type=success&message={$successMessage}");
            exit();
        }
    }


    public function updateLocationStatus()
    {

        session_start();
        $userId = $_SESSION['user']['id'];
        $id = $_POST['location_id'];
        $currentStatus = $_POST['current_status'];

        $newStatusId = ($currentStatus === 'active') ? 2 : 1;
        $newStatusText = ($newStatusId === 2) ? 'inactive' : 'active';
        $msgText = "Location status changed to " . ucfirst($newStatusText);

        // Update location status

        // Fetch township
        $location = $this->db->columnFilter('view_available_locations', 'id', $id);

        $change_assign_agnet = $this->db->columnFilter('user_full_info', 'id', $location['agent_id']);
        // var_dump($change_assign_agnet);
        // die();

        if ($newStatusId === 2) {

            $user = new Mail();
            $user->agentchangestatusbytownship($change_assign_agnet['email'], $change_assign_agnet['name'], $change_assign_agnet['township_name']);
        } else {
            $user = new Mail();
            $user->agentchangestatusbytownshipactive($change_assign_agnet['email'], $change_assign_agnet['name'], $change_assign_agnet['township_name']);
        }


        if ($location['agent_id']) {
            $agnetstatus = $this->db->update('users', $location['agent_id'], ['status_id' => $newStatusId]);
        } else {
            // Redirect back with error
            $errorMessage = urlencode('You need to first assign an agent for this location');
            header("Location: " . URLROOT . "/available_place/place_detail?id=" . urlencode($id) .
                "&message_type=error&message={$errorMessage}");
            exit();
        }

        $this->db->update('available_location', $id, ['status_location_id' => $newStatusId]);

        // Change route status based on township
        $this->db->changefromcitystatus('route', $location['township_id'], ['status' => $newStatusText]);
        $this->db->changetocitystatus('route', $location['township_id'], ['status' => $newStatusText]);



        // Notify all agents
        $agents = $this->db->columnFilterAll('user_full_info', 'role_name', 'Agent') ?: [];
        $title = ($newStatusId === 2) ? "Township Deactivated" : "Township Activated";
        $typeid = ($newStatusId === 2) ? 3 : 2;
        $message = ($newStatusId === 2)
            ? "The township of {$location['city_name']} has been deactivated and is no longer available for new deliveries."
            : "Activation complete: {$location['city_name']} is now live in the system.";

        foreach ($agents as $agent) {
            $notification = new Notification();
            $notification->setFromagentid($userId);
            $notification->setToagentid($agent['id']);
            $notification->setTypeid($typeid);
            $notification->setTitle($title);
            $notification->setMessage($message);
            $notification->setCreatedAt(date('Y-m-d H:i:s'));
            $this->db->create('agent_notifications', $notification->toArray());
        }

        // Redirect
        header("Location: " . URLROOT . "/available_place/place_detail?id=" . urlencode($id) .
            "&message_type=success&message=" . urlencode($msgText));
        exit();
    }

    public function addplace()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $regionId = $_POST['region'];
            $cityName = $_POST['city'];
            $townshipName = $_POST['township'] . ' Township';
            echo $townshipName;


            $townshipcheck = $this->db->columnFilter('townships', 'name', $townshipName);
            if ($townshipcheck) {
                setMessage('error', 'Address is already exit');
                redirect('available_place/addplace');
            }

            // Find or create city
            $city = $this->db->columnFilter('cities', 'name', $cityName);
            if (!$city) {
                $cityModel = new CityModel();
                $cityModel->setRegionId($regionId);
                $cityModel->setName($cityName);
                $this->db->create('cities', $cityModel->toArray());
                $city = $this->db->columnFilter('cities', 'name', $cityName);
            }

            // Find or create township
            $township = $this->db->columnFilter('townships', 'name', $townshipName);
            if (!$township) {
                $townshipModel = new TownshipModel();
                $townshipModel->setCityId($city['id']);
                $townshipModel->setName($townshipName);
                $this->db->create('townships', $townshipModel->toArray());
                $township = $this->db->columnFilter('townships', 'name', $townshipName);
            }

            // Create available_location
            $location = new Available_locationModel();
            $location->setRegionId($regionId);
            $location->setCityId($city['id']);
            $location->setTownshipId($township['id']);
            $location->setAgentId(null);
            date_default_timezone_set('Asia/Yangon');
            $location->setCreatedAt(date('Y-m-d H:i:s')); // ✅ fix date format
            $location->setUpdatedAt(null);
            $location->setStatusLoacationId(3);

            $this->db->create('available_location', $location->toArray());

            redirect('available_place/addplace?success=1');
        }
    }
}
