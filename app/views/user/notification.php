<?php require_once APPROOT . '/views/inc/nav.php' ?>
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
</style>


<!-- Main Content -->
<main class="flex-1 p-8 md:p-16 flex flex-col items-center">
    <!-- Breadcrumbs -->
    <div class="mb-8 text-gray-600">
        <a href="#" class="hover:underline">Home</a> &gt; Notifications
    </div>

    <!-- Notifications Section -->
    <div class="bg-white p-6 md:p-8 rounded-xl shadow-lg w-full max-w-5xl">
        <h2 class="text-2xl md:text-3xl font-semibold text-gray-800 mb-6 border-b-2 pb-4">Recent Notifications</h2>

        <!-- Notifications List with Scrollbar -->
        <div class="space-y-4 overflow-y-auto max-h-96">
            <!-- Notification Card -->
            <div class="p-4 rounded-xl shadow-sm border border-gray-200 bg-blue-50">
                <div class="flex items-start justify-between">
                    <div class="flex items-center space-x-2">
                        <i class="fas fa-truck-fast text-blue-500"></i>
                        <div class="text-lg font-semibold text-gray-800">Your delivery is on its way!</div>
                    </div>
                    <span class="text-sm text-gray-500 font-medium">23 hours ago</span>
                </div>
                <p class="text-base text-gray-600 mt-2">
                    A new delivery request (Order ID: #MDY702013YGN) is available for acceptance. Check 'Request
                    Deliveries'.
                </p>
            </div>

            <!-- Notification Card -->
            <div class="p-4 rounded-xl shadow-sm border border-gray-200 bg-white">
                <div class="flex items-start justify-between">
                    <div class="flex items-center space-x-2">
                        <i class="fas fa-box-open text-green-500"></i>
                        <div class="text-lg font-semibold text-gray-800">Delivery complete: Order #7890</div>
                    </div>
                    <span class="text-sm text-gray-500 font-medium">1 hour ago</span>
                </div>
                <p class="text-base text-gray-600 mt-2">
                    Your package has been successfully delivered to the recipient. Thank you for using GoDelivery!
                </p>
            </div>

            <!-- Notification Card -->
            <div class="p-4 rounded-xl shadow-sm border border-gray-200 bg-white">
                <div class="flex items-start justify-between">
                    <div class="flex items-center space-x-2">
                        <i class="fas fa-check-circle text-orange-500"></i>
                        <div class="text-lg font-semibold text-gray-800">Pickup request confirmed</div>
                    </div>
                    <span class="text-sm text-gray-500 font-medium">3 hours ago</span>
                </div>
                <p class="text-base text-gray-600 mt-2">
                    Your pickup request has been confirmed. A delivery agent will be with you shortly to collect the
                    parcel.
                </p>
            </div>

            <!-- Notification Card -->
            <div class="p-4 rounded-xl shadow-sm border border-gray-200 bg-white">
                <div class="flex items-start justify-between">
                    <div class="flex items-center space-x-2">
                        <i class="fas fa-user-check text-indigo-500"></i>
                        <div class="text-lg font-semibold text-gray-800">Your account is verified!</div>
                    </div>
                    <span class="text-sm text-gray-500 font-medium">Yesterday</span>
                </div>
                <p class="text-base text-gray-600 mt-2">
                    Welcome to GoDelivery! Your account has been verified and is ready to use.
                </p>
            </div>

            <!-- Notification Card -->
            <div class="p-4 rounded-xl shadow-sm border border-gray-200 bg-blue-50">
                <div class="flex items-start justify-between">
                    <div class="flex items-center space-x-2">
                        <i class="fas fa-tag text-purple-500"></i>
                        <div class="text-lg font-semibold text-gray-800">New offer available!</div>
                    </div>
                    <span class="text-sm text-gray-500 font-medium">2 days ago</span>
                </div>
                <p class="text-base text-gray-600 mt-2">
                    Check out our new limited-time offer on express deliveries. Get a 10% discount on your next two
                    orders.
                </p>
            </div>

            <!-- Notification Card -->
            <div class="p-4 rounded-xl shadow-sm border border-gray-200 bg-white">
                <div class="flex items-start justify-between">
                    <div class="flex items-center space-x-2">
                        <i class="fas fa-comment-dots text-gray-500"></i>
                        <div class="text-lg font-semibold text-gray-800">Feedback survey</div>
                    </div>
                    <span class="text-sm text-gray-500 font-medium">3 days ago</span>
                </div>
                <p class="text-base text-gray-600 mt-2">
                    We'd love to hear your feedback on your recent delivery experience. Please take a moment to
                    complete our quick survey.
                </p>
            </div>

            <!-- Notification Card -->
            <div class="p-4 rounded-xl shadow-sm border border-gray-200 bg-white">
                <div class="flex items-start justify-between">
                    <div class="flex items-center space-x-2">
                        <i class="fas fa-tools text-red-500"></i>
                        <div class="text-lg font-semibold text-gray-800">Scheduled maintenance</div>
                    </div>
                    <span class="text-sm text-gray-500 font-medium">1 week ago</span>
                </div>
                <p class="text-base text-gray-600 mt-2">
                    Please note that the GoDelivery platform will be undergoing scheduled maintenance on Friday at
                    2:00 AM.
                </p>
            </div>

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
                                d="M12 2.163c3.21 0 3.584.013 4.852.072 1.258.058 1.838.257 2.222.403.491.189.882.415 1.248.78.368.367.594.757.78 1.248.146.384.345.964.403 2.222.059 1.268.072 1.633.072 4.852s-.013 3.584-.072 4.852c-.058 1.258-.257 1.838-.403 2.222-.189.491-.415.882-.78 1.248-.367.368-.594-.757-.78-1.248-.384.146-.964.345-2.222.403-1.268.059-1.633.072-4.852.072s-3.584-.013-4.852-.072c-1.258-.058-1.838-.257-2.222-.403-.491-.189-.415-.882-.78-1.248-.367-.368-.594-.757-.78-1.248-.146-.384-.345-.964-.403-2.222-.059-1.268-.072-1.633-.072-4.852s.013-3.584.072-4.852c.058-1.258.257-1.838.403-2.222.189-.491.415-.882.78-1.248.367-.368.757-.594 1.248-.78.384-.146.964-.345 2.222-.403 1.268-.059 1.633-.072 4.852-.072zM12 0C8.74 0 8.333.014 7.053.073c-1.234.058-2.105.248-2.83.526-.74.276-1.348.674-1.952 1.278-.604.604-1.002 1.212-1.278 1.952-.278.725-.468 1.6-.526 2.83-.059 1.28-.073 1.687-.073 4.907s.014 3.627.073 4.907c.058 1.234.248 2.105.526 2.83.276.74.674 1.348 1.278 1.952.604.604 1.212 1.002 1.952 1.278.725.278 1.6.468 2.83.526 1.28.059 1.687.073 4.907.073s3.627-.014 4.907-.073c1.234-.058 2.105-.248 2.83-.526.74-.276 1.348-.674 1.952-1.278.604-.604 1.212-1.002 1.278-1.952.278-.725.468-1.6.526-2.83.059-1.28.073-1.687.073-4.907s-.014-3.627-.073-4.907c-.058-1.234-.248-2.105-.526-2.83-.276-.74-.674-1.348-1.278-1.952-.604-.604-1.212-1.002-1.952-1.278-.725-.278-1.6-.468-2.83-.526-1.28-.059-1.687-.073-4.907-.073zM12 6.865a5.135 5.135 0 1 0 0 10.27A5.135 5.135 0 0 0 12 6.865zM12 8.895a3.105 3.105 0 1 1 0 6.21 3.105 3.105 0 0 1 0-6.21z" />
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