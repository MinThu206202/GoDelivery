<?php session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);


// Placeholder for PHP include. In a real environment, you would use this.
require_once APPROOT . '/views/inc/nav.php'
?>

<style>
    /* Custom CSS variables from the original file */
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

    body {
        font-family: 'Poppins', sans-serif;
    }

    .header-bg {
        background-color: var(--primary-color);
    }

    .footer-bg {
        background-color: var(--dark-blue-footer);
    }
</style>

<!-- Main Content -->
<main class="flex-1 p-8 md:p-16 flex flex-col items-center">
    <!-- Breadcrumbs -->
    <div class="mb-8 text-gray-600">
        <a href="pickup-history.php" class="hover:underline">Pickup History</a> &gt; Details
    </div>

    <!-- Details Section -->
    <div class="bg-white p-8 md:p-12 rounded-xl shadow-lg w-full max-w-2xl">
        <h2 class="text-center text-4xl font-semibold text-gray-800 mb-8">Pickup Details</h2>

        <!-- Details Card -->
        <div class="space-y-6">
            <div class="p-6 bg-gray-50 rounded-lg border border-gray-200">
                <h3 class="text-xl font-bold text-gray-700 mb-4">Request Information</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-gray-600">
                    <div>
                        <strong>Tracking ID:</strong> <?= htmlspecialchars($data['request_code']) ?>
                    </div>
                    <div>
                        <strong>Requested on:</strong> <?= htmlspecialchars($data['preferred_date']) ?>
                    </div>
                    <div>
                        <strong>Status:</strong> <span
                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800"><?= htmlspecialchars($data['status']) ?></span>
                    </div>
                </div>
            </div>

            <div class="p-6 bg-gray-50 rounded-lg border border-gray-200">
                <h3 class="text-xl font-bold text-gray-700 mb-4">Pickup Address</h3>
                <div class="space-y-2 text-gray-600">
                    <p><strong>Region:</strong> <?= htmlspecialchars($data['sender_region']) ?></p>
                    <p><strong>City:</strong> <?= htmlspecialchars($data['sender_city']) ?></p>
                    <p><strong>Township:</strong> <?= htmlspecialchars($data['sender_township']) ?></p>
                </div>
            </div>

            <div class="p-6 bg-gray-50 rounded-lg border border-gray-200">
                <h3 class="text-xl font-bold text-gray-700 mb-4">Receiver Information</h3>
                <div class="space-y-2 text-gray-600">
                    <p><strong>Name:</strong> <?= htmlspecialchars($data['receiver_name']) ?? 'N/A' ?></p>
                    <p><strong>Phone:</strong> <?= htmlspecialchars($data['receiver_phone']) ?></p>
                    <p><strong>Address:</strong> <?= htmlspecialchars($data['receiver_address']) ?></p>
                </div>
            </div>
        </div>

        <div class="mt-8 text-center">
            <a href="<?php echo URLROOT; ?>/page/pickuphistory"
                class="inline-block bg-[#1F265B] text-white font-bold py-3 px-8 rounded-full shadow-lg hover:bg-[#141a40] transition-colors duration-200">
                &larr; Back to History
            </a>
        </div>
    </div>
</main>

<!-- Footer Section -->
<footer class="footer-bg text-white p-8 md:p-12">
    <div class="container mx-auto">
        <div class="flex flex-col md:flex-row justify-between items-center text-center md:text-left">
            <div class="mb-6 md:mb-0 md:w-1/2">
                <h2 class="text-3xl font-bold mb-2">Contact Us</h2>
                <h3 class="text-5xl font-extrabold mb-4">Fast, Affordable, And Always On Time.</h3>
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
                    <a href="#" class="text-white hover:text-gray-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
                            <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                            <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
                        </svg>
                    </a>
                    <a href="#" class="text-white hover:text-gray-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="currentColor">
                            <path
                                d="M19 0H5a5 5 0 0 0-5 5v14a5 5 0 0 0 5 5h14a5 5 0 0 0 5-5V5a5 5 0 0 0-5-5zm-3 7h-2c-1.087 0-1.85.602-1.85 2.056V11h3l-.48 3H12v8h-3v-8H7V11h2.02v-1.487c0-1.876 1.13-2.915 3.17-2.915h3.81V7z" />
                        </svg>
                    </a>
                </div>
            </div>
            <div class="hidden md:block">
                <!-- Placeholder for the image -->
                <svg xmlns="http://www.w3.org/2000/svg" class="h-48 w-48 text-white opacity-25" viewBox="0 0 24 24"
                    fill="currentColor">
                    <path
                        d="M4 3h16a2 2 0 012 2v14a2 2 0 01-2 2H4a2 2 0 01-2-2V5a2 2 0 012-2zM4 5v14h16V5H4zm2 1.5a1.5 1.5 0 100 3 1.5 1.5 0 000-3zM18 17H6l4-4 4 4 4-4v4z" />
                </svg>
            </div>
        </div>
    </div>
</footer>
</body>

</html>