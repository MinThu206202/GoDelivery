<?php require_once APPROOT . '/views/inc/agentsidebar.php';
$pickup = $data['pickup'];
$admin = $data['admin'];
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
            <div class="flex items-center space-x-4">
                <div class="flex items-center space-x-2">
                    <img src="/Delivery/<?= htmlspecialchars($agent['profile_image']) ?>" alt="Agent Avatar"
                        class="w-10 h-10 rounded-full border-2 border-blue-500">
                    <div>
                        <p class="text-lg font-medium text-gray-800"><?= htmlspecialchars($agent['name']) ?></p>
                        <p class="text-sm text-gray-500">Agent ID: <?= htmlspecialchars($agent['access_code']) ?></p>
                    </div>
                </div>
            </div>
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
                        $status = $pickup['status'] ?? 'N/A';


                        switch ($status) {
                            case 'pending':
                                $status_class = 'bg-yellow-100 text-yellow-800';
                                break;
                            case 'accepted':
                                $status_class = 'bg-blue-100 text-blue-800';
                                break;
                            case 'collected':
                                $status_class = 'bg-purple-100 text-purple-800';
                                break;
                            case 'voucher_created':
                                $status_class = 'bg-indigo-100 text-indigo-800';
                                break;
                            case 'delivered':
                                $status_class = 'bg-green-100 text-green-800';
                                break;
                            case 'arrived_office':
                                $status_class = 'bg-teal-100 text-teal-800';
                                break;
                            case 'rejected':
                                $status_class = 'bg-red-100 text-red-800';
                                break;
                            case 'agent_checked':
                                $status_class = 'bg-pink-100 text-pink-800';
                                break;
                            case 'awaiting_payment':
                                $status_class = 'bg-orange-100 text-orange-800';
                                break;
                            case 'payment_success':
                                $status_class = 'bg-emerald-100 text-emerald-800';
                                break;
                            default:
                                $status_class = 'bg-gray-100 text-gray-800';
                        }


                        ?>

                        <span class="px-3 py-1 inline-flex text-sm font-semibold rounded-full <?= $status_class ?>">
                            <?= ucfirst(htmlspecialchars($status)) ?>
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
                            <div>
                                <p class="text-sm font-medium text-gray-500">Receiver Agent Name</p>
                                <p class="mt-1 text-base font-semibold text-gray-900">
                                    <?= htmlspecialchars($admin['name']) ?></p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Receiver Township</p>
                                <p class="mt-1 text-base font-semibold text-gray-900">
                                    <?= htmlspecialchars($location['township_name']) ?></p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Township Status</p>
                                <?php
                                $status = strtolower($location['status_location_name'] ?? '');
                                switch ($status) {
                                    case 'active':
                                        $route_status_class = 'bg-green-100 text-green-800';
                                        break;
                                    case 'pending':
                                        $route_status_class = 'bg-yellow-100 text-yellow-800';
                                        break;
                                    default:
                                        $route_status_class = 'bg-red-100 text-red-800';
                                        break;
                                }
                                ?>
                                <span
                                    class="mt-1 text-sm font-semibold px-2 py-1 rounded-full <?= $route_status_class ?>">
                                    <?= ucfirst(htmlspecialchars($location['status_location_name'])) ?>
                                </span>
                            </div>

                            <div>
                                <p class="text-sm font-medium text-gray-500">Route Status</p>
                                <?php
                                $status = strtolower($route['status'] ?? '');
                                switch ($status) {
                                    case 'active':
                                        $route_status_class = 'bg-green-100 text-green-800';
                                        break;
                                    case 'pending':
                                        $route_status_class = 'bg-yellow-100 text-yellow-800';
                                        break;
                                    default:
                                        $route_status_class = 'bg-red-100 text-red-800';
                                        break;
                                }
                                ?>
                                <span
                                    class="mt-1 text-sm font-semibold px-2 py-1 rounded-full <?= $route_status_class ?>">
                                    <?= ucfirst(htmlspecialchars($route['status'])) ?>
                                </span>
                            </div>

                        </div>
                    </div>

                    <!-- Buttons at the end -->
                    <div class="flex justify-end pt-6 border-t border-gray-200 space-x-4">
                        <a href="javascript:history.back()"
                            class="px-6 py-3 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition-colors duration-200 shadow-md">
                            Back to Requests
                        </a>

                        <?php
                        // statuses where the Edit button should NOT be shown
                        $blockedStatuses = ['accepted', 'collected', 'voucher_created', 'rejected', 'agent_checked'];

                        if (!in_array($pickup['status'], $blockedStatuses)): ?>
                            <a href="<?php echo URLROOT; ?>/agent/edit_pickup?request_code=<?= urlencode($pickup['request_code']); ?>"
                                class="px-6 py-3 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600 transition-colors duration-200 shadow-md">
                                Edit Pickup
                            </a>
                        <?php endif; ?>

                        <?php if ($pickup['status'] === 'collected'): ?>
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