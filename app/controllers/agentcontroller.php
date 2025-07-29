<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


class Agentcontroller extends Controller{
    private $db;
    public function __construct(){
        $this->model('UserModel');
        $this->model('Delivery');
        $this->model('notification');
        $this->db = new Database();
    }

  public function getShortCode($city)
  {
    $codes = [
      'Yangon' => 'YGN',
      'Mandalay' => 'MDY',
      'Monywa' => 'MYW',
      'Thanlyin' => 'TNL',
      'Hmawbi' => 'HMB',
      'Thaketa' => 'TKT',
      'Insein' => 'INS',
      'Pyin Oo Lwin' => 'POL',
      'Myingyan' => 'MYG',
      'Amarapura' => 'AMP',
      'Meiktila' => 'MKL',
      'Sagaing' => 'SGG',
      'Shwebo' => 'SHW',
      'Kale' => 'KLE',
      'Yinmabin' => 'YNB'
    ];

    return $codes[$city] ?? $city;
  }

  // public function voucher(){
  //   if($_SERVER['REQUEST_METHOD'] == 'POST'){
  //     $name = json_decode($_POST['agent_data'],true);

  //     //sender info
  //     $sender_name = $_POST['sender_name'];
  //     $sender_phone = $_POST['sender_phone'];
  //     $sender_email = $_POST['sender_email'];
  //     $sender_address = $_POST['sender_address'];

  //     //receiver info
  //     $receiver_name = $_POST['receiver_name'];
  //     $receiver_phone = $_POST['receiver_phone'];
  //     $receiver_email = $_POST['receiver_email'];
  //     $reciever_address = $_POST['receiver_address'];

  //     //package detail
  //     $weight = $_POST['weight'];
  //     $product_type = $_POST['product_type'];

  //   //location
  //   $region = $_POST['senderAgentRegion'];
  //   $cities = $_POST['senderAgentCity'];
  //   $payment = $_POST['payment'];

  //   $routecheck = $this->db->checkroute('route',$name['city_id'] ,$cities);
  //   $checkagent = $this->db->checkadmin('users','city_id',$cities);

  //   // $totalprice = $routecheck['price'];

  //   if($routecheck){

  //     //sender customer register
  //     $sender = new UserModel();
  //     $sender->setName($sender_name);
  //     $sender->setEmail($sender_email);
  //     $sender->setPhone($sender_phone);
  //     $sender->setAddress($sender_address);
  //     $sender->setCity($cities);
  //     $sender->setRegion($region);
  //     $sender->setTownship(null);
  //     $sender->setWard(null);
  //     $sender->setAddress($sender_address);
  //     $sender->setPassword(null);
  //     $sender->setOtp_code(null);
  //     $sender->setOtp_expiry(null);
  //     $sender->setSecurity_code(null);
  //     $sender->setStatus_id(null);
  //     $sender->setRole_id(3);
  //     $sender->setisLogin(0);
  //     $sender->setCreated_at(date('Y-m-d H:i:s'));

  //     $sendercreate = $this->db->create('users',$sender->toArray());


  //     //receiver customer register
  //     $receicer = new UserModel();
  //     $receicer->setName($receiver_name);
  //     $receicer->setEmail($receiver_email);
  //     $receicer->setPhone($receiver_phone);
  //     $receicer->setAddress($reciever_address);
  //     $receicer->setCity($name['city_id']);
  //     $receicer->setRegion($name['region_id']);
  //     $receicer->setTownship(null);
  //     $receicer->setWard(null);
  //     $receicer->setAddress($reciever_address);
  //     $receicer->setPassword(null);
  //     $receicer->setOtp_code(null);
  //     $receicer->setOtp_expiry(null);
  //     $receicer->setSecurity_code(null);
  //     $receicer->setStatus_id(null);
  //     $receicer->setRole_id(3);
  //     $receicer->setisLogin(0);
  //     $receicer->setCreated_at(date('Y-m-d H:i:s'));

  //     $receicercreate = $this->db->create('users', $receicer->toArray());

  //     //calculate price 
  //     $totalprice = $weight * $routecheck['price'];

  //     //get id from database
  //     $sender_agent_id = $name['id'];
  //     $receiver_agent_id = $checkagent['id']; 
  //     $from_city_id = $name['city_id'];       
  //     $sender_customer_id = $this->db->columnFilter('users','email',$sender_email);
  //     $receiver_customer_id = $this->db->columnFilter('users','email',$receiver_email);
  //     $payment_status_id = $this->db->columnFilter('payment_statuses','name',$payment);

