<?php require_once APPROOT . '/views/inc/agentsidebar.php'; ?>

<script src="https://cdn.tailwindcss.com"></script>
<!-- Inter Font -->
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<style>
    body {
        font-family: 'Inter', sans-serif;
        background-color: #f3f4f6;
        /* Removed centering and padding from body to allow sidebar to align correctly */
        /* display: flex; justify-content: center; align-items: flex-start; min-height: 100vh; padding: 2rem; */
    }

    /* Styles for print */
    @media print {
        body {
            background-color: #fff;
            padding: 0 !important;
            /* Ensure no padding on body for print */
            overflow: visible !important;
            /* Allow content to flow without scrollbars */
            height: auto !important;
            /* Allow body to expand to content height */
        }

        .no-print {
            display: none !important;
        }

        .voucher-container {
            box-shadow: none !important;
            /* Remove shadow for print */
            border: 1px solid #ccc !important;
            /* Add a border for print */
            margin: 0 !important;
            /* Remove auto margins for print */
            width: 100% !important;
            /* Take full width */
            max-width: none !important;
            /* Remove max-width restriction */
            min-height: auto !important;
            /* Allow height to adjust */
            padding: 1rem !important;
            /* Add some padding inside the voucher for print */
        }

        /* Ensure main content area also allows full content flow */
        main {
            overflow-y: visible !important;
            flex: none !important;
            /* Remove flex-1 property */
            height: auto !important;
            /* Allow height to adjust */
            padding: 0 !important;
            /* Remove padding from main for print */
        }

        /* Ensure table cells with inputs look clean when printed */
        input,
        textarea,
        select {
            border: none !important;
            padding: 0 !important;
            background-color: transparent !important;
            box-shadow: none !important;
            outline: none !important;
        }

        .printable-input-cell input,
        .printable-input-cell textarea {
            width: 100%;
            display: block;
            border: none !important;
            background: none !important;
            padding: 0 !important;
            margin: 0 !important;
            font-size: inherit;
            line-height: inherit;
            color: inherit;
        }
    }
</style>


