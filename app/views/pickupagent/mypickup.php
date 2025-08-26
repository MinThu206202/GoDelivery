<?php require_once APPROOT . '/views/inc/pickupagentsiderbar.php';
?>
<!-- Main Content -->
<div class="flex flex-1 flex-col">
    <!-- Header -->
    <header class="bg-white text-gray-800 shadow-sm py-4 px-6 md:px-8 lg:px-12 flex items-center justify-between">
        <h1 class="text-xl md:text-2xl font-bold">My Pickups</h1>
        <div class="flex-1 max-w-lg mx-auto">
            <div class="relative">
                <input type="text"
                    class="w-full pl-10 pr-4 py-2 rounded-full border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="Search...">
                <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
            </div>
        </div>
        <div class="flex items-center space-x-4">
            <div class="flex items-center space-x-2">
                <div
                    class="w-10 h-10 bg-gray-200 rounded-full flex items-center justify-center font-bold text-gray-700">
                    MM</div>
                <div>
                    <span class="text-sm font-medium text-gray-600">Mi Mi</span>
                    <p class="text-xs text-gray-500">Agent ID: YGN0001</p>
                </div>
            </div>
        </div>
    </header>

    <!-- Pickups Table -->
    <main class="flex-1 p-6 md:p-8 lg:p-12 overflow-y-auto">
        <div class="max-w-7xl mx-auto">
            <h2 class="text-xl md:text-2xl font-semibold text-gray-800 mb-4">Assigned Pickups</h2>
            <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50 sticky top-0">
                            <tr>
                                <th
                                    class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">
                                    ID</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">
                                    Recipient</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">
                                    Address</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">
                                    Due Time</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">
                                    Status</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">
                                    Action</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php foreach ($data['allpickupdata'] as $pick): ?>
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-blue-600 font-medium">
                                        <?= htmlspecialchars($pick['request_code']) ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        <?= htmlspecialchars($pick['sender_name']) ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <?= htmlspecialchars($pick['sender_address']) ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <?= htmlspecialchars($pick['created_at']) ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <?php
                                        // Map statuses to Tailwind CSS badge colors
                                        $statusColors = [
                                            'pending' => 'bg-yellow-300 text-yellow-900',       // waiting
                                            'accepted' => 'bg-blue-300 text-blue-900',         // assigned
                                            'collected' => 'bg-orange-300 text-orange-900',    // picked up
                                            'on_the_way' => 'bg-teal-300 text-teal-900',       // in transit
                                            'rejected' => 'bg-red-300 text-red-900',           // failed/rejected
                                            'awaiting_payment' => 'bg-amber-300 text-amber-900', // payment pending
                                            'payment_success' => 'bg-green-300 text-green-900'   // completed/delivered
                                        ];

                                        $badgeClass = $statusColors[$pick['status']] ?? 'bg-gray-100 text-gray-700';
                                        ?>
                                        <span
                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full <?= $badgeClass ?>">
                                            <?= htmlspecialchars($pick['status']) ?>
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium flex flex-row space-x-2">
                                        <!-- View Button -->
                                        <a href="<?= URLROOT; ?>/pickupagentcontroller/pickupdetail?request_code=<?= htmlspecialchars($pick['request_code']); ?>"
                                            class="px-3 py-1 bg-blue-500 text-white text-xs font-semibold rounded hover:bg-blue-600 w-auto">
                                            View
                                        </a>

                                        <!-- Pending-only Button -->
                                        <?php if ($pick['status'] === 'accepted'): ?>
                                            <a href="<?= URLROOT; ?>/pickupagentcontroller/startpickup?id=<?= htmlspecialchars($pick['id']); ?>"
                                                class="px-3 py-1 bg-green-500 text-white text-xs font-semibold rounded hover:bg-green-600 w-auto">
                                                Pickup
                                            </a>
                                        <?php endif; ?>
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
</body>

</html>