<?php 

require_once __DIR__ . '/UserModel.php';

class   NormalUser extends UserModel
{
    private float $bonus = 0.03;

    public function getbonus()
    {
        return $this->bonus;
    }
}


?>