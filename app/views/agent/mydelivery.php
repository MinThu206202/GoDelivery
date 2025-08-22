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
        <h1 class="text-3xl font-semibold text-gray-800">Deliveries</h1>
        <div class="flex items-center space-x-4">
            <div class="flex items-center space-x-2">
                <img src="/Delivery/<?= htmlspecialchars($agent['profile_image']) ?>" alt="Agent Avatar"
                    class="w-10 h-10 rounded-full border-2 border-blue-500">
                <div>
                    <p class="text-lg font-medium text-gray-800"><?= htmlspecialchars($agent['name']) ?></p>
                    <p class="text-sm text-gray-500">Agent ID: <?= htmlspecialchars($agent['access_code']) ?></p>
                </div>
            </div>
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

            <!-- Fixed Table Height -->
            <div class="overflow-x-auto h-[450px] flex">
                <table class="min-w-full divide-y divide-gray-200 self-start w-full">
                    <thead class="bg-gray-50 sticky top-0 z-10">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Order ID</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Customer</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Delivery Date</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                From City</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Destination City</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Actions</th>
                        </tr>
                    </thead>
                    <tbody id="deliveryTableBody" class="bg-white divide-y divide-gray-200">
                        <?php if (!empty($data['delivery'])): ?>
                            <?php foreach ($data['delivery'] as $delivery):
                                $statusClass = match ($delivery['delivery_status']) {
                                    'Pending' => 'bg-gray-100 text-gray-800',
                                    'Awaiting Acceptance' => 'bg-yellow-100 text-yellow-800',
                                    'Rejected' => 'bg-red-100 text-red-800',
                                    'In Transit' => 'bg-blue-100 text-blue-800',
                                    'Delivered' => 'bg-green-100 text-green-800',
                                    'Return' => 'bg-purple-100 text-purple-800',
                                    'Cancelled' => 'bg-rose-100 text-rose-800',
                                    'Failed Delivery' => 'bg-orange-100 text-orange-800',
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
                                    <td class="px-4 py-3 flex flex-wrap gap-2">
                                        <a href="<?= URLROOT ?>/agentcontroller/delivery_detail/<?= $delivery['tracking_code'] ?>"
                                            class="text-white bg-[#1F265B] px-3 py-2 rounded hover:bg-[#2A346C] break-words text-center w-[80px]">
                                            View
                                        </a>

                                        <?php if ($delivery['delivery_status'] !== 'In Transit'): ?>
                                            <a href="<?= URLROOT ?>/agentcontroller/get_data/<?= $delivery['tracking_code'] ?>"
                                                class="text-white bg-blue-500 px-3 py-2 rounded hover:bg-blue-600 break-words text-center w-[80px]">
                                                Edit
                                            </a>
                                        <?php endif; ?>
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
    </main>
</div>

<script>
    function filterDeliveries(event, status) {
        event.preventDefault();
        const rows = document.querySelectorAll('#deliveryTableBody tr');
        const filterLinks = document.querySelectorAll('.filter-link');

        filterLinks.forEach(link => {
            link.classList.remove('active', 'bg-[#1F265B]', 'text-white');
            link.classList.add('bg-gray-100', 'text-gray-700');
        });

        event.currentTarget.classList.add('active', 'bg-[#1F265B]', 'text-white');
        event.currentTarget.classList.remove('bg-gray-100', 'text-gray-700');

        rows.forEach(row => {
            const rowStatus = row.getAttribute('data-status');
            row.style.display = (status === 'All' || rowStatus === status) ? '' : 'none';
        });
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