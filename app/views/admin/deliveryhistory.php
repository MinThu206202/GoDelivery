    <?php
    require_once APPROOT . '/views/inc/sidebar.php';
    ?>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
@import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');

body {
    font-family: 'Inter', sans-serif;
    background-color: #f1f5f9;
}
    </style>


    <!-- Main Content -->
    <main class="flex-1 p-6 space-y-6 md:ml-64">
        <!-- Top Nav -->
        <header class="bg-white p-4 rounded-lg shadow-md flex items-center justify-between">
            <div class="flex items-center space-x-2">
                <i class="fas fa-user-tie text-2xl text-gray-600"></i>
                <h2 class="text-xl font-semibold text-gray-800">Delivery History</h2>
            </div>
            <div class="flex items-center space-x-2">
                <i class="fas fa-user-circle text-2xl text-gray-600"></i>
                <span
                    class="hidden md:inline-block font-medium"><?= htmlspecialchars($_SESSION['user']['name']) ?></span>
            </div>
        </header>

        <!-- Delivery Table -->
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h3 class="text-xl font-semibold mb-4 text-gray-800">All Deliveries</h3>

            <!-- Scrollable Table Container -->
            <div class="overflow-y-auto h-[600px] border rounded-lg">
                <table class="table-fixed w-full text-left border-collapse">
                    <thead class="sticky top-0 z-10 bg-gray-100">
                        <tr>
                            <th class="w-2/12 px-4 py-3 font-medium text-gray-600 text-sm">Tracking ID</th>
                            <th class="w-3/12 px-4 py-3 font-medium text-gray-600 text-sm">Customer Info</th>
                            <th class="w-2/12 px-4 py-3 font-medium text-gray-600 text-sm">Agent</th>
                            <th class="w-2/12 px-4 py-3 font-medium text-gray-600 text-sm">Status</th>
                            <th class="w-2/12 px-4 py-3 font-medium text-gray-600 text-sm">Date</th>
                            <th class="w-1/12 px-4 py-3 font-medium text-gray-600 text-sm">Paid</th>
                            <th class="w-1/12 px-4 py-3 font-medium text-gray-600 text-sm">View</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <?php if (!empty($data['alldeliverydata'])): ?>
                        <?php foreach ($data['alldeliverydata'] as $delivery): ?>
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3 text-sm text-gray-800">
                                <?= htmlspecialchars($delivery['tracking_code']) ?>
                            </td>
                            <td class="px-4 py-3 text-sm text-gray-800 truncate">
                                <?= htmlspecialchars($delivery['sender_customer_name']) ?>
                            </td>
                            <td class="px-4 py-3 text-sm text-gray-800">
                                <?= htmlspecialchars($delivery['sender_agent_name']) ?>
                            </td>
                            <td class="px-4 py-3 text-sm">
                                <?php
                                        $status_class = match ($delivery['delivery_status']) {
                                            'Delivered' => 'bg-green-100 text-green-700',
                                            'In Transit' => 'bg-yellow-100 text-yellow-700',
                                            'Pending' => 'bg-orange-100 text-orange-700',
                                            'Cancelled' => 'bg-red-100 text-red-700',
                                            default => 'bg-gray-100 text-gray-700'
                                        };
                                        ?>
                                <span class="px-2 py-1 rounded-full text-xs font-semibold <?= $status_class ?>">
                                    <?= htmlspecialchars($delivery['delivery_status']) ?>
                                </span>
                            </td>
                            <td class="px-4 py-3 text-sm text-gray-800">
                                <?= htmlspecialchars($delivery['created_at']) ?>
                            </td>
                            <td class="px-4 py-3 text-sm text-gray-800">
                                <?= htmlspecialchars($delivery['payment_status']) ?>
                            </td>
                            <td class="px-4 py-3 text-sm">
                                <a href="<?= URLROOT; ?>/admincontroller/delivery_detail?tracking_code=<?= urlencode($delivery['tracking_code']) ?>"
                                    class="bg-green-500 text-white px-3 py-1 rounded-lg text-xs font-bold hover:bg-green-600 transition">
                                    View
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        <?php else: ?>
                        <tr>
                            <td colspan="7" class="px-5 py-4 text-center text-sm text-gray-500">
                                No delivery data available.
                            </td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

    </main>
    </body>

    </html>