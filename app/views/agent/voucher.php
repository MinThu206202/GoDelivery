<?php

use Soap\Url;

require_once APPROOT . '/views/inc/agentsidebar.php'; ?>

<script src="https://cdn.tailwindcss.com"></script>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
body {
    font-family: 'Inter', sans-serif;
    background-color: #f3f4f6;
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
            <form method="POST" action="<?= URLROOT; ?>/agentcontroller/voucher">
                <?php require APPROOT . '/views/components/auth_message.php'; ?>

                <input type="hidden" name="agent_data" value='<?= json_encode($_SESSION['user']); ?>'>
                <div class="mb-8">
                    <h2 class="text-xl font-semibold text-gray-800 border-b pb-2 mb-4">Sender Information (Customer)
                    </h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-y-4 gap-x-8">
                        <div>
                            <label for="senderName" class="block text-sm text-gray-500">Name:</label>
                            <input type="text" name="sender_name" id="senderName" placeholder="Enter sender's name"
                                class="text-lg font-medium text-gray-900 border border-gray-300 rounded-md p-2 w-full focus:outline-none focus:ring-2 focus:ring-[#1F265B]">
                        </div>
                        <div>
                            <label for="senderPhone" class="block text-sm text-gray-500">Phone:</label>
                            <input type="tel" name="sender_phone" id="senderPhone"
                                placeholder="Enter sender's phone number"
                                class="text-gray-700 border border-gray-300 rounded-md p-2 w-full focus:outline-none focus:ring-2 focus:ring-[#1F265B]">
                        </div>
                        <div>
                            <label for="senderEmail" class="block text-sm text-gray-500">Email:</label>
                            <input type="email" name="sender_email" id="senderEmail" placeholder="Enter sender's email"
                                class="text-gray-700 border border-gray-300 rounded-md p-2 w-full focus:outline-none focus:ring-2 focus:ring-[#1F265B]">
                        </div>
                        <div class="md:col-span-2">
                            <label for="senderAddress" class="block text-sm text-gray-500">Address:</label>
                            <textarea id="senderAddress" name="sender_address" rows="2"
                                placeholder="Enter sender's address"
                                class="text-gray-700 border border-gray-300 rounded-md p-2 w-full focus:outline-none focus:ring-2 focus:ring-[#1F265B]"></textarea>
                        </div>
                    </div>
                </div>

                <!-- Recipient Information -->
                <div class="mb-8">
                    <h2 class="text-xl font-semibold text-gray-800 border-b pb-2 mb-4">Recipient Information</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-y-4 gap-x-8">
                        <div>
                            <label for="recipientName" class="block text-sm text-gray-500">Name:</label>
                            <input type="text" name="receiver_name" id="recipientName"
                                placeholder="Enter recipient's name"
                                class="text-lg font-medium text-gray-900 border border-gray-300 rounded-md p-2 w-full focus:outline-none focus:ring-2 focus:ring-[#1F265B]">
                        </div>
                        <div>
                            <label for="recipientPhone" class="block text-sm text-gray-500">Phone:</label>
                            <input type="tel" name="receiver_phone" id="recipientPhone"
                                placeholder="Enter recipient's phone number"
                                class="text-gray-700 border border-gray-300 rounded-md p-2 w-full focus:outline-none focus:ring-2 focus:ring-[#1F265B]">
                        </div>
                        <div>
                            <label for="recipientEmail" class="block text-sm text-gray-500">Email:</label>
                            <input type="email" name="receiver_email" id="recipientEmail"
                                placeholder="Enter recipient's email"
                                class="text-gray-700 border border-gray-300 rounded-md p-2 w-full focus:outline-none focus:ring-2 focus:ring-[#1F265B]">
                        </div>
                        <div class="md:col-span-2">
                            <label for="recipientAddress" class="block text-sm text-gray-500"></label>
                            <textarea id="recipientAddress" name="receiver_address" rows="2"
                                placeholder="Enter recipient's address"
                                class="text-gray-700 border border-gray-300 rounded-md p-2 w-full focus:outline-none focus:ring-2 focus:ring-[#1F265B]"></textarea>
                        </div>
                    </div>
                </div>

                <!-- Package Details -->
                <div class="mb-8">
                    <h2 class="text-xl font-semibold text-gray-800 border-b pb-2 mb-4">Package Details</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-y-4 gap-x-8 mb-4">
                        <div>
                            <label for="packageWeight" class="block text-sm text-gray-500">Weight (kg):</label>
                            <input type="number" name="weight" id="packageWeight" step="0.1"
                                placeholder="Enter package weight"
                                class="text-lg font-medium text-gray-900 border border-gray-300 rounded-md p-2 w-full focus:outline-none focus:ring-2 focus:ring-[#1F265B]">
                        </div>
                        <div>
                            <label for="numberofpiece" class="block text-sm text-gray-500">Number of Piece</label>
                            <input type="number" name="piece" id="numberofpiece" step="0.1"
                                placeholder="Enter Number of Piece"
                                class="text-lg font-medium text-gray-900 border border-gray-300 rounded-md p-2 w-full focus:outline-none focus:ring-2 focus:ring-[#1F265B]">
                        </div>
                        <div>
                            <label for="deliveryType" class="block text-sm text-gray-500">Delivery Type:</label>
                            <select id="deliveryType" name="delivery_type"
                                class="text-gray-700 border border-gray-300 rounded-md p-2 w-full focus:outline-none focus:ring-2 focus:ring-[#1F265B]">
                                <option value="" disabled selected>Select Delivery Type</option>
                                <option value="1">Normal</option>
                                <option value="2">Express</option>
                                <option value="3">In-City</option>
                                <option value="4">Important</option>
                            </select>
                        </div>
                        <div id="importantNoteContainer" class="hidden md:col-span-2">
                            <p class="text-sm text-red-600 mt-1 p-2 bg-red-50 rounded-md border border-red-200">
                                **Important:** Selecting "Important/Import" means your delivery is faster and will
                                increase an **extra cost** more than normal cost.
                            </p>
                        </div>
                        <div>
                            <label for="deliveryType" class="block text-sm text-gray-500">Payment Details</label>
                            <select id="paymentType" name="payment"
                                class="text-lg font-medium text-gray-900 border border-gray-300 rounded-md p-2 w-full focus:outline-none focus:ring-2 focus:ring-[#1F265B]">
                                <option value=1>Sender Pay</option>
                                <option value=2>Receiver Pay</option>
                            </select>
                        </div>
                    </div>
                    <label for="productType" class="block text-sm text-gray-500 mt-4">Product Type:</label>
                    <textarea id="productType" name="product_type" rows="2"
                        placeholder="Any special delivery instructions"
                        class="text-gray-700 border border-gray-300 rounded-md p-2 w-full focus:outline-none focus:ring-2 focus:ring-[#1F265B]"></textarea>
                </div>

                <!-- Agent Cities & Payment -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <div>
                        <h2 class="text-xl font-semibold text-gray-800 border-b pb-2 mb-4">Agent Locations</h2>
                        <div class="space-y-4">
                            <div>
                                <label for="senderAgentRegion" class="block text-sm text-gray-500">Receiver Agent
                                    Region:</label>
                                <select id="senderAgentRegion" name="senderAgentRegion"
                                    class="text-gray-700 border border-gray-300 rounded-md p-2 w-full focus:outline-none focus:ring-2 focus:ring-[#1F265B]">
                                    <option value="" disabled selected>Select Region</option>
                                    <?php foreach ($data['region'] as $region) : ?>
                                    <option value="<?= htmlspecialchars($region['id']); ?>">
                                        <?= htmlspecialchars($region['name']); ?>
                                    </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div>
                                <label for="senderAgentCity" class="block text-sm text-gray-500">Receiver Agent
                                    City:</label>
                                <select id="senderAgentCity" name="senderAgentCity"
                                    class="text-gray-700 border border-gray-300 rounded-md p-2 w-full focus:outline-none focus:ring-2 focus:ring-[#1F265B]">
                                    <option value="" disabled selected>Select City</option>
                                </select>
                            </div>
                            <div>
                                <label for="senderAgentTownship" class="block text-sm text-gray-500">Receiver Agent
                                    Township:</label>
                                <select id="senderAgentTownship" name="senderAgentTownship"
                                    class="text-gray-700 border border-gray-300 rounded-md p-2 w-full focus:outline-none focus:ring-2 focus:ring-[#1F265B]">
                                    <option value="" disabled selected>Select Township</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>



                <!-- Action Buttons -->
                <div class="flex justify-end space-x-4 mt-6 no-print">
                    <button type="submit"
                        class="px-6 py-2 bg-[#1F265B] text-white rounded-lg hover:bg-[#2A346C] transition-colors duration-200">
                        Save Voucher
                    </button>
                </div>
            </form>

            <!-- Footer -->
            <div class="text-center text-gray-600 text-sm pt-6 border-t border-gray-200 mt-6">
                <p>&copy; 2024 Delivery Management System. All rights reserved.</p>
                <p>Thank you for choosing our service!</p>
            </div>
        </div>
    </main>
</div>

<script>
const $ = id => document.getElementById(id);

// Generic function to load select options
const loadOptions = (url, targetSelect, placeholder) => {
    targetSelect.innerHTML = `<option value="">${placeholder}</option>`;
    if (!url) return;

    fetch(url)
        .then(res => res.json())
        .then(items => {
            items.forEach(item => {
                const opt = document.createElement('option');
                opt.value = item.id;
                opt.textContent = item.name;
                targetSelect.appendChild(opt);
            });
        })
        .catch(err => console.error('Error loading options:', err));
};

// Region → City
$('senderAgentRegion').addEventListener('change', function() {
    const regionId = this.value;
    loadOptions(`<?= URLROOT; ?>/agent/getCitiesByRegion?region_id=${regionId}`, $('senderAgentCity'),
        'Select City');
    $('senderAgentTownship').innerHTML = '<option value="">Select Township</option>';
});

// City → Township
$('senderAgentCity').addEventListener('change', function() {
    const cityId = this.value;
    loadOptions(`<?= URLROOT; ?>/agent/getTownshipsByCity?city_id=${cityId}`, $('senderAgentTownship'),
        'Select Township');
});

// Delivery Type logic
const deliveryTypeHandler = () => {
    const type = $('deliveryType').value;
    const importantNote = $('importantNoteContainer');
    const agentLocation = document.querySelector(
        '.voucher-container .grid.grid-cols-1.md\\:grid-cols-2.gap-6.mb-8');

    importantNote.classList.toggle('hidden', type !== '4'); // Important
    agentLocation.classList.toggle('hidden', type === '3'); // In-City
};

$('deliveryType').addEventListener('change', deliveryTypeHandler);
</script>



</body>

</html>