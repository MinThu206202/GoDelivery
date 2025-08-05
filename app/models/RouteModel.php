<?php

require_once __DIR__ . '/BaseModel.php';

    // your code
 class RouteModel extends BaseModel{

    protected $from_city_id;
    protected $from_township_id;
    protected $to_city_id;
    protected $to_township_id;
    protected $distance;
    protected float $price;
    protected $status;
    protected $time;
    protected $created_at;
    protected $updated_at;

    public function setPrice(float $price): void
    {
        $this->price = $price;
    }

    // Getter method for price (optional)
    public function getPrice(): float
    {
        return $this->price;
    }

 }

 class ActiveRoute extends RouteModel{
    private $bonus=0.15;
    public function calculatebonus()
    {
        $bonus = $this->price * $this->bonus;
        return $this->price -= $bonus;
    }
 }

?>