<?php require_once APPROOT . '/views/inc/nav.php' ?>

<!-- Hero Section -->
<section class="pt-24 pb-12 hero-bg">
    <div class="container mx-auto px-4 flex flex-col md:flex-row items-center justify-between gap-8">
        <div class="md:w-1/2 text-center md:text-left">
            <h1 class="text-3xl md:text-5xl font-bold text-[#1F265B] leading-tight mb-4">
                JOIN With GoDelivery <br> Your Trusted Partner in Fast & Reliable Deliveries
            </h1>
            <p class="text-sm md:text-base text-gray-600 leading-relaxed">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Enimdu semper at integer mauris.
                Consectetur arcu aliquet proin nunc at risus id. Malesuada dictum id vel eget nulla ipsum maecenas.
                Praesent feugiat dolor ipsum pharetra laoreet vulputate pellentesque sed.
            </p>
        </div>
        <div class="md:w-1/2 text-center">
            <img src="<?php echo URLROOT; ?>/public/images/home.png" alt="Delivery Illustration"
                class="w-full h-auto rounded-lg">
        </div>
    </div>
</section>

<!-- Search Section -->
<section class="py-10 bg-white shadow-md -mt-12 relative z-20 rounded-lg mx-auto max-w-5xl search-box-shadow">
    <div class="container mx-auto px-4">
        <div class="flex mb-4 border-b-2 border-gray-200">
            <button
                class="tab-button active text-[#1F265B] font-semibold pb-2 border-b-2 border-[#1F265B]">FINDING</button>
            <button class="tab-button text-gray-500 font-semibold ml-6 pb-2">Price Calculator</button>
        </div>
        <form action="<?= URLROOT; ?>/pages/user_tracking" method="POST">
            <div class="flex flex-col md:flex-row gap-4">
                <input type="text" name="code" placeholder="Enter your Bolting Code"
                    class="flex-1 p-3 border rounded-md focus:border-[#1F265B] outline-none">
                <button
                    class="bg-[#1F265B] text-white p-3 rounded-md font-semibold hover:bg-gray-800 transition-colors">Search</button>
            </div>
        </form>
    </div>
</section>

<!-- Content Grid -->
<section class="py-12 bg-[#f0f4f7] mt-8">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Grid Item 1 -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="h-40 bg-gray-200 rounded-lg mb-4 flex items-center justify-center text-gray-500">
                    <i class="fas fa-box text-4xl"></i>
                </div>
                <p class="text-sm text-gray-400">16th March 2024</p>
                <p class="mt-2 text-gray-700">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do
                    eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                <a href="#"
                    class="mt-4 inline-flex items-center justify-center w-10 h-10 rounded-full bg-[#1F265B] text-white hover:bg-gray-800 transition-colors"><i
                        class="fas fa-arrow-right"></i></a>
            </div>
            <!-- Grid Item 2 -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="h-40 bg-gray-200 rounded-lg mb-4 flex items-center justify-center text-gray-500">
                    <i class="fas fa-box text-4xl"></i>
                </div>
                <p class="text-sm text-gray-400">16th March 2024</p>
                <p class="mt-2 text-gray-700">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do
                    eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                <a href="#"
                    class="mt-4 inline-flex items-center justify-center w-10 h-10 rounded-full bg-[#1F265B] text-white hover:bg-gray-800 transition-colors"><i
                        class="fas fa-arrow-right"></i></a>
            </div>
            <!-- Grid Item 3 -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="h-40 bg-gray-200 rounded-lg mb-4 flex items-center justify-center text-gray-500">
                    <i class="fas fa-box text-4xl"></i>
                </div>
                <p class="text-sm text-gray-400">16th March 2024</p>
                <p class="mt-2 text-gray-700">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do
                    eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                <a href="#"
                    class="mt-4 inline-flex items-center justify-center w-10 h-10 rounded-full bg-[#1F265B] text-white hover:bg-gray-800 transition-colors"><i
                        class="fas fa-arrow-right"></i></a>
            </div>
            <!-- Grid Item 4 -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="h-40 bg-gray-200 rounded-lg mb-4 flex items-center justify-center text-gray-500">
                    <i class="fas fa-box text-4xl"></i>
                </div>
                <p class="text-sm text-gray-400">16th March 2024</p>
                <p class="mt-2 text-gray-700">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do
                    eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                <a href="#"
                    class="mt-4 inline-flex items-center justify-center w-10 h-10 rounded-full bg-[#1F265B] text-white hover:bg-gray-800 transition-colors"><i
                        class="fas fa-arrow-right"></i></a>
            </div>
            <!-- Grid Item 5 -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="h-40 bg-gray-200 rounded-lg mb-4 flex items-center justify-center text-gray-500">
                    <i class="fas fa-box text-4xl"></i>
                </div>
                <p class="text-sm text-gray-400">16th March 2024</p>
                <p class="mt-2 text-gray-700">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do
                    eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                <a href="#"
                    class="mt-4 inline-flex items-center justify-center w-10 h-10 rounded-full bg-[#1F265B] text-white hover:bg-gray-800 transition-colors"><i
                        class="fas fa-arrow-right"></i></a>
            </div>
            <!-- Grid Item 6 -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="h-40 bg-gray-200 rounded-lg mb-4 flex items-center justify-center text-gray-500">
                    <i class="fas fa-box text-4xl"></i>
                </div>
                <p class="text-sm text-gray-400">16th March 2024</p>
                <p class="mt-2 text-gray-700">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do
                    eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                <a href="#"
                    class="mt-4 inline-flex items-center justify-center w-10 h-10 rounded-full bg-[#1F265B] text-white hover:bg-gray-800 transition-colors"><i
                        class="fas fa-arrow-right"></i></a>
            </div>
        </div>
    </div>
</section>

<!-- Footer -->
<footer class="bg-[#1F265B] text-white py-12">
    <div
        class="container mx-auto px-4 flex flex-col md:flex-row justify-between items-center gap-8 text-center md:text-left">
        <div class="md:w-1/2">
            <h2 class="text-3xl md:text-5xl font-bold mb-4">GoDelivery</h2>
            <p class="text-gray-300">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor
                incididunt ut labore et dolore magna aliqua.</p>
            <div class="mt-6 flex justify-center md:justify-start space-x-4">
                <a href="#" class="text-white hover:text-gray-300 transition-colors"><i
                        class="fab fa-facebook-f"></i></a>
                <a href="#" class="text-white hover:text-gray-300 transition-colors"><i class="fab fa-twitter"></i></a>
                <a href="#" class="text-white hover:text-gray-300 transition-colors"><i
                        class="fab fa-instagram"></i></a>
            </div>
        </div>
        <div class="md:w-1/2">
            <img src="https://placehold.co/400x300/E5E7EB/4B5563?text=Footer+Illustration" alt="Footer Illustration"
                class="w-full h-auto rounded-lg">
        </div>
    </div>
</footer>

</body>

</html>