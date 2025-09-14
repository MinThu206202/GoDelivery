<?php

require_once __DIR__ . '/BaseModel.php';

class paymenthistoryModel extends BaseModel
{
    protected  $deliveries_id;
    protected $payment_method_id;
    protected $receipt_image;
    protected $agent_id;
    protected $created_at;
}