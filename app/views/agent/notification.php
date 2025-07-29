<?php require_once APPROOT . '/views/inc/agentsidebar.php';
$noti = $data['noti'];

?>

<script src="https://cdn.tailwindcss.com"></script>
<!-- Inter Font -->
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<style>
    body {
        font-family: 'Inter', sans-serif;
        background-color: #f3f4f6;
    }

    /* Add a custom scrollbar style for better aesthetics (optional) */
    .custom-scrollbar::-webkit-scrollbar {
        width: 8px;
        /* Width of the scrollbar */
    }

    .custom-scrollbar::-webkit-scrollbar-track {
        background: #f1f1f1;
        /* Color of the track */
        border-radius: 10px;
    }

    .custom-scrollbar::-webkit-scrollbar-thumb {
        background: #888;
        /* Color of the scrollbar thumb */
        border-radius: 10px;
    }

    .custom-scrollbar::-webkit-scrollbar-thumb:hover {
        background: #555;
        /* Color of the scrollbar thumb on hover */
    }
</style>


<!-- Main Content Area -->
<div class="flex-1 flex flex-col overflow-hidden">
    <!-- Header -->
    <header class="flex items-center justify-between p-6 bg-white shadow-md rounded-bl-lg">
        <h1 class="text-3xl font-semibold text-gray-800">Notifications</h1>
        <div class="flex items-center space-x-4">
            <div class="flex items-center space-x-2">
                <img src="https://placehold.co/40x40/FF6347/FFFFFF?text=JD" alt="Agent Avatar"
                    class="w-10 h-10 rounded-full border-2 border-blue-500">
                <div>
                    <p class="text-lg font-medium text-gray-800">John Doe</p>
                    <p class="text-sm text-gray-500">Agent ID: #007</p>
                </div>
            </div>
            <a href="#"
                class="px-4 py-2 bg-[#1F265B] text-white rounded-lg hover:bg-[#2A346C] transition-colors duration-200">Back
                to Dashboard</a>
        </div>
    </header>

    <!-- Notifications List Content -->
    <main class="flex-1 overflow-y-auto p-6 bg-gray-100">
        <div class="max-w-4xl mx-auto bg-white p-8 rounded-xl shadow-md">
            <h2 class="text-2xl font-semibold text-gray-800 mb-6">Your Notifications</h2>
            <div class="overflow-y-auto max-h-[550px] pr-4 custom-scrollbar">
                <div class="space-y-4">
                    <!-- Sample Notification 1 (New Delivery) -->
                    <?php foreach ($data['noti'] as $noti): ?>
                        <div class="bg-blue-50 border-l-4 border-blue-500 text-blue-800 p-4 rounded-lg shadow-sm">
                            <div class="flex justify-between items-center mb-1">
                                <h3 class="font-bold text-lg"><?= htmlspecialchars($noti['title']) ?></h3>
                                <?php
                                $createdAt = strtotime($noti['created_at'] ?? '');
                                $timeDiff = max(0, time() - $createdAt);

                                if ($timeDiff < 60) {
                                    $timeAgo = 'Just now';
                                } elseif ($timeDiff < 3600) {
                                    $minutes = floor($timeDiff / 60);
                                    $timeAgo = $minutes . ' minute' . ($minutes > 1 ? 's' : '') . ' ago';
                                } elseif ($timeDiff < 86400) {
                                    $hours = floor($timeDiff / 3600);
                                    $timeAgo = $hours . ' hour' . ($hours > 1 ? 's' : '') . ' ago';
                                } else {
                                    $days = floor($timeDiff / 86400);
                                    $timeAgo = $days . ' day' . ($days > 1 ? 's' : '') . ' ago';
                                }
                                ?>

                                <span class="text-sm text-gray-600"><?= $timeAgo ?></span>
                            </div>
                            <p class="text-gray-700"><?= htmlspecialchars($noti['message']) ?></p>
                            </p>
                        </div>
                    <?php endforeach; ?>

                    <!-- Sample Notification 2 (Delivery Status Update) -->
                    <div class="bg-green-50 border-l-4 border-green-500 text-green-800 p-4 rounded-lg shadow-sm">
                        <div class="flex justify-between items-center mb-1">
                            <h3 class="font-bold text-lg">Delivery Status Update</h3>
                            <span class="text-sm text-gray-600">Yesterday at 3:00 PM</span>
                        </div>
                        <p class="text-gray-700">Delivery #ORD1005 has been marked as 'Delivered' by the recipient.
                            Earnings processed.</p>
                    </div>

                    <!-- Sample Notification 3 (System Alert) -->
                    <div class="bg-red-50 border-l-4 border-red-500 text-red-800 p-4 rounded-lg shadow-sm">
                        <div class="flex justify-between items-center mb-1">
                            <h3 class="font-bold text-lg">System Alert: Payment Issue</h3>
                            <span class="text-sm text-gray-600">July 23, 2024</span>
                        </div>
                        <p class="text-gray-700">There was an issue processing payment for Order ID: #ORD0999. Please
                            review the order details.</p>
                    </div>

                    <!-- Sample Notification 4 (Profile Update Reminder) -->
                    <div class="bg-yellow-50 border-l-4 border-yellow-500 text-yellow-800 p-4 rounded-lg shadow-sm">
                        <div class="flex justify-between items-center mb-1">
                            <h3 class="font-bold text-lg">Reminder: Profile Incomplete</h3>
                            <span class="text-sm text-gray-600">July 20, 2024</span>
                        </div>
                        <p class="text-gray-700">Your agent profile is 80% complete. Please update your vehicle
                            information in settings.</p>
                    </div>

                    <!-- Sample Notification 5 (General Info) -->
                    <div class="bg-gray-50 border-l-4 border-gray-300 text-gray-800 p-4 rounded-lg shadow-sm">
                        <div class="flex justify-between items-center mb-1">
                            <h3 class="font-bold text-lg">New Feature Alert!</h3>
                            <span class="text-sm text-gray-600">July 15, 2024</span>
                        </div>
                        <p class="text-gray-700">We've launched a new feature for route optimization. Check out the
                            dashboard for more details.</p>
                    </div>

                    <!-- Added more sample notifications to demonstrate scrolling -->
                    <div class="bg-blue-50 border-l-4 border-blue-500 text-blue-800 p-4 rounded-lg shadow-sm">
                        <div class="flex justify-between items-center mb-1">
                            <h3 class="font-bold text-lg">Delivery Accepted!</h3>
                            <span class="text-sm text-gray-600">1 hour ago</span>
                        </div>
                        <p class="text-gray-700">You have successfully accepted Delivery ID: #ORD1009. Proceed to pickup location.</p>
                    </div>
                    <div class="bg-green-50 border-l-4 border-green-500 text-green-800 p-4 rounded-lg shadow-sm">
                        <div class="flex justify-between items-center mb-1">
                            <h3 class="font-bold text-lg">Payout Processed</h3>
                            <span class="text-sm text-gray-600">3 hours ago</span>
                        </div>
                        <p class="text-gray-700">Your recent earnings have been successfully processed and transferred to your account.</p>
                    </div>
                    <div class="bg-yellow-50 border-l-4 border-yellow-500 text-yellow-800 p-4 rounded-lg shadow-sm">
                        <div class="flex justify-between items-center mb-1">
                            <h3 class="font-bold text-lg">Service Update</h3>
                            <span class="text-sm text-gray-600">Today at 9:00 AM</span>
                        </div>
                        <p class="text-gray-700">Scheduled maintenance will occur tonight from 2 AM to 4 AM. Services may be briefly interrupted.</p>
                    </div>
                    <div class="bg-red-50 border-l-4 border-red-500 text-red-800 p-4 rounded-lg shadow-sm">
                        <div class="flex justify-between items-center mb-1">
                            <h3 class="font-bold text-lg">Action Required: Document Expiring</h3>
                            <span class="text-sm text-gray-600">5 days ago</span>
                        </div>
                        <p class="text-gray-700">Your driver's license is expiring soon. Please upload updated documents to avoid service interruption.</p>
                    </div>
                    <div class="bg-gray-50 border-l-4 border-gray-300 text-gray-800 p-4 rounded-lg shadow-sm">
                        <div class="flex justify-between items-center mb-1">
                            <h3 class="font-bold text-lg">App Update Available!</h3>
                            <span class="text-sm text-gray-600">Last week</span>
                        </div>
                        <p class="text-gray-700">A new version of the delivery app is available. Update now for new features and bug fixes!</p>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>

</body>

</html>