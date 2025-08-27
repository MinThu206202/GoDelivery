<?php

class Voucher_helper
{

    private $db;
    public function __construct()
    {
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
    public function getSenderData($post)
    {
        return [
            'name' => $post['sender_name'],
            'email' => $post['sender_email'],
            'phone' => $post['sender_phone'],
            'address' => $post['sender_address'],
            'township_id' => $post['senderAgentTownship'],
            'city_id' => $post['senderAgentCity'],
            'region_id' => $post['senderAgentRegion']
        ];
    }

    public function getReceiverData($post, $agent)
    {
        return [
            'name' => $post['receiver_name'],
            'email' => $post['receiver_email'],
            'phone' => $post['receiver_phone'],
            'address' => $post['receiver_address'],
            'city_id' => $agent['city_id'],
            'region_id' => $agent['region_id'],
            'township_id' => $agent['township_id']
        ];
    }

    public function createUser($data)
    {
        $chelckusertype = $this->db->columnFilter('users', 'email', $_POST['sender_email']);

        $user = new UserModel();
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->phone = $data['phone'];
        $user->address = $data['address'];
        $user->city_id = $data['city_id'];
        $user->region_id = $data['region_id'];
        $user->township_id = $data['township_id'];
        $user->ward_id = null;
        $user->password = null;
        $user->otp_code = null;
        $user->otp_expiry =  null;
        $user->security_code = null;
        $user->status_id = null;
        $user->role_id = 3;
        $user->is_login = 0;
        $user->created_at = date('Y-m-d H:i:s');
        $user->user_type_id = null;
        $user->access_code = null;

        $this->db->create('users', $user->toArray());
        return $this->db->columnFilter('users', 'email', $data['email'])['id'];
    }

    public function generateTrackingNumber($fromCityId, $toCityId)
    {
        $fromCity = $this->db->columnFilter('cities', 'id', $fromCityId);
        $toCity = $this->db->columnFilter('cities', 'id', $toCityId);

        $shortFrom = $this->getShortCode($fromCity['name']);
        $shortTo = $this->getShortCode($toCity['name']);
        $random = str_pad(rand(0, 999999), 6, "0", STR_PAD_LEFT);

        return $shortFrom . $random . $shortTo;
    }

    public function calculateArrivalTime($routeDurationInHours)
    {
        date_default_timezone_set('Asia/Yangon');
        $durationInSeconds = (float)$routeDurationInHours * 3600; // 1 hour = 3600 seconds
        return date("Y-m-d H:i:s", time() + $durationInSeconds);
    }

    public function buildDeliveryData($post, $agent, $receiverAgent, $senderId, $receiverId, $trackingNumber, $arrivalTime, $amount, $paymentStatusId)
    {
        return [
            'sender_agent_id' => $agent['id'],
            'receiver_agent_id' => $receiverAgent['id'],
            'sender_customer_id' => $senderId,
            'receiver_customer_id' => $receiverId,
            'from_township_id' => $agent['township_id'],
            'to_township_id' => $receiverAgent['township_id'],
            'from_city_id' => $agent['city_id'],
            'to_city_id' => $post['senderAgentCity'],
            'from_region_id' => $agent['region_id'],
            'to_region_id' => $post['senderAgentRegion'],
            'weight' => $post['weight'],
            'amount' => $amount,
            'delivery_status_id' => 1,
            'payment_status_id' => $paymentStatusId,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => null,
            'product_type' => $post['product_type'],
            'tracking_code' => $trackingNumber,
            'duration' => $arrivalTime,
            'delivery_type_id' => $post['delivery_type'],
            'piece_count' => $post['piece']
        ];
    }

    public function createNotification($fromAgentId, $toAgentId, $trackingNumber)
    {
        $notification = new Notification();
        $notification->setFromagentid($fromAgentId);
        $notification->setToagentid($toAgentId);
        $notification->setTypeid(1);
        $notification->setTitle("New Delivery Available!");
        $notification->setMessage("A new delivery request (Order ID: #$trackingNumber) is available for acceptance. Check 'Request Deliveries'.");
        $notification->setCreatedAt(date('Y-m-d H:i:s'));

        $this->db->create('agent_notifications', $notification->toArray());
    }
}
