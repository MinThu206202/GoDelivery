<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


class Agentcontroller extends Controller
{
  private $db;

  public function __construct()
  {
    $this->model('UserModel');
    $this->model('Delivery');
    $this->model('notification');
    $this->model('NormalUser');
    $this->model('PremiumUser');
    $this->model('Delivery_status_Model');
    $this->model('VehicleModel');
    $this->model('paymentModel');
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
    $receiverAgent = $this->db->checkadmin('users', 'township_id', $senderData['township_id']);


    if (!$route) {
      setMessage('error', 'Route is not active');
      return redirect('agent/voucher');
    }

    if (!$receiverAgent) {
      setMessage('error', 'Agent is not active');
      return redirect('agent/voucher');
    }

    $trackingNumber = $user->generateTrackingNumber($agent['city_id'], $receiverAgent['city_id']);
    $arrivalTime = $user->calculateArrivalTime($route['time']);


    $totalPrice = (float)$_POST['weight'] * (float) $route['price'];

    $paymentStatusId = $_POST['payment'];

    // $paymentStatus = $this->db->columnFilter('payment_statuses', 'name', $_POST['payment']);

    $senderId = $user->createUser($senderData);
    $receiverId = $user->createUser($receiverData);

    $deliveryData = $user->buildDeliveryData($_POST, $agent, $receiverAgent, $senderId, $receiverId, $trackingNumber, $arrivalTime, $totalPrice, $paymentStatusId);
    $this->db->create('deliveries', $deliveryData);

    $trackingcode = $this->db->columnFilter('deliveries', 'tracking_code', $trackingNumber);

    $deliveryhistory = new Delivery_status_Model();
    $deliveryhistory->delivery_id = $trackingcode['id'];
    $deliveryhistory->status_id = 1;
    $deliveryhistory->changed_by = null;
    $deliveryhistory->note = null;
    $deliveryhistory->changed_at = null;

    $createdeliveryhistory = $this->db->create('delivery_status_history', $deliveryhistory->toArray());
    if (!$createdeliveryhistory) {
      setMessage('error', 'Delivery Status history is not insert');
      return redirect('agent/voucher');
    }


    $user->createNotification($agent['id'], $receiverAgent['id'], $trackingNumber);

    $deliveryDetails = $this->db->columnFilter("view_deliveries_detailed", "tracking_code", $trackingNumber);
    $this->view('agent/voucher_detail', ['create_data' => $deliveryDetails]);
  }

