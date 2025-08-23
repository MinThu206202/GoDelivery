<?php
// var_dump($_SESSION['customer']);
// die();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GoDelivery</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            line-height: 1.6;
            color: #4A5568;
            background-color: #f8f9fa;
        }

        .hero-bg {
            background: linear-gradient(to right, #fff, #e6f0ff);
        }

        .search-box-shadow {
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body>
    <header
        class="bg-[#1F265B] text-white p-4 md:p-6 flex justify-between items-center fixed top-0 left-0 w-full z-50 shadow-md">
        <a href="<?= URLROOT ?>/pages/index" class="text-2xl font-extrabold">GO<span class="text-[#FFA500]"> |
            </span>DELIVERY</a>
        <nav class="flex items-center space-x-4 md:space-x-6">
            <?php $current = $_SERVER['REQUEST_URI']; ?>

            <a href="<?= URLROOT ?>/pages/calculator"
                class="flex items-center space-x-2 text-sm font-semibold px-3 py-1 rounded-full transition-colors <?= strpos($current, '/pages/calculator') !== false ? 'bg-white text-[#1F265B]' : 'text-gray-300 hover:text-white' ?>">
                <i class="fa-solid fa-calculator"></i><span>Price Calculator</span>
            </a>

            <a href="<?= URLROOT ?>/pages/ournetwork"
                class="flex items-center space-x-2 text-sm font-semibold px-3 py-1 rounded-full transition-colors <?= strpos($current, '/pages/ournetwork') !== false ? 'bg-white text-[#1F265B]' : 'text-gray-300 hover:text-white' ?>">
                <i class="fa-solid fa-map-location-dot"></i><span>Our Network</span>
            </a>

            <?php if (isset($_SESSION['customer'])): ?>
                <a href="<?= URLROOT ?>/pages/pickup"
                    class="flex items-center space-x-2 text-sm font-semibold px-3 py-1 rounded-full transition-colors <?= strpos($current, '/pages/pickup') !== false ? 'bg-white text-[#1F265B]' : 'text-gray-300 hover:text-white' ?>">
                    <i class="fa-solid fa-truck-fast"></i><span>Pick Up Request</span>
                </a>

                <a href="<?= URLROOT ?>/pages/pickuphistory"
                    class="flex items-center space-x-2 text-sm font-semibold px-3 py-1 rounded-full transition-colors <?= strpos($current, '/pages/pickuphistory') !== false ? 'bg-white text-[#1F265B]' : 'text-gray-300 hover:text-white' ?>">
                    <i class="fa-solid fa-history"></i><span>Pickup History</span>
                </a>

                <a href="<?= URLROOT ?>/pages/notification"
                    class="flex items-center space-x-2 text-sm font-semibold px-3 py-1 rounded-full transition-colors <?= strpos($current, '/pages/notification') !== false ? 'bg-white text-[#1F265B]' : 'text-gray-300 hover:text-white' ?>">
                    <i class="fa-solid fa-bell"></i><span>Notification</span>
                </a>

                <a href="<?= URLROOT ?>/auth/logout"
                    class="flex items-center space-x-2 px-3 py-1 bg-white text-[#1F265B] rounded-full text-sm font-semibold hover:bg-gray-100 transition-colors">
                    <i class="fa-solid fa-user"></i><span>Logout</span>
                </a>
            <?php else: ?>
                <a href="<?= URLROOT ?>/pages/customerlogin"
                    class="flex items-center space-x-2 px-3 py-1 bg-white text-[#1F265B] rounded-full text-sm font-semibold hover:bg-gray-100 transition-colors">
                    <i class="fa-solid fa-user"></i><span>Login</span>
                </a>
            <?php endif; ?>
        </nav>
    </header>
</body>

</html>