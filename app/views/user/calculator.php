<?php require_once APPROOT . '/views/inc/nav.php' ?>
<style>
    body {
        font-family: 'Poppins', sans-serif;
        line-height: 1.6;
        color: #4A5568;
        background-color: #f8f9fa;
    }

    .hero-bg {
        background-color: #f0f4f7;
    }

    .search-box-container {
        background-color: #fff;
        padding: 2.5rem;
        border-radius: 0.5rem;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
    }

    .form-row {
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
    }

    @media (min-width: 768px) {
        .form-row {
            flex-direction: row;
            align-items: flex-end;
        }
    }
</style>


<!-- Page Header Section -->
<section class="py-16 bg-[#f0f4f7] text-center mt-[70px]">
    <div class="container mx-auto px-4">
        <h1 class="text-3xl md:text-4xl font-bold text-[#333] mb-2">Price Calculator</h1>
        <p class="text-base text-[#4A5568]">Home <i class="fas fa-arrow-right mx-2 text-gray-400"></i> Price
            Calculator</p>
    </div>
</section>

<!-- Calculator Form Section -->
<section class="py-16 bg-[#e6f0ff]">
    <div class="container mx-auto px-4 search-box-container">
        <div class="form-row">
            <!-- From City -->
            <div class="flex-1 w-full md:w-auto">
                <label for="fromCity" class="block font-semibold mb-2 text-[#333]">From City</label>
                <select id="fromCity"
                    class="w-full p-3 border border-[#ddd] rounded-md focus:outline-none focus:border-[#1F265B] bg-white">
                    <option>Yangon</option>
                    <option>Mandalay</option>
                    <option>Naypyidaw</option>
                </select>
            </div>
            <!-- To City -->
            <div class="flex-1 w-full md:w-auto">
                <label for="toCity" class="block font-semibold mb-2 text-[#333]">To City</label>
                <select id="toCity"
                    class="w-full p-3 border border-[#ddd] rounded-md focus:outline-none focus:border-[#1F265B] bg-white">
                    <option>Mandalay</option>
                    <option>Yangon</option>
                    <option>Naypyidaw</option>
                </select>
            </div>
            <!-- Service Type -->
            <div class="flex-1 w-full md:w-auto">
                <label for="serviceType" class="block font-semibold mb-2 text-[#333]">Service Type</label>
                <select id="serviceType"
                    class="w-full p-3 border border-[#ddd] rounded-md focus:outline-none focus:border-[#1F265B] bg-white">
                    <option>Express</option>
                    <option>Standard</option>
                </select>
            </div>
            <!-- Weight Input -->
            <div class="flex-1 w-full md:w-auto">
                <label for="weight" class="block font-semibold mb-2 text-[#333]">Weight (kg)</label>
                <input type="number" id="weight"
                    class="w-full p-3 border border-[#ddd] rounded-md focus:outline-none focus:border-[#1F265B] bg-white"
                    placeholder="e.g., 5">
            </div>
            <!-- Calculate Button -->
            <div class="mt-8 md:mt-0 w-full md:w-auto">
                <a href="./calculate_result.html">
                    <button
                        class="w-full md:w-auto px-6 py-3 bg-[#1F265B] text-white rounded-md font-semibold hover:bg-gray-800 transition-colors">Calculate</button>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Calculation Guide Section (with static image) -->
<section class="py-16 bg-[#f8f9fa] text-center">
    <div class="container mx-auto px-4">
        <img src="<?php echo URLROOT; ?>/public/images/calculator.png" alt="Volume and Irregular Item Calculation Guide"
            class="max-w-full h-auto rounded-lg shadow-md">
    </div>
</section>

<!-- Footer (Recreated from previous context) -->
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