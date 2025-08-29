<?php require_once APPROOT . '/views/inc/nav.php';
$township = $data['township'];
?>

<!-- Include Select2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

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

/* Optional: Adjust Select2 height */
.select2-container .select2-selection--single {
    height: 48px;
    padding: 5px 12px;
    border-radius: 6px;
    border: 1px solid #ddd;
}
</style>

<!-- Page Header Section -->
<section class="py-16 bg-[#f0f4f7] text-center mt-[70px]">
    <div class="container mx-auto px-4">
        <h1 class="text-3xl md:text-4xl font-bold text-[#333] mb-2">Price Calculator</h1>
        <p class="text-base text-[#4A5568]">Home <i class="fas fa-arrow-right mx-2 text-gray-400"></i> Price Calculator
        </p>
    </div>
</section>

<!-- Calculator Form Section -->
<section class="py-16 bg-[#e6f0ff]">
    <form action="<?= URLROOT; ?>/auth/calculateprice" method="POST">
        <div class="container mx-auto px-4 search-box-container">
            <div class="form-row">

                <!-- From City -->
                <div class="flex-1 w-full md:w-auto">
                    <label for="fromCity" class="block font-semibold mb-2 text-[#333]">From City</label>
                    <select id="fromCity" name="fromCity" class="w-full">
                        <option value="">Select City</option>
                        <?php foreach ($township as $t): ?>
                        <option value="<?= $t['id'] ?>"><?= htmlspecialchars($t['name']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- To City -->
                <div class="flex-1 w-full md:w-auto">
                    <label for="toCity" class="block font-semibold mb-2 text-[#333]">To City</label>
                    <select id="toCity" name="toCity" class="w-full">
                        <option value="">Select City</option>
                        <?php foreach ($township as $t): ?>
                        <option value="<?= $t['id'] ?>"><?= htmlspecialchars($t['name']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Service Type -->
                <div class="flex-1 w-full md:w-auto">
                    <label for="serviceType" class="block font-semibold mb-2 text-[#333]">Service Type</label>
                    <select id="serviceType" name="serviceType" class="w-full">
                        <option value="">Select Service</option>
                        <option value="express">Express</option>
                        <option value="standard">Standard</option>
                    </select>
                </div>

                <!-- Weight Input -->
                <div class="flex-1 w-full md:w-auto">
                    <label for="weight" class="block font-semibold mb-2 text-[#333]">Weight (kg)</label>
                    <input type="number" id="weight" name="weight"
                        class="w-full p-3 border border-[#ddd] rounded-md focus:outline-none focus:border-[#1F265B] bg-white"
                        placeholder="e.g., 5">
                </div>

                <!-- Calculate Button -->
                <div class="mt-8 md:mt-0 w-full md:w-auto">
                    <button
                        class="w-full md:w-auto px-6 py-3 bg-[#1F265B] text-white rounded-md font-semibold hover:bg-gray-800 transition-colors">
                        Calculate
                    </button>
                </div>

            </div>
        </div>
    </form>
</section>

<?php if (!empty($data['result'])): ?>
<?php if (!empty($data['result']['error'])): ?>
<div class="mt-6 p-4 bg-red-100 text-red-700 rounded-md text-center">
    <?= htmlspecialchars($data['result']['error']) ?>
</div>
<?php elseif (!empty($data['result']['total'])): ?>
<section class="py-12 bg-gray-50">
    <div class="container mx-auto px-4 grid md:grid-cols-2 gap-6">

        <!-- Left Card -->
        <!-- Left Card -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="text-lg font-bold text-blue-600 mb-4">Calculate Info</h3>

            <div class="space-y-3 text-gray-700">
                <div class="flex justify-between border-b pb-2">
                    <span class="font-medium">From:</span>
                    <span><?= $data['result']['from'] ?></span>
                </div>
                <div class="flex justify-between border-b pb-2">
                    <span class="font-medium">To:</span>
                    <span><?= $data['result']['to'] ?></span>
                </div>
                <div class="flex justify-between border-b pb-2">
                    <span class="font-medium">Weight (kg):</span>
                    <span><?= $data['result']['weight'] ?> Kg</span>
                </div>
                <div class="flex justify-between border-b pb-2">
                    <span class="font-medium">Service:</span>
                    <span><?= $data['result']['type'] ?></span>
                </div>
                <div class="flex justify-between pt-3">
                    <span class="font-semibold text-lg">Amount:</span>
                    <span class="text-2xl font-bold text-[#1F265B]">
                        <?= number_format($data['result']['total'], 0) ?> MMK
                    </span>
                </div>
            </div>
        </div>


        <!-- Right Card -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="text-lg font-bold text-blue-600 mb-4">Details</h3>

            <div class="space-y-3 text-gray-700">
                <div class="border-b pb-2">
                    <p class="text-gray-900 font-semibold">Agent Name</p>
                    <p class="bg-gray-100 px-4 py-2 rounded-md inline-block text-lg font-bold text-[#1F265B] mt-1">
                        <?= $data['result']['agent_name'] ?>
                    </p>
                </div>
                <div class="border-b pb-2">
                    <p class="text-gray-900 font-semibold">Contact Number</p>
                    <p class="bg-gray-100 px-4 py-2 rounded-md inline-block text-lg font-bold text-[#1F265B] mt-1">
                        <?= $data['result']['phone'] ?>
                    </p>
                </div>
                <div class="border-b pb-2">
                    <p class="text-gray-900 font-semibold">Duration Time</p>
                    <p class="bg-gray-100 px-4 py-2 rounded-md inline-block text-lg font-bold text-[#1F265B] mt-1">
                        <?= $data['result']['note'] ?>
                    </p>
                </div>
            </div>
        </div>

    </div>
</section>
<?php endif; ?>
<?php else: ?>
<!-- Show Image if no result -->
<section class="py-16 bg-[#f8f9fa] text-center">
    <div class="container mx-auto px-4">
        <img src="<?php echo URLROOT; ?>/public/images/calculator.png" alt="Volume and Irregular Item Calculation Guide"
            class="max-w-full h-auto rounded-lg shadow-md">
    </div>
</section>
<?php endif; ?>






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

<!-- Include jQuery and Select2 JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
$(document).ready(function() {
    $('#fromCity, #toCity, #serviceType').select2({
        placeholder: 'Select an option',
        width: '100%'
    });
});
</script>