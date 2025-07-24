<?php 

class RouteModel{

    private $fromcity;
    private $tocity;
    private $distnce;
    private $price;
    private $status;
    private $created_at;
    private $updated_at;

public function setFromcity($fromcity){
    $this->fromcity = $fromcity;
}

public function getFromcity(){
    return $this->fromcity;
}

    public function setTocity($tocity)
    {
        $this->tocity = $tocity;
    }

    public function getTocity()
    {
        return $this->tocity;
    }
    public function setDistance($distance)
    {
        $this->distnce = $distance;
    }

    public function getDistance()
    {
        return $this->distnce;
    }
    public function setPrice($price)
    {
        $this->price = $price;
    }

    public function getPrice()
    {
        return $this->price;
    }
    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function getStatus()
    {
        return $this->status;
    }
    public function setCreatedat($created_at)
    {
        $this->created_at = $created_at;
    }

    public function getCreatedat()
    {
        return $this->created_at;
    }

    public function setUpdatedat($updated_at)
    {
        $this->updated_at = $updated_at;
    }

    public function getUpdatedat()
    {
        return $this->updated_at;
    }

    public function toArray()
    {
        return [
            "from_city_id" => $this->getFromcity(),
            "to_city_id" => $this->getTocity(),
            "distance" => $this->getDistance(),
            "price" => $this->getPrice(),
            "status" => $this->getStatus(),
            "created_at" => $this->getCreatedat(),
            "updated_at" => $this->getUpdatedat()
        ];
    }

}


?>