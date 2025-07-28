<?php require_once APPROOT . '/views/inc/agentsidebar.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deliveries - Delivery Management</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Inter Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f3f4f6;
        }

        /* Custom styles for toast notifications (if used on this page) */
        .toast-success {
            background-color: #22c55e;
            /* green-500 */
        }

        .toast-error {
            background-color: #ef4444;
            /* red-500 */
        }

        .toast-warning {
            background-color: #f59e0b;
            /* amber-500 */
        }

        /* Ensure the main content area correctly manages its height */
        .flex-1.flex.flex-col.overflow-hidden {
            height: 100vh;
            /* Ensure it takes full viewport height */
            display: flex;
            flex-direction: column;
        }

        /* Make table header sticky and visible */
        .sticky-header th {
            background-color: #f9fafb;
            /* Light gray background for sticky header */
            position: sticky;
            top: 0;
            z-index: 10;
            /* Ensure it stays above scrolling content */
        }
    </style>
</head>

<body class="flex h-screen overflow-hidden">

    <!-- Sidebar (assuming agentsidebar.php provides this) -->
    <!-- The content of agentsidebar.php would typically go here -->
    <!-- For demonstration, I'm including a placeholder sidebar -->
    <aside class="w-64 bg-[#1F265B] text-white flex flex-col rounded-r-lg shadow-lg no-print">
        <div class="p-6 text-2xl font-bold text-center border-b border-[#2A346C] rounded-tl-lg">
            Delivery Agent
        </div>
        <nav class="flex-1 px-4 py-6 space-y-2" id="sidebarNav">
            <?php $currentRoute = $_SERVER['REQUEST_URI']; ?>
            <a href="<?= URLROOT; ?>/agent/home"
                class="flex items-center px-4 py-3 rounded-lg transition duration-200 
               <?= strpos($currentRoute, '/agent/home') !== false ? 'active-sidebar-link text-white bg-[#2A346C]' : 'text-gray-300 hover:bg-[#2A346C] hover:text-white' ?>"
                data-page="dashboard">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                </svg>
                Dashboard
            </a>
            <a href="<?= URLROOT; ?>/agent/my_deliveries"
                class="flex items-center px-4 py-3 rounded-lg transition duration-200 
               <?= strpos($currentRoute, '/agent/my_deliveries') !== false ? 'active-sidebar-link text-white bg-[#2A346C]' : 'text-gray-300 hover:bg-[#2A346C] hover:text-white' ?>">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                </svg>
                My Deliveries
            </a>
            <a href="<?= URLROOT; ?>/agent/incoming"
                class="flex items-center px-4 py-3 rounded-lg transition duration-200 
               <?= strpos($currentRoute, '/agent/incoming') !== false ? 'active-sidebar-link text-white bg-[#2A346C]' : 'text-gray-300 hover:bg-[#2A346C] hover:text-white' ?>">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                    </path>
                </svg>
                Incoming Deliveries
            </a>
            <a href="<?= URLROOT; ?>/agent/profile"
                class="flex items-center px-4 py-3 rounded-lg transition duration-200 
               <?= strpos($currentRoute, '/agent/profile') !== false ? 'active-sidebar-link text-white bg-[#2A346C]' : 'text-gray-300 hover:bg-[#2A346C] hover:text-white' ?>">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
                Agent Profile
            </a>
            <a href="<?= URLROOT; ?>/agent/customers"
                class="flex items-center px-4 py-3 rounded-lg transition duration-200 
               <?= strpos($currentRoute, '/agent/customers') !== false ? 'active-sidebar-link text-white bg-[#2A346C]' : 'text-gray-300 hover:bg-[#2A346C] hover:text-white' ?>">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.653-.146-1.28-.42-1.828m0 0a9.009 9.009 0 00-3.963-3.963M12 8a3 3 0 100-6 3 3 0 000 6zm-3 6a9.009 9.009 0 00-3.963-3.963m0 0C4.146 13.72 4 14.347 4 15v2H2m3-2.42A3.001 3.001 0 009 15.5V17m0 0h-2"></path>
                </svg>
                Customers
            </a>
            <a href="<?= URLROOT; ?>/agent/settings"
                class="flex items-center px-4 py-3 rounded-lg transition duration-200 
               <?= strpos($currentRoute, '/agent/settings') !== false ? 'active-sidebar-link text-white bg-[#2A346C]' : 'text-gray-300 hover:bg-[#2A346C] hover:text-white' ?>">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37a1.724 1.724 0 002.572-1.065z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                </svg>
                Settings
            </a>
            <a href="<?= URLROOT; ?>/agent/logout"
                class="flex items-center px-4 py-3 rounded-lg text-gray-300 hover:bg-[#2A346C] hover:text-white transition-colors duration-200">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                </svg>
                Logout
            </a>
        </nav>
    </aside>

    <!-- Main Content Area -->
    <div class="flex-1 flex flex-col overflow-hidden min-h-0">
        <!-- Header -->
        <header class="flex items-center justify-between p-6 bg-white shadow-md rounded-bl-lg">
            <h1 class="text-3xl font-semibold text-gray-800">Deliveries</h1>
            <div class="flex items-center space-x-4">
                <div class="flex items-center space-x-2">
                    <img src="https://placehold.co/40x40/FF6347/FFFFFF?text=JD" alt="Agent Avatar"
                        class="w-10 h-10 rounded-full border-2 border-blue-500">
                    <div>
                        <p class="text-lg font-medium text-gray-800"><?= htmlspecialchars($agent['name']) ?></p>
                        <p class="text-sm text-gray-500">Agent ID: #007</p>
                    </div>
                </div>
            </div>
        </header>

        <!-- Delivery History Content -->
        <main class="flex-1 p-6 bg-gray-100 flex flex-col min-h-0">
            <div class="max-w-6xl mx-auto bg-white p-8 rounded-xl shadow-md flex-1 flex flex-col min-h-0">
                <h2 class="text-2xl font-semibold text-gray-800 mb-6">All Deliveries</h2>

                <!-- Filter Links -->
                <div class="mb-6 flex flex-wrap gap-3 flex-shrink-0">
                    <a href="#" onclick="filterDeliveries(event, 'All')"
                        class="filter-link px-5 py-2 rounded-lg text-sm font-medium border border-gray-300 bg-gray-100 hover:bg-gray-200 transition-colors duration-200 active">
                        All
                    </a>
                    <a href="#" onclick="filterDeliveries(event, 'Delivered')"
                        class="filter-link px-5 py-2 rounded-lg text-sm font-medium border border-gray-300 bg-gray-100 hover:bg-gray-200 transition-colors duration-200">
                        Delivered
                    </a>
                    <a href="#" onclick="filterDeliveries(event, 'In Transit')"
                        class="filter-link px-5 py-2 rounded-lg text-sm font-medium border border-gray-300 bg-gray-100 hover:bg-gray-200 transition-colors duration-200">
                        In Transit
                    </a>
                    <a href="#" onclick="filterDeliveries(event, 'Pending')"
                        class="filter-link px-5 py-2 rounded-lg text-sm font-medium border border-gray-300 bg-gray-100 hover:bg-gray-200 transition-colors duration-200">
                        Pending
                    </a>
                    <a href="#" onclick="filterDeliveries(event, 'Cancelled')"
                        class="filter-link px-5 py-2 rounded-lg text-sm font-medium border border-gray-300 bg-gray-100 hover:bg-gray-200 transition-colors duration-200">
                        Cancelled
                    </a>
                    <a href="#" onclick="filterDeliveries(event, 'Return')"
                        class="filter-link px-5 py-2 rounded-lg text-sm font-medium border border-gray-300 bg-gray-100 hover:bg-gray-200 transition-colors duration-200">
                        Return
                    </a>
                </div>

                <div class="h-[500px] overflow-auto border border-gray-300 rounded-lg shadow">
                    <table class="min-w-full h-full table-fixed divide-y divide-gray-200">
                        <thead class="bg-gray-100 sticky top-0 z-10">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-700 uppercase">Order ID</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-700 uppercase">Customer</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-700 uppercase">Date</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-700 uppercase">From City</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-700 uppercase">To City</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-700 uppercase">Status</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-700 uppercase">Actions</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-200 align-top">
                            <?php if (!empty($data['delivery'])): ?>
                                <?php foreach ($data['delivery'] as $delivery):
                                    $statusClass = match ($delivery['delivery_status']) {
                                        'Delivered' => 'bg-green-100 text-green-800',
                                        'Pending' => 'bg-yellow-100 text-yellow-800',
                                        'In Transit' => 'bg-blue-100 text-blue-800',
                                        'Cancelled' => 'bg-red-100 text-red-800',
                                        'Return' => 'bg-purple-100 text-purple-800',
                                        default => 'bg-gray-100 text-gray-800',
                                    };
                                ?>
                                    <tr>
                                        <td class="px-4 py-3 text-sm text-gray-900"><?= $delivery['tracking_code'] ?></td>
                                        <td class="px-4 py-3 text-sm text-gray-700"><?= $delivery['sender_customer_name'] ?></td>
                                        <td class="px-4 py-3 text-sm text-gray-700"><?= $delivery['created_at'] ?></td>
                                        <td class="px-4 py-3 text-sm text-gray-700"><?= $delivery['sender_agent_city'] ?? 'N/A' ?></td>
                                        <td class="px-4 py-3 text-sm text-gray-700"><?= $delivery['receiver_agent_city'] ?? 'N/A' ?></td>
                                        <td class="px-4 py-3">
                                            <span class="px-2 inline-flex text-xs font-semibold rounded-full <?= $statusClass ?>">
                                                <?= $delivery['delivery_status'] ?>
                                            </span>
                                        </td>
                                        <td class="px-4 py-3 whitespace-nowrap">
                                            <a href="<?= URLROOT ?>/agentcontroller/delivery_detail/<?= $delivery['tracking_code'] ?>"
                                                class="text-white bg-[#1F265B] px-4 py-2 rounded hover:bg-[#2A346C] mr-2">
                                                View
                                            </a>
                                            <!-- Edit Button Added Here -->
                                            <a href="<?= URLROOT ?>/agentcontroller/edit_delivery/<?= $delivery['tracking_code'] ?>"
                                                class="text-white bg-blue-500 px-4 py-2 rounded hover:bg-blue-600">
                                                Edit
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="7">
                                        <div class="h-[400px] flex items-center justify-center text-gray-400 text-sm">
                                            No deliveries found.
                                        </div>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>

    <script>
        function viewDeliveryDetails(orderId) {
            console.log("Viewing details for Order ID: " + orderId);
            // In a real application, you would navigate to a detailed view page
            // For now, an alert is used as a placeholder.
            alert("Viewing details for Order ID: " + orderId);
        }

        function filterDeliveries(event, status) {
            event.preventDefault(); // Prevent default link behavior

            const tableBody = document.getElementById('deliveryTableBody');
            const rows = tableBody.getElementsByTagName('tr');
            const filterLinks = document.querySelectorAll('.filter-link');

            // Remove 'active' class from all links and reset their styles
            filterLinks.forEach(link => {
                link.classList.remove('active', 'bg-[#1F265B]', 'text-white');
                link.classList.add('bg-gray-100', 'text-gray-700');
            });

            // Add 'active' class to the clicked link and apply active styles
            event.currentTarget.classList.add('active', 'bg-[#1F265B]', 'text-white');
            event.currentTarget.classList.remove('bg-gray-100', 'text-gray-700');


            for (let i = 0; i < rows.length; i++) {
                const row = rows[i];
                const rowStatus = row.getAttribute('data-status');

                if (status === 'All' || rowStatus === status) {
                    row.style.display = ''; // Show the row
                } else {
                    row.style.display = 'none'; // Hide the row
                }
            }
        }

        // Initialize with 'All' deliveries displayed and 'All' button active
        document.addEventListener('DOMContentLoaded', () => {
            const allLink = document.querySelector('.filter-link.active');
            if (allLink) {
                // Manually trigger the filter function for the 'All' link on load
                filterDeliveries({
                    currentTarget: allLink,
                    preventDefault: () => {}
                }, 'All');
            }
        });
    </script>
</body>

</html>