<?php require_once APPROOT . '/views/inc/agentsidebar.php';
$voucher = $data['create_data'];
?>

<script src="https://cdn.tailwindcss.com"></script>
<!-- Inter Font -->
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
        display: block;
        /* Override flex for print to avoid layout issues */
    }

    .no-print {
        display: none !important;
    }

    #printable-voucher {
        box-shadow: none !important;
        /* Remove shadow for print */
        border: 1px solid #ccc !important;
        /* Add a border for print */
        margin: 0 auto !important;
        /* Center the voucher on the page */
        width: 100% !important;
        /* Ensure it takes available width within max-width */
        max-width: 700px !important;
        /* Increased max-width for print */
        min-height: auto !important;
        /* Allow height to adjust */
        padding: 0.75rem !important;
        /* Reduce padding for print */
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

    /* Adjust font sizes for print */
    #printable-voucher h1 {
        font-size: 2rem !important;
        /* Smaller h1 */
    }

    #printable-voucher h2 {
        font-size: 1.25rem !important;
        /* Smaller h2 */
    }

    #printable-voucher label,
    #printable-voucher input,
    #printable-voucher textarea,
    #printable-voucher select,
    #printable-voucher p,
    #printable-voucher span,
    #printable-voucher strong,
    #printable-voucher div:not(.grid) {
        /* Target direct text containers */
        font-size: 0.8rem !important;
        /* Smaller text for all content */
        line-height: 1.2 !important;
        /* Tighter line spacing */
    }

    #printable-voucher .text-lg {
        font-size: 0.9rem !important;
        /* Adjust specific large texts */
    }

    #printable-voucher .text-sm {
        font-size: 0.7rem !important;
        /* Adjust specific small texts */
    }

    #printable-voucher .text-xs {
        font-size: 0.6rem !important;
        /* Adjust specific extra small texts */
    }

    /* Ensure form elements look clean when printed */
    input,
    textarea,
    select {
        border: none !important;
        padding: 0 !important;
        background-color: transparent !important;
        box-shadow: none !important;
        outline: none !important;
    }

    /* Ensure inputs don't take up too much space */
    #printable-voucher input,
    #printable-voucher textarea,
    #printable-voucher select {
        min-height: auto !important;
        /* Prevent minimum height issues */
    }
}
</style>


