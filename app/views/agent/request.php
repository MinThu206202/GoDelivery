<?php require_once APPROOT . '/views/inc/agentsidebar.php'; ?>

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
        <h1 class="text-3xl font-semibold text-gray-800">Available Deliveries</h1>
        <div class="flex items-center space-x-4">
            <div class="flex items-center space-x-2">
                <img src="https://placehold.co/40x40/FF6347/FFFFFF?text=JD" alt="Agent Avatar" class="w-10 h-10 rounded-full border-2 border-blue-500">
                <div>
                    <p class="text-lg font-medium text-gray-800"><?= htmlspecialchars($agent['name']) ?></p>
                    <p class="text-sm text-gray-500">Agent ID: #007</p>
                </div>
            </div>
        </div>
    </header>

    <!-- Available Deliveries Content -->
    <main class="flex-1 overflow-y-auto p-6 bg-gray-100">
        <div class="max-w-6xl mx-auto bg-white p-8 rounded-xl shadow-md">
            <h2 class="text-2xl font-semibold text-gray-800 mb-6">New Delivery Requests</h2>
            <!-- Added max-h-96 and overflow-y-auto for scrollability -->
            <div class="overflow-x-auto overflow-y-auto max-h-96">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50 sticky top-0">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider rounded-tl-lg">Order ID</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Sender Agent</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pickup Location</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Sender Customer</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Creation Date</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider rounded-tr-lg">Action</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php foreach ($data['request_delivery'] as $res): ?>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><?= htmlspecialchars($res['tracking_code'] ?? '') ?></td>

                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= htmlspecialchars($res['receiver_agent_name'] ?? 'N/A') ?></td>

                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= htmlspecialchars($res['sender_agent_city'] ?? 'N/A') ?></td>


                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= htmlspecialchars($res['sender_customer_name'] ?? 'N/A') ?></td>

                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?= htmlspecialchars($res['created_at'] ?? '0.00') ?></td>

                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium flex items-center justify-end space-x-2">
                                    <a href="<?= URLROOT; ?>/agentcontroller/delivery_detail/<?= htmlspecialchars($res['tracking_code'] ?? '') ?>"
                                        class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200">
                                        View
                                    </a>
                                    <form action="<?= URLROOT; ?>/agentcontroller/requestaccept" method="POST" style="display: inline;">
                                        <input type="hidden" name="tracking_code" value="<?= $res['tracking_code'] ?>">
                                        <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors duration-200">
                                            Accept
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</div>

<!-- Toast Container -->
<div id="toast-container" class="fixed bottom-4 right-4 z-50 space-y-2">
    <div id="toast-message" class="hidden flex items-center justify-between p-4 rounded-lg shadow-lg text-white font-semibold">
        <span id="toast-text"></span>
        <button onclick="hideToast()" class="ml-4 text-white hover:text-gray-200 focus:outline-none">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
    </div>
</div>

<script>

        <?php if (isset($_GET['accepted'])): ?>
    <?php if ($_GET['accepted'] == '1'): ?>
        showToast('Delivery accepted successfully.', 'success');
    <?php elseif ($_GET['accepted'] == '0'): ?>
        showToast('Failed to accept delivery. Please try again.', 'error');
    <?php endif; ?>
    <?php endif; ?>
    
    // Remove the query string after toast shows (for a clean URL)
    if (window.history.replaceState) {
        const url = new URL(window.location);
        url.searchParams.delete('accepted');
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

    // Simulate accepting a delivery
    function handleAccept(orderId) {
        // Simulate an asynchronous operation (e.g., API call)
        console.log(`Attempting to accept delivery: ${orderId}`);

        // Randomly determine outcome for demonstration
        const outcome = Math.random();

        if (outcome < 0.6) { // 60% chance of success
            showToast(`Delivery ${orderId} accepted successfully.`, 'success');
            // In a real application, you would update the UI to reflect the accepted delivery
            // e.g., remove the row, change button to "Accepted" , etc.
        } else if (outcome < 0.8) { // 20% chance of something went wrong
            showToast(`Something went wrong with ${orderId}. Please try again.`, 'error');
        } else { // 20% chance of already assigned
            showToast(`Delivery ${orderId} is already assigned to another agent.`, 'warning');
        }
    }
</script>
</body>

</html>