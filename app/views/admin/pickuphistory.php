<?php require_once APPROOT . '/views/inc/sidebar.php'; ?>
<script src="https://cdn.tailwindcss.com"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<style>
@import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');

body {
    font-family: 'Inter', sans-serif;
    background-color: #f1f5f9;
}

.bg-custom-blue {
    background-color: #1F265B;
}

.text-custom-blue {
    color: #1F265B;
}
</style>

<!-- Main Content -->
<main class="flex-1 p-6 space-y-6 md:ml-64">
    <!-- Top Nav -->
    <header class="bg-white p-4 rounded-lg shadow-md flex items-center justify-between flex-wrap">
        <h2 class="text-xl font-semibold text-gray-800 hidden md:block">Pickup History</h2>
        <div class="ml-auto flex items-center space-x-2 mt-4 md:mt-0">
            <i class="fas fa-user-circle text-2xl text-gray-600"></i>
            <span class="font-medium">Min Thu</span>
        </div>
    </header>

    <!-- All Pickups Table -->
    <div class="bg-white p-6 rounded-lg shadow-md">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-xl font-semibold text-gray-800">All Pickups</h3>
        </div>

        <div class="overflow-x-auto" style="max-height: 500px;">
            <div class="overflow-y-auto" style="max-height: 500px;">
                <table class="w-full text-left table-auto border-collapse">
                    <thead class="sticky top-0 z-10 bg-custom-blue">
                        <tr>
                            <th class="px-4 py-3 font-medium text-white text-sm">Request ID</th>
                            <th class="px-4 py-3 font-medium text-white text-sm">Customer Info</th>
                            <th class="px-4 py-3 font-medium text-white text-sm">Agent</th>
                            <th class="px-4 py-3 font-medium text-white text-sm">Pickup Status</th>
                            <th class="px-4 py-3 font-medium text-white text-sm">Date</th>
                            <th class="px-4 py-3 font-medium text-white text-sm">Pickup Agent</th>
                            <th class="px-4 py-3 font-medium text-white text-sm">View</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($data['pickups'])): ?>
                        <?php foreach ($data['pickups'] as $pickup): ?>
                        <?php
                                // Define status to color mapping
                                $status_colors = [
                                    'pending' => 'bg-yellow-500 text-white',
                                    'accepted' => 'bg-indigo-500 text-white',
                                    'collected' => 'bg-orange-600 text-white',
                                    'voucher_created' => 'bg-purple-600 text-white',
                                    'delivered' => 'bg-green-500 text-white',
                                    'arrived_office' => 'bg-teal-500 text-white',
                                    'rejected' => 'bg-red-500 text-white',
                                    'agent_checked' => 'bg-pink-500 text-white',
                                    'awaiting_payment' => 'bg-orange-500 text-white',
                                    'payment_success' => 'bg-emerald-600 text-white',
                                    'awaiting_cash' => 'bg-amber-500 text-white',
                                    'cash_collected' => 'bg-lime-600 text-white',
                                    'pickup_verification_pending' => 'bg-orange-500 text-white',
                                    'pickup_verified' => 'bg-blue-500 text-white',
                                    'on_the_way' => 'bg-sky-500 text-white',
                                    'waiting_for_receipt' => 'bg-pink-500 text-white',
                                    'receipt_submitted' => 'bg-cyan-500 text-white',
                                    'payment_pending' => 'bg-amber-600 text-white',
                                    'payment_reject' => 'bg-red-600 text-white',
                                    'cancelled' => 'bg-gray-600 text-white',
                                    'arrived_at_user' => 'bg-green-600 text-white',
                                    'pickup_failed' => 'bg-red-600 text-white',
                                    'default' => 'bg-gray-400 text-white',
                                ];

                                $status_key = strtolower($pickup['status'] ?? 'default');
                                $status_class = $status_colors[$status_key] ?? $status_colors['default'];
                                ?>
                        <tr class="border-t border-gray-200 hover:bg-gray-50 transition-colors">
                            <td class="px-4 py-3 text-sm text-gray-800"><?= htmlspecialchars($pickup['request_code']) ?>
                            </td>
                            <td class="px-4 py-3 text-sm text-gray-800 truncate">
                                <?= htmlspecialchars($pickup['sender_name']) ?></td>
                            <td class="px-4 py-3 text-sm text-gray-800"><?= htmlspecialchars($pickup['agent_name']) ?>
                            </td>
                            <td class="px-4 py-3 text-sm">
                                <span class="px-2 py-1 rounded-full text-xs font-semibold <?= $status_class ?>">
                                    <?= htmlspecialchars($pickup['status'] ?? 'Unknown') ?>
                                </span>
                            </td>
                            <td class="px-4 py-3 text-sm text-gray-800"><?= htmlspecialchars($pickup['created_at']) ?>
                            </td>
                            <td class="px-4 py-3 text-sm text-gray-800">
                                <?= htmlspecialchars($pickup['pickup_agent_name'] ?? 'N/A') ?></td>
                            <td class="px-4 py-3 text-sm text-gray-800">
                                <button
                                    onclick="window.location='<?= URLROOT; ?>/pickup/view?id=<?= htmlspecialchars($pickup['id'] ?? '') ?>';"
                                    class="bg-green-500 text-white px-3 py-1 rounded-lg hover:bg-green-600 transition-colors duration-200">
                                    View
                                </button>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        <?php else: ?>
                        <tr>
                            <td colspan="7" class="px-5 py-4 text-center">No pickups data available.</td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>
</body>

</html>