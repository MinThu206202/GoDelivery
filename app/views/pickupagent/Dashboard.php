<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delivery Agent Dashboard</title>
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

    <!-- Header: Updated to include search bar and user profile -->
    <header class="bg-white shadow-sm py-4 px-6 md:px-8 lg:px-12 flex items-center justify-between">
        <div class="flex items-center space-x-4">
            <!-- Title is now only on the sidebar as per the photo -->
        </div>
        <div class="flex-1 max-w-lg mx-auto">
            <div class="relative">
                <input type="text"
                    class="w-full pl-10 pr-4 py-2 rounded-full border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="Search...">
                <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
            </div>
        </div>
        <div class="flex items-center space-x-4">
            <div class="flex items-center space-x-2">
                <div
                    class="w-10 h-10 bg-gray-200 rounded-full flex items-center justify-center font-bold text-gray-700">
                    Mi</div>
                <div>
                    <span class="text-sm font-medium text-gray-600">Mi Mi</span>
                    <p class="text-xs text-gray-500">Agent ID: YGN0001</p>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content Area -->
    <main class="flex-1 p-6 md:p-8 lg:p-12">
        <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-4 gap-6">

            <!-- Sidebar / Navigation: Updated with new styling and list items -->
            <div class="col-span-1 bg-white rounded-xl shadow-lg h-fit p-6 space-y-2">
                <h1 class="text-xl md:text-2xl font-bold text-gray-800 mb-6">Delivery Agent</h1>
                <a href="dashboard.html"
                    class="block text-left py-3 px-4 rounded-lg bg-blue-100 text-blue-700 font-semibold transition duration-200 hover:bg-blue-200">
                    <i class="fas fa-th-large mr-3"></i> Dashboard
                </a>
                <a href="incoming-deliveries.html"
                    class="block text-left py-3 px-4 rounded-lg text-gray-700 font-semibold transition duration-200 hover:bg-gray-100">
                    <i class="fas fa-truck mr-3"></i> Incoming Deliveries
                </a>
                <a href="my-deliveries.html"
                    class="block text-left py-3 px-4 rounded-lg text-gray-700 font-semibold transition duration-200 hover:bg-gray-100">
                    <i class="fas fa-list-alt mr-3"></i> My Deliveries
                </a>
                <a href="agent-profile.html"
                    class="block text-left py-3 px-4 rounded-lg text-gray-700 font-semibold transition duration-200 hover:bg-gray-100">
                    <i class="fas fa-user-circle mr-3"></i> Agent Profile
                </a>
                <a href="create-voucher.html"
                    class="block text-left py-3 px-4 rounded-lg text-gray-700 font-semibold transition duration-200 hover:bg-gray-100">
                    <i class="fas fa-file-alt mr-3"></i> Create Voucher
                </a>
                <a href="notifications.html"
                    class="block text-left py-3 px-4 rounded-lg text-gray-700 font-semibold transition duration-200 hover:bg-gray-100">
                    <i class="fas fa-bell mr-3"></i> Notifications
                </a>
                <a href="request-delivery.html"
                    class="block text-left py-3 px-4 rounded-lg text-gray-700 font-semibold transition duration-200 hover:bg-gray-100">
                    <i class="fas fa-box-open mr-3"></i> Request Delivery
                </a>
                <a href="available-route.html"
                    class="block text-left py-3 px-4 rounded-lg text-gray-700 font-semibold transition duration-200 hover:bg-gray-100">
                    <i class="fas fa-map-marked-alt mr-3"></i> Available Route
                </a>
                <a href="pickup-request.html"
                    class="block text-left py-3 px-4 rounded-lg text-gray-700 font-semibold transition duration-200 hover:bg-gray-100">
                    <i class="fas fa-shopping-cart mr-3"></i> Pickup Request
                </a>
                <a href="#"
                    class="block text-left py-3 px-4 rounded-lg text-gray-700 font-semibold transition duration-200 hover:bg-gray-100">
                    <i class="fas fa-sign-out-alt mr-3"></i> Logout
                </a>
            </div>

            <!-- Dashboard Content Area -->
            <div class="col-span-1 lg:col-span-3 bg-white rounded-xl shadow-lg p-6">
                <!-- Dashboard Overview Section (Landing Page) -->
                <div class="mb-8">
                    <h2 class="text-xl md:text-2xl font-semibold text-gray-800 mb-4">Dashboard Overview</h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                        <div class="bg-gray-50 rounded-lg p-4 shadow-sm flex flex-col items-start">
                            <i class="fas fa-truck-loading text-blue-500 text-2xl mb-2"></i>
                            <span class="text-3xl font-bold text-gray-900">12</span>
                            <p class="text-sm text-gray-600">Assigned Pickups</p>
                        </div>
                        <div class="bg-gray-50 rounded-lg p-4 shadow-sm flex flex-col items-start">
                            <i class="fas fa-check-circle text-green-500 text-2xl mb-2"></i>
                            <span class="text-3xl font-bold text-gray-900">5</span>
                            <p class="text-sm text-gray-600">Completed Today</p>
                        </div>
                        <div class="bg-gray-50 rounded-lg p-4 shadow-sm flex flex-col items-start">
                            <i class="fas fa-clock text-yellow-500 text-2xl mb-2"></i>
                            <span class="text-3xl font-bold text-gray-900">1</span>
                            <p class="text-sm text-gray-600">Overdue</p>
                        </div>
                    </div>

                    <!-- Quick View of Assigned Pickups -->
                    <div class="mt-8">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Upcoming Pickups</h3>
                        <div class="space-y-4">
                            <!-- Pickup Card 1 -->
                            <a href="pickup-details.html?id=pickup-001"
                                class="block bg-gray-50 rounded-lg p-6 shadow-sm flex flex-col md:flex-row items-center md:items-start space-y-4 md:space-y-0 md:space-x-6 transition duration-200 hover:bg-gray-100 cursor-pointer">
                                <div
                                    class="flex-shrink-0 w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center text-blue-600">
                                    <i class="fas fa-box text-2xl"></i>
                                </div>
                                <div class="flex-1 text-center md:text-left">
                                    <h3 class="font-bold text-lg text-gray-800">#PCK-001</h3>
                                    <p class="text-sm text-gray-600">Recipient: Jane Doe</p>
                                    <p class="text-sm text-gray-500">Address: 123 Main St, Anytown</p>
                                </div>
                                <div class="flex-shrink-0 text-center md:text-right">
                                    <span
                                        class="inline-block px-3 py-1 text-sm font-semibold rounded-full bg-yellow-100 text-yellow-700">Pending</span>
                                    <p class="text-xs text-gray-400 mt-1">Due: 2:00 PM</p>
                                </div>
                            </a>

                            <!-- Pickup Card 2 -->
                            <a href="pickup-details.html?id=pickup-002"
                                class="block bg-gray-50 rounded-lg p-6 shadow-sm flex flex-col md:flex-row items-center md:items-start space-y-4 md:space-y-0 md:space-x-6 transition duration-200 hover:bg-gray-100 cursor-pointer">
                                <div
                                    class="flex-shrink-0 w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center text-blue-600">
                                    <i class="fas fa-box text-2xl"></i>
                                </div>
                                <div class="flex-1 text-center md:text-left">
                                    <h3 class="font-bold text-lg text-gray-800">#PCK-002</h3>
                                    <p class="text-sm text-gray-600">Recipient: John Smith</p>
                                    <p class="text-sm text-gray-500">Address: 456 Oak Ave, Somewhere</p>
                                </div>
                                <div class="flex-shrink-0 text-center md:text-right">
                                    <span
                                        class="inline-block px-3 py-1 text-sm font-semibold rounded-full bg-yellow-100 text-yellow-700">Pending</span>
                                    <p class="text-xs text-gray-400 mt-1">Due: 3:30 PM</p>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>

</html>