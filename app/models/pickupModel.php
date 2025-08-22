<?php

class PickupModel
{
    // Sender Info
    private $sender_name;
    private $sender_email;
    private $sender_phone;
    private $sender_address;
    private $sender_region_id;
    private $sender_city_id;
    private $sender_township_id;

    // Receiver Info
    private $receiver_name;
    private $receiver_email;
    private $receiver_phone;
    private $receiver_address;
    private $receiver_region_id;
    private $receiver_city_id;
    private $receiver_township_id;

    // Parcel Details
    private $landmark;
    private $parcel_type_id;
    private $weight;
    private $quantity;
    private $preferred_date;

    // Agents & Status
    private $agent_id;
    private $pickup_agent_id;
    private $status;
    private $request_code;

    // Timestamps
    private $created_at;
    private $updated_at;

    // === Setters and Getters ===
    public function setSenderName($name)
    {
        $this->sender_name = $name;
    }
    public function getSenderName()
    {
        return $this->sender_name;
    }

    public function setSenderEmail($email)
    {
        $this->sender_email = $email;
    }
    public function getSenderEmail()
    {
        return $this->sender_email;
    }

    public function setSenderPhone($phone)
    {
        $this->sender_phone = $phone;
    }
    public function getSenderPhone()
    {
        return $this->sender_phone;
    }

    public function setSenderAddress($address)
    {
        $this->sender_address = $address;
    }
    public function getSenderAddress()
    {
        return $this->sender_address;
    }

    public function setSenderRegionId($id)
    {
        $this->sender_region_id = $id;
    }
    public function getSenderRegionId()
    {
        return $this->sender_region_id;
    }

    public function setSenderCityId($id)
    {
        $this->sender_city_id = $id;
    }
    public function getSenderCityId()
    {
        return $this->sender_city_id;
    }

    public function setLandmark($landmark)
    {
        $this->landmark = $landmark;
    }
    public function getLandmark()
    {
        return $this->landmark;
    }

    public function setSenderTownshipId($id)
    {
        $this->sender_township_id = $id;
    }
    public function getSenderTownshipId()
    {
        return $this->sender_township_id;
    }

    public function setReceiverName($name)
    {
        $this->receiver_name = $name;
    }
    public function getReceiverName()
    {
        return $this->receiver_name;
    }

    public function setReceiverEmail($email)
    {
        $this->receiver_email = $email;
    }
    public function getReceiverEmail()
    {
        return $this->receiver_email;
    }

    public function setReceiverPhone($phone)
    {
        $this->receiver_phone = $phone;
    }
    public function getReceiverPhone()
    {
        return $this->receiver_phone;
    }

    public function setReceiverAddress($address)
    {
        $this->receiver_address = $address;
    }
    public function getReceiverAddress()
    {
        return $this->receiver_address;
    }

    public function setReceiverRegionId($id)
    {
        $this->receiver_region_id = $id;
    }
    public function getReceiverRegionId()
    {
        return $this->receiver_region_id;
    }

    public function setReceiverCityId($id)
    {
        $this->receiver_city_id = $id;
    }
    public function getReceiverCityId()
    {
        return $this->receiver_city_id;
    }

    public function setReceiverTownshipId($id)
    {
        $this->receiver_township_id = $id;
    }
    public function getReceiverTownshipId()
    {
        return $this->receiver_township_id;
    }

    public function setParcelTypeId($id)
    {
        $this->parcel_type_id = $id;
    }
    public function getParcelTypeId()
    {
        return $this->parcel_type_id;
    }

    public function setWeight($weight)
    {
        $this->weight = $weight;
    }
    public function getWeight()
    {
        return $this->weight;
    }

    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }
    public function getQuantity()
    {
        return $this->quantity;
    }

    public function setPreferredDate($date)
    {
        $this->preferred_date = $date;
    }
    public function getPreferredDate()
    {
        return $this->preferred_date;
    }

    public function setAgentId($id)
    {
        $this->agent_id = $id;
    }
    public function getAgentId()
    {
        return $this->agent_id;
    }

    public function setPickupAgentId($id)
    {
        $this->pickup_agent_id = $id;
    }
    public function getPickupAgentId()
    {
        return $this->pickup_agent_id;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }
    public function getStatus()
    {
        return $this->status;
    }

    public function setRequestCode($code)
    {
        $this->request_code = $code;
    }
    public function getRequestCode()
    {
        return $this->request_code;
    }

    public function setCreatedAt($datetime)
    {
        $this->created_at = $datetime;
    }
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    public function setUpdatedAt($datetime)
    {
        $this->updated_at = $datetime;
    }
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    // === Convert to array for DB insertion ===
    public function toArray()
    {
        return [
            "sender_name" => $this->getSenderName(),
            "sender_email" => $this->getSenderEmail(),
            "sender_phone" => $this->getSenderPhone(),
            "sender_address" => $this->getSenderAddress(),
            "sender_region_id" => $this->getSenderRegionId(),
            "landmark" => $this->getLandmark(),
            "sender_city_id" => $this->getSenderCityId(),
            "sender_township_id" => $this->getSenderTownshipId(),
            "receiver_name" => $this->getReceiverName(),
            "receiver_email" => $this->getReceiverEmail(),
            "receiver_phone" => $this->getReceiverPhone(),
            "receiver_address" => $this->getReceiverAddress(),
            "receiver_region_id" => $this->getReceiverRegionId(),
            "receiver_city_id" => $this->getReceiverCityId(),
            "receiver_township_id" => $this->getReceiverTownshipId(),
            "parcel_type_id" => $this->getParcelTypeId(),
            "weight" => $this->getWeight(),
            "quantity" => $this->getQuantity(),
            "preferred_date" => $this->getPreferredDate(),
            "agent_id" => $this->getAgentId(),
            "pickup_agent_id" => $this->getPickupAgentId(),
            "status_id" => $this->getStatus(),
            "request_code" => $this->getRequestCode(),
            "created_at" => $this->getCreatedAt(),
            "updated_at" => $this->getUpdatedAt()
        ];
    }
}