  //     //calculate tracking_number
  //     $city_name = $this->db->columnFilter('cities', 'id', $from_city_id);
  //     $shortname = $this->getShortCode($city_name['name']);
  //     $to_city_name = $this->db->columnFilter('cities','id',$checkagent['city_id']);
  //     $shortname2 = $this->getShortCode($to_city_name['name']);
  //     $randomnumber = str_pad(rand(0,999999),6,"0",STR_PAD_LEFT);
  //     $tracking_number = $shortname.$randomnumber.$shortname2;

  //     date_default_timezone_set('Asia/Yangon');
  //     $route_duration = $routecheck['time']; 


  //     $duration_seconds = strtotime($route_duration) - strtotime('TODAY');

  //     $estimated_arrival = time() + $duration_seconds;

  //     $deliver=new Delivery();
  //     $deliver->setSenderagentid($sender_agent_id);
  //     $deliver->setReceiveragentid($receiver_agent_id);
  //     $deliver->setSendCustomerid($sender_customer_id['id']);
  //     $deliver->setReceiveCustomerid($receiver_customer_id['id']);
  //     $deliver->setFromcityid($from_city_id);
  //     $deliver->setTocityid($cities);
  //     $deliver->setWeight($weight);
  //     $deliver->setAmount($totalprice);
  //     $deliver->setDeliverystatusid(1);
  //     $deliver->setPaymentstatusid($payment_status_id['id']);
  //     $deliver->setcreatedat(date('Y-m-d H:i:s'));
  //     $deliver->setUpdated_at(null);
  //     $deliver->setProducttype($product_type);
  //     $deliver->setTrackingnumber($tracking_number);
  //     $deliver->setDurationtime(date("Y-m-d H:i:s", $estimated_arrival));

  //     $deliverycreate = $this->db->create('deliveries',$deliver->toArray());
  //     if($deliverycreate){



  //       //create notification 
  //       $title = "New Delivery Available!";
  //       $message = "A new delivery request (Order ID: #".$tracking_number.") is available for
  //                         acceptance. Check 'Available Deliveries' page.";

  //       $user = new Notification();
  //       $user->setFromagentid($sender_agent_id);
  //       $user->setToagentid($receiver_agent_id);
  //       $user->setTypeid(1);
  //       $user->setTitle($title);
  //       $user->setMessage($message);
  //       date_default_timezone_set('Asia/Yangon');
  //       $user->setCreatedAt(date('Y-m-d H:i:s'));

  //       $createnoti = $this->db->create('agent_notifications', $user->toArray());

  //       $delivery_data = $this->db->columnFilter("view_deliveries_detailed", "tracking_code", $tracking_number);
  //       $data = [
  //         "create_data" => $delivery_data
  //       ];

  //       $this->view('agent/voucher_detail',$data);

  //     }


  //   }else{
  //     setMessage('error','route is not active');
  //     redirect('agent/voucher');
  //   }

  // }
  // }


  public function voucher()
  {
    require_once APPROOT . '/helpers/Voucher_helper.php';

    if ($_SERVER['REQUEST_METHOD'] != 'POST') return;

    $agent = json_decode($_POST['agent_data'], true);

    $user = new Voucher_helper();

    $senderData = $user->getSenderData($_POST);
    $receiverData = $user->getReceiverData($_POST, $agent);

    $route = $this->db->checkroute('route', $agent['city_id'], $senderData['city_id']);
    $receiverAgent = $this->db->checkadmin('users', 'city_id', $senderData['city_id']);

    if (!$route) {
      setMessage('error', 'Route is not active');
      return redirect('agent/voucher');
    }

    $senderId = $user->createUser($senderData);
    $receiverId = $user->createUser($receiverData);

    $trackingNumber = $user->generateTrackingNumber($agent['city_id'], $receiverAgent['city_id']);
    $arrivalTime = $user->calculateArrivalTime($route['time']);

    $totalPrice = $_POST['weight'] * $route['price'];
    $paymentStatus = $this->db->columnFilter('payment_statuses', 'name', $_POST['payment']);

    $deliveryData = $user->buildDeliveryData($_POST, $agent, $receiverAgent, $senderId, $receiverId, $trackingNumber, $arrivalTime, $totalPrice, $paymentStatus['id']);
    $this->db->create('deliveries', $deliveryData);

    $user->createNotification($agent['id'], $receiverAgent['id'], $trackingNumber);

    $deliveryDetails = $this->db->columnFilter("view_deliveries_detailed", "tracking_code", $trackingNumber);
    $this->view('agent/voucher_detail', ['create_data' => $deliveryDetails]);
  }




