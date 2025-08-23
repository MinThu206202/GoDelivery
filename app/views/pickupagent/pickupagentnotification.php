<?php require_once APPROOT . '/views/inc/pickupagentsiderbar.php'; ?>


<!-- Main Content -->
<div class="flex flex-1 flex-col">
    <!-- Header -->
    <header class="bg-white text-gray-800 shadow-sm py-4 px-6 md:px-8 lg:px-12 flex items-center justify-between">
        <h1 class="text-xl md:text-2xl font-bold">Notifications</h1>
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

    <!-- Notifications List -->
    <main class="flex-1 p-6 md:p-8 lg:p-12">
        <div class="max-w-4xl mx-auto">
            <!-- Scrollable Notifications Container -->
            <div class="h-[80vh] overflow-y-auto custom-scrollbar rounded-lg shadow-lg border border-gray-200">
                <div class="space-y-2 p-4">
                    <!-- Notification Title -->
                    <h2 class="text-xl font-semibold text-gray-800 mb-4 px-2">Your Notifications</h2>
                    <!-- Notification 1: New Delivery Available -->
                    <div class="bg-white rounded-lg p-6 flex items-start space-x-4 border-l-4 border-blue-500">
                        <div class="flex-shrink-0 pt-1">
                            <i class="fas fa-truck-moving text-2xl text-blue-500"></i>
                        </div>
                        <div class="flex-1">
                            <div class="flex justify-between items-center">
                                <h3 class="text-lg font-semibold text-gray-800">New Delivery Available!</h3>
                                <div class="text-sm text-gray-400">23 hours ago</div>
                            </div>
                            <p class="text-gray-600 mt-1">A new delivery request (Order ID: #MDY702013YGN) is
                                available for acceptance. Check 'Request Deliveries'.</p>
                        </div>
                    </div>

                    <!-- Notification 2: New Delivery Available -->
                    <div class="bg-white rounded-lg p-6 flex items-start space-x-4 border-l-4 border-blue-500">
                        <div class="flex-shrink-0 pt-1">
                            <i class="fas fa-truck-moving text-2xl text-blue-500"></i>
                        </div>
                        <div class="flex-1">
                            <div class="flex justify-between items-center">
                                <h3 class="text-lg font-semibold text-gray-800">New Delivery Available!</h3>
                                <div class="text-sm text-gray-400">23 hours ago</div>
                            </div>
                            <p class="text-gray-600 mt-1">A new delivery request (Order ID: #MDY685198YGN) is
                                available for acceptance. Check 'Request Deliveries'.</p>
                        </div>
                    </div>

                    <!-- Notification 3: Delivery Accepted -->
                    <div class="bg-white rounded-lg p-6 flex items-start space-x-4 border-l-4 border-green-500">
                        <div class="flex-shrink-0 pt-1">
                            <i class="fas fa-check-circle text-2xl text-green-500"></i>
                        </div>
                        <div class="flex-1">
                            <div class="flex justify-between items-center">
                                <h3 class="text-lg font-semibold text-gray-800">Delivery Accepted!</h3>
                                <div class="text-sm text-gray-400">1 day ago</div>
                            </div>
                            <p class="text-gray-600 mt-1">You have successfully accepted Delivery #MDY457724YGN.</p>
                        </div>
                    </div>

                    <!-- Notification 4: Pickup Completed -->
                    <div class="bg-white rounded-lg p-6 flex items-start space-x-4 border-l-4 border-green-500">
                        <div class="flex-shrink-0 pt-1">
                            <i class="fas fa-clipboard-check text-2xl text-green-500"></i>
                        </div>
                        <div class="flex-1">
                            <div class="flex justify-between items-center">
                                <h3 class="text-lg font-semibold text-gray-800">Pickup Completed!</h3>
                                <div class="text-sm text-gray-400">3 days ago</div>
                            </div>
                            <p class="text-gray-600 mt-1">You have completed Pickup #MDY998745YGN successfully.</p>
                        </div>
                    </div>

                    <!-- Notification 5: System Update -->
                    <div class="bg-white rounded-lg p-6 flex items-start space-x-4 border-l-4 border-purple-500">
                        <div class="flex-shrink-0 pt-1">
                            <i class="fas fa-bell text-2xl text-purple-500"></i>
                        </div>
                        <div class="flex-1">
                            <div class="flex justify-between items-center">
                                <h3 class="text-lg font-semibold text-gray-800">System Update</h3>
                                <div class="text-sm text-gray-400">5 days ago</div>
                            </div>
                            <p class="text-gray-600 mt-1">The GoDelivery app has been updated with new features.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
</body>

</html>