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



    // In your controller
    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') return;

        $code = implode('', $_POST['security_code'] ?? []);
        $password = $_POST['password'] ?? '';

        if (!$code || !$password) {
            setMessage('error', 'Missing credentials');
            return redirect('pages/login');
        }

        $user = $this->db->columnFilter('users', 'security_code', $code);
        if (!$user || $user['password'] !== base64_encode($password)) {
            setMessage('error', 'Invalid credentials');
            return redirect('pages/login');
        }

        $this->db->setLogin($user['id']);

        session_start();
        $agent = $this->db->columnFilter('user_full_info', 'id', $user['id']);
        $_SESSION['user'] = $user;

        $route = $user['role_id'] === ADMIN_ROLE ? 'admin/home' : 'agent/home';
        redirect($route);
    }





    public function forgetpassword()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') return;

        $email = trim($_POST['email'] ?? '');

        // Only send the email to validator
        $validation = new UserValidator(['email' => $email]);
        $errors = $validation->validateForm();
        // var_dump($errors);
        // die();

        // If email validation fails, show errors
        if (!empty($errors)) {
            setMessage('error', $errors['email-err'] ?? 'Invalid email!');
            return redirect('pages/forgetpassword');
        }

        // Check if email exists in DB
        $user = $this->db->columnFilter('users', 'email', $email);
        if (!$user) {
            setMessage('error', 'Email is not registered');
            return redirect('pages/forgetpassword');
        }

        // Get security info
        $security = $this->db->columnFilter('users', 'id', $user['id']);
        if (!$security) {
            setMessage('error', 'Security record not found');
            return redirect('pages/forgetpassword');
        }

        // Generate OTP
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

        // Send OTP email
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

            $postData = $_POST;

            $email = trim($postData['email'] ?? '');
            $phone = trim($postData['phonenumber'] ?? '');
            $password = trim($postData['password'] ?? '');
            $confirm = trim($postData['confirm_password'] ?? '');

            // 1️⃣ Validate format using your UserValidator
            $validator = new UserValidator($postData);
            $errors = $validator->validateForm(); // returns array of format errors


            // 2️⃣ Check password confirmation
            if ($password !== $confirm) {
                $errors['confirm'][] = 'Password does not match the confirmation';
            }

            // 3️⃣ Check if email or phone already exists
            if (!empty($email) && $this->db->columnFilter('users', 'email', $email)) {
                $errors['email'][] = 'Email is already registered';
            }

            if (!empty($phone) && $this->db->columnFilter('users', 'phone', $phone)) {
                $errors['phone'][] = 'Phone number is already registered';
            }

            // 4️⃣ Show all errors using setMessage
            if (!empty($errors)) {
                foreach ($errors as $fieldErrors) {
                    if (is_array($fieldErrors)) {
                        foreach ($fieldErrors as $err) {
                            setMessage('error', $err);
                        }
                    } else {
                        setMessage('error', $fieldErrors);
                    }
                }
                redirect('pages/register'); // go back to the form
                return;
            }

            // 5️⃣ All good, insert user
            $securityCode = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);
            $param = [
                $postData['name'],
                $phone,
                $email,
                $postData['region_id'],
                $postData['city_id'],
                $postData['township_id'],
                $postData['ward_id'],
                $postData['address'],
                base64_encode($password),
                null,
                null,
                $securityCode,
                2,
                3,
                date('Y-m-d H:i:s'),
                0
            ];

            $usercreate = $this->db->insertuser(...$param);

            if ($usercreate) {
                (new Mail)->welcomeamil($email, $postData['name']);
                redirect('pages/login');
            } else {
                setMessage('error', 'Registration failed');
                redirect('pages/register');
            }
        }
    }

    public function customerregister()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') return;

        // Collect and sanitize input
        $name = trim($_POST['name'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $phone = trim($_POST['phone'] ?? '');
        $password = $_POST['password'] ?? '';
        $confirm_password = $_POST['confirm_password'] ?? '';

        // Validation
        $errors = [];
        if (!$name) $errors[] = "Name is required";
        if (!$email || !filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Valid email is required";
        if (!$phone || !preg_match('/^(09|\+959)\d{7,9}$/', $phone)) $errors[] = "Valid phone number is required";
        if (!$password) $errors[] = "Password is required";
        if ($password !== $confirm_password) $errors[] = "Passwords do not match";

        // Check for duplicates
        if ($this->db->columnFilter('users', 'email', $email)) $errors[] = "Email already exists";
        if ($this->db->columnFilter('users', 'phone', $phone)) $errors[] = "Phone number already exists";

        // Handle errors
        if (!empty($errors)) {
            foreach ($errors as $err) setMessage('error', $err);
            $this->view('pages/customerregister');
            return;
        }

        // Create user
        $params = [
            $name,
            $phone,
            $email,
            null,
            null,
            null,
            null,
            null,
            base64_encode($password),
            null,
            null,
            null,
            3,
            3,
            date('Y-m-d H:i:s'),
            0
        ];

        $this->db->insertuser(...$params);
        setMessage('success', 'Account created successfully');
        redirect('pages/customerlogin');
    }
}
