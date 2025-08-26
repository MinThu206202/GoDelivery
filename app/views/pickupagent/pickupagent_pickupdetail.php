<?php require_once APPROOT . '/views/inc/pickupagentsiderbar.php';
$pickup = $data['pickupdetial'];
?>

<style>
    :root {
        --main-bg-color: rgb(31 38 91 / var(--tw-bg-opacity, 1));
    }

    body {
        font-family: 'Inter', sans-serif;
        background-color: #f3f4f6;
    }

    .custom-scrollbar::-webkit-scrollbar {
        width: 8px;
    }

    .custom-scrollbar::-webkit-scrollbar-track {
        background: #e5e7eb;
        border-radius: 10px;
    }

    .custom-scrollbar::-webkit-scrollbar-thumb {
        background: #9ca3af;
        border-radius: 10px;
    }

    .custom-scrollbar::-webkit-scrollbar-thumb:hover {
        background: #6b7280;
    }

    .text-shadow-md {
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
    }

    .active-link {
        background-color: #2563eb;
        color: white;
    }
</style>


<!-- Main Content -->
<div class="flex flex-1 flex-col">
    <!-- Header -->
    <header class="bg-white shadow-sm py-4 px-6 md:px-8 lg:px-12 flex items-center justify-between">
        <div class="flex items-center space-x-4">
            <h1 class="text-xl md:text-2xl font-bold">Pickup Details</h1>
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

    <?php if (isset($_SESSION['flash_message'])):
        $flash = $_SESSION['flash_message'];
        unset($_SESSION['flash_message']);
    ?>
        <div id="flashMessage" class="mx-auto mb-6 max-w-lg text-center 
                px-6 py-3 rounded shadow-md text-white font-medium
                <?= $flash['type'] === 'success' ? 'bg-green-500' : 'bg-red-500' ?>">
            <?= htmlspecialchars($flash['message']) ?>
        </div>

        <script>
            setTimeout(() => {
                const flash = document.getElementById('flashMessage');
                if (flash) flash.style.display = 'none';
            }, 4000);
        </script>
    <?php endif; ?>

    <!-- Main Content -->
    <main class="flex-1 p-6 md:p-8 lg:p-12 overflow-y-auto">
        <div class="max-w-4xl mx-auto bg-white rounded-lg shadow-md p-6 sm:p-8">

            <!-- Static content area with pickup details -->
            <div id="pickup-details-container" class="space-y-6">
                <!-- Pickup ID & Status -->
                <div class="flex justify-between items-center pb-4 border-b border-gray-200">
                    <h2 class="text-3xl font-extrabold text-gray-900"><?= htmlspecialchars($pickup['request_code']) ?>
                    </h2>
                    <?php
                    // Map statuses to Tailwind badge colors
                    $statusColors = [
                        'pending' => 'bg-yellow-300 text-yellow-900',       // waiting
                        'accepted' => 'bg-blue-300 text-blue-900',         // assigned
                        'collected' => 'bg-orange-300 text-orange-900',    // picked up
                        'on_the_way' => 'bg-teal-300 text-teal-900',       // in transit
                        'rejected' => 'bg-red-300 text-red-900',           // failed/rejected
                        'awaiting_payment' => 'bg-amber-300 text-amber-900', // payment pending
                        'payment_success' => 'bg-green-300 text-green-900'   // completed/delivered
                    ];
                    $badgeClass = $statusColors[$pickup['status']] ?? 'bg-gray-100 text-gray-700';
                    ?>

                    <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full <?= $badgeClass ?>">
                        <?= htmlspecialchars(ucwords(str_replace('_', ' ', $pickup['status']))) ?>
                    </span>
                </div>

                <!-- Basic Info -->
                <div class="space-y-4 p-6 border border-gray-200 rounded-lg">
                    <h3 class="text-xl font-bold text-gray-800">Basic Info</h3>
                    <div class="grid sm:grid-cols-2 gap-y-4 gap-x-8">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Recipient</p>
                            <p class="text-lg font-semibold"><?= htmlspecialchars($pickup['sender_name']) ?></p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Address</p>
                            <p class="text-lg font-semibold"><?= htmlspecialchars($pickup['sender_address']) ?></p>
                        </div>
                    </div>

                    <div class="grid sm:grid-cols-2 gap-y-4 gap-x-8">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Due Time</p>
                            <p class="text-lg font-semibold"><?= htmlspecialchars($pickup['created_at']) ?></p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Contact</p>
                            <p class="text-lg font-semibold"><?= htmlspecialchars($pickup['sender_phone']) ?></p>
                        </div>
                    </div>
                </div>

                <!-- Delivery Info -->
                <div class="space-y-4 p-6 border border-gray-200 rounded-lg">
                    <h3 class="text-xl font-bold text-gray-800">Delivery Info</h3>
                    <div class="grid sm:grid-cols-2 gap-y-4 gap-x-8">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Weight</p>
                            <p class="text-lg font-semibold"><?= htmlspecialchars($pickup['weight']) ?> kg</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Number of Piece</p>
                            <p class="text-lg font-semibold"><?= htmlspecialchars($pickup['quantity']) ?></p>
                        </div>
                    </div>

                    <div class="grid sm:grid-cols-2 gap-y-4 gap-x-8">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Payment Type</p>
                            <p class="text-lg font-semibold">
                                <?= htmlspecialchars(ucwords(str_replace('_', ' ', $pickup['payment_status_name']))) ?>
                            </p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Delivery Type</p>
                            <p class="text-lg font-semibold">
                                <?= htmlspecialchars(ucwords(str_replace('_', ' ', $pickup['delivery_type_name']))) ?>
                            </p>
                        </div>
                    </div>
                </div>



                <!-- Action buttons -->
                <div
                    class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4 pt-6 border-t border-gray-200">

                    <!-- Back Button -->
                    <a href="<?= URLROOT; ?>/pickupagentcontroller/mypick"
                        class="w-full sm:w-auto flex justify-center items-center py-3 px-6 rounded-lg font-bold text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors">
                        <i class="fas fa-arrow-left mr-2"></i> Back to Pickups
                    </a>

                    <!-- Edit Button -->
                    <?php if ($pickup['status'] === 'on_the_way'): ?>
                        <button onclick="openEditModal()"
                            class="w-full sm:w-auto flex justify-center items-center py-3 px-6 rounded-lg font-bold text-white bg-yellow-500 hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:ring-offset-2 transition-colors">
                            <i class="fas fa-pencil-alt mr-2"></i> Edit Pickup
                        </button>

                        <!-- Pickup Verify Button -->
                        <a href="<?= URLROOT; ?>/pickupagentcontroller/verifypickup?id=<?= htmlspecialchars($pickup['id']); ?>"
                            class="w-full sm:w-auto flex justify-center items-center py-3 px-6 rounded-lg font-bold text-white bg-purple-600 hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-400 focus:ring-offset-2 transition-colors">
                            <i class="fas fa-user-check mr-2"></i> Pickup Verify
                        </a>
                    <?php endif; ?>

                    <!-- Mark as Complete Button -->
                    <?php if ($pickup['status'] === 'pickup_verified'): ?>
                        <a href="<?= URLROOT; ?>/pickupagentcontroller/completepickup?id=<?= htmlspecialchars($pickup['id']); ?>"
                            class="w-full sm:w-auto flex justify-center items-center py-3 px-6 rounded-lg font-bold text-white bg-green-500 hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-400 focus:ring-offset-2 transition-colors">
                            <i class="fas fa-check mr-2"></i> Complete Pickup
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </main>
</div>