  public function search(){
      if($_SERVER['REQUEST_METHOD'] == 'GET'){
        $code = $_GET['q'];
        $tracking_code = $this->db->columnFilter('view_deliveries_detailed','tracking_code',$code);
        $data = [
          'tracking_code' => $tracking_code
        ];
        $this->view('agent/result',$data);

      }
    }

    public function delivery_detail($code){
    $tracking_code = $this->db->columnFilter('view_deliveries_detailed', 'tracking_code', $code);
    $data = [
      'tracking_code' => $tracking_code
    ];
    $this->view('agent/result', $data);
  }


  public function requestaccept()
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $code = $_POST['tracking_code'];
      $delivery = $this->db->columnFilter('deliveries', 'tracking_code', $code);
      $title = "Delivery Accepted!";
      $message = "You have successfully accepted Delivery ID: " . $code . ". Proceed to pickup location.";

      if ($delivery) {
        $accept = $this->db->update('deliveries', $delivery['id'], ['delivery_status_id' => 2]);

        if ($accept) {
          $user = new Notification();
          $user->setFromagentid($delivery['receiver_agent_id']);
          $user->setToagentid($delivery['sender_agent_id']);
          $user->setTypeid(1);
          $user->setTitle($title);
          $user->setMessage($message);
          date_default_timezone_set('Asia/Yangon');
          $user->setCreatedAt(date('Y-m-d H:i:s'));

          $createnoti = $this->db->create('agent_notifications',$user->toArray());
          

          redirect('agent/request?accepted=1');
        }
      }
      // If something went wrong
      redirect('agent/request?accepted=0');
    }
  }


  public function get_data($code){
    $tracking_code = $this->db->columnFilter('view_deliveries_detailed', 'tracking_code', $code);
    $data = [
      'tracking_code' => $tracking_code
    ];
    $this->view('agent/update_status', $data);
  }

  
  public function edit_incomedelivery($code)
  {
    $tracking_code = $this->db->columnFilter('view_deliveries_detailed', 'tracking_code', $code);
    $data = [
      'tracking_code' => $tracking_code
    ];
    $this->view('agent/update_status_incoming', $data);
  }

      public function show_updated_status(){
          if($_SERVER['REQUEST_METHOD'] == 'POST'){
              $code = $_POST['tracking_code'];
              $status = $_POST['new_status'];
              $notes = $_POST['notes'];
  
              $id_result = $this->db->columnFilter('deliveries','tracking_code',$code);
              $delivery_id = $id_result['id'] ?? null; // Get the ID, handle if not found
  
              $changestatus = false;
              if ($delivery_id) {
                  $changestatus = $this->db->update('deliveries',$delivery_id,['delivery_status_id' => $status]);
              }
  
              if($changestatus){
                  $message = urlencode('Status updated successfully!');
                  $message_type = 'success';
              } else {
                  $message = urlencode('Failed to update status. Please try again.');
                  $message_type = 'error';
              }
  
              header("Location: " . URLROOT . "/agentcontroller/get_data/" . urlencode($code) . "?message_type=" . $message_type . "&message=" . $message);
              exit(); 
          }
      }

  public function show_updated_status_income()
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $code = $_POST['tracking_code'];
      $status = $_POST['new_status'];
      $notes = $_POST['notes'];


      $id_result = $this->db->columnFilter('deliveries', 'tracking_code', $code);
      $delivery_id = $id_result['id'] ?? null; 
      // var_dump($delivery_id);
      // die();

      $changestatus = false;
      if ($delivery_id) {
        $changestatus = $this->db->update('deliveries', $delivery_id, ['delivery_status_id' => $status]);
      }

      if ($changestatus) {
        $message = urlencode('Status updated successfully!');
        $message_type = 'success';
      } else {
        $message = urlencode('Failed to update status. Please try again.');
        $message_type = 'error';
      }
      
      header("Location: " . URLROOT . "/agentcontroller/edit_incomedelivery/" . urlencode($code) . "?message_type=" . $message_type . "&message=" . $message);
      exit();
    }
  }

  public function send_otp()
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $email = $_POST['email'];
      $otp = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);

      $id = $this->db->columnFilter('users', 'email', $email);
      $iscreated = $this->db->update('users', $id['id'], ['otp_code' => $otp]);

      if ($iscreated) {
        $user = new Mail();
        $user->sendOTP($email, $otp);

        header("Location: " . URLROOT . "/agent/profile?otp=1");
        exit;
      } else {
        // Handle error, maybe show alert
      }
    }
  }


  }



?>