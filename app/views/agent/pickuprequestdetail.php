<?php require_once APPROOT . '/views/inc/agentsidebar.php';
$pickup = $data['pickup'];

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
        <!-- <header class="flex items-center justify-between p-6 bg-white shadow-md rounded-bl-lg">
            <h1 class="text-3xl font-semibold text-gray-800">Pickup Request Details</h1>
        </header> -->
        <header class="flex items-center justify-between p-6 bg-white shadow-md rounded-bl-lg">
            <h1 class="text-3xl font-semibold text-gray-800">Pickup Request Details</h1>
            <div x-data="{ open: false }" class="relative">
                <!-- Button-like Trigger -->
                <button
                    @click="open = !open"
                    class="flex items-center space-x-2 bg-white border border-gray-300 px-4 py-2 rounded-lg shadow-sm hover:bg-gray-100 transition">
                    <img src="/Delivery/<?= htmlspecialchars($agent['profile_image']) ?>"
                        alt="Agent Avatar"
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
                <div
                    x-show="open"
                    @click.away="open = false"
                    x-transition
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

        </header>

        <!-- Main Content Area -->
        <main class="flex-1 overflow-y-auto p-6 bg-gray-100">
            <div class="max-w-4xl mx-auto">
                <!-- Back Button at the top-->

                <!-- Detail Card -->
                <div class="bg-white p-8 rounded-xl shadow-md space-y-8">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-2xl font-bold text-gray-800">Request:
                            <?= htmlspecialchars($pickup['request_code']) ?></h2>
                        <?php
                        $status = strtolower($pickup['status'] ?? 'N/A');

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

                        $status_class = $statusClasses[$status] ?? $statusClasses['default'];
                        ?>

                        <span
                            class="px-4 py-2 inline-flex text-sm font-bold rounded-full shadow-md text-white capitalize <?= $status_class ?>">
                            <?= htmlspecialchars(str_replace('_', ' ', $status)) ?>
                        </span>


                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-6">
                        <!-- Sender Information -->
                        <div class="space-y-4">
                            <h3 class="text-xl font-semibold text-gray-700 border-b pb-2">Sender Information</h3>
                            <div>
                                <p class="flex items-center text-sm font-medium text-gray-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-gray-400"
                                        viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    Name
                                </p>
                                <p class="mt-1 text-base font-semibold text-gray-900">
                                    <?= htmlspecialchars($pickup['sender_name'] ?? 'N/A') ?></p>
                            </div>
                            <div>
                                <p class="flex items-center text-sm font-medium text-gray-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-gray-400"
                                        viewBox="0 0 20 20" fill="currentColor">
                                        <path
                                            d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.774a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z" />
                                    </svg>
                                    Contact Number
                                </p>
                                <p class="mt-1 text-base font-semibold text-gray-900">
                                    <?= htmlspecialchars($pickup['sender_phone'] ?? 'N/A') ?></p>
                            </div>
                            <div>
                                <p class="flex items-center text-sm font-medium text-gray-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-gray-400"
                                        viewBox="0 0 20 20" fill="currentColor">
                                        <path
                                            d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                                        <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                                    </svg>
                                    Email
                                </p>
                                <p class="mt-1 text-base font-semibold text-gray-900">
                                    <?= htmlspecialchars($pickup['sender_email'] ?? 'N/A') ?></p>
                            </div>
                            <div>
                                <p class="flex items-center text-sm font-medium text-gray-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-gray-400"
                                        viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M5.057 4.058a1 1 0 01.993-.993h8.39a1 1 0 01.993.993v.994h-10.376v-.994zM4 6.883V17h12V6.883l-4 4-4-4-4 4z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    Pickup Address
                                </p>
                                <p class="mt-1 text-base font-semibold text-gray-900">
                                    <?= htmlspecialchars($pickup['sender_address'] ?? 'N/A') ?>
                                </p>
                            </div>
                            <div>
                                <p class="flex items-center text-sm font-medium text-gray-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-gray-400"
                                        viewBox="0 0 20 20" fill="currentColor">
                                        <path
                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.381-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                    </svg>
                                    Region
                                </p>
                                <p class="mt-1 text-base font-semibold text-gray-900">
                                    <?= htmlspecialchars($pickup['sender_region'] ?? 'N/A') ?>
                                </p>
                            </div>
                            <div>
                                <p class="flex items-center text-sm font-medium text-gray-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-gray-400"
                                        viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M5.057 4.058a1 1 0 01.993-.993h8.39a1 1 0 01.993.993v.994h-10.376v-.994zM4 6.883V17h12V6.883l-4 4-4-4-4 4z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    City
                                </p>
                                <p class="mt-1 text-base font-semibold text-gray-900">
                                    <?= htmlspecialchars($pickup['sender_city'] ?? 'N/A') ?>
                                </p>
                            </div>
                            <div>
                                <p class="flex items-center text-sm font-medium text-gray-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-gray-400"
                                        viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M5.057 4.058a1 1 0 01.993-.993h8.39a1 1 0 01.993.993v.994h-10.376v-.994zM4 6.883V17h12V6.883l-4 4-4-4-4 4z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    Township
                                </p>
                                <p class="mt-1 text-base font-semibold text-gray-900">
                                    <?= htmlspecialchars($pickup['sender_township'] ?? 'N/A') ?>
                                </p>
                            </div>
                        </div>

                        <!-- Receiver Information -->
                        <div class="space-y-4">
                            <h3 class="text-xl font-semibold text-gray-700 border-b pb-2">Receiver Information</h3>
                            <div>
                                <p class="flex items-center text-sm font-medium text-gray-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-gray-400"
                                        viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    Name
                                </p>
                                <p class="mt-1 text-base font-semibold text-gray-900">
                                    <?= htmlspecialchars($pickup['receiver_name'] ?? 'N/A') ?></p>
                            </div>
                            <div>
                                <p class="flex items-center text-sm font-medium text-gray-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-gray-400"
                                        viewBox="0 0 20 20" fill="currentColor">
                                        <path
                                            d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.774a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z" />
                                    </svg>
                                    Contact Number
                                </p>
                                <p class="mt-1 text-base font-semibold text-gray-900">
                                    <?= htmlspecialchars($pickup['receiver_phone'] ?? 'N/A') ?></p>
                            </div>
                            <div>
                                <p class="flex items-center text-sm font-medium text-gray-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-gray-400"
                                        viewBox="0 0 20 20" fill="currentColor">
                                        <path
                                            d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                                        <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                                    </svg>
                                    Email
                                </p>
                                <p class="mt-1 text-base font-semibold text-gray-900">
                                    <?= htmlspecialchars($pickup['receiver_email'] ?? 'N/A') ?></p>
                            </div>
                            <div>
                                <p class="flex items-center text-sm font-medium text-gray-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-gray-400"
                                        viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M5.057 4.058a1 1 0 01.993-.993h8.39a1 1 0 01.993.993v.994h-10.376v-.994zM4 6.883V17h12V6.883l-4 4-4-4-4 4z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    Delivery Address
                                </p>
                                <p class="mt-1 text-base font-semibold text-gray-900">
                                    <?= htmlspecialchars($pickup['receiver_address'] ?? 'N/A') ?>
                                </p>
                            </div>
                            <div>
                                <p class="flex items-center text-sm font-medium text-gray-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-gray-400"
                                        viewBox="0 0 20 20" fill="currentColor">
                                        <path
                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.381-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                    </svg>
                                    Region
                                </p>
                                <p class="mt-1 text-base font-semibold text-gray-900">
                                    <?= htmlspecialchars($pickup['receiver_city'] ?? 'N/A') ?>
                                </p>
                            </div>
                            <div>
                                <p class="flex items-center text-sm font-medium text-gray-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-gray-400"
                                        viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M5.057 4.058a1 1 0 01.993-.993h8.39a1 1 0 01.993.993v.994h-10.376v-.994zM4 6.883V17h12V6.883l-4 4-4-4-4 4z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    City
                                </p>
                                <p class="mt-1 text-base font-semibold text-gray-900">
                                    <?= htmlspecialchars($pickup['receiver_city'] ?? 'N/A') ?>
                                </p>
                            </div>
                            <div>
                                <p class="flex items-center text-sm font-medium text-gray-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-gray-400"
                                        viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M5.057 4.058a1 1 0 01.993-.993h8.39a1 1 0 01.993.993v.994h-10.376v-.994zM4 6.883V17h12V6.883l-4 4-4-4-4 4z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    Township
                                </p>
                                <p class="mt-1 text-base font-semibold text-gray-900">
                                    <?= htmlspecialchars($pickup['receiver_township'] ?? 'N/A') ?>
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Parcel Details -->
                    <div class="space-y-4 pt-6 border-t border-gray-200">
                        <h3 class="text-xl font-semibold text-gray-700 border-b pb-2">Parcel & Request Details</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-6">
                            <div>
                                <p class="flex items-center text-sm font-medium text-gray-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-gray-400"
                                        viewBox="0 0 20 20" fill="currentColor">
                                        <path
                                            d="M5 4a2 2 0 00-2 2v2a2 2 0 002 2h2.228A2 2 0 019 12.338V14a2 2 0 002 2h2a2 2 0 002-2v-1.662c.45-.444.97-1.12.97-1.12l.147-.146A2 2 0 0015.772 10H18a2 2 0 002-2V6a2 2 0 00-2-2h-1.662a2 2 0 00-1.12.97l-.146.147A2 2 0 0113 9.772V12h-2V9.772A2 2 0 017.338 9H5a2 2 0 00-2-2z" />
                                    </svg>
                                    Parcel Type
                                </p>
                                <p class="mt-1 text-base font-semibold text-gray-900">
                                    <?= htmlspecialchars($pickup['parcel_type'] ?? 'N/A') ?></p>
                            </div>
                            <div>
                                <p class="flex items-center text-sm font-medium text-gray-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-gray-400"
                                        viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M10 2a1 1 0 00-1 1v1a1 1 0 002 0V3a1 1 0 00-1-1zM5.534 3.732a1 1 0 00-1.414 1.414l.707.707a1 1 0 001.414-1.414l-.707-.707zM15 8a1 1 0 10-2 0v1a1 1 0 102 0V8zM3 8a1 1 0 10-2 0v1a1 1 0 102 0V8zM4.929 15.071a1 1 0 001.414 0l.707-.707a1 1 0 00-1.414-1.414l-.707.707a1 1 0 000 1.414zM13.586 16.207a1 1 0 00-1.414-1.414l-.707.707a1 1 0 001.414 1.414l.707-.707zM18 10a1 1 0 01-1 1H3a1 1 0 010-2h14a1 1 0 011 1z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    Parcel Weight
                                </p>
                                <p class="mt-1 text-base font-semibold text-gray-900">
                                    <?= htmlspecialchars($pickup['weight'] ?? 'N/A') ?></p>
                            </div>
                            <div>
                                <p class="flex items-center text-sm font-medium text-gray-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-gray-400"
                                        viewBox="0 0 20 20" fill="currentColor">
                                        <path
                                            d="M5 4a2 2 0 00-2 2v2a2 2 0 002 2h2.228A2 2 0 019 12.338V14a2 2 0 002 2h2a2 2 0 002-2v-1.662c.45-.444.97-1.12.97-1.12l.147-.146A2 2 0 0015.772 10H18a2 2 0 002-2V6a2 2 0 00-2-2h-1.662a2 2 0 00-1.12.97l-.146.147A2 2 0 0113 9.772V12h-2V9.772A2 2 0 017.338 9H5a2 2 0 00-2-2z" />
                                    </svg>
                                    Number of Items
                                </p>
                                <p class="mt-1 text-base font-semibold text-gray-900">
                                    <?= htmlspecialchars($pickup['quantity'] ?? 'N/A') ?></p>
                            </div>
                            <div>
                                <p class="flex items-center text-sm font-medium text-gray-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-gray-400"
                                        viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    Requested Date & Time
                                </p>
                                <p class="mt-1 text-base font-semibold text-gray-900">
                                    <?= htmlspecialchars($pickup['created_at'] ?? 'N/A') ?></p>
                            </div>
                            <div>
                                <p class="flex items-center text-sm font-medium text-gray-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-gray-400"
                                        viewBox="0 0 20 20" fill="currentColor">
                                        <path
                                            d="M5 4a2 2 0 00-2 2v2a2 2 0 002 2h2.228A2 2 0 019 12.338V14a2 2 0 002 2h2a2 2 0 002-2v-1.662c.45-.444.97-1.12.97-1.12l.147-.146A2 2 0 0015.772 10H18a2 2 0 002-2V6a2 2 0 00-2-2h-1.662a2 2 0 00-1.12.97l-.146.147A2 2 0 0113 9.772V12h-2V9.772A2 2 0 017.338 9H5a2 2 0 00-2-2z" />
                                    </svg>
                                    Payment Type
                                </p>
                                <p class="mt-1 text-base font-semibold text-gray-900">
                                    <?= htmlspecialchars($pickup['payment_status_name'] ?? 'N/A') ?></p>
                            </div>
                            <div>
                                <p class="flex items-center text-sm font-medium text-gray-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-gray-400"
                                        viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    Delivery Type
                                </p>
                                <p class="mt-1 text-base font-semibold text-gray-900">
                                    <?= htmlspecialchars($pickup['delivery_type_name'] ?? 'N/A') ?></p>
                            </div>
                        </div>
                    </div>

                    <!-- Back Button at the end -->
                    <div class="flex justify-end pt-6 border-t border-gray-200">
                        <a href="<?php echo URLROOT; ?>/agent/requestpickup"
                            class="px-6 py-3 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition-colors duration-200 shadow-md">
                            Back to Requests
                        </a>
                    </div>

                </div>
            </div>
        </main>
    </div>
</body>

</html>