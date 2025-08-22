<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pickup Details</title>
    <!-- Inter font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap">
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f3f4f6;
        }

        /* Custom scrollbar for better aesthetics */
        .custom-scrollbar::-webkit-scrollbar {
            width: 8px;
        }

        .custom-scrollbar::-webkit-scrollbar-track {
            background: #e5e7eb;
            border-radius: 10px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #9ca3af;
            border-radius: 10px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: #6b7280;
        }
    </style>
</head>

<body class="flex flex-col min-h-screen antialiased">

    <!-- Header -->
    <header class="bg-white shadow-sm py-4 px-6 md:px-8 lg:px-12 flex items-center justify-between">
        <div class="flex items-center space-x-6">
            <h1 class="text-xl md:text-2xl font-bold text-gray-800 hidden lg:block">Pickup Details</h1>
            <div class="relative w-full max-w-sm">
                <input type="text" placeholder="Search..." class="w-full pl-10 pr-4 py-2 rounded-full border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500">
                <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
            </div>
        </div>
        <div class="flex items-center space-x-4">
            <div class="text-right">
                <p class="font-medium text-gray-800">Mi Mi</p>
                <p class="text-sm text-gray-500">Agent ID: YGN0001</p>
            </div>
            <div class="w-10 h-10 bg-gray-200 rounded-full flex items-center justify-center font-bold text-gray-700">MM</div>
        </div>
    </header>

    <!-- Main Content Area -->
    <main class="flex-1 p-6 md:p-8 lg:p-12">
        <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-[250px_1fr] gap-6">

            <!-- Sidebar / Navigation -->
            <aside class="bg-gray-800 text-white rounded-xl shadow-lg h-fit p-4 space-y-4">
                <div class="flex items-center space-x-3 p-2 mb-4">
                    <img src="https://placehold.co/40x40/5d4f7c/ffffff?text=DA" alt="Logo" class="rounded-lg">
                    <span class="font-bold text-lg">Delivery Agent</span>
                </div>
                <nav class="space-y-2">
                    <a href="dashboard.html" class="flex items-center space-x-3 py-3 px-4 rounded-xl text-gray-300 font-semibold transition duration-200 hover:bg-gray-700 hover:text-white">
                        <i class="fas fa-home w-5 text-center"></i>
                        <span>Dashboard</span>
                    </a>
                    <a href="my-pickups.html" class="flex items-center space-x-3 py-3 px-4 rounded-xl bg-gray-700 text-white font-semibold transition duration-200 hover:bg-gray-600">
                        <i class="fas fa-truck-moving w-5 text-center"></i>
                        <span>My Pickups</span>
                    </a>
                    <a href="completed-pickups.html" class="flex items-center space-x-3 py-3 px-4 rounded-xl text-gray-300 font-semibold transition duration-200 hover:bg-gray-700 hover:text-white">
                        <i class="fas fa-history w-5 text-center"></i>
                        <span>Completed Pickups</span>
                    </a>
                    <hr class="border-gray-700 my-4">
                    <a href="#" class="flex items-center space-x-3 py-3 px-4 rounded-xl text-gray-300 font-semibold transition duration-200 hover:bg-gray-700 hover:text-white">
                        <i class="fas fa-user-circle w-5 text-center"></i>
                        <span>Agent Profile</span>
                    </a>
                    <a href="#" class="flex items-center space-x-3 py-3 px-4 rounded-xl text-gray-300 font-semibold transition duration-200 hover:bg-gray-700 hover:text-white">
                        <i class="fas fa-bell w-5 text-center"></i>
                        <span>Notifications</span>
                    </a>
                    <a href="#" class="flex items-center space-x-3 py-3 px-4 rounded-xl text-gray-300 font-semibold transition duration-200 hover:bg-gray-700 hover:text-white">
                        <i class="fas fa-sign-out-alt w-5 text-center"></i>
                        <span>Logout</span>
                    </a>
                </nav>
            </aside>

            <!-- Dashboard Content Area -->
            <div class="col-span-1 lg:col-span-3 bg-white rounded-xl shadow-lg p-6">
                <!-- Pickup Details Section -->
                <div>
                    <div class="flex justify-between items-center mb-4">
                        <a href="my-pickups.html" class="text-gray-500 hover:text-gray-700 transition duration-200 focus:outline-none">
                            <i class="fas fa-arrow-left mr-2"></i> Back to My Pickups
                        </a>
                        <h2 class="text-xl md:text-2xl font-semibold text-gray-800">Pickup Details</h2>
                        <div></div> <!-- Placeholder for alignment -->
                    </div>

                    <div id="pickup-info" class="bg-gray-50 rounded-lg p-6 shadow-sm mb-6 space-y-4">
                        <div class="flex justify-between items-center">
                            <span class="text-gray-500">Pickup ID:</span>
                            <span class="font-semibold text-gray-800">#PCK-001</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-500">Recipient:</span>
                            <span class="font-semibold text-gray-800">Jane Doe</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-500">Address:</span>
                            <span class="font-semibold text-gray-800">123 Main St, Anytown</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-500">Due Time:</span>
                            <span class="font-semibold text-gray-800">2:00 PM</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-500">Status:</span>
                            <span class="inline-block px-3 py-1 text-sm font-semibold rounded-full bg-yellow-100 text-yellow-700">Pending</span>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <label for="parcel-verified" class="flex items-center space-x-2 cursor-pointer">
                            <input type="checkbox" id="parcel-verified" class="form-checkbox h-5 w-5 text-blue-600 rounded focus:ring-blue-500">
                            <span class="text-gray-700 font-medium">Confirm parcel collected & info verified</span>
                        </label>

                        <button id="confirm-btn" class="w-full px-6 py-3 bg-green-600 text-white font-semibold rounded-lg shadow-md transition duration-200 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 disabled:opacity-50 disabled:cursor-not-allowed">
                            <i class="fas fa-check mr-2"></i> Mark as Completed
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script>
        const confirmCheckbox = document.getElementById('parcel-verified');
        const confirmButton = document.getElementById('confirm-btn');
        if (confirmCheckbox && confirmButton) {
            confirmButton.disabled = !confirmCheckbox.checked;
            confirmCheckbox.addEventListener('change', (event) => {
                confirmButton.disabled = !event.target.checked;
            });
        }
    </script>
</body>

</html>