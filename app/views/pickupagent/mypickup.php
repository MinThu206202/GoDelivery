<?php require_once APPROOT . '/views/inc/pickupagentsiderbar.php'; ?>
<!-- Main Content -->
<div class="flex flex-1 flex-col">
    <!-- Header -->
    <header class="bg-white text-gray-800 shadow-sm py-4 px-6 md:px-8 lg:px-12 flex items-center justify-between">
        <h1 class="text-xl md:text-2xl font-bold">My Pickups</h1>
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
                    MM</div>
                <div>
                    <span class="text-sm font-medium text-gray-600">Mi Mi</span>
                    <p class="text-xs text-gray-500">Agent ID: YGN0001</p>
                </div>
            </div>
        </div>
    </header>

    <!-- Pickups Table -->
    <main class="flex-1 p-6 md:p-8 lg:p-12 overflow-y-auto">
        <div class="max-w-7xl mx-auto">
            <h2 class="text-xl md:text-2xl font-semibold text-gray-800 mb-4">Assigned Pickups</h2>
            <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">
                                ID</th>
                            <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">
                                Recipient</th>
                            <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">
                                Address</th>
                            <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">
                                Due Time</th>
                            <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">
                                Status</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <tr class="hover:bg-gray-50 cursor-pointer"
                            onclick="window.location.href='pickup-details.html?id=pickup-001'">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-blue-600 font-medium">#PCK-001</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Jane Doe</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">123 Main St, Anytown</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">2:00 PM</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-700">
                                    Pending
                                </span>
                            </td>
                        </tr>
                        <tr class="hover:bg-gray-50 cursor-pointer"
                            onclick="window.location.href='pickup-details.html?id=pickup-002'">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-blue-600 font-medium">#PCK-002</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">John Smith</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">456 Oak Ave, Somewhere
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">3:30 PM</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-700">
                                    Pending
                                </span>
                            </td>
                        </tr>
                        <tr class="hover:bg-gray-50 cursor-pointer"
                            onclick="window.location.href='pickup-details.html?id=pickup-003'">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-blue-600 font-medium">#PCK-003</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Alice Johnson</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">789 Pine Rd, Otherplace
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">4:15 PM</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-700">
                                    Pending
                                </span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</div>
</body>

</html>