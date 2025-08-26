<?php require_once APPROOT . '/views/inc/pickupagentsiderbar.php';
$vehicle = $data['profile'];
?>


<!-- Main Content -->
<div class="flex flex-1 flex-col">
    <!-- Header -->
    <header class="bg-white text-gray-800 shadow-sm py-4 px-6 md:px-8 lg:px-12 flex items-center justify-between">
        <h1 class="text-xl md:text-2xl font-bold">Agent Profile</h1>
        <div class="flex items-center space-x-4">
            <div class="flex items-center space-x-2">
                <div
                    class="w-10 h-10 bg-gray-200 rounded-full flex items-center justify-center font-bold text-gray-700">
                    MM</div>
                <div>
                    <span class="text-sm font-medium text-gray-600"><?= htmlspecialchars($user['name']) ?></span>
                    <p class="text-xs text-gray-500"><?= htmlspecialchars($user['access_code']) ?></p>
                </div>
            </div>
        </div>
    </header>

    <!-- Profile Content -->
    <main class="flex-1 p-6 md:p-8 lg:p-12 overflow-y-auto">
        <div class="max-w-4xl mx-auto bg-white rounded-xl shadow-lg p-8">

            <!-- Profile Header Section -->
            <div class="flex items-center mb-8 pb-4 border-b border-gray-200">
                <div
                    class="w-24 h-24 bg-gray-200 rounded-full flex items-center justify-center text-4xl font-bold text-gray-700 mr-6">
                    MM
                </div>
                <div>
                    <h2 class="text-2xl font-bold text-gray-800"><?= htmlspecialchars($user['name']) ?></h2>
                    <p class="text-sm text-gray-500">Agent ID: <?= htmlspecialchars($user['access_code']) ?></p>
                    <p class="text-sm text-gray-500">Member since: <?= htmlspecialchars($user['created_at']) ?></p>
                </div>
                <div class="ml-auto">
                    <button
                        class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-200 shadow-md">
                        <i class="fas fa-edit mr-2"></i> Edit Profile
                    </button>
                </div>
            </div>

            <!-- Contact and Vehicle Information -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                <div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-4">Contact Information</h3>
                    <div class="space-y-3 text-gray-600">
                        <p class="flex items-center"><i
                                class="fas fa-envelope mr-3 text-blue-500"></i><?= htmlspecialchars($user['email']) ?>
                        </p>
                        <p class="flex items-center"><i
                                class="fas fa-phone-alt mr-3 text-blue-500"></i><?= htmlspecialchars($user['phone']) ?>
                        </p>
                        <p class="flex items-center"><i
                                class="fas fa-map-marker-alt mr-3 text-blue-500"></i><?= htmlspecialchars($vehicle['region_name']) ?>,<?= htmlspecialchars($vehicle['township_name']) ?>
                        </p>
                    </div>
                </div>
                <div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-4">Vehicle Information</h3>
                    <div class="space-y-3 text-gray-600">
                        <p class="flex items-center"><i class="fas fa-motorcycle mr-3 text-blue-500"></i>Vehicle
                            Type: <?= htmlspecialchars($vehicle['vehicle_type_name']) ?></p>
                        <p class="flex items-center"><i class="fas fa-id-card mr-3 text-blue-500"></i>License Plate:
                            <?= htmlspecialchars($vehicle['plate_number']) ?></p>
                        <p class="flex items-center"><i class="fas fa-tag mr-3 text-blue-500"></i>Vehicle Make:
                            <?= htmlspecialchars($vehicle['make']) ?>(<?= htmlspecialchars($vehicle['color']) ?> color)
                        </p>
                    </div>
                </div>
            </div>

            <!-- Performance Metrics -->
            <div class="mb-8">
                <h3 class="text-xl font-semibold text-gray-800 mb-4">Performance</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Completed Pickups Card -->
                    <div class="bg-gray-50 p-6 rounded-lg shadow-sm text-center">
                        <div class="text-4xl font-bold text-blue-600 mb-2">156</div>
                        <div class="text-gray-500 text-sm">Completed Pickups</div>
                    </div>
                    <!-- Average Rating Card -->
                    <div class="bg-gray-50 p-6 rounded-lg shadow-sm text-center">
                        <div class="text-4xl font-bold text-blue-600 mb-2">4.8 <i
                                class="fas fa-star text-yellow-400 text-xl ml-1"></i></div>
                        <div class="text-gray-500 text-sm">Average Rating</div>
                    </div>
                    <!-- On-Time Rate Card -->
                    <div class="bg-gray-50 p-6 rounded-lg shadow-sm text-center">
                        <div class="text-4xl font-bold text-blue-600 mb-2">98%</div>
                        <div class="text-gray-500 text-sm">On-Time Rate</div>
                    </div>
                </div>
            </div>

            <!-- Badges & Achievements (optional) -->
            <div>
                <h3 class="text-xl font-semibold text-gray-800 mb-4">Badges & Achievements</h3>
                <div class="flex flex-wrap gap-4">
                    <span
                        class="flex items-center bg-gray-100 text-gray-800 text-sm font-medium px-4 py-2 rounded-full shadow-sm">
                        <i class="fas fa-medal text-yellow-500 mr-2"></i> Top Performer
                    </span>
                    <span
                        class="flex items-center bg-gray-100 text-gray-800 text-sm font-medium px-4 py-2 rounded-full shadow-sm">
                        <i class="fas fa-award text-blue-500 mr-2"></i> Star Agent
                    </span>
                    <span
                        class="flex items-center bg-gray-100 text-gray-800 text-sm font-medium px-4 py-2 rounded-full shadow-sm">
                        <i class="fas fa-gem text-purple-500 mr-2"></i> 100+ Pickups
                    </span>
                </div>
            </div>

        </div>
    </main>
</div>
</body>

</html>