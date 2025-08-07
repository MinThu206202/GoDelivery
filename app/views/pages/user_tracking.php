<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GoDelivery Tracking Result</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Inter Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Font Awesome for icons (optional, but good for consistency) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8fafc;
            /* Very light background */
            margin: 0;
            padding: 2rem;
            /* Add padding around the main content */
            display: flex;
            justify-content: center;
            align-items: flex-start;
            /* Align to top for longer content */
            min-height: 100vh;
        }

        .main-content-wrapper {
            background-color: #ffffff;
            padding: 2.5rem;
            border-radius: 0.75rem;
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.08);
            max-width: 800px;
            /* Constrain width for better readability */
            width: 100%;
        }

        .info-card {
            background-color: #f8fafc;
            /* Light background for info cards */
            padding: 1.5rem;
            border-radius: 0.75rem;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            border: 1px solid #e2e8f0;
        }

        .status-badge {
            padding: 0.5rem 1rem;
            font-size: 0.95rem;
            font-weight: 600;
            border-radius: 9999px;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.08);
        }

        .status-badge.bg-green-100 {
            color: #166534;
            background-color: #dcfce7;
        }

        /* Delivered */
        .status-badge.bg-blue-100 {
            color: #1e40af;
            background-color: #dbeafe;
        }

        /* In Transit */
        .status-badge.bg-yellow-100 {
            color: #a16207;
            background-color: #fef9c3;
        }

        /* Pending */
        .status-badge.bg-red-100 {
            color: #b91c1c;
            background-color: #fee2e2;
        }

        /* Cancelled */
        .status-badge.bg-purple-100 {
            color: #6b21a8;
            background-color: #f3e8ff;
        }

        /* Return */
        .status-badge.bg-gray-100 {
            color: #4b5563;
            background-color: #e5e7eb;
        }

        /* Default/Unknown */

        /* Styles for status history entries */
        .status-history-item {
            padding: 1rem;
            border-radius: 0.5rem;
            margin-bottom: 0.75rem;
            border: 1px solid #e2e8f0;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        }

        .status-history-item.bg-green-100 {
            background-color: #dcfce7;
        }

        .status-history-item.bg-blue-100 {
            background-color: #dbeafe;
        }

        .status-history-item.bg-yellow-100 {
            background-color: #fef9c3;
        }

        .status-history-item.bg-red-100 {
            background-color: #fee2e2;
        }

        .status-history-item.bg-purple-100 {
            background-color: #f3e8ff;
        }

        .status-history-item.bg-gray-100 {
            background-color: #e5e7eb;
        }
    </style>
</head>

<body>
    <?php
      
        $voucher = $data['tracking_code'] ?? 'N/A';
        $status = $data['update_status'] ?? 'N/A';


        // Function to get status style and icon
        function getStatusStyleAndIcon($statusText)
    {
        switch (strtolower($statusText)) {
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

    <div class="main-content-wrapper">
        <h3 class="text-3xl font-extrabold text-[#1F265B] mb-8 text-center">Tracking Details</h3>

        <!-- Simple input and button to trigger display for demonstration -->
        <!-- This section is for demonstration purposes only, as per your request to remove JS. -->
        <!-- In a real application, this data would come from a backend query based on the 'bolting code'. -->
        <div class="flex flex-col sm:flex-row items-center gap-4 mb-8 p-4 bg-gray-50 rounded-lg border border-gray-200">
            <label for="boltingCodeDisplay" class="text-lg font-medium text-gray-700 whitespace-nowrap">Bolting Code:</label>
            <span id="boltingCodeDisplay" class="flex-grow p-3 border border-gray-300 rounded-lg bg-white text-gray-800 text-base">
                <?= htmlspecialchars($voucher['tracking_code'] ?? 'N/A') ?>
            </span>
        </div>

        <!-- Tracking Result Display Area -->
        <div id="trackingResultDisplay" class="mt-10">
            <!-- Current Status and Order Info -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-y-6 gap-x-10 mb-10">
                <div class="flex flex-col space-y-1">
                    <p class="text-sm text-gray-500 font-medium">Order ID:</p>
                    <p class="text-xl font-bold text-gray-900"><?= htmlspecialchars($voucher['tracking_code'] ?? 'N/A') ?></p>
                </div>
                <div class="flex flex-col space-y-1">
                    <p class="text-sm text-gray-500 font-medium">Current Status:</p>
                    <?php
                    $currentStatus = $voucher['delivery_status'] ?? 'Unknown';
                    $currentStatusStyle = getStatusStyleAndIcon($currentStatus);
                    ?>
                    <p class="text-xl font-bold text-gray-900">
                        <span class="status-badge shadow-md <?= $currentStatusStyle['bg'] ?> <?= $currentStatusStyle['text'] ?>">
                            <?= $currentStatusStyle['icon'] ?>
                            <?= htmlspecialchars($currentStatus) ?>
                        </span>
                    </p>
                </div>
                <div class="flex flex-col space-y-1">
                    <p class="text-sm text-gray-500 font-medium">Assigned Driver:</p>
                    <p class="text-xl font-semibold text-gray-900"><?= htmlspecialchars($voucher['sender_agent_name'] ?? 'N/A') ?></p>
                </div>
                <div class="flex flex-col space-y-1">
                    <p class="text-sm text-gray-500 font-medium">Estimated Delivery:</p>
                    <p class="text-xl font-semibold text-gray-900"><?= htmlspecialchars($voucher['duration'] ?? 'N/A') ?></p>
                </div>
            </div>

            <!-- Sender Information -->
            <div class="mb-10 info-card">
                <h3 class="text-2xl font-semibold text-gray-800 border-b-2 border-gray-200 pb-3 mb-5">Sender Information</h3>
                <div class="space-y-3 text-lg">
                    <p><strong class="font-medium text-gray-700">Name:</strong> <?= htmlspecialchars($voucher['sender_customer_name'] ?? 'N/A') ?></p>
                    <p><strong class="font-medium text-gray-700">Phone:</strong> <?= htmlspecialchars($voucher['sender_customer_phone'] ?? 'N/A') ?></p>
                    <p><strong class="font-medium text-gray-700">Email:</strong> <?= htmlspecialchars($voucher['sender_customer_email'] ?? 'N/A') ?></p>
                    <p><strong class="font-medium text-gray-700">Address:</strong> <?= htmlspecialchars($voucher['sender_customer_address'] ?? 'N/A') ?></p>
                </div>
            </div>

            <!-- Recipient Information -->
            <div class="mb-10 info-card">
                <h3 class="text-2xl font-semibold text-gray-800 border-b-2 border-gray-200 pb-3 mb-5">Recipient Information</h3>
                <div class="space-y-3 text-lg">
                    <p><strong class="font-medium text-gray-700">Name:</strong> <?= htmlspecialchars($voucher['receiver_customer_name'] ?? 'N/A') ?></p>
                    <p><strong class="font-medium text-gray-700">Phone:</strong> <?= htmlspecialchars($voucher['receiver_customer_phone'] ?? 'N/A') ?></p>
                    <p><strong class="font-medium text-gray-700">Email:</strong> <?= htmlspecialchars($voucher['receiver_customer_email'] ?? 'N/A') ?></p>
                    <p><strong class="font-medium text-gray-700">Address:</strong> <?= htmlspecialchars($voucher['receiver_customer_address'] ?? 'N/A') ?></p>
                </div>
            </div>

            <!-- Package Details -->
            <div class="mb-10 info-card">
                <h3 class="text-2xl font-semibold text-gray-800 border-b-2 border-gray-200 pb-3 mb-5">Package Details</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-y-3 gap-x-10 text-lg">
                    <p><strong class="font-medium text-gray-700">Weight:</strong> <?= htmlspecialchars($voucher['weight'] ?? 'N/A') ?></p>
                    <p><strong class="font-medium text-gray-700">Amount:</strong> <?= htmlspecialchars($voucher['amount'] ?? 'N/A') ?></p>
                    <p><strong class="font-medium text-gray-700">Duration Time:</strong> <?= htmlspecialchars($voucher['duration'] ?? 'N/A') ?></p>
                    <p><strong class="font-medium text-gray-700">Product Type:</strong> <?= htmlspecialchars($voucher['product_type'] ?? 'N/A') ?></p>
                </div>
            </div>

            <!-- Status Update History Section -->
            <div class="mb-10 info-card">
                <h3 class="text-2xl font-semibold text-gray-800 border-b-2 border-gray-200 pb-3 mb-5">Status Update History</h3>
                <div class="space-y-4" id="statusHistoryContainer">
                    <?php
                    $hasNonPending = false;
                    if (is_array($status)) {
                        foreach ($status as $history) {
                            if (isset($history['status']) && strtolower($history['status']) !== 'pending') {
                                $hasNonPending = true;
                                break;
                            }
                        }
                    }
                    ?>

                    <?php if ($hasNonPending): ?>
                        <?php foreach ($status as $history): ?>
                            <?php if (isset($history['status']) && strtolower($history['status']) !== 'pending'): ?>
                                <?php
                                $style = getStatusStyleAndIcon($history['status']);
                                ?>
                                <div class="p-4 rounded-md border <?= $style['bg'] ?> <?= str_replace('bg-', 'border-', $style['bg']) ?>">
                                    <p class="text-lg font-semibold <?= $style['text'] ?>">
                                        <?= $style['icon'] ?>
                                        Status: <?= htmlspecialchars($history['status'] ?? 'N/A') ?>
                                    </p>
                                    <p class="text-sm text-gray-700 mt-1">
                                        Reason: <?= htmlspecialchars($history['note'] ?? 'No reason provided.') ?>
                                    </p>
                                    <p class="text-xs text-gray-500 mt-2">
                                        Updated by: <span class="font-medium"><?= htmlspecialchars($history['changed_by'] ?? 'Unknown Agent') ?></span>
                                        at <span class="font-medium"><?= htmlspecialchars($history['changed_at'] ?? 'N/A') ?></span>
                                    </p>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p class="text-gray-600 text-center py-4">No status update history available.</p>
                    <?php endif; ?>
                </div>
            </div>

            <div class="flex justify-center space-x-4 mt-10">
                <button onclick="window.history.back()"
                    class="px-8 py-3 bg-gray-500 text-white rounded-lg shadow-lg hover:bg-gray-600 transition-all duration-300 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-opacity-50">
                    Back
                </button>
                <button onclick="window.print()"
                    class="px-8 py-3 bg-gray-600 text-white rounded-lg shadow-lg hover:bg-gray-700 transition-all duration-300 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-opacity-50">
                    Print Delivery Details
                </button>
            </div>
        </div>

        <!-- No Result Found Message (Initially Hidden) -->
        <!-- This section is for demonstration purposes only, as per your request to remove JS. -->
        <!-- In a real application, this would be conditionally displayed by PHP if $voucher is empty. -->
        <?php if (!$voucher): ?>
            <div id="noResultFound" class="text-center p-8 bg-white rounded-xl shadow-md mx-auto max-w-sm">
                <h2 class="text-2xl font-semibold text-gray-800 mb-4">No Tracking Information Found</h2>
                <p class="text-gray-600 mb-4">
                    The bolting code entered did not yield any results. Please ensure you entered it correctly.
                </p>
            </div>
        <?php endif; ?>

    </div>

</body>

</html>