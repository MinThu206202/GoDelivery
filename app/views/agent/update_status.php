<?php require_once APPROOT . '/views/inc/agentsidebar.php'; ?>

<script src="https://cdn.tailwindcss.com"></script>
<!-- Inter Font -->
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<style>
    body {
        font-family: 'Inter', sans-serif;
        background-color: #f3f4f6;
    }
</style>


<!-- Main Content Area -->
<div class="flex-1 flex flex-col overflow-hidden">
    <!-- Header -->
    <header class="flex items-center justify-between p-6 bg-white shadow-md rounded-bl-lg">
        <h1 class="text-3xl font-semibold text-gray-800">Update Delivery Status</h1>
        <div class="flex items-center space-x-4">
            <div class="flex items-center space-x-2">
                <img src="https://placehold.co/40x40/FF6347/FFFFFF?text=JD" alt="Agent Avatar"
                    class="w-10 h-10 rounded-full border-2 border-blue-500">
                <div>
                    <p class="text-lg font-medium text-gray-800">John Doe</p>
                    <p class="text-sm text-gray-500">Agent ID: #007</p>
                </div>
            </div>
            <a href="#"
                class="px-4 py-2 bg-[#1F265B] text-white rounded-lg hover:bg-[#2A346C] transition-colors duration-200">Back
                to Dashboard</a>
        </div>
    </header>

    <!-- Status Update Content -->
    <main class="flex-1 overflow-y-auto p-6 bg-gray-100">
        <div class="max-w-xl mx-auto bg-white p-8 rounded-xl shadow-md">
            <h2 class="text-2xl font-semibold text-gray-800 mb-6">Update Status for Order #ORD1001</h2>

            <div class="space-y-4 mb-8">
                <div>
                    <p class="text-sm text-gray-500">Current Status:</p>
                    <p id="current-status-display" class="text-lg font-semibold text-gray-900">
                        <span
                            class="px-2 inline-flex text-base leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">In
                            Transit</span>
                    </p>
                </div>
                <div>
                    <label for="newDeliveryStatus" class="block text-sm font-medium text-gray-700 mb-1">Select New
                        Status:</label>
                    <select id="newDeliveryStatus"
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-[#1F265B] focus:border-[#1F265B] sm:text-sm">
                        <option value="In Transit" selected>In Transit</option>
                        <option value="Out for Delivery">Out for Delivery</option>
                        <option value="Delivered">Delivered</option>
                        <option value="Attempted Delivery">Attempted Delivery</option>
                        <option value="Cancelled">Cancelled</option>
                    </select>
                </div>
                <div>
                    <label for="statusNotes" class="block text-sm font-medium text-gray-700 mb-1">Notes
                        (Optional):</label>
                    <textarea id="statusNotes" rows="3" placeholder="Add any relevant notes about the status update"
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[#1F265B] focus:border-[#1F265B] sm:text-sm"></textarea>
                </div>
            </div>

            <div class="flex justify-end space-x-4 mt-6">
                <button type="button"
                    class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors duration-200">Cancel</button>
                <button onclick="submitStatusUpdate('ORD1001')"
                    class="px-6 py-2 bg-[#1F265B] text-white rounded-lg hover:bg-[#2A346C] transition-colors duration-200">
                    Update Status
                </button>
            </div>
        </div>
    </main>
</div>

<script>
    function submitStatusUpdate(orderId) {
        const newStatus = document.getElementById('newDeliveryStatus').value;
        const statusNotes = document.getElementById('statusNotes').value;
        const currentStatusDisplay = document.getElementById('current-status-display').querySelector('span');

        // Update the display immediately
        currentStatusDisplay.textContent = newStatus;
        currentStatusDisplay.classList.remove('bg-yellow-100', 'text-yellow-800', 'bg-blue-100', 'text-blue-800', 'bg-green-100', 'text-green-800', 'bg-red-100', 'text-red-800', 'bg-gray-100', 'text-gray-800');

        switch (newStatus) {
            case 'In Transit':
                currentStatusDisplay.classList.add('bg-yellow-100', 'text-yellow-800');
                break;
            case 'Out for Delivery':
                currentStatusDisplay.classList.add('bg-blue-100', 'text-blue-800');
                break;
            case 'Delivered':
                currentStatusDisplay.classList.add('bg-green-100', 'text-green-800');
                break;
            case 'Attempted Delivery':
                currentStatusDisplay.classList.add('bg-red-100', 'text-red-800');
                break;
            case 'Cancelled':
                currentStatusDisplay.classList.add('bg-gray-100', 'text-gray-800');
                break;
            default:
                currentStatusDisplay.classList.add('bg-gray-100', 'text-gray-800');
                break;
        }

        console.log(`Order ${orderId} status updated to: ${newStatus} with notes: "${statusNotes}"`);
        alert(`Status for Order ${orderId} updated to: ${newStatus}`); // Using alert for demo
        // In a real application, you would send this data to a backend API
    }
</script>
</body>

</html>