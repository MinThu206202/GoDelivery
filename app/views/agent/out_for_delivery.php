<?php require_once APPROOT . '/views/inc/agentsidebar.php'; ?>

<script src="https://cdn.tailwindcss.com"></script>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
body {
    font-family: 'Inter', sans-serif;
    background-color: #f3f4f6;
}

/* Toast notifications */
.toast-success {
    background-color: #22c55e;
}

.toast-error {
    background-color: #ef4444;
}

.toast-warning {
    background-color: #f59e0b;
}
</style>

<div class="flex-1 flex flex-col overflow-hidden">
    <!-- Header -->
    <header class="flex items-center justify-between p-6 bg-white shadow-md rounded-bl-lg">
        <h1 class="text-3xl font-semibold text-gray-800">Out For Delivery</h1>
        <div x-data="{ open: false }" class="relative">
            <button @click="open = !open"
                class="flex items-center space-x-2 bg-white border border-gray-300 px-4 py-2 rounded-lg shadow-sm hover:bg-gray-100 transition">
                <img src="/Delivery/<?= htmlspecialchars($agent['profile_image']) ?>" alt="Agent Avatar"
                    class="w-10 h-10 rounded-full border-2 border-blue-500">
                <div class="text-left">
                    <p class="text-lg font-medium text-gray-800"><?= htmlspecialchars($agent['name']) ?></p>
                    <p class="text-sm text-gray-500">Agent ID: <?= htmlspecialchars($agent['access_code']) ?></p>
                </div>
            </button>

            <!-- Dropdown -->
            <div x-show="open" @click.away="open = false" x-transition
                class="absolute right-0 mt-2 w-48 bg-white border border-gray-200 rounded-lg shadow-lg py-2 z-50">
                <a href="<?= URLROOT; ?>/agent/profile"
                    class="block px-4 py-2 text-gray-700 hover:bg-gray-100 transition">Profile</a>
                <div class="border-t my-1"></div>
                <a href="<?= URLROOT; ?>/agentcontroller/logout"
                    class="block px-4 py-2 text-gray-700 hover:bg-gray-100 transition">Logout</a>
            </div>
        </div>
        <script src="//unpkg.com/alpinejs" defer></script>
    </header>

    <!-- Delivery Requests Content -->
    <main class="flex-1 overflow-y-auto p-6 bg-gray-100">
        <div class="max-w-6xl mx-auto bg-white p-8 rounded-xl shadow-md">
            <h2 class="text-2xl font-semibold text-gray-800 mb-6">Ongoing Deliveries</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 table-fixed">
                    <thead class="bg-gray-50 sticky top-0">
                        <tr>
                            <th
                                class="w-28 px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider rounded-tl-lg">
                                Delivery ID</th>
                            <th
                                class="w-32 px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Customer</th>
                            <th
                                class="w-32 px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Destination</th>
                            <th
                                class="w-24 px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Contact</th>
                            <th
                                class="w-36 px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Pickup Agent</th>
                            <th
                                class="w-32 px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Parcel Type</th>
                            <th
                                class="w-36 px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Delivery Status</th>
                            <th
                                class="w-40 px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider rounded-tr-lg">
                                Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php if (!empty($data['deliveries'])): ?>
                        <?php foreach ($data['deliveries'] as $delivery): ?>
                        <tr>
                            <td class="px-4 py-2 text-sm font-medium text-gray-900">
                                <?= htmlspecialchars($delivery['tracking_code'] ?? '') ?></td>
                            <td class="px-4 py-2 text-sm text-gray-500">
                                <?= htmlspecialchars($delivery['receiver_customer_name'] ?? 'N/A') ?></td>
                            <td class="px-4 py-2 text-sm text-gray-500">
                                <?= htmlspecialchars($delivery['receiver_customer_address'] ?? 'N/A') ?></td>
                            <td class="px-4 py-2 text-sm text-gray-500">
                                <?= htmlspecialchars($delivery['receiver_customer_phone'] ?? '0.00') ?></td>
                            <td class="px-4 py-2 text-sm text-gray-900">
                                <?= htmlspecialchars($delivery['pickupagent_name'] ?? 'N/A') ?></td>
                            <td class="px-4 py-2 text-sm text-gray-700 truncate"
                                title="<?= htmlspecialchars($delivery['delivery_type_name'] ?? 'N/A') ?>">
                                <?= htmlspecialchars($delivery['delivery_type_name'] ?? 'N/A') ?></td>
                            <?php
                                    $status = trim($delivery['delivery_status']); // remove extra spaces

                                    $statusClass = match ($status) {
                                        'Pending' => 'bg-yellow-100 text-yellow-800',
                                        'Ready for Pickup' => 'bg-indigo-100 text-indigo-800',
                                        'Delivered' => 'bg-green-100 text-green-800',
                                        'Cancelled' => 'bg-red-100 text-red-800',
                                        'Returned' => 'bg-purple-100 text-purple-800',
                                        'Awaiting Acceptance' => 'bg-blue-100 text-blue-800',
                                        'Rejected' => 'bg-red-200 text-red-900',
                                        'Out for Delivery' => 'bg-blue-200 text-blue-900',
                                        'Deliver Parcel' => 'bg-green-200 text-green-900',
                                        'Waiting Payment' => 'bg-yellow-200 text-yellow-900',
                                        'Receipt Submitted' => 'bg-indigo-200 text-indigo-900',
                                        'Payment Success' => 'bg-green-300 text-green-900',
                                        'On the Way' => 'bg-blue-300 text-blue-900',
                                        'Delivery at Office' => 'bg-indigo-300 text-indigo-900',
                                        default => 'bg-gray-100 text-gray-800',
                                    };
                                    ?>
                            <td class="px-6 py-4 text-sm">
                                <span
                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full <?= $statusClass ?> break-words max-w-[120px] text-center">
                                    <?= htmlspecialchars($status) ?>
                                </span>
                            </td>


                            <td class="px-4 py-2 text-right text-sm font-medium flex space-x-2">
                                <a href="<?= URLROOT; ?>/agent/outfordeliveryaction?delivery_code=<?= htmlspecialchars($delivery['tracking_code']) ?>"
                                    class="px-3 py-1 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600 transition-colors duration-200">
                                    Actions
                                </a>

                            </td>

                        </tr>
                        <?php endforeach; ?>
                        <?php else: ?>
                        <tr>
                            <td colspan="8" class="px-6 py-8 text-center text-gray-500 text-sm">📦 No deliveries
                                available.</td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</div>

<!-- Toast Notifications -->
<div id="toast-container" class="fixed bottom-4 right-4 z-50 space-y-2">
    <div id="toast-message"
        class="hidden flex items-center justify-between p-4 rounded-lg shadow-lg text-white font-semibold">
        <span id="toast-text"></span>
        <button onclick="hideToast()" class="ml-4 text-white hover:text-gray-200 focus:outline-none">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
    </div>
</div>

<script>
function showToast(message, type) {
    const toastMessage = document.getElementById('toast-message');
    const toastText = document.getElementById('toast-text');
    toastText.textContent = message;
    toastMessage.classList.remove('hidden');
    toastMessage.classList.remove('toast-success', 'toast-error', 'toast-warning');
    if (type === 'success') toastMessage.classList.add('toast-success');
    else if (type === 'error') toastMessage.classList.add('toast-error');
    else if (type === 'warning') toastMessage.classList.add('toast-warning');
    setTimeout(() => hideToast(), 3000);
}

function hideToast() {
    document.getElementById('toast-message').classList.add('hidden');
}
</script>