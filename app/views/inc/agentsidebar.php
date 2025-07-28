<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$agent = $_SESSION['user'];
$currentRoute = $_SERVER['REQUEST_URI'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agent Dashboard Sidebar</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Inter Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f3f4f6;
            /* Added for standalone view, remove if integrating into full page */
            display: flex;
            height: 100vh;
            overflow: hidden;
        }

        /* Active sidebar link style */
        .active-sidebar-link {
            background-color: #2A346C;
            /* Darker blue from your theme */
            color: white;
            font-weight: 600;
            /* Semibold */
        }
    </style>
</head>

<body class="flex h-screen overflow-hidden">

    <!-- Sidebar -->
    <aside class="w-64 bg-[#1F265B] text-white flex flex-col rounded-r-lg shadow-lg">
        <div class="p-6 text-2xl font-bold text-center border-b border-[#2A346C] rounded-tl-lg">
            Delivery Agent
        </div>
        <nav id="sidebarNav" class="flex-1 px-4 py-6 space-y-2">
            <!-- Dashboard Link -->
            <a href="<?= URLROOT; ?>/agent/home"
                class="flex items-center px-4 py-3 rounded-lg transition duration-200 
               <?= strpos($currentRoute, '/agent/home') !== false ? 'active-sidebar-link text-white' : 'text-gray-300 hover:bg-[#2A346C] hover:text-white' ?>">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                    </path>
                </svg>
                Dashboard
            </a>

            <!-- My Deliveries Link -->
            <a href="<?= URLROOT; ?>/agent/mydelivery"
                class="flex items-center px-4 py-3 rounded-lg transition duration-200 
               <?= strpos($currentRoute, '/agent/mydelivery') !== false ? 'active-sidebar-link text-white' : 'text-gray-300 hover:bg-[#2A346C] hover:text-white' ?>">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01">
                    </path>
                </svg>
                My Deliveries
            </a>

            <!-- Agent Profile Link -->
            <a href="<?= URLROOT; ?>/agent/profile"
                class="flex items-center px-4 py-3 rounded-lg transition duration-200 
               <?= strpos($currentRoute, '/agent/profile') !== false ? 'active-sidebar-link text-white' : 'text-gray-300 hover:bg-[#2A346C] hover:text-white' ?>">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
                Agent Profile
            </a>

            <!-- Create Voucher Link -->
            <a href="<?= URLROOT; ?>/agent/voucher"
                class="flex items-center px-4 py-3 rounded-lg transition duration-200 
               <?= strpos($currentRoute, '/agent/voucher') !== false ? 'active-sidebar-link text-white' : 'text-gray-300 hover:bg-[#2A346C] hover:text-white' ?>">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 13h6m-3-3v6m5 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                    </path>
                </svg>
                Create Voucher
            </a>

            <!-- Notifications Link -->
            <a href="<?= URLROOT; ?>/agent/notification"
                class="flex items-center px-4 py-3 rounded-lg transition duration-200 
               <?= strpos($currentRoute, '/agent/notification') !== false ? 'active-sidebar-link text-white' : 'text-gray-300 hover:bg-[#2A346C] hover:text-white' ?>">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 17v2a2 2 0 01-2 2H7a2 2 0 01-2-2V7a2 2 0 012-2h2m2 12l-4-4m0 0l4-4m4 4h6m-6 4v-4m0 0l4 4m-4-4l-4-4">
                    </path>
                </svg>
                Notifications
            </a>

            <!-- Request Delivery Link -->
            <a href="<?= URLROOT; ?>/agent/request"
                class="flex items-center px-4 py-3 rounded-lg transition duration-200 
               <?= strpos($currentRoute, '/agent/request') !== false ? 'active-sidebar-link text-white' : 'text-gray-300 hover:bg-[#2A346C] hover:text-white' ?>">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                    </path>
                </svg>
                Request Delivery
            </a>

            <!-- Logout Link -->
            <a href="#" class="flex items-center px-4 py-3 rounded-lg text-gray-300 hover:bg-[#2A346C] hover:text-white transition-colors duration-200">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                </svg>
                Logout
            </a>
        </nav>
    </aside>

</body>

</html>