<?php 

class CityModel {
    private $region_id;
    private $name;


    public function setRegionId($region_id)
    {
        $this->region_id = $region_id;
    }

    public function getRegionId()
    {
        return $this->region_id;
    }


    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function toArray(){
       return [
        "region_id" => $this->getRegionId(),
        "name" => $this->getName()
        ];
    }

}



?>