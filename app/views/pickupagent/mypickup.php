<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Pickups</title>
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
            <h1 class="text-xl md:text-2xl font-bold text-gray-800 hidden lg:block">My Pickups</h1>
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
                <!-- My Pickups Section (Full List) -->
                <div>
                    <h2 class="text-xl md:text-2xl font-semibold text-gray-800 mb-4">My Pickups</h2>
                    <div class="bg-gray-50 rounded-lg p-6 shadow-sm overflow-x-auto custom-scrollbar">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Recipient</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Address</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Due Time</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <!-- Sample rows for My Pickups -->
                                <tr class="cursor-pointer hover:bg-gray-100" onclick="window.location.href='pickup-details.html?id=pickup-001'">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">#PCK-001</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Jane Doe</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">123 Main St, Anytown</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">2:00 PM</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-block px-3 py-1 text-sm font-semibold rounded-full bg-yellow-100 text-yellow-700">Pending</span>
                                    </td>
                                </tr>
                                <tr class="cursor-pointer hover:bg-gray-100" onclick="window.location.href='pickup-details.html?id=pickup-002'">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">#PCK-002</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">John Smith</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">456 Oak Ave, Somewhere</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">3:30 PM</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-block px-3 py-1 text-sm font-semibold rounded-full bg-yellow-100 text-yellow-700">Pending</span>
                                    </td>
                                </tr>
                                <tr class="cursor-pointer hover:bg-gray-100" onclick="window.location.href='pickup-details.html?id=pickup-003'">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">#PCK-003</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Alice Johnson</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">789 Pine Rd, Otherplace</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">4:15 PM</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-block px-3 py-1 text-sm font-semibold rounded-full bg-yellow-100 text-yellow-700">Pending</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>

</html>