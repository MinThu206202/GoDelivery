<?php
$totalAgents = count($data['allUserData']);

// Count total deliveries
$totalDeliveries = count($data['allDeliveryData']);

// Separate complete vs not complete
$completeDeliveries = 0;
$notCompleteDeliveries = 0;

foreach ($data['allDeliveryData'] as $delivery) {
    if ($delivery['delivery_status'] === 'complete') {
        $completeDeliveries++;
    } else {
        $notCompleteDeliveries++;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GoDelivery - Admin Dashboard</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

    body {
        font-family: 'Poppins', sans-serif;
    }

    /* Custom animation for the alert box */
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .custom-alert-box {
        animation: fadeIn 0.3s ease-out;
    }

    /*
        To fully replicate the PHP sidebar logic, you'd dynamically add classes
        based on the route. Below is an example of what that would look like
        using ternary operators and Tailwind classes.
        */
    </style>
</head>

<body class="bg-[#e9eff5] text-[#555] font-sans">
    <div class="flex flex-col lg:flex-row min-h-screen">
        <!-- Sidebar -->
        <aside
            class="w-full lg:w-64 bg-[#1F265B] text-white p-5 lg:p-0 shadow-lg lg:shadow-none lg:fixed lg:h-full lg:overflow-y-auto z-50">
            <div class="sidebar-header text-center text-3xl font-bold py-5">
                GO<span class="text-white">|</span>DELIVERY
            </div>
            <nav class="sidebar-nav flex flex-wrap justify-center lg:flex-col lg:space-y-2">
                <a href="#"
                    class="nav-item flex items-center p-3 lg:px-6 text-white/80 hover:bg-white/10 transition-all duration-300 rounded-md
                    <?= strpos($currentRoute, '/admin/home') !== false ? 'bg-white text-[#1F265B] border-l-4 border-[#ff6600] pl-10' : '' ?>">
                    <i class="fas fa-home mr-3 text-lg"></i> Dashboard
                </a>
                <a href="#"
                    class="nav-item flex items-center p-3 lg:px-6 text-white/80 hover:bg-white/10 transition-all duration-300 rounded-md
                    <?= strpos($currentRoute, '/admin/deliveryhistory') !== false ? 'bg-white text-[#1F265B] border-l-4 border-[#ff6600] pl-10' : '' ?>">
                    <i class="fas fa-history mr-3 text-lg"></i> Delivery History
                </a>
                <a href="#"
                    class="nav-item flex items-center p-3 lg:px-6 text-white/80 hover:bg-white/10 transition-all duration-300 rounded-md
                    <?= strpos($currentRoute, '/admin/agent') !== false ? 'bg-white text-[#1F265B] border-l-4 border-[#ff6600] pl-10' : '' ?>">
                    <i class="fas fa-user-tie mr-3 text-lg"></i> Agent
                </a>
                <a href="#"
                    class="nav-item flex items-center p-3 lg:px-6 text-white/80 hover:bg-white/10 transition-all duration-300 rounded-md
                    <?= strpos($currentRoute, '/admin/access_code') !== false ? 'bg-white text-[#1F265B] border-l-4 border-[#ff6600] pl-10' : '' ?>">
                    <i class="fas fa-key mr-3 text-lg"></i> Access Code
                </a>
                <a href="#"
                    class="nav-item flex items-center p-3 lg:px-6 text-white/80 hover:bg-white/10 transition-all duration-300 rounded-md
                    <?= strpos($currentRoute, '/admin/route') !== false ? 'bg-white text-[#1F265B] border-l-4 border-[#ff6600] pl-10' : '' ?>">
                    <i class="fas fa-route mr-3 text-lg"></i> Route
                </a>
                <a href="#"
                    class="nav-item flex items-center p-3 lg:px-6 text-white/80 hover:bg-white/10 transition-all duration-300 rounded-md
                    <?= strpos($currentRoute, '/available_place/available') !== false ? 'bg-white text-[#1F265B] border-l-4 border-[#ff6600] pl-10' : '' ?>">
                    <i class="fas fa-map-marker-alt mr-3 text-lg"></i> Available Place
                </a>
                <a href="#"
                    class="nav-item flex items-center p-3 lg:px-6 text-white/80 hover:bg-white/10 transition-all duration-300 rounded-md
                    <?= strpos($currentRoute, '/admin/profile') !== false ? 'bg-white text-[#1F265B] border-l-4 border-[#ff6600] pl-10' : '' ?>">
                    <i class="fas fa-user mr-3 text-lg"></i> Profile
                </a>
                <a href="#"
                    class="nav-item logout flex items-center p-3 lg:px-6 text-white/80 hover:bg-white/10 transition-all duration-300 rounded-md lg:mt-10">
                    <i class="fas fa-sign-out-alt mr-3 text-lg"></i> Logout
                </a>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="main-content flex-grow p-4 lg:ml-64 lg:p-8">
            <!-- Dashboard Header -->
            <header
                class="flex flex-col md:flex-row items-center justify-between bg-white p-5 rounded-xl shadow-md mb-8">
                <h2 class="text-3xl font-bold text-[#333] mb-4 md:mb-0">Agent</h2>
                <form method="POST" action="<?php echo URLROOT; ?>/admincontroller/search">
                    <div
                        class="search-bar w-full md:w-auto flex items-center border border-[#cdd2d7] rounded-full overflow-hidden bg-[#f0f2f5] max-w-lg">
                        <input type="text" name="tracking_code" id="searchInput"
                            placeholder="Enter Customer WayBill Number"
                            class="flex-grow border-none px-5 py-3 outline-none bg-transparent text-[#555] text-center">
                        <button id="searchButton"
                            class="bg-transparent border-none px-4 py-3 cursor-pointer text-[#1F265B] text-xl transition-colors duration-300 hover:text-[#151b43]">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </form>
                <div class="admin-profile flex items-center font-semibold text-[#333] mt-4 md:mt-0">
                    <div
                        class="profile-icon bg-[#1F265B] text-white w-10 h-10 rounded-full flex items-center justify-center text-xl mr-3">
                        <i class="fas fa-user-circle"></i>
                    </div>
                    <span><?= htmlspecialchars($_SESSION['user']['name']) ?></span>
                </div>
            </header>

            <!-- Summary Cards -->
            <section class="summary-cards grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 mb-8">
                <div class="card bg-[#1F265B] text-white p-6 rounded-xl text-center shadow-lg">
                    <p class="text-base font-normal opacity-90 mb-2">Total Deliveries</p>
                    <p class="text-4xl font-extrabold"><?= $totalDeliveries ?></p>
                </div>
                <div class="card bg-[#1F265B] text-white p-6 rounded-xl text-center shadow-lg">
                    <p class="text-base font-normal opacity-90 mb-2">Completed Deliveries</p>
                    <p class="text-4xl font-extrabold"><?= $completeDeliveries ?></p>
                </div>
                <div class="card bg-[#1F265B] text-white p-6 rounded-xl text-center shadow-lg">
                    <p class="text-base font-normal opacity-90 mb-2">Pending Delivery</p>
                    <p class="text-4xl font-extrabold"><?= $notCompleteDeliveries ?></p>
                </div>
                <div class="card bg-[#1F265B] text-white p-6 rounded-xl text-center shadow-lg">
                    <p class="text-base font-normal opacity-90 mb-2">Total Agent</p>
                    <p class="text-4xl font-extrabold"><?= $totalAgents ?></p>
                </div>
            </section>

            <!-- Delivery List Panel -->
            <section class="panel bg-white rounded-xl shadow-md p-6 mb-8">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-2xl font-semibold text-[#333]">Delivery List</h3>
                    <a href="#"
                        class="bg-[#1F265B] text-white py-2 px-4 rounded-lg font-medium transition-all duration-300 hover:bg-[#151b43]">
                        <i class="fas fa-plus mr-2"></i> Add New
                    </a>
                </div>
                <div class="table-container overflow-x-auto">
                    <table class="w-full border-collapse min-w-[600px]">
                        <thead>
                            <tr>
                                <th
                                    class="text-left px-5 py-4 bg-[#1F265B] text-white font-semibold text-sm uppercase sticky top-0 z-10">
                                    Tracking Code</th>
                                <th
                                    class="text-left px-5 py-4 bg-[#1F265B] text-white font-semibold text-sm uppercase sticky top-0 z-10">
                                    From</th>
                                <th
                                    class="text-left px-5 py-4 bg-[#1F265B] text-white font-semibold text-sm uppercase sticky top-0 z-10">
                                    To</th>
                                <th
                                    class="text-left px-5 py-4 bg-[#1F265B] text-white font-semibold text-sm uppercase sticky top-0 z-10">
                                    Date & Time</th>
                                <th
                                    class="text-left px-5 py-4 bg-[#1F265B] text-white font-semibold text-sm uppercase sticky top-0 z-10">
                                    Amount</th>
                                <th
                                    class="text-left px-5 py-4 bg-[#1F265B] text-white font-semibold text-sm uppercase sticky top-0 z-10">
                                    Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($data['allDeliveryData'])): ?>
                            <?php foreach ($data['allDeliveryData'] as $user): ?>
                            <tr class="hover:bg-[#fcfcfc] transition-colors duration-200">
                                <td class="px-5 py-4 border-b border-[#e0e0e0] whitespace-nowrap">
                                    <?= htmlspecialchars($user['tracking_code']); ?></td>
                                <td class="px-5 py-4 border-b border-[#e0e0e0] whitespace-nowrap">
                                    <?= htmlspecialchars($user['from_city_name']) ?></td>
                                <td class="px-5 py-4 border-b border-[#e0e0e0] whitespace-nowrap">
                                    <?= htmlspecialchars($user['to_city_name']) ?></td>
                                <td class="px-5 py-4 border-b border-[#e0e0e0] whitespace-nowrap">
                                    <?= htmlspecialchars($user['created_at']) ?></td>
                                <td class="px-5 py-4 border-b border-[#e0e0e0] whitespace-nowrap">
                                    $<?= htmlspecialchars($user['amount']) ?></td>
                                <td class="px-5 py-4 border-b border-[#e0e0e0] whitespace-nowrap">
                                    <?= htmlspecialchars($user['delivery_status']) ?></td>
                            </tr>
                            <?php endforeach; ?>
                            <?php else: ?>
                            <tr>
                                <td colspan="7" class="px-5 py-4 text-center">No delivery data available.</td>
                            </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </section>

            <!-- Agent List Panel -->
            <section class="agent-panel panel bg-white rounded-xl shadow-md p-6">
                <h3 class="text-2xl font-semibold text-[#333] mb-6">Agent</h3>
                <div class="table-container overflow-x-auto">
                    <table class="w-full border-collapse min-w-[600px]">
                        <thead>
                            <tr>
                                <th
                                    class="text-left px-5 py-4 bg-[#1F265B] text-white font-semibold text-sm uppercase sticky top-0 z-10">
                                    Agent Code</th>
                                <th
                                    class="text-left px-5 py-4 bg-[#1F265B] text-white font-semibold text-sm uppercase sticky top-0 z-10">
                                    Agent Name</th>
                                <th
                                    class="text-left px-5 py-4 bg-[#1F265B] text-white font-semibold text-sm uppercase sticky top-0 z-10">
                                    City</th>
                                <th
                                    class="text-left px-5 py-4 bg-[#1F265B] text-white font-semibold text-sm uppercase sticky top-0 z-10">
                                    Address</th>
                                <th
                                    class="text-left px-5 py-4 bg-[#1F265B] text-white font-semibold text-sm uppercase sticky top-0 z-10">
                                    Created Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($data['allUserData'])): ?>
                            <?php foreach ($data['allUserData'] as $user): ?>
                            <tr class="hover:bg-[#fcfcfc] transition-colors duration-200">
                                <td class="px-5 py-4 border-b border-[#e0e0e0] whitespace-nowrap">
                                    <?= htmlspecialchars($user['name']) ?></td>
                                <td class="px-5 py-4 border-b border-[#e0e0e0] whitespace-nowrap">
                                    <?= htmlspecialchars($user['city_name']) ?></td>
                                <td class="px-5 py-4 border-b border-[#e0e0e0] whitespace-nowrap">
                                    <?= htmlspecialchars($user['address']) ?></td>
                                <td class="px-5 py-4 border-b border-[#e0e0e0] whitespace-nowrap">
                                    <?= htmlspecialchars($user['address']) ?></td>
                                <td class="px-5 py-4 border-b border-[#e0e0e0] whitespace-nowrap">
                                    <?= htmlspecialchars($user['created_at']) ?></td>
                            </tr>
                            <?php endforeach; ?>
                            <?php else: ?>
                            <tr>
                                <td colspan="5" class="px-5 py-4 text-center">No user data available.</td>
                            </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </section>
        </main>
    </div>

    <!-- Custom Alert Box HTML -->
    <div class="custom-alert-overlay fixed top-0 left-0 w-full h-full bg-black/50 hidden items-center justify-center z-[2000] backdrop-blur-sm"
        id="customAlertOverlay">
        <div
            class="custom-alert-box bg-white p-10 rounded-xl shadow-2xl w-11/12 max-w-lg text-center flex flex-col gap-6">
            <h4 class="text-3xl font-bold text-[#1F265B] mb-1">Notification</h4>
            <p id="customAlertMessage" class="text-base text-[#555] leading-relaxed mb-0"></p>
            <button id="customAlertCloseButton"
                class="bg-[#1F265B] text-white border-none py-3 px-6 rounded-lg text-lg font-semibold cursor-pointer transition-all duration-300 hover:bg-[#151b43] hover:-translate-y-0.5">OK</button>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', () => {
        const searchInput = document.getElementById('searchInput');
        const searchButton = document.getElementById('searchButton');
        const customAlertOverlay = document.getElementById('customAlertOverlay');
        const customAlertMessage = document.getElementById('customAlertMessage');
        const customAlertCloseButton = document.getElementById('customAlertCloseButton');

        /**
         * Shows the custom alert box with a given message.
         * @param {string} message - The message to display in the alert box.
         */
        function showAlert(message) {
            customAlertMessage.textContent = message;
            customAlertOverlay.style.display = 'flex';
        }

        /**
         * Hides the custom alert box.
         */
        function hideAlert() {
            customAlertOverlay.style.display = 'none';
        }

        // Event listener for the search button
        searchButton.addEventListener('click', () => {
            const searchTerm = searchInput.value.trim();
            if (searchTerm === '') {
                showAlert("Please enter a tracking code to search.");
            } else {
                // Redirect to delivery_details.html with the search term as a URL parameter
                window.location.href =
                    `../html/search.html?trackingCode=${encodeURIComponent(searchTerm)}`;
            }
        });

        // Event listener for the custom alert close button
        customAlertCloseButton.addEventListener('click', hideAlert);

        // Event listener to close alert when clicking outside the box
        customAlertOverlay.addEventListener('click', (event) => {
            if (event.target === customAlertOverlay) {
                hideAlert();
            }
        });
    });
    </script>
</body>

</html>