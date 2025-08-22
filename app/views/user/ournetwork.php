<?php require_once APPROOT . '/views/inc/nav.php' ?>

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
                <!-- Country Dropdown -->
                <div class="filter-group">
                    <label for="country">Country</label>
                    <select id="country">
                        <option value="Myanmar" selected>Myanmar</option>
                        <option value="Thailand">Thailand</option>
                        <option value="Singapore">Singapore</option>
                    </select>
                </div>
                <!-- Region Dropdown -->
                <div class="filter-group">
                    <label for="region">Select Region</label>
                    <select id="region">
                        <option>Mandalay</option>
                    </select>
                </div>
                <!-- Township/City Dropdown -->
                <div class="filter-group">
                    <label for="township">Select Township/City</label>
                    <select id="township">
                        <option>Meiktila</option>
                    </select>
                </div>
            </div>
        </div>
    </section>

    <section class="network-content-section">
        <div class="container network-info-wrapper">
            <!-- Left Column: Address List -->
            <div class="network-locations" id="networkLocations">
                <h2 class="text-xl font-semibold mb-4 text-gray-800">Bahan Township</h2>

                <!-- Address Card -->
                <div class="location-card">
                    <h3>Bahan Township</h3>
                    <p>No(116)/U Chit Maung Road/Bahan Township</p>
                    <p>Yangon Region</p>
                    <p>09789123456</p>
                </div>

                <!-- Address Card -->
                <div class="location-card">
                    <h3>Bahan Township</h3>
                    <p>No(116)/U Chit Maung Road/Bahan Township</p>
                    <p>Yangon Region</p>
                    <p>09789123456</p>
                </div>

                <!-- Address Card -->
                <div class="location-card">
                    <h3>Bahan Township</h3>
                    <p>No(116)/U Chit Maung Road/Bahan Township</p>
                    <p>Yangon Region</p>
                    <p>09789123456</p>
                </div>
            </div>

            <!-- Right Column: Map Placeholder -->
            <div class="network-map-placeholder">
                <div class="map-overlay">
                    <i class="fas fa-map-marker-alt"></i>
                    <p>Explore Nearby Places</p>
                </div>
            </div>
        </div>
    </section>

</main>

<!-- Footer -->
<footer class="footer">
    <div class="container">
        <!-- Left Section: Text Content -->
        <div class="footer-content">
            <h2>Fast, Affordable, And Always On Time.</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Egestas semper at integer a quis eget. Diam
                neque, massa pellentesque pellentesque leo.</p>

            <!-- Action Button and Socials -->
            <a href="#" class="contact-now">
                <span>Contact Now</span>
                <i class="fas fa-arrow-right"></i>
            </a>
            <div class="social-icons">
                <!-- Twitter Icon -->
                <a href="#"><i class="fab fa-twitter"></i></a>
                <!-- Instagram Icon -->
                <a href="#"><i class="fab fa-instagram"></i></a>
                <!-- Facebook Icon -->
                <a href="#"><i class="fab fa-facebook-f"></i></a>
            </div>
        </div>
    </div>
</footer>

</body>

</html>