<!-- Main Content Area -->
<div class="flex-1 flex flex-col overflow-hidden">
    <!-- Header -->
    <header class="flex items-center justify-between p-6 bg-white shadow-md rounded-bl-lg no-print">
        <h1 class="text-3xl font-semibold text-gray-800">Delivery Voucher</h1>
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

    <!-- Voucher Content -->
    <main class="flex-1 overflow-y-auto p-6 bg-gray-100">
        <div class="voucher-container bg-white p-8 rounded-xl shadow-lg max-w-6xl w-full mx-auto">
            <!-- Header -->
            <div class="flex justify-between items-center border-b-2 border-gray-200 pb-4 mb-6">
                <h1 class="text-4xl font-bold text-[#1F265B]">Delivery Voucher</h1>
                <img src="https://placehold.co/80x80/1F265B/FFFFFF?text=DMS" alt="Company Logo"
                    class="h-20 w-20 rounded-lg">
            </div>

            <!-- Sender Information -->
            <div class="mb-8">
                <h2 class="text-xl font-semibold text-gray-800 border-b pb-2 mb-4">Sender Information (Customer)
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-y-4 gap-x-8">
                    <div>
                        <label for="senderName" class="block text-sm text-gray-500">Name:</label>
                        <input type="text" id="senderName" value="Sender Logistics Co."
                            class="text-lg font-medium text-gray-900 border border-gray-300 rounded-md p-2 w-full focus:outline-none focus:ring-2 focus:ring-[#1F265B]">
                    </div>
                    <div>
                        <label for="senderPhone" class="block text-sm text-gray-500">Phone:</label>
                        <input type="tel" id="senderPhone" value="+1 (111) 222-3333"
                            class="text-gray-700 border border-gray-300 rounded-md p-2 w-full focus:outline-none focus:ring-2 focus:ring-[#1F265B]">
                    </div>
                    <div>
                        <label for="senderEmail" class="block text-sm text-gray-500">Email:</label>
                        <input type="email" id="senderEmail" value="sender@example.com"
                            class="text-gray-700 border border-gray-300 rounded-md p-2 w-full focus:outline-none focus:ring-2 focus:ring-[#1F265B]">
                    </div>
                    <div>
                        <label for="senderRegion" class="block text-sm text-gray-500">Region:</label>
                        <input type="text" id="senderRegion" value="North America"
                            class="text-gray-700 border border-gray-300 rounded-md p-2 w-full focus:outline-none focus:ring-2 focus:ring-[#1F265B]">
                    </div>
                    <div class="md:col-span-2">
                        <label for="senderCities" class="block text-sm text-gray-500">Cities:</label>
                        <input type="text" id="senderCities" value="Anytown, USA"
                            class="text-gray-700 border border-gray-300 rounded-md p-2 w-full focus:outline-none focus:ring-2 focus:ring-[#1F265B]">
                    </div>
                    <div class="md:col-span-2">
                        <label for="senderAddress" class="block text-sm text-gray-500">Address:</label>
                        <textarea id="senderAddress" rows="2"
                            class="text-gray-700 border border-gray-300 rounded-md p-2 w-full focus:outline-none focus:ring-2 focus:ring-[#1F265B]">123 Main Street</textarea>
                    </div>
                </div>
            </div>

            <!-- Recipient Information -->
            <div class="mb-8">
                <h2 class="text-xl font-semibold text-gray-800 border-b pb-2 mb-4">Recipient Information</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-y-4 gap-x-8">
                    <div>
                        <label for="recipientName" class="block text-sm text-gray-500">Name:</label>
                        <input type="text" id="recipientName" value="Emily White"
                            class="text-lg font-medium text-gray-900 border border-gray-300 rounded-md p-2 w-full focus:outline-none focus:ring-2 focus:ring-[#1F265B]">
                    </div>
                    <div>
                        <label for="recipientPhone" class="block text-sm text-gray-500">Phone:</label>
                        <input type="tel" id="recipientPhone" value="+1 (444) 555-6666"
                            class="text-gray-700 border border-gray-300 rounded-md p-2 w-full focus:outline-none focus:ring-2 focus:ring-[#1F265B]">
                    </div>
                    <div>
                        <label for="recipientEmail" class="block text-sm text-gray-500">Email:</label>
                        <input type="email" id="recipientEmail" value="emily.white@example.com"
                            class="text-gray-700 border border-gray-300 rounded-md p-2 w-full focus:outline-none focus:ring-2 focus:ring-[#1F265B]">
                    </div>
                    <div>
                        <label for="recipientRegion" class="block text-sm text-gray-500">Region:</label>
                        <input type="text" id="recipientRegion" value="West Coast"
                            class="text-gray-700 border border-gray-300 rounded-md p-2 w-full focus:outline-none focus:ring-2 focus:ring-[#1F265B]">
                    </div>
                    <div class="md:col-span-2">
                        <label for="recipientCities" class="block text-sm text-gray-500">Cities:</label>
                        <input type="text" id="recipientCities" value="Villagetown, USA"
                            class="text-gray-700 border border-gray-300 rounded-md p-2 w-full focus:outline-none focus:ring-2 focus:ring-[#1F265B]">
                    </div>
                    <div class="md:col-span-2">
                        <label for="recipientAddress" class="block text-sm text-gray-500">Address:</label>
                        <textarea id="recipientAddress" rows="2"
                            class="text-gray-700 border border-gray-300 rounded-md p-2 w-full focus:outline-none focus:ring-2 focus:ring-[#1F265B]">456 Oak Avenue</textarea>
                    </div>
                </div>
            </div>

            <!-- Package Details -->
            <div class="mb-8">
                <h2 class="text-xl font-semibold text-gray-800 border-b pb-2 mb-4">Package Details</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-y-4 gap-x-8 mb-4">
                    <div>
                        <label for="packageWeight" class="block text-sm text-gray-500">Weight (kg):</label>
                        <input type="number" id="packageWeight" value="2.5" step="0.1"
                            class="text-lg font-medium text-gray-900 border border-gray-300 rounded-md p-2 w-full focus:outline-none focus:ring-2 focus:ring-[#1F265B]">
                    </div>
                    <div>
                        <label for="packageTotal" class="block text-sm text-gray-500">Total ($):</label>
                        <input type="number" id="packageTotal" value="50.00" step="0.01"
                            class="text-lg font-medium text-gray-900 border border-gray-300 rounded-md p-2 w-full focus:outline-none focus:ring-2 focus:ring-[#1F265B]">
                    </div>
                    <div class="md:col-span-2">
                        <label for="packageDescription" class="block text-sm text-gray-500">Overall
                            Description:</label>
                        <textarea id="packageDescription" rows="3"
                            class="text-gray-700 border border-gray-300 rounded-md p-2 w-full focus:outline-none focus:ring-2 focus:ring-[#1F265B]">A mix of electronics and books. Fragile items included.</textarea>
                    </div>
                </div>
                <!-- Removed the table for Item and Quantity -->
                <label for="specialInstructions" class="block text-sm text-gray-500 mt-4">Special
                    Instructions:</label>
                <textarea id="specialInstructions" rows="2"
                    class="text-gray-700 border border-gray-300 rounded-md p-2 w-full focus:outline-none focus:ring-2 focus:ring-[#1F265B]">Leave at front door if no answer.</textarea>
            </div>

            <!-- Agent Cities & Payment -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <div>
                    <h2 class="text-xl font-semibold text-gray-800 border-b pb-2 mb-4">Agent Locations</h2>
                    <div class="space-y-4">
                        <div>
                            <label for="senderAgentCities" class="block text-sm text-gray-500">Sender Agent
                                City:</label>
                            <input type="text" id="senderAgentCities" value="New York"
                                class="text-gray-700 border border-gray-300 rounded-md p-2 w-full focus:outline-none focus:ring-2 focus:ring-[#1F265B]">
                        </div>
                        <div>
                            <label for="receiverAgentCities" class="block text-sm text-gray-500">Receiver Agent
                                City:</label>
                            <input type="text" id="receiverAgentCities" value="Los Angeles"
                                class="text-700 border border-gray-300 rounded-md p-2 w-full focus:outline-none focus:ring-2 focus:ring-[#1F265B]">
                        </div>
                    </div>
                </div>
                <div>
                    <h2 class="text-xl font-semibold text-gray-800 border-b pb-2 mb-4">Payment Details</h2>
                    <label for="paymentType" class="block text-sm text-gray-500">Payment Type:</label>
                    <select id="paymentType"
                        class="text-lg font-medium text-gray-900 border border-gray-300 rounded-md p-2 w-full focus:outline-none focus:ring-2 focus:ring-[#1F265B]">
                        <option value="Prepaid">Prepaid</option>
                        <option value="Pay on Delivery">Pay on Delivery</option>
                    </select>
                </div>
            </div>

            <!-- Delivery Status -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <div>
                    <h2 class="text-xl font-semibold text-gray-800 border-b pb-2 mb-4">Delivery Status</h2>
                    <label for="deliveryStatus" class="block text-sm text-gray-500">Status:</label>
                    <select id="deliveryStatus"
                        class="text-lg font-medium text-gray-900 border border-gray-300 rounded-md p-2 w-full mb-2 focus:outline-none focus:ring-2 focus:ring-[#1F265B]">
                        <option value="In Transit">In Transit</option>
                        <option value="Delivered">Delivered</option>
                        <option value="Pending">Pending</option>
                        <option value="Cancelled">Cancelled</option>
                    </select>
                    <label for="estimatedDelivery" class="block text-sm text-gray-500">Estimated Delivery:</label>
                    <input type="datetime-local" id="estimatedDelivery" value="2024-07-26T17:00"
                        class="text-gray-700 border border-gray-300 rounded-md p-2 w-full focus:outline-none focus:ring-2 focus:ring-[#1F265B]">
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex justify-end space-x-4 mt-6 no-print">
                <button onclick="window.print()"
                    class="px-6 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition-colors duration-200">
                    Print Voucher
                </button>
                <button
                    class="px-6 py-2 bg-[#1F265B] text-white rounded-lg hover:bg-[#2A346C] transition-colors duration-200">
                    Save Voucher
                </button>
            </div>

            <!-- Footer -->
            <div class="text-center text-gray-600 text-sm pt-6 border-t border-gray-200 mt-6">
                <p>&copy; 2024 Delivery Management System. All rights reserved.</p>
                <p>Thank you for choosing our service!</p>
            </div>
        </div>
    </main>
</div>

</body>

</html>