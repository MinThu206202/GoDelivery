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

.bg-primary-blue {
    background-color: #1F265B;
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

<footer class="bg-primary-blue text-white py-12">
    <div
        class="container mx-auto px-4 flex flex-col md:flex-row justify-between items-start gap-8 text-center md:text-left">
        <div class="md:w-1/3">
            <h2 class="text-3xl md:text-5xl font-bold mb-4">GoDelivery</h2>
            <p class="text-gray-300">Your most reliable partner in logistics and delivery services, dedicated to
                providing top-notch service with a smile.</p>
            <div class="mt-6 flex justify-center md:justify-start space-x-4">
                <a href="#" class="text-white hover:text-gray-300 transition-colors"><i
                        class="fab fa-facebook-f"></i></a>
                <a href="#" class="text-white hover:text-gray-300 transition-colors"><i class="fab fa-twitter"></i></a>
                <a href="#" class="text-white hover:text-gray-300 transition-colors"><i
                        class="fab fa-instagram"></i></a>
            </div>
        </div>
        <div class="md:w-1/3 text-sm text-gray-300">
            <h3 class="font-bold text-lg mb-2">Quick Links</h3>
            <ul class="space-y-1">
                <li><a href="#" class="hover:text-primary-orange transition-colors">Home</a></li>
                <li><a href="#services" class="hover:text-primary-orange transition-colors">Services</a></li>
                <li><a href="#about-us" class="hover:text-primary-orange transition-colors">About Us</a></li>
                <li><a href="#our-impact" class="hover:text-primary-orange transition-colors">Our Impact</a></li>
                <li><a href="#faq" class="hover:text-primary-orange transition-colors">FAQ</a></li>
                <li><a href="#" class="hover:text-primary-orange transition-colors">Careers</a></li>
            </ul>
        </div>
        <div class="md:w-1/3 text-sm text-gray-300">
            <h3 class="font-bold text-lg mb-2">Contact Us</h3>
            <ul class="space-y-1">
                <li><i class="fas fa-phone-alt mr-2"></i> +1 234 567 8900</li>
                <li><i class="fas fa-envelope mr-2"></i> info@godelivery.com</li>
                <li><i class="fas fa-map-marker-alt mr-2"></i> 123 Delivery St, Suite 400, City, Country</li>
            </ul>
        </div>
    </div>
</footer>