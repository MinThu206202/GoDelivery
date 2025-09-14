<?php
require_once APPROOT . '/views/inc/sidebar.php';
?>
<script src="https://cdn.tailwindcss.com"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<style>
@import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');

body {
    font-family: 'Inter', sans-serif;
    background-color: #f1f5f9;
}

.bg-custom-blue {
    background-color: #1F265B;
}

.text-custom-blue {
    color: #1F265B;
}
</style>

<?php foreach ($data['detaildelivery'] as $user): ?>
<?php
    $status = strtolower($user['delivery_status']);
    $statusClass = match ($status) {
        'delivered' => 'status-delivered',
        'pending' => 'status-pending',
        'cancelled' => 'status-cancelled',
        'returned' => 'status-returned',
        default => 'status-default'
    };
    ?>



<!-- Main Content -->
<main class="flex-1 p-6 space-y-6 md:ml-64">
    <!-- Top Nav -->
    <header class="bg-white p-4 rounded-lg shadow-md flex items-center justify-between flex-wrap">
        <h2 class="text-xl font-semibold text-gray-800 hidden md:block">Delivery Detail</h2>
        <div class="ml-auto flex items-center space-x-2 mt-4 md:mt-0">
            <i class="fas fa-user-circle text-2xl text-gray-600"></i>
            <span class="font-medium">Min Thu</span>
        </div>
    </header>

    <!-- Delivery Details Card -->
    <div class="bg-white p-6 rounded-lg shadow-md">
        <div class="mb-6">
            <h3 class="text-xl font-semibold text-gray-800">Tracking Code(<span>
                    <?= htmlspecialchars($user['tracking_code']); ?>
                </span>)</h3>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-y-8 gap-x-12">
            <!-- From Section -->
            <div class="space-y-4">
                <h4 class="text-lg font-medium text-gray-700 border-b pb-2">From:</h4>
                <div class="flex items-center space-x-2">
                    <i class="fas fa-user-circle text-gray-500"></i>
                    <span class="text-gray-800"><span>
                            <?= htmlspecialchars($user['sender_customer_name']); ?>
                        </span></span>
                </div>
                <div class="flex items-center space-x-2">
                    <i class="fas fa-phone-alt text-gray-500"></i>
                    <span class="text-gray-800"><span>
                            <?= htmlspecialchars($user['sender_customer_phone']); ?>
                        </span></span>
                </div>
                <div class="flex items-center space-x-2">
                    <i class="fas fa-map-marker-alt text-gray-500"></i>
                    <span class="text-gray-800"><span>
                            <?= htmlspecialchars($user['sender_customer_address']); ?>
                        </span></span>
                </div>
                <div>
                    <p class="text-gray-500 text-sm mt-4">From City</p>
                    <p class="font-medium">
                        <?= htmlspecialchars($user['from_city_name']); ?>
                    </p>
                </div>
            </div>

            <!-- To Section -->
            <div class="space-y-4">
                <h4 class="text-lg font-medium text-gray-700 border-b pb-2">To:</h4>
                <div class="flex items-center space-x-2">
                    <i class="fas fa-user-circle text-gray-500"></i>
                    <span class="text-gray-800">
                        <?= htmlspecialchars($user['receiver_customer_name']); ?>
                    </span>
                </div>
                <div class="flex items-center space-x-2">
                    <i class="fas fa-phone-alt text-gray-500"></i>
                    <span class="text-gray-800">
                        <?= htmlspecialchars($user['receiver_customer_phone']); ?>
                    </span>
                </div>
                <div class="flex items-center space-x-2">
                    <i class="fas fa-map-marker-alt text-gray-500"></i>
                    <span class="text-gray-800">
                        <?= htmlspecialchars($user['receiver_customer_address']); ?>
                    </span>
                </div>
                <div>
                    <p class="text-gray-500 text-sm mt-4">To City</p>
                    <p class="font-medium">
                        <?= htmlspecialchars($user['to_city_name']); ?>
                    </p>
                </div>
            </div>
        </div>

        <hr class="my-8">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-y-8 gap-x-12">
            <!-- Sender Agent Section -->
            <div class="space-y-4">
                <h4 class="text-lg font-medium text-gray-700 border-b pb-2">Sender Agent:</h4>
                <div class="flex items-center space-x-2">
                    <i class="fas fa-user-circle text-gray-500"></i>
                    <span class="text-gray-800">
                        <?= htmlspecialchars($user['sender_agent_name']); ?>
                    </span>
                </div>
                <div class="flex items-center space-x-2">
                    <i class="fas fa-phone-alt text-gray-500"></i>
                    <span class="text-gray-800">
                        <?= htmlspecialchars($user['sender_agent_phone']); ?>
                    </span>
                </div>
                <div class="flex items-center space-x-2">
                    <i class="fas fa-envelope text-gray-500"></i>
                    <span class="text-gray-800">
                        <?= htmlspecialchars($user['sender_agent_email']); ?>
                    </span>
                </div>
            </div>

            <!-- Receiver Agent Section -->
            <div class="space-y-4">
                <h4 class="text-lg font-medium text-gray-700 border-b pb-2">Receiver Agent:</h4>
                <div class="flex items-center space-x-2">
                    <i class="fas fa-user-circle text-gray-500"></i>
                    <span class="text-gray-800">
                        <?= htmlspecialchars($user['receiver_agent_name']); ?>
                    </span>
                </div>
                <div class="flex items-center space-x-2">
                    <i class="fas fa-phone-alt text-gray-500"></i>
                    <span class="text-gray-800">
                        <?= htmlspecialchars($user['receiver_agent_phone']); ?>
                    </span>
                </div>
                <div class="flex items-center space-x-2">
                    <i class="fas fa-envelope text-gray-500"></i>
                    <span class="text-gray-800">
                        <?= htmlspecialchars($user['receiver_agent_email']); ?>
                    </span>
                </div>
            </div>
        </div>

        <hr class="my-8">

        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            <div class="flex flex-col items-center">
                <i class="fas fa-weight text-2xl text-gray-500"></i>
                <p class="text-sm text-gray-500 mt-2">Weight(Kg)</p>
                <p class="font-bold text-gray-800">
                    <?= htmlspecialchars($user['weight']); ?> KG
                </p>
            </div>
            <div class="flex flex-col items-center">
                <i class="fas fa-box text-2xl text-gray-500"></i>
                <p class="text-sm text-gray-500 mt-2">Number of Piece</p>
                <p class="font-bold text-gray-800">
                    <?= htmlspecialchars($user['piece_count']); ?>
                </p>
            </div>
            <div class="flex flex-col items-center">
                <i class="fas fa-money-bill-wave text-2xl text-gray-500"></i>
                <p class="text-sm text-gray-500 mt-2">Sender/Receiver Pay</p>
                <p class="font-bold text-gray-800">
                    <?= htmlspecialchars($user['payment_status']); ?>
                </p>
            </div>
            <div class="flex flex-col items-center">
                <i class="fas fa-credit-card text-2xl text-gray-500"></i>
                <p class="text-sm text-gray-500 mt-2">Amount</p>
                <p class="font-bold text-gray-800">
                    <?= htmlspecialchars($user['amount']); ?> MMK
                </p>
            </div>
        </div>

        <hr class="my-8">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <h4 class="text-lg font-medium text-gray-700">Content Description</h4>
                <p class="mt-2 text-gray-800">
                    <?= htmlspecialchars($user['product_type']); ?>
                </p>
            </div>
            <div>
                <h4 class="text-lg font-medium text-gray-700">Status</h4>
                <span class="mt-2 inline-block px-3 py-1 text-sm font-semibold rounded-full bg-blue-500 text-white">In
                    <?= htmlspecialchars($user['delivery_status']); ?>
                </span>
            </div>
        </div>
        <?php endforeach; ?>

        <hr class="my-8">

        <div class="flex justify-start">
            <button onclick=" history.back()"
                class="bg-gray-400 text-white font-semibold py-2 px-6 rounded-lg hover:bg-gray-500 transition-colors duration-300">
                <i class="fas fa-arrow-left mr-2"></i>Back
            </button>

        </div>
    </div>
</main>

</body>

</html>