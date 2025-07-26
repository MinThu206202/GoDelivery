<?php require_once APPROOT . '/views/inc/agentsidebar.php'; ?>

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
                    <p class="text-lg font-medium text-gray-800">John Doe</p>
                    <p class="text-sm text-gray-500">Agent ID: #007</p>
                </div>
            </div>
            <a href="#" class="px-4 py-2 bg-[#1F265B] text-white rounded-lg hover:bg-[#2A346C] transition-colors duration-200">Back to Dashboard</a>
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
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pickup Location</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Delivery Location</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Customer</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Earnings</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider rounded-tr-lg">Action</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">#ORD1001</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">123 Main St, City A</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">456 Oak Ave, City B</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Sarah Connor</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">$18.00</td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <button onclick="handleAccept('#ORD1001')" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors duration-200">Accept</button>
                            </td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">#ORD1002</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">789 Pine Ln, City C</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">101 Elm Rd, City D</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Kyle Reese</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">$25.50</td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <button onclick="handleAccept('#ORD1002')" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors duration-200">Accept</button>
                            </td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">#ORD1003</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">222 Birch Blvd, City E</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">333 Cedar Dr, City F</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">John Connor</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">$14.75</td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <button onclick="handleAccept('#ORD1003')" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors duration-200">Accept</button>
                            </td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">#ORD1004</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">555 River St, City G</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">666 Lake Dr, City H</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Linda Hamilton</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">$22.00</td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <button onclick="handleAccept('#ORD1004')" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors duration-200">Accept</button>
                            </td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">#ORD1005</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">777 Ocean Ave, City I</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">888 Mountain Rd, City J</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Arnold S.</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">$30.00</td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <button onclick="handleAccept('#ORD1005')" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors duration-200">Accept</button>
                            </td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">#ORD1006</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">999 Valley Cir, City K</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">111 Summit Way, City L</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Grace Hopper</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">$19.50</td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <button onclick="handleAccept('#ORD1006')" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors duration-200">Accept</button>
                            </td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">#ORD1007</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">444 Forest Ave, City M</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">555 Meadow Ln, City N</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Alan Turing</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">$16.00</td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <button onclick="handleAccept('#ORD1007')" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors duration-200">Accept</button>
                            </td>
                        </tr>
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
            // e.g., remove the row, change button to "Accepted", etc.
        } else if (outcome < 0.8) { // 20% chance of something went wrong
            showToast(`Something went wrong with ${orderId}. Please try again.`, 'error');
        } else { // 20% chance of already assigned
            showToast(`Delivery ${orderId} is already assigned to another agent.`, 'warning');
        }
    }
</script>
</body>

</html>