<?php

require_once __DIR__ . '/UserModel.php';

class   PremiumUser extends UserModel
{
    private float $bonus = 0.15;

    public function getbonus()
    {
        return $this->bonus;
    }
}
