<?php require_once APPROOT . '/views/inc/nav.php';
if (!isset($data['regions'])) {
    $data['regions'] = [
        ['id' => 1, 'name' => 'Yangon Region'],
        ['id' => 2, 'name' => 'Mandalay Region'],
        ['id' => 3, 'name' => 'Naypyidaw Union Territory'],
        ['id' => 4, 'name' => 'Sagaing Region'],
    ];
}
?>
<link rel="stylesheet" type="text/css" href="<?php echo URLROOT; ?>/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo URLROOT; ?>/vendor/animate/animate.css">
<link rel="stylesheet" type="text/css" href="<?php echo URLROOT; ?>/vendor/css-hamburgers/hamburgers.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo URLROOT; ?>/vendor/select2/select2.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo URLROOT; ?>/css/util.css">
<link rel="stylesheet" type="text/css" href="<?php echo URLROOT; ?>/css/main.css">
<style>
body {
    font-family: 'Poppins', sans-serif;
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

.input-style {
    padding: 12px;
    border-radius: 8px;
    border: 1px solid var(--border-color);
    background-color: var(--light-grey);
    font-size: 14px;
    width: 100%;
    transition: all 0.2s ease-in-out;
}

.input-style:focus {
    outline: none;
    border-color: var(--primary-color);
    box-shadow: 0 0 0 3px rgba(31, 38, 91, 0.2);
}
</style>


<!-- Main Content -->
<main class="flex-1 p-8 md:p-16 flex flex-col items-center">
    <!-- Breadcrumbs -->
    <div class="mb-8 text-gray-600">
        <a href="#" class="hover:underline">Home</a> &gt; Pickup Request
    </div>

    <!-- Pickup Request Section -->
    <div class="bg-white p-8 md:p-12 rounded-xl shadow-lg w-full max-w-4xl">
        <h2 class="text-center text-4xl font-semibold text-gray-800 mb-8">Schedule a Pickup</h2>

        <form class="space-y-6" method="POST" action="<?php echo URLROOT; ?>/pickupcontroller/pickuprequest">
            <!-- Name, Phone Number, and Email -->
            <?php require APPROOT . '/views/components/auth_message.php'; ?>


            <!-- New Region, City, and Township Dropdowns for Pickup Address -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <label for="pickup_region" class="block text-sm font-medium text-gray-700 mb-1">Region</label>
                    <select id="pickup_region" name="pickup_region" class="input-style">
                        <option value="">Select Region</option>
                        <?php foreach ($data['regions'] as $region): ?>
                        <option value="<?= $region['id'] ?>"><?= $region['name'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div>
                    <label for="pickup_city" class="block text-sm font-medium text-gray-700 mb-1">City</label>
                    <select id="pickup_city" name="pickup_city" class="input-style">
                        <option value="">Select City</option>
                    </select>
                </div>
                <div>
                    <label for="pickup_township" class="block text-sm font-medium text-gray-700 mb-1">Township</label>

                    <select id="pickup_township" name="pickup_township" class="input-style">
                        <option value="">Select Township</option>
                    </select>
                </div>
            </div>

            <!-- Pickup Address and Landmark -->
            <div>
                <label for="pickup_address" class="block text-sm font-medium text-gray-700 mb-1">Pickup
                    Address</label>
                <input type="text" id="pickup_address" name="pickup_address"
                    placeholder="Full street address, township/city" class="input-style">
            </div>
            <div>
                <label for="landmark" class="block text-sm font-medium text-gray-700 mb-1">Landmark/Building</label>
                <input type="text" id="landmark" name="landmark" placeholder="e.g., Near ABC Supermarket"
                    class="input-style">
            </div>

            <!-- Date -->
            <div>
                <label for="preferred_date" class="block text-sm font-medium text-gray-700 mb-1">
                    Preferred Date
                </label>
                <div class="relative">
                    <!-- Date Input -->
                    <input type="date" id="preferred_date" name="preferred_date"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 input-style"
                        min="" max="">

                    <!-- Custom Calendar Icon -->
                    <span class="absolute inset-y-0 right-3 flex items-center pointer-events-none text-gray-500">
                        <!-- Heroicons calendar -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </span>
                </div>
            </div>

            <!-- Parcel Details -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <label for="parcel_type" class="block text-sm font-medium text-gray-700 mb-1">Parcel
                        Type</label>
                    <select id="parcel_type" name="parcel_type" class="input-style">
                        <option value="">Select parcel type</option>
                        <option value="1">Document</option>
                        <option value="2">Box</option>
                        <option value="3">Fragile</option>
                        <option value="4">Food</option>
                        <option value="5">Other</option>
                    </select>
                </div>
                <div>
                    <label for="weight" class="block text-sm font-medium text-gray-700 mb-1">Guess Weight
                        (approximate)</label>
                    <select id="weight" name="weight" class="input-style">
                        <option value="">Select weight</option>
                        <option value="<1kg">&lt;1kg</option>
                        <option value="1-5kg">1–5kg</option>
                        <option value="5-10kg">5–10kg</option>
                        <option value=">10kg">&gt;10kg</option>
                    </select>
                </div>
                <div>
                    <label for="quantity" class="block text-sm font-medium text-gray-700 mb-1">Quantity</label>
                    <input type="number" id="quantity" name="quantity" min="1" placeholder="Number of parcels"
                        class="input-style">
                </div>
            </div>

            <!-- Payment Type and Delivery Type -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="payment_type" class="block text-sm font-medium text-gray-700 mb-1">Payment
                        Type</label>
                    <select id="payment_type" name="payment_type" class="input-style">
                        <option value="">Select payment type</option>
                        <option value=1>Sender Pay</option>
                        <option value=2>Receiver Pay</option>
                    </select>
                </div>
                <div>
                    <label for="delivery_type" class="block text-sm font-medium text-gray-700 mb-1">Delivery
                        Type</label>
                    <select id="delivery_type" name="delivery_type" class="input-style">
                        <option value="">Select delivery type</option>
                        <option value="1">Normal</option>
                        <option value="2">Express</option>
                        <option value="3">In-City</option>
                        <option value="4">Important</option>
                    </select>
                    <div id="delivery_notice"
                        class="hidden mt-2 p-3 rounded-md border-l-4 border-yellow-400 bg-yellow-50 text-yellow-800 text-sm flex items-center gap-2 shadow-sm">
                        <!-- Info Icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 flex-shrink-0" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 16h-1v-4h-1m1-4h.01M12 20c4.418 0 8-3.582 8-8s-3.582-8-8-8-8 3.582-8 8 3.582 8 8 8z" />
                        </svg>
                        <span>This delivery is faster and may cost more</span>
                    </div>
                </div>

            </div>

            <!-- Special Notes -->
            <!-- <div>
            <label for="special_notes" class="block text-sm font-medium text-gray-700 mb-1">Special
            Notes</label>
            <textarea id="special_notes" name="special_notes" rows="3"
            placeholder="Any special instructions for the agent" class="input-style"></textarea>
            </div> -->

            <!-- Receiver Info with separate fields -->
            <div class="space-y-4 p-4 border border-gray-200 rounded-lg bg-gray-50">
                <h3 class="text-md font-semibold text-gray-800">Receiver Info (Optional)</h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="receiver_name" class="block text-sm font-medium text-gray-700 mb-1">Name</label>
                        <input type="text" id="receiver_name" name="receiver_name" placeholder="Receiver's name"
                            class="input-style">
                    </div>
                    <div>
                        <label for="receiver_phone" class="block text-sm font-medium text-gray-700 mb-1">Phone</label>
                        <input type="tel" id="receiver_phone" name="receiver_phone"
                            placeholder="Receiver's phone number" class="input-style">
                    </div>
                </div>

                <div>
                    <label for="receiver_email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input type="email" id="receiver_email" name="receiver_email" placeholder="Receiver's email"
                        class="input-style">
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label for="receiver_region" class="block text-sm font-medium text-gray-700 mb-1">Region</label>
                        <select id="receiver_region" name="receiver_region" class="input-style">
                            <option value="">Select Region</option>
                            <?php foreach ($data['regions'] as $region): ?>
                            <option value="<?= $region['id'] ?>"><?= $region['name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div>
                        <label for="receiver_city" class="block text-sm font-medium text-gray-700 mb-1">City</label>
                        <select id="receiver_city" name="receiver_city" class="input-style">
                            <option value="">Select City</option>
                        </select>
                    </div>
                    <div>
                        <label for="receiver_township"
                            class="block text-sm font-medium text-gray-700 mb-1">Township</label>
                        <select id="receiver_township" name="receiver_township" class="input-style">
                            <option value="">Select Township</option>
                        </select>
                    </div>
                </div>
                <div>
                    <label for="receiver_address" class="block text-sm font-medium text-gray-700 mb-1">Address</label>
                    <textarea id="receiver_address" name="receiver_address" rows="2"
                        placeholder="Receiver's street address" class="input-style"></textarea>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="flex justify-end">
                <button type="submit"
                    class="px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg shadow-md hover:bg-blue-700 transition-colors duration-200">
                    Submit Request
                </button>
            </div>
        </form>
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
                                d="M12 2.163c3.21 0 3.584.013 4.852.072 1.258.058 1.838.257 2.222.403.491.189.882.415 1.248.78.368.367.594.757.78 1.248.146.384.345.964.403 2.222.059 1.268.072 1.633.072 4.852s-.013 3.584-.072 4.852c-.058 1.258-.257 1.838-.403 2.222-.189.491-.415.882-.78 1.248-.367.368-.757.594-1.248.78-.384.146-.964.345-2.222.403-1.268.059-1.633.072-4.852.072s-3.584-.013-4.852-.072c-1.258-.058-1.838-.257-2.222-.403-.491-.189-.415-.882-.78-1.248-.367-.368-.757-.594-1.248-.78-.384-.146-.964-.345-2.222-.403-1.268-.059-1.633-.072-4.852-.072zM12 0C8.74 0 8.333.014 7.053.073c-1.234.058-2.105.248-2.83.526-.74.276-1.348.674-1.952 1.278-.604.604-1.002 1.212-1.278 1.952-.278.725-.468 1.6-.526 2.83-.059 1.28-.073 1.687-.073 4.907s.014 3.627.073 4.907c.058 1.234.248 2.105.526 2.83.276.74.674 1.348 1.278 1.952.604.604 1.212 1.002 1.952 1.278.725.278 1.6.468 2.83.526 1.28.059 1.687.073 4.907.073s3.627-.014 4.907-.073c1.234-.058 2.105-.248 2.83-.526.276-.74.674-1.348 1.278-1.952.604-.604 1.212-1.002 1.278-1.952-.725-.278-1.6-.468-2.83-.526-1.28-.059-1.687-.073-4.907-.073zM12 6.865a5.135 5.135 0 1 0 0 10.27A5.135 5.135 0 0 0 12 6.865zM12 8.895a3.105 3.105 0 1 1 0 6.21 3.105 3.105 0 0 1 0-6.21z" />
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

<script>
// Allow only today up to 5 days later
document.addEventListener("DOMContentLoaded", function() {
    const today = new Date();
    const maxDate = new Date();
    maxDate.setDate(today.getDate() + 5);

    const todayStr = today.toISOString().split("T")[0];
    const maxStr = maxDate.toISOString().split("T")[0];

    const dateInput = document.getElementById("preferred_date");
    dateInput.setAttribute("min", todayStr);
    dateInput.setAttribute("max", maxStr);
});


document.addEventListener('DOMContentLoaded', function() {
    const regionSelect = document.getElementById('pickup_region');
    const citySelect = document.getElementById('pickup_city');
    const townshipSelect = document.getElementById('pickup_township');

    regionSelect.addEventListener('change', function() {
        const regionId = this.value;
        citySelect.innerHTML = '<option value="">Select City</option>';
        townshipSelect.innerHTML = '<option value="">Select Township</option>';

        if (regionId) {
            fetch('<?= URLROOT ?>/routepage/getCities?region_id=' + regionId)
                .then(res => res.json())
                .then(data => {
                    data.forEach(city => {
                        let option = document.createElement('option');
                        option.value = city.id;
                        option.textContent = city.name;
                        citySelect.appendChild(option);
                    });
                });
        }
    });

    citySelect.addEventListener('change', function() {
        const cityId = this.value;
        townshipSelect.innerHTML = '<option value="">Select Township</option>';

        if (cityId) {
            fetch('<?= URLROOT ?>/routepage/getTownships?city_id=' + cityId)
                .then(res => res.json())
                .then(data => {
                    data.forEach(township => {
                        let option = document.createElement('option');
                        option.value = township.id;
                        option.textContent = township.name;
                        townshipSelect.appendChild(option);
                    });
                });
        }
    });
});

document.addEventListener('DOMContentLoaded', function() {
    const receiverRegionSelect = document.getElementById('receiver_region');
    const receiverCitySelect = document.getElementById('receiver_city');
    const receiverTownshipSelect = document.getElementById('receiver_township');

    receiverRegionSelect.addEventListener('change', function() {
        const regionId = this.value;
        receiverCitySelect.innerHTML = '<option value="">Select City</option>';
        receiverTownshipSelect.innerHTML = '<option value="">Select Township</option>';

        if (regionId) {
            fetch('<?= URLROOT ?>/routepage/getCities?region_id=' + regionId)
                .then(res => res.json())
                .then(data => {
                    data.forEach(city => {
                        let option = document.createElement('option');
                        option.value = city.id;
                        option.textContent = city.name;
                        receiverCitySelect.appendChild(option);
                    });
                });
        }
    });

    receiverCitySelect.addEventListener('change', function() {
        const cityId = this.value;
        receiverTownshipSelect.innerHTML = '<option value="">Select Township</option>';

        if (cityId) {
            fetch('<?= URLROOT ?>/routepage/getTownships?city_id=' + cityId)
                .then(res => res.json())
                .then(data => {
                    data.forEach(township => {
                        let option = document.createElement('option');
                        option.value = township.id;
                        option.textContent = township.name;
                        receiverTownshipSelect.appendChild(option);
                    });
                });
        }
    });
});
</script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const deliveryType = document.getElementById('delivery_type');
    const receiverRegionDiv = document.getElementById('receiver_region').parentElement;
    const receiverCityDiv = document.getElementById('receiver_city').parentElement;
    const receiverTownshipDiv = document.getElementById('receiver_township').parentElement;
    const deliveryNotice = document.getElementById('delivery_notice');

    function updateDeliveryFields() {
        const value = deliveryType.value;

        // Hide receiver region/city/township if In-City
        if (value === '3') { // In-City
            receiverRegionDiv.style.display = 'none';
            receiverCityDiv.style.display = 'none';
            receiverTownshipDiv.style.display = 'none';
        } else {
            receiverRegionDiv.style.display = '';
            receiverCityDiv.style.display = '';
            receiverTownshipDiv.style.display = '';
        }

        // Show notice if Important
        if (value === '4') { // Important
            deliveryNotice.classList.remove('hidden');
        } else {
            deliveryNotice.classList.add('hidden');
        }
    }

    // Initialize on page load
    updateDeliveryFields();

    // Listen for changes
    deliveryType.addEventListener('change', updateDeliveryFields);
});
</script>



</body>

</html>