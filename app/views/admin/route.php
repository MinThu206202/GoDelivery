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

.bg-custom-blue {
    background-color: #1F265B;
}

.status-active {
    background-color: #d1fae5;
    color: #059669;
}
</style>


<!-- Main Content -->
<main class="flex-1 p-6 space-y-6 md:ml-64">
    <!-- Top Nav -->
    <header class="bg-white p-4 rounded-lg shadow-md flex items-center justify-between">
        <div class="flex items-center space-x-2">
            <i class="fas fa-route text-2xl text-gray-600"></i>
            <h2 class="text-xl font-semibold text-gray-800">Route</h2>
        </div>
        <div class="flex items-center space-x-2">
            <i class="fas fa-user-circle text-2xl text-gray-600"></i>
            <span class="hidden md:inline-block font-medium"> <?= htmlspecialchars($_SESSION['user']['name']) ?>
            </span>
        </div>
    </header>

    <!-- Route List Table -->
    <div class="bg-white p-6 rounded-lg shadow-md">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-xl font-semibold text-gray-800">Route List</h3>
            <button onclick="window.location='<?= URLROOT; ?>/routepage/addroute';"
                class="bg-indigo-600 text-white font-semibold py-2 px-4 rounded-lg hover:bg-indigo-700 transition-colors duration-200">
                + Add Route
            </button>
        </div>

        <!-- Scrollable table container -->
        <div class="overflow-x-auto border border-gray-200 rounded-lg max-h-[500px] overflow-y-auto">
            <table class="table-fixed w-full text-left border-collapse">
                <thead class="sticky top-0 z-10 bg-custom-blue">
                    <tr>
                        <th class="px-4 py-3 font-medium text-white text-sm">FROM</th>
                        <th class="px-4 py-3 font-medium text-white text-sm">TO</th>
                        <th class="px-4 py-3 font-medium text-white text-sm">DISTANCE (KM)</th>
                        <th class="px-4 py-3 font-medium text-white text-sm">PRICE</th>
                        <th class="px-4 py-3 font-medium text-white text-sm">DURATION TIME</th>
                        <th class="px-4 py-3 font-medium text-white text-sm">STATUS</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <?php if (!empty($data['allroutedata'])): ?>
                    <?php foreach ($data['allroutedata'] as $route): ?>
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3 text-sm text-gray-800"><?= htmlspecialchars($route['from_township']) ?>
                        </td>
                        <td class="px-4 py-3 text-sm text-gray-800"><?= htmlspecialchars($route['to_township']) ?>
                        </td>
                        <td class="px-4 py-3 text-sm text-gray-800"><?= htmlspecialchars($route['distance']) ?> KM
                        </td>
                        <td class="px-4 py-3 text-sm text-gray-800"><?= htmlspecialchars($route['price']) ?> MMK
                        </td>
                        <td class="px-4 py-3 text-sm text-gray-800"><?= htmlspecialchars($route['time']) ?> HR</td>
                        <td class="px-4 py-3 text-sm text-gray-800">
                            <?php if ($route['status'] === 'active'): ?>
                            <span class="px-2 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-800">
                                <?= htmlspecialchars($route['status']) ?>
                            </span>
                            <?php else: ?>
                            <span class="px-2 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-800">
                                <?= htmlspecialchars($route['status']) ?>
                            </span>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php else: ?>
                    <tr>
                        <td colspan="6" class="px-5 py-4 text-center text-sm text-gray-500">No route data available.
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