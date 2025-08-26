<?php
$current_page = $_SERVER['REQUEST_URI'];
$user = $_SESSION['user'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Pickups</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        :root {
            --main-bg-color: rgb(31 38 91 / var(--tw-bg-opacity, 1));
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #f3f4f6;
        }

        .custom-scrollbar::-webkit-scrollbar {
            width: 8px;
        }

        .custom-scrollbar::-webkit-scrollbar-track {
            background: #e5e7eb;
            border-radius: 10px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #9ca3af;
            border-radius: 10px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: #6b7280;
        }

        .text-shadow-md {
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        }

        .active-link {
            background-color: #2563eb;
            color: white;
        }

        /* Tailwind bg-blue-600 */
    </style>
</head>

<body class="flex min-h-screen antialiased">

    <!-- Sidebar -->
    <div
        class="w-64 bg-[--main-bg-color] text-white p-6 rounded-r-lg shadow-lg h-screen sticky top-0 overflow-y-auto custom-scrollbar">
        <h1 class="text-3xl font-bold mb-1 text-blue-500 text-shadow-md">GoDelivery</h1>
        <h2 class="text-xl md:text-2xl font-bold text-white mb-6 text-shadow-md">Delivery Agent</h2>
        <div class="space-y-2">
            <a href="<?php echo URLROOT; ?>/pickupagentcontroller/Dashboard" class="flex items-center py-3 px-4 rounded-lg font-semibold transition duration-200 hover:bg-gray-800 
               <?php echo (strpos($current_page, 'Dashboard') !== false) ? 'active-link' : 'text-gray-300'; ?>">
                <i class="fas fa-th-large mr-3"></i> Dashboard
            </a>

            <a href="<?php echo URLROOT; ?>/pickupagentcontroller/mypick" class="flex items-center py-3 px-4 rounded-lg font-semibold transition duration-200 hover:bg-gray-800 
               <?php echo (strpos($current_page, 'mypick') !== false) ? 'active-link' : 'text-gray-300'; ?>">
                <i class="fas fa-truck-moving mr-3"></i> My Pickups
            </a>

            <a href="<?php echo URLROOT; ?>/pickupagentcontroller/completepickup" class="flex items-center py-3 px-4 rounded-lg font-semibold transition duration-200 hover:bg-gray-800 
               <?php echo (strpos($current_page, 'completepickup') !== false) ? 'active-link' : 'text-gray-300'; ?>">
                <i class="fas fa-history mr-3"></i> Completed Pickups
            </a>

            <a href="<?php echo URLROOT; ?>/pickupagentcontroller/pickupagentprofile"
                class="flex items-center py-3 px-4 rounded-lg font-semibold transition duration-200 hover:bg-gray-800 
               <?php echo (strpos($current_page, 'pickupagentprofile') !== false) ? 'active-link' : 'text-gray-300'; ?>">
                <i class="fas fa-user-circle mr-3"></i> Agent Profile
            </a>

            <a href="<?php echo URLROOT; ?>/pickupagentcontroller/notification" class="flex items-center py-3 px-4 rounded-lg font-semibold transition duration-200 hover:bg-gray-800 
               <?php echo (strpos($current_page, 'notification') !== false) ? 'active-link' : 'text-gray-300'; ?>">
                <i class="fas fa-bell mr-3"></i> Notifications
            </a>

            <a href="<?php echo URLROOT; ?>/agentcontroller/logout" class="flex items-center py-3 px-4 rounded-lg font-semibold transition duration-200 hover:bg-gray-800 
               <?php echo (strpos($current_page, 'logout') !== false) ? 'active-link' : 'text-gray-300'; ?>">
                <i class="fas fa-sign-out-alt mr-3"></i> Logout
            </a>
        </div>
    </div>