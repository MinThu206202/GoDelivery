<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

class Auth extends Controller
{
    private $db;
    public function __construct()
    {
        $this->model('UserModel');
        $this->db = new Database();
    }

    public function getCities()
    {
        $regionId = $_GET['region_id'] ?? null;
        if ($regionId) {
            $cities = $this->db->columnFilterAll('cities', 'region_id', $regionId);
            // var_dump($cities);
            // die();
            echo json_encode($cities);
        }
    }

    public function getTownships()
    {
        $cityId = $_GET['city_id'] ?? null;
        if ($cityId) {
            $townships = $this->db->columnFilterall('townships', 'city_id', $cityId);
            echo json_encode($townships);
        }
    }

    public function getWards()
    {
        $townshipId = $_GET['township_id'] ?? null;
        if ($townshipId) {
            $wards = $this->db->columnFilterall('wards', 'township_id', $townshipId);
            echo json_encode($wards);
        }
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') return;

        $codeArray = $_POST['security_code'] ?? null;
        $passwordRaw = $_POST['password'] ?? null;

        if (!$codeArray || !$passwordRaw) {
            setMessage('error', 'Missing credentials');
            return redirect('pages/login');
        }

        $securityCode = implode('', $codeArray);
        $encodedPassword = base64_encode($passwordRaw);

        $user = $this->db->columnFilter('users', 'security_code', $securityCode);
      
        if (!$user || $user['password'] !== $encodedPassword) {
            setMessage('error', 'Invalid security code');
            return redirect('pages/login');
        }

        session_start();
        $_SESSION['user'] = $user;

        return $user['role_id'] == 1
            ? redirect('admin/home')
            : redirect('agent/home');
    }


    public function forgetpassword()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') return;

        $email = trim($_POST['email'] ?? '');

        if (empty($email)) {
            setMessage('error', 'Email is required');
            return redirect('pages/forgetpassword');
        }

        $user = $this->db->columnFilter('users', 'email', $email);
        if (!$user) {
            setMessage('error', 'Email is not registered');
            return redirect('pages/forgetpassword');
        }

        $security = $this->db->columnFilter('users', 'id', $user['id']);
        if (!$security) {
            setMessage('error', 'Security record not found');
            return redirect('pages/forgetpassword');
        }

        $otp = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
        date_default_timezone_set('Asia/Yangon');
        $expiry = date('Y-m-d H:i:s', strtotime('+1 minutes'));

        $updated = $this->db->update('users', $security['id'], [
            'otp_code' => $otp,
            'otp_expiry' => $expiry
        ]);

        if (!$updated) {
            setMessage('error', 'Failed to generate OTP');
            return redirect('pages/forgetpassword');
        }

        (new Mail())->sendOTP($email, $otp);

        session_start();
        $_SESSION['post_email'] = $email;

        return redirect('pages/otp');
    }




    public function otp()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            session_start();

            $email = $_SESSION['post_email'] ?? null;
            $otp = isset($_POST['otp']) ? implode('', array_map('trim', $_POST['otp'])) : null;

            if (!$email || !$otp) {
                setMessage('error', 'Missing email or OTP.');
                return redirect('pages/otp');
            }

            $user = $this->db->columnFilter('users', 'email', $email);

            date_default_timezone_set('Asia/Yangon');
            $currenttime =  date('Y-m-d H:i:s');

            if (time() > strtotime($user['otp_expiry'])) {
                setMessage('error', 'OTP expired');
                redirect('pages/otp');
            }


            if (!empty($user) && ($user['otp_code'] ?? '') === $otp) {
                $_SESSION['change_mail'] = $email;
                return redirect('pages/changepassword');
            }

            setMessage('error', 'Invalid OTP');
            redirect('pages/otp');
        }
    }

    public function changepassword()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            session_start();

            $email = $_SESSION['post_email'] ?? null;
            $newPass = $_POST['new_password'] ?? null;
            $confirmPass = $_POST['confirm_password'] ?? null;

            if (!$email || !$newPass || !$confirmPass) {
                setMessage('error', 'All fields are required.');
                return redirect('pages/changepassword');
            }

            if ($newPass !== $confirmPass) {
                setMessage('error', 'Passwords do not match.');
                return redirect('pages/changepassword');
            }

            $user = $this->db->columnFilter('users', 'email', $email);

            if (!$user || empty($user['id'])) {
                setMessage('error', 'User not found.');
                return redirect('pages/changepassword');
            }

            // Use password_hash for real security instead of base64
            $hashedPassword = password_hash($newPass, PASSWORD_BCRYPT);

            $updated = $this->db->update('users', $user['id'], ['password' => $hashedPassword]);

            if ($updated) {
                unset($_SESSION['post_email']); // optional: clear session
                return redirect('pages/login');
            }

            setMessage('error', 'Failed to update password.');
            redirect('pages/changepassword');
        }
    }

    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            session_start();
            date_default_timezone_set('Asia/Yangon');

            $email = $_POST['email'];
            $phone = $_POST['phonenumber'];
            $password = $_POST['password'];
            $confirm = $_POST['confirm_password'];

            if ($this->db->columnFilter('users', 'email', $email) || $this->db->columnFilter('users', 'phone', $phone)) {
                setMessage('error', 'Email or phone already registered');
                redirect('pages/register');
            }

            if ($password !== $confirm) {
                setMessage('error', 'Password not match');
                redirect('pages/register');
            }

            $userId = $this->db->columnFilter('users', 'email', $email)['id'];
            $securityCode = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);

            $user = new UserModel;
            $user->setName($_POST['name']);
            $user->setEmail($email);
            $user->setPhone($phone);
            $user->setPassword(base64_encode($password));
            $user->setRegion($_POST['region_id']);
            $user->setCity($_POST['city_id']);
            $user->setTownship($_POST['township_id']);
            $user->setWard($_POST['ward_id']);
            $user->setAddress($_POST['address']);
            $user->setRole_id(2);
            $user->setStatus_id(3);
            $user->setCreated_at(date('Y-m-d H:i:s'));
            $user->setSecurity_code($securityCode);

            if ($this->db->create('users', $user->toArray())) {
                    (new Mail)->welcomeamil($email, $_POST['name']);
                    redirect('pages/login');
            }else{
            setMessage('error', 'Registration failed');
            redirect('pages/register');
            }
        }
    }

}

