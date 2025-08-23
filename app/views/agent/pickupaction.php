<?php require_once APPROOT . '/views/inc/agentsidebar.php';
$pickup = $data['pickup'];
$admin = $data['admin'];
$location = $data['location'];
$route = $data['route'];




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
                <form action="#" method="POST" class="bg-white p-8 rounded-xl shadow-md space-y-8">
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center space-x-4">
                            <h2 class="text-2xl font-bold text-gray-800">Request:
                                <?= htmlspecialchars($pickup['request_code']) ?></h2>
                            <?php
                            switch ($pickup['status']) {
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
                                <?= ucfirst(htmlspecialchars($pickup['status'])) ?>
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
                                    <input type="text" id="receiver_agent_name" name="receiver_agent_name"
                                        value="<?= htmlspecialchars($admin['name']) ?>"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 bg-gray-100 cursor-not-allowed"
                                        readonly>
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
                                    <span
                                        class="mt-1 px-3 py-1 inline-flex text-sm font-semibold rounded-full status-<?= strtolower(str_replace(' ', '-', htmlspecialchars($admin['status_name']))) ?>">
                                        <?= ucfirst(htmlspecialchars($admin['status_name'])) ?>
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
                                        value="<?= htmlspecialchars($route['from_township'] . ' → ' . $route['to_township']) ?>"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 bg-gray-100 cursor-not-allowed"
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
                                    <span
                                        class="mt-1 px-3 py-1 inline-flex text-sm font-semibold rounded-full status-<?= strtolower(str_replace(' ', '-', htmlspecialchars($route['status']))) ?>">
                                        <?= ucfirst(htmlspecialchars($route['status'])) ?>
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
                                        Current Location
                                    </label>
                                    <input type="text" id="location_name" name="location_name"
                                        value="<?= htmlspecialchars($location['township_name']) ?>"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 bg-gray-100 cursor-not-allowed"
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
                                    <span
                                        class="mt-1 px-3 py-1 inline-flex text-sm font-semibold rounded-full status-<?= strtolower(str_replace(' ', '-', htmlspecialchars($location['status_location_name']))) ?>">
                                        <?= ucfirst(htmlspecialchars($location['status_location_name'])) ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

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

                                        <option value="1" <?= ($pickup['status'] == 1) ? 'selected' : '' ?>>Pending
                                        </option>
                                        <option value="2" <?= ($pickup['status'] == 2) ? 'selected' : '' ?>>Accepted
                                        </option>
                                        <option value="3" <?= ($pickup['status'] == 3) ? 'selected' : '' ?>>Collected
                                        </option>
                                        <option value="4" <?= ($pickup['status'] == 4) ? 'selected' : '' ?>>Voucher
                                            Created</option>
                                        <option value="5" <?= ($pickup['status'] == 5) ? 'selected' : '' ?>>Delivered
                                        </option>
                                        <option value="6" <?= ($pickup['status'] == 6) ? 'selected' : '' ?>>Arrived
                                            Office</option>
                                        <option value="7" <?= ($pickup['status'] == 7) ? 'selected' : '' ?>>Rejected
                                        </option>
                                        <option value="8" <?= ($pickup['status'] == 8) ? 'selected' : '' ?>>Agent
                                            Checked</option>
                                        <option value="9" <?= ($pickup['status'] == 9) ? 'selected' : '' ?>>Awaiting
                                            Payment</option>
                                        <option value="10" <?= ($pickup['status'] == 10) ? 'selected' : '' ?>>Payment
                                            Success</option>
                                    </select>

                                </div>
                            </div>

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
                                            <option value="<?= htmlspecialchars($agent['id']) ?>"
                                                <?= ($agent['id'] == $assignedAgentId) ? 'selected' : '' ?>>
                                                <?= htmlspecialchars($agent['name']) ?>
                                                (<?= htmlspecialchars($agent['id']) ?>)
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

                    <!-- Action Buttons -->
                    <div class="flex justify-end space-x-4 pt-6 border-t border-gray-200">
                        <a href="javascript:history.back()"
                            class="px-6 py-3 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition-colors duration-200 shadow-md">
                            Cancel
                        </a>
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
                    </div>
                </form>
            </div>
        </main>
    </div>
</body>

</html>