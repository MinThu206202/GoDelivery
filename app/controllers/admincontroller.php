<?php 

class admincontroller extends Controller{
    private $db;
    public function __construct(){
        $this->model('UserModel');
        $this->db = new Database();
    }

    public function changephone(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $new_phone = $_POST['new_phone'];
            $password = $_POST['password'];
            session_start();
            $user = $_SESSION['user'];
            $password_id = $user['password'];
            $id = $user['id'];
            $checkphone = $this->db->columnFilter('users','phone',$new_phone);
            if($checkphone){
                setMessage ('error','New Phone Number is already taken');
                redirect('admin/profile');
            }else{
                if(!$checkphone && $password == $password_id){
                    $data = [
                        'phone' => $new_phone
                    ];
                    $change = $this->db->update('users',$id,$data);
                    if($change){
                        redirect('admin/profile');
                    }else{
                        echo "Fail";
                        die();
                    }
                }
            }
        }
    }


    public function changepassword(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $password = $_POST['current_password'];
            $newpassword = $_POST['new_password'];
            $confirmpassword = $_POST['confirm_password'];
            session_start();
            $user = $_SESSION['user'];
            $id = $user['id'];
            $pass = $user['password'];
            $newpassword = base64_encode($newpassword);
            $password = base64_encode($password);
            // echo base64_decode($pass);
            // die();
            if($newpassword !== $confirmpassword){
                setMessage ('error','Password do not match');
                redirect('admin/profile');
            }
            if($password !== $user['password']){
                setMessage ('error' , 'Current Password is not Match');
                redirect('admin/profile');
            }else{
                $data = [
                    'password' => $newpassword
                ];
                $ischange = $this->db->update('users',$id,$data);
                if($ischange){
                    redirect('admin/profile');
                }else{
                    setMessage('error','Password can not change');
                    redirect('admin/profile');
                }
            }
        }
    }

    public function  set_agent_session(){
        session_start();

        $agentId = $_GET['id'] ?? null;            
        $isagent = $this->db->agentbyid($agentId);
        $isdelivery = $this->db->deliverybyid($agentId);
        // var_dump($agentId);
        // die();
        $data = [
            'agent' => $isagent,
            'delivery' => $isdelivery
        ];
        $this->view('admin/agent_profile',$data);
    }

}


?>