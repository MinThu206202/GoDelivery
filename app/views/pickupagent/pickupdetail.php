<?php require_once APPROOT . '/views/inc/pickupagentsiderbar.php'; ?>


<!-- Main Content -->
<div class="flex flex-1 flex-col">
    <!-- Header -->
    <header class="bg-white text-gray-800 shadow-sm py-4 px-6 md:px-8 lg:px-12 flex items-center justify-between">
        <h1 class="text-xl md:text-2xl font-bold">Pickup Details</h1>
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

    <!-- Pickup Details Content -->
    <main class="flex-1 p-6 md:p-8 lg:p-12 overflow-y-auto">
        <div class="max-w-4xl mx-auto">
            <div class="flex justify-between items-center mb-6">
                <a href="my-pickups.html"
                    class="text-gray-500 hover:text-gray-700 transition duration-200 focus:outline-none">
                    <i class="fas fa-arrow-left mr-2"></i> Back to My Pickups
                </a>
            </div>

            <div class="bg-white rounded-lg shadow-sm p-6 space-y-4">
                <div class="flex justify-between items-center">
                    <span class="text-gray-500">Pickup ID:</span>
                    <span class="font-semibold text-gray-800">#PCK-001</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-gray-500">Recipient:</span>
                    <span class="font-semibold text-gray-800">Jane Doe</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-gray-500">Address:</span>
                    <span class="font-semibold text-gray-800">123 Main St, Anytown</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-gray-500">Due Time:</span>
                    <span class="font-semibold text-gray-800">2:00 PM</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-gray-500">Status:</span>
                    <span
                        class="inline-block px-3 py-1 text-sm font-semibold rounded-full bg-yellow-100 text-yellow-700">Pending</span>
                </div>
            </div>

            <!-- Confirmation Section -->
            <div class="mt-6 space-y-4">
                <label for="parcel-verified" class="flex items-center space-x-2 cursor-pointer">
                    <input type="checkbox" id="parcel-verified"
                        class="form-checkbox h-5 w-5 text-blue-600 rounded focus:ring-blue-500">
                    <span class="text-gray-700 font-medium">Confirm parcel collected & info verified</span>
                </label>

                <button id="confirm-btn"
                    class="w-full px-6 py-3 bg-green-600 text-white font-semibold rounded-lg shadow-md transition duration-200 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 disabled:opacity-50 disabled:cursor-not-allowed">
                    <i class="fas fa-check mr-2"></i> Mark as Completed
                </button>
            </div>
        </div>
    </main>
</div>

<script>
    const confirmCheckbox = document.getElementById('parcel-verified');
    const confirmButton = document.getElementById('confirm-btn');
    if (confirmCheckbox && confirmButton) {
        confirmButton.disabled = !confirmCheckbox.checked;
        confirmCheckbox.addEventListener('change', (event) => {
            confirmButton.disabled = !event.target.checked;
        });
    }
</script>
</body>

</html>