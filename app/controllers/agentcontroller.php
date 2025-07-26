<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class Agentcontroller extends Controller{
    private $db;
    public function __construct(){
        $this->model('UserModel');
        $this->model('Delivery');
        $this->db = new Database();
    }

    public function voucher(){
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $name = json_decode($_POST['agent_data'],true);
     
        //sender info
        $sender_name = $_POST['sender_name'];
        $sender_phone = $_POST['sender_phone'];
        $sender_email = $_POST['sender_email'];
        $sender_address = $_POST['sender_address'];

        //receiver info
        $receiver_name = $_POST['receiver_name'];
        $receiver_phone = $_POST['receiver_phone'];
        $receiver_email = $_POST['receiver_email'];
        $reciever_address = $_POST['receiver_address'];

        //package detail
        $weight = $_POST['weight'];
        $product_type = $_POST['product_type'];

      //location
      $region = $_POST['senderAgentRegion'];
      $cities = $_POST['senderAgentCity'];
      $payment = $_POST['payment'];

      $routecheck = $this->db->checkroute('route',$name['city_id'] ,$cities);
      $checkagent = $this->db->checkadmin('users','city_id',$cities);

      // $totalprice = $routecheck['price'];

      if($routecheck){
      
        //sender customer register
        $sender = new UserModel();
        $sender->setName($sender_name);
        $sender->setEmail($sender_email);
        $sender->setPhone($sender_phone);
        $sender->setAddress($sender_address);
        $sender->setCity($cities);
        $sender->setRegion($region);
        $sender->setTownship(null);
        $sender->setWard(null);
        $sender->setAddress($sender_address);
        $sender->setPassword(null);
        $sender->setOtp_code(null);
        $sender->setOtp_expiry(null);
        $sender->setSecurity_code(null);
        $sender->setStatus_id(null);
        $sender->setRole_id(3);
        $sender->setisLogin(0);
        $sender->setCreated_at(date('Y-m-d H:i:s'));

        $sendercreate = $this->db->create('users',$sender->toArray());
        

        //receiver customer register
        $receicer = new UserModel();
        $receicer->setName($receiver_name);
        $receicer->setEmail($receiver_email);
        $receicer->setPhone($receiver_phone);
        $receicer->setAddress($reciever_address);
        $receicer->setCity($name['city_id']);
        $receicer->setRegion($name['region_id']);
        $receicer->setTownship(null);
        $receicer->setWard(null);
        $receicer->setAddress($reciever_address);
        $receicer->setPassword(null);
        $receicer->setOtp_code(null);
        $receicer->setOtp_expiry(null);
        $receicer->setSecurity_code(null);
        $receicer->setStatus_id(null);
        $receicer->setRole_id(3);
        $receicer->setisLogin(0);
        $receicer->setCreated_at(date('Y-m-d H:i:s'));

        $receicercreate = $this->db->create('users', $receicer->toArray());

        $totalprice = $weight * $routecheck['price'];

        $sender_agent_id = $name['id'];
        $receiver_agent_id = $checkagent['id']; 
        $from_city_id = $name['city_id'];       
        $sender_customer_id = $this->db->columnFilter('users','email',$sender_email);
        $receiver_customer_id = $this->db->columnFilter('users','email',$receiver_email);
        $payment_status_id = $this->db->columnFilter('payment_statuses','name',$payment);


        $deliver=new Delivery();
        $deliver->setSenderagentid($sender_agent_id);
        $deliver->setReceiveragentid($receiver_agent_id);
        $deliver->setSendCustomerid($sender_customer_id['id']);
        $deliver->setReceiveCustomerid($receiver_customer_id['id']);
        $deliver->setFromcityid($from_city_id);
        $deliver->setTocityid($cities);
        $deliver->setWeight($weight);
        $deliver->setAmount($totalprice);
        $deliver->setDeliverystatusid(2);
        $deliver->setPaymentstatusid($payment_status_id['id']);
        $deliver->setcreatedat(date('Y-m-d H:i:s'));
        $deliver->setUpdated_at(null);
        $deliver->setProducttype($product_type);

        $deliverycreate = $this->db->create('deliveries',$deliver->toArray());
        if($deliverycreate){
          echo "min";
          die;
        }


      }else{
        setMessage('error','route is not active');
        redirect('agent/voucher');
      }

    }
    }

}




?>