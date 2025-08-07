<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GoDelivery</title>
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/deliverycss/main.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/deliverycss/calculator.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/deliverycss/ournetwork.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <header class="new-main-header">
        <a href="home.html" class="logo-link">
            <div class="logo">GoDelivery</div>
        </a>
        <nav class="main-nav">
            <a href="<?php echo URLROOT; ?>/pages/calculator" class="nav-item active">Price Calculator</a>
            <a href="<?php echo URLROOT; ?>/pages/ournetwork" class="nav-item">Our Network</a>
            <a href="#" class="nav-item tracking">
                <i class="fas fa-search"></i> Tracking
            </a>
            <a href="<?PHP echo URLROOT; ?>/pages/login">
                <button class="login-button">Login</button>
            </a>
        </nav>
    </header>