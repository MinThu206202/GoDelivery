<?php

class Pickupcontroller extends Controller
{
    private $db;
    public function __construct()
    {
        $this->model('pickupModel');
        $this->model('notification');
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


    public function pickuprequest()
    {
        session_start();
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            return;
        }
        $sender = $_SESSION['customer'];

        // ✅ Define required fields
        $required = [
            'pickup_region',
            'pickup_city',
            'payment_type',
            'delivery_type',
            'pickup_township',
            'pickup_address',
            'preferred_date',
            'parcel_type',
            'weight',
            'quantity',
            'receiver_name',
            'receiver_phone',
            'receiver_email',
            'receiver_region',
            'receiver_city',
            'receiver_township',
            'receiver_address'
        ];

        // ✅ Check missing fields
        foreach ($required as $field) {
            if (empty($_POST[$field])) {
                setMessage('error', ucfirst(str_replace('_', ' ', $field)) . " is required");
                redirect('pages/pickup');
                return;
            }
        }

        $delivery_type  = $_POST['delivery_type'];
        $payment_type   = $_POST['payment_type'];
        $pickup_region   = (int) $_POST['pickup_region'];
        $pickup_city     = (int) $_POST['pickup_city'];
        $pickup_township = (int) $_POST['pickup_township'];
        $pickup_address  = trim($_POST['pickup_address']);
        $landmark        = $_POST['landmark'] ?? null;
        $preferred_date  = $_POST['preferred_date'];
        $parcel_type     = (int) $_POST['parcel_type'];
        $weight          = (float) $_POST['weight'];
        $quantity        = (int) $_POST['quantity'];

        $receiver_name    = trim($_POST['receiver_name']);
        $receiver_phone   = trim($_POST['receiver_phone']);
        $receiver_email   = filter_var($_POST['receiver_email'], FILTER_SANITIZE_EMAIL);
        $receiver_region  = (int) $_POST['receiver_region'];
        $receiver_city    = (int) $_POST['receiver_city'];
        $receiver_township = (int) $_POST['receiver_township'];
        $receiver_address = trim($_POST['receiver_address']);



        if (!filter_var($receiver_email, FILTER_VALIDATE_EMAIL)) {
            setMessage('error', "Invalid receiver email");
            redirect('pages/pickup');
            return;
        }


        if (!preg_match('/^[0-9]{6,15}$/', $receiver_phone)) {
            setMessage('error', "Invalid receiver phone number");
            redirect('pages/pickup');
            return;
        }

        if ($weight <= 0) {
            setMessage('error', "Weight must be greater than 0");
            redirect('pages/pickup');
            return;
        }

        if ($quantity < 1) {
            setMessage('error', "Quantity must be at least 1");
            redirect('pages/pickup');
            return;
        }

        if (!strtotime($preferred_date)) {
            setMessage('error', "Invalid preferred date");
            redirect('pages/pickup');
            return;
        }

        // ✅ Generate request code
        $townshipname = $this->db->getById('townships', $pickup_township);
        $otp = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);
        $requestCode = 'PR-' . $this->getTownshipShortCode($townshipname['name']) . '-' . rand(100000, 999999);

        // ✅ Find available agent
        $checkagent = $this->db->columnFilter('available_location', 'township_id', $pickup_township);


        if (!$checkagent || $checkagent['agent_id'] === null) {
            setMessage('error', "We cannot pickup your address");
            redirect('pages/pickup');
            return;
        }



        // ✅ Save to DB
        $pickup = new PickupModel();
        $pickup->setSenderId($sender['id']);
        $pickup->setSenderRegionId($pickup_region);
        $pickup->setSenderCityId($pickup_city);
        $pickup->setSenderTownshipId($pickup_township);
        $pickup->setSenderAddress($pickup_address);
        $pickup->setLandMark($landmark);
        $pickup->setPreferredDate($preferred_date);
        $pickup->setParcelTypeId($parcel_type);
        $pickup->setWeight($weight);
        $pickup->setDeliveryType($delivery_type);
        $pickup->setPaymentType($payment_type);
        $pickup->setQuantity($quantity);
        $pickup->setReceiverName($receiver_name);
        $pickup->setReceiverEmail($receiver_email);
        $pickup->setReceiverPhone($receiver_phone);
        $pickup->setReceiverRegionId($receiver_region);
        $pickup->setReceiverCityId($receiver_city);
        $pickup->setReceiverTownshipId($receiver_township);
        $pickup->setReceiverAddress($receiver_address);
        $pickup->setRequestCode($requestCode);
        $pickup->setAgentId($checkagent['agent_id']);
        $pickup->setPickupAgentId(null);
        $pickup->setCreatedAt(date('Y-m-d H:i:s'));
        $pickup->setUpdatedAt(null);
        $pickup->setStatus(1); // pending

