<?php require_once APPROOT . '/views/inc/agentsidebar.php';
$agent = $data['tracking_code'];

?>

<script src="https://cdn.tailwindcss.com"></script>
<!-- Inter Font -->
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<style>
    body {
        font-family: 'Inter', sans-serif;
        background-color: #f3f4f6;
    }

    /* Custom alert box styling */
    .custom-alert {
        position: fixed;
        top: 20px;
        left: 50%;
        transform: translateX(-50%);
        padding: 1rem 2rem;
        border-radius: 0.5rem;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        z-index: 1000;
        display: flex;
        align-items: center;
        gap: 1rem;
        opacity: 0;
        /* Start hidden for animation */
        transition: opacity 0.3s ease-in-out;
    }

    .custom-alert.show {
        opacity: 1;
        /* Show when 'show' class is added */
    }

    .custom-alert.success {
        background-color: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
    }

    .custom-alert.error {
        background-color: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
    }

    .custom-alert-close {
        cursor: pointer;
        font-weight: bold;
        font-size: 1.2rem;
        margin-left: auto;
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
        <!-- Message Box Container -->
        <div id="message-box-container"></div>

        <div class="max-w-xl mx-auto bg-white p-8 rounded-xl shadow-md">
            <h2 class="text-2xl font-semibold text-gray-800 mb-6">Update Status for Order <?= htmlspecialchars($agent['tracking_code']) ?></h2>

            <div class="space-y-4 mb-8">
                <div>
                    <p class="text-sm text-gray-500">Current Status:</p>
                    <p id="current-status-display" class="text-lg font-semibold text-gray-900">
                        <span id="status-badge"
                            class="px-2 inline-flex text-base leading-5 font-semibold rounded-full">
                            <?= htmlspecialchars($agent['delivery_status']) ?>
                        </span>
                    </p>
                </div>
                <div>
                    <label for="newDeliveryStatus" class="block text-sm font-medium text-gray-700 mb-1">Select New
                        Status:</label>
                    <select id="newDeliveryStatus"
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-[#1F265B] focus:border-[#1F265B] sm:text-sm">
                        <option value="1">Pending</option>
                        <option value="2">In Transit</option>
                        <!-- <option value="3">Delivered</option> -->
                        <option value="4">Cancelled</option>
                        <!-- <option value="5">Returned</option> -->
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
                    onclick="window.location.href='<?= URLROOT ?>/agent/mydelivery';"
                    class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors duration-200">
                    Cancel
                </button> <button onclick="submitStatusUpdate('<?= htmlspecialchars($agent['tracking_code']) ?>')"
                    class="px-6 py-2 bg-[#1F265B] text-white rounded-lg hover:bg-[#2A346C] transition-colors duration-200">
                    Update Status
                </button>
            </div>
        </div>
    </main>
</div>

<!-- Hidden POST form -->
<form id="postStatusForm" method="POST" action="<?= URLROOT ?>/agentcontroller/show_updated_status" style="display: none;">
    <input type="hidden" name="tracking_code" value="<?= htmlspecialchars($agent['tracking_code']) ?>">
    <input type="hidden" name="new_status" id="form-new-status">
    <input type="hidden" name="notes" id="form-notes">
</form>

<script>
    /**
     * Applies Tailwind CSS classes for background and text color based on the delivery status.
     * @param {HTMLElement} element - The span element to apply classes to.
     * @param {string} status - The delivery status text (e.g., "Pending", "Delivered").
     */
    function applyStatusColors(element, status) {
        // Remove all existing color classes to ensure a clean slate
        element.classList.remove(
            'bg-yellow-100', 'text-yellow-800',
            'bg-blue-100', 'text-blue-800',
            'bg-green-100', 'text-green-800',
            'bg-red-100', 'text-red-800',
            'bg-gray-100', 'text-gray-800'
        );

        // Apply new classes based on the status
        switch (status) {
            case 'Pending':
                element.classList.add('bg-yellow-100', 'text-yellow-800');
                break;
            case 'In Transit':
                element.classList.add('bg-blue-100', 'text-blue-800');
                break;
            case 'Delivered':
                element.classList.add('bg-green-100', 'text-green-800');
                break;
            case 'Cancelled':
                element.classList.add('bg-red-100', 'text-red-800'); // Using red for cancelled
                break;
            case 'Returned':
                element.classList.add('bg-gray-100', 'text-gray-800'); // Using gray for returned
                break;
            default:
                // Default color if status is unrecognized
                element.classList.add('bg-gray-100', 'text-gray-800');
                break;
        }
    }

    /**
     * Displays a custom alert message.
     * @param {string} message - The message to display.
     * @param {string} type - The type of message ('success' or 'error').
     */
    function showCustomAlert(message, type) {
        const container = document.getElementById('message-box-container');
        if (!container) return;

        // Create the alert element
        const alertDiv = document.createElement('div');
        alertDiv.className = `custom-alert ${type}`;
        alertDiv.innerHTML = `
            <span>${message}</span>
            <span class="custom-alert-close" onclick="this.parentElement.remove()">&times;</span>
        `;
        container.appendChild(alertDiv);

        // Add 'show' class after a short delay to trigger fade-in animation
        setTimeout(() => alertDiv.classList.add('show'), 10);

        // Automatically remove the alert after 5 seconds
        setTimeout(() => {
            if (alertDiv.parentElement) {
                alertDiv.classList.remove('show'); // Trigger fade-out
                alertDiv.addEventListener('transitionend', () => alertDiv.remove(), {
                    once: true
                });
            }
        }, 5000);
    }

    /**
     * Handles the initial display of the current status color on page load and checks for URL messages.
     */
    document.addEventListener('DOMContentLoaded', () => {
        const statusBadge = document.getElementById('status-badge');
        const initialStatusText = statusBadge.textContent.trim();
        applyStatusColors(statusBadge, initialStatusText);

        // Set the initial selected option in the dropdown based on the current status text
        const newDeliveryStatusSelect = document.getElementById('newDeliveryStatus');
        const options = newDeliveryStatusSelect.options;
        for (let i = 0; i < options.length; i++) {
            if (options[i].text === initialStatusText) { // Match by text content
                options[i].selected = true;
                break;
            }
        }

        // Check for success/error messages in URL parameters
        const urlParams = new URLSearchParams(window.location.search);
        const messageType = urlParams.get('message_type');
        const message = urlParams.get('message');

        if (messageType && message) {
            showCustomAlert(decodeURIComponent(message), messageType);
            // Clean the URL to remove the message parameters
            history.replaceState(null, '', window.location.pathname + window.location.hash);
        }
    });

    /**
     * Submits the status update by populating a hidden form and submitting it.
     * @param {string} trackingCode - The tracking code of the order.
     */
    function submitStatusUpdate(trackingCode) {
        const newDeliveryStatusSelect = document.getElementById('newDeliveryStatus');
        // Get the VALUE of the selected option (e.g., "1", "2") for the backend
        const newStatusValue = newDeliveryStatusSelect.value;
        // Get the TEXT of the selected option (e.g., "Pending", "In Transit") for local display
        const newStatusText = newDeliveryStatusSelect.options[newDeliveryStatusSelect.selectedIndex].text;
        const statusNotes = document.getElementById('statusNotes').value;
        const statusBadge = document.getElementById('status-badge');

        // Update the displayed status text and color on the current page (before redirect)
        statusBadge.textContent = newStatusText;
        applyStatusColors(statusBadge, newStatusText);

        // Populate the hidden form fields with the data to be sent via POST
        document.getElementById('form-new-status').value = newStatusValue; // Send the numeric value
        document.getElementById('form-notes').value = statusNotes;

        // Submit the hidden form, which will navigate to the PHP endpoint
        document.getElementById('postStatusForm').submit();
    }
</script>
</body>

</html>