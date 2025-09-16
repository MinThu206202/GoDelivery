<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Placeholder for PHP include. In a real environment, you would use this.
require_once APPROOT . '/views/inc/nav.php'
?>

<style>
/* Custom CSS variables from the original file */
:root {
    --primary-color: #1F265B;
    --secondary-color: #333;
    --text-color: #555;
    --heading-color: #333;
    --light-grey: #f8f8f8;
    --dark-blue-footer: #1a237e;
    --white: #fff;
    --border-color: #ddd;
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

/* Custom scrollbar for better visual on webkit browsers */
.overflow-x-auto::-webkit-scrollbar {
    height: 8px;
}

.overflow-x-auto::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 10px;
}

.overflow-x-auto::-webkit-scrollbar-thumb {
    background: var(--primary-color);
    border-radius: 10px;
}

.overflow-x-auto::-webkit-scrollbar-thumb:hover {
    background: #0056b3;
}
</style>


<!-- Main Content -->
<main class="flex-1 p-8 md:p-16 flex flex-col items-center">
    <!-- Breadcrumbs -->
    <div class="mb-8 text-gray-600">
        <a href="#" class="hover:underline">Home</a> &gt; Pickup History
    </div>

    <!-- History Section -->
    <!-- Added overflow-x-auto class to make the table horizontally scrollable -->
    <div class="bg-white p-8 md:p-12 rounded-xl shadow-lg w-full max-w-full overflow-x-auto">
        <h2 class="text-center text-4xl font-semibold text-gray-800 mb-8">Pickup History</h2>

        <div class="w-full">
            <table class="min-w-full divide-y divide-gray-200" id="historyTable">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Tracking ID</th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Requested on</th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Pickup Address</th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Receiver Info</th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Status</th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200" id="historyTableBody">
                    <!-- Static Data for Demonstration -->
                    <?php if (!empty($data['pickup'])): ?> <?php foreach ($data['pickup'] as $pickup): ?> <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?= $pickup['request_code']; ?>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            <?= date('Y-m-d h:i A', strtotime($pickup['created_at'])); ?></td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            <strong>Region:</strong> <?= $pickup['sender_region']; ?><br>
                            <strong>City:</strong> <?= $pickup['sender_city']; ?><br>
                            <strong>Township:</strong> <?= $pickup['sender_township']; ?>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            <strong>Name:</strong> <?= $pickup['receiver_name']; ?><br>
                            <strong>Phone:</strong> <?= $pickup['receiver_phone']; ?><br>
                            <strong>Address:</strong> <?= $pickup['receiver_address']; ?>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">
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
                                                                    'arrived_at_user'             => 'bg-green-600',
                                                                    'pickup_failed'               => 'bg-red-600',
                                                                    'delivered' => 'bg-green-500',
                                                                    'rejected' => 'bg-red-500',
                                                                    'cancelled' => 'bg-gray-600',
                                                                ];

                                    ?>

                            <span
                                class="px-3 py-1.5 inline-flex text-sm leading-5 font-bold text-white rounded-full shadow-lg <?= $statusColors[$pickup['status']] ?? '' ?>">
                                <?= ucfirst(str_replace('_', ' ', $pickup['status'])) ?>
                            </span>

                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <button
                                onclick="window.location.href='<?php echo URLROOT; ?>/pickupcontroller/detail?request_code=<?= $pickup['request_code']; ?>'"
                                class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg shadow-md transition duration-200 ease-in-out">
                                View
                            </button>
                        </td>

                    </tr>
                    <?php endforeach; ?>
                    <?php else: ?>
                    <tr>
                        <td colspan="6" class="px-6 py-4 text-center text-sm text-gray-500">No pickups found.</td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</main>

<footer class="bg-primary-blue text-white py-12">
    <div
        class="container mx-auto px-4 flex flex-col md:flex-row justify-between items-start gap-8 text-center md:text-left">
        <div class="md:w-1/3">
            <h2 class="text-3xl md:text-5xl font-bold mb-4">GoDelivery</h2>
            <p class="text-gray-300">Your most reliable partner in logistics and delivery services, dedicated to
                providing top-notch service with a smile.</p>
            <div class="mt-6 flex justify-center md:justify-start space-x-4">
                <a href="#" class="text-white hover:text-gray-300 transition-colors"><i
                        class="fab fa-facebook-f"></i></a>
                <a href="#" class="text-white hover:text-gray-300 transition-colors"><i class="fab fa-twitter"></i></a>
                <a href="#" class="text-white hover:text-gray-300 transition-colors"><i
                        class="fab fa-instagram"></i></a>
            </div>
        </div>
        <div class="md:w-1/3 text-sm text-gray-300">
            <h3 class="font-bold text-lg mb-2">Quick Links</h3>
            <ul class="space-y-1">
                <li><a href="#" class="hover:text-primary-orange transition-colors">Home</a></li>
                <li><a href="#services" class="hover:text-primary-orange transition-colors">Services</a></li>
                <li><a href="#about-us" class="hover:text-primary-orange transition-colors">About Us</a></li>
                <li><a href="#our-impact" class="hover:text-primary-orange transition-colors">Our Impact</a></li>
                <li><a href="#faq" class="hover:text-primary-orange transition-colors">FAQ</a></li>
                <li><a href="#" class="hover:text-primary-orange transition-colors">Careers</a></li>
            </ul>
        </div>
        <div class="md:w-1/3 text-sm text-gray-300">
            <h3 class="font-bold text-lg mb-2">Contact Us</h3>
            <ul class="space-y-1">
                <li><i class="fas fa-phone-alt mr-2"></i> +1 234 567 8900</li>
                <li><i class="fas fa-envelope mr-2"></i> info@godelivery.com</li>
                <li><i class="fas fa-map-marker-alt mr-2"></i> 123 Delivery St, Suite 400, City, Country</li>
            </ul>
        </div>
    </div>
</footer>
</body>

</html>