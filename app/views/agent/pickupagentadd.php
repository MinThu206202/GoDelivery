<?php require_once APPROOT . '/views/inc/agentsidebar.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Pickup Agent</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Inter Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Font Awesome CDN for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
    body {
        font-family: 'Inter', sans-serif;
        background-color: #f3f4f6;
    }

    .error-message {
        color: #ef4444;
        font-size: 0.875rem;
        margin-top: 0.25rem;
    }

    .modal {
        position: fixed;
        z-index: 1000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        display: none;
        justify-content: center;
        align-items: center;
    }

    .modal-content {
        background-color: #fff;
        padding: 2rem;
        border-radius: 0.75rem;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        max-width: 400px;
        text-align: center;
    }
    </style>
</head>

<body class="flex flex-col min-h-screen">
    <!-- Main Content Area -->
    <div class="flex-1 flex flex-col overflow-hidden">
        <!-- Header -->
        <header class="flex items-center justify-between p-6 bg-white shadow-md rounded-bl-lg">
            <h1 class="text-3xl font-semibold text-gray-800">Add New Pickup Agent</h1>
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

        <!-- Form Content -->
        <main class="flex-1 overflow-y-auto p-6 bg-gray-100">
            <div class="max-w-xl mx-auto bg-white p-8 rounded-xl shadow-md">

                <!-- Header with Back Button -->
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-2xl font-semibold text-gray-800">Agent Details</h2>
                    <a href="<?= URLROOT; ?>/agent/pickupagentlist"
                        class="inline-flex items-center px-4 py-2 bg-gray-200 text-gray-700 rounded-md shadow-sm hover:bg-gray-300 transition">
                        Back
                    </a>
                </div>

                <form id="addAgentForm" class="space-y-6" method="POST"
                    action="<?php echo URLROOT; ?>/agentcontroller/pickupagentadd">
                    <?php require APPROOT . '/views/components/auth_message.php'; ?>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Full Name -->
                        <div>
                            <label for="fullName" class="block text-sm font-medium text-gray-700"><i
                                    class="fa-solid fa-user mr-2"></i>Full Name</label>
                            <input type="text" id="fullName" name="fullName"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#1F265B] focus:ring focus:ring-[#1F265B] focus:ring-opacity-50 p-2"
                                maxlength="100">
                            <p class="error-message hidden" id="fullName-error">Full Name is required.</p>
                        </div>
                        <!-- Phone Number -->
                        <div>
                            <label for="phoneNumber" class="block text-sm font-medium text-gray-700"><i
                                    class="fa-solid fa-phone mr-2"></i>Phone Number</label>
                            <input type="text" id="phoneNumber" name="phoneNumber"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#1F265B] focus:ring focus:ring-[#1F265B] focus:ring-opacity-50 p-2">
                            <p class="error-message hidden" id="phoneNumber-error">Phone Number is required.</p>
                        </div>
                        <!-- Email (optional) -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700"><i
                                    class="fa-solid fa-envelope mr-2"></i>Email (optional)</label>
                            <input type="email" id="email" name="email"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#1F265B] focus:ring focus:ring-[#1F265B] focus:ring-opacity-50 p-2">
                        </div>
                        <!-- Password -->
                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700"><i
                                    class="fa-solid fa-lock mr-2"></i>Password</label>
                            <input type="password" id="password" name="password"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#1F265B] focus:ring focus:ring-[#1F265B] focus:ring-opacity-50 p-2">
                            <p class="error-message hidden" id="password-error">Password is required.</p>
                        </div>
                        <!-- Assigned Vehicle (optional) -->
                        <div>
                            <label for="assignedVehicle" class="block text-sm font-medium text-gray-700"><i
                                    class="fa-solid fa-truck-pickup mr-2"></i>Assigned Vehicle (optional)</label>
                            <select id="assignedVehicle" name="assignedVehicle"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#1F265B] focus:ring focus:ring-[#1F265B] focus:ring-opacity-50 p-2">
                                <option value="None">None</option>
                                <option value="1">Bike</option>
                                <option value="2">Van</option>
                                <option value="3">Car</option>
                            </select>
                        </div>
                        <!-- Vehicle Make -->
                        <div>
                            <label for="vehicleMake" class="block text-sm font-medium text-gray-700"><i
                                    class="fa-solid fa-car mr-2"></i>Vehicle Make</label>
                            <input type="text" id="vehicleMake" name="vehicleMake"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#1F265B] focus:ring focus:ring-[#1F265B] focus:ring-opacity-50 p-2">
                        </div>
                        <!-- Vehicle Color -->
                        <div>
                            <label for="vehicleColor" class="block text-sm font-medium text-gray-700"><i
                                    class="fa-solid fa-palette mr-2"></i>Color</label>
                            <input type="text" id="vehicleColor" name="vehicleColor"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#1F265B] focus:ring focus:ring-[#1F265B] focus:ring-opacity-50 p-2">
                        </div>
                        <!-- Vehicle Number -->
                        <div>
                            <label for="vehicleNumber" class="block text-sm font-medium text-gray-700"><i
                                    class="fa-solid fa-id-card mr-2"></i>Vehicle Number</label>
                            <input type="text" id="vehicleNumber" name="vehicleNumber"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#1F265B] focus:ring focus:ring-[#1F265B] focus:ring-opacity-50 p-2">
                            <p class="error-message hidden" id="vehicleNumber-error">Vehicle Number is required.</p>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="pt-6">
                        <button type="submit"
                            class="w-full py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-[#1F265B] hover:bg-[#2A346C] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#1F265B]">
                            Add New Agent
                        </button>
                    </div>
                </form>
            </div>
        </main>

    </div>

    <!-- Confirmation Modal -->
    <div id="confirmationModal" class="modal">
        <div class="modal-content">
            <h3 id="modalTitle" class="text-xl font-semibold mb-4"></h3>
            <p id="modalMessage" class="text-gray-600 mb-6"></p>
            <button id="modalCloseButton"
                class="px-4 py-2 bg-[#1F265B] text-white rounded-md hover:bg-[#2A346C]">Close</button>
        </div>
    </div>
</body>

</html>