<?php 

class Available_locationModel {
    private $region_id;
    private $city_id;
    private $township_id;
    private $agent_id;
    private $created_at;
    private $updated_at;
    private $status_location_id;


    public function setRegionId($region_id){
        $this->region_id = $region_id;
    }

    public function getRegionId()
    {
        return $this->region_id;
    }

    public function setCityId($city_id)
    {
        $this->city_id = $city_id;
    }

    public function getCityId()
    {
        return $this->city_id;
    }

    public function setTownshipId($township_id)
    {
        $this->township_id = $township_id;
    }

    public function getTownshipId()
    {
        return $this->township_id;
    }

    public function setAgentId($agent_id)
    {
        $this->agent_id = $agent_id;
    }

    public function getAgentId()
    {
        return $this->agent_id;
    }

    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;
    }

    public function getCreatedAt()
    {
        return $this->created_at;
    }

    public function setUpdatedAt($updated_at)
    {
        $this->updated_at = $updated_at;
    }

    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    public function setStatusLoacationId($status_location_id)
    {
        $this->status_location_id = $status_location_id;
    }

    public function getStatusLocationId()
    {
        return $this->status_location_id;
    }

    public function toArray(){
        return[
            "region_id" => $this->getRegionId(),
            "city_id" => $this->getCityId(),
            "township_id" => $this->getTownshipId(),
            "agent_id" => $this->getAgentId(),
            "created_at" => $this->getCreatedAt(),
            "updated_at" => $this->getUpdatedAt(),
            "status_location_id" => $this->getStatusLocationId()
        ];
    }

}



?>