<?php require_once APPROOT . '/views/inc/agentsidebar.php';

?>

<script src="https://cdn.tailwindcss.com"></script>
<!-- Inter Font -->
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<style>
body {
    font-family: 'Inter', sans-serif;
    background-color: #f3f4f6;
}

/* Custom styles for toast notifications */
.toast-success {
    background-color: #22c55e;
    /* green-500 */
}

.toast-error {
    background-color: #ef4444;
    /* red-500 */
}

.toast-warning {
    background-color: #f59e0b;
    /* amber-500 */
}
</style>


<!-- Main Content Area -->
<div class="flex-1 flex flex-col overflow-hidden">
    <!-- Header -->
    <header class="flex items-center justify-between p-6 bg-white shadow-md rounded-bl-lg">
        <h1 class="text-3xl font-semibold text-gray-800">Pickup Location Requests</h1>
        <div x-data="{ open: false }" class="relative">
            <!-- Button-like Trigger -->
            <button @click="open = !open"
                class="flex items-center space-x-2 bg-white border border-gray-300 px-4 py-2 rounded-lg shadow-sm hover:bg-gray-100 transition">
                <img src="/Delivery/<?= htmlspecialchars($agent['profile_image']) ?>" alt="Agent Avatar"
                    class="w-10 h-10 rounded-full border-2 border-blue-500">
                <div class="text-left">
                    <p class="text-lg font-medium text-gray-800">
                        <?= htmlspecialchars($agent['name']) ?>
                    </p>
                    <p class="text-sm text-gray-500">
                        Agent ID: <?= htmlspecialchars($agent['access_code']) ?>
                    </p>
                </div>
            </button>

            <!-- Dropdown -->
            <div x-show="open" @click.away="open = false" x-transition
                class="absolute right-0 mt-2 w-48 bg-white border border-gray-200 rounded-lg shadow-lg py-2 z-50">
                <!-- Profile -->
                <a href="<?= URLROOT; ?>/agent/profile"
                    class="block px-4 py-2 text-gray-700 hover:bg-gray-100 transition">
                    Profile
                </a>

                <!-- Divider -->
                <div class="border-t my-1"></div>

                <!-- Logout -->
                <a href="<?= URLROOT; ?>/agentcontroller/logout"
                    class="block px-4 py-2 text-gray-700 hover:bg-gray-100 transition">
                    Logout
                </a>
            </div>
        </div>

        <!-- Alpine.js -->
        <script src="//unpkg.com/alpinejs" defer></script>

    </header>

    <!-- Pickup Requests Content -->
    <main class="flex-1 overflow-y-auto p-6 bg-gray-100">
        <div class="max-w-6xl mx-auto bg-white p-8 rounded-xl shadow-md">
            <h2 class="text-2xl font-semibold text-gray-800 mb-6">Available Pickup Requests</h2>

            <!-- Scrollable Table Container -->
            <div class="overflow-x-auto max-h-[500px] border rounded-lg shadow-inner">
                <table class="min-w-full divide-y divide-gray-200 table-fixed">
                    <thead class="bg-gray-50 sticky top-0 z-10">
                        <tr>
                            <th
                                class="w-28 px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider rounded-tl-lg">
                                Request ID
                            </th>
                            <th
                                class="w-32 px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Customer Name
                            </th>
                            <th
                                class="w-32 px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Pickup Location
                            </th>
                            <th
                                class="w-24 px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Contact Number
                            </th>
                            <th
                                class="w-36 px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Requested Date & Time
                            </th>
                            <th
                                class="w-32 px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Parcel Type
                            </th>
                            <th
                                class="w-36 px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Parcel Status
                            </th>
                            <th
                                class="w-40 px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider rounded-tr-lg">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php if (!empty($data['pickup_requests'])): ?>
                        <?php foreach ($data['pickup_requests'] as $res): ?>
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2 text-sm font-medium text-gray-900">
                                <?= htmlspecialchars($res['request_code'] ?? '') ?></td>
                            <td class="px-4 py-2 text-sm text-gray-500">
                                <?= htmlspecialchars($res['sender_name'] ?? 'N/A') ?></td>
                            <td class="px-4 py-2 text-sm text-gray-500">
                                <?= htmlspecialchars($res['sender_city'] ?? 'N/A') ?></td>
                            <td class="px-4 py-2 text-sm text-gray-500">
                                <?= htmlspecialchars($res['sender_phone'] ?? '0.00') ?></td>
                            <td class="px-4 py-2 text-sm text-gray-900">
                                <?= htmlspecialchars($res['created_at'] ?? '0.00') ?></td>
                            <td class="px-4 py-2 text-sm text-gray-700 truncate"
                                title="<?= htmlspecialchars($res['parcel_type'] ?? 'N/A') ?>">
                                <?= htmlspecialchars($res['parcel_type'] ?? 'N/A') ?>
                            </td>
                            <td class="px-4 py-2 text-sm">
                                <?php
                                        $status = strtolower($res['status'] ?? 'default');
                                        $statusClasses = [
                                            'pending'                     => 'bg-yellow-500',
                                            'accepted'                    => 'bg-indigo-500',
                                            'collected'                   => 'bg-orange-600',
                                            'voucher_created'             => 'bg-purple-600',
                                            'delivered'                   => 'bg-green-500',
                                            'arrived_office'              => 'bg-teal-500',
                                            'rejected'                    => 'bg-red-500',
                                            'agent_checked'               => 'bg-pink-500',
                                            'awaiting_payment'            => 'bg-orange-500',
                                            'arrived_at_office' => 'bg-blue-400',
                                            'payment_success'             => 'bg-emerald-600',
                                            'awaiting_cash'               => 'bg-amber-500',
                                            'cash_collected'              => 'bg-lime-600',
                                            'pickup_verification_pending' => 'bg-orange-500',
                                            'pickup_verified'             => 'bg-blue-500',
                                            'on_the_way'                  => 'bg-sky-500',
                                            'waiting_for_receipt'         => 'bg-pink-500',
                                            'receipt_submitted'           => 'bg-cyan-500',
                                            'payment_pending'             => 'bg-amber-600',
                                            'payment_reject'              => 'bg-red-600',
                                            'cancelled'                   => 'bg-gray-600',
                                            'arrived_at_user'             => 'bg-green-600',
                                            'pickup_failed'               => 'bg-red-600',
                                            'default'                     => 'bg-gray-400'
                                        ];
                                        $status_class = $statusClasses[$status] ?? $statusClasses['default'];
                                        ?>
                                <span
                                    class="px-3 py-1 inline-flex text-sm font-bold rounded-full shadow-md text-white capitalize <?= $status_class ?> whitespace-nowrap leading-tight"
                                    title="<?= htmlspecialchars(str_replace('_', ' ', $status)) ?>">
                                    <?= htmlspecialchars(str_replace('_', ' ', $status)) ?>
                                </span>
                            </td>
                            <td class="px-4 py-2 text-right text-sm font-medium flex space-x-2">
                                <a href="<?= URLROOT; ?>/agent/pickup_detail?request_code=<?= htmlspecialchars($res['request_code']) ?>"
                                    class="px-3 py-1 bg-[#1F265B] text-white rounded-lg hover:bg-[#2A346C] transition-colors duration-200">
                                    View
                                </a>
                                <a href="<?= URLROOT; ?>/agent/action?request_code=<?= htmlspecialchars($res['request_code']) ?>"
                                    class="px-3 py-1 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600 transition-colors duration-200">
                                    Actions
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        <?php else: ?>
                        <tr>
                            <td colspan="8" class="px-6 py-8 text-center text-gray-500 text-sm">
                                🚚 No pickup requests available.
                            </td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>

