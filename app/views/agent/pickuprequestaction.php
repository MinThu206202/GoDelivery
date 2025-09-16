<?php require_once APPROOT . '/views/inc/agentsidebar.php';
$pickup = $data['pickup'];
// $admin = $data['admin'];
$location = $data['location'];
$route = $data['route'];
?>
<style>
body {
    font-family: 'Inter', sans-serif;
    background-color: #f3f4f6;
}

.status-pending {
    background-color: #fef3c7;
    /* yellow-100 */
    color: #b45309;
    /* amber-700 */
}
</style>


<body class="bg-gray-100 antialiased">
    <div class="flex-1 flex flex-col overflow-hidden min-h-screen">
        <!-- Header -->
        <header class="flex items-center justify-between p-6 bg-white shadow-md rounded-bl-lg">
            <h1 class="text-3xl font-semibold text-gray-800">Pickup Requests Detail</h1>
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
                    <a href="<?= URLROOT; ?>/agentcontroller/logout"
                        class="block px-4 py-2 text-gray-700 hover:bg-gray-100 transition">
                        Logout
                    </a>
                </div>
            </div>

            <!-- Alpine.js -->
            <script src="//unpkg.com/alpinejs" defer></script>

        </header>

        <!-- Main Content Area -->
        <main class="flex-1 overflow-y-auto p-6 bg-gray-100">
            <div class="max-w-4xl mx-auto">
                <!-- Back Button at the top-->
                <div class="mb-6">
                    <a href="javascript:history.back()"
                        class="flex items-center text-gray-600 hover:text-gray-900 transition-colors duration-200">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7">
                            </path>
                        </svg>
                        Back to Requests
                    </a>
                </div>

                <!-- Detail Card -->
                <div class="bg-white p-8 rounded-xl shadow-md space-y-8">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-2xl font-bold text-gray-800">Request:
                            <?= htmlspecialchars($pickup['request_code']) ?></h2>
                        <?php
                        $status = strtolower($pickup['status'] ?? 'default');

                        $statusClasses = [
                            'pending'                     => 'bg-yellow-500',
                            'accepted'                    => 'bg-indigo-500',
                            'collected'                   => 'bg-orange-600',
                            'voucher_created'             => 'bg-purple-600',
                            'delivered'                   => 'bg-green-500',
                            'arrived_office'              => 'bg-teal-500',
                            'rejected'                    => 'bg-red-500',
                            'agent_checked'               => 'bg-pink-500',
                            'arrived_at_office' => 'bg-blue-400',
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

                        $status_class = $statusClasses[$status] ?? $statusClasses['default'];
                        ?>

                        <span
                            class="px-3 py-1 inline-flex text-sm font-bold rounded-full shadow-md text-white capitalize <?= $status_class ?>  whitespace-nowrap leading-tight"
                            title="<?= htmlspecialchars(str_replace('_', ' ', $status)) ?>">
                            <?= htmlspecialchars(str_replace('_', ' ', $status)) ?>
                        </span>

                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-6">
                        <!-- Sender Information -->
                        <div class="space-y-4">
                            <h3 class="text-xl font-semibold text-gray-700 border-b pb-2">Sender Information</h3>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Name</p>
                                <p class="mt-1 text-base font-semibold text-gray-900">
                                    <?= htmlspecialchars($pickup['sender_name']) ?></p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Contact Number</p>
                                <p class="mt-1 text-base font-semibold text-gray-900">
                                    <?= htmlspecialchars($pickup['sender_phone']) ?></p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Email</p>
                                <p class="mt-1 text-base font-semibold text-gray-900">
                                    <?= htmlspecialchars($pickup['sender_email']) ?></p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Pickup Address</p>
                                <p class="mt-1 text-base font-semibold text-gray-900">
                                    <?= htmlspecialchars($pickup['sender_address']) ?>
                                </p>
                            </div>
                            <!-- <div>
                                <p class="text-sm font-medium text-gray-500">Region</p>
                                <p class="mt-1 text-base font-semibold text-gray-900">
                                    <?= htmlspecialchars($pickup['sender_region']) ?>
                                </p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">City</p>
                                <p class="mt-1 text-base font-semibold text-gray-900">
                                    <?= htmlspecialchars($pickup['sender_city']) ?>
                                </p>
                            </div> -->
                            <div>
                                <p class="text-sm font-medium text-gray-500">Township</p>
                                <p class="mt-1 text-base font-semibold text-gray-900">
                                    <?= htmlspecialchars($pickup['sender_township']) ?>
                                </p>
                            </div>
                        </div>

                        <!-- Receiver Information -->
                        <div class="space-y-4">
                            <h3 class="text-xl font-semibold text-gray-700 border-b pb-2">Receiver Information</h3>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Name</p>
                                <p class="mt-1 text-base font-semibold text-gray-900">
                                    <?= htmlspecialchars($pickup['receiver_name']) ?></p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Contact Number</p>
                                <p class="mt-1 text-base font-semibold text-gray-900">
                                    <?= htmlspecialchars($pickup['receiver_phone']) ?></p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Email</p>
                                <p class="mt-1 text-base font-semibold text-gray-900">
                                    <?= htmlspecialchars($pickup['receiver_email']) ?></p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Delivery Address</p>
                                <p class="mt-1 text-base font-semibold text-gray-900">
                                    <?= htmlspecialchars($pickup['receiver_address']) ?>
                                </p>
                            </div>
                            <!-- <div>
                                <p class="text-sm font-medium text-gray-500">Region</p>
                                <p class="mt-1 text-base font-semibold text-gray-900">
                                    <?= htmlspecialchars($pickup['receiver_region']) ?>
                                </p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">City</p>
                                <p class="mt-1 text-base font-semibold text-gray-900">
                                    <?= htmlspecialchars($pickup['receiver_city']) ?>
                                </p>
                            </div> -->
                            <div>
                                <p class="text-sm font-medium text-gray-500">Township</p>
                                <p class="mt-1 text-base font-semibold text-gray-900">
                                    <?= htmlspecialchars($pickup['receiver_township']) ?>
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Parcel Details -->
                    <div class="space-y-4 pt-6 border-t border-gray-200">
                        <h3 class="text-xl font-semibold text-gray-700 border-b pb-2">Parcel & Request Details</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-6">
                            <div>
                                <p class="text-sm font-medium text-gray-500">Parcel Type</p>
                                <p class="mt-1 text-base font-semibold text-gray-900">
                                    <?= htmlspecialchars($pickup['parcel_type']) ?></p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Parcel Weight</p>
                                <p class="mt-1 text-base font-semibold text-gray-900">
                                    <?= htmlspecialchars($pickup['weight']) ?> kg</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Number of Items</p>
                                <p class="mt-1 text-base font-semibold text-gray-900">
                                    <?= htmlspecialchars($pickup['quantity']) ?></p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Requested Date & Time</p>
                                <p class="mt-1 text-base font-semibold text-gray-900">
                                    <?= htmlspecialchars($pickup['created_at']) ?></p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Payment Type</p>
                                <p class="mt-1 text-base font-semibold text-gray-900">
                                    <?= htmlspecialchars($pickup['payment_status_name']) ?></p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Delivery Type</p>
                                <p class="mt-1 text-base font-semibold text-gray-900">
                                    <?= htmlspecialchars($pickup['delivery_type_name']) ?></p>
                            </div>
                        </div>
                    </div>

                    <!-- Agent & Route Details -->
                    <div class="space-y-4 pt-6 border-t border-gray-200">
                        <h3 class="text-xl font-semibold text-gray-700 border-b pb-2">Agent & Route Details</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-6">

                            <!-- Receiver Agent Name + Badge Side by Side -->
                            <div>
                                <p class="text-sm font-medium text-gray-500">Receiver Agent Name</p>
                                <div class="flex items-center gap-2 mt-1">
                                    <?php
                                    if (empty($location['agent_name'])) {
                                        // If agent_name is NULL or empty
                                        $agentName = "Agent Not Yet";
                                        $agentStatus = "Pending";
                                        $statusClass = "bg-yellow-100 text-yellow-800";
                                    } else {
                                        $agentName = htmlspecialchars($location['agent_name']);
                                        $agentStatus = ucfirst(htmlspecialchars($location['agent_status_name'] ?? 'N/A'));

                                        // Status color
                                        switch (strtolower($location['agent_status_name'] ?? '')) {
                                            case 'active':
                                                $statusClass = "bg-green-100 text-green-800";
                                                break;
                                            case 'pending':
                                                $statusClass = "bg-yellow-100 text-yellow-800";
                                                break;
                                            case 'inactive':   // 👈 Added this
                                                $statusClass = "bg-gray-200 text-gray-800";
                                                break;
                                            default:
                                                $statusClass = "bg-red-100 text-red-800";
                                                break;
                                        }
                                    }
                                    ?>
                                    <p class="text-base font-semibold text-gray-900"><?= $agentName ?></p>
                                    <span class="text-sm font-semibold px-2 py-1 rounded-full <?= $statusClass ?>">
                                        <?= $agentStatus ?>
                                    </span>
                                </div>
                            </div>


                            <!-- Receiver Township -->
                            <div>
                                <p class="text-sm font-medium text-gray-500">Receiver Township</p>
                                <div class="flex items-center gap-2 mt-1">
                                    <p class="text-base font-semibold text-gray-900">
                                        <?= htmlspecialchars($location['township_name'] ?? 'N/A') ?>
                                    </p>
                                    <?php
                                    $status = strtolower($location['status_location_name'] ?? '');
                                    switch ($status) {
                                        case 'active':
                                            $route_status_class = "bg-green-100 text-green-800";
                                            break;
                                        case 'pending':
                                            $route_status_class = "bg-yellow-100 text-yellow-800";
                                            break;
                                        case 'inactive':
                                            $route_status_class = "bg-gray-200 text-gray-800";
                                            break;
                                        default:
                                            $route_status_class = "bg-red-100 text-red-800";
                                            break;
                                    }
                                    ?>
                                    <span
                                        class="text-sm font-semibold px-2 py-1 rounded-full <?= $route_status_class ?>">
                                        <?= ucfirst(htmlspecialchars($location['status_location_name'] ?? 'N/A')) ?>
                                    </span>
                                </div>
                            </div>


                            <!-- Township Status -->
                            <div>
                                <p class="text-sm font-medium text-gray-500">Route Status</p>
                                <div class="flex items-center gap-2 mt-1">
                                    <?php
                                    $from = $route['from_township'] ?? null;
                                    $to   = $route['to_township'] ?? null;
                                    $status = strtolower($route['status'] ?? '');

                                    if (empty($from) && empty($to)) {
                                        // Case: No route yet
                                        $route_text = "Route Not Yet";
                                        $status_text = "Pending";
                                        $route_status_class = "bg-yellow-100 text-yellow-800";
                                    } else {
                                        // Case: Show real route
                                        $route_text = htmlspecialchars($from) . " -> " . htmlspecialchars($to);
                                        $status_text = ucfirst(htmlspecialchars($route['status'] ?? 'N/A'));

                                        switch ($status) {
                                            case 'active':
                                                $route_status_class = "bg-green-100 text-green-800";
                                                break;
                                            case 'pending':
                                                $route_status_class = "bg-yellow-100 text-yellow-800";
                                                break;
                                            case 'inactive':
                                                $route_status_class = "bg-gray-200 text-gray-800";
                                                break;
                                            default:
                                                $route_status_class = "bg-red-100 text-red-800";
                                                break;
                                        }
                                    }
                                    ?>
                                    <p class="text-base font-semibold text-gray-900">
                                        <?= $route_text ?>
                                    </p>
                                    <span
                                        class="text-sm font-semibold px-2 py-1 rounded-full <?= $route_status_class ?>">
                                        <?= $status_text ?>
                                    </span>
                                </div>
                            </div>




                        </div>
                    </div>


                    <!-- Buttons at the end -->
                    <div class="flex justify-end pt-6 border-t border-gray-200 space-x-4">
                        <a href=" <?php echo URLROOT; ?>/agent/requestpickup"
                            class="px-6 py-3 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition-colors duration-200 shadow-md">
                            Back to Requests
                        </a>

                        <?php
                        // statuses where the Edit button should NOT be shown
                        $blockedStatuses = ['accepted', 'collected', 'voucher_created', 'rejected', 'agent_checked', 'cash_collected', 'arrived_at_office', 'payment_success'];

                        if (!in_array($pickup['status'], $blockedStatuses)): ?>
                        <a href="<?php echo URLROOT; ?>/agent/edit_pickup?request_code=<?= urlencode($pickup['request_code']); ?>"
                            class="px-6 py-3 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600 transition-colors duration-200 shadow-md">
                            Edit Pickup
                        </a>
                        <?php endif; ?>

                        <?php if ($pickup['status'] === 'cash_collected'   || $pickup['status'] === 'payment_success'): ?>
                        <a href="<?php echo URLROOT; ?>/agentcontroller/create_voucher_pickup?request_code=<?= urlencode($pickup['request_code']); ?>"
                            class="px-6 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors duration-200 shadow-md">
                            Create Voucher
                        </a>
                        <?php endif; ?>
                    </div>


                </div>
            </div>
        </main>
    </div>
</body>

</html>