<?php
require_once APPROOT . '/views/inc/agentsidebar.php';

// Get the tracking code from the URL parameter
$voucher = $data['tracking_code'] ?? 'N/A';
$status = $data['update_status'] ?? 'N/A';


// Dummy agent data for the header if not available from session or $data
$agent = $_SESSION['user'] ?? ['name' => 'Agent Name', 'id' => 'AGENT001']; // Added agent ID for update form
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delivery Tracking Result</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Inter Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f3f4f6;
            /* Light gray background */
        }

        /* Header specific styles to match the image */
        header {
            background-color: #ffffff;
            /* White background for header */
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            /* Subtle shadow */
            border-bottom-left-radius: 0.5rem;
            /* Rounded bottom-left corner */
        }

        /* Main content area background */
        main {
            background-color: #f3f4f6;
            /* Light gray background for main content */
            /* Ensure main content is centered and takes available space */
            flex-grow: 1;
            /* Allow it to grow and fill space vertically */
            padding: 1.5rem;
            /* Consistent padding around the content */
            overflow-y: auto;
            /* Keep scrolling for long content */
            /* Removed display: flex, align-items, justify-content to allow mx-auto on child to work reliably */
        }

        /* Card styles for information sections */
        .info-card {
            background-color: #ffffff;
            /* White background for info cards */
            padding: 1.5rem;
            /* Padding inside cards */
            border-radius: 0.75rem;
            /* Rounded corners */
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            /* Medium shadow */
            border: 1px solid #e5e7eb;
            /* Light gray border */
        }

        /* Styles for print */
        @media print {
            body {
                background-color: #fff;
                padding: 0 !important;
                overflow: visible !important;
                height: auto !important;
                display: block;
            }

            .no-print {
                display: none !important;
            }

            .printable-area {
                box-shadow: none !important;
                border: 1px solid #ccc !important;
                margin: 0 auto !important;
                width: 100% !important;
                max-width: 700px !important;
                min-height: auto !important;
                padding: 0.75rem !important;
            }

            .printable-area h1 {
                font-size: 2rem !important;
            }

            .printable-area h2 {
                font-size: 1.25rem !important;
            }

            .printable-area p,
            .printable-area span,
            .printable-area strong {
                font-size: 0.8rem !important;
                line-height: 1.2 !important;
            }
        }
    </style>
</head>

