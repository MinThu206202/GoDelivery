<?php
require_once APPROOT . '/middleware/AuthMiddleware.php';

class admincontroller extends Controller
{
    private $db;
    private $admin;
    public function __construct()
    {
        AuthMiddleware::adminOnly();
        $this->model('UserModel');
        $this->model('notification');
        $this->admin = $_SESSION['user'];
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

            $current = trim($_POST['current_password'] ?? '');
            $new     = trim($_POST['new_password'] ?? '');
            $confirm = trim($_POST['confirm_password'] ?? '');

            // Check if any field is empty
            if (empty($current) || empty($new) || empty($confirm)) {
                setMessage('error', 'All fields are required');
                redirect('admin/pro');
                return;
            }

            // Check current password
            if (base64_encode($current) !== $user['password']) {
                setMessage('error', 'Incorrect current password');
                redirect('admin/pro');
                return;
            }

            // Check new password strength (min 8 chars, at least 1 letter and 1 number)
            if (!preg_match('/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d@$!%*#?&]{8,}$/', $new)) {
                setMessage('error', 'Password must be at least 8 characters long and include letters and numbers');
                redirect('admin/pro');
                return;
            }

            // Check new & confirm password match
            if ($new !== $confirm) {
                setMessage('error', 'Passwords do not match');
                redirect('admin/pro');
                return;
            }

            // Update password
            $updated = $this->db->update('users', $user['id'], ['password' => base64_encode($new)]);
            if ($updated) {
                setMessage('success', 'Password changed successfully');
                // Optionally update session password
                $_SESSION['user']['password'] = base64_encode($new);
            } else {
                setMessage('error', 'Password change failed');
            }

            redirect('admin/pro');
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
        $fullinfo = $this->db->getById('user_full_info', $id);
        $name = $fullinfo['name'];

        date_default_timezone_set('Asia/Yangon');

        $this->db->create('agent_notifications', [
            'from_agent_id' => $this->admin['id'],
            'to_agent_id'   => $fullinfo['created_by_agent'],
            'type_id'       => 4,
            'title'   => 'Pickup Agent Activated!',
            'message' => "Hello, your Pickup Agent $name account has been successfully activated. You can now log in and start managing deliveries. Use the security code sent to your email for your first login.",

            'created_at'    => date('Y-m-d H:i:s', time())
        ]);
        (new Mail)->pickupAgentActivated(
            $fullinfo['email'],
            $fullinfo['name'],
            $fullinfo['security_code']

        );
        $this->db->update('users', $id, ['status_id' => 1]);
        header("Location: " . URLROOT . "/admincontroller/pickupagentdetail?id=" . $id);
        exit;
    }

    public function rejectpickupagent()
    {
        $id = $_GET['id'];
        $fullinfo = $this->db->getById('user_full_info', $id);
        (new Mail)->pickupAgentDeactivated(
            $fullinfo['email'],
            $fullinfo['name'],

        );

        date_default_timezone_set('Asia/Yangon');


        $name = $fullinfo['name'];
        $this->db->create('agent_notifications', [
            'from_agent_id' => $this->admin['id'],
            'to_agent_id'   => $fullinfo['created_by_agent'],
            'type_id'       => 3,
            'title'   => 'Pickup Agent Deactivated',
            'message' => "Your Pickup Agent $name account has been deactivated. You no longer have access to the system. Please contact support if you believe this is a mistake.",

            'created_at'    => date('Y-m-d H:i:s', time())
        ]);

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