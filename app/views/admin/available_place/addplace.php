<?php
session_start();
require_once APPROOT . '/views/inc/sidebar.php';

$name = isset($_SESSION['user']) ? $_SESSION['user'] : ['name' => 'Admin', 'id' => 0];

// Dummy data for regions if not provided by backend
if (!isset($data['regions'])) {
    $data['regions'] = [
        ['id' => 1, 'name' => 'Yangon'],
        ['id' => 2, 'name' => 'Mandalay'],
    ];
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

.bg-custom-blue {
    background-color: #1F265B;
}
</style>


<!-- Main Content -->
<main class="flex-1 p-6 space-y-6 md:ml-64">
    <!-- Top Nav -->
    <header class="bg-white p-4 rounded-lg shadow-md flex items-center justify-between">
        <div class="flex items-center space-x-2">
            <i class="fas fa-map-marker-alt text-2xl text-gray-600"></i>
            <h2 class="text-xl font-semibold text-gray-800">Create New Places</h2>
        </div>
        <div class="flex items-center space-x-2">
            <i class="fas fa-user-circle text-2xl text-gray-600"></i>
            <span class="hidden md:inline-block font-medium"><?= htmlspecialchars($name['name']) ?></span>
        </div>
    </header>

    <!-- Form Section -->
    <div class="bg-white p-6 rounded-lg shadow-md max-w-lg mx-auto">
        <h3 class="text-xl font-semibold text-gray-800 mb-6">Add Place</h3>
        <form id="placeForm" action="<?= URLROOT; ?>/availablecontroller/addplace" method="POST"
            onsubmit="return validateForm(event)">
            <div>
                <?php require APPROOT . '/views/components/auth_message.php'; ?>
                <label for="region" class="block text-gray-700 font-medium mb-1">Region</label>
                <select id="region" name="region"
                    class="w-full px-3 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    <?php foreach ($data['regions'] as $region): ?>
                    <option value="<?= htmlspecialchars($region['id']) ?>">
                        <?= htmlspecialchars($region['name']) ?>
                    </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div>
                <label for="city" class="block text-gray-700 font-medium mb-1">City</label>
                <input type="text" id="city" name="city" placeholder="Enter City"
                    class="w-full px-3 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>
            <div>
                <label for="township" class="block text-gray-700 font-medium mb-1">Township</label>
                <input type="text" id="township" name="township" placeholder="Enter Township"
                    class="w-full px-3 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>
            <div class="flex justify-end space-x-4 mt-6">
                <button type="button" onclick="window.location='<?= URLROOT; ?>/available_place/available';"
                    class="bg-gray-300 text-gray-700 font-semibold py-2 px-4 rounded-lg hover:bg-gray-400 transition-colors duration-200">
                    Cancel
                </button>

                <button type="submit"
                    class="bg-custom-blue text-white font-semibold py-2 px-4 rounded-lg hover:bg-indigo-700 transition-colors duration-200">
                    Create Place
                </button>
            </div>
        </form>
    </div>
</main>
</body>

</html>