<!-- Main Content Area -->
<div class="flex-1 flex flex-col overflow-hidden">
    <!-- Header -->
    <header class="flex items-center justify-between p-6 bg-white shadow-md rounded-bl-lg no-print">
        <h1 class="text-3xl font-semibold text-gray-800">Delivery Details</h1>
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

    <!-- Delivery Details Content -->
    <main class="flex-1 overflow-y-auto p-6 bg-gray-100">
        <div id="printable-voucher" class="max-w-4xl mx-auto bg-white p-8 rounded-xl shadow-md">
            <h2 class="text-2xl font-semibold text-gray-800 mb-6">Order
                <?= htmlspecialchars($voucher['tracking_code']) ?></h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-y-4 gap-x-8 mb-8">
                <div>
                    <p class="text-sm text-gray-500">Order ID:</p>
                    <p class="text-lg font-semibold text-gray-900"><?= htmlspecialchars($voucher['tracking_code']) ?>
                    </p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Current Status:</p>
                    <p class="text-lg font-semibold text-gray-900">
                        <span
                            class="px-2 inline-flex text-base leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">In
                            <?= htmlspecialchars($voucher['delivery_status']) ?></span>
                    </p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Assigned Driver:</p>
                    <p class="text-lg font-semibold text-gray-900">
                        <?= htmlspecialchars($voucher['sender_agent_name']) ?></p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Estimated Delivery:</p>
                    <p class="text-lg font-semibold text-gray-900">
                        <?= htmlspecialchars($voucher['duration']) ?></p>
                </div>
            </div>

            <div class="mb-8">
                <h3 class="text-xl font-semibold text-gray-800 border-b pb-2 mb-4">Sender Information</h3>
                <div class="space-y-2">
                    <p><strong class="text-gray-700">Name:</strong>
                        <?= htmlspecialchars($voucher['sender_customer_name']) ?></p>
                    <p><strong class="text-gray-700">Phone:</strong>
                        <?= htmlspecialchars($voucher['sender_customer_phone']) ?></p>
                    <p><strong class="text-gray-700">Email:</strong>
                        <?= htmlspecialchars($voucher['sender_customer_email']) ?></p>
                    <p><strong class="text-gray-700">Address:</strong>
                        <?= htmlspecialchars($voucher['sender_customer_address']) ?><?= htmlspecialchars($voucher['from_region_name']) ?>
                    </p>
                </div>
            </div>

            <div class="mb-8">
                <h3 class="text-xl font-semibold text-gray-800 border-b pb-2 mb-4">Recipient Information</h3>
                <div class="space-y-2">
                    <p><strong
                            class="text-gray-700">Name:</strong><?= htmlspecialchars($voucher['receiver_customer_name']) ?>
                    </p>
                    <p><strong class="text-gray-700">Phone:</strong>
                        <?= htmlspecialchars($voucher['receiver_customer_phone']) ?></p>
                    <p><strong class="text-gray-700">Email:</strong>
                        <?= htmlspecialchars($voucher['receiver_customer_email']) ?></p>
                    <p><strong class="text-gray-700">Address:</strong>
                        <?= htmlspecialchars($voucher['receiver_customer_address']) ?><?= htmlspecialchars($voucher['to_region_name']) ?>
                    </p>
                </div>
            </div>

            <!-- Pickup Location Information -->
            <div class="mb-8">
                <h3 class="text-xl font-semibold text-gray-800 border-b pb-2 mb-4">Pickup Location</h3>
                <div class="space-y-2">
                    <p><strong class="text-gray-700">Pickup Agent
                            Name:</strong><?= htmlspecialchars($voucher['receiver_agent_name']) ?></p>
                    <p><strong class="text-gray-700">Pickup Agent Phone:</strong>
                        <?= htmlspecialchars($voucher['receiver_agent_phone']) ?></p>
                    <p><strong class="text-gray-700">Pickup Agent Address:</strong>
                        <?= htmlspecialchars($voucher['receiver_agent_address']) ?>,<?= htmlspecialchars($voucher['to_region_name']) ?>
                    </p>
                </div>
            </div>

            <div class="mb-8">
                <h3 class="text-xl font-semibold text-gray-800 border-b pb-2 mb-4">Package Details</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-y-2 gap-x-8">
                    <p><strong class="text-gray-700">Weight:</strong><?= htmlspecialchars($voucher['weight']) ?></p>
                    <p><strong class="text-gray-700">Amount:</strong> <?= htmlspecialchars($voucher['amount']) ?></p>
                    <p><strong class="text-gray-700">Duration Time:</strong>
                        <?= htmlspecialchars($voucher['duration']) ?></p>
                    <p><strong class="text-gray-700">Product Type:</strong>
                        <?= htmlspecialchars($voucher['product_type']) ?></p>
                </div>
            </div>

            <div class="mb-8">
                <h3 class="text-xl font-semibold text-gray-800 border-b pb-2 mb-4">Package Details</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-y-2 gap-x-8">
                    <p><strong class="text-gray-700">Weight:</strong><?= htmlspecialchars($voucher['weight']) ?></p>
                    <p><strong class="text-gray-700">Amount:</strong> <?= htmlspecialchars($voucher['amount']) ?></p>
                    <p><strong class="text-gray-700">Duration Time:</strong>
                        <?= htmlspecialchars($voucher['duration']) ?></p>
                    <p><strong class="text-gray-700">Product Type:</strong>
                        <?= htmlspecialchars($voucher['product_type']) ?></p>
                </div>
            </div>

            <div class="flex justify-end space-x-4 mt-6 no-print">
                <button onclick="printVoucher()"
                    class="px-6 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition-colors duration-200">
                    Print Voucher
                </button>
                <!-- Changed "Edit Delivery" button to "Go to Dashboard" link -->
                <a href="<?= URLROOT; ?>/agent/home"
                    class="px-6 py-2 bg-[#1F265B] text-white rounded-lg hover:bg-[#2A346C] transition-colors duration-200">
                    Go to Dashboard
                </a>
            </div>
        </div>
    </main>
</div>


<script>
function printVoucher() {
    // Get only voucher content
    const printContent = document.getElementById('printable-voucher').innerHTML;

    // Open a new window for clean print
    const win = window.open('', '', 'height=700,width=900');
    win.document.write(`
            <html>
                <head>
                    <title>Print Voucher</title>
                    <link href="https://cdn.tailwindcss.com" rel="stylesheet">
                    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
                    <style>
                        body { font-family: 'Inter', sans-serif; background: #fff; padding: 20px; }
                        @media print { .no-print { display: none !important; } }
                    </style>
                </head>
                <body>
                    ${printContent}
                </body>
            </html>
        `);

    win.document.close();
    win.focus();
    win.print();
    win.close();
}
</script>

</body>

</html>