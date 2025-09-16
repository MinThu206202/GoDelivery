<?php session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Placeholder for PHP include. In a real environment, you would use this.
require_once APPROOT . '/views/inc/nav.php';

// Mock data for demonstration purposes. In a live application, this would come from a database.
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

.bg-primary-blue {
    background-color: #1F265B;
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
                        $statusClass = '';
                        switch (strtolower($data['status'])) {
                            case 'pending':
                                $statusClass = 'bg-yellow-200 text-yellow-800';
                                break;
                            case 'rejected':
                                $statusClass = 'bg-red-200 text-red-800';
                                break;
                            case 'waiting_for_receipt':
                                $statusClass = 'bg-blue-200 text-blue-800';
                                break;
                            case 'payment_pending':
                                $statusClass = 'bg-purple-200 text-purple-800';
                                break;
                            default:
                                $statusClass = 'bg-green-200 text-green-800';
                                break;
                        }
                        ?>
                        <div
                            class="px-3 py-1 inline-flex text-sm leading-5 font-bold rounded-full <?= $statusClass ?> break-words capitalize">
                            <?= htmlspecialchars(str_replace('_', ' ', $data['status'])) ?>
                        </div>
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

            <!-- Agent Information Section -->
            <?php if ($data['status'] !== 'pending' && $data['status'] !== 'rejected'): ?>
            <div class="pb-6 border-b border-gray-200">
                <h3 class="text-2xl font-semibold text-gray-800 mb-6">Agent Information</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-4 text-gray-600">
                    <p><strong>Name:</strong> <?= htmlspecialchars($pickupagent['name'] ?? 'N/A') ?></p>
                    <p><strong>Phone:</strong> <?= htmlspecialchars($pickupagent['phone'] ?? 'N/A') ?></p>
                    <p><strong>Vehicle Type:</strong>
                        <?= htmlspecialchars($pickupagent['vehicle_type_name'] ?? 'N/A') ?></p>
                    <p><strong>Vehicle Make:</strong> <?= htmlspecialchars($pickupagent['make'] ?? 'N/A') ?></p>
                </div>
            </div>
            <?php endif; ?>

            <!-- User send ss and payment -->
            <?php if ($data['status'] === 'waiting_for_receipt'): ?>
            <form action="<?= URLROOT; ?>/pickupcontroller/submitpayment" method="POST" enctype="multipart/form-data">
                <div class="pb-6 border-b border-gray-200">
                    <h3 class="text-2xl font-semibold text-gray-800 mb-6">Payment Information</h3>
                    <input type="hidden" name="id" value="<?= htmlspecialchars($data['id'] ?? '') ?>">
                    <!-- Row 1: Payment Type & Amount -->
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
                            <input type="text" id="paymentNumber"
                                class="mt-1 block w-full border border-gray-300 rounded-lg p-2 pr-12 text-right tracking-wider bg-gray-100"
                                readonly>
                            <!-- Copy Icon -->
                            <button type="button" onclick="copyPaymentNumber()"
                                class="absolute right-2 top-1/2 -translate-y-1/2 text-gray-500 hover:text-gray-800 transition-colors duration-200">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M8 16h8M8 12h8M8 8h8M4 6h16M4 18h16" />
                                </svg>
                            </button>
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
                            class="mt-2 w-full max-w-xs h-auto rounded-lg border border-gray-300 hidden">
                        <input type="file" name="payment_image" accept="image/*"
                            class="mt-4 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 transition-colors duration-200">
                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-end">
                        <button type="submit" class="btn-primary px-8 py-3 rounded-full">
                            Submit Payment
                        </button>
                    </div>
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

<script>
const methodSelect = document.getElementById('paymentMethodSelect');
const paymentId = document.getElementById('paymentId');
const paymentName = document.getElementById('paymentName');
const paymentNumber = document.getElementById('paymentNumber');
const accountHolder = document.getElementById('accountHolder');
const paymentImage = document.getElementById('paymentImage');

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
        } else {
            paymentImage.src = '';
            paymentImage.classList.add('hidden');
        }
    } else {
        paymentId.value = '';
        paymentName.value = '';
        paymentNumber.value = '';
        accountHolder.value = '';
        paymentImage.src = '';
        paymentImage.classList.add('hidden');
    }
});

function copyPaymentNumber() {
    const input = document.getElementById('paymentNumber');
    navigator.clipboard.writeText(input.value)
        .then(() => {
            const message = document.createElement('div');
            message.textContent = 'Copied!';
            message.style.cssText =
                'position:fixed; bottom:20px; right:20px; background-color:#1F265B; color:white; padding:10px 20px; border-radius:5px; z-index:1000;';
            document.body.appendChild(message);
            setTimeout(() => {
                document.body.removeChild(message);
            }, 2000);
        })
        .catch(err => {
            const message = document.createElement('div');
            message.textContent = 'Failed to copy!';
            message.style.cssText =
                'position:fixed; bottom:20px; right:20px; background-color:red; color:white; padding:10px 20px; border-radius:5px; z-index:1000;';
            document.body.appendChild(message);
            setTimeout(() => {
                document.body.removeChild(message);
            }, 2000);
        });
}
</script>
</body>

</html>