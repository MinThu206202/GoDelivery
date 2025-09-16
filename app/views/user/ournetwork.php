<?php require_once APPROOT . '/views/inc/nav.php';

?>

<style>
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap');

:root {
    --primary-color: #1F265B;
    --secondary-color: #333;
    --heading-color: #333;
    --light-grey: #f8f9fa;
    --dark-blue-footer: #1F265B;
    --white: #fff;
    --border-color: #ddd;
    --form-bg-color: #e6f0ff;
    --section-bg-color: #f0f4f7;
    --text-color: #4A5568;
    --tracking-active-bg: #E3F2FD;
    --tracking-active-text: #1F265B;
}

.bg-primary-blue {
    background-color: #1F265B;
}

body {
    font-family: 'Poppins', sans-serif;
    line-height: 1.6;
    color: var(--text-color);
    background-color: var(--light-grey);
    display: flex;
    flex-direction: column;
    min-height: 100vh;
}

.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
}

/* Custom styles integrated from ournetwork.css */
.new-main-header {
    background-color: var(--primary-color);
    color: var(--white);
    padding: 15px 30px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    flex-wrap: wrap;
    flex-shrink: 0;
    width: 100%;
    z-index: 100;
}

.new-main-header .logo-link {
    text-decoration: none;
    color: inherit;
}

.new-main-header .logo {
    font-size: 28px;
    font-weight: 700;
    color: var(--white);
}

.new-main-header .main-nav {
    display: flex;
    gap: 25px;
    flex-wrap: wrap;
    justify-content: center;
    align-items: center;
    margin-left: auto;
}

.new-main-header .main-nav .nav-item {
    color: rgba(255, 255, 255, 0.8);
    text-decoration: none;
    font-size: 16px;
    font-weight: 500;
    transition: color 0.3s ease;
    padding: 5px 0;
}

.new-main-header .main-nav .nav-item:hover {
    color: var(--white);
}

.new-main-header .main-nav .nav-item.tracking {
    background-color: var(--tracking-active-bg);
    color: var(--tracking-active-text);
    padding: 8px 18px;
    border-radius: 9999px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
    transition: background-color 0.3s ease, color 0.3s ease, box-shadow 0.3s ease;
    display: flex;
    align-items: center;
    gap: 8px;
}

.new-main-header .main-nav .login-button {
    background-color: var(--white);
    color: var(--primary-color);
    padding: 8px 18px;
    border: none;
    border-radius: 9999px;
    font-size: 16px;
    font-weight: 600;
    cursor: pointer;
    transition: background-color 0.3s ease, transform 0.1s ease, box-shadow 0.3s ease;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
}

.page-header {
    background-color: var(--section-bg-color);
    padding: 60px 0;
    text-align: center;
    margin-top: 70px;
}

.page-header h1 {
    font-size: 40px;
    color: var(--heading-color);
    margin-bottom: 10px;
}

.page-header p {
    font-size: 16px;
    color: var(--text-color);
}

.page-header p i {
    margin: 0 8px;
    font-size: 14px;
    color: #999;
}

.network-filter-section {
    background-color: var(--form-bg-color);
    padding: 60px 0;
}

.network-filter-section .filter-row {
    display: flex;
    justify-content: space-around;
    align-items: flex-end;
    gap: 20px;
    flex-wrap: wrap;
}

.network-filter-section .filter-group {
    flex: 1;
    min-width: 200px;
    margin-bottom: 20px;
}

.network-filter-section label {
    display: block;
    font-weight: 600;
    margin-bottom: 8px;
    color: var(--heading-color);
}