        $notificationText = "📦 New Pickup Request #$requestCode from " . $sender['name'] . " at " . $pickup_address . ". Please proceed with collection.";

        $noti = new Notification();
        $noti->setFromagentid($sender['id']);
        $noti->setToagentid($checkagent['agent_id']);
        $noti->setTypeid(5);
        $noti->setTitle("New Pickup Request");
        $noti->setMessage($notificationText);
        $this->db->create('agent_notifications', $noti->toArray());

        $this->db->create('pickup_requests', $pickup->toArray());
        redirect('pages/index');
    }

    public function detail()
    {
        $request_code = $_GET['request_code'];
        $payment = $this->db->readAll('payment_methods_view');
        $code = $this->db->columnFilter('pickup_requests_view', 'request_code', $request_code);
        $pickup_agent = $this->db->columnFilter('user_full_info', 'id', $code['pickup_agent_id']);
        $data = [
            'pickup_agent' => $pickup_agent,
            'payment' => $payment,
            'code' => $code,
        ];
        $this->view('user/pickupdetail', $data);
    }

    public function updatepayment()
    {
        $id = $_GET['id'] ?? null;
        $payment = $_GET['payment_method'] ?? null;
        $request_code = $_GET['request_code'] ?? null;

        if ($id && $payment) {
            // Set status dynamically based on payment type
            $status_id = ($payment == 1) ? 11 : 6;

            // Update pickup request
            $this->db->update('pickup_requests', $id, [
                'payment_type_id' => $payment,
                'status_id' => $status_id
            ]);
        }
        redirect('pickupcontroller/detail?request_code=' . urlencode($request_code));
        return;
    }

    public function cancel()
    {
        $id = $_GET['id'];
        $request_code = $_GET['request_code'];
        $this->db->update('pickup_requests', $id, ['status_id' => 12]);
        redirect('pages/pickuphistory');
        return;
    }

    public function submitpayment()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') return;

        $id = $_POST['id'] ?? null;
        $payment_method_id = $_POST['payment_method_id'] ?? null;
        $payment_image = null;

        if (!$id || !$payment_method_id) {
            throw new Exception("Missing required fields.");
        }

        // --- Handle file upload if exists ---
        if (!empty($_FILES['payment_image']['name'])) {
            $file = $_FILES['payment_image'];
            $uploadDir = $_SERVER['DOCUMENT_ROOT'] . "/Delivery/public/uploads/";

            if (!is_dir($uploadDir)) mkdir($uploadDir, 0755, true);
            if (!is_writable($uploadDir)) throw new Exception("Upload folder not writable.");

            // Validate size (5MB max)
            if ($file['size'] > 5 * 1024 * 1024) throw new Exception("File too large. Max 5MB.");

            // Validate MIME type
            $allowed = ['image/jpeg', 'image/png', 'image/gif', 'image/avif'];
            $mime = mime_content_type($file['tmp_name']);
            if (!in_array($mime, $allowed)) throw new Exception("Invalid file type.");

            // Generate safe filename
            $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
            $base = preg_replace("/[^A-Za-z0-9_\-]/", '', pathinfo($file['name'], PATHINFO_FILENAME));
            $base = substr($base, 0, 50);
            $newName = uniqid('payment_', true) . '_' . $base . '.' . $ext;

            if (!move_uploaded_file($file['tmp_name'], $uploadDir . $newName)) {
                throw new Exception("Upload failed.");
            }

            $payment_image = "public/uploads/" . $newName;
        }

        // --- Update DB ---
        date_default_timezone_set('Asia/Yangon');

        $updateData = [
            'status_id' => 13,
            'updated_at' => date('Y-m-d H:i:s'), // current timestamp
            'payment_method_id' => $payment_method_id,
            'method_image' => $payment_image
        ];


        if ($this->db->update('pickup_requests', $id, $updateData)) {
            redirect('pages/pickuphistory');
        } else {
            throw new Exception("Failed to update payment info.");
        }
    }
}
