<?php require_once APPROOT . '/views/inc/pickupagentsiderbar.php';
$pickup = $data['pickupdetial'];

?>

<style>
    :root {
        --main-bg-color: rgb(31 38 91 / var(--tw-bg-opacity, 1));
    }

    body {
        font-family: 'Inter', sans-serif;
        background-color: #f3f4f6;
    }

    .custom-scrollbar::-webkit-scrollbar {
        width: 8px;
    }

    .custom-scrollbar::-webkit-scrollbar-track {
        background: #e5e7eb;
        border-radius: 10px;
    }

    .custom-scrollbar::-webkit-scrollbar-thumb {
        background: #9ca3af;
        border-radius: 10px;
    }

    .custom-scrollbar::-webkit-scrollbar-thumb:hover {
        background: #6b7280;
    }

    .text-shadow-md {
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
    }

    .active-link {
        background-color: #2563eb;
        color: white;
    }
</style>


<!-- Main Content -->
<div class="flex flex-1 flex-col">
    <!-- Header -->
    <header class="bg-white shadow-sm py-4 px-6 md:px-8 lg:px-12 flex items-center justify-between">
        <div class="flex items-center space-x-4">
            <h1 class="text-xl md:text-2xl font-bold">Pickup Details</h1>
        </div>
        <div class="flex items-center space-x-2">
            <!-- Profile Image or Initials -->
            <div
                class="w-10 h-10 rounded-full overflow-hidden bg-gray-200 flex items-center justify-center text-sm font-bold text-gray-700">
                <?php if (!empty($user['profile_image'])): ?>
                    <img src="<?= URLROOT . '/' . htmlspecialchars($user['profile_image']) ?>" alt="Profile Image"
                        class="w-full h-full object-cover">
                <?php else: ?>
                    <?= strtoupper(substr($user['name'], 0, 2)) ?>
                <?php endif; ?>
            </div>

            <!-- User Info -->
            <div>
                <span class="text-sm font-medium text-gray-600"><?= htmlspecialchars($user['name']) ?></span>
                <p class="text-xs text-gray-500"><?= htmlspecialchars($user['access_code']) ?></p>
            </div>
        </div>
    </header>



    <?php if (isset($_SESSION['flash_message'])):
        $flash = $_SESSION['flash_message'];
        unset($_SESSION['flash_message']);
    ?>
        <div id="flashMessage" class="mx-auto mb-6 max-w-lg text-center 
                px-6 py-3 rounded shadow-md text-white font-medium
                <?= $flash['type'] === 'success' ? 'bg-green-500' : 'bg-red-500' ?>">
            <?= htmlspecialchars($flash['message']) ?>
        </div>

        <script>
            setTimeout(() => {
                const flash = document.getElementById('flashMessage');
                if (flash) flash.style.display = 'none';
            }, 4000);
        </script>
    <?php endif; ?>

    <!-- Main Content -->
    <main class="flex-1 p-6 md:p-8 lg:p-12 overflow-y-auto">
        <div class="max-w-4xl mx-auto bg-white rounded-lg shadow-md p-6 sm:p-8">

            <!-- Static content area with pickup details -->
            <div id="pickup-details-container" class="space-y-6">
                <!-- Pickup ID & Status -->
                <div class="flex justify-between items-center pb-4 border-b border-gray-200">
                    <h2 class="text-3xl font-extrabold text-gray-900"><?= htmlspecialchars($pickup['tracking_code']) ?>
                    </h2>
                    <?php
                    $status = strtolower($pickup['delivery_status'] ?? 'default');

                    $statusClasses = [
                        'pending'                     => 'bg-yellow-500',
                        'accepted'                    => 'bg-indigo-500',
                        'collected'                   => 'bg-orange-600',
                        'voucher_created'             => 'bg-purple-600',
                        'delivered'                   => 'bg-green-500',
                        'arrived_office'              => 'bg-teal-500',
                        'rejected'                    => 'bg-red-500',
                        'agent_checked'               => 'bg-pink-500',
                        'awaiting_payment'            => 'bg-orange-500',
                        'payment_success'             => 'bg-emerald-600',
                        'awaiting_cash'               => 'bg-amber-500',
                        'cash_collected'              => 'bg-lime-600',
                        'pickup_verification_pending' => 'bg-orange-500',
                        'pickup_verified'             => 'bg-blue-500',
                        'on_the_way'                  => 'bg-sky-500',
                        'waiting_for_receipt'         => 'bg-pink-500',
                        'receipt_submitted'           => 'bg-cyan-500',
                        'payment_pending'             => 'bg-amber-600',
                        'payment_reject'              => 'bg-red-600',
                        'arrived_at_user'             => 'bg-green-600',
                        'pickup_failed'               => 'bg-red-600',
                        'cancelled'                   => 'bg-gray-600',
                        'default'                     => 'bg-gray-400'
                    ];

                    $badgeClass = $statusClasses[$status] ?? $statusClasses['default'];
                    ?>

                    <span
                        class="px-3 py-1 inline-flex text-sm font-bold rounded-full shadow-md text-white capitalize <?= $badgeClass ?>  whitespace-nowrap leading-tight"
                        title="<?= htmlspecialchars(str_replace('_', ' ', $status)) ?>">
                        <?= htmlspecialchars(str_replace('_', ' ', $status)) ?>
                    </span>

                </div>

                <!-- Basic Info -->
                <div class="space-y-4 p-6 border border-gray-200 rounded-lg">
                    <h3 class="text-xl font-bold text-gray-800">Basic Info</h3>
                    <div class="grid sm:grid-cols-2 gap-y-4 gap-x-8">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Recipient</p>
                            <p class="text-lg font-semibold"><?= htmlspecialchars($pickup['receiver_customer_name']) ?>
                            </p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Address</p>
                            <p class="text-lg font-semibold">
                                <?= htmlspecialchars($pickup['receiver_customer_address']) ?></p>
                        </div>
                    </div>

                    <div class="grid sm:grid-cols-2 gap-y-4 gap-x-8">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Due Time</p>
                            <p class="text-lg font-semibold"><?= htmlspecialchars($pickup['created_at']) ?></p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Contact</p>
                            <p class="text-lg font-semibold"><?= htmlspecialchars($pickup['receiver_customer_phone']) ?>
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Delivery Info -->
                <div class="space-y-4 p-6 border border-gray-200 rounded-lg">
                    <h3 class="text-xl font-bold text-gray-800">Delivery Info</h3>
                    <div class="grid sm:grid-cols-2 gap-y-4 gap-x-8">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Weight</p>
                            <p class="text-lg font-semibold"><?= htmlspecialchars($pickup['weight']) ?> kg</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Number of Piece</p>
                            <p class="text-lg font-semibold"><?= htmlspecialchars($pickup['piece_count']) ?></p>
                        </div>
                    </div>

                    <div class="grid sm:grid-cols-2 gap-y-4 gap-x-8">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Payment Type</p>
                            <p class="text-lg font-semibold">
                                <?= htmlspecialchars(ucwords(str_replace('_', ' ', $pickup['payment_status']))) ?>
                            </p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Delivery Type</p>
                            <p class="text-lg font-semibold">
                                <?= htmlspecialchars(ucwords(str_replace('_', ' ', $pickup['delivery_type_name']))) ?>
                            </p>
                        </div>
                    </div>

                    <div class="grid sm:grid-cols-2 gap-y-4 gap-x-8">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Total Amount</p>
                            <p class="text-lg font-semibold">
                                <?= htmlspecialchars(ucwords(str_replace('_', ' ', $pickup['amount'] ?? 'Processing'))) ?>
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Delivery Info -->


                <!-- Default Notice Text -->
                <?php if ($pickup['delivery_status'] === 'arrived_at_user' || $pickup['delivery_status'] === 'Delivered'): ?>
                    <div
                        class="mt-4 p-4 bg-green-100 border border-green-400 rounded-lg text-green-800 font-medium text-center">
                        Delivery completed. Appreciate your hard work, pickup agent!
                    </div>
                <?php endif; ?>


                <input type="hidden" name="payment" value="<?= htmlspecialchars($pickup['delivery_type_name']) ?>">

                <!-- Payment Form -->

                <?php if ($pickup['delivery_status_id'] == 10): ?>
                    <div class="space-y-4 p-6 border border-gray-200 rounded-lg mt-6">
                        <h3 class="text-xl font-bold text-gray-800">Payment</h3>

                        <form action="<?= URLROOT; ?>/pickupagentcontroller/savepayment" method="POST"
                            enctype="multipart/form-data" class="space-y-4">
                            <input type="hidden" name="pickup_id" value="<?= htmlspecialchars($pickup['id']); ?>">

                            <!-- Payment Type Dropdown -->
                            <div>
                                <label for="payment_type" class="block text-sm font-medium text-gray-700">Select
                                    Payment Type</label>
                                <select id="payment_type" name="payment_type"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm p-2">
                                    <option value="">-- Select Type --</option>
                                    <option value="1">Cash</option>
                                    <option value="2">Online Payment</option>
                                    <option value="3">Banking</option>
                                </select>
                            </div>

                            <!-- Method Dropdown -->
                            <div id="method_group" class="hidden">
                                <label for="method_id" class="block text-sm font-medium text-gray-700">Select
                                    Method</label>
                                <select id="method_id" name="method_id"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm p-2">
                                    <option value="">-- Select Method --</option>
                                    <?php foreach ($data['payment'] as $method): ?>
                                        <option value="<?= htmlspecialchars($method['id']); ?>"
                                            data-type="<?= htmlspecialchars($method['payment_type_id']); ?>"
                                            data-image="<?= htmlspecialchars($method['method_image']); ?>"
                                            data-number="<?= htmlspecialchars($method['method_number']); ?>"
                                            data-holder="<?= htmlspecialchars($method['account_holder']); ?>">
                                            <?= htmlspecialchars($method['method_name']); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <!-- Show Method Details -->
                            <div id="method_details" class="hidden mt-3 p-3 bg-gray-50 rounded border space-y-2">
                                <!-- Small image -->
                                <img id="method_img" src="" alt="Method Image"
                                    class="w-32 h-32 object-contain border rounded shadow cursor-pointer">

                                <p class="text-sm text-gray-700">Account Number: <span id="method_number"
                                        class="font-semibold"></span></p>
                                <p class="text-sm text-gray-700">Account Holder: <span id="account_holder"
                                        class="font-semibold"></span></p>
                            </div>

                            <!-- Upload Receipt -->
                            <div id="receipt_group" class="hidden">
                                <label for="receipt" class="block text-sm font-medium text-gray-700">Upload
                                    Receipt</label>
                                <input type="file" id="receipt" name="receipt" accept="image/*"
                                    class="mt-1 block w-full text-sm text-gray-700 border border-gray-300 rounded-md cursor-pointer focus:outline-none focus:ring-2 focus:ring-blue-500">

                                <div id="receipt_preview" class="mt-3 hidden">
                                    <img id="receipt_img" src="" alt="Receipt Preview"
                                        class="w-40 h-40 object-cover rounded-lg border border-gray-300 shadow">
                                    <p id="receipt_name" class="text-sm text-gray-600 mt-2"></p>
                                </div>
                            </div>

                            <input type="hidden" name="agent_id" value="<?= htmlspecialchars($user['id']); ?>">

                            <input type="hidden" name="delivery_id" value="<?= htmlspecialchars($pickup['id']) ?>">

                            <!-- Submit -->
                            <button type="submit"
                                class="w-full sm:w-auto px-6 py-2 bg-green-600 text-white rounded-lg shadow hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500">
                                Save Payment
                            </button>
                        </form>
                    </div>


                    <!-- Image Upload (hidden until Online/Banking) -->
                    <div id="payment_image_group" class="hidden">
                        <label for="payment_image" class="block text-sm font-medium text-gray-700">Upload Receipt /
                            Screenshot</label>
                        <input type="file" id="payment_image" name="payment_image" accept="image/*"
                            class="mt-1 block w-full text-sm text-gray-700 border border-gray-300 rounded-md cursor-pointer focus:outline-none focus:ring-2 focus:ring-blue-500">

                        <!-- Preview -->
                        <div id="image_preview" class="mt-3 hidden">
                            <img id="preview_img" src="" alt="Payment Preview"
                                class="w-40 h-40 object-cover rounded-lg border border-gray-300 shadow">
                            <p id="file_name" class="text-sm text-gray-600 mt-2"></p>
                        </div>
                    </div>


                    </form>
                <?php endif; ?>
            </div>


            <!-- Action buttons -->
            <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4 pt-6 border-t border-gray-200">

                <!-- Back Button -->
                <a href="<?= URLROOT; ?>/pickupagentcontroller/completepickup"
                    class="w-full sm:w-auto flex justify-center items-center py-3 px-6 rounded-lg font-bold text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors">
                    <i class="fas fa-arrow-left mr-2"></i> Back to Pickups
                </a>



                <!-- Arrived at User Button -->
                <?php if ($pickup['delivery_status'] === 'Deliver Parcel'): ?>
                    <!-- Arrived at User Button -->
                    <a href="<?= URLROOT; ?>/pickupagentcontroller/arrivedoutofdelivery?id=<?= htmlspecialchars($pickup['id']); ?>&request_code=<?= urlencode($pickup['tracking_code']); ?>"
                        class="w-full sm:w-auto flex justify-center items-center py-3 px-6 rounded-lg font-bold text-white bg-green-500 hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-400 focus:ring-offset-2 transition-colors">
                        <i class="fas fa-map-marker-alt mr-2"></i> Arrived at Customer
                    </a>

                    <!-- Pickup Fail Button -->
                    <a href="<?= URLROOT; ?>/pickupagentcontroller/outofdeliveryreturn?id=<?= htmlspecialchars($pickup['id']); ?>&request_code=<?= urlencode($pickup['tracking_code']); ?>"
                        class="w-full sm:w-auto flex justify-center items-center py-3 px-6 rounded-lg font-bold text-white bg-red-500 hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-400 focus:ring-offset-2 transition-colors">
                        <i class="fas fa-times-circle mr-2"></i> Return
                    </a>
                <?php endif; ?>


                <?php if ($pickup['delivery_status'] === 'awaiting_cash'): ?>
                    <a href="<?= URLROOT; ?>/pickupagentcontroller/collectcash?id=<?= htmlspecialchars($pickup['id']); ?>"
                        class="w-full sm:w-auto flex justify-center items-center py-3 px-6 rounded-lg font-bold text-white bg-yellow-500 hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:ring-offset-2 transition-colors">
                        <i class="fas fa-money-bill-wave mr-2"></i> Collect Cash
                    </a>
                <?php endif; ?>


                <!-- Mark as Complete Button -->
                <?php if ($pickup['delivery_status'] === 'pickup_verified'  || $pickup['delivery_status'] === 'voucher_created'): ?>
                    <a href="<?= URLROOT; ?>/pickupagentcontroller/completepickup?id=<?= htmlspecialchars($pickup['id']); ?>&request_code=<?= urlencode($pickup['request_code']); ?>"
                        class="w-full sm:w-auto flex justify-center items-center py-3 px-6 rounded-lg font-bold text-white bg-green-500 hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-400 focus:ring-offset-2 transition-colors">
                        <i class="fas fa-check mr-2"></i> Complete Pickup
                    </a>
                <?php endif; ?>
            </div>
        </div>
