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

.status-pending {
    background-color: #fef3c7;
    color: #d97706;
}
</style>

<!-- Main Content -->
<main class="flex-1 p-6 space-y-6 md:ml-64">
    <!-- Top Nav -->
    <header class="bg-white p-4 rounded-lg shadow-md flex items-center justify-between">
        <div class="flex items-center space-x-2">
            <i class="fas fa-map-marker-alt text-2xl text-gray-600"></i>
            <h2 class="text-xl font-semibold text-gray-800">Available Places</h2>
        </div>
        <div class="flex items-center space-x-2">
            <i class="fas fa-user-circle text-2xl text-gray-600"></i>
            <span class="hidden md:inline-block font-medium"><?= htmlspecialchars($data['user']['name']) ?></span>
        </div>
    </header>

    <div class="bg-white p-6 rounded-lg shadow-md">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-xl font-semibold text-gray-800">Place List</h3>
            <button onclick="window.location='<?= URLROOT; ?>/available_place/addplace';"
                class="bg-indigo-600 text-white font-semibold py-2 px-4 rounded-lg hover:bg-indigo-700 transition-colors duration-200">
                + Add Place
            </button>
        </div>

        <div class="overflow-x-auto" style="max-height: 500px;">
            <div class="overflow-y-auto" style="max-height: 500px;">
                <table class="w-full text-left table-auto border-collapse">
                    <thead class="sticky top-0 z-10 bg-custom-blue">
                        <tr>
                            <th class="px-4 py-3 font-medium text-white text-sm">REGION</th>
                            <th class="px-4 py-3 font-medium text-white text-sm">CITY</th>
                            <th class="px-4 py-3 font-medium text-white text-sm">TOWNSHIP</th>
                            <th class="px-4 py-3 font-medium text-white text-sm">AGENT NAME</th>
                            <th class="px-4 py-3 font-medium text-white text-sm">STATUS</th>
                            <th class="px-4 py-3 font-medium text-white text-sm">ACTION</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($data['availabel_place'])): ?>
                        <?php foreach ($data['availabel_place'] as $place): ?>
                        <tr class="border-t border-gray-200">
                            <td class="px-4 py-3 text-sm text-gray-800">
                                <?= htmlspecialchars($place['region_name']) ?></td>
                            <td class="px-4 py-3 text-sm text-gray-800"><?= htmlspecialchars($place['city_name']) ?>
                            </td>
                            <td class="px-4 py-3 text-sm text-gray-800">
                                <?= htmlspecialchars($place['township_name']) ?></td>
                            <td class="px-4 py-3 text-sm text-gray-800">
                                <?php if (!empty($place['agent_name'])): ?>
                                <?= htmlspecialchars($place['agent_name']) ?>
                                <?php else: ?>
                                <span
                                    class="px-2 py-1 rounded-full text-xs font-semibold bg-yellow-200 text-yellow-800">
                                    Not Yet Assigned
                                </span>
                                <?php endif; ?>
                            </td>
                            <td class="px-4 py-3 text-sm text-gray-800">
                                <?php
                                        $status_class = '';
                                        switch (strtolower($place['status_location_name'] ?? 'pending')) {
                                            case 'active':
                                                $status_class = 'bg-green-200 text-green-800';
                                                break;
                                            case 'inactive':
                                                $status_class = 'bg-red-200 text-red-800';
                                                break;
                                            case 'pending':
                                            default:
                                                $status_class = 'bg-yellow-200 text-yellow-800';
                                                break;
                                        }
                                        ?>
                                <span class="px-2 py-1 rounded-full text-xs font-semibold <?= $status_class ?>">
                                    <?= htmlspecialchars($place['status_location_name'] ?? 'Pending') ?>
                                </span>
                            </td>
                            <td class="px-4 py-3 text-sm text-gray-800">
                                <button
                                    onclick="window.location='<?= URLROOT; ?>/available_place/place_detail?id=<?= htmlspecialchars($place['id'] ?? '') ?>';"
                                    class="bg-indigo-600 text-white px-3 py-1 rounded-lg hover:bg-indigo-700 transition-colors duration-200">
                                    View
                                </button>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        <?php else: ?>
                        <tr>
                            <td colspan="6" class="px-5 py-4 text-center">No place data available.</td>
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