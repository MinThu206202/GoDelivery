<?php require_once APPROOT . '/views/inc/pickupagentsiderbar.php';
$vehicle = $data['profile'];
$alldata = $data['allpickupdata'];
// Total pickups
$totalPickups = count($alldata);

// Total delivered
$totalDelivered = count(array_filter($alldata, function ($item) {
    return strtolower($item['status'] ?? '') === 'collected';
}));

// Total not delivered
$totalNotDelivered = $totalPickups - $totalDelivered;

?>


<!-- Main Content -->
<div class="flex flex-1 flex-col">
    <!-- Header -->
    <header class="bg-white text-gray-800 shadow-sm py-4 px-6 md:px-8 lg:px-12 flex items-center justify-between">
        <h1 class="text-xl md:text-2xl font-bold">Agent Profile</h1>
        <div class="flex items-center space-x-4">
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

        </div>
    </header>

    <!-- Profile Content -->
    <main class="flex-1 p-6 md:p-8 lg:p-12 overflow-y-auto">
        <div class="max-w-4xl mx-auto bg-white rounded-xl shadow-lg p-8">

            <!-- Profile Header Section -->
            <div class="flex items-center mb-8 pb-4 border-b border-gray-200">
                <div
                    class="w-24 h-24 rounded-full overflow-hidden bg-gray-200 flex items-center justify-center text-4xl font-bold text-gray-700 mr-6">
                    <?php if (!empty($user['profile_image'])): ?>
                    <img src="<?= URLROOT . '/' . htmlspecialchars($user['profile_image']) ?>" alt="Profile Image"
                        class="w-full h-full object-cover">
                    <?php else: ?>
                    <?= strtoupper(substr($user['name'], 0, 2)) ?>
                    <?php endif; ?>
                </div>

                <div>
                    <h2 class="text-2xl font-bold text-gray-800"><?= htmlspecialchars($user['name']) ?></h2>
                    <p class="text-sm text-gray-500">Agent ID: <?= htmlspecialchars($user['access_code']) ?></p>
                    <p class="text-sm text-gray-500">Member since: <?= htmlspecialchars($user['created_at']) ?></p>
                </div>
                <div class="ml-auto">
                    <button onclick="openProfileModal()"
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
                        <div class="text-4xl font-bold text-blue-600 mb-2"><?= htmlspecialchars($totalPickups) ?></div>
                        <div class="text-gray-500 text-sm">Total Pickups</div>
                    </div>
                    <!-- Average Rating Card -->
                    <div class="bg-gray-50 p-6 rounded-lg shadow-sm text-center">
                        <div class="text-4xl font-bold text-blue-600 mb-2"><?= htmlspecialchars($totalDelivered) ?>
                        </div>
                        <div class="text-gray-500 text-sm">Complete Pickups</div>
                    </div>
                    <!-- On-Time Rate Card -->
                    <div class="bg-gray-50 p-6 rounded-lg shadow-sm text-center">
                        <div class="text-4xl font-bold text-blue-600 mb-2"><?= htmlspecialchars($totalNotDelivered) ?>
                        </div>
                        <div class="text-gray-500 text-sm">Assigned Pickup</div>
                    </div>
                </div>
            </div>

            <!-- Badges & Achievements (optional) -->


        </div>
    </main>
</div>



<!-- Edit Profile Modal -->
<div id="profileModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white w-full max-w-md rounded-xl shadow-lg p-6 relative">
        <button onclick="closeProfileModal()"
            class="absolute top-3 right-3 text-gray-500 hover:text-gray-700 text-lg">&times;</button>

        <h2 class="text-xl font-bold mb-4">Edit Profile</h2>
        <form action="<?= URLROOT; ?>/pickupagentcontroller/updateProfile" method="POST" enctype="multipart/form-data"
            class="space-y-4">

            <!-- Hidden ID -->
            <input type="hidden" name="user_id" value="<?= htmlspecialchars($user['id']) ?>">

            <!-- Profile Image Upload with Preview -->
            <div class="flex flex-col items-center">
                <div class="w-28 h-28 rounded-full overflow-hidden border-4 border-blue-100 shadow-md mb-3">
                    <img id="profilePreview"
                        src="<?= !empty($user['profile_image']) ? URLROOT . '/' . htmlspecialchars($user['profile_image']) : 'https://via.placeholder.com/150' ?>"
                        alt="Profile Preview" class="w-full h-full object-cover">
                </div>
                <label class="cursor-pointer bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                    <input type="file" name="profile_image" accept="image/*" class="hidden"
                        onchange="previewProfile(event)">
                    Change Image
                </label>
            </div>

            <!-- Name -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Name</label>
                <input type="text" name="name" value="<?= htmlspecialchars($user['name']) ?>"
                    class="mt-1 block w-full border rounded-lg px-3 py-2 text-sm focus:ring-blue-500 focus:border-blue-500">
            </div>

            <!-- Submit -->
            <div class="flex justify-end">
                <button type="submit"
                    class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Save</button>
            </div>
        </form>
    </div>
</div>

<script>
function openProfileModal() {
    document.getElementById('profileModal').classList.remove('hidden');
}

function closeProfileModal() {
    document.getElementById('profileModal').classList.add('hidden');
}

function previewProfile(event) {
    const reader = new FileReader();
    reader.onload = function() {
        document.getElementById('profilePreview').src = reader.result;
    };
    reader.readAsDataURL(event.target.files[0]);
}
</script>


</body>

</html>