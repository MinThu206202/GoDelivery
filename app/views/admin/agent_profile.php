<?php
$currentRoute = $_SERVER['REQUEST_URI'];
$agent = $data['agent'];
require_once APPROOT . '/views/inc/sidebar.php';
?>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<script src="https://cdn.tailwindcss.com"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<style>
body {
    font-family: 'Inter', sans-serif;
    background-color: #f1f5f9;
}

.sidebar a {
    position: relative;
    transition: all 0.3s ease;
}

.sidebar a.active-sidebar-link {
    background-color: #fff;
    color: #1F265B;
    font-weight: 600;
}

.sidebar a.active-sidebar-link::before,
.sidebar a:not(.active-sidebar-link):hover::before {
    content: '';
    position: absolute;
    left: 0;
    top: 0;
    height: 100%;
    width: 8px;
    background-color: #FBBF24;
    border-top-left-radius: 4px;
    border-bottom-left-radius: 4px;
}

.sidebar a:not(.active-sidebar-link):hover {
    background-color: #fef3c7;
    color: #1F265B;
}
</style>


<!-- Main Content -->
<div class="flex-1 p-8 md:ml-64">
    <!-- Topbar -->
    <header class="flex justify-between items-center pb-8 border-b border-gray-300">
        <div class="flex items-center space-x-4 text-gray-800">
            <h1 class="text-3xl font-bold">Agent View</h1>
        </div>
        <div class="flex items-center space-x-4">
            <i class="fas fa-user-circle text-gray-500 text-3xl"></i>
            <div class="flex flex-col">
                <span class="text-gray-800 font-semibold"><?= htmlspecialchars($_SESSION['user']['name']) ?></span>
            </div>
        </div>
    </header>

    <!-- Main Panel -->
    <main class="mt-8">
        <!-- Agent Info and Actions -->
        <div class="bg-white p-8 rounded-3xl shadow-xl border border-gray-200">
            <!-- Agent Details -->
            <!-- Agent Details -->
            <div class="p-6 bg-[#1F265B] text-white rounded-2xl shadow-lg mb-8">
                <div class="flex items-center justify-between">
                    <!-- Left side: Badge + Name + Status -->
                    <div class="flex items-center space-x-4">
                        <span
                            class="bg-[#FBBF24] text-[#1F265B] px-4 py-2 text-sm font-semibold rounded-full">Agent</span>

                        <p class="font-bold text-xl"><?= htmlspecialchars($agent['name']) ?></p>

                        <?php
                        $statusClass = '';
                        if ($agent['status_name'] === 'Active') {
                            $statusClass = 'bg-green-100 text-green-800';
                        } elseif ($agent['status_name'] === 'Pending') {
                            $statusClass = 'bg-yellow-100 text-yellow-800';
                        } elseif ($agent['status_name'] === 'Inactive') {
                            $statusClass = 'bg-red-100 text-red-800';
                        }
                        ?>

                        <span class="px-3 py-1 text-xs font-semibold rounded-full <?= $statusClass ?>">
                            <?= htmlspecialchars($agent['status_name']) ?>
                        </span>

                    </div>

                    <!-- Right side: Deactivate button -->
                    <?php
                    // Decide button label, color based on status
                    if ($agent['status_name'] === 'Active') {
                        $btnText = 'Deactivate Agent';
                        $btnClass = 'bg-red-600 hover:bg-red-700';
                    } else {
                        $btnText = 'Activate Agent';
                        $btnClass = 'bg-green-600 hover:bg-green-700';
                    }
                    ?>

                    <a href="<?= URLROOT ?>/admincontroller/changestatus?id=<?= $agent['id'] ?>"
                        class="px-6 py-2 <?= $btnClass ?> text-white font-semibold rounded-lg shadow transition-colors duration-200">
                        <?= $btnText ?>
                    </a>

                </div>

                <!-- Agent Info Grid -->
                <div class="mt-6 space-y-2 grid grid-cols-1 md:grid-cols-2 gap-4">
                    <p class="text-sm">Name: <?= htmlspecialchars($agent['name']) ?></p>
                    <p class="text-sm">Email: <?= htmlspecialchars($agent['email']) ?></p>
                    <p class="text-sm">Password: **********</p>
                    <p class="text-sm">Phone: <?= htmlspecialchars($agent['phone']) ?></p>
                    <p class="text-sm">Code: <?= htmlspecialchars($agent['access_code']) ?></p>
                    <p class="text-sm">Address: <?= htmlspecialchars($agent['region_name']) ?></p>
                </div>
            </div>

            <!-- Agent Stats -->
            <div class="mt-8 text-center">
                <h2 class="text-xl font-semibold mb-4 text-gray-800">Agent Statistics</h2>
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <!-- Assigned Deliveries -->
                    <div
                        class="p-6 bg-white rounded-2xl shadow-md border border-gray-200 flex flex-col items-center justify-center space-y-2 transform transition-transform duration-200 hover:scale-105">
                        <i class="fas fa-list-ul text-3xl text-blue-500"></i>
                        <p class="text-gray-600 text-sm">Assigned</p>
                        <p class="text-3xl font-bold text-gray-800">10</p>
                    </div>
                    <!-- Pending Deliveries -->
                    <div
                        class="p-6 bg-white rounded-2xl shadow-md border border-gray-200 flex flex-col items-center justify-center space-y-2 transform transition-transform duration-200 hover:scale-105">
                        <i class="fas fa-clock text-3xl text-yellow-500"></i>
                        <p class="text-gray-600 text-sm">Pending</p>
                        <p class="text-3xl font-bold text-gray-800">10</p>
                    </div>
                    <!-- Complete Deliveries -->
                    <div
                        class="p-6 bg-white rounded-2xl shadow-md border border-gray-200 flex flex-col items-center justify-center space-y-2 transform transition-transform duration-200 hover:scale-105">
                        <i class="fas fa-check-circle text-3xl text-green-500"></i>
                        <p class="text-gray-600 text-sm">Completed</p>
                        <p class="text-3xl font-bold text-gray-800">10</p>
                    </div>
                </div>

                <!-- Assigned Deliveries Table (moved here) -->
                <div class="mt-8">
                    <h2 class="text-2xl font-semibold mb-6 text-gray-800">Assigned Deliveries</h2>
                    <div class="overflow-x-auto bg-white rounded-3xl shadow-xl border border-gray-200">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col"
                                        class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        DELIVERY ID</th>
                                    <th scope="col"
                                        class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        CUSTOMER</th>
                                    <th scope="col"
                                        class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        STATUS</th>
                                    <th scope="col"
                                        class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        DATE</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <?php if (!empty($data['delivery'])): ?>
                                <?php foreach ($data['delivery'] as $delivery): ?>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        <?= htmlspecialchars($delivery['tracking_code']) ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <?= htmlspecialchars($delivery['sender_customer_name']) ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <span
                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                <?= $delivery['delivery_status'] === 'Delivered' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' ?>">
                                            <?= htmlspecialchars($delivery['delivery_status']) ?>
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <?= htmlspecialchars($delivery['created_at']) ?></td>
                                </tr>
                                <?php endforeach; ?>
                                <?php else: ?>
                                <tr>
                                    <td colspan="4" class="text-center py-4 text-gray-500">No deliveries found.</td>
                                </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

    </main>
</div>
</body>

</html>