</div>

<!-- Toast Container -->
<div id="toast-container" class="fixed bottom-4 right-4 z-50 space-y-2">
    <div id="toast-message"
        class="hidden flex items-center justify-between p-4 rounded-lg shadow-lg text-white font-semibold">
        <span id="toast-text"></span>
        <button onclick="hideToast()" class="ml-4 text-white hover:text-gray-200 focus:outline-none">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
    </div>
</div>

<script>
<?php if (isset($_GET['accepted'])): ?>
<?php if ($_GET['accepted'] == '1'): ?>
showToast('Pickup request accepted successfully.', 'success');
<?php elseif ($_GET['accepted'] == '0'): ?>
showToast('Failed to accept pickup request. Please try again.', 'error');
<?php endif; ?>
<?php endif; ?>

<?php if (isset($_GET['rejected'])): ?>
<?php if ($_GET['rejected'] == '1'): ?>
showToast('Pickup request rejected successfully.', 'success');
<?php elseif ($_GET['rejected'] == '0'): ?>
showToast('Failed to reject pickup request. Please try again.', 'error');
<?php endif; ?>
<?php endif; ?>

// Remove the query string after toast shows (for a clean URL)
if (window.history.replaceState) {
    const url = new URL(window.location);
    url.searchParams.delete('accepted');
    url.searchParams.delete('rejected');
    window.history.replaceState({}, document.title, url.pathname);
}
// Function to show toast notifications
function showToast(message, type) {
    const toastMessage = document.getElementById('toast-message');
    const toastText = document.getElementById('toast-text');

    // Set message and initial state
    toastText.textContent = message;
    toastMessage.classList.remove('hidden');

    // Remove previous type classes
    toastMessage.classList.remove('toast-success', 'toast-error', 'toast-warning');

    // Add new type class
    if (type === 'success') {
        toastMessage.classList.add('toast-success');
    } else if (type === 'error') {
        toastMessage.classList.add('toast-error');
    } else if (type === 'warning') {
        toastMessage.classList.add('toast-warning');
    }

    // Hide toast after 3 seconds
    setTimeout(() => {
        hideToast();
    }, 3000);
}

// Function to hide toast notifications
function hideToast() {
    document.getElementById('toast-message').classList.add('hidden');
}
</script>
</body>

</html>