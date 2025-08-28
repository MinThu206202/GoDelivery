<?php require_once APPROOT . '/views/inc/agentsidebar.php';
$pickup = $data['pickup'];
$location = $data['location'];
$route = $data['route'];
$availableAgents = $data['availableAgents'];
?>

<script src="https://cdn.tailwindcss.com"></script>

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

    .status-on-hold {
        background-color: #fef9c3;
        color: #ca8a04;
    }

    .status-picked-up {
        background-color: #d1fae5;
        color: #065f46;
    }

    .status-canceled {
        background-color: #fee2e2;
        color: #991b1b;
    }

    .status-available {
        background-color: #d1fae5;
        color: #065f46;
    }

    .status-active {
        background-color: #d1fae5;
        color: #065f46;
    }

    .status-pending-location {
        background-color: #fef3c7;
        color: #b45309;
    }
</style>

<body class="bg-gray-100 antialiased">
    <div class="flex-1 flex flex-col overflow-hidden min-h-screen">
        <!-- Header -->
        <header class="flex items-center justify-between p-6 bg-white shadow-md rounded-bl-lg">
            <h1 class="text-3xl font-semibold text-gray-800">Edit Pickup Request</h1>
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
                <form action="<?php echo URLROOT; ?>/agentcontroller/pickupupdate" method="POST"
                    class="bg-white p-8 rounded-xl shadow-md space-y-8">
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center space-x-4">
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
                                'cancelled'                   => 'bg-gray-600',
                                'arrived_at_user'             => 'bg-green-600',
                                'pickup_failed'               => 'bg-red-600',
                                'default'                     => 'bg-gray-400'
                            ];

                            $status_class = $statusClasses[$status] ?? $statusClasses['default'];
                            ?>

                            <span
                                class="px-4 py-2 inline-flex text-sm font-bold rounded-full shadow-md text-white capitalize <?= $status_class ?>">
                                <?= htmlspecialchars(str_replace('_', ' ', $status)) ?>
                            </span>

                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-6">
                        <!-- Sender Information (Read-only) -->
                        <div class="space-y-4">
                            <h3 class="text-xl font-semibold text-gray-700 border-b pb-2">Sender Information</h3>
                            <div>
                                <label for="sender_name" class="flex items-center text-sm font-medium text-gray-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-gray-400"
                                        viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    Name
                                </label>
                                <input type="text" id="sender_name" name="sender_name"
                                    value="<?= htmlspecialchars($pickup['sender_name']) ?>"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 bg-gray-100 cursor-not-allowed"
                                    readonly>
                            </div>
                            <div>
                                <label for="sender_phone" class="flex items-center text-sm font-medium text-gray-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-gray-400"
                                        viewBox="0 0 20 20" fill="currentColor">
                                        <path
                                            d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.774a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z" />
                                    </svg>
                                    Contact Number
                                </label>
                                <input type="text" id="sender_phone" name="sender_phone"
                                    value="<?= htmlspecialchars($pickup['sender_phone']) ?>"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 bg-gray-100 cursor-not-allowed"
                                    readonly>
                            </div>
                            <!-- More sender fields would go here, all set to readonly -->
                        </div>

                        <!-- Receiver Information (Read-only) -->
                        <div class="space-y-4">
                            <h3 class="text-xl font-semibold text-gray-700 border-b pb-2">Receiver Information</h3>
                            <div>
                                <label for="receiver_name" class="flex items-center text-sm font-medium text-gray-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-gray-400"
                                        viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    Name
                                </label>
                                <input type="text" id="receiver_name" name="receiver_name"
                                    value="<?= htmlspecialchars($pickup['receiver_name']) ?>"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 bg-gray-100 cursor-not-allowed"
                                    readonly>
                            </div>
                            <div>
                                <label for="receiver_phone" class="flex items-center text-sm font-medium text-gray-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-gray-400"
                                        viewBox="0 0 20 20" fill="currentColor">
                                        <path
                                            d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.774a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z" />
                                    </svg>
                                    Contact Number
                                </label>
                                <input type="text" id="receiver_phone" name="receiver_phone"
                                    value="<?= htmlspecialchars($pickup['receiver_phone']) ?>"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 bg-gray-100 cursor-not-allowed"
                                    readonly>
                            </div>
                            <!-- More receiver fields would go here, all set to readonly -->
                        </div>
                    </div>

                    <!-- Status and Location Information (Read-only) -->
                    <?php if ($pickup['status'] === 'pending'): ?>
                        <div class="space-y-6 pt-6 border-t border-gray-200">
                            <h3 class="text-xl font-semibold text-gray-700 border-b pb-2">Status & Location</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-6">

                                <!-- Receiver Agent Status -->
                                <div class="space-y-4">
                                    <div>
                                        <label for="receiver_agent_name"
                                            class="flex items-center text-sm font-medium text-gray-500">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-gray-400"
                                                viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd"
                                                    d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            Receiver Agent
                                        </label>
                                        <?php
                                        $agentName = $location['agent_name'] ?? null;
                                        $displayAgent = $agentName ? htmlspecialchars($agentName) : 'Agent is not yet';
                                        ?>
                                        <input type="text" id="receiver_agent_name" name="receiver_agent_name"
                                            value="<?= $displayAgent ?>" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 
                   focus:ring focus:ring-indigo-200 focus:ring-opacity-50 bg-gray-100 cursor-not-allowed" readonly>
                                    </div>

                                    <div>
                                        <label for="receiver_agent_status"
                                            class="flex items-center text-sm font-medium text-gray-500">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-gray-400"
                                                viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd"
                                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            Receiver Agent Status
                                        </label>
                                        <?php
                                        if (!$agentName) {
                                            // If agent name is NULL → force Pending
                                            $statusLabel = "Pending";
                                            $agent_status_class = 'bg-yellow-100 text-yellow-800';
                                        } else {
                                            $status = strtolower($location['status_location_name'] ?? 'inactive');
                                            $statusLabel = ucfirst($status);
                                            $agent_status_class = match ($status) {
                                                'active' => 'bg-green-100 text-green-800',
                                                'inactive' => 'bg-gray-200 text-gray-800',
                                                'pending' => 'bg-yellow-100 text-yellow-800',
                                                default => 'bg-blue-100 text-blue-800',
                                            };
                                        }
                                        ?>
                                        <span
                                            class="mt-1 px-3 py-1 inline-flex text-sm font-semibold rounded-full <?= $agent_status_class ?>">
                                            <?= htmlspecialchars($statusLabel) ?>
                                        </span>
                                    </div>
                                </div>


                                <!-- Route Status -->
                                <div class="space-y-4">
                                    <div>
                                        <label for="route_name" class="flex items-center text-sm font-medium text-gray-500">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-gray-400"
                                                viewBox="0 0 20 20" fill="currentColor">
                                                <path
                                                    d="M10 2a8 8 0 100 16 8 8 0 000-16zm-1 11a1 1 0 112 0v2a1 1 0 11-2 0v-2zM8 8a1 1 0 112 0v1a1 1 0 11-2 0V8z" />
                                            </svg>
                                            Route Name
                                        </label>
                                        <input type="text" id="route_name" name="route_name"
                                            value="<?= empty($route['from_township']) || empty($route['to_township'])
                                                        ? 'Route not available'
                                                        : htmlspecialchars($route['from_township'] . ' → ' . $route['to_township']) ?>" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 
                               focus:ring focus:ring-indigo-200 focus:ring-opacity-50 bg-gray-100 cursor-not-allowed"
                                            readonly>
                                    </div>
                                    <div>
                                        <label for="route_status"
                                            class="flex items-center text-sm font-medium text-gray-500">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-gray-400"
                                                viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd"
                                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            Route Status
                                        </label>
                                        <?php
                                        $route_status = empty($route['from_township']) || empty($route['to_township'])
                                            ? 'pending' : strtolower($route['status'] ?? 'pending');
                                        $route_status_class = match ($route_status) {
                                            'pending' => 'bg-yellow-100 text-yellow-800',
                                            'active' => 'bg-green-100 text-green-800',
                                            'inactive' => 'bg-gray-200 text-gray-800',
                                            default => 'bg-blue-100 text-blue-800',
                                        };
                                        ?>
                                        <span
                                            class="mt-1 px-3 py-1 inline-flex text-sm font-semibold rounded-full <?= $route_status_class ?>">
                                            <?= ucfirst(htmlspecialchars($route_status)) ?>
                                        </span>
                                    </div>
                                </div>

                                <!-- Location Status -->
                                <div class="space-y-4">
                                    <div>
                                        <label for="location_name"
                                            class="flex items-center text-sm font-medium text-gray-500">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-gray-400"
                                                viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd"
                                                    d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            Receiver Location
                                        </label>
                                        <input type="text" id="location_name" name="location_name"
                                            value="<?= htmlspecialchars($location['township_name'] ?? 'N/A') ?>" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 
                               focus:ring focus:ring-indigo-200 focus:ring-opacity-50 bg-gray-100 cursor-not-allowed"
                                            readonly>
                                    </div>
                                    <div>
                                        <label for="location_status"
                                            class="flex items-center text-sm font-medium text-gray-500">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-gray-400"
                                                viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd"
                                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            Location Status
                                        </label>
                                        <?php
                                        $loc_status = strtolower($location['status_location_name'] ?? 'inactive');
                                        $loc_status_class = match ($loc_status) {
                                            'pending' => 'bg-yellow-100 text-yellow-800',
                                            'active' => 'bg-green-100 text-green-800',
                                            'inactive' => 'bg-gray-200 text-gray-800',
                                            'delivered' => 'bg-blue-100 text-blue-800',
                                            default => 'bg-gray-100 text-gray-600',
                                        };
                                        ?>
                                        <span
                                            class="mt-1 px-3 py-1 inline-flex text-sm font-semibold rounded-full <?= $loc_status_class ?>">
                                            <?= ucfirst(htmlspecialchars($location['status_location_name'] ?? 'Inactive')) ?>
                                        </span>
                                    </div>
                                </div>

                            </div>
                        </div>
                    <?php endif; ?>


                    <?php if ($pickup['status'] === 'pickup_verification_pending'): ?>

                        <div class="space-y-6 pt-6 border-t border-gray-200">
                            <h3 class="text-xl font-semibold text-gray-700 border-b pb-2">Pickup Information</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-6">

                                <!-- Weight -->
                                <div class="space-y-4">
                                    <div>
                                        <label for="weight" class="flex items-center text-sm font-medium text-gray-700">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1 text-gray-500"
                                                viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd"
                                                    d="M4 3a1 1 0 00-1 1v2a5 5 0 005 5h4a5 5 0 005-5V4a1 1 0 00-1-1H4zm1 3V5h10v1a3 3 0 01-3 3H8a3 3 0 01-3-3z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            Weight
                                        </label>
                                        <input type="text" id="weight" name="weight"
                                            value="<?= htmlspecialchars($pickup['weight'] ?? 'N/A') ?>" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm 
                    focus:border-indigo-300 focus:ring focus:ring-indigo-200 
                    focus:ring-opacity-50 bg-gray-100 cursor-not-allowed" readonly>
                                    </div>
                                </div>

                                <!-- Amount -->
                                <div class="space-y-4">
                                    <div>
                                        <label for="amount" class="flex items-center text-sm font-medium text-gray-700">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1 text-gray-500"
                                                viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd"
                                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm-1-9V6h2v3h3v2h-3v3h-2v-3H6V9h3z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            Amount
                                        </label>
                                        <input type="text" id="amount" name="amount"
                                            value="<?= htmlspecialchars($pickup['amount'] ?? 'N/A') ?>" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm 
                    focus:border-indigo-300 focus:ring focus:ring-indigo-200 
                    focus:ring-opacity-50 bg-gray-100 cursor-not-allowed" readonly>
                                    </div>
                                </div>

                                <!-- Quantity -->
                                <div class="space-y-4">
                                    <div>
                                        <label for="quantity" class="flex items-center text-sm font-medium text-gray-700">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1 text-gray-500"
                                                viewBox="0 0 20 20" fill="currentColor">
                                                <path
                                                    d="M4 3h12a1 1 0 011 1v2H3V4a1 1 0 011-1zm0 4h14v9a1 1 0 01-1 1H4a1 1 0 01-1-1V7z" />
                                            </svg>
                                            Quantity
                                        </label>
                                        <input type="text" id="quantity" name="quantity"
                                            value="<?= htmlspecialchars($pickup['quantity'] ?? 'N/A') ?>" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm 
                    focus:border-indigo-300 focus:ring focus:ring-indigo-200 
                    focus:ring-opacity-50 bg-gray-100 cursor-not-allowed" readonly>
                                    </div>
                                </div>

                                <!-- Delivery Type -->
                                <div class="space-y-4">
                                    <div>
                                        <label for="delivery_type"
                                            class="flex items-center text-sm font-medium text-gray-700">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1 text-gray-500"
                                                viewBox="0 0 20 20" fill="currentColor">
                                                <path
                                                    d="M3 5a2 2 0 012-2h6a2 2 0 012 2v2h2a2 2 0 012 2v2.586l-2 2V15a2 2 0 01-2 2H9.414l-2-2H5a2 2 0 01-2-2V5z" />
                                            </svg>
                                            Delivery Type
                                        </label>
                                        <input type="text" id="delivery_type" name="delivery_type"
                                            value="<?= htmlspecialchars($pickup['delivery_type_name'] ?? 'N/A') ?>" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm 
                    focus:border-indigo-300 focus:ring focus:ring-indigo-200 
                    focus:ring-opacity-50 bg-gray-100 cursor-not-allowed" readonly>
                                    </div>
                                </div>

                                <!-- Payment Type -->
                                <div class="space-y-4">
                                    <div>
                                        <label for="payment_type"
                                            class="flex items-center text-sm font-medium text-gray-700">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1 text-gray-500"
                                                viewBox="0 0 20 20" fill="currentColor">
                                                <path
                                                    d="M4 4h12a2 2 0 012 2v2H2V6a2 2 0 012-2zm-2 6h16v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z" />
                                            </svg>
                                            Payment Option
                                        </label>
                                        <input type="text" id="payment_type" name="payment_type"
                                            value="<?= htmlspecialchars($pickup['payment_status_name'] ?? 'N/A') ?>" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm 
                    focus:border-indigo-300 focus:ring focus:ring-indigo-200 
                    focus:ring-opacity-50 bg-gray-100 cursor-not-allowed" readonly>
                                    </div>
                                </div>

                                <div class="space-y-4">
                                    <div>
                                        <label for="payment_type"
                                            class="flex items-center text-sm font-medium text-gray-700">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1 text-gray-500"
                                                viewBox="0 0 20 20" fill="currentColor">
                                                <path
                                                    d="M4 4h12a2 2 0 012 2v2H2V6a2 2 0 012-2zm-2 6h16v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z" />
                                            </svg>
                                            Parcel Type
                                        </label>
                                        <input type="text" id="payment_type" name="payment_type"
                                            value="<?= htmlspecialchars($pickup['parcel_type'] ?? 'N/A') ?>" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm 
                    focus:border-indigo-300 focus:ring focus:ring-indigo-200 
                    focus:ring-opacity-50 bg-gray-100 cursor-not-allowed" readonly>
                                    </div>
                                </div>

                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if ($pickup['status'] === 'pending'): ?>
                        <!-- Editable Fields: Update Status & Pickup Agent -->
                        <div class="space-y-6 pt-6 border-t border-gray-200">
                            <h3 class="text-xl font-semibold text-gray-700 border-b pb-2">Update Request</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-6">
                                <!-- Update Status -->
                                <div class="space-y-4">
                                    <div>
                                        <label for="status" class="flex items-center text-sm font-medium text-gray-700">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1 text-gray-500"
                                                viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd"
                                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            Update Status
                                        </label>
                                        <select id="status" name="status" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 
           focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 
           sm:text-sm rounded-md shadow-sm">
                                            <option value="2" <?= ($pickup['status'] == 2) ? 'selected' : '' ?>>Accepted
                                            </option>
                                            <option value="7" <?= ($pickup['status'] == 7) ? 'selected' : '' ?>>Rejected
                                            </option>
                                        </select>

                                    </div>
                                </div>

                                <input type="hidden" name="id" value="<?= htmlspecialchars($pickup['id']) ?>">
                                <input type="hidden" name="pickup_code"
                                    value="<?= htmlspecialchars($pickup['request_code']) ?>">


                                <!-- Pickup Agent -->
                                <div class="space-y-4">
                                    <div>
                                        <label for="pickup_agent"
                                            class="flex items-center text-sm font-medium text-gray-700">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1 text-gray-500"
                                                viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd"
                                                    d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            Pickup Agent
                                        </label>
                                        <select id="pickup_agent" name="pickup_agent"
                                            class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md shadow-sm">
                                            <option value="">Select an Agent</option>
                                            <?php foreach ($availableAgents as $agent) : ?>
                                                <option value="<?= htmlspecialchars($agent['id']) ?>">
                                                    <?= htmlspecialchars($agent['name']) ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>



                        <!-- Notes field -->
                        <div class="space-y-4 pt-6 border-t border-gray-200">
                            <label for="note" class="flex items-center text-sm font-medium text-gray-700">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1 text-gray-500"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 2h2v4H6V6zm5 0h2v4h-2V6z"
                                        clip-rule="evenodd" />
                                </svg>
                                Notes
                            </label>
                            <textarea id="note" name="note" rows="4"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"></textarea>
                        </div>
                    <?php endif; ?>

                    <!-- Action Buttons -->
                    <div class="flex justify-end space-x-4 pt-6 border-t border-gray-200">
                        <a href="javascript:history.back()"
                            class="px-6 py-3 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition-colors duration-200 shadow-md">
                            Cancel
                        </a>

                        <?php if ($pickup['status'] === 'pending'): ?>
                            <button type="submit"
                                class="flex items-center space-x-2 px-6 py-3 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors duration-200 shadow-md">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                        clip-rule="evenodd" />
                                </svg>
                                <span>Save Changes</span>
                            </button>
                        <?php endif; ?>
                </form>

                <?php if ($pickup['status'] === 'pickup_verification_pending' || $pickup['status'] === 'Awaiting cash'): ?>
                    <a href="<?php echo URLROOT; ?>/agentcontroller/pickupverify
?id=<?php echo urlencode($pickup['id']); ?>
&request_code=<?php echo urlencode($pickup['request_code']); ?>
&payment_status=<?php echo urlencode($pickup['payment_status_name']); ?>"
                        class="inline-flex items-center space-x-2 px-6 py-3 bg-green-500 text-white rounded-lg hover:bg-green-600 transition-colors duration-200 shadow-md">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                clip-rule="evenodd" />
                        </svg>
                        <span>Verify Pickup</span>
                    </a>

                <?php endif; ?>
            </div>

    </div>
    </main>
    </div>
</body>

</html>