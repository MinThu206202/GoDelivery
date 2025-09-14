<?php
require_once APPROOT . '/middleware/AuthMiddleware.php';

class admincontroller extends Controller
{
    private $db;
    public function __construct()
    {
        AuthMiddleware::adminOnly();
        $this->model('UserModel');
        $this->db = new Database();
    }

    public function changephone()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            session_start();
            $newPhone = $_POST['new_phone'];
            $password = $_POST['password'];
            $user = $_SESSION['user'];

            if ($this->db->columnFilter('users', 'phone', $newPhone)) {
                setMessage('error', 'Phone number already in use');
            } elseif ($password === $user['password']) {
                $updated = $this->db->update('users', $user['id'], ['phone' => $newPhone]);
                if (!$updated) {
                    setMessage('error', 'Phone number update failed');
                }
            } else {
                setMessage('error', 'Incorrect password');
            }

            redirect('admin/profile');
        }
    }


    public function changepassword()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            session_start();
            $user = $_SESSION['user'];

            $current = base64_encode($_POST['current_password']);
            $new     = base64_encode($_POST['new_password']);
            $confirm = base64_encode($_POST['confirm_password']);

            if ($new !== $confirm) {
                setMessage('error', 'Passwords do not match');
            } elseif ($current !== $user['password']) {
                setMessage('error', 'Incorrect current password');
            } else {
                $updated = $this->db->update('users', $user['id'], ['password' => $new]);
                if (!$updated) {
                    setMessage('error', 'Password change failed');
                }
            }

            redirect('admin/profile');
        }
    }

    public function  agent_profile()
    {
        // session_start();

        $agentId = $_GET['id'] ?? null;
        $isagent = $this->db->columnFilter('user_full_info', 'id', $agentId);
        $isdelivery = $this->db->getByDeliveryId('view_deliveries_detailed', $isagent['id']);

        $data = [
            'agent' => $isagent,
            'delivery' => $isdelivery
        ];
        $this->view('admin/agent_profile', $data);
    }

    public function changestatus()
    {
        // session_start();

        $agentId = $_GET['id'] ?? null;

        $user = $this->db->columnFilter('users', 'id', $agentId);

        if ($user['status_id'] == 1) {
            $this->db->update('users', $agentId, ['status_id' => 2]);
            $mail = new Mail();
            $ismail = $mail->activeagent($user['email'], $user['name']);
        } elseif ($user['status_id'] == 2) {
            $this->db->update('users', $agentId, ['status_id' => 1]);
            $mail = new Mail();
            $ismail = $mail->dectivateagent($user['email'], $user['name']);
        }
        $isagent = $this->db->columnFilter('user_full_info', 'id', $agentId);
        $isdelivery = $this->db->getByDeliveryId('view_deliveries_detailed', $isagent['id']);

        $data = [
            'agent' => $isagent,
            'delivery' => $isdelivery,
            'success' => true
        ];
        $this->view('admin/agent_profile', $data);
    }

    public function sendmail()
    {
        require_once APPROOT . '/helpers/Voucher_helper.php';
        $id = $_GET['id'] ?? null;
        if (!$id) {
            redirect('admin/access_code');
        }


        $user = $this->db->columnFilter('users', 'id', $id);

        $user1 = $this->db->columnFilter('user_full_info', 'id', $id);

        $access_user = new Voucher_helper();

        $shortcode = $access_user->getShortCode($user1['city_name']);
        $random = str_pad(rand(0, 9999), 4, '0', STR_PAD_LEFT);
        $access_code = $shortcode . $random;

        if ($user && !empty($user['email']) && !empty($user['name']) && !empty($user['security_code'])) {
            (new Mail())->acceptagent($user['email'], $user['name'], $user['security_code']);

            $this->db->update('users', $id, ['status_id' => 1, 'access_code' => $access_code]);
            // Redirect with success flag
            redirect('admin/access_code?success=1'); // or ?success=0 if failed
        } else {
            redirect('admin/access_code?mail=error');
        }
    }


    public function delivery_detail()
    {
        $tracking_code = $_GET['tracking_code'];
        $id = $this->db->columnFilter('deliveries', 'tracking_code', $tracking_code);
        if ($id) {
            $data['detaildelivery'] = [$this->db->getById('view_deliveries_detailed', $id['id'])];
            return $this->view('admin/search', $data);
        }
    }

    public function search()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['tracking_code'])) {
            $id = $this->db->columnFilter('deliveries', 'tracking_code', $_POST['tracking_code'])['id'] ?? null;
            if ($id) {
                $data['detaildelivery'] = [$this->db->getById('view_deliveries_detailed', $id)];
                return $this->view('admin/search', $data);
            }
        }
        setMessage('error', 'Tracking code not found or invalid.');
    }

    public function pickupagentdetail()
    {
        $id = $_GET['id'];
        $fullinfo = $this->db->getById('user_full_info', $id);
        $data = [
            'fullinfo' => $fullinfo
        ];
        $this->view('admin/pickupagentprofile', $data);
    }

    public function acceptpickupagent()
    {
        $id = $_GET['id'];
        $this->db->update('users', $id, ['status_id' => 1]);
        header("Location: " . URLROOT . "/admincontroller/pickupagentdetail?id=" . $id);
        exit;
    }

    public function rejectpickupagent()
    {
        $id = $_GET['id'];
        $this->db->update('users', $id, ['status_id' => 2]);
        header("Location: " . URLROOT . "/admincontroller/pickupagentdetail?id=" . $id);
        exit;
    }

    public function logout()
    {


        $id = $_SESSION['user']['id'] ?? null;
        if ($id) {
            $this->db->unsetLogin($id);
        }

        session_destroy();

        $this->view('pages/login');
        exit();
    }
}