<?php session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Placeholder for PHP include. In a real environment, you would use this.
require_once APPROOT . '/views/inc/nav.php';

$payment = $data['payment'];
$pickupagent = $data['pickup_agent'];
$data = $data['code'];
?>

<style>
    /* Custom CSS variables from the original file */
    :root {
        --primary-color: #1F265B;
        --accent-color: #FACC15;
        /* A bright golden yellow accent */
        --secondary-color: #333;
        --text-color: #555;
        --heading-color: #333;
        --light-grey: #f8f8f8;
        --dark-blue-footer: #1a237e;
        --white: #fff;
        --border-color: #e2e8f0;
        --form-bg-color: #e6f0ff;
        --section-bg-color: #f0f4f7;
    }

    body {
        font-family: 'Poppins', sans-serif;
    }

    .header-bg {
        background-color: var(--primary-color);
    }

    .footer-bg {
        background-color: var(--dark-blue-footer);
    }

    /* Modern button styles with subtle shadow and transition */
    .btn-primary {
        background-color: var(--primary-color);
        color: var(--white);
        padding: 0.75rem 1.5rem;
        border-radius: 9999px;
        /* Tailwind's rounded-full */
        font-weight: 600;
        transition: all 0.2s ease-in-out;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .btn-primary:hover {
        background-color: #141a40;
        box-shadow: 0 6px 8px rgba(0, 0, 0, 0.15);
        transform: translateY(-2px);
    }

    .btn-accent {
        background-color: var(--accent-color);
        color: var(--primary-color);
        font-weight: 600;
        transition: all 0.2s ease-in-out;
    }

    .btn-accent:hover {
        background-color: #dcb300;
    }

    .card {
        background-color: var(--white);
        border-radius: 1rem;
        box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
    }
</style>

<!-- Main Content -->
<main class="flex-1 p-8 md:p-16 flex flex-col items-center bg-gray-100">
    <!-- Breadcrumbs -->
    <div class="mb-8 text-gray-500 text-sm">
        <a href="pickup-history.php" class="hover:underline hover:text-gray-800 transition-colors duration-200">Pickup
            History</a> &gt;
        <span class="text-gray-800 font-medium">Details</span>
    </div>

    <!-- Details Section -->
    <div class="card p-8 md:p-12 w-full max-w-4xl">
        <h2 class="text-center text-4xl font-bold text-gray-800 mb-8">Pickup Details</h2>

        <div class="space-y-12">
            <!-- Request & Status Section -->
            <div class="pb-6 border-b border-gray-200">
                <h3 class="text-2xl font-semibold text-gray-800 mb-4">Request & Status</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-6 text-gray-600">
                    <div class="space-y-2">
                        <strong class="text-lg font-bold text-gray-900">Tracking ID:</strong>
                        <div class="bg-gray-50 p-3 rounded-lg text-gray-800 font-mono">
                            <?= htmlspecialchars($data['request_code']) ?>
                        </div>
                    </div>
                    <div class="space-y-2">
                        <strong class="text-lg font-bold text-gray-900">Status:</strong>
                        <?php
                        $statusColors = [
                            'pending' => 'bg-yellow-500',
                            'pickup_verification_pending' => 'bg-orange-500',
                            'pickup_verified' => 'bg-blue-500',
                            'accepted' => 'bg-indigo-500',
                            'on_the_way' => 'bg-sky-500',
                            'collected' => 'bg-orange-600',
                            'awaiting_cash' => 'bg-amber-500',
                            'cash_collected' => 'bg-lime-600',
                            'waiting_for_receipt' => 'bg-pink-500',
                            'receipt_submitted' => 'bg-cyan-500',
                            'payment_pending' => 'bg-amber-600',
                            'payment_success' => 'bg-green-600',
                            'payment_reject' => 'bg-red-600',
                            'voucher_created' => 'bg-purple-600',
                            'delivered' => 'bg-green-500',
                            'rejected' => 'bg-red-500',
                            'cancelled' => 'bg-gray-600',
                        ];

                        $statusKey = strtolower(str_replace(' ', '_', $data['status']));
                        $statusClass = $statusColors[$statusKey] ?? 'bg-gray-400'; // fallback color
                        ?>
                        <div
                            class="px-4 py-2 inline-flex text-sm leading-5 font-bold rounded-full shadow-md text-white <?= $statusClass ?> break-words capitalize">
                            <?= htmlspecialchars(str_replace('_', ' ', $statusKey)) ?>
                        </div>

                        <!-- Cancel Button (only show if not already cancelled/rejected/delivered) -->
                        <?php
                        $cancelAllowed = ['pending', 'accepted', 'on_the_way'];
                        if (in_array($statusKey, $cancelAllowed)): ?>
                            <a href="<?= URLROOT; ?>/pickupcontroller/cancel?id=<?= urlencode($data['id']) ?>&code=<?= urlencode($data['request_code']) ?>"
                                class="inline-block mt-3 bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg shadow-md transition">
                                Cancel Request
                            </a>
                        <?php endif; ?>

                    </div>
                </div>
            </div>


            <!-- Sender and Receiver Information Section -->
            <div class="pb-6 border-b border-gray-200">
                <h3 class="text-2xl font-semibold text-gray-800 mb-6">Sender & Receiver Information</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-8">
                    <!-- Sender Details Column -->
                    <div class="space-y-4 bg-gray-50 p-6 rounded-lg">
                        <h4 class="text-xl font-bold text-gray-700 mb-2">Sender</h4>
                        <div class="text-gray-600">
                            <p><strong>Name:</strong> <?= htmlspecialchars($data['sender_name'] ?? 'N/A') ?></p>
                            <p><strong>Phone:</strong> <?= htmlspecialchars($data['sender_phone'] ?? 'N/A') ?></p>
                            <p><strong>Address:</strong> <?= htmlspecialchars($data['sender_address'] ?? 'N/A') ?></p>
                        </div>
                    </div>
                    <!-- Receiver Details Column -->
                    <div class="space-y-4 bg-gray-50 p-6 rounded-lg">
                        <h4 class="text-xl font-bold text-gray-700 mb-2">Receiver</h4>
                        <div class="text-gray-600">
                            <p><strong>Name:</strong> <?= htmlspecialchars($data['receiver_name'] ?? 'N/A') ?></p>
                            <p><strong>Phone:</strong> <?= htmlspecialchars($data['receiver_phone'] ?? 'N/A') ?></p>
                            <p><strong>Address:</strong> <?= htmlspecialchars($data['receiver_address'] ?? 'N/A') ?></p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Parcel Details Section -->
            <div class="pb-6 border-b border-gray-200">
                <h3 class="text-2xl font-semibold text-gray-800 mb-6">Parcel Details</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-4 text-gray-600">
                    <p><strong>Weight:</strong> <?= htmlspecialchars($data['weight'] ?? 'N/A') ?></p>
                    <p><strong>Quantity:</strong> <?= htmlspecialchars($data['quantity'] ?? 'N/A') ?></p>
                    <p><strong>Parcel Type:</strong> <?= htmlspecialchars($data['parcel_type'] ?? 'N/A') ?></p>
                    <p><strong>Delivery Type:</strong> <?= htmlspecialchars($data['delivery_type_name'] ?? 'N/A') ?></p>
                </div>
            </div>

            <!-- Agent Information Section -->
            <?php if ($data['status'] !== 'pending' && $data['status'] !== 'rejected'): ?>
                <div class="pb-6 border-b border-gray-200">
                    <h3 class="text-2xl font-semibold text-gray-800 mb-6">Agent Information</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-4 text-gray-600">
                        <p><strong>Name:</strong> <?= htmlspecialchars($pickupagent['name'] ?? 'N/A') ?></p>
                        <p><strong>Phone:</strong> <?= htmlspecialchars($pickupagent['phone'] ?? 'N/A') ?></p>
                        <p><strong>Vehicle Type:</strong>
                            <?= htmlspecialchars($pickupagent['vehicle_type_name'] ?? 'N/A') ?></p>
                        <p><strong>Vehicle Make:</strong>
                            <?= htmlspecialchars($pickupagent['make'] ?? 'N/A') ?>(<?= htmlspecialchars($pickupagent['color'] ?? 'N/A') ?>)
                        </p>
                    </div>
                </div>
            <?php endif; ?>

            <!-- User send ss and payment -->
            <?php if ($data['status'] === 'waiting_for_receipt' || $data['status'] === 'payment_reject'): ?>
                <form action="<?= URLROOT; ?>/pickupcontroller/submitpayment" method="POST" enctype="multipart/form-data">
                    <div class="pb-6 border-b border-gray-200">
                        <h3 class="text-2xl font-semibold text-gray-800 mb-6">Payment Information</h3>
                        <input type="hidden" name="id" value="<?= htmlspecialchars($data['id'] ?? '') ?>">
                        <!-- Row 1: Payment Type & Amount -->
                        <?php if ($data['status'] === 'payment_reject'): ?>

                            <p class="text-red-600 font-semibold p-4 border border-red-200 rounded bg-red-50">
                                Please input the correct payment amount. You rejected the previous payment.
                            </p>
                        <?php endif; ?>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <label class="block font-medium text-gray-700">Payment Type</label>
                                <input type="text" value="<?= htmlspecialchars($data['payment_type'] ?? '') ?>"
                                    class="mt-1 block w-full border border-gray-300 rounded-lg p-2 bg-gray-100" readonly>
                            </div>
                            <div>
                                <label class="block font-medium text-gray-700">Amount</label>
                                <input type="number" value="<?= htmlspecialchars($data['amount'] ?? '') ?>"
                                    class="mt-1 block w-full border border-gray-300 rounded-lg p-2 bg-gray-100" readonly>
                            </div>
                        </div>

                        <!-- Row 2: Payment Method & Payment Name -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <?php
                            $selectedTypeId = $data['payment_type_id'] ?? null;
                            ?>
                            <div>
                                <label class="block font-medium text-gray-700">Payment Method</label>
                                <select id="paymentMethodSelect" name="payment_method_id"
                                    class="mt-1 block w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200">
                                    <option value="">-- Select Payment Method --</option>
                                    <?php foreach ($payment as $method): ?>
                                        <?php if ($method['payment_type_id'] == $selectedTypeId): ?>
                                            <option value="<?= htmlspecialchars($method['id']) ?>"
                                                data-name="<?= htmlspecialchars($method['method_name']) ?>"
                                                data-phone="<?= htmlspecialchars($method['method_number']) ?>"
                                                data-image="<?= htmlspecialchars($method['method_image']) ?>"
                                                data-holder="<?= htmlspecialchars($method['account_holder']) ?>">
                                                <?= htmlspecialchars($method['method_name']) ?>
                                            </option>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <input type="hidden" id="paymentId" name="payment_method_id_hidden">
                            <div>
                                <label class="block font-medium text-gray-700">Payment Name</label>
                                <input type="text" id="paymentName"
                                    class="mt-1 block w-full border border-gray-300 rounded-lg p-2 bg-gray-100" readonly>
                            </div>
                        </div>

                        <!-- Row 3: Payment Number & Account Holder -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div class="relative">
                                <label class="block font-medium text-gray-700">Payment Number</label>
                                <div class="relative mt-1">
                                    <input type="text" id="paymentNumber" value="09772528282"
                                        class="block w-full border border-gray-300 rounded-lg p-2 pr-10 bg-gray-100 text-left tracking-wider"
                                        readonly>
                                    <button type="button" onclick="copyPaymentNumber()"
                                        class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 hover:text-gray-800 transition-colors duration-200">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <rect x="9" y="9" width="13" height="13" rx="2" ry="2" />
                                            <path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <div>
                                <label class="block font-medium text-gray-700">Account Holder</label>
                                <input type="text" id="accountHolder"
                                    class="mt-1 block w-full border border-gray-300 rounded-lg p-2 bg-gray-100" readonly>
                            </div>
                        </div>

                        <!-- Row 4: QR Image + Upload -->
                        <div class="mb-6">
                            <label class="block font-medium text-gray-700">QR Image</label>
                            <img id="paymentImage"
                                class="mt-2 w-40 h-auto rounded-lg border border-gray-300 hidden cursor-pointer"
                                onclick="openImageModal()">

                            <!-- Save Button -->
                            <button type="button" id="saveImageBtn"
                                class="mt-2 bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition-colors duration-200 hidden">
                                Save
                            </button>

                            <input type="file" name="payment_image" accept="image/*"
                                class="mt-4 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 transition-colors duration-200">
                        </div>

                        <div class="flex justify-end">
                            <button type="submit"
                                class="px-6 py-3 bg-[#1F265B] text-white rounded-lg hover:bg-[#2A346C] transition-colors">
                                Submit Payment
                            </button>
                        </div>

                </form>
            <?php endif; ?>

            <!-- Payment Method Section -->
            <?php if ($data['status'] === 'payment_pending'): ?>
                <div class="pb-6 w-full md:w-1/2 mx-auto">
                    <h3 class="text-2xl font-semibold text-gray-800 mb-6">Payment Method</h3>
                    <form action="<?= URLROOT; ?>/Pickupcontroller/updatepayment" method="GET" class="space-y-4">
                        <select id="paymentMethod" name="payment_method"
                            class="w-full p-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-colors duration-200">
                            <option value=1>Cash</option>
                            <option value=2>Online</option>
                            <option value=3>Banking</option>
                        </select>
                        <input type="hidden" name="id" value="<?= htmlspecialchars($data['id'] ?? '') ?>">
                        <input type="hidden" name="request_code"
                            value="<?= htmlspecialchars($data['request_code'] ?? '') ?>">
                        <button type="submit" class="btn-primary w-full md:w-auto">
                            Proceed
                        </button>
                    </form>
                </div>
            <?php endif; ?>
        </div>

        <div class="mt-12 text-center">
            <a href="<?php echo URLROOT; ?>/page/pickuphistory" class="btn-primary px-8 py-3">
                &larr; Back to History
            </a>
        </div>
    </div>
</main>

<!-- Footer Section -->
<footer class="footer-bg text-white p-8 md:p-12">
    <div class="container mx-auto">
        <div class="flex flex-col md:flex-row justify-between items-center text-center md:text-left">
            <div class="mb-6 md:mb-0 md:w-1/2">
                <h2 class="text-3xl font-bold mb-2">Contact Us</h2>
                <h3 class="text-5xl font-extrabold mb-4">Fast, Affordable, And Always On Time.</h3>
                <p class="text-sm leading-relaxed mb-4">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Egestas semper sit integer et. At
                    aliquam tortor lectus commodo ut lectus sed fermentum. Cursus in tincidunt cursus viverra diam.
                    Praesent feugiat dolor ipsum pharetra laoreet vulputate pellentesque sed.
                </p>
                <div class="flex justify-center md:justify-start items-center space-x-4">
                    <a href="#"
                        class="flex items-center space-x-2 bg-white text-gray-800 font-semibold py-2 px-4 rounded-full hover:bg-gray-200 transition-colors duration-200">
                        <span>Contact Now</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                                clip-rule="evenodd" />
                        </svg>
                    </a>
                    <a href="#" class="text-white hover:text-gray-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
                            <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                            <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
                        </svg>
                    </a>
                    <a href="#" class="text-white hover:text-gray-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="currentColor">
                            <path
                                d="M19 0H5a5 5 0 0 0-5 5v14a5 5 0 0 0 5 5h14a5 5 0 0 0 5-5V5a5 5 0 0 0-5-5zm-3 7h-2c-1.087 0-1.85.602-1.85 2.056V11h3l-.48 3H12v8h-3v-8H7V11h2.02v-1.487c0-1.876 1.13-2.915 3.17-2.915h3.81V7z" />
                        </svg>
                    </a>
                </div>
            </div>
            <div class="hidden md:block">
                <!-- Placeholder for the image -->
                <svg xmlns="http://www.w3.org/2000/svg" class="h-48 w-48 text-white opacity-25" viewBox="0 0 24 24"
                    fill="currentColor">
                    <path
                        d="M4 3h16a2 2 0 012 2v14a2 2 0 01-2 2H4a2 2 0 01-2-2V5a2 2 0 012-2zM4 5v14h16V5H4zm2 1.5a1.5 1.5 0 100 3 1.5 1.5 0 000-3zM18 17H6l4-4 4 4 4-4v4z" />
                </svg>
            </div>
        </div>
    </div>
</footer>

<div id="imageModal"
    class="fixed inset-0 bg-black bg-opacity-80 flex items-center justify-center opacity-0 pointer-events-none transition-opacity duration-300 z-50">
    <div class="relative max-w-[90%] max-h-[90%]">
        <!-- Close Button -->
        <button onclick="closeImageModal()"
            class="absolute top-2 right-2 text-white text-3xl font-bold hover:text-red-500">&times;</button>
        <img id="modalImage" src="" class="w-full h-auto max-h-[90vh] rounded-lg shadow-2xl">
    </div>
</div>

<script>
    const methodSelect = document.getElementById('paymentMethodSelect');
    const paymentId = document.getElementById('paymentId');
    const paymentName = document.getElementById('paymentName');
    const paymentNumber = document.getElementById('paymentNumber');
    const accountHolder = document.getElementById('accountHolder');
    const paymentImage = document.getElementById('paymentImage');
    const saveBtn = document.getElementById('saveImageBtn'); // Save button
    const modal = document.getElementById('imageModal');
    const modalImage = document.getElementById('modalImage');

    // Dropdown change
    methodSelect.addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        const img = selectedOption.dataset.image;

        if (selectedOption.value !== "") {
            paymentId.value = selectedOption.value;
            paymentName.value = selectedOption.dataset.name || '';
            paymentNumber.value = selectedOption.dataset.phone || '';
            accountHolder.value = selectedOption.dataset.holder || '';

            if (img) {
                paymentImage.src = '/Delivery/' + img;
                paymentImage.classList.remove('hidden');
                saveBtn.classList.remove('hidden'); // Show Save button
            } else {
                paymentImage.src = '';
                paymentImage.classList.add('hidden');
                saveBtn.classList.add('hidden'); // Hide Save button
            }
        } else {
            paymentId.value = '';
            paymentName.value = '';
            paymentNumber.value = '';
            accountHolder.value = '';
            paymentImage.src = '';
            paymentImage.classList.add('hidden');
            saveBtn.classList.add('hidden'); // Hide Save button
        }
    });

    // Copy number function
    // function copyPaymentNumber() {
    //     const copyText = document.getElementById("paymentNumber");
    //     navigator.clipboard.writeText(copyText.value);
    //     // no alert box shown
    // }

    function showMessage(text, bg) {
        const message = document.createElement('div');
        message.textContent = text;
        message.style.cssText =
            `position:fixed; bottom:20px; right:20px; background-color:${bg}; color:white; padding:10px 20px; border-radius:5px; z-index:1000;`;
        document.body.appendChild(message);
        setTimeout(() => document.body.removeChild(message), 2000);
    }

    // Modal functions
    function openImageModal() {
        if (paymentImage.src) {
            modalImage.src = paymentImage.src;
            modal.classList.remove('opacity-0', 'pointer-events-none');
            modal.classList.add('opacity-100');
        }
    }

    function closeImageModal() {
        modal.classList.add('opacity-0', 'pointer-events-none');
        modal.classList.remove('opacity-100');
    }

    // Save button download
    saveBtn.addEventListener('click', function() {
        if (!paymentImage.src || paymentImage.classList.contains('hidden')) {
            return alert('No image to save!');
        }

        const link = document.createElement('a');
        link.href = paymentImage.src;
        const parts = paymentImage.src.split('/');
        link.download = parts[parts.length - 1];
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
    });
</script>
</body>

</html>