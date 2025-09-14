<?php
$currentRoute = $_SERVER['REQUEST_URI'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GoDelivery - Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
    body {
        font-family: 'Inter', sans-serif;
        background-color: #f1f5f9;
    }

    .sidebar a {
        position: relative;
        transition: all 0.3s ease;
    }

    .sidebar a.active-sidebar-link {
        background-color: #fff;
        color: #1F265B;
        font-weight: 600;
    }

    .sidebar a.active-sidebar-link::before,
    .sidebar a:not(.active-sidebar-link):hover::before {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        height: 100%;
        width: 8px;
        /* Increased from 4px to 8px */
        background-color: #FBBF24;
        /* Yellow bar */
        border-top-left-radius: 4px;
        border-bottom-left-radius: 4px;
    }


    .sidebar a:not(.active-sidebar-link):hover {
        background-color: #fef3c7;
        /* Light yellow hover */
        color: #1F265B;
    }

    .sidebar a:not(.active-sidebar-link):hover::before {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        height: 100%;
        width: 8px;
        /* Increased from 4px to 8px */
        background-color: #FBBF24;
        /* Yellow bar */
        border-top-left-radius: 4px;
        border-bottom-left-radius: 4px;
    }
    </style>
</head>

<body class="flex flex-col md:flex-row min-h-screen">

    <!-- Sidebar -->
    <aside
        class="sidebar bg-[#1F265B] text-white w-full md:w-64 p-6 flex flex-col items-center md:items-start space-y-8 md:space-y-12 md:fixed md:h-screen">

        <!-- Logo -->
        <div class="flex items-center space-x-2 border-b border-gray-700 pb-4 w-full justify-center md:justify-start">
            <h1 class="text-2xl font-bold">GO <span class="text-yellow-400">|</span> DELIVERY</h1>
        </div>

        <!-- Nav -->
        <nav class="flex flex-col space-y-2 w-full">
            <a href="<?= URLROOT ?>/admin/home"
                class="flex items-center space-x-4 p-3 rounded-lg <?= strpos($currentRoute, '/admin/home') !== false ? 'active-sidebar-link' : '' ?>">
                <i class="fas fa-home text-lg"></i>
                <span class="font-medium">Dashboard</span>
            </a>

            <a href="<?= URLROOT ?>/admin/deliveryhistory"
                class="flex items-center space-x-4 p-3 rounded-lg <?= strpos($currentRoute, '/admin/deliveryhistory') !== false ? 'active-sidebar-link' : '' ?>">
                <i class="fas fa-history text-lg"></i>
                <span class="font-medium">Delivery History</span>
            </a>

            <a href="<?= URLROOT ?>/admin/pickuphistory"
                class="flex items-center space-x-4 p-3 rounded-lg <?= strpos($currentRoute, '/admin/pickuphistory') !== false ? 'active-sidebar-link' : '' ?>">
                <i class="fas fa-truck text-lg"></i>
                <span class="font-medium">Pick Up History</span>
            </a>


            <a href="<?= URLROOT ?>/admin/agent"
                class="flex items-center space-x-4 p-3 rounded-lg <?= strpos($currentRoute, '/admin/agent') !== false ? 'active-sidebar-link' : '' ?>">
                <i class="fas fa-user-tie text-lg"></i>
                <span class="font-medium">Agent</span>
            </a>

            <a href="<?= URLROOT ?>/admin/route"
                class="flex items-center space-x-4 p-3 rounded-lg <?= strpos($currentRoute, '/admin/route') !== false ? 'active-sidebar-link' : '' ?>">
                <i class="fas fa-route text-lg"></i>
                <span class="font-medium">Route</span>
            </a>

            <a href="<?= URLROOT ?>/available_place/available"
                class="flex items-center space-x-4 p-3 rounded-lg <?= strpos($currentRoute, '/available_place/available') !== false ? 'active-sidebar-link' : '' ?>">
                <i class="fas fa-map-marker-alt text-lg"></i>
                <span class="font-medium">Available Place</span>
            </a>

            <a href="<?= URLROOT ?>/admin/pro"
                class="flex items-center space-x-4 p-3 rounded-lg <?= strpos($currentRoute, '/admin/profile') !== false ? 'active-sidebar-link' : '' ?>">
                <i class="fas fa-user text-lg"></i>
                <span class="font-medium">Profile</span>
            </a>
        </nav>

        <!-- Logout -->
        <div class="mt-auto w-full">
            <a href="<?= URLROOT ?>/admincontroller/logout"
                class="flex items-center space-x-4 p-3 rounded-lg hover:bg-red-600 transition duration-200">
                <i class="fas fa-sign-out-alt text-lg"></i>
                <span class="font-medium">Logout</span>
            </a>
        </div>
    </aside>
</body>

</html>