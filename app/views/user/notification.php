<?php require_once APPROOT . '/views/inc/nav.php';
$noti = $data['noti'] ?? [];
?>

<style>
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap');

body {
    font-family: 'Poppins', sans-serif;
    background-color: #f0f4f7;
}

:root {
    --primary-color: #1F265B;
    --secondary-color: #333;
    --text-color: #555;
    --heading-color: #333;
    --light-grey: #f8f8f8;
    --dark-blue-footer: #1a237e;
    --white: #fff;
    --border-color: #ddd;
    --form-bg-color: #e6f0ff;
    --section-bg-color: #f0f4f7;
}

.header-bg {
    background-color: var(--primary-color);
}

.footer-bg {
    background-color: var(--dark-blue-footer);
}

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

<main class="flex-1 p-8 md:p-16 flex flex-col items-center">
    <!-- Breadcrumbs -->
    <div class="mb-8 text-gray-600">
        <a href="#" class="hover:underline">Home</a> &gt; Notifications
    </div>

    <!-- Notifications Section -->
    <div class="bg-white p-6 md:p-8 rounded-xl shadow-lg w-full max-w-5xl">
        <h2 class="text-2xl md:text-3xl font-semibold text-gray-800 mb-6 border-b-2 pb-4">Recent Notifications</h2>

        <!-- Notifications List -->
        <div class="space-y-4 overflow-y-auto max-h-96 custom-scrollbar">

            <?php
            $typeStyles = [
                'on_its_way'        => ['bg' => 'bg-blue-50',   'border' => 'border-blue-500',   'icon' => 'text-blue-500',   'icon_class' => 'fas fa-truck-fast'],
                'delivery_complete' => ['bg' => 'bg-green-50',  'border' => 'border-green-500',  'icon' => 'text-green-500',  'icon_class' => 'fas fa-box-open'],
                'pickup_confirmed'  => ['bg' => 'bg-yellow-50', 'border' => 'border-yellow-500', 'icon' => 'text-yellow-500', 'icon_class' => 'fas fa-check-circle'],
                'rejected'          => ['bg' => 'bg-red-50',    'border' => 'border-red-500',    'icon' => 'text-red-500',    'icon_class' => 'fas fa-times-circle'],
                'default'           => ['bg' => 'bg-gray-50',   'border' => 'border-gray-300',   'icon' => 'text-gray-500',   'icon_class' => 'fas fa-bell'],
            ];

            $tz = new DateTimeZone('Asia/Yangon'); // Myanmar timezone
            ?>

            <?php if (!empty($noti)): ?>
            <?php foreach ($noti as $n):
                    $status = strtolower($n['notification_type'] ?? 'default');
                    $style  = $typeStyles[$status] ?? $typeStyles['default'];

                    // Convert to Myanmar timezone
                    $createdAt = new DateTime($n['created_at'] ?? 'now', new DateTimeZone('UTC'));
                    $createdAt->setTimezone($tz);

                    $now = new DateTime('now', $tz);
                    $timeDiff = $now->getTimestamp() - $createdAt->getTimestamp();

                    // Time ago formatting
                    if ($timeDiff < 60) $timeAgo = 'Just now';
                    elseif ($timeDiff < 3600) $timeAgo = floor($timeDiff / 60) . ' minutes ago';
                    elseif ($timeDiff < 86400) $timeAgo = floor($timeDiff / 3600) . ' hours ago';
                    else $timeAgo = floor($timeDiff / 86400) . ' days ago';

                    // $myanmarTime = $createdAt->format('d M Y, H:i'); // Exact Myanmar time
                ?>
            <div
                class="flex items-start p-4 rounded-xl shadow-sm border-l-4 <?= $style['border'] ?> <?= $style['bg'] ?>">
                <div class="flex-shrink-0 mr-4">
                    <i class="<?= $style['icon_class'] ?> <?= $style['icon'] ?> text-xl"></i>
                </div>
                <div class="flex-1">
                    <div class="flex justify-between items-center mb-1">
                        <h3 class="font-bold text-lg text-gray-800"><?= htmlspecialchars($n['title']) ?></h3>
                        <span class="text-sm text-gray-600"><?= $timeAgo ?></span>
                    </div>
                    <p class="text-gray-700"><?= htmlspecialchars($n['message']) ?></p>
                </div>
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
</main>

<!-- Footer Section -->
<footer class="footer-bg text-white p-8 md:p-12 mt-auto">
    <div class="container mx-auto">
        <div class="flex flex-col md:flex-row justify-between items-center text-center md:text-left">
            <div class="mb-6 md:mb-0 md:w-1/2">
                <h2 class="text-3xl font-bold mb-2">Contact Us</h2>
                <h3 class="text-2xl font-extrabold mb-4">Fast, Affordable, And Always On Time.</h3>
                <p class="text-sm leading-relaxed mb-4">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Egestas semper sit integer et. At
                    aliquam tortor lectus commodo ut lectus sed fermentum. Cursus in tincidunt cursus viverra diam.
                    Praesent feugiat dolor ipsum pharetra laoreet vulputate pellentesque sed.
                </p>
                <div class="flex justify-center md:justify-start items-center space-x-4">
                    <a href="#"
                        class="flex items-center space-x-2 bg-white text-gray-800 font-semibold py-2 px-4 rounded-full hover:bg-gray-200 transition-colors duration-200">
                        <span>Contact Now</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                                clip-rule="evenodd" />
                        </svg>
                    </a>
                    <!-- Add your social icons here as needed -->
                </div>
            </div>
        </div>
    </div>
</footer>