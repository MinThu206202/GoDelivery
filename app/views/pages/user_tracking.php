<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GoDelivery Tracking Result</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Inter Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
    body {
        font-family: 'Inter', sans-serif;
        background-color: #f8fafc;
        margin: 0;
        padding: 2rem;
        display: flex;
        justify-content: center;
        align-items: flex-start;
        min-height: 100vh;
    }

    .main-content-wrapper {
        background-color: #ffffff;
        padding: 2.5rem;
        border-radius: 0.75rem;
        box-shadow: 0 6px 16px rgba(0, 0, 0, 0.08);
        max-width: 800px;
        width: 100%;
    }

    .info-card {
        background-color: #f8fafc;
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

    /* Status colors */
    .status-badge.bg-green-100 {
        color: #166534;
        background-color: #dcfce7;
    }

    .status-badge.bg-blue-100 {
        color: #1e40af;
        background-color: #dbeafe;
    }

    .status-badge.bg-yellow-100 {
        color: #a16207;
        background-color: #fef9c3;
    }

    .status-badge.bg-red-100 {
        color: #b91c1c;
        background-color: #fee2e2;
    }

    .status-badge.bg-purple-100 {
        color: #6b21a8;
        background-color: #f3e8ff;
    }

    .status-badge.bg-gray-100 {
        color: #4b5563;
        background-color: #e5e7eb;
    }

    /* Status history entries */
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
    $voucher = $data['tracking_code'] ?? null;
    $status = $data['update_status'] ?? [];
    $code = $data['code'];


    // Function to get status style and icon
    function getStatusStyleAndIcon($statusText)
    {
        switch (strtolower($statusText)) {
            case 'delivered':
                return ['bg' => 'bg-green-100', 'text' => 'text-green-800', 'icon' => '<i class="fas fa-check-circle mr-2"></i>'];
            case 'in transit':
                return ['bg' => 'bg-blue-100', 'text' => 'text-blue-800', 'icon' => '<i class="fas fa-truck mr-2 animate-spin"></i>'];
            case 'pending':
                return ['bg' => 'bg-gray-100', 'text' => 'text-gray-800', 'icon' => '<i class="fas fa-clock mr-2 animate-pulse"></i>'];
            case 'awaiting acceptance':
                return ['bg' => 'bg-yellow-100', 'text' => 'text-yellow-800', 'icon' => '<i class="fas fa-hourglass-half mr-2"></i>'];
            case 'cancelled':
                return ['bg' => 'bg-rose-100', 'text' => 'text-rose-800', 'icon' => '<i class="fas fa-times-circle mr-2"></i>'];
            case 'rejected':
                return ['bg' => 'bg-red-100', 'text' => 'text-red-800', 'icon' => '<i class="fas fa-ban mr-2"></i>'];
            case 'return':
                return ['bg' => 'bg-purple-100', 'text' => 'text-purple-800', 'icon' => '<i class="fas fa-undo mr-2"></i>'];
            case 'failed delivery':
                return ['bg' => 'bg-orange-100', 'text' => 'text-orange-800', 'icon' => '<i class="fas fa-exclamation-triangle mr-2"></i>'];
            default:
                return ['bg' => 'bg-gray-100', 'text' => 'text-gray-800', 'icon' => '<i class="fas fa-question-circle mr-2"></i>'];
        }
    }
    ?>

    <?php if (empty($voucher) || !is_array($voucher)): ?>
    <!-- No Tracking Found -->
    <div class="text-center p-8 bg-white rounded-xl shadow-md mx-auto max-w-sm">
        <h2 class="text-2xl font-semibold text-gray-800 mb-4">No Tracking Information Found</h2>
        <p class="text-gray-600 mb-4">
            The tracking code
            "<span class="font-semibold text-red-600"><?= isset($code) ? htmlspecialchars($code) : 'N/A' ?></span>"
            did not yield any results. Please ensure you entered it correctly.
        </p>
        <a href="<?= URLROOT; ?>/pages/index"
            class="mt-6 inline-block px-6 py-3 bg-[#1F265B] text-white rounded-lg hover:bg-[#2A346C] transition-colors duration-200">
            Back to Dashboard
        </a>
    </div>
    <?php else: ?>
    <!-- Tracking Details -->
    <div class="main-content-wrapper">
        <h3 class="text-3xl font-extrabold text-[#1F265B] mb-8 text-center">Tracking Details</h3>

        <!-- Bolting Code -->
        <div class="flex flex-col sm:flex-row items-center gap-4 mb-8 p-4 bg-gray-50 rounded-lg border border-gray-200">
            <label class="text-lg font-medium text-gray-700 whitespace-nowrap">Bolting Code:</label>
            <span class="flex-grow p-3 border border-gray-300 rounded-lg bg-white text-gray-800 text-base">
                <?= htmlspecialchars($voucher['tracking_code'] ?? 'N/A') ?>
            </span>
        </div>

        <!-- Current Status -->
        <?php
            $currentStatus = $voucher['delivery_status'] ?? 'Unknown';
            $currentStatusStyle = getStatusStyleAndIcon($currentStatus);
            ?>
        <div class="flex flex-col space-y-1 mb-10">
            <p class="text-sm text-gray-500 font-medium">Current Status:</p>
            <span class="status-badge shadow-md <?= $currentStatusStyle['bg'] ?> <?= $currentStatusStyle['text'] ?>">
                <?= $currentStatusStyle['icon'] ?><?= htmlspecialchars($currentStatus) ?>
            </span>
        </div>

        <!-- Sender Info -->
        <div class="mb-10 info-card">
            <h3 class="text-2xl font-semibold text-gray-800 border-b-2 border-gray-200 pb-3 mb-5">Sender Information
            </h3>
            <p><strong>Name:</strong> <?= htmlspecialchars($voucher['sender_customer_name'] ?? 'N/A') ?></p>
            <p><strong>Phone:</strong> <?= htmlspecialchars($voucher['sender_customer_phone'] ?? 'N/A') ?></p>
            <p><strong>Email:</strong> <?= htmlspecialchars($voucher['sender_customer_email'] ?? 'N/A') ?></p>
            <p><strong>Address:</strong> <?= htmlspecialchars($voucher['sender_customer_address'] ?? 'N/A') ?></p>
        </div>

        <!-- Recipient Info -->
        <div class="mb-10 info-card">
            <h3 class="text-2xl font-semibold text-gray-800 border-b-2 border-gray-200 pb-3 mb-5">Recipient Information
            </h3>
            <p><strong>Name:</strong> <?= htmlspecialchars($voucher['receiver_customer_name'] ?? 'N/A') ?></p>
            <p><strong>Phone:</strong> <?= htmlspecialchars($voucher['receiver_customer_phone'] ?? 'N/A') ?></p>
            <p><strong>Email:</strong> <?= htmlspecialchars($voucher['receiver_customer_email'] ?? 'N/A') ?></p>
            <p><strong>Address:</strong> <?= htmlspecialchars($voucher['receiver_customer_address'] ?? 'N/A') ?></p>
        </div>

        <!-- Package Details -->
        <div class="mb-10 info-card">
            <h3 class="text-2xl font-semibold text-gray-800 border-b-2 border-gray-200 pb-3 mb-5">Package Details</h3>
            <p><strong>Weight:</strong> <?= htmlspecialchars($voucher['weight'] ?? 'N/A') ?></p>
            <p><strong>Amount:</strong> <?= htmlspecialchars($voucher['amount'] ?? 'N/A') ?></p>
            <p><strong>Duration:</strong> <?= htmlspecialchars($voucher['duration'] ?? 'N/A') ?></p>
            <p><strong>Product Type:</strong> <?= htmlspecialchars($voucher['product_type'] ?? 'N/A') ?></p>
        </div>

        <!-- Status History -->
        <div class="mb-10 info-card">
            <h3 class="text-2xl font-semibold text-gray-800 border-b-2 border-gray-200 pb-3 mb-5">Status Update History
            </h3>
            <?php if (!empty($status) && is_array($status)): ?>
            <?php foreach ($status as $history):
                        $style = getStatusStyleAndIcon($history['status'] ?? 'Unknown'); ?>
            <div class="status-history-item <?= $style['bg'] ?>">
                <p class="<?= $style['text'] ?> font-semibold">
                    <?= $style['icon'] ?>Status: <?= htmlspecialchars($history['status'] ?? 'N/A') ?>
                </p>
                <p class="text-sm text-gray-700 mt-1">Reason:
                    <?= htmlspecialchars($history['note'] ?? 'No reason provided.') ?></p>
                <p class="text-xs text-gray-500 mt-2">
                    Updated by: <span
                        class="font-medium"><?= htmlspecialchars($history['changed_by'] ?? 'Unknown Agent') ?></span>
                    at <span class="font-medium"><?= htmlspecialchars($history['changed_at'] ?? 'N/A') ?></span>
                </p>
            </div>
            <?php endforeach; ?>
            <?php else: ?>
            <p class="text-gray-600 text-center py-4">No status update history available.</p>
            <?php endif; ?>
        </div>

        <!-- Actions -->
        <div class="flex justify-center space-x-4 mt-10">
            <button onclick="window.history.back()"
                class="px-8 py-3 bg-gray-500 text-white rounded-lg shadow-lg hover:bg-gray-600 transition-all duration-300">
                Back
            </button>
            <button onclick="window.print()"
                class="px-8 py-3 bg-gray-600 text-white rounded-lg shadow-lg hover:bg-gray-700 transition-all duration-300">
                Print Delivery Details
            </button>
        </div>
    </div>
    <?php endif; ?>
</body>

</html>