.network-filter-section select {
    width: 100%;
    padding: 12px 15px;
    border: 1px solid var(--border-color);
    border-radius: 5px;
    font-size: 16px;
    appearance: none;
    background-color: var(--white);
    background-image: url('data:image/svg+xml;charset=US-ASCII,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%22292.4%22%20height%3D%22292.4%22%3E%3Cpath%20fill%3D%22%23007bff%22%20d%3D%22M287%2069.9a14.77%2014.77%200%2000-20.8%200L146.2%20190.2%2026.2%2069.9A14.77%2014.77%200%20005.4%2090.7l120%20120%20120-120A14.77%2014.77%200%2000287%2069.9z%22%2F%3E%3C%2Fsvg%3E');
    background-repeat: no-repeat;
    background-position: right 15px top 50%;
    background-size: 12px;
    cursor: pointer;
}

.network-content-section {
    padding: 60px 0;
    background-color: var(--light-grey);
}

.network-content-section .network-info-wrapper {
    display: flex;
    gap: 30px;
    flex-wrap: wrap;
    align-items: flex-start;
}

.network-content-section .network-locations {
    flex: 1;
    min-width: 300px;
    max-height: 500px;
    overflow-y: auto;
    padding-right: 15px;
    scrollbar-width: thin;
    scrollbar-color: var(--primary-color) #f1f1f1;
}

.network-content-section .network-locations::-webkit-scrollbar {
    width: 8px;
}

.network-content-section .network-locations::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 10px;
}

.network-content-section .network-locations::-webkit-scrollbar-thumb {
    background: var(--primary-color);
    border-radius: 10px;
}

.network-content-section .network-locations::-webkit-scrollbar-thumb:hover {
    background: #0056b3;
}

.network-content-section .location-card {
    background-color: var(--white);
    padding: 25px;
    border-radius: 8px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    margin-bottom: 20px;
    border-left: 5px solid var(--primary-color);
}

.network-content-section .location-card h3 {
    font-size: 20px;
    color: var(--heading-color);
    margin-bottom: 10px;
}

.network-content-section .location-card p {
    font-size: 15px;
    color: var(--text-color);
    line-height: 1.5;
}

.network-content-section .network-map-placeholder {
    flex: 2;
    min-width: 400px;
    height: 500px;
    background-color: #e0e0e0;
    border-radius: 10px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
    display: flex;
    justify-content: center;
    align-items: center;
    position: relative;
    overflow: hidden;
}

.network-content-section .map-overlay {
    text-align: center;
    color: #999;
}

.network-content-section .map-overlay i {
    font-size: 80px;
    margin-bottom: 15px;
}

.network-content-section .map-overlay p {
    font-size: 20px;
    font-weight: 500;
}

.footer {
    background-color: var(--dark-blue-footer);
    color: var(--white);
    padding: 60px 0;
    flex-shrink: 0;
}

.footer .container {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 40px;
    flex-wrap: wrap;
}

.footer-content {
    flex: 2;
}

.footer-content h2 {
    font-size: 36px;
    margin-bottom: 20px;
    line-height: 1.3;
}

.footer-content p {
    font-size: 15px;
    color: #ccc;
    margin-bottom: 30px;
    line-height: 1.7;
}

.footer-content .contact-now {
    display: inline-flex;
    align-items: center;
    text-decoration: none;
    background-color: var(--white);
    color: var(--primary-color);
    padding: 12px 25px;
    border-radius: 5px;
    font-weight: 600;
    transition: background-color 0.3s ease, color 0.3s ease;
    margin-bottom: 20px;
}

.footer-content .contact-now i {
    margin-left: 10px;
}

.social-icons a {
    color: white;
    font-size: 1.5rem;
    margin-right: 15px;
    transition: color 0.3s ease;
}

@media (max-width: 768px) {
    .new-main-header {
        flex-direction: column;
        padding: 15px;
        text-align: center;
    }

    .main-nav {
        flex-direction: column;
        margin-top: 15px;
    }

    .filter-row {
        flex-direction: column;
        align-items: stretch;
    }

    .filter-group {
        width: 100%;
        min-width: unset;
    }
}

.map-container {
    flex: 2;
    min-width: 400px;
    height: 500px;
    background-color: #e0e0e0;
    border-radius: 10px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
    overflow: hidden;
    position: relative;
    display: flex;
    justify-content: center;
    align-items: center;
}

