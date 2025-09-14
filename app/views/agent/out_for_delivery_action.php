<?php require_once APPROOT . '/views/inc/agentsidebar.php';
$delivery = $data['pickup'];
// $route = $data['route'];
// $location = $data['location'];
$availableAgents = $data['availableAgents'];
// var_dump($availableAgents);
// die();
?>

<body class="bg-gray-100 antialiased">
    <div class="flex-1 flex flex-col overflow-hidden min-h-screen">
        <!-- Header -->
        <header class="flex items-center justify-between p-6 bg-white shadow-md rounded-bl-lg">
            <h1 class="text-3xl font-semibold text-gray-800">Edit Delivery</h1>
            <!-- Profile Dropdown (same as pickup) -->
        </header>

        <!-- Main Content -->
        <main class="flex-1 overflow-y-auto p-6 bg-gray-100">
            <div class="max-w-4xl mx-auto">
                <form action="<?php echo URLROOT; ?>/agentcontroller/outofdelivery" method="POST"
                    class="bg-white p-8 rounded-xl shadow-md space-y-8">

                    <!-- Delivery Info -->
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-2xl font-bold text-gray-800">
                            Delivery: <?= htmlspecialchars($delivery['tracking_code']) ?>
                        </h2>
                        <span class="px-4 py-2 text-sm font-bold rounded-full shadow-md text-white 
                        <?= $delivery['delivery_status'] == 'Delivered' ? 'bg-green-500' : 'bg-yellow-500' ?>">
                            <?= htmlspecialchars($delivery['delivery_status']) ?>
                        </span>
                    </div>

                    <input type="hidden" name="code" value="<?= htmlspecialchars($delivery['id']) ?>">

                    <!-- Sender + Receiver Info -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-6">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-700 border-b pb-2">Sender</h3>
                            <p class="text-gray-600">Name: <?= htmlspecialchars($delivery['sender_customer_name']) ?>
                            </p>
                            <p class="text-gray-600">Phone: <?= htmlspecialchars($delivery['sender_customer_phone']) ?>
                            </p>
                            <p class="text-gray-600">Address:
                                <?= htmlspecialchars($delivery['sender_customer_address'] ?? 'N/A') ?></p>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-700 border-b pb-2">Receiver</h3>
                            <p class="text-gray-600">Name: <?= htmlspecialchars($delivery['receiver_customer_name']) ?>
                            </p>
                            <p class="text-gray-600">Phone:
                                <?= htmlspecialchars($delivery['receiver_customer_phone']) ?></p>
                            <p class="text-gray-600">Address:
                                <?= htmlspecialchars($delivery['receiver_customer_address'] ?? 'N/A') ?></p>
                        </div>
                    </div>

                    <!-- Delivery Information -->
                    <div class="space-y-6 pt-6 border-t border-gray-200">
                        <h3 class="text-xl font-semibold text-gray-700 border-b pb-2">Delivery Information</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-6">
                            <div>
                                <p class="text-gray-600 font-medium">Parcel Type:</p>
                                <p class="text-gray-600"><?= htmlspecialchars($delivery['product_type'] ?? 'N/A') ?>
                                </p>
                            </div>
                            <div>
                                <p class="text-gray-600 font-medium">Parcel Weight

                                    :</p>
                                <p class="text-gray-600">
                                    <?= htmlspecialchars($delivery['weight'] ?? 'N/A') ?></p>
                            </div>
                            <div>
                                <p class="text-gray-600 font-medium">Number of Items:</p>
                                <p class="text-gray-600"><?= htmlspecialchars($delivery['piece_count'] ?? 'N/A') ?>
                                </p>
                            </div>
                            <div>
                                <p class="text-gray-600 font-medium">Parcel Amount:</p>
                                <p class="text-gray-600"><?= htmlspecialchars($delivery['amount'] ?? 'N/A') ?> MMK</p>
                            </div>
                            <div>
                                <p class="text-gray-600 font-medium">Payment Type:</p>
                                <p class="text-gray-600"><?= htmlspecialchars($delivery['payment_status'] ?? 'N/A') ?>
                                </p>
                            </div>
                            <div>
                                <p class="text-gray-600 font-medium">Delivery Type:</p>
                                <p class="text-gray-600">
                                    <?= htmlspecialchars($delivery['delivery_type_name'] ?? 'N/A') ?>
                                </p>
                            </div>
                        </div>
                    </div>


                    <!-- Editable Fields -->
                    <div class="space-y-6 pt-6 border-t border-gray-200">
                        <h3 class="text-xl font-semibold text-gray-700 border-b pb-2">Update Delivery</h3>


                        <!-- Assign Agent -->
                        <div>
                            <label class="text-sm font-medium text-gray-700">Assign Delivery Agent</label>
                            <select name="delivery_agent"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                                <option value="">Select Agent</option>
                                <?php foreach ($availableAgents as $agent): ?>
                                <option value="<?= $agent['id'] ?>"
                                    <?= $delivery['id'] == $agent['id'] ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($agent['name']) ?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <!-- Notes -->
                        <div>
                            <label class="text-sm font-medium text-gray-700">Notes</label>
                            <textarea name="note" rows="3"
                                class="w-full rounded-md border-gray-300 shadow-sm"><?= htmlspecialchars($delivery['note'] ?? '') ?></textarea>
                        </div>

                        <input type="hidden" name="id" value="<?= htmlspecialchars($delivery['id']) ?>">
                        <input type="hidden" name="tracking_code"
                            value="<?= htmlspecialchars($delivery['tracking_code']) ?>">
                    </div>

                    <!-- Buttons -->
                    <div class="flex justify-end space-x-4 pt-6 border-t">
                        <a href="javascript:history.back()"
                            class="px-6 py-3 bg-gray-500 text-white rounded-lg hover:bg-gray-600">Back</a>
                        <button type="submit"
                            class="px-6 py-3 bg-blue-500 text-white rounded-lg hover:bg-blue-600">Change To Pickup Agnet
                        </button>
                    </div>
                </form>
            </div>
        </main>
    </div>
</body>