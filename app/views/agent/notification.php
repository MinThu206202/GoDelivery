<?php require_once APPROOT . '/views/inc/agentsidebar.php';
$noti = $data['noti'] ?? [];
?>

<script src="https://cdn.tailwindcss.com"></script>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
    body {
        font-family: 'Inter', sans-serif;
        background-color: #f3f4f6;
    }

    /* Custom scrollbar */
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

<div class="flex-1 flex flex-col overflow-hidden">
    <!-- Header -->
    <header class="flex items-center justify-between p-6 bg-white shadow-md rounded-bl-lg">
        <h1 class="text-3xl font-semibold text-gray-800">Notifications</h1>
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

    <!-- Notifications List Content -->
    <main class="flex-1 overflow-y-auto p-6 bg-gray-100">
        <div class="max-w-4xl mx-auto bg-white p-8 rounded-xl shadow-md">
            <h2 class="text-2xl font-semibold text-gray-800 mb-6">Your Notifications</h2>

            <div class="overflow-y-auto max-h-[550px] pr-4 custom-scrollbar">
                <div class="space-y-4">
                    <?php if (!empty($noti)): ?>
                        <?php
                        $typeStyles = [
                            'request_delivery' => ['bg' => 'bg-blue-50', 'border' => 'border-blue-500', 'text' => 'text-blue-800'],
                            'my_delivery'      => ['bg' => 'bg-green-50', 'border' => 'border-green-500', 'text' => 'text-green-800'],
                            'from_delivery_issue' => ['bg' => 'bg-red-50', 'border' => 'border-red-500', 'text' => 'text-red-800'],
                            'from_agent'       => ['bg' => 'bg-yellow-50', 'border' => 'border-yellow-500', 'text' => 'text-yellow-800'],
                            'general'          => ['bg' => 'bg-gray-50', 'border' => 'border-gray-300', 'text' => 'text-gray-800'],
                        ];
                        ?>

                        <?php foreach ($noti as $n):
                            $type = strtolower($n['notification_type'] ?? 'general');
                            $style = $typeStyles[$type] ?? $typeStyles['general'];
                            $createdAt = strtotime($n['created_at'] ?? '');
                            $timeDiff = time() - $createdAt;
                            if ($timeDiff < 60) {
                                $timeAgo = 'Just now';
                            } elseif ($timeDiff < 3600) {
                                $timeAgo = floor($timeDiff / 60) . ' minutes ago';
                            } elseif ($timeDiff < 86400) {
                                $timeAgo = floor($timeDiff / 3600) . ' hours ago';
                            } else {
                                $timeAgo = floor($timeDiff / 86400) . ' days ago';
                            }
                        ?>
                            <div
                                class="<?= $style['bg'] ?> <?= $style['border'] ?> <?= $style['text'] ?> p-4 rounded-lg shadow-sm border-l-4">
                                <div class="flex justify-between items-center mb-1">
                                    <h3 class="font-bold text-lg"><?= htmlspecialchars($n['title']) ?></h3>
                                    <span class="text-sm text-gray-600"><?= $timeAgo ?></span>
                                </div>
                                <p class="text-gray-700"><?= htmlspecialchars($n['message']) ?></p>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
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