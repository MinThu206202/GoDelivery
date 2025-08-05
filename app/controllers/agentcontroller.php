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
        $this->model('NormalUser');
        $this->model('PremiumUser');
        $this->model('Delivery_status_Model');
        $this->db = new Database();
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
    // var_dump($senderData);
    // die();
    $receiverData = $user->getReceiverData($_POST, $agent);

    $route = $this->db->checkroute('route', $agent['township_id'], $senderData['township_id']);
    $receiverAgent = $this->db->checkadmin('users', 'township_id', $senderData['city_id']);

    if (!$route) {
      setMessage('error', 'Route is not active');
      return redirect('agent/voucher');
    }

    if(!$receiverAgent){
      echo "agent is not active";
      die();
    }

    $trackingNumber = $user->generateTrackingNumber($agent['city_id'], $receiverAgent['city_id']);
    $arrivalTime = $user->calculateArrivalTime($route['time']);

    // $chelckusertype = $this->db->columnFilter('users','email',$_POST['sender_email']);
    // if($chelckusertype['user_type_id'] === Premium_user){
    //   $routeat = new PremiumUser();

    // }else{
    //   $routeat = new NormalUser();
    // }

    // $actualbonus = $routeat->getbonus();


    $totalPrice = (float)$_POST['weight'] * (float) $route['price'];

    // $totalPrice = $Amountprice - ($Amountprice * $actualbonus);

    $paymentStatus = $this->db->columnFilter('payment_statuses', 'name', $_POST['payment']);

    $senderId = $user->createUser($senderData);
    $receiverId = $user->createUser($receiverData);

    $deliveryData = $user->buildDeliveryData($_POST, $agent, $receiverAgent, $senderId, $receiverId, $trackingNumber, $arrivalTime, $totalPrice, $paymentStatus['id']);
    $this->db->create('deliveries', $deliveryData);

    $trackingcode = $this->db->columnFilter('deliveries','tracking_code',$trackingNumber);

    $deliveryhistory = new Delivery_status_Model();
    $deliveryhistory->delivery_id = $trackingcode['id'];
    $deliveryhistory->status_id = 1;
    $deliveryhistory->changed_by = null;
    $deliveryhistory->note = null;
    $deliveryhistory->changed_at = null;

    $createdeliveryhistory = $this->db->create('delivery_status_history',$deliveryhistory->toArray());
    if(!$createdeliveryhistory){
      setMessage ('error' , 'Delivery Status history is not insert');
      return redirect('agent/voucher');
    }
    

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
    $update_status = $this->db->columnFilterAll('view_delivery_status_history', 'tracking_code', $code);
    $data = [
      'tracking_code' => $tracking_code,
      'update_status' => $update_status
    ];
    $this->view('agent/result', $data);
  }


  public function requestaccept()
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $code = $_POST['tracking_code'];
      $delivery = $this->db->columnFilter('deliveries', 'tracking_code', $code);

      if ($delivery && $this->db->update('deliveries', $delivery['id'], ['delivery_status_id' => 2])) {
        $this->db->create('agent_notifications', [
          'from_agent_id' => $delivery['receiver_agent_id'],
          'to_agent_id'   => $delivery['sender_agent_id'],
          'type_id'       => 1,
          'title'         => 'Delivery Accepted!',
          'message'       => "You accepted delivery: $code. Proceed to pickup.",
          'created_at'    => date('Y-m-d H:i:s', time())
        ]);
        return redirect('agent/request?accepted=1');
      }

      return redirect('agent/request?accepted=0');
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

  public function show_updated_status()
  {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') return;
    session_start();
    $code   = $_POST['tracking_code'];
    $status = $_POST['new_status'];
    $notes  = $_POST['notes'];
    $agent = $_SESSION['user'];


    $delivery = $this->db->columnFilter('deliveries', 'tracking_code', $code);
    $delivery_id = $delivery['id'] ?? null;

    $get_delivery_status_id = $this->db->columnFilter('view_delivery_status_history','delivery_id',$delivery_id);


    if (!$delivery_id) {
      $this->redirectWithMessage($code, 'Failed to update status. Delivery not found.', 'error');
      return;
    }

    date_default_timezone_set('Asia/Yangon');

    $status_history = new Delivery_status_Model();
    $status_history->delivery_id = $delivery_id;
    $status_history->status_id = $status;
    $status_history->changed_by = $agent['id'];
    $status_history->note = $notes;
    $status_history->changed_at = date('Y-m-d H:i:s');

    $status_history_chaged = $this->db->create('delivery_status_history',$status_history->toArray());


    $statusChanged = $this->db->update('deliveries', $delivery_id, [
      'delivery_status_id' => $status
    ]);

    if ($statusChanged && $status === "4") {
      $this->sendCancelNotification($delivery);
    }

    $msgType = $statusChanged ? 'success' : 'error';
    $msgText = $statusChanged ? 'Status updated successfully!' : 'Failed to update status. Please try again.';
    $this->redirectWithMessage($code, $msgText, $msgType);
  }

  private function sendCancelNotification($delivery)
  {
    $notif = new Notification();
    $notif->setFromagentid($delivery['sender_agent_id']);
    $notif->setToagentid($delivery['receiver_agent_id']);
    $notif->setTypeid(3);
    $notif->setTitle("System Alert: Delivery Cancelled");
    $notif->setMessage("Voucher {$delivery['tracking_code']} has been cancelled by the customer.");
    $notif->setCreatedAt(date('Y-m-d H:i:s', strtotime('now')));

    $this->db->create('agent_notifications', $notif->toArray());
  }

  private function redirectWithMessage($code, $message, $type)
  {
    header("Location: " . URLROOT . "/agentcontroller/get_data/" . urlencode($code) . "?message_type={$type}&message=" . urlencode($message));
    exit();
  }

  public function show_updated_status_income()
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $code   = $_POST['tracking_code'];
      $status = $_POST['new_status'];
      $notes  = $_POST['notes'];

      $delivery = $this->db->columnFilter('deliveries', 'tracking_code', $code);
      $id = $delivery['id'] ?? null;

      if ($id && $this->db->update('deliveries', $id, ['delivery_status_id' => $status])) {

        $statusNotifications = [
          '3' => ['title' => 'Delivery Completed', 'message' => "Delivery $code marked as 'Delivered'. Earnings processed.", 'type' => 2],
          '5' => ['title' => 'Return Initiated', 'message' => "Return started for voucher $code. Please check it.", 'type' => 3]
        ];

        if (isset($statusNotifications[$status])) {
          date_default_timezone_set('Asia/Yangon');
          $data = $statusNotifications[$status];
          $this->db->create('agent_notifications', [
            'from_agent_id' => $delivery['receiver_agent_id'],
            'to_agent_id'   => $delivery['sender_agent_id'],
            'type_id'       => $data['type'],
            'title'         => $data['title'],
            'message'       => $data['message'],
            'created_at'    => date('Y-m-d H:i:s')
          ]);
        }

        $msg = ['type' => 'success', 'text' => 'Status updated successfully!'];
      } else {
        $msg = ['type' => 'error', 'text' => 'Failed to update status.'];
      }

      header("Location: " . URLROOT . "/agentcontroller/edit_incomedelivery/" . urlencode($code) . "?message_type={$msg['type']}&message=" . urlencode($msg['text']));
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


  public function logout()
  {
    session_start();

    $id = $_SESSION['user']['id'] ?? null;
    if ($id) {
      $this->db->unsetLogin($id);
    }

    session_destroy();

    $this->view('pages/login');
    exit();
  }
}



?>