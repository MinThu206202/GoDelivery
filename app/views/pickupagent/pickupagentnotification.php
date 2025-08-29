<?php require_once APPROOT . '/views/inc/pickupagentsiderbar.php';
$noti = $data['noti'] ?? [];
?>

<style>
/* Custom Scrollbar */
.custom-scrollbar::-webkit-scrollbar {
    width: 8px;
}

.custom-scrollbar::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 10px;
}

.custom-scrollbar::-webkit-scrollbar-thumb {
    background: #888;
    border-radius: 10px;
}

.custom-scrollbar::-webkit-scrollbar-thumb:hover {
    background: #555;
}
</style>

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
                    MM
                </div>
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
                    <h2 class="text-xl font-semibold text-gray-800 mb-4 px-2">Your Notifications</h2>

                    <?php
                    // Notification type styling
                    $typeStyles = [
                        'pickup_confirmed'        => ['border' => 'border-blue-500', 'icon' => 'fas fa-truck-moving text-blue-500'],
                        'delivery_complete' => ['border' => 'border-green-500', 'icon' => 'fas fa-check-circle text-green-500'],
                        'pickup_completed'  => ['border' => 'border-green-500', 'icon' => 'fas fa-clipboard-check text-green-500'],
                        'system_update'     => ['border' => 'border-purple-500', 'icon' => 'fas fa-bell text-purple-500'],
                        'default'           => ['border' => 'border-gray-300', 'icon' => 'fas fa-bell text-gray-500'],
                    ];

                    $tz = new DateTimeZone('Asia/Yangon');

                    if (!empty($noti)):
                        foreach ($noti as $n):
                            $status = strtolower($n['notification_type'] ?? 'default');
                            $style  = $typeStyles[$status] ?? $typeStyles['default'];

                            // Convert created_at to Myanmar time
                            $createdAt = new DateTime($n['created_at'] ?? 'now', new DateTimeZone('UTC'));
                            $createdAt->setTimezone($tz);

                            $now = new DateTime('now', $tz);
                            $timeDiff = $now->getTimestamp() - $createdAt->getTimestamp();

                            if ($timeDiff < 60) $timeAgo = 'Just now';
                            elseif ($timeDiff < 3600) $timeAgo = floor($timeDiff / 60) . ' minutes ago';
                            elseif ($timeDiff < 86400) $timeAgo = floor($timeDiff / 3600) . ' hours ago';
                            else $timeAgo = floor($timeDiff / 86400) . ' days ago';

                    ?>
                    <div class="bg-white rounded-lg p-6 flex items-start space-x-4 <?= $style['border'] ?>">
                        <div class="flex-shrink-0 pt-1">
                            <i class="<?= $style['icon'] ?> text-2xl"></i>
                        </div>
                        <div class="flex-1">
                            <div class="flex justify-between items-center">
                                <h3 class="text-lg font-semibold text-gray-800"><?= htmlspecialchars($n['title']) ?>
                                </h3>
                                <div class="text-sm text-gray-400"><?= $timeAgo ?></div>
                            </div>
                            <p class="text-gray-600 mt-1"><?= htmlspecialchars($n['message']) ?></p>
                        </div>
                    </div>
                    <?php
                        endforeach;
                    else:
                        ?>
                    <div
                        class="p-6 bg-yellow-50 border-l-4 border-yellow-500 text-yellow-800 rounded-lg text-center font-medium shadow-sm">
                        Notification is not yet.
                    </div>
                    <?php endif; ?>

                </div>
            </div>
        </div>
    </main>
</div>
</body>

</html>