<!-- Edit Modal -->
<div id="editModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex justify-center items-center hidden z-50">
    <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-lg">
        <h2 class="text-xl font-bold mb-4">Edit Pickup</h2>

        <form id="editForm" method="GET">
            <!-- Weight -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Weight (kg)</label>
                <input type="number" name="weight" value="<?= htmlspecialchars($pickup['weight']); ?>"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
            </div>

            <!-- Pieces -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Number of Piece</label>
                <input type="number" name="quantity" value="<?= htmlspecialchars($pickup['quantity']); ?>"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
            </div>

            <!-- Payment Type -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Payment Type</label>
                <select name="payment_type" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    <option value=1 <?= $pickup['payment_status_name'] == "Sender Pay" ? 'selected' : ''; ?>>
                        Sender Pay</option>
                    <option value=2 <?= $pickup['payment_status_name'] == "Receiver Pay" ? 'selected' : ''; ?>>Receiver
                        Pay</option>
                </select>
            </div>

            <input type="hidden" name="request_code" value="<?= htmlspecialchars($pickup['request_code']); ?>">

            <!-- Delivery Type -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Delivery Type</label>
                <select name="delivery_type" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    <option value=1 <?= $pickup['delivery_type_name'] == "Normal" ? 'selected' : ''; ?>>Normal
                    </option>
                    <option value=2 <?= $pickup['delivery_type_name'] == "Express" ? 'selected' : ''; ?>>Express
                    </option>
                    <option value=3 <?= $pickup['delivery_type_name'] == "In City" ? 'selected' : ''; ?>>In City
                    </option>
                    <option value=4 <?= $pickup['delivery_type_name'] == "Important" ? 'selected' : ''; ?>>
                        Important
                    </option>
                </select>
            </div>

            <!-- Buttons -->
            <div class="flex justify-end space-x-3 mt-6">
                <button type="button" onclick="closeEditModal()"
                    class="px-4 py-2 bg-gray-300 rounded-lg hover:bg-gray-400">Cancel</button>

                <button type="submit"
                    class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Save</button>
            </div>
        </form>
    </div>
</div>

<script>
    function openEditModal() {
        document.getElementById('editModal').classList.remove('hidden');
    }

    function closeEditModal() {
        document.getElementById('editModal').classList.add('hidden');
    }

    // When save clicked
    document.getElementById('editForm').addEventListener('submit', function(e) {
        e.preventDefault();

        // collect form data
        const formData = new FormData(this);
        const queryString = new URLSearchParams(formData).toString();

        // redirect with params to your PHP controller
        window.location.href =
            "<?= URLROOT; ?>/pickupagentcontroller/editpickup?id=<?= htmlspecialchars($pickup['id']); ?>&" +
            queryString;
    });
</script>




</body>

</html>