<?php

class AuthMiddleware
{
    public static function adminOnly()
    {
        session_start();


        if (!defined('admin')) define('admin', 1);
        if (!isset($_SESSION['user']) || $_SESSION['user']['role_id'] != admin) {
            header("Location: " . URLROOT . "/pages/login");
            exit();
        }
    }

    public static function agentOnly()
    {
        session_start();

        if (!defined('agent')) define('agent', 2);
        if (!isset($_SESSION['user']) || $_SESSION['user']['role_id'] != agent) {
            header("Location: " . URLROOT . "/pages/login");
            exit();
        }
    }
}