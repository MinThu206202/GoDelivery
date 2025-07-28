<?php require_once APPROOT . '/views/inc/agentsidebar.php'; ?>

<!-- Main Content Area -->
<div class="flex-1 flex flex-col overflow-hidden">
    <!-- Header -->
    <header class="flex items-center justify-between p-6 bg-white shadow-md rounded-bl-lg">
        <h1 class="text-3xl font-semibold text-gray-800">Dashboard</h1>
        <div class="flex items-center space-x-4">
            <form action="<?= URLROOT ?>/agentcontroller/search" method="GET" class="relative">
                <input
                    type="text"
                    name="q"
                    placeholder="Search..."
                    class="px-4 py-2 border border-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500">
                <button type="submit">
                    <svg class="absolute right-3 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </button>
            </form>
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

    <!-- Dashboard Content -->
    <main class="flex-1 overflow-y-auto p-6 bg-gray-100">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
            <!-- Metric Card 1 -->
            <div class="bg-white p-6 rounded-xl shadow-md flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Deliveries Today</p>
                    <p class="text-3xl font-bold text-gray-900">12</p>
                </div>
                <div class="p-3 bg-blue-100 rounded-full">
                    <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01">
                        </path>
                    </svg>
                </div>
            </div>

            <!-- Metric Card 2 -->
            <div class="bg-white p-6 rounded-xl shadow-md flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Pending Deliveries</p>
                    <p class="text-3xl font-bold text-gray-900">5</p>
                </div>
                <div class="p-3 bg-yellow-100 rounded-full">
                    <svg class="w-8 h-8 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>

            <!-- Metric Card 3 -->
            <div class="bg-white p-6 rounded-xl shadow-md flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Total Earnings (Week)</p>
                    <p class="text-3xl font-bold text-gray-900">$450.75</p>
                </div>
                <div class="p-3 bg-green-100 rounded-full">
                    <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.592 1L21 12m-6-4h.01M3 12l2.408-1.592A2.501 2.501 0 006 10c0-1.11.89-2 2-2h.01M12 21v-7m0 0V3">
                        </path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Recent Orders Table -->
            <div class="bg-white p-6 rounded-xl shadow-md lg:col-span-2"> <!-- Made it span full width -->
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Recent Orders</h2>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider rounded-tl-lg">
                                    Order ID</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Customer</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    City</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Amount</th> <!-- New Amount Column Header -->
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Status</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider rounded-tr-lg">
                                    Action</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php foreach ($data['delivery'] as $delivery):
                                $statusClass = '';
                                switch ($delivery['delivery_status']) {
                                    case 'Delivered':
                                        $statusClass = 'bg-green-100 text-green-800';
                                        break;
                                    case 'Pending':
                                        $statusClass = 'bg-yellow-100 text-yellow-800';
                                        break;
                                    case 'In Transit':
                                        $statusClass = 'bg-blue-100 text-blue-800';
                                        break;
                                    case 'Cancelled':
                                        $statusClass = 'bg-red-100 text-red-800';
                                        break;
                                    case 'Return':
                                        $statusClass = 'bg-purple-100 text-purple-800';
                                        break;
                                    default:
                                        $statusClass = 'bg-gray-100 text-gray-800'; // Default neutral color
                                        break;
                                }
                            ?>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><span><?= htmlspecialchars($delivery['tracking_code']) ?></span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><span><?= htmlspecialchars($delivery['sender_customer_name']) ?></span></td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><span><?= htmlspecialchars($delivery['receiver_agent_city']) ?></span></td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><span>MMK<?= htmlspecialchars(number_format($delivery['amount'] ?? 0.00, 2)) ?></span></td> <!-- New Amount Column Data -->
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full <?= $statusClass ?>">
                                            <?= htmlspecialchars($delivery['delivery_status']) ?>
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <a href="<?= URLROOT; ?>/agent/deliverydetails/<?= htmlspecialchars($delivery['tracking_code']) ?>"
                                            class="px-4 py-2 bg-[#1F265B] text-white rounded-lg hover:bg-[#2A346C] transition-colors duration-200">
                                            View
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
</div>

<script>
    function setActiveLink(clickedElement) {
        // Get all sidebar links
        const sidebarLinks = document.querySelectorAll('#sidebarNav a');

        // Remove 'active-sidebar-link' class from all links
        sidebarLinks.forEach(link => {
            link.classList.remove('active-sidebar-link');
        });

        // Add 'active-sidebar-link' class to the clicked element
        clickedElement.classList.add('active-sidebar-link');
    }

    // Set 'Dashboard' as active on initial load
    document.addEventListener('DOMContentLoaded', () => {
        const dashboardLink = document.querySelector('#sidebarNav a[data-page="dashboard"]');
        if (dashboardLink) {
            dashboardLink.classList.add('active-sidebar-link');
        }
    });
</script>

</body>

</html>