<div class="flex-1 flex flex-col overflow-hidden">

    <!-- Header -->
    <header class="flex items-center justify-between p-6 bg-white shadow-md rounded-bl-lg no-print">
        <h1 class="text-3xl font-semibold text-gray-800">Delivery Details</h1>
        <div x-data="{ open: false }" class="relative">
            <!-- Button-like Trigger -->
            <button
                @click="open = !open"
                class="flex items-center space-x-2 bg-white border border-gray-300 px-4 py-2 rounded-lg shadow-sm hover:bg-gray-100 transition">
                <img src="/Delivery/<?= htmlspecialchars($agent['profile_image']) ?>"
                    alt="Agent Avatar"
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
            <div
                x-show="open"
                @click.away="open = false"
                x-transition
                class="absolute right-0 mt-2 w-48 bg-white border border-gray-200 rounded-lg shadow-lg py-2 z-50">
                <!-- Profile -->
                <a href="<?= URLROOT; ?>/agent/profile"
                    class="block px-4 py-2 text-gray-700 hover:bg-gray-100 transition">
                    Profile
                </a>

                <!-- Divider -->
                <div class="border-t my-1"></div>

                <!-- Logout -->
                <a href="<?= URLROOT; ?>/agent/logout"
                    class="block px-4 py-2 text-gray-700 hover:bg-gray-100 transition">
                    Logout
                </a>
            </div>
        </div>

        <!-- Alpine.js -->
        <script src="//unpkg.com/alpinejs" defer></script>

    </header>

    <!-- Tracking Content -->
    <main class="flex-1 overflow-y-auto p-6 bg-gray-100">
        <div class="max-w-4xl w-full bg-white p-8 rounded-xl shadow-2xl border border-gray-200 mx-auto">
            <?php if ($voucher): ?>
                <div class="printable-area">
                    <h2 class="text-3xl font-extrabold text-[#1F265B] mb-8 text-center">Order
                        <?= htmlspecialchars($voucher['tracking_code']) ?> Details</h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-y-6 gap-x-10 mb-10">
                        <div class="flex flex-col space-y-1">
                            <p class="text-sm text-gray-500 font-medium">Order ID:</p>
                            <p class="text-xl font-bold text-gray-900"><?= htmlspecialchars($voucher['tracking_code']) ?>
                            </p>
                        </div>
                        <div class="flex flex-col space-y-1">
                            <p class="text-sm text-gray-500 font-medium">Current Status:</p>
                            <?php
                            $statusClass = '';
                            switch ($voucher['delivery_status']) {
                                case 'Pending':
                                    $statusClass = 'bg-gray-100 text-gray-800';
                                    break;
                                case 'Awaiting Acceptance':
                                    $statusClass = 'bg-yellow-100 text-yellow-800';
                                    break;
                                case 'Rejected':
                                    $statusClass = 'bg-red-100 text-red-800';
                                    break;
                                case 'In Transit':
                                    $statusClass = 'bg-blue-100 text-blue-800';
                                    break;
                                case 'Delivered':
                                    $statusClass = 'bg-green-100 text-green-800';
                                    break;
                                case 'Return':
                                    $statusClass = 'bg-purple-100 text-purple-800';
                                    break;
                                case 'Cancelled':
                                    $statusClass = 'bg-rose-100 text-rose-800';
                                    break;
                                case 'Failed Delivery':
                                    $statusClass = 'bg-orange-100 text-orange-800';
                                    break;
                                default:
                                    $statusClass = 'bg-gray-100 text-gray-800';
                                    break;
                            }
                            ?>
                            <p class="text-xl font-bold text-gray-900">
                                <span
                                    class="px-4 py-2 inline-flex text-base leading-5 font-semibold rounded-full <?= $statusClass ?> shadow-md">
                                    <?= htmlspecialchars($voucher['delivery_status']) ?>
                                </span>
                            </p>
                        </div>
                        <div class="flex flex-col space-y-1">
                            <p class="text-sm text-gray-500 font-medium">Assigned Driver:</p>
                            <p class="text-xl font-semibold text-gray-900">
                                <?= htmlspecialchars($voucher['sender_agent_name']) ?></p>
                        </div>
                        <div class="flex flex-col space-y-1">
                            <p class="text-sm text-gray-500 font-medium">Estimated Delivery:</p>
                            <p class="text-xl font-semibold text-gray-900"><?= htmlspecialchars($voucher['duration']) ?></p>
                        </div>
                    </div>

                    <div class="mb-10 p-6 bg-gray-50 rounded-lg border border-gray-200 info-card">
                        <h3 class="text-2xl font-semibold text-gray-800 border-b-2 border-gray-200 pb-3 mb-5">Sender
                            Information</h3>
                        <div class="space-y-3 text-lg">
                            <p><strong class="font-medium text-gray-700">Name:</strong>
                                <?= htmlspecialchars($voucher['sender_customer_name']) ?></p>
                            <p><strong class="font-medium text-gray-700">Phone:</strong>
                                <?= htmlspecialchars($voucher['sender_customer_phone']) ?></p>
                            <p><strong class="font-medium text-gray-700">Email:</strong>
                                <?= htmlspecialchars($voucher['sender_customer_email']) ?></p>
                            <p><strong class="font-medium text-gray-700">Address:</strong>
                                <?= htmlspecialchars($voucher['sender_customer_address']) ?>,
                                <?= htmlspecialchars($voucher['from_township_name']) ?></p>
                        </div>
                    </div>

                    <div class="mb-10 p-6 bg-gray-50 rounded-lg border border-gray-200 info-card">
                        <h3 class="text-2xl font-semibold text-gray-800 border-b-2 border-gray-200 pb-3 mb-5">Recipient
                            Information</h3>
                        <div class="space-y-3 text-lg">
                            <p><strong class="font-medium text-gray-700">Name:</strong>
                                <?= htmlspecialchars($voucher['receiver_customer_name']) ?></p>
                            <p><strong class="font-medium text-gray-700">Phone:</strong>
                                <?= htmlspecialchars($voucher['receiver_customer_phone']) ?></p>
                            <p><strong class="font-medium text-gray-700">Email:</strong>
                                <?= htmlspecialchars($voucher['receiver_customer_email']) ?></p>
                            <p><strong class="font-medium text-gray-700">Address:</strong>
                                <?= htmlspecialchars($voucher['receiver_customer_address']) ?>,
                                <?= htmlspecialchars($voucher['to_township_name']) ?></p>
                        </div>
                    </div>

                    <!-- Pickup Location Information -->
                    <div class="mb-10 p-6 bg-gray-50 rounded-lg border border-gray-200 info-card">
                        <h3 class="text-2xl font-semibold text-gray-800 border-b-2 border-gray-200 pb-3 mb-5">Pickup
                            Location</h3>
                        <div class="space-y-3 text-lg">
                            <p><strong class="font-medium text-gray-700">Pickup Agent Name:</strong>
                                <?= htmlspecialchars($voucher['receiver_agent_name']) ?></p>
                            <p><strong class="font-medium text-gray-700">Pickup Agent Phone:</strong>
                                <?= htmlspecialchars($voucher['receiver_agent_phone']) ?></p>
                            <p><strong class="font-medium text-gray-700">Pickup Agent Address:</strong>
                                <?= htmlspecialchars($voucher['receiver_agent_address']) ?>,
                                <?= htmlspecialchars($voucher['from_township_name']) ?></p>
                        </div>
                    </div>

                    <div class="mb-10 p-6 bg-gray-50 rounded-lg border border-gray-200 info-card">
                        <h3 class="text-2xl font-semibold text-gray-800 border-b-2 border-gray-200 pb-3 mb-5">Package
                            Details</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-y-3 gap-x-10 text-lg">
                            <p><strong class="font-medium text-gray-700">Weight:</strong>
                                <?= htmlspecialchars($voucher['weight']) ?></p>
                            <p><strong class="font-medium text-gray-700">Amount:</strong>
                                <?= htmlspecialchars($voucher['amount']) ?></p>
                            <p><strong class="font-medium text-gray-700">Duration Time:</strong>
                                <?= htmlspecialchars($voucher['duration']) ?></p>
                            <p><strong class="font-medium text-gray-700">Product Type:</strong>
                                <?= htmlspecialchars($voucher['product_type']) ?></p>
                        </div>
                    </div>

                    <?php
                    function getStatusStyleAndIcon($status)
                    {
                        switch (strtolower($status)) {
                            case 'delivered':
                                return [
                                    'bg' => 'bg-green-100',
                                    'text' => 'text-green-800',
                                    'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="inline-block w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" /></svg>'
                                ];
                            case 'in transit':
                                return [
                                    'bg' => 'bg-blue-100',
                                    'text' => 'text-blue-800',
                                    'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="inline-block w-5 h-5 mr-2 animate-spin" fill="none" viewBox="0 0 24 24" stroke="currentColor"><circle cx="12" cy="12" r="10" stroke-width="4" class="opacity-25" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="4" d="M4 12a8 8 0 018-8v8H4z" /></svg>'
                                ];
                            case 'pending':
                                return [
                                    'bg' => 'bg-gray-100',
                                    'text' => 'text-gray-800',
                                    'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="inline-block w-5 h-5 mr-2 animate-pulse" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6l4 2" /></svg>'
                                ];
                            case 'awaiting acceptance':
                                return [
                                    'bg' => 'bg-yellow-100',
                                    'text' => 'text-yellow-800',
                                    'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="inline-block w-5 h-5 mr-2" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l2 2m6-2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>'
                                ];
                            case 'cancelled':
                                return [
                                    'bg' => 'bg-rose-100',
                                    'text' => 'text-rose-800',
                                    'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="inline-block w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><line x1="18" y1="6" x2="6" y2="18" stroke-width="3" stroke-linecap="round" /><line x1="6" y1="6" x2="18" y2="18" stroke-width="3" stroke-linecap="round" /></svg>'
                                ];
                            case 'rejected':
                                return [
                                    'bg' => 'bg-red-100',
                                    'text' => 'text-red-800',
                                    'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="inline-block w-5 h-5 mr-2" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg>'
                                ];
                            case 'return':
                                return [
                                    'bg' => 'bg-purple-100',
                                    'text' => 'text-purple-800',
                                    'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="inline-block w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M3 10h11M9 21l7-11-7-11" /></svg>'
                                ];
                            case 'failed delivery':
                                return [
                                    'bg' => 'bg-orange-100',
                                    'text' => 'text-orange-800',
                                    'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="inline-block w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M12 2a10 10 0 100 20 10 10 0 000-20z" /></svg>'
                                ];
                            default:
                                return [
                                    'bg' => 'bg-gray-100',
                                    'text' => 'text-gray-800',
                                    'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="inline-block w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><circle cx="12" cy="12" r="10" stroke-width="2" /></svg>'
                                ];
                        }
                    }
                    ?>
                    <!-- Status Update History Section -->

                    <div class="mb-10 p-6 rounded-lg border info-card">
                        <h3 class="text-2xl font-semibold text-gray-800 border-b-2 border-gray-200 pb-3 mb-5">Status Update
                            History</h3>
                        <div class="space-y-4">
                            <?php
                            $hasNonPending = false;
                            foreach ($status as $history) {
                                if (strtolower($history['status']) !== 'pending') {
                                    $hasNonPending = true;
                                    break;
                                }
                            }
                            ?>

                            <?php if ($hasNonPending): ?>
                                <?php foreach ($status as $history): ?>
                                    <?php if (strtolower($history['status']) !== 'pending'): ?>
                                        <?php
                                        $style = getStatusStyleAndIcon($history['status']);
                                        ?>
                                        <div
                                            class="p-4 rounded-md border <?= $style['bg'] ?> <?= str_replace('bg-', 'border-', $style['bg']) ?>">
                                            <p class="text-lg font-semibold <?= $style['text'] ?>">
                                                <?= $style['icon'] ?>
                                                Status: <?= htmlspecialchars($history['status'] ?? 'N/A') ?>
                                            </p>
                                            <p class="text-sm text-gray-700 mt-1">
                                                Reason: <?= htmlspecialchars($history['note'] ?? 'No reason provided.') ?>
                                            </p>
                                            <p class="text-xs text-gray-500 mt-2">
                                                Updated by: <span
                                                    class="font-medium"><?= htmlspecialchars($history['changed_by'] ?? 'Unknown Agent') ?></span>
                                                at <span
                                                    class="font-medium"><?= htmlspecialchars($history['changed_at'] ?? 'N/A') ?></span>
                                            </p>
                                        </div>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <p class="text-gray-600 text-center py-4">No status update history available.</p>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="flex justify-center space-x-4 mt-10 no-print">
                        <button onclick="window.print()"
                            class="px-8 py-3 bg-gray-500 text-white rounded-lg shadow-lg hover:bg-gray-600 transition-colors duration-300 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-opacity-50">
                            Print Delivery Details
                        </button>
                    </div>
                </div>
            <?php else: ?>
                <div class="text-center p-8 bg-white rounded-xl shadow-md mx-auto max-w-sm">
                    <h2 class="text-2xl font-semibold text-gray-800 mb-4">No Tracking Information Found</h2>
                    <p class="text-gray-600 mb-4">
                        The tracking code "<?php echo is_array($voucher) && isset($voucher['tracking_code']) ?
                                                htmlspecialchars($voucher['tracking_code']) : 'N/A'; ?>" did not yield
                        any results.
                        Please ensure you entered it correctly.
                    </p>
                    <a href="<?= URLROOT; ?>/agent/home"
                        class="mt-6 inline-block px-6 py-3 bg-[#1F265B] text-white rounded-lg hover:bg-[#2A346C] transition-colors duration-200">
                        Back to Dashboard
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </main>



    </body>

</html>