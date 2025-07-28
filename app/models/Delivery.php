<?php 

class Delivery{
    private $sender_agent_id;
    private $receiver_agent_id;
    private $sender_customer_id;
    private $receicer_cusomer_id;
    private $form_city_id;
    private $to_city_id;
    private $weight;
    private $amount;
    private $delivery_status_id;
    private $payment_status_id;
    private $created_at;
    private $updated_at;
    private $product_type;
    private $tracking_number;
    private $duration;


    public function setSenderagentid($sender_agent_id)
    {
        $this->sender_agent_id = $sender_agent_id;
    }

    public function getSenderagentid()
    {
        return $this->sender_agent_id;
    }

    public function setReceiveragentid($receiver_agent_id)
    {
        $this->receiver_agent_id = $receiver_agent_id;
    }

    public function getReceiveragentid()
    {
        return $this->receiver_agent_id;
    }
    public function setSendCustomerid($sender_customer_id)
    {
        $this->sender_customer_id = $sender_customer_id;
    }

    public function getSendCustomerid()
    {
        return $this->sender_customer_id;
    }
    public function setReceiveCustomerid($receicer_cusomer_id)
    {
        $this->receicer_cusomer_id = $receicer_cusomer_id;
    }

    public function getReceiverCutomerid()
    {
        return $this->receicer_cusomer_id;
    }

    public function setFromcityid($form_city_id)
    {
        $this->form_city_id = $form_city_id;
    }

    public function getFromcityid()
    {
        return $this->form_city_id;
    }
    public function setTocityid($to_city_id)
    {
        $this->to_city_id = $to_city_id;
    }

    public function getTocityid()
    {
        return $this->to_city_id;
    }


    public function setWeight($weight)
    {
        $this->weight = $weight;
    }

    public function getWeight()
    {
        return $this->weight;
    }
    public function setAmount($amount)
    {
        $this->amount = $amount;
    }

    public function getAmount()
    {
        return $this->amount;
    }

    public function setDeliverystatusid($delivery_status_id)
    {
        $this->delivery_status_id = $delivery_status_id;
    }

    public function getDeliverystatusid()
    {
        return $this->delivery_status_id;
    }

    public function setPaymentstatusid($payment_status_id)
    {
        $this->payment_status_id = $payment_status_id;
    }

    public function getPaymentstatusid()
    {
        return $this->payment_status_id;
    }

    public function setcreatedat($created_at)
    {
        $this->created_at = $created_at;
    }

    public function getcreatedat()
    {
        return $this->created_at;
    }

    public function setUpdated_at($updated_at)
    {
        $this->updated_at = $updated_at;
    }

    public function getUpdated_at()
    {
        return $this->updated_at;
    }

    public function setProducttype($product_type)
    {
        $this->product_type = $product_type;
    }

    public function getProducttype()
    {
        return $this->product_type;
    }

    public function setTrackingnumber($tracking_number){
        $this->tracking_number = $tracking_number;
    }

    public function getTrackingnumber(){
        return $this->tracking_number;
    }
    public function setDurationtime($duration)
    {
        $this->duration = $duration;
    }

    public function getDurationtime()
    {
        return $this->duration;
    }
    public function toArray()
    {
        return [
            "sender_agent_id" => $this->getSenderagentid(),
            "receiver_agent_id" => $this->getReceiveragentid(),
            "sender_customer_id" => $this->getSendCustomerid(),
            "receiver_customer_id" => $this->getReceiveragentid(),
            "from_city_id" => $this->getFromcityid(),
            "to_city_id" => $this->getTocityid(),
            "weight" => $this->getWeight(),
            "amount" => $this->getAmount(),
            "delivery_status_id" => $this->getDeliverystatusid(),
            "payment_status_id" => $this->getPaymentstatusid(),
            "created_at" => $this->getcreatedat(),
            "updated_at" => $this->getUpdated_at(),
            "product_type" => $this->getProducttype(),
            "tracking_code" => $this->getTrackingnumber(),
            "duration" => $this->getDurationtime()
        ];
    }

}


?>