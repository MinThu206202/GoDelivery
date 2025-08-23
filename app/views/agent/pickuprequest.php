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
        <div class="flex items-center space-x-4">
            <div class="flex items-center space-x-2">
                <img src="/Delivery/<?= htmlspecialchars($agent['profile_image']) ?>" alt="Agent Avatar"
                    class="w-10 h-10 rounded-full border-2 border-blue-500">
                <div>
                    <p class="text-lg font-medium text-gray-800"><?= htmlspecialchars($agent['name']) ?></p>
                    <p class="text-sm text-gray-500">Agent ID: <?= htmlspecialchars($agent['access_code']) ?></p>
                </div>
            </div>
        </div>
    </header>

    <!-- Pickup Requests Content -->
    <main class="flex-1 overflow-y-auto p-6 bg-gray-100">
        <div class="max-w-6xl mx-auto bg-white p-8 rounded-xl shadow-md">
            <h2 class="text-2xl font-semibold text-gray-800 mb-6">Available Pickup Requests</h2>
            <!-- Adjusted max-height and overflow for scrollability -->
            <div class="overflow-x-auto overflow-y-auto h-[500px]">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50 sticky top-0">
                        <tr>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider rounded-tl-lg">
                                Request ID </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Customer Name</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Pickup Location</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Contact Number</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Requested Date & Time</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Parcel Status</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider rounded-tr-lg">
                                Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200 h-full">
                        <?php if (!empty($data['pickup_requests'])): ?>
                            <?php foreach ($data['pickup_requests'] as $res): ?>

                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        <?= htmlspecialchars($res['request_code'] ?? '') ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <?= htmlspecialchars($res['sender_name'] ?? 'N/A') ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <?= htmlspecialchars($res['sender_city'] ?? 'N/A') ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <?= htmlspecialchars($res['sender_phone'] ?? '0.00') ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        <?= htmlspecialchars($res['created_at'] ?? '0.00') ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        <?php
                                        $status = $res['status'] ?? '';

                                        // assign bg color based on status
                                        $statusClasses = [
                                            'pending'          => 'bg-yellow-100 text-yellow-800',
                                            'accepted'         => 'bg-blue-100 text-blue-800',
                                            'collected'        => 'bg-purple-100 text-purple-800',
                                            'voucher_created'  => 'bg-indigo-100 text-indigo-800',
                                            'delivered'        => 'bg-green-100 text-green-800',
                                            'arrived_office'   => 'bg-teal-100 text-teal-800',
                                            'rejected'         => 'bg-red-100 text-red-800',
                                            'agent_checked'    => 'bg-pink-100 text-pink-800',
                                            'awaiting_payment' => 'bg-orange-100 text-orange-800',
                                            'payment_success'  => 'bg-emerald-100 text-emerald-800',
                                            'default'          => 'bg-gray-100 text-gray-800'
                                        ];

                                        $class = $statusClasses[$status] ?? 'bg-gray-100 text-gray-800';
                                        ?>
                                        <span class="px-3 py-1 inline-flex text-xs font-semibold rounded-full <?= $class ?>">
                                            <?= htmlspecialchars($status) ?>
                                        </span>
                                    </td>

                                    <td
                                        class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium flex items-center justify-end space-x-2">
                                        <!-- View Button -->
                                        <a href="<?= URLROOT; ?>/agent/pickup_detail?request_code=<?= htmlspecialchars($res['request_code']) ?>"
                                            class="px-4 py-2 bg-[#1F265B] text-white rounded-lg hover:bg-[#2A346C] transition-colors duration-200">
                                            View
                                        </a>
                                        <!-- Edit Button -->
                                        <a href="<?= URLROOT; ?>/agent/action?request_code=<?= htmlspecialchars($res['request_code']) ?>"
                                            class="px-4 py-2 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600 transition-colors duration-200">
                                            Actions
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="7" class="px-6 py-8 text-center text-gray-500 text-sm">
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