<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once APPROOT . '/views/inc/agentsidebar.php';


?>

<body class="flex flex-col min-h-screen">
    <!-- Main Content Area -->
    <div class="flex-1 flex flex-col overflow-hidden">
        <!-- Header -->
        <header class="flex items-center justify-between p-6 bg-white shadow-md rounded-bl-lg">
            <h1 class="text-3xl font-semibold text-gray-800">Payment List</h1>
            <div class="flex items-center space-x-4">
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
                        <a href="<?= URLROOT; ?>/agent/logout"
                            class="block px-4 py-2 text-gray-700 hover:bg-gray-100 transition">
                            Logout
                        </a>
                    </div>
                </div>

                <!-- Alpine.js -->
                <script src="//unpkg.com/alpinejs" defer></script>

            </div>
        </header>

        <?php if (!empty($_SESSION['flash_message'])): ?>
            <?php
            $flash = $_SESSION['flash_message'];
            unset($_SESSION['flash_message']); // clear after showing
            ?>
            <div id="flashMessage" class="fixed top-4 left-1/2 transform -translate-x-1/2 
        px-6 py-3 rounded shadow-md text-white font-medium 
        <?= $flash['type'] === 'success' ? 'bg-green-500' : 'bg-red-500' ?>">
                <?= htmlspecialchars($flash['message']) ?>
            </div>
        <?php endif; ?>


        <!-- Payment List Content -->
        <main class="flex-1 overflow-y-auto p-6 bg-gray-100">
            <div class="max-w-6xl mx-auto bg-white p-8 rounded-xl shadow-md">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-semibold text-gray-800">All Payments</h2>
                    <!-- New Button added here -->
                    <a href="<?php echo URLROOT; ?>/agent/paymenttype"
                        class="text-white bg-[#1F265B] px-4 py-2 rounded-lg text-sm font-medium hover:bg-[#2A346C] transition-colors duration-200">
                        Go to Payment Types
                    </a>
                </div>

                <!-- Fixed Table Height -->
                <div class="overflow-x-auto h-[450px] flex">
                    <table class="min-w-full divide-y divide-gray-200 self-start w-full">
                        <thead class="bg-gray-50 sticky top-0 z-10">
                            <tr>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    ID
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Date
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Customer Name
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Payment Type
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Amount
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Screenshot
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody id="paymentsTableBody" class="bg-white divide-y divide-gray-200">
                            <!-- Payment Delivery Records -->
                            <?php foreach ($data['paymentdelivery'] as $res): ?>
                                <tr>
                                    <td class="px-6 py-4 text-sm font-medium text-gray-900 break-words max-w-[120px]">
                                        <?= htmlspecialchars($res['tracking_code'] ?? 'N/A') ?>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-500 break-words max-w-[150px]">
                                        <?= (new DateTime($res['created_at']))->format('Y-m-d g:i A') ?>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-500 break-words max-w-[150px]">
                                        <?= htmlspecialchars($res['receiver_customer_name']) ?>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-500">
                                        <p class="font-semibold text-gray-900">
                                            <?= htmlspecialchars($res['payment_type_name']) ?></p>
                                        <p class="text-xs"><?= htmlspecialchars($res['payment_method_name']) ?></p>
                                        <p class="text-xs text-gray-400">
                                            <?= htmlspecialchars($res['payment_method_number']) ?></p>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-500 break-words max-w-[120px]">
                                        $<?= htmlspecialchars($res['amount'] ?? 'N/A') ?>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-500">
                                        <img src="/Delivery/<?= htmlspecialchars($res['receipt_image']) ?>"
                                            alt="Payment Screenshot" class="w-16 h-16 rounded-lg"
                                            onclick="openImageModal(this.src)">
                                    </td>
                                    <td class="px-4 py-3 flex gap-2">
                                        <?php if ($res['delivery_status_name'] === 'payment_success'): ?>
                                            <span class="bg-green-100 text-green-600 px-2 py-1 rounded font-semibold">Payment
                                                Success</span>
                                        <?php elseif ($res['delivery_status_name'] === 'payment_reject'): ?>
                                            <span class="bg-red-100 text-red-600 px-2 py-1 rounded font-semibold">Payment
                                                Rejected</span>
                                        <?php endif; ?>

                                        <?php if (($res['delivery_status_name'] ?? '') === 'Waiting Payment'): ?>
                                            <!-- Accept Button -->
                                            <button
                                                onclick="openConfirmationModal('<?= htmlspecialchars((string)($res['id'] ?? '')) ?>', '<?= urlencode($res['tracking_code'] ?? $res['request_code'] ?? 'N/A') ?>', 'accepted')"
                                                class="text-white bg-green-600 px-4 py-2 rounded hover:bg-green-700 text-sm min-w-[80px]">
                                                Accept
                                            </button>

                                            <!-- Reject Button -->
                                            <button
                                                onclick="openConfirmationModal('<?= htmlspecialchars((string)($res['id'] ?? '')) ?>', '<?= urlencode($res['tracking_code'] ?? $res['request_code'] ?? 'N/A') ?>', 'rejected')"
                                                class="text-white bg-red-500 px-4 py-2 rounded hover:bg-red-600 text-sm min-w-[80px]">
                                                Reject
                                            </button>
                                        <?php endif; ?>

                                    </td>
                                </tr>
                            <?php endforeach; ?>

                            <!-- Regular Payment Records -->
                            <?php foreach ($data['payment'] as $res): ?>
                                <tr>
                                    <td class="px-6 py-4 text-sm font-medium text-gray-900 break-words max-w-[120px]">
                                        <?= htmlspecialchars($res['request_code'] ?? 'N/A') ?>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-500 break-words max-w-[150px]">
                                        <?= (new DateTime($res['updated_at']))->format('Y-m-d g:i A') ?>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-500 break-words max-w-[150px]">
                                        <?= htmlspecialchars($res['sender_name']) ?>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-500">
                                        <p class="font-semibold text-gray-900"><?= htmlspecialchars($res['payment_type']) ?>
                                        </p>
                                        <p class="text-xs"><?= htmlspecialchars($res['payment_method']) ?></p>
                                        <p class="text-xs text-gray-400"><?= htmlspecialchars($res['method_number']) ?></p>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-500 break-words max-w-[120px]">
                                        $<?= htmlspecialchars($res['amount'] ?? 'N/A') ?>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-500">
                                        <img src="/Delivery/<?= htmlspecialchars($res['method_image']) ?>"
                                            alt="Payment Screenshot" class="w-16 h-16 rounded-lg"
                                            onclick="openImageModal(this.src)">
                                    </td>
                                    <td class="px-4 py-3 flex gap-2">
                                        <?php if ($res['status'] === 'payment_success'): ?>
                                            <span class="bg-green-100 text-green-600 px-2 py-1 rounded font-semibold">Payment
                                                Success</span>
                                        <?php elseif ($res['status'] === 'payment_reject'): ?>
                                            <span class="bg-red-100 text-red-600 px-2 py-1 rounded font-semibold">Payment
                                                Rejected</span>
                                        <?php endif; ?>

                                        <!-- Accept/Reject Buttons for Regular Payment -->
                                        <?php if (($res['status'] ?? '') === 'receipt_submitted'): ?>
                                            <button
                                                onclick="openConfirmationModal('<?= addslashes($res['id']) ?>', '<?= addslashes($res['request_code']) ?>', 'accepted')"
                                                class="text-white bg-green-600 px-4 py-2 rounded hover:bg-green-700 text-sm min-w-[80px]">Accept</button>
                                            <button
                                                onclick="openConfirmationModal('<?= addslashes($res['id']) ?>', '<?= addslashes($res['request_code']) ?>', 'rejected')"
                                                class="text-white bg-red-500 px-4 py-2 rounded hover:bg-red-600 text-sm min-w-[80px]">Reject</button>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>

    <div id="imageModal"
        class="fixed inset-0 bg-black bg-opacity-80 flex items-center justify-center opacity-0 pointer-events-none transition-opacity duration-300 z-50">
        <div class="relative max-w-[90%] max-h-[90%]">
            <!-- Close Button -->
            <button onclick="closeImageModal()"
                class="absolute top-2 right-2 text-white text-3xl font-bold hover:text-red-500">&times;</button>
            <img id="modalImage" src="" class="w-full h-auto max-h-[90vh] rounded-lg shadow-2xl">
        </div>
    </div>

    <div id="confirmationModal"
        class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50 transition-opacity duration-300">
        <div
            class="bg-white rounded-xl w-96 p-6 relative shadow-lg transform transition-transform duration-300 scale-95">
            <!-- Icon & Title -->
            <div class="flex items-center gap-3 mb-4">
                <svg id="modalIcon" class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M13 16h-1v-4h-1m1-4h.01M12 12v.01M12 6v2m0 4v6"></path>
                </svg>
                <h3 class="text-lg font-semibold" id="modalTitle">Confirm Action</h3>
            </div>

            <!-- Message -->
            <p class="mb-6 text-gray-700" id="modalText">Are you sure?</p>

            <!-- Buttons -->
            <div class="flex justify-end gap-3">
                <button onclick="closeModal()"
                    class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">Cancel</button>
                <a href="#" id="confirmLink"
                    class="px-4 py-2 text-white rounded-lg hover:opacity-90 transition">Confirm</a>
            </div>

            <!-- Close X -->
            <button onclick="closeModal()"
                class="absolute top-2 right-2 text-gray-400 hover:text-gray-700 font-bold text-xl">&times;</button>
        </div>
    </div>



    <script>
        function openImageModal(src) {
            const modal = document.getElementById('imageModal');
            const modalImg = document.getElementById('modalImage');
            modalImg.src = src;
            modal.classList.remove('opacity-0', 'pointer-events-none');
            modal.classList.add('opacity-100');
        }

        function closeImageModal() {
            const modal = document.getElementById('imageModal');
            modal.classList.remove('opacity-100');
            modal.classList.add('opacity-0', 'pointer-events-none');
        }

        function openConfirmationModal(id, requestCode, status) {
            const modal = document.getElementById('confirmationModal');
            const confirmLink = document.getElementById('confirmLink');
            const modalText = document.getElementById('modalText');
            const modalTitle = document.getElementById('modalTitle');
            const modalIcon = document.getElementById('modalIcon');

            // Update the confirm link dynamically using both ID and request_code
            confirmLink.href =
                `<?= URLROOT; ?>/agentcontroller/confirmpayment?id=${id}&request_code=${requestCode}&status=${status}`;

            // Update modal text
            modalText.textContent = `Are you sure you want to ${status} payment with Request Code: ${requestCode}?`;

            // Style based on action
            if (status === 'accepted') {
                confirmLink.className = "px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition";
                modalIcon.className = "w-6 h-6 text-green-600";
                modalTitle.textContent = "Confirm Acceptance";
            } else if (status === 'rejected') {
                confirmLink.className = "px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition";
                modalIcon.className = "w-6 h-6 text-red-600";
                modalTitle.textContent = "Confirm Rejection";
            } else {
                confirmLink.className = "px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition";
                modalIcon.className = "w-6 h-6 text-blue-600";
                modalTitle.textContent = "Confirm Action";
            }

            // Show modal with animation
            modal.classList.remove('hidden');
            setTimeout(() => {
                modal.querySelector('div').classList.remove('scale-95');
                modal.querySelector('div').classList.add('scale-100');
            }, 10);
        }

        function closeModal() {
            const modal = document.getElementById('confirmationModal');
            const modalContent = modal.querySelector('div');
            modalContent.classList.remove('scale-100');
            modalContent.classList.add('scale-95');
            setTimeout(() => modal.classList.add('hidden'), 150);
        }

        document.addEventListener('DOMContentLoaded', () => {
            const flash = document.getElementById('flashMessage');
            if (flash) {
                setTimeout(() => {
                    flash.classList.add('opacity-0', 'transition', 'duration-500');
                    setTimeout(() => flash.remove(), 500);
                }, 3000); // hide after 3 seconds
            }
        });
    </script>
</body>

</html>