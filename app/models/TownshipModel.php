<?php

class TownshipModel
{
    private $city_id;
    private $name;


    public function setCityId($city_id)
    {
        $this->city_id = $city_id;
    }

    public function getCityId()
    {
        return $this->city_id;
    }


    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function toArray()
    {
        return [
            "city_id" => $this->getCityId(),
            "name" => $this->getName()
        ];
    }
}
