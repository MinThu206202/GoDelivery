<?php

require_once __DIR__ . '/BaseModel.php';

class Delivery_status_Model extends BaseModel
{
    protected  $id;
    protected $delivery_id;
    protected $status_id;
    protected $changed_by;
    protected $note;
    protected $changed_at;
    
}
