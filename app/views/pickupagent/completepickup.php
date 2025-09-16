<?php require_once APPROOT . '/views/inc/pickupagentsiderbar.php'; ?>
<!-- Main Content -->
<div class="flex flex-1 flex-col">
    <!-- Header -->
    <header class="bg-white text-gray-800 shadow-sm py-4 px-6 md:px-8 lg:px-12 flex items-center justify-between">
        <h1 class="text-xl md:text-2xl font-bold">My Pickups</h1>
        <div class="flex-1 max-w-lg mx-auto">
            <div class="relative">
            </div>
        </div>
        <div class="flex items-center space-x-2">
            <div
                class="w-10 h-10 rounded-full overflow-hidden bg-gray-200 flex items-center justify-center text-sm font-bold text-gray-700">
                <?php if (!empty($user['profile_image'])): ?>
                <img src="<?= URLROOT . '/' . htmlspecialchars($user['profile_image']) ?>" alt="Profile Image"
                    class="w-full h-full object-cover">
                <?php else: ?>
                <?= strtoupper(substr($user['name'], 0, 2)) ?>
                <?php endif; ?>
            </div>
            <div>
                <span class="text-sm font-medium text-gray-600"><?= htmlspecialchars($user['name']) ?></span>
                <p class="text-xs text-gray-500"><?= htmlspecialchars($user['access_code']) ?></p>
            </div>
        </div>
    </header>

    <!-- Pickups Table -->
    <main class="flex-1 p-6 md:p-8 lg:p-12">
        <div class="max-w-7xl mx-auto">
            <h2 class="text-xl md:text-2xl font-semibold text-gray-800 mb-4">Assigned Pickups</h2>

            <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                <!-- Scrollable table container -->
                <div class="overflow-x-auto max-h-[500px] overflow-y-auto">
                    <table class="min-w-full table-fixed divide-y divide-gray-200">
                        <thead class="bg-gray-50 sticky top-0 z-10">
                            <tr>
                                <th
                                    class="w-1/12 px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">
                                    ID</th>
                                <th
                                    class="w-2/12 px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">
                                    Recipient</th>
                                <th
                                    class="w-4/12 px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">
                                    Address</th>
                                <th
                                    class="w-2/12 px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">
                                    Due Time</th>
                                <th
                                    class="w-2/12 px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">
                                    Status</th>
                                <th
                                    class="w-1/12 px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">
                                    Action</th>
                            </tr>
                        </thead>

                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php if (!empty($data['alldata'])): ?>
                            <?php foreach ($data['alldata'] as $pick): ?>
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-blue-600 font-medium">
                                    <?= htmlspecialchars($pick['tracking_code']) ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    <?= htmlspecialchars($pick['sender_customer_name']) ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <?= htmlspecialchars($pick['sender_customer_address']) ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <?= htmlspecialchars($pick['created_at']) ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <?php
                                            $status = strtolower($pick['delivery_status'] ?? 'default');
                                            $statusClasses = [
                                                'pending' => 'bg-yellow-500',
                                                'accepted' => 'bg-indigo-500',
                                                'collected' => 'bg-orange-600',
                                                'voucher_created' => 'bg-purple-600',
                                                'delivered' => 'bg-green-500',
                                                'arrived_office' => 'bg-teal-500',
                                                'rejected' => 'bg-red-500',
                                                'agent_checked' => 'bg-pink-500',
                                                'arrived_at_office' => 'bg-blue-400',
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
                                                'cancelled' => 'bg-gray-600',
                                                'arrived_at_user' => 'bg-green-600',
                                                'pickup_failed' => 'bg-red-600',
                                                'default' => 'bg-gray-400'
                                            ];
                                            $status_class = $statusClasses[$status] ?? $statusClasses['default'];
                                            ?>
                                    <span
                                        class="px-3 py-1 inline-flex text-sm font-bold rounded-full shadow-md text-white capitalize <?= $status_class ?> whitespace-nowrap leading-tight"
                                        title="<?= htmlspecialchars(str_replace('_', ' ', $status)) ?>">
                                        <?= htmlspecialchars(str_replace('_', ' ', $status)) ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium flex space-x-2">
                                    <a href="<?= URLROOT; ?>/pickupagentcontroller/outofdeliverydetail?request_code=<?= htmlspecialchars($pick['tracking_code']); ?>"
                                        class="px-3 py-1 bg-blue-500 text-white text-xs font-semibold rounded hover:bg-blue-600 w-auto">
                                        View
                                    </a>
                                    <?php if ($pick['delivery_status_id'] == 8): ?>
                                    <a href="<?= URLROOT; ?>/pickupagentcontroller/deliverparcel?id=<?= htmlspecialchars($pick['id']); ?>"
                                        class="px-3 py-1 bg-green-500 text-white text-xs font-semibold rounded hover:bg-green-600 w-auto">
                                        Deliver Parcel
                                    </a>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                            <?php else: ?>
                            <tr>
                                <td colspan="6" class="text-center text-gray-500 py-6">
                                    No pickups found.
                                </td>
                            </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div> <!-- End scrollable table container -->
            </div>
        </div>
    </main>
</div>