.map-container img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.map-container.no-locations {
    background-color: #f0f4f7;
}

.map-container.no-locations img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 10px;
}
</style>


<!-- Main Content Section -->
<main class="container mx-auto p-4 lg:p-8 flex-1">

    <!-- Page Title and Breadcrumbs -->
    <section class="page-header">
        <div class="container">
            <h1>Our Network</h1>
            <p>Home <i class="fas fa-arrow-right"></i> Our Network</p>
        </div>
    </section>

    <!-- Search/Filter Section -->
    <section class="network-filter-section">
        <div class="container bg-white p-10 rounded-xl shadow-lg">
            <div class="filter-row">
                <!-- Region Dropdown -->
                <div class="filter-group">
                    <label for="region">Select Region</label>
                    <select id="region" name="region">
                        <option value="">-- Select Region --</option>
                        <?php foreach ($data['regions'] as $region): ?>
                        <option value="<?= $region['id'] ?>"><?= $region['name'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- City Dropdown -->
                <div class="filter-group">
                    <label for="city">Select City</label>
                    <select id="city" name="city">
                        <option value="">-- Select City --</option>
                    </select>
                </div>

                <!-- Township Dropdown -->
                <div class="filter-group">
                    <label for="township">Select Township</label>
                    <select id="township" name="township">
                        <option value="">-- Select Township --</option>
                    </select>
                </div>

            </div>
        </div>
    </section>

    <section class="network-content-section">
        <div class="network-info-wrapper">
            <!-- Locations List -->
            <div class="network-locations" id="networkLocations">
                <h2 class="text-xl font-semibold mb-4 text-gray-800">All Locations</h2>
                <?php if (!empty($data['places'])): ?>
                <?php foreach ($data['places'] as $place): ?>
                <div class="location-card">
                    <h3><?= $place['township_name'] ?></h3>
                    <p><?= $place['region_name'] ?></p>
                    <p><?= $place['agent_name'] ?></p>
                    <p><?= $place['agent_phone'] ?></p>
                </div>
                <?php endforeach; ?>
                <?php else: ?>
                <p class="text-gray-500">No locations available.</p>
                <?php endif; ?>
            </div>

            <!-- Map Section -->
            <div class="map-container" id="mapContainer">
                <!-- This will be populated by JavaScript -->
            </div>
        </div>
    </section>

</main>

<!-- Footer -->
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


<script>
document.addEventListener("DOMContentLoaded", function() {
    const regionSelect = document.getElementById("region");
    const citySelect = document.getElementById("city");
    const townshipSelect = document.getElementById("township");
    const networkLocations = document.getElementById("networkLocations");
    const mapContainer = document.getElementById("mapContainer");

    // SVG image data for when no locations are found or selected
    const noLocationsSVG = `
        <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 400 300" preserveAspectRatio="xMidYMid meet" fill="#e0e0e0">
            <rect width="100%" height="100%" fill="#f0f4f7" />
            <g transform="translate(200, 150)">
                <path d="M0,0 C-10,0 -18,-8 -18,-18 C-18,-35 0,-50 0,-50 C0,-50 18,-35 18,-18 C18,-8 10,0 0,0 Z M0,-25 A7,7 0 1 1 0,-25.0001 Z" fill="#ccc"/>
                <circle cx="0" cy="-34" r="22" fill="#e0e0e0" />
                <path d="M22,0 A22,22 0 1 1 -22,0 M-22,-22 L22,22" stroke="#ef4444" stroke-width="6" fill="none" stroke-linecap="round"/>
            </g>
            <text x="50%" y="220" dominant-baseline="middle" text-anchor="middle" font-family="Poppins, sans-serif" font-size="20" fill="#999">No Locations Found</text>
        </svg>
    `;
    const defaultMapImage = "<?= URLROOT ?>/public/images/ournetwork.png";

    const allLocations = <?= json_encode($data['places']); ?>; // all locations from PHP

    // Render locations function
    function renderLocations(locations) {
        if (locations.length > 0) {
            let html = `<h2 class="text-xl font-semibold mb-4 text-gray-800">Available Locations</h2>`;
            locations.forEach(loc => {
                html += `
                    <div class="location-card">
                        <h3>${loc.township_name}</h3>
                        <p>${loc.region_name}</p>
                        <p>${loc.agent_name}</p>
                        <p>${loc.agent_phone}</p>
                    </div>
                `;
            });
            networkLocations.innerHTML = html;
        } else {
            networkLocations.innerHTML = `<p class="text-gray-500">No locations found.</p>`;
        }
    }

    // Function to render the map
    function renderMap(location) {
        if (location && location.latitude && location.longitude) {
            const mapHtml =
                `<iframe width="100%" height="100%" frameborder="0" style="border:0" src="" allowfullscreen></iframe>`;
            mapContainer.innerHTML = mapHtml;
            mapContainer.classList.remove('no-locations');
        } else {
            mapContainer.innerHTML =
                `<img src="${defaultMapImage}" alt="Our Network Map" class="w-full h-full object-cover rounded-lg shadow-md" />`;
            mapContainer.classList.add('no-locations');
        }
    }


    // Initial render → all locations and default map image
    renderLocations(allLocations);
    renderMap(null); // Show default map image

    // Region change → load cities & reset township
    regionSelect.addEventListener("change", function() {
        const regionId = this.value;
        citySelect.innerHTML = '<option value="">-- Select City --</option>';
        townshipSelect.innerHTML = '<option value="">-- Select Township --</option>';

        if (regionId) {
            fetch(`<?= URLROOT ?>/user/getCities?region_id=${regionId}`)
                .then(res => res.json())
                .then(data => {
                    data.forEach(city => {
                        citySelect.innerHTML +=
                            `<option value="${city.id}">${city.name}</option>`;
                    });
                });

            // Filter locations by region and update map
            const filtered = allLocations.filter(loc => loc.region_id == regionId);
            renderLocations(filtered);
            renderMap(filtered.length > 0 ? filtered[0] : null);
        } else {
            renderLocations(allLocations); // reset
            renderMap(null);
        }
    });

    // City change → load townships
    citySelect.addEventListener("change", function() {
        const cityId = this.value;
        townshipSelect.innerHTML = '<option value="">-- Select Township --</option>';

        if (cityId) {
            fetch(`<?= URLROOT ?>/user/getTownships?city_id=${cityId}`)
                .then(res => res.json())
                .then(data => {
                    data.forEach(township => {
                        townshipSelect.innerHTML +=
                            `<option value="${township.id}">${township.name}</option>`;
                    });
                });

            // Filter locations by city and update map
            const filtered = allLocations.filter(loc => loc.city_id == cityId);
            renderLocations(filtered);
            renderMap(filtered.length > 0 ? filtered[0] : null);
        } else {
            // if reset → show all or filter by region
            const regionId = regionSelect.value;
            const filtered = regionId ?
                allLocations.filter(loc => loc.region_id == regionId) :
                allLocations;
            renderLocations(filtered);
            renderMap(filtered.length > 0 ? filtered[0] : null);
        }
    });

    // Township change → filter locations
    townshipSelect.addEventListener("change", function() {
        const townshipId = this.value;

        if (townshipId) {
            const filtered = allLocations.filter(loc => loc.township_id == townshipId);
            renderLocations(filtered);
            renderMap(filtered.length > 0 ? filtered[0] : null);
        } else {
            // if reset → filter by city or region
            const cityId = citySelect.value;
            const regionId = regionSelect.value;

            let filtered = allLocations;
            if (cityId) filtered = filtered.filter(loc => loc.city_id == cityId);
            else if (regionId) filtered = filtered.filter(loc => loc.region_id == regionId);

            renderLocations(filtered);
            renderMap(filtered.length > 0 ? filtered[0] : null);
        }
    });
});
</script>



</body>

</html>