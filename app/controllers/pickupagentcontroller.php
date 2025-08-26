<?php
session_start();
class pickupagentcontroller extends Controller
{

    private $db;
    private $pickup_agent;

    public function __construct()
    {
        $this->db = new Database();
        $this->pickup_agent = $_SESSION['user'];
    }

    public function Dashboard()
    {
        $allpickupdata = $this->db->columnFilterAll('pickup_requests_view', 'pickup_agent_id', $this->pickup_agent['id']);
        $data = [
            'allpickupdata' => $allpickupdata,
        ];
        $this->view('pickupagent/Dashboard', $data);
    }

    public function mypick()
    {
        $allpickupdata = $this->db->columnFilterAll('pickup_requests_view', 'pickup_agent_id', $this->pickup_agent['id']);

        $allpickupdata = array_filter($allpickupdata, function ($pickup) {
            return $pickup['status'] !== 'pending';
        });
        $data = [
            'allpickupdata' => $allpickupdata,
        ];

        $this->view('pickupagent/mypickup', $data);
    }



    public function pickupagentprofile()
    {
        $profile = $this->db->getById('user_full_info', $this->pickup_agent['id']);
        $data = [
            'profile' => $profile,
        ];
        $this->view('pickupagent/agentpickupprofile', $data);
    }

    public function notification()
    {
        $this->view('pickupagent/pickupagentnotification');
    }

    public function pickupdetail()
    {
        $request_code = $_GET['request_code'];
        $pickupdetail = $this->db->columnFilter('pickup_requests_view', 'request_code', $request_code);
        $data = [
            'pickupdetial' => $pickupdetail,
        ];
        $this->view('pickupagent/pickupagent_pickupdetail', $data);
    }

    public function pickupagent_pickupdetail()
    {
        $this->view('pickupagent/pickupagent_pickupdetail');
    }

    public function startpickup()
    {
        $pickup_id = $_GET['id'];
        $result = $this->db->update('pickup_requests', $pickup_id, ['status_id' => 4]);
        redirect('pickupagentcontroller/mypick');
        return;
    }

    public function editpickup()
    {
        $request_code = $_GET['request_code'];
        $request_id = $_GET['id'];
        $weight = $_GET['weight'];
        $quantity = $_GET['quantity'];
        $payment_type = $_GET['payment_type'];
        $delivery_type = $_GET['delivery_type'];

        $result = $this->db->update(
            'pickup_requests',
            $request_id,
            [
                'weight' => $weight,
                'quantity' => $quantity,
                'delivery_type_id' => $delivery_type,
                'payment_status_id' => $payment_type
            ]
        );

        // ✅ Set flash message in session
        if ($result) {
            $_SESSION['flash_message'] = [
                'type' => 'success',
                'message' => 'Pickup updated successfully!'
            ];
        } else {
            $_SESSION['flash_message'] = [
                'type' => 'error',
                'message' => 'Failed to update pickup. Please try again.'
            ];
        }

        redirect('pickupagentcontroller/pickupdetail?request_code=' . $request_code);
        return;
    }

    public function verifypickup()
    {
        $id = $_GET['id'];
        $request_code = $this->db->getById('pickup_requests', $id);


        $result =  $this->db->update('pickup_requests', $id, ['status_id' => 9]);
        if ($result) {
            $_SESSION['flash_message'] = [
                'type' => 'success',
                'message' => 'Pickup verified successfully!'
            ];
        } else {
            $_SESSION['flash_message'] = [
                'type' => 'error',
                'message' => 'Failed to verify pickup. Please try again.'
            ];
        }


        redirect('pickupagentcontroller/pickupdetail?request_code=' . $request_code['request_code']);
        return;
    }

    public function completepickup()
    {
        $id = $_GET['id'];
        $this->db->update('pickup_requests', $id, ['status_id' => 3]);
        redirect('pickupagentcontroller/mypick');
        return;
    }
}
