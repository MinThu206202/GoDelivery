<?php
$currentRoute = $_SERVER['REQUEST_URI'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GoDelivery - Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <div class="dashboard-container">


        <aside class="sidebar">
            <div class="sidebar-header">
                GO<span>|</span>DELIVERY
            </div>
            <nav class="sidebar-nav">
                <a href="<?= URLROOT ?>/admin/home"
                    class="nav-item <?= strpos($currentRoute, '/admin/home') !== false ? 'active' : '' ?>">
                    <i class="fas fa-home"></i> Dashboard
                </a>

                <a href="<?= URLROOT ?>/admin/deliveryhistory"
                    class="nav-item <?= strpos($currentRoute, '/admin/deliveryhistory') !== false ? 'active' : '' ?>">
                    <i class="fas fa-history"></i> Delivery History
                </a>


                <a href="<?= URLROOT ?>/admin/agent"
                    class="nav-item <?= strpos($currentRoute, '/admin/agent') !== false ? 'active' : '' ?>">
                    <i class="fas fa-user-tie"></i> Agent
                </a>

                <a href="<?= URLROOT ?>/admin/access_code"
                    class="nav-item <?= strpos($currentRoute, '/admin/access_code') !== false ? 'active' : '' ?>">
                    <i class="fas fa-key"></i> Access Code
                </a>

                <a href="<?= URLROOT ?>/admin/route"
                    class="nav-item <?= strpos($currentRoute, '/admin/route') !== false ? 'active' : '' ?>">
                    <i class="fas fa-route"></i> Route
                </a>

                <a href="<?= URLROOT ?>/available_place/available"
                    class="nav-item <?= strpos($currentRoute, '/available_place/available') !== false ? 'active' : '' ?>">
                    <i class="fas fa-map-marker-alt"></i> Available Place
                </a>

                <a href="<?= URLROOT ?>/admin/profile"
                    class="nav-item <?= strpos($currentRoute, '/admin/profile') !== false ? 'active' : '' ?>">
                    <i class="fas fa-user"></i> Profile
                </a>

                <a href="<?= URLROOT ?>/admincontroller/logout" class="nav-item logout">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
            </nav>
        </aside>