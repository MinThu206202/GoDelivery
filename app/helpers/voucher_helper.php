<?php 

class Voucher_helper{

    private $db;
    public function __construct(){
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
        'region_id' => $agent['region_id']
    ];
}

public function createUser($data)
{
    $user = new UserModel();
    $user->setName($data['name']);
    $user->setEmail($data['email']);
    $user->setPhone($data['phone']);
    $user->setAddress($data['address']);
    $user->setCity($data['city_id']);
    $user->setRegion($data['region_id']);
    $user->setTownship(null);
    $user->setWard(null);
    $user->setPassword(null);
    $user->setOtp_code(null);
    $user->setOtp_expiry(null);
    $user->setSecurity_code(null);
    $user->setStatus_id(null);
    $user->setRole_id(3);
    $user->setisLogin(0);
    $user->setCreated_at(date('Y-m-d H:i:s'));

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

public function calculateArrivalTime($routeDuration)
{
    $duration = strtotime($routeDuration) - strtotime('TODAY');
    return date("Y-m-d H:i:s", time() + $duration);
}

public function buildDeliveryData($post, $agent, $receiverAgent, $senderId, $receiverId, $trackingNumber, $arrivalTime, $amount, $paymentStatusId)
{
    return [
        'sender_agent_id' => $agent['id'],
        'receiver_agent_id' => $receiverAgent['id'],
        'sender_customer_id' => $senderId,
        'receiver_customer_id' => $receiverId,
        'from_city_id' => $agent['city_id'],
        'to_city_id' => $post['senderAgentCity'],
        'weight' => $post['weight'],
        'amount' => $amount,
        'delivery_status_id' => 1,
        'payment_status_id' => $paymentStatusId,
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => null,
        'product_type' => $post['product_type'],
        'tracking_code' => $trackingNumber,
        'duration' => $arrivalTime
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


?>