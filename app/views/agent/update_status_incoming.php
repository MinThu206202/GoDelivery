<?php require APPROOT . '/views/inc/agentsidebar.php'; ?>

<?php
$agent = $data['tracking_code'];
$user = $_SESSION['user'];
?>

<!-- Tailwind CSS & Fonts -->
<script src="https://cdn.tailwindcss.com"></script>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
body {
    font-family: 'Inter', sans-serif;
    background-color: #f3f4f6;
}
</style>

<div class="flex flex-1 overflow-hidden">
    <!-- Main Content -->
    <div class="flex-1 flex flex-col">

        <!-- Header -->
        <header class="flex items-center justify-between p-6 bg-white shadow-md rounded-bl-lg">
            <h1 class="text-2xl font-semibold text-gray-800"> Update Incoming Delivery Status</h1>

            <!-- Agent Dropdown -->
            <div x-data="{ open: false }" class="relative">
                <button @click="open = !open"
                    class="flex items-center space-x-3 bg-white border border-gray-300 px-4 py-2 rounded-lg shadow-sm hover:bg-gray-100 transition">
                    <img src="/Delivery/<?= htmlspecialchars($user['profile_image']) ?>" alt="Agent Avatar"
                        class="w-10 h-10 rounded-full border-2 border-blue-500 object-cover">
                    <div class="text-left">
                        <p class="text-lg font-medium text-gray-800"><?= htmlspecialchars($user['name']) ?></p>
                        <p class="text-sm text-gray-500">Agent ID: <?= htmlspecialchars($user['access_code']) ?></p>
                    </div>
                </button>

                <!-- Dropdown Menu -->
                <div x-show="open" @click.away="open = false" x-transition
                    class="absolute right-0 mt-2 w-48 bg-white border border-gray-200 rounded-lg shadow-lg py-2 z-50">
                    <a href="<?= URLROOT; ?>/agent/profile"
                        class="block px-4 py-2 text-gray-700 hover:bg-gray-100 transition">Profile</a>
                    <div class="border-t my-1"></div>
                    <a href="<?= URLROOT; ?>/agentcontroller/logout"
                        class="block px-4 py-2 text-gray-700 hover:bg-gray-100 transition">Logout</a>
                </div>
            </div>
        </header>

        <script src="//unpkg.com/alpinejs" defer></script>

        <!-- Page Content -->
        <main class="mt-8 px-6 mb-8">
            <div class="bg-white p-8 rounded-3xl shadow-xl border border-gray-200">

                <!-- Request Header -->
                <div class="flex justify-between items-center mb-8">
                    <h2 class="text-xl font-bold text-gray-800">
                        Tracking Code: <span
                            class="text-blue-700"><?= htmlspecialchars($agent['tracking_code']) ?></span>
                    </h2>
                    <?php
                    $statusClass = match (trim($agent['delivery_status'])) {
                        'Pending' => 'bg-yellow-100 text-yellow-800',
                        'Ready for Pickup' => 'bg-indigo-100 text-indigo-800',
                        'Delivered' => 'bg-green-100 text-green-800',
                        'Cancelled' => 'bg-red-100 text-red-800',
                        'Returned' => 'bg-purple-100 text-purple-800',
                        'Awaiting Acceptance' => 'bg-blue-100 text-blue-800',
                        'Rejected' => 'bg-red-200 text-red-900',
                        'Out for Delivery' => 'bg-blue-200 text-blue-900',
                        'Deliver Parcel' => 'bg-green-200 text-green-900',
                        'Waiting Payment' => 'bg-yellow-200 text-yellow-900',
                        'Receipt Submitted' => 'bg-indigo-200 text-indigo-900',
                        'Payment Success' => 'bg-green-300 text-green-900',
                        'On the Way' => 'bg-blue-300 text-blue-900',
                        'Rejected by Agent' => 'bg-red-300 text-red-900',
                        'Delivery at Office' => 'bg-indigo-300 text-indigo-900',
                        default => 'bg-gray-100 text-gray-800',
                    };
                    ?>
                    <span class="font-semibold px-4 py-2 rounded-full shadow-sm <?= $statusClass ?>">
                        <?= htmlspecialchars($agent['delivery_status']) ?>
                    </span>

                </div>

                <!-- Sender & Receiver Info -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <!-- Sender -->
                    <div class="p-6 rounded-2xl border bg-gray-50 shadow-sm">
                        <h3 class="text-lg font-semibold text-gray-700 mb-3">👤 Sender Information</h3>
                        <div class="space-y-1 text-gray-600 text-sm">
                            <p><span class="font-medium">Name:</span>
                                <?= htmlspecialchars($agent['sender_customer_name']) ?></p>
                            <p><span class="font-medium">Phone:</span>
                                <?= htmlspecialchars($agent['sender_customer_phone']) ?></p>
                            <p><span class="font-medium">Email:</span>
                                <?= htmlspecialchars($agent['sender_customer_email']) ?></p>
                            <p><span class="font-medium">Address:</span>
                                <?= htmlspecialchars($agent['sender_customer_address']) ?></p>
                            <p><span class="font-medium">Township:</span>
                                <?= htmlspecialchars($agent['from_township_name']) ?></p>
                        </div>
                    </div>

                    <!-- Receiver -->
                    <div class="p-6 rounded-2xl border bg-gray-50 shadow-sm">
                        <h3 class="text-lg font-semibold text-gray-700 mb-3">📍 Receiver Information</h3>
                        <div class="space-y-1 text-gray-600 text-sm">
                            <p><span class="font-medium">Name:</span>
                                <?= htmlspecialchars($agent['receiver_customer_name']) ?></p>
                            <p><span class="font-medium">Phone:</span>
                                <?= htmlspecialchars($agent['receiver_customer_phone']) ?></p>
                            <p><span class="font-medium">Email:</span>
                                <?= htmlspecialchars($agent['receiver_customer_email']) ?></p>
                            <p><span class="font-medium">Address:</span>
                                <?= htmlspecialchars($agent['receiver_customer_address']) ?></p>
                            <p><span class="font-medium">Township:</span>
                                <?= htmlspecialchars($agent['to_township_name']) ?></p>
                        </div>
                    </div>
                </div>

                <!-- Sender Agent & Parcel -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <!-- Sender Agent -->
                    <div class="p-6 rounded-2xl border bg-gray-50 shadow-sm">
                        <h3 class="text-lg font-semibold text-gray-700 mb-3">🧑‍💼 Sender Agent Information</h3>
                        <div class="space-y-1 text-gray-600 text-sm">
                            <p><span class="font-medium">Name:</span>
                                <?= htmlspecialchars($agent['sender_agent_name']) ?></p>
                            <p><span class="font-medium">Contact:</span>
                                <?= htmlspecialchars($agent['sender_agent_phone']) ?></p>
                        </div>
                    </div>

                    <!-- Parcel -->
                    <div class="p-6 rounded-2xl border bg-gray-50 shadow-sm">
                        <h3 class="text-lg font-semibold text-gray-700 mb-3">📦 Parcel Details</h3>
                        <div class="space-y-1 text-gray-600 text-sm">
                            <p><span class="font-medium">Type:</span> <?= htmlspecialchars($agent['product_type']) ?>
                            </p>
                            <p><span class="font-medium">Weight:</span> <?= htmlspecialchars($agent['weight']) ?> kg</p>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex justify-end gap-4 mt-8">
                    <!-- Back -->
                    <a href="<?= URLROOT ?>/agent/incoming">
                        <button
                            class="px-6 py-3 bg-gray-200 text-gray-700 font-semibold rounded-xl shadow-lg hover:bg-gray-300 transition">
                            Back
                        </button>
                    </a>

                    <!-- Arrived at Office -->
                    <?php if ($agent['delivery_status'] === 'On the Way'): ?>
                    <a href="<?= URLROOT ?>/agentcontroller/arrived_at_office?id=<?= $agent['id'] ?>"
                        class="px-6 py-3 bg-blue-600 text-white font-semibold rounded-xl shadow-lg hover:bg-blue-700 transition">
                        Arrived at Office
                    </a>
                    <?php endif; ?>

                    <?php if ($agent['delivery_status'] === 'Returned'): ?>
                    <a href="<?= URLROOT ?>/agentcontroller/return_page?id=<?= $agent['id'] ?>"
                        class="px-6 py-3 bg-red-600 text-white font-semibold rounded-xl shadow-lg hover:bg-red-700 transition">
                        Return
                    </a>
                    <?php endif; ?>


                </div>
            </div>
        </main>
    </div>
</div>