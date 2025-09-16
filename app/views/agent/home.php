<?php require_once APPROOT . '/views/inc/agentsidebar.php';
$delivery = $data['delivery'];
$total  = count($delivery);
$delivery = $data['delivery']; // array of deliveries

$pendingCount = count(array_filter($delivery, function ($item) {
    return isset($item['delivery_status']) && $item['delivery_status'] === 'Pending';
}));

$totalAmount = array_sum(array_column($data['delivery'], 'amount'));


?>


<!-- Main Content Area -->
<div class="flex-1 flex flex-col overflow-hidden">
    <!-- Header -->
    <header class="flex items-center justify-between p-6 bg-white shadow-md rounded-bl-lg">
        <h1 class="text-3xl font-semibold text-gray-800">Dashboard</h1>
        <div class="flex items-center space-x-4">
            <form action="<?= URLROOT ?>/agentcontroller/search" method="GET" class="relative">
                <input type="text" name="q" placeholder="Search..."
                    class="px-4 py-2 border border-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500">
                <button type="submit">
                    <svg class="absolute right-3 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </button>
            </form>
            <div x-data="{ open: false }" class="relative">
                <!-- Button-like Trigger -->
                <button @click="open = !open"
                    class="flex items-center space-x-2 bg-white border border-gray-300 px-4 py-2 rounded-lg shadow-sm hover:bg-gray-100 transition">
                    <img src="/Delivery/<?= htmlspecialchars($agent['profile_image']) ?>" alt="Agent Avatar"
                        class="w-10 h-10 rounded-full border-2 border-blue-500">
                    <div class="text-left">
                        <p class="text-lg font-medium text-gray-800">
                            <?= htmlspecialchars($agent['name']) ?>
                        </p>
                        <p class="text-sm text-gray-500">
                            Agent ID: <?= htmlspecialchars($agent['access_code']) ?>
                        </p>
                    </div>
                </button>

                <!-- Dropdown -->
                <div x-show="open" @click.away="open = false" x-transition
                    class="absolute right-0 mt-2 w-48 bg-white border border-gray-200 rounded-lg shadow-lg py-2 z-50">
                    <!-- Profile -->
                    <a href="<?= URLROOT; ?>/agent/profile"
                        class="block px-4 py-2 text-gray-700 hover:bg-gray-100 transition">
                        Profile
                    </a>

                    <!-- Divider -->
                    <div class="border-t my-1"></div>

                    <!-- Logout -->
                    <a href="<?= URLROOT; ?>/agentcontroller/logout"
                        class="block px-4 py-2 text-gray-700 hover:bg-gray-100 transition">
                        Logout
                    </a>
                </div>
            </div>

            <!-- Alpine.js -->
            <script src="//unpkg.com/alpinejs" defer></script>


        </div>
    </header>

    <!-- Dashboard Content -->
    <main class="flex-1 overflow-y-auto p-6 bg-gray-100">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
            <!-- Metric Card 1 -->
            <div class="bg-white p-6 rounded-xl shadow-md flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Total Deliveries</p>
                    <p class="text-3xl font-bold text-gray-900"><span><?= htmlspecialchars($total) ?></span></p>
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
                    <p class="text-3xl font-bold text-gray-900"><span><?= htmlspecialchars($pendingCount) ?></span></p>
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
                    <p class="text-sm text-gray-500">Total Earnings</p>
                    <p class="text-3xl font-bold text-gray-900">
                        <span><?= number_format((float)$totalAmount, 0, '.', ',') ?> MMK</span>
                    </p>
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
            <div class="bg-white p-6 rounded-xl shadow-md lg:col-span-2">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Recent Orders</h2>

                <!-- Add scroll here -->
                <div class="overflow-x-auto max-h-[400px] overflow-y-auto rounded-lg border border-gray-200">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50 sticky top-0 z-10">
                            <tr>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Order ID</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Customer</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    City</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Amount</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Status</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Action</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php foreach ($data['delivery'] as $delivery): ?>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    <?= htmlspecialchars($delivery['tracking_code']) ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <?= htmlspecialchars($delivery['sender_customer_name']) ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <?= htmlspecialchars($delivery['to_township_name']) ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    MMK<?= htmlspecialchars(number_format($delivery['amount'] ?? 0, 2)) ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <?php
                                        $statusClass = match (trim($delivery['delivery_status'])) {
                                            'Pending' => 'bg-yellow-100 text-yellow-800',
                                            'Ready for Pickup' => 'bg-indigo-100 text-indigo-800',
                                            'Delivered' => 'bg-green-100 text-green-800',
                                            'Cancelled' => 'bg-red-100 text-red-800',
                                            'Returned' => 'bg-purple-100 text-purple-800',
                                            'Awaiting Acceptance' => 'bg-blue-100 text-blue-800',
                                            'Rejected' => 'bg-red-200 text-red-900',
                                            'Out for Delivery' => 'bg-blue-200 text-blue-900',
                                            'Deliver Parcel' => 'bg-green-200 text-green-900',
                                            'Waiting Payment' => 'bg-yellow-200 text-yellow-900',
                                            'Receipt Submitted' => 'bg-indigo-200 text-indigo-900',
                                            'Payment Success' => 'bg-green-300 text-green-900',
                                            'On the Way' => 'bg-blue-300 text-blue-900',
                                            'Delivery at Office' => 'bg-indigo-300 text-indigo-900',
                                            default => 'bg-gray-100 text-gray-800',
                                        };
                                        ?>
                                    <span
                                        class="px-3 py-1 inline-flex text-xs font-semibold rounded-full <?= $statusClass ?>">
                                        <?= htmlspecialchars($delivery['delivery_status']) ?>
                                    </span>

                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <a href="<?= URLROOT; ?>/agentcontroller/delivery_detail/<?= htmlspecialchars($delivery['tracking_code']) ?>"
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


            <!-- Pickup Requests Table -->
            <div class="bg-white p-6 rounded-xl shadow-md lg:col-span-2">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Pickup Requests</h2>
                <div class="overflow-x-auto max-h-[400px] overflow-y-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50 sticky top-0 z-10">
                            <tr>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider rounded-tl-lg">
                                    Request ID</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Customer</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    City</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Amount</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Status</th>

                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php if (!empty($data['pickup_requests'])): ?>
                            <?php foreach ($data['pickup_requests'] as $request): ?>
                            <?php
                                    // Status color mapping
                                    $statusColors = [
                                        'pending'                     => 'bg-yellow-500',
                                        'accepted'                    => 'bg-indigo-500',
                                        'collected'                   => 'bg-orange-600',
                                        'voucher_created'             => 'bg-purple-600',
                                        'delivered'                   => 'bg-green-500',
                                        'arrived_office'              => 'bg-teal-500',
                                        'rejected'                    => 'bg-red-500',
                                        'agent_checked'               => 'bg-pink-500',
                                        'awaiting_payment'            => 'bg-orange-500',
                                        'payment_success'             => 'bg-emerald-600',
                                        'awaiting_cash'               => 'bg-amber-500',
                                        'cash_collected'              => 'bg-lime-600',
                                        'pickup_verification_pending' => 'bg-orange-500',
                                        'pickup_verified'             => 'bg-blue-500',
                                        'on_the_way'                  => 'bg-sky-500',
                                        'waiting_for_receipt'         => 'bg-pink-500',
                                        'receipt_submitted'           => 'bg-cyan-500',
                                        'payment_pending'             => 'bg-amber-600',
                                        'payment_reject'              => 'bg-red-600',
                                        'cancelled'                   => 'bg-gray-600',
                                        'arrived_at_user'             => 'bg-green-600',
                                        'pickup_failed'               => 'bg-red-600',
                                        'default'                     => 'bg-gray-400',
                                    ];

                                    $statusKey   = strtolower($request['status']);
                                    $statusClass = $statusColors[$statusKey] ?? $statusColors['default'];
                                    ?>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    <?= htmlspecialchars($request['request_code']) ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <?= htmlspecialchars($request['sender_name']) ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <?= htmlspecialchars($request['sender_township']) ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    MMK<?= htmlspecialchars(number_format($request['amount'] ?? 0, 2)) ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full text-white <?= $statusClass ?>">
                                        <?= htmlspecialchars($request['status']) ?>
                                    </span>
                                </td>

                            </tr>
                            <?php endforeach; ?>
                            <?php else: ?>
                            <tr>
                                <td colspan="6" class="px-6 py-4 text-center text-sm text-gray-500">
                                    🚚 No data yet
                                </td>
                            </tr>
                            <?php endif; ?>
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