<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

class Auth extends Controller
{
    private $db;
    public function __construct()
    {
        $this->model('UserModel');
        $this->model('SecurityCodeModel');
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
            $townships = $this->db->columnFilterAll('townships', 'city_id', $cityId);
            echo json_encode($townships);
        }
    }

    public function getWards()
    {
        $townshipId = $_GET['township_id'] ?? null;
        if ($townshipId) {
            $wards = $this->db->columnFilterAll('wards', 'township_id', $townshipId);
            echo json_encode($wards);
        }
    }

    public function login()
    {
        //  echo "Hello Bo Kaw";
        //  exit;
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['security_code']) && isset($_POST['password'])) {
                $array = $_POST['security_code'];
                $security_code = implode('', $array);
                $password = base64_encode($_POST['password']);

                $ischeck = $this->db->columnFilter('user_security', 'security_code', $security_code);
                $id = $ischeck['user_id'];


                $isLogin = $this->db->columnFilter('users', 'id', $id);

                // var_dump($data);
                // die();
                if ($isLogin && $isLogin['role_id'] == 1) {

                    session_start();
                    $_SESSION['user'] = $isLogin;
                    redirect('admin/home');
                } elseif ($isLogin && $isLogin['role_id'] == 2) {
                    $this->view('agent/home');
                } else {
                    setMessage('error', 'Login Fail!');
                    redirect('pages/login');
                }
            } else {
                setMessage('error', 'Error');
                redirect('pages/login');
            }
        }
    }


    public function forgetpassword()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') return;

        session_start();

        $email = filter_var(trim($_POST['email'] ?? ''), FILTER_VALIDATE_EMAIL);
        if (!$email) {
            setMessage('error', 'Invalid email format');
            return redirect('pages/forgetpassword');
        }

        $user = $this->db->columnFilter('users', 'email', $email);
        if (!$user) {
            setMessage('error', 'Email is not registered');
            return redirect('pages/forgetpassword');
        }

        $security = $this->db->columnFilter('user_security', 'user_id', $user['id']);
        if (!$security) {
            setMessage('error', 'Security record not found');
            return redirect('pages/forgetpassword');
        }

        $otp = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);
        $expiry = date('Y-m-d H:i:s', strtotime('+5 minutes'));

        $updated = $this->db->update('user_security', $security['id'], [
            'otp_code' => $otp,
            'otp_expiry' => $expiry
        ]);

        if ($updated) {
            (new Mail())->sendOTP($email, $otp);
            $_SESSION['post_email'] = $email;
            return redirect('pages/otp');
        }

        setMessage('error', 'Failed to send OTP');
        redirect('pages/forgetpassword');
    }




    public function otp()
    {
        // echo "kyaw";
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            session_start();
            if (isset($_SESSION['post_email']) && isset($_POST['otp'])) {
                $otpArray = $_POST['otp'];
                $otp = implode('', $otpArray);
                $email = $_SESSION['post_email'];

                $checkid = $this->db->columnFilter('users', 'email', $email);
                $id = $checkid['id'];

                $otpcheck = $this->db->columnFilter('user_security', 'user_id', $id);
                $confirmotp = $otpcheck['otp_code'];

                if ($otpcheck && $confirmotp == $otp) {
                    $_SESSION['change_mail'] = $email;
                    redirect('pages/changepassword');
                } else {
                    setMessage('error', 'Invalid OTP');
                    redirect('pages/otp');
                }
            }
        }
    }

    public function changepassword()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            session_start();
            if (isset($_SESSION['post_email']) && isset($_POST['new_password']) && isset($_POST['confirm_password'])) {
                $email = $_SESSION['post_email'];
                $password = $_POST['new_password'];
                $confirm_password = $_POST['confirm_password'];
                $password = base64_encode($password);
                $confirm_password = base64_encode($confirm_password);

                $checkid = $this->db->columnFilter('users', 'email', $email);
                $id = $checkid['id'];

                $data = [
                    'password' => $password
                ];

                if ($password !== $confirm_password) {
                    setMessage('error', 'Password not match');
                    redirect('pages/changepassword');
                }
                $checkmail = $this->db->update('users', $id, $data);
                if ($checkmail) {
                    redirect('pages/login');
                } else {
                    setMessage('error', 'Password not changed');
                    redirect('pages/changepassword');
                }
            }
        }
    }

    public function register()
    {
        // echo "kyaw";
        // die();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            session_start();
            $email = $_POST['email'];
            $phone = $_POST['phonenumber'];

            $emailcheck = $this->db->columnFilter('users', 'email', $email);
            $phonecheck = $this->db->columnFilter('users', 'phone', $phone);
            if ($emailcheck || $phonecheck) {
                setMessage('error', 'This email or phone is already registered');
                redirect('pages/register');
            } else {
                $name = $_POST['name'];
                $password = $_POST['password'];
                $confirmpassword = $_POST['confirm_password'];
                $region_id = $_POST['region_id'];
                $city_id = $_POST['city_id'];
                $township_id = $_POST['township_id'];
                $ward_id = $_POST['ward_id'];
                $address = $_POST['address'];
               
                if ($password !== $confirmpassword) {
                    setMessage('error', 'Password not match');
                    redirect('pages/register');
                } else {
                    $password = base64_encode($password);


                    $user = new UserModel;
                    $user->setName($name);
                    $user->setEmail($email);
                    $user->setPhone($phone);
                    $user->setPassword($password);
                    $user->setRegion($region_id);
                    $user->setCity($city_id);
                    $user->setTownship($township_id);
                    $user->setWard($ward_id);
                    $user->setAddress($address);
                    $user->setrole_id(2);
                    $user->setCreated_at(date('Y-m-d h:i:s'), time());
                    $user->setStatus_id(3);


                    $create = $this->db->create('users', $user->toArray());

                    if ($create) {

                        $getid = $this->db->columnFilter('users', 'email', $email);
                        $id = $getid['id'];
                        $security_code = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);

                        $security = new SecurityCodeModel;
                        $security->setUser_id($id);
                        $security->setOtp_code(null);
                        $security->setOtp_expiry(null);
                        $security->setSecurity_code($security_code);
                        $security_create = $this->db->create('user_security', $security->toArray());
                        if ($security_create) {
                            $new =  new Mail();
                            $sentmail = $new->welcomeamil($email, $name);
                            redirect('pages/login');
                        } else {
                            echo "kyaw";
                            die();
                        }
                    } else {
                        setMessage('error', 'Failed to register');
                        redirect('pages/register');
                    }
                }
            }
        } else {
            echo "POST";
        }
    }
}
