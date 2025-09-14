<?php
require_once APPROOT . '/views/inc/sidebar.php';
$totalAgents = count($data['allUserData']);

// Count total deliveries
$totalDeliveries = count($data['allDeliveryData']);

// Separate complete vs not complete
$completeDeliveries = 0;
$notCompleteDeliveries = 0;

foreach ($data['allDeliveryData'] as $delivery) {
    if ($delivery['delivery_status'] === 'complete') {
        $completeDeliveries++;
    } else {
        $notCompleteDeliveries++;
    }
}
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
</head>


<!-- Main Content -->
<main class="flex-1 p-6 space-y-6 md:ml-64">
    <!-- Top Nav -->
    <header class="bg-white p-4 rounded-lg shadow-md flex items-center justify-between">
        <h2 class="text-xl font-semibold text-gray-800">Dashboard</h2>

        <!-- Centered Search -->
        <div class="flex-1 flex justify-center px-4">
            <form method="POST" action="<?php echo URLROOT; ?>/admincontroller/search" class="relative w-full max-w-md">
                <input type="text" name="tracking_code" placeholder="Enter Customer WayBill Number"
                    class="w-full pl-10 pr-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500">
                <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
            </form>
        </div>

        <!-- User Info -->
        <div class="flex items-center space-x-2">
            <i class="fas fa-user-circle text-2xl text-gray-600"></i>
            <span class="hidden md:inline-block font-medium">
                <?= htmlspecialchars($_SESSION['user']['name']) ?>
            </span>
        </div>
    </header>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="bg-white p-6 rounded-lg shadow-md text-center">
            <div class="text-3xl font-bold text-indigo-800"><?= $totalDeliveries ?>
            </div>
            <div class="text-sm font-medium text-gray-600 mt-1">Total Deliveries</div>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-md text-center">
            <div class="text-3xl font-bold text-indigo-800"><?= $completeDeliveries ?></div>
            <div class="text-sm font-medium text-gray-600 mt-1">Completed Deliveries</div>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-md text-center">
            <div class="text-3xl font-bold text-indigo-800"><?= $notCompleteDeliveries ?></div>
            <div class="text-sm font-medium text-gray-600 mt-1">Pending Delivery</div>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-md text-center">
            <div class="text-3xl font-bold text-indigo-800"><?= $totalAgents ?></div>
            <div class="text-sm font-medium text-gray-600 mt-1">Total Agent</div>
        </div>
    </div>

    <!-- Recent Deliveries Table -->
    <div class="bg-white p-6 rounded-lg shadow-md max-h-96 overflow-y-auto">
        <h3 class="text-xl font-semibold mb-4 text-gray-800">Recent Deliveries Process</h3>
        <div class="overflow-x-auto">
            <table class="w-full text-left table-auto">
                <thead class="sticky top-0 z-10 bg-white">
                    <tr class="bg-[#1F265B] rounded-t-lg">
                        <th class="px-4 py-3 font-medium text-white text-sm">Tracking Code</th>
                        <th class="px-4 py-3 font-medium text-white text-sm">From</th>
                        <th class="px-4 py-3 font-medium text-white text-sm">To</th>
                        <th class="px-4 py-3 font-medium text-white text-sm">Date & Time</th>
                        <th class="px-4 py-3 font-medium text-white text-sm">Amount</th>
                        <th class="px-4 py-3 font-medium text-white text-sm">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($data['allDeliveryData'])): ?>
                    <?php foreach ($data['allDeliveryData'] as $user): ?>

                    <tr class="border-t border-gray-200">
                        <td class="px-4 py-3 text-sm text-gray-800"><?= htmlspecialchars($user['tracking_code']); ?>
                        </td>
                        <td class="px-4 py-3 text-sm text-gray-800"><?= htmlspecialchars($user['from_city_name']) ?>
                        </td>
                        <td class="px-4 py-3 text-sm text-gray-800"><?= htmlspecialchars($user['to_city_name']) ?>
                        </td>
                        <td class="px-4 py-3 text-sm text-gray-800"><?= htmlspecialchars($user['created_at']) ?>
                        </td>
                        <td class="px-4 py-3 text-sm text-gray-800"><?= htmlspecialchars($user['amount']) ?> MMK
                        </td>
                        <td class="px-4 py-3 text-sm text-gray-800">
                            <?= htmlspecialchars($user['delivery_status']) ?></td>
                    </tr>
                    <?php endforeach; ?>
                    <?php else: ?>
                    <tr>
                        <td colspan="7" class="px-5 py-4 text-center">No delivery data available.</td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Agent Table -->
    <div class="bg-white p-6 rounded-lg shadow-md max-h-96 overflow-y-auto">
        <h3 class="text-xl font-semibold mb-4 text-gray-800">Agent</h3>
        <div class="overflow-x-auto">
            <table class="w-full text-left table-auto">
                <thead class="sticky top-0 z-10 bg-white">
                    <tr class="bg-[#1F265B] rounded-t-lg">
                        <th class="px-4 py-3 font-medium text-white text-sm">Agent Code</th>
                        <th class="px-4 py-3 font-medium text-white text-sm">Agent Name</th>
                        <th class="px-4 py-3 font-medium text-white text-sm">City</th>
                        <th class="px-4 py-3 font-medium text-white text-sm">Address</th>
                        <th class="px-4 py-3 font-medium text-white text-sm">Created Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($data['allUserData'])): ?>
                    <?php foreach ($data['allUserData'] as $user): ?>

                    <tr class="border-t border-gray-200">
                        <td class="px-4 py-3 text-sm text-gray-800"><?= htmlspecialchars($user['access_code']) ?>
                        </td>
                        <td class="px-4 py-3 text-sm text-gray-800"><?= htmlspecialchars($user['name']) ?></td>
                        <td class="px-4 py-3 text-sm text-gray-800"><?= htmlspecialchars($user['city_name']) ?></td>
                        <td class="px-4 py-3 text-sm text-gray-800"><?= htmlspecialchars($user['address']) ?></td>
                        <td class="px-4 py-3 text-sm text-gray-800"><?= htmlspecialchars($user['created_at']) ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php else: ?>
                    <tr>
                        <td colspan="5" class="px-5 py-4 text-center">No user data available.</td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</main>
</body>

</html>