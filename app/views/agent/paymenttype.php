<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Placeholder for PHP include. In a real environment, you would use this.
require_once APPROOT . '/views/inc/agentsidebar.php';

?>

<body class="flex flex-col min-h-screen">
    <!-- Main Content Area -->
    <div class="flex-1 flex flex-col overflow-hidden">
        <!-- Header -->
        <header class="flex items-center justify-between p-6 bg-white shadow-md rounded-bl-lg">
            <h1 class="text-3xl font-semibold text-gray-800">Payment Types</h1>
            <div class="flex items-center space-x-4">
                <div class="flex items-center space-x-2">
                    <!-- Mock Admin Avatar -->
                    <img src="/Delivery/<?= htmlspecialchars($agent['profile_image']) ?>" alt="Cashier Avatar"
                        class="w-10 h-10 rounded-full border-2 border-blue-500">
                    <div>
                        <p class="text-lg font-medium text-gray-800"><?= htmlspecialchars($agent['name']) ?>
                        </p>
                        <p class="text-sm text-gray-500">Agent ID:
                            <?= htmlspecialchars($agent['access_code']) ?></p>
                    </div>
                </div>
            </div>
        </header>

        <!-- Payment Type List Content -->
        <main class="flex-1 overflow-y-auto p-6 bg-gray-100">
            <div class="max-w-6xl mx-auto bg-white p-8 rounded-xl shadow-md">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-semibold text-gray-800">All Payment Types</h2>
                    <div class="flex space-x-3">
                        <!-- Back Button -->
                        <a href="<?= URLROOT; ?>/agent/paymentlist"
                            class="px-4 py-2 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-100 transition">
                            Back
                        </a>


                        <!-- Add Payment Button -->
                        <button onclick="openModal()"
                            class="text-white bg-[#1F265B] px-4 py-2 rounded-lg text-sm font-medium hover:bg-[#2A346C] transition-colors duration-200">
                            Add New Payment
                        </button>
                    </div>
                </div>

                <!-- Fixed Table Height -->
                <?php if (!empty($_SESSION['flash_message'])): ?>
                    <?php
                    $flash = $_SESSION['flash_message'];
                    unset($_SESSION['flash_message']); // clear after showing
                    ?>
                    <div class="mb-4">
                        <div id="flashMessage" class="fixed top-4 left-1/2 transform -translate-x-1/2 
            px-6 py-3 rounded shadow-md text-white font-medium 
            <?= $flash['type'] === 'success' ? 'bg-green-500' : 'bg-red-500' ?>">
                            <?= htmlspecialchars($flash['message']) ?>
                        </div>
                    </div>
                <?php endif; ?>

                <div class="overflow-x-auto h-[450px] flex">
                    <table class="min-w-full divide-y divide-gray-200 self-start w-full">
                        <thead class="bg-gray-100 sticky top-0 z-10 shadow">
                            <tr>
                                <th
                                    class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Payment Type
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Bank Name
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Account Number
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Account Holder
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Screenshot
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php foreach ($data['allmethod'] as $res): ?>
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-3 text-sm font-medium max-w-[150px]">
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full
                    <?= strtolower($res['name']) === 'banking' ? 'bg-blue-100 text-blue-800' : '' ?>
                    <?= strtolower($res['name']) === 'online' ? 'bg-green-100 text-green-800' : '' ?>">
                                            <?= htmlspecialchars($res['name']) ?>
                                        </span>
                                    </td>
                                    <td class="px-6 py-3 text-sm text-gray-700 font-medium max-w-[150px]">
                                        <?= htmlspecialchars($res['method_name']) ?>
                                    </td>
                                    <td class="px-6 py-3 text-sm text-gray-500 max-w-[150px]">
                                        <?= htmlspecialchars($res['method_number']) ?>
                                    </td>
                                    <td class="px-6 py-3 text-sm text-gray-500 max-w-[150px]">
                                        <?= htmlspecialchars($res['account_name'] ?? $res['method_name']) ?>
                                    </td>
                                    <td class="px-6 py-3 text-sm text-gray-500">
                                        <?php if (!empty($res['method_image'])): ?>
                                            <img src="/Delivery/<?= htmlspecialchars($res['method_image']) ?>"
                                                alt="Payment Screenshot"
                                                class="w-24 h-12 rounded-lg cursor-pointer hover:scale-105 transition-transform shadow-sm"
                                                onclick="openImageModal(this.src)">
                                        <?php else: ?>
                                            <span class="text-gray-400 text-xs italic">No image</span>
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


    <!-- Realistic Image Modal -->
    <div id="imageModal"
        class="fixed inset-0 bg-black bg-opacity-80 flex items-center justify-center opacity-0 pointer-events-none transition-opacity duration-300 z-50">
        <div class="relative max-w-[90%] max-h-[90%]">
            <!-- Close Button -->
            <button onclick="closeImageModal()"
                class="absolute top-2 right-2 text-white text-3xl font-bold hover:text-red-500">&times;</button>
            <img id="modalImage" src="" class="w-full h-auto max-h-[90vh] rounded-lg shadow-2xl">
        </div>
    </div>



    <div id="addPaymentModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden z-50">
        <div class="bg-white rounded-2xl shadow-lg w-full max-w-md p-6">
            <h3 class="text-xl font-semibold text-gray-800 mb-4">Add New Payment</h3>

            <form action="<?php echo URLROOT; ?>/agentcontroller/addpayment" method="POST" enctype="multipart/form-data"
                class="space-y-4">

                <!-- Dropdown -->
                <div>
                    <label for="payment_type" class="block text-sm font-medium text-gray-700">Payment Type</label>
                    <select id="payment_type" name="payment_type" required
                        class="mt-1 block w-full border border-gray-300 rounded-lg p-2 focus:ring-[#1F265B] focus:border-[#1F265B]">
                        <option value="">-- Select Type --</option>
                        <option value=2>Online</option>
                        <option value=3>Banking</option>
                    </select>
                </div>

                <!-- Name -->
                <div>
                    <label for="payment_name" class="block text-sm font-medium text-gray-700">Payment Name</label>
                    <input type="text" id="payment_name" name="payment_name" required
                        class="mt-1 block w-full border border-gray-300 rounded-lg p-2 focus:ring-[#1F265B] focus:border-[#1F265B]">
                </div>

                <!-- Number -->
                <div>
                    <label for="payment_number" class="block text-sm font-medium text-gray-700">Payment Number</label>
                    <input type="number" id="payment_number" name="payment_number"
                        class="mt-1 block w-full border border-gray-300 rounded-lg p-2 focus:ring-[#1F265B] focus:border-[#1F265B]">
                </div>

                <div>
                    <label for="payment_number" class="block text-sm font-medium text-gray-700">Payment Holder</label>
                    <input type="text" id="payment_number" name="payment_holder"
                        class="mt-1 block w-full border border-gray-300 rounded-lg p-2 focus:ring-[#1F265B] focus:border-[#1F265B]">
                </div>

                <!-- Image Upload -->
                <div>
                    <label for="payment_image" class="block text-sm font-medium text-gray-700">Screenshot</label>
                    <input type="file" id="payment_image" name="payment_image" accept="image/*"
                        class="mt-1 block w-full border border-gray-300 rounded-lg p-2 focus:ring-[#1F265B] focus:border-[#1F265B]">
                </div>

                <!-- Buttons -->
                <div class="flex justify-end space-x-3 mt-6">
                    <button type="button" onclick="closeModal()"
                        class="px-4 py-2 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-100">
                        Cancel
                    </button>
                    <button type="submit" class="px-4 py-2 rounded-lg bg-[#1F265B] text-white hover:bg-[#2A346C]">
                        Save
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openModal() {
            document.getElementById('addPaymentModal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('addPaymentModal').classList.add('hidden');
        }

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

        // Optional: close modal when clicking outside the image
        document.getElementById('imageModal').addEventListener('click', function(e) {
            if (e.target.id === 'imageModal') closeImageModal();
        });
    </script>

</body>

</html>