</div>
</main>
</div>

<!-- Modal -->
<div id="imageModal" class="hidden fixed inset-0 bg-black bg-opacity-80 flex items-center justify-center z-50">
    <img id="modalImg" src="" class="max-w-[90%] max-h-[90%] rounded-lg shadow-lg">
</div>


<script>
    document.addEventListener("DOMContentLoaded", () => {
        const paymentType = document.getElementById("payment_type");
        const methodGroup = document.getElementById("method_group");
        const methodId = document.getElementById("method_id");
        const methodDetails = document.getElementById("method_details");
        const methodImg = document.getElementById("method_img");
        const methodNumber = document.getElementById("method_number");
        const accountHolder = document.getElementById("account_holder");
        const receiptGroup = document.getElementById("receipt_group");
        const receiptInput = document.getElementById("receipt");
        const receiptPreview = document.getElementById("receipt_preview");
        const receiptImg = document.getElementById("receipt_img");
        const receiptName = document.getElementById("receipt_name");

        // Show method dropdown when Online/Banking selected
        paymentType?.addEventListener("change", () => {
            const selectedType = paymentType.value;
            methodId.value = "";
            methodDetails.classList.add("hidden");
            receiptGroup.classList.add("hidden");

            if (selectedType === "2" || selectedType === "3") {
                methodGroup.classList.remove("hidden");
                [...methodId.options].forEach(opt => {
                    if (!opt.value) return;
                    opt.hidden = opt.dataset.type !== selectedType;
                });
            } else {
                methodGroup.classList.add("hidden");
            }
        });

        // Show method details when chosen
        methodId?.addEventListener("change", () => {
            const selected = methodId.options[methodId.selectedIndex];
            if (selected?.value) {
                methodImg.src = selected.dataset.image ? "<?= URLROOT ?>/" + selected.dataset.image : "";
                methodNumber.textContent = selected.dataset.number || "N/A";
                accountHolder.textContent = selected.dataset.holder || "N/A";
                methodDetails.classList.remove("hidden");
                receiptGroup.classList.remove("hidden");
            } else {
                methodDetails.classList.add("hidden");
                receiptGroup.classList.add("hidden");
            }
        });

        // Preview uploaded receipt
        receiptInput?.addEventListener("change", () => {
            const file = receiptInput.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = e => {
                    receiptImg.src = e.target.result;
                    receiptPreview.classList.remove("hidden");
                    receiptName.textContent = "File: " + file.name;
                };
                reader.readAsDataURL(file);
            } else {
                receiptPreview.classList.add("hidden");
            }
        });

        // Image modal (no close button, click anywhere to hide)
        const modal = document.getElementById("imageModal");
        const modalImg = document.getElementById("modalImg");

        methodImg?.addEventListener("click", () => {
            if (methodImg.src) {
                modalImg.src = methodImg.src;
                modal.classList.remove("hidden");
            }
        });

        // Click overlay OR big image to close
        modal?.addEventListener("click", () => {
            modal.classList.add("hidden");
        });
    });
</script>





</body>

</html>