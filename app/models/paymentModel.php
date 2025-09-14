<?php

require_once __DIR__ . '/BaseModel.php';

class paymentModel extends BaseModel
{
    protected  $payment_type_id;
    protected $method_name;
    protected $method_image;
    protected $method_number;
    protected $account_holder;
    protected $create_by_agent_id;
}
