<?php require_once APPROOT . '/views/inc/agentsidebar.php'; ?>

<script src="https://cdn.tailwindcss.com"></script>
<!-- Inter Font -->
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<style>
body {
    font-family: 'Inter', sans-serif;
    background-color: #f3f4f6;
}
</style>

<!-- Main Content Area -->
<div class="flex-1 flex flex-col overflow-hidden">
    <!-- Header -->
    <header class="flex items-center justify-between p-6 bg-white shadow-md rounded-bl-lg">
        <h1 class="text-3xl font-semibold text-gray-800">Incoming Deliveries</h1>
        <div class="flex items-center space-x-4">
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

    <!-- Delivery History Content -->
    <main class="flex-1 overflow-y-auto p-6 bg-gray-100">
        <div class="max-w-6xl mx-auto bg-white p-8 rounded-xl shadow-md">
            <h2 class="text-2xl font-semibold text-gray-800 mb-6">All Deliveries</h2>

            <!-- Filter Links -->
            <div class="mb-6 flex flex-wrap gap-3">
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

            <div class="overflow-x-auto">
                <div class="overflow-x-auto h-[450px] flex">
                    <table class="min-w-full divide-y divide-gray-200 self-start w-full">
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
                                    Delivery Date</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    From City</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Destination City</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Status</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Actions</th>
                            </tr>
                        </thead>
                        <tbody id="deliveryTableBody" class="bg-white divide-y divide-gray-200">
                            <?php if (!empty($data['delivery'])): ?>
                            <?php foreach ($data['delivery'] as $delivery):
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
                                        'Rejected by Agent' => 'bg-red-300 text-red-900',
                                        'Delivery at Office' => 'bg-indigo-300 text-indigo-900',
                                        default => 'bg-gray-100 text-gray-800',
                                    };
                                ?>
                            <tr data-status="<?= htmlspecialchars($delivery['delivery_status']) ?>">

                                <!-- Order ID -->
                                <td class="px-6 py-4 text-sm font-medium text-gray-900 break-words max-w-[120px]">
                                    <?= htmlspecialchars($delivery['tracking_code']) ?>
                                </td>

                                <!-- Customer -->
                                <td class="px-6 py-4 text-sm text-gray-500 break-words max-w-[150px]">
                                    <?= htmlspecialchars($delivery['sender_customer_name']) ?>
                                </td>

                                <!-- Delivery Date -->
                                <td class="px-6 py-4 text-sm text-gray-500 break-words max-w-[120px]">
                                    <?= htmlspecialchars($delivery['created_at']) ?>
                                </td>

                                <!-- From City -->
                                <td class="px-6 py-4 text-sm text-gray-500 break-words max-w-[120px]">
                                    <?= htmlspecialchars($delivery['from_city_name'] ?? 'N/A') ?>
                                </td>

                                <!-- Destination City -->
                                <td class="px-6 py-4 text-sm text-gray-500 break-words max-w-[120px]">
                                    <?= htmlspecialchars($delivery['to_city_name'] ?? 'N/A') ?>
                                </td>

                                <!-- Status -->
                                <td class="px-6 py-4 text-sm">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full <?= $statusClass ?> 
                     break-words max-w-[120px] text-center">
                                        <?= htmlspecialchars($delivery['delivery_status']) ?>
                                    </span>
                                </td>

                                <!-- Actions (View / Edit buttons) -->
                                <td class="px-4 py-3 flex gap-2">
                                    <a href="<?= URLROOT ?>/agentcontroller/delivery_detail/<?= $delivery['tracking_code'] ?>"
                                        class="w-[80px] text-center px-3 py-2 rounded bg-[#1F265B] text-white hover:bg-[#2A346C] transition">
                                        View
                                    </a>

                                    <a href="<?= URLROOT ?>/agentcontroller/edit_incomedelivery/<?= $delivery['tracking_code'] ?>"
                                        class="w-[80px] text-center px-3 py-2 rounded bg-blue-500 text-white hover:bg-blue-600 transition">
                                        Edit
                                    </a>
                                </td>

                            </tr>

                            <?php endforeach; ?>
                            <?php else: ?>
                            <tr>
                                <td colspan="7" class="text-center text-gray-500 text-sm py-6">
                                    🚚 No delivery requests available.
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
function viewDeliveryDetails(orderId) {
    console.log("Viewing details for Order ID: " + orderId);
    alert("Viewing details for Order ID: " + orderId);
}

function filterDeliveries(event, status) {
    event.preventDefault(); // Prevent default link behavior

    const tableBody = document.getElementById('deliveryTableBody');
    const rows = tableBody.getElementsByTagName('tr');
    const filterLinks = document.querySelectorAll('.filter-link');

    // Remove 'active' class from all links
    filterLinks.forEach(link => {
        link.classList.remove('active');
        link.classList.remove('bg-[#1F265B]', 'text-white');
        link.classList.add('bg-gray-100', 'text-gray-700');
    });

    // Add 'active' class to the clicked link
    event.currentTarget.classList.add('active');
    event.currentTarget.classList.remove('bg-gray-100', 'text-gray-700');
    event.currentTarget.classList.add('bg-[#1F265B]', 'text-white');


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

document.addEventListener('DOMContentLoaded', () => {
    const tbody = document.getElementById('deliveryTableBody');
    const rows = tbody.querySelectorAll('tr');
    const container = tbody.closest('div');

    if (rows.length <= 0) {
        // center if only 1 or 2 rows
        container.classList.add("items-center");
    } else {
        // normal scroll if many
        container.classList.remove("items-center");
    }
});
</script>

</body>

</html>