  public function search()
  {
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
      $code = $_GET['q'];
      $tracking_code = $this->db->columnFilter('view_deliveries_detailed', 'tracking_code', $code);
      $update_status = $this->db->columnFilterAll('view_delivery_status_history', 'tracking_code', $code);

      $data = [
        'code' => $code,
        'tracking_code' => $tracking_code,
        'update_status' => $update_status,
      ];
      $this->view('agent/result', $data);
    }
  }

  public function delivery_detail($code)
  {
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
        return redirect('agent/deliveryrequest?accepted=1');
      }

      return redirect('agent/deliveryrequest?accepted=0');
    }
  }

  public function requestreject()
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $code = $_POST['tracking_code'];
      $delivery = $this->db->columnFilter('deliveries', 'tracking_code', $code);

      if ($delivery && $this->db->update('deliveries', $delivery['id'], ['delivery_status_id' => 15])) {
        $this->db->create('agent_notifications', [
          'from_agent_id' => $delivery['receiver_agent_id'],
          'to_agent_id'   => $delivery['sender_agent_id'],
          'type_id'       => 3,
          'title'         => 'Delivery Reject!',
          'message'       => "Your  delivery: $code is Reject.Try Again.",
          'created_at'    => date('Y-m-d H:i:s', time())
        ]);
        return redirect('agent/deliveryrequest?accepted=0');
      }

      return redirect('agent/deliveryrequest?accepted=1');
    }
  }


  public function get_data($code)
  {
    $tracking_code = $this->db->columnFilter('view_deliveries_detailed', 'tracking_code', $code);
    $data = [
      'tracking_code' => $tracking_code
    ];
    $this->view('agent/update_status', $data);
  }

  public function request_other_agent()
  {
    $id = $_GET['id'];
    $this->db->update('deliveries', $id, ['delivery_status_id' => 6]);
    date_default_timezone_set('Asia/Yangon');

    $delivery_info = $this->db->getById('deliveries', $id);

    $code = $delivery_info['tracking_code'];

    date_default_timezone_set('Asia/Yangon');
    $this->db->create('agent_notifications', [
      'from_agent_id' => $delivery_info['sender_agent_id'],
      'to_agent_id'   => $delivery_info['receiver_agent_id'],
      'type_id'       => 1,
      'title'         => "New Delivery Request",
      'message'       => "New request received for Delivery $code",
      'created_at'    => date('Y-m-d H:i:s')
    ]);

    header("Location: " . URLROOT . "/agentcontroller/get_data/" . urlencode($code));
    exit();
  }

  public function cancel_delivery()
  {
    $id = $_GET['id'];
    $delivery_info = $this->db->getById('deliveries', $id);

    $code = $delivery_info['tracking_code'];
    $this->db->update('deliveries', $id, ['delivery_status_id' => 4]);
    header("Location: " . URLROOT . "/agentcontroller/get_data/" . urlencode($code));
    exit();
  }
  public function start_delivery()
  {
    $id = $_GET['id'];
    $this->db->update('deliveries', $id, ['delivery_status_id' => 13]);

    date_default_timezone_set('Asia/Yangon');

    $delivery_info = $this->db->getById('deliveries', $id);

    $code = $delivery_info['tracking_code'];

    date_default_timezone_set('Asia/Yangon');
    $status_history = new Delivery_status_Model();
    $status_history->delivery_id = $id;
    $status_history->status_id = 13;
    $status_history->changed_by = $delivery_info['sender_agent_id'];
    $status_history->note = null;
    $status_history->changed_at = date('Y-m-d H:i:s');

    $status_history_chaged = $this->db->create('delivery_status_history', $status_history->toArray());

    header("Location: " . URLROOT . "/agentcontroller/get_data/" . urlencode($code));
    exit();
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



    $get_delivery_status_id = $this->db->columnFilter('view_delivery_status_history', 'delivery_id', $delivery_id);


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

    $status_history_chaged = $this->db->create('delivery_status_history', $status_history->toArray());


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



  public function arrived_at_office()
  {
    $id = $_GET['id'];
    $this->db->update('deliveries', $id, ['delivery_status_id' => 14]);
    date_default_timezone_set('Asia/Yangon');

    $delivery_info = $this->db->getById('deliveries', $id);

    $code = $delivery_info['tracking_code'];


    $status_history = new Delivery_status_Model();
    $status_history->delivery_id = $id;
    $status_history->status_id = 14;
    $status_history->changed_by = $delivery_info['sender_agent_id'];
    $status_history->note = null;
    $status_history->changed_at = date('Y-m-d H:i:s');

    $status_history_chaged = $this->db->create('delivery_status_history', $status_history->toArray());

    date_default_timezone_set('Asia/Yangon');
    $this->db->create('agent_notifications', [
      'from_agent_id' => $delivery_info['receiver_agent_id'],
      'to_agent_id'   => $delivery_info['sender_agent_id'],
      'type_id'       => 2,
      'title'         => "Delivery At Office",
      'message'       => "Delivery $code marked as 'Arrived at Office'. Ready for next processing.",
      'created_at'    => date('Y-m-d H:i:s')
    ]);

    header("Location: " . URLROOT . "/agentcontroller/edit_incomedelivery/" . urlencode($code));
    exit();
  }


  public function send_otp()
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $email = $_POST['email'] ?? null;

      if (!$email) {
        header("Location: " . URLROOT . "/agent/profile?message=Invalid+email&message_type=error");
        exit;
      }

      $otp = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);

      // Find user ID by email
      $id = $this->db->columnFilter('users', 'email', $email);

      if (!$id || empty($id['id'])) {
        header("Location: " . URLROOT . "/agent/profile?message=User+not+found&message_type=error");
        exit;
      }

      // Save OTP to DB
      $isUpdated = $this->db->update('users', $id['id'], ['otp_code' => $otp]);

      if ($isUpdated) {
        // Send mail
        $user = new Mail();
        $user->sendOTP($email, $otp);

        // Redirect back to profile with query params
        header("Location: " . URLROOT . "/agent/profile?otp_sent=1&message=OTP+sent+successfully&message_type=success&identifier=" . urlencode($email));
        exit;
      } else {
        header("Location: " . URLROOT . "/agent/profile?message=Failed+to+generate+OTP&message_type=error");
        exit;
      }
    }
  }


  public function verify_otp_submit()
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $email = $_POST['email'] ?? null;
      $otp   = isset($_POST['otp']) ? implode('', $_POST['otp']) : null;

      if (!$email || !$otp) {
        echo json_encode(['status' => 'error', 'message' => 'Invalid request']);
        exit;
      }

      $user = $this->db->columnFilter('users', 'email', $email);

      if (!$user || empty($user['id'])) {
        echo json_encode(['status' => 'error', 'message' => 'User not found']);
        exit;
      }

      if ($otp === $user['otp_code']) {
        echo json_encode(['status' => 'success', 'message' => 'OTP verified successfully']);
        exit;
      } else {
        echo json_encode(['status' => 'error', 'message' => 'Invalid OTP']);
        exit;
      }
    }
  }

  public function resend_otp_request()
  {
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
      $email = $_GET['identifier'] ?? null;

      if (!$email) {
        echo json_encode(['status' => 'error', 'message' => 'Email not provided']);
        exit;
      }

      // Generate new 6-digit OTP
      $otp = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);

      // Find user ID by email
      $user = $this->db->columnFilter('users', 'email', $email);

      if (!$user || empty($user['id'])) {
        echo json_encode(['status' => 'error', 'message' => 'User not found']);
        exit;
      }

      // Save OTP to DB
      $isUpdated = $this->db->update('users', $user['id'], ['otp_code' => $otp]);

      if ($isUpdated) {
        // Send OTP email
        $mailer = new Mail();
        $mailer->sendOTP($email, $otp);


        echo json_encode(['status' => 'success', 'message' => 'OTP resent successfully']);
        exit;
      } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to generate OTP']);
        exit;
      }
    }
  }

  public function reset_password_submit()
  {
    header('Content-Type: application/json');

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
      echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
      exit;
    }

    $newPassword = $_POST['newPassword'] ?? null;
    $confirmNewPassword = $_POST['confirmNewPassword'] ?? null;
    $email = $_POST['email'] ?? null;

    if (!$newPassword || !$confirmNewPassword || !$email) {
      echo json_encode(['status' => 'error', 'message' => 'Missing required fields']);
      exit;
    }

    if ($newPassword !== $confirmNewPassword) {
      echo json_encode(['status' => 'error', 'message' => 'Passwords do not match']);
      exit;
    }

    $user = $this->db->columnFilter('users', 'email', $email);
    if (!$user) {
      echo json_encode(['status' => 'error', 'message' => 'User not found']);
      exit;
    }

    // Hash password
    $hashedPassword = base64_encode($newPassword, PASSWORD_BCRYPT);
    $this->db->update('users', $user['id'], ['password' => $hashedPassword]);

    // Flash message
    $_SESSION['flash_message'] = [
      'type' => 'success',
      'message' => 'Password changed successfully!'
    ];

    echo json_encode([
      'status' => 'success',
      'message' => 'Password updated successfully',
      'redirect' => URLROOT .  '/agent/profile'
    ]);
    exit;
  }



  public function changepassword()
  {
    header('Content-Type: application/json');

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
      echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
      exit;
    }

    $currentPassword = $_POST['currentPassword'] ?? '';
    $newPassword = $_POST['newPassword'] ?? '';
    $confirmPassword = $_POST['confirmNewPassword'] ?? '';
    $email = $_POST['email'] ?? '';

    // Required field validation
    if (empty($currentPassword) || empty($newPassword) || empty($confirmPassword) || empty($email)) {
      echo json_encode(['status' => 'error', 'message' => 'All fields are required']);
      exit;
    }

    $current = base64_encode($currentPassword);
    $new = base64_encode($newPassword);
    $confirm = base64_encode($confirmPassword);

    if ($new !== $confirm) {
      echo json_encode(['status' => 'error', 'message' => 'New passwords do not match']);
      exit;
    }

    $user = $this->db->columnFilter('users', 'email', $email);

    if (!$user || $current !== $user['password']) {
      echo json_encode(['status' => 'error', 'message' => 'Current password is incorrect']);
      exit;
    }

    $this->db->update('users', $user['id'], ['password' => $new]);
    echo json_encode([
      'status' => 'success',
      'message' => 'Password updated successfully',
      'redirect' => URLROOT . '/agent/profile'
    ]);
  }

  public function updateprofile()
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      try {
        // --- Get text inputs ---
        $email   = $_POST['email'] ?? '';
        $name    = $_POST['fullName'] ?? '';
        $address = $_POST['address'] ?? '';

        // --- Load existing agent info from DB ---
        $agent = $this->db->columnFilter('users', 'email', $email);
        if (!$agent) {
          throw new Exception("Agent not found.");
        }

        // --- Default image path (keep old if no new upload) ---
        $imageUrl = $agent['profile_image'];

        // --- Handle file upload ---
        if (isset($_FILES['image']) && $_FILES['image']['error'] !== UPLOAD_ERR_NO_FILE) {
          $file = $_FILES['image'];

          // Upload directory inside project
          $uploadDir = $_SERVER['DOCUMENT_ROOT'] . "/Delivery/public/uploads/";


          // Ensure folder exists
          if (!is_dir($uploadDir)) {
            if (!mkdir($uploadDir, 0755, true)) {
              throw new Exception("Failed to create upload folder: " . $uploadDir);
            }
          }

          // Check writable
          if (!is_writable($uploadDir)) {
            throw new Exception("Upload folder is not writable: " . $uploadDir);
          }

          // Validate file size (max 5MB)
          $maxFileSize = 5 * 1024 * 1024; // 5MB
          if ($file['size'] > $maxFileSize) {
            throw new Exception("File is too large. Max 5MB.");
          }

          // Validate MIME type
          $allowedMimeTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/avif'];
          $finfo = finfo_open(FILEINFO_MIME_TYPE);
          $mimeType = finfo_file($finfo, $file['tmp_name']);
          finfo_close($finfo);

          if (!in_array($mimeType, $allowedMimeTypes)) {
            throw new Exception("Invalid file type. Only JPG, PNG, AVIF, GIF allowed.");
          }

          // Sanitize and create unique filename
          $originalName  = pathinfo($file['name'], PATHINFO_FILENAME);
          $extension     = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
          $sanitizedBase = preg_replace("/[^A-Za-z0-9_\-]/", '', $originalName);
          $sanitizedBase = substr($sanitizedBase, 0, 50);
          $newFileName   = uniqid('user_', true) . '_' . $sanitizedBase . '.' . $extension;

          $targetPath = $uploadDir . $newFileName;

          // Move uploaded file
          if (!move_uploaded_file($file['tmp_name'], $targetPath)) {
            throw new Exception("Failed to move uploaded file.");
          }

          // Delete old image if exists
          if (!empty($agent['image']) && file_exists($_SERVER['DOCUMENT_ROOT'] . '/' . $agent['image'])) {
            unlink($_SERVER['DOCUMENT_ROOT'] . '/' . $agent['image']);
          }

          // Save new image path relative to project
          $imageUrl = 'public/uploads/' . $newFileName;
        }

        // --- Update agent info in DB ---
        $this->db->update('users', $agent['id'], [
          'name'    => $name,
          'address' => $address,
          'profile_image'   => $imageUrl
        ],);

        setMessage('profile_message', 'Profile updated successfully.');
        redirect('agent/profile');
      } catch (Exception $e) {
        die("Error: " . $e->getMessage());
      }
    }
  }

  public function getTownshipShortCode($township)
  {
    $codes = [
      'Insein Township'         => 'INS',
      'Lanmadaw Township'       => 'LMD',
      'Chanayethazan Township'  => 'CYZ',
      'South Okkalapa Township' => 'SOK',
      'North Okkalapa Township' => 'NOK',
      'Kyauktan Township'       => 'KYT',
      'Thanlyin Township'       => 'TNL',
      'Thaketa Township'        => 'TKT',
      'Pyin Oo Lwin Township'   => 'POL',
      'Myingyan Township'       => 'MYG',
      'Amarapura Township'      => 'AMP',
      'Meiktila Township'       => 'MKL',
      'Hmawbi Township'         => 'HMB',
      'Hlaing Township'         => 'HLG',
      'Halo Township'           => 'HAL',
      'hi Township'             => 'HI',
      'dfds Township'           => 'DFD',
      'kk Township'             => 'KK',
      'mdm Township'            => 'MDM',
      'pyawbwe Township'        => 'PYW',
      'aass Township'           => 'AAS',
      '5555 Township'           => 'T555',
      '2 Township'              => 'T2'
    ];

    return $codes[$township] ?? strtoupper(substr($township, 0, 3));
  }
  public function pickupagentadd()
  {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') return;

    session_start();
    $userinfo = $_SESSION['user'] ?? [];

    // Collect and sanitize input
    $data = array_map('trim', [
      'name'           => $_POST['fullName'] ?? '',
      'phone'          => $_POST['phoneNumber'] ?? '',
      'email'          => $_POST['email'] ?? '',
      'password'       => $_POST['password'] ?? '',
      'vehicle_id'     => $_POST['assignedVehicle'] ?? null,
      'vehicle_number' => $_POST['vehicleNumber'] ?? null,
      'vehicleMake'   => $_POST['vehicleMake'] ?? '',
      'vehicleColor'   => $_POST['vehicleColor'] ?? ''
    ]);

    // Basic validation
    if (!$data['name'] || !$data['phone'] || !$data['password']) {
      setMessage('error', 'Fields are required.');
      redirect('agent/addpickupagent');
    }

    if ($data['email'] && !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
      setMessage('error', 'Invalid email format.');
      redirect('agent/addpickupagent');
    }

    // Check unique constraints
    if ($this->db->columnFilter('users', 'email', $data['email'])) {
      setMessage('error', 'Email is already registered.');
      redirect('agent/addpickupagent');
    }
    if ($this->db->columnFilter('users', 'phone', $data['phone'])) {
      setMessage('error', 'Phone is already registered.');
      redirect('agent/addpickupagent');
    }

    // Encode password and generate security code
    $data['password'] = base64_encode($data['password']);
    $data['security_code'] = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);

    $user = $this->db->getById('user_full_info', $userinfo['id']);
    $data['accesscode'] = $this->getTownshipShortCode($user['township_name']) . '-PGA-' . str_pad(rand(0, 999999), 4, '0', STR_PAD_LEFT);


    // Step 1: Insert vehicle
    $vehicle = new VehicleModel();
    $vehicle->vehicle_type_id = $data['vehicle_id'];
    $vehicle->plate_number    = $data['vehicle_number'];
    $vehicle->make            = $data['vehicleMake'];
    $vehicle->color           = $data['vehicleColor'];

    $vehicle_id = $this->db->create('vehicles', $vehicle->toArray());

    // Step 2: Insert user and link with vehicle
    if ($vehicle_id) {
      $user = new UserModel();
      $user->name             = $data['name'];
      $user->access_code      = $data['accesscode'];
      $user->phone            = $data['phone'];
      $user->email            = $data['email'] ?: null;
      $user->address          = $userinfo['address'] ?? null;
      $user->city_id          = $userinfo['city_id'] ?? null;
      $user->region_id        = $userinfo['region_id'] ?? null;
      $user->township_id      = $userinfo['township_id'] ?? null;
      $user->ward_id          = null;
      $user->password         = $data['password'];
      $user->otp_code         = null;
      $user->otp_expiry       = null;
      $user->security_code    = $data['security_code'];
      $user->status_id        = 3; // Active
      $user->role_id          = 4; // Pickup Agent
      $user->is_login         = 0;
      $user->created_at       = date('Y-m-d H:i:s');
      $user->user_type_id     = null;
      $user->vehicle_id       = $vehicle_id; // ✅ link vehicle here
      $user->created_by_agent = $userinfo['id'] ?? null;

      $this->db->create('users', $user->toArray());
    }


    redirect('agent/pickupagentlist');
  }

  public function updatestatuspickupagent()
  {
    $access_code = $_GET['access_code'] ?? null;
    $status = $_GET['status'] ?? null;

    if (!$access_code || !$status) {
      die("Invalid request");
    }

    $status_info = $this->db->columnFilter('statuses', 'name', $status);
    $user = $this->db->columnFilter('users', 'access_code', $access_code);

    if (!$user || !$status_info) {
      die("Invalid data");
    }

    $this->db->update('users', $user['id'], ['status_id' => $status_info['id']]);

    // Set flash message
    session_start();
    $_SESSION['flash_message'] = [
      'type' => $status === 'Active' ? 'success' : 'error',
      'message' => $status === 'Active' ? 'Pickup Agent Activated Successfully!' : 'Pickup Agent Deactivated Successfully!'
    ];

    redirect('agent/pickupagentdetail?access_code=' . $access_code);
  }

  public function pickupupdate()
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $status       = $_POST['status'] ?? null;
      $pickup_agent = $_POST['pickup_agent'] ?? null;
      $pickup_id    = $_POST['id'] ?? null;
      $pickup_code  = $_POST['pickup_code'] ?? null;

      // Validation: Ensure required fields are present
      if (empty($status)) {
        setMessage('error', 'Please select a status.');
        redirect('agent/edit_pickup?request_code=' . urlencode($pickup_code));
        return;
      }

      if (empty($pickup_agent)) {
        setMessage('error', 'Please select a pickup agent.');
        redirect('agent/edit_pickup?request_code=' . urlencode($pickup_code));
        return;
      }

      // Validation: Ensure pickup request exists
      $fullinfo = $this->db->getById('pickup_requests', $pickup_id);
      if (!$fullinfo) {
        setMessage('error', 'Pickup request not found.');
        redirect('agent/action');
        return;
      }

      // Send notifications based on status
      if ($status == 2) { // ✅ Accepted
        $title   = "Pickup Request Confirmed";
        $message = "Your pickup request #" . $fullinfo['request_code'] .
          " has been confirmed. An agent will arrive soon at " . $fullinfo['sender_address'] . ".";

        $noti = new Notification();
        $noti->setFromagentid($fullinfo['agent_id']);
        $noti->setToagentid($fullinfo['sender_id']);
        $noti->setTypeid(8);
        $noti->setTitle($title);
        $noti->setMessage($message);
        $this->db->create('agent_notifications', $noti->toArray());
      } elseif ($status == 5) { // ❌ Rejected
        $title   = "Pickup Request Rejected";
        $message = "Sorry, your pickup request #" . $fullinfo['request_code'] .
          " has been rejected. Please contact support or submit a new request.";

        $noti = new Notification();
        $noti->setFromagentid($fullinfo['agent_id']);
        $noti->setToagentid($fullinfo['sender_id']);
        $noti->setTypeid(8);
        $noti->setTitle($title);
        $noti->setMessage($message);
        $this->db->create('agent_notifications', $noti->toArray());
      }

      // Notify assigned pickup agent
      $title1 = "New Pickup Assignment Confirmed";
      $message1 = "You have been assigned to pickup request #" . $fullinfo['request_code'] .
        ". Please collect the parcel from " . $fullinfo['sender_address'] . ".";

      $noti1 = new Notification();
      $noti1->setFromagentid($fullinfo['agent_id']);
      $noti1->setToagentid($pickup_agent);
      $noti1->setTypeid(8);
      $noti1->setTitle($title1);
      $noti1->setMessage($message1);
      $this->db->create('agent_notifications', $noti1->toArray());

      // Update pickup request
      $result = $this->db->update('pickup_requests', $pickup_id, [
        'pickup_agent_id' => $pickup_agent,
        'status_id'       => $status
      ]);

      if ($result) {
        setMessage('success', 'Pickup request updated successfully.');
      } else {
        setMessage('error', 'Failed to update pickup request.');
      }

      redirect('agent/action?request_code=' . urlencode($pickup_code));
      return;
    }
  }


  public function pickupverify()
  {
    $pickup_id = $_GET['id'];
    $pickup_code = $_GET['request_code'];
    $payment_status = $_GET['payment_status'];

    $fullinfo = $this->db->columnFilter('pickup_requests', 'request_code', $pickup_code);

    if ($payment_status == 'Sender Pay') {
      $status_id = 10;
    } else {
      $status_id = 8;
    }
    $result = $this->db->update('pickup_requests', $pickup_id, ['status_id' => $status_id]);
    redirect('agent/action?request_code=' . $pickup_code);
    return;
  }

  public function addpayment()
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      session_start();

      try {
        // --- Get inputs ---
        $agent_id       = $_POST['agent_id'] ?? '';
        $payment_type   = trim($_POST['payment_type'] ?? '');
        $payment_name   = trim($_POST['payment_name'] ?? '');
        $payment_holder = trim($_POST['payment_holder'] ?? '');
        $payment_number = trim($_POST['payment_number'] ?? '');

        // --- Validation ---
        if (empty($payment_type)) {
          throw new Exception("Payment type is required.");
        }
        if (empty($payment_name)) {
          throw new Exception("Payment method name is required.");
        }
        if (empty($payment_holder)) {
          throw new Exception("Account holder name is required.");
        }
        if (empty($payment_number)) {
          throw new Exception("Payment number is required.");
        }
        // Optional: only digits, 8-20 characters
        if (!preg_match('/^\d{8,20}$/', $payment_number)) {
          throw new Exception("Payment number must be 8-20 digits.");
        }

        // --- Default image path ---
        $payment_image = null;

        // --- Handle file upload ---
        if (isset($_FILES['payment_image']) && $_FILES['payment_image']['error'] !== UPLOAD_ERR_NO_FILE) {
          $file = $_FILES['payment_image'];

          // Upload directory
          $uploadDir = $_SERVER['DOCUMENT_ROOT'] . "/Delivery/public/uploads/";

          if (!is_dir($uploadDir) && !mkdir($uploadDir, 0755, true)) {
            throw new Exception("Failed to create upload folder.");
          }

          if (!is_writable($uploadDir)) {
            throw new Exception("Upload folder is not writable.");
          }

          // File size max 5MB
          if ($file['size'] > 5 * 1024 * 1024) {
            throw new Exception("File is too large. Max 5MB.");
          }

          // Allowed MIME types
          $allowedMimeTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/avif'];
          $finfo = finfo_open(FILEINFO_MIME_TYPE);
          $mimeType = finfo_file($finfo, $file['tmp_name']);
          finfo_close($finfo);

          if (!in_array($mimeType, $allowedMimeTypes)) {
            throw new Exception("Invalid file type. Only JPG, PNG, AVIF, GIF allowed.");
          }

          // Sanitize filename
          $originalName  = pathinfo($file['name'], PATHINFO_FILENAME);
          $extension     = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
          $sanitizedBase = preg_replace("/[^A-Za-z0-9_\-]/", '', $originalName);
          $sanitizedBase = substr($sanitizedBase, 0, 50);
          $newFileName   = uniqid('payment_', true) . '_' . $sanitizedBase . '.' . $extension;

          $targetPath = $uploadDir . $newFileName;

          if (!move_uploaded_file($file['tmp_name'], $targetPath)) {
            throw new Exception("Failed to move uploaded file.");
          }

          $payment_image = 'public/uploads/' . $newFileName;
        }

        // --- Insert payment record into DB ---
        $payment = new paymentModel();
        $payment->create_by_agent_id = $agent_id;
        $payment->payment_type_id   = $payment_type;
        $payment->method_name       = $payment_name;
        $payment->method_image      = $payment_image;
        $payment->method_number     = $payment_number;
        $payment->account_holder    = $payment_holder;

        $this->db->create('payment_methods', $payment->toArray());

        $_SESSION['flash_message'] = [
          'type'    => 'success',
          'message' => 'Payment added successfully!'
        ];

        redirect('agent/paymenttype');
      } catch (Exception $e) {
        $_SESSION['flash_message'] = [
          'type' => 'error',
          'message' => $e->getMessage()
        ];
        redirect('agent/paymenttype'); // redirect back to the form
      }
    }
  }


  public function confirmpayment()
  {
    $code = $_GET['request_code'];
    $id = $_GET['id'];
    $status = $_GET['status'];

    if ($status == 'accepted') {
      $status_id = 7;
      $message = "Payment with Request Code $code has been accepted successfully.";
      $type = "success";
    } else {
      $status_id = 14;
      $message = "Payment with Request Code $code has been rejected.";
      $type = "error";
    }

    // Update database
    $this->db->update('pickup_requests', $id, ['status_id' => $status_id]);

    // Set flash message in session
    session_start();
    $_SESSION['flash_message'] = [
      'message' => $message,
      'type' => $type
    ];

    // Redirect back to payment list
    redirect('agent/paymentlist');
  }


  public function confirmDeliveryPayment()
  {
    $code = $_GET['tracking_code'];
    $id = $_GET['id'];
    $status = $_GET['status'];
    if ($status == 'accepted') {
      $status_id = 12;
      $message = "Payment with Request Code $code has been accepted successfully.";
      $type = "success";
    } else {
      $status_id = 16;
      $message = "Payment with Request Code $code has been rejected.";
      $type = "error";
    }

    $code_id = $this->db->columnFilter('deliveries', 'tracking_code', $code);

    // Update database
    $result = $this->db->update('deliveries', $code_id['id'], ['delivery_status_id' => $status_id]);

    // Set flash message in session
    session_start();
    $_SESSION['flash_message'] = [
      'message' => $message,
      'type' => $type
    ];

    // Redirect back to payment list
    redirect('agent/paymentlist');
  }

  public function create_voucher_pickup()
  {
    require_once APPROOT . '/helpers/Voucher_helper.php';

    $request_code = $_GET['request_code'];
    $fullinfo = $this->db->columnFilter('pickup_requests', 'request_code', $request_code);

    $sender_full_info = $this->db->getById('users', $fullinfo['sender_id']);


    $helper = new Voucher_helper();
    $tracking_code = $helper->generateTrackingNumber($fullinfo['sender_city_id'], $fullinfo['receiver_city_id']);

    $route = $this->db->checkroute('route', $fullinfo['sender_township_id'], $fullinfo['receiver_township_id']);

    $arrivalTime = $helper->calculateArrivalTime($route['time']);

    $user = new UserModel();
    $user->name = $fullinfo['receiver_name'];
    $user->phone = $fullinfo['receiver_phone'];
    $user->email = $fullinfo['receiver_email'];
    $user->region_id = $fullinfo['receiver_region_id'];
    $user->township_id = $fullinfo['receiver_township_id'];
    $user->city_id = $fullinfo['receiver_city_id'];
    $user->role_id = 3;
    $user->address = $fullinfo['receiver_address'];
    $result = $this->db->create('users', $user->toArray());

    $user1 = new UserModel();
    $user1->name = $sender_full_info['name'];
    $user1->phone = $sender_full_info['phone'];
    $user1->email = $sender_full_info['email'];
    $user1->region_id = $fullinfo['sender_region_id'];
    $user1->township_id = $fullinfo['sender_township_id'];
    $user1->city_id = $fullinfo['sender_city_id'];
    $user1->role_id = 3;
    $user1->address = $fullinfo['sender_address'];
    $result1 = $this->db->create('users', $user1->toArray());


    $checkadmin = $this->db->checkadmin('users', 'township_id', $fullinfo['receiver_township_id']);

    $deli = new Delivery();
    $deli->setSenderagentid($fullinfo['agent_id']);
    $deli->setReceiveragentid($checkadmin['id']);
    $deli->setSendCustomerid($result1);
    $deli->setReceiveCustomerid($result);
    $deli->setWeight($fullinfo['weight']);
    $deli->setAmount($fullinfo['amount']);
    $deli->setDeliverystatusid(1);
    $deli->setPaymentstatusid($fullinfo['payment_status_id']);
    date_default_timezone_set('Asia/Yangon');
    $deli->setcreatedat(date('Y-m-d H:i:s'));
    $deli->setUpdated_at(null);
    $deli->setProducttype($fullinfo['parcel_type_id']);
    $deli->setTrackingnumber($tracking_code);
    $deli->setDurationtime($arrivalTime);
    $deli->setFromtownshipid($fullinfo['sender_township_id']);
    $deli->setTotownshipid($fullinfo['receiver_township_id']);
    $deli->setFromregionid($fullinfo['sender_region_id']);
    $deli->setToregionid($fullinfo['receiver_region_id']);
    $deli->setFromcityid($fullinfo['sender_city_id']);
    $deli->setTocityid($fullinfo['receiver_city_id']);
    $deli->setDeliveryTypeId($fullinfo['delivery_type_id']);
    $deli->setPiececount($fullinfo['quantity']);
    $deliresult = $this->db->create('deliveries', $deli->toArray());


    $this->db->update('pickup_requests', $fullinfo['id'], ['status_id' => 15]);
    redirect('agent/action?request_code=' . $fullinfo['request_code']);
    return;
  }

  public function outofdelivery()
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $agent = $_POST['delivery_agent'] ?? null;
      $code  = $_POST['tracking_code'] ?? null;
      $id = $_POST['id'];

      // Validation: ensure an agent is selected
      if (empty($agent)) {
        setMessage('error', 'Please select a delivery agent.');
        redirect('agent/outfordeliveryaction?delivery_code=' . urlencode($code));
        return;
      }

      // Validation: ensure delivery code exists
      $delivery = $this->db->columnFilter('deliveries', 'tracking_code', $code);
      if (!$delivery) {
        setMessage('error', 'Invalid delivery code.');
        redirect('agent/outfordelivery');
        return;
      }

      // Update delivery record
      $result = $this->db->update('deliveries', $id, [
        'pickupagent_id'     => $agent,
        'delivery_status_id' => 8
      ]);

      if ($result) {
        setMessage('success', 'Delivery assigned successfully.');
      } else {
        setMessage('error', 'Failed to assign delivery. Please try again.');
      }

      redirect('agent/outfordelivery');
      return;
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

  public function deletepayment()
  {
    $id = $_GET['id'];
    $this->db->delete('payment_methods', $id);
    redirect('agent/paymenttype');
    return;
  }

  public function editpayment()
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $id = intval($_GET['id'] ?? 0);
      if ($id <= 0) throw new Exception("Invalid Payment ID.");

      $payment_name   = trim($_POST['payment_name']);
      $payment_number = trim($_POST['payment_number']);
      $payment_holder = trim($_POST['payment_holder']);
      $payment_image  = null;

      $errors = [];

      if (empty($payment_name)) $errors[] = "Payment Name is required.";
      if (empty($payment_number) || !preg_match('/^[0-9]+$/', $payment_number)) $errors[] = "Payment Number must be numeric.";
      if (empty($payment_holder)) $errors[] = "Payment Holder is required.";

      if (!empty($errors)) {
        if (session_status() == PHP_SESSION_NONE) session_start();
        $_SESSION['flash_message'] = ['type' => 'error', 'message' => implode(" ", $errors)];
        redirect('agent/paymenttype');
        exit;
      }

      // --- Handle file upload ---
      if (isset($_FILES['payment_image']) && $_FILES['payment_image']['error'] !== UPLOAD_ERR_NO_FILE) {
        $file = $_FILES['payment_image'];
        $uploadDir = $_SERVER['DOCUMENT_ROOT'] . "/Delivery/public/uploads/";
        if (!is_dir($uploadDir) && !mkdir($uploadDir, 0755, true)) {
          throw new Exception("Failed to create upload folder.");
        }
        if (!is_writable($uploadDir)) throw new Exception("Upload folder is not writable.");
        if ($file['size'] > 5 * 1024 * 1024) throw new Exception("File is too large. Max 5MB.");

        $allowedMimeTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/avif'];
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mimeType = finfo_file($finfo, $file['tmp_name']);
        finfo_close($finfo);

        $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'avif'];
        if (!in_array($mimeType, $allowedMimeTypes) || !in_array($extension, $allowedExtensions)) {
          throw new Exception("Invalid file type. Only JPG, PNG, GIF, AVIF allowed.");
        }

        $sanitizedBase = preg_replace("/[^A-Za-z0-9_\-]/", '', pathinfo($file['name'], PATHINFO_FILENAME));
        $sanitizedBase = substr($sanitizedBase, 0, 50);
        $newFileName = uniqid('payment_', true) . '_' . $sanitizedBase . '.' . $extension;
        $targetPath = $uploadDir . $newFileName;

        if (!move_uploaded_file($file['tmp_name'], $targetPath)) throw new Exception("Failed to move uploaded file.");
        $payment_image = 'public/uploads/' . $newFileName;
      }

      // --- Update DB ---
      $dataToUpdate = [
        'method_name' => $payment_name,
        'method_number' => $payment_number,
        'account_holder' => $payment_holder
      ];
      if ($payment_image) $dataToUpdate['method_image'] = $payment_image;

      $this->db->update('payment_methods', $id, $dataToUpdate);

      if (session_status() == PHP_SESSION_NONE) session_start();
      $_SESSION['flash_message'] = ['type' => 'success', 'message' => 'Payment edited successfully!'];

      redirect('agent/paymenttype');
    }
  }

  public function return_page()
  {
    $id = $_GET['id'];
    $fullinfo = $this->db->getById('deliveries', $id);
    $code = $fullinfo['tracking_code'];
    date_default_timezone_set('Asia/Yangon');
    if ($this->db->update('deliveries', $id, ['delivery_status_id' => 17, 'sender_agent_id' => $fullinfo['receiver_agent_id'], 'receiver_agent_id' => $fullinfo['sender_agent_id']])) {
      $this->db->create('agent_notifications', [
        'from_agent_id' => $fullinfo['receiver_agent_id'],
        'to_agent_id'   => $fullinfo['sender_agent_id'],
        'type_id'       => 3,
        'title'   => 'Delivery Returned!',
        'message' => "Your delivery with tracking code $code has been returned. Please proceed to pick it up.",

        'created_at'    => date('Y-m-d H:i:s', time())
      ]);

      header("Location: " . URLROOT . "/agentcontroller/edit_incomedelivery/" . urlencode($fullinfo['tracking_code']));
      exit();
    }
  }
}
