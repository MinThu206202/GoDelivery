<?php require_once APPROOT . '/views/inc/pickupagentsiderbar.php'; ?>

<!-- Main Content Wrapper: Contains the header and the dashboard content -->
<div class="flex flex-1 flex-col">
    <!-- Header -->
    <header class="bg-white text-gray-800 shadow-sm py-4 px-6 md:px-8 lg:px-12 flex items-center justify-between">
        <h1 class="text-xl md:text-2xl font-bold">Pickup Agent Dashboard</h1>
        <div class="flex-1 max-w-lg mx-auto">
        </div>
        <div class="flex items-center space-x-2">
            <!-- Profile Image or Initials -->
            <div
                class="w-10 h-10 rounded-full overflow-hidden bg-gray-200 flex items-center justify-center text-sm font-bold text-gray-700">
                <?php if (!empty($user['profile_image'])): ?>
                <img src="<?= URLROOT . '/' . htmlspecialchars($user['profile_image']) ?>" alt="Profile Image"
                    class="w-full h-full object-cover">
                <?php else: ?>
                <?= strtoupper(substr($user['name'], 0, 2)) ?>
                <?php endif; ?>
            </div>

            <!-- User Info -->
            <div>
                <span class="text-sm font-medium text-gray-600"><?= htmlspecialchars($user['name']) ?></span>
                <p class="text-xs text-gray-500"><?= htmlspecialchars($user['access_code']) ?></p>
            </div>
        </div>
    </header>

    <!-- Dashboard Content Area -->
    <main class="flex-1 p-6 md:p-8 lg:p-12 overflow-y-auto">
        <div class="max-w-7xl mx-auto">
            <!-- Dashboard Overview Section (Landing Page) -->
            <div class="mb-8">
                <h2 class="text-xl md:text-2xl font-semibold text-gray-800 mb-4">Dashboard Overview</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                    <div class="bg-white rounded-lg p-4 shadow-lg flex flex-col items-start">
                        <i class="fas fa-truck-loading text-blue-500 text-2xl mb-2"></i>
                        <span class="text-3xl font-bold text-gray-900">12</span>
                        <p class="text-sm text-gray-600">Assigned Pickups</p>
                    </div>
                    <div class="bg-white rounded-lg p-4 shadow-lg flex flex-col items-start">
                        <i class="fas fa-check-circle text-green-500 text-2xl mb-2"></i>
                        <span class="text-3xl font-bold text-gray-900">5</span>
                        <p class="text-sm text-gray-600">Completed Today</p>
                    </div>
                    <div class="bg-white rounded-lg p-4 shadow-lg flex flex-col items-start">
                        <i class="fas fa-clock text-yellow-500 text-2xl mb-2"></i>
                        <span class="text-3xl font-bold text-gray-900">1</span>
                        <p class="text-sm text-gray-600">Overdue</p>
                    </div>
                </div>

                <!-- Quick View of Assigned Pickups -->
                <div class="mt-8">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Upcoming Pickups</h3>

                    <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                        <div class="max-h-96 overflow-y-auto">
                            <table class="min-w-full table-fixed divide-y divide-gray-200">
                                <thead class="bg-gray-50 sticky top-0 z-10">
                                    <tr>
                                        <th
                                            class="w-1/6 px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">
                                            Pickup ID</th>
                                        <th
                                            class="w-1/6 px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">
                                            Recipient</th>
                                        <th
                                            class="w-2/6 px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">
                                            Address</th>
                                        <th
                                            class="w-1/6 px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">
                                            Status</th>
                                        <th
                                            class="w-1/6 px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">
                                            Due Time</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <?php if (!empty($data['allpickupdata'])): ?>
                                    <?php foreach ($data['allpickupdata'] as $pickup): ?>
                                    <tr>
                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-sm font-medium text-blue-600 hover:underline cursor-pointer">
                                            <?= htmlspecialchars($pickup['request_code']) ?>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            <?= htmlspecialchars($pickup['sender_name']) ?>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            <?= htmlspecialchars($pickup['sender_address']) ?>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <?php
                                                    $status = strtolower($pickup['status'] ?? 'default');
                                                    $statusClasses = [
                                                        'pending' => 'bg-yellow-500',
                                                        'accepted' => 'bg-indigo-500',
                                                        'collected' => 'bg-orange-600',
                                                        'voucher_created' => 'bg-purple-600',
                                                        'delivered' => 'bg-green-500',
                                                        'arrived_office' => 'bg-teal-500',
                                                        'rejected' => 'bg-red-500',
                                                        'agent_checked' => 'bg-pink-500',
                                                        'awaiting_payment' => 'bg-orange-500',
                                                        'payment_success' => 'bg-emerald-600',
                                                        'awaiting_cash' => 'bg-amber-500',
                                                        'cash_collected' => 'bg-lime-600',
                                                        'pickup_verification_pending' => 'bg-orange-500',
                                                        'pickup_verified' => 'bg-blue-500',
                                                        'on_the_way' => 'bg-sky-500',
                                                        'waiting_for_receipt' => 'bg-pink-500',
                                                        'receipt_submitted' => 'bg-cyan-500',
                                                        'payment_pending' => 'bg-amber-600',
                                                        'payment_reject' => 'bg-red-600',
                                                        'arrived_at_user' => 'bg-green-600',
                                                        'pickup_failed' => 'bg-red-600',
                                                        'cancelled' => 'bg-gray-600',
                                                        'default' => 'bg-gray-400'
                                                    ];
                                                    $status_class = $statusClasses[$status] ?? $statusClasses['default'];
                                                    ?>
                                            <span
                                                class="px-3 py-1 inline-flex text-sm font-bold rounded-full shadow-md text-white capitalize <?= $status_class ?>"
                                                title="<?= htmlspecialchars(str_replace('_', ' ', $status)) ?>">
                                                <?= htmlspecialchars(str_replace('_', ' ', $status)) ?>
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            <?= htmlspecialchars($pickup['created_at']) ?>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                    <?php else: ?>
                                    <tr>
                                        <td colspan="5" class="text-center text-gray-500 py-4">No pickups found</td>
                                    </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </main>
</div>
</body>

</html>