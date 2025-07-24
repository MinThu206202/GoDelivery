<?php
session_start();
require_once APPROOT . '/views/inc/sidebar.php';
$name = $_SESSION['user'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Create Route</title>
    <link rel="stylesheet" href="<?= URLROOT; ?>/public/deliverycss/admin/addroute.css">
    <style>
        /* Your CSS styles here, unchanged */
        .route-form-container {
            max-width: 500px;
            margin: 30px auto;
            padding: 20px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            font-family: 'Poppins', sans-serif;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 6px;
            font-weight: 600;
            color: #1F265B;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 15px;
        }

        .form-actions {
            display: flex;
            justify-content: space-between;
            gap: 20px;
            margin-top: 20px;
        }

        .modal-button-primary {
            background-color: #1F265B;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 600;
        }

        .modal-button-primary:hover {
            background-color: #151b40;
        }

        #notificationOverlay {
            display: none;
            position: fixed;
            inset: 0;
            background-color: rgba(0, 0, 0, 0.6);
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }

        #notificationOverlay.show {
            display: flex;
        }

        #notificationBox {
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            width: 400px;
            max-width: 90%;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        }

        .notification-title {
            font-size: 20px;
            margin-bottom: 15px;
            color: #1F265B;
            font-weight: 600;
        }

        .success-toast {
            position: fixed;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            background: #28a745;
            color: white;
            padding: 12px 20px;
            border-radius: 6px;
            font-size: 16px;
            z-index: 1001;
            animation: fadeInOut 3s forwards;
        }

        .hidden {
            display: none;
        }

        @keyframes fadeInOut {
            0% {
                opacity: 0;
                transform: translateX(-50%) translateY(-20px);
            }

            10%,
            90% {
                opacity: 1;
                transform: translateX(-50%) translateY(0);
            }

            100% {
                opacity: 0;
                transform: translateX(-50%) translateY(-20px);
            }
        }
    </style>
</head>

<body>

    <main class="main-content">
        <header class="dashboard-header">
            <div class="header-left">
                <h2 class="page-title">Create New Route</h2>
            </div>
            <div class="header-right">
                <div class="admin-profile">
                    <div class="profile-icon"><i class="fas fa-user-circle"></i></div>
                    <span><?= htmlspecialchars($name['name']) ?></span>
                </div>
            </div>
        </header>

        <div class="route-form-container">
            <div class="panel-header-with-button">
                <h3>Add Route</h3>
            </div>
            <form id="routeForm" action="<?= URLROOT; ?>/routepage/createroute" method="POST" onsubmit="return validateForm(event)">
                <!-- From Region -->
                <div class="form-group">
                    <label for="fromRegion">From Region</label>
                    <select id="fromRegion" name="fromRegion" onchange="loadCities(this.value, 'fromCity')" required>
                        <option value="">-- Select From Region --</option>
                        <?php foreach ($data['regions'] as $region): ?>
                            <option value="<?= htmlspecialchars($region['id']) ?>"><?= htmlspecialchars($region['name']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- From City -->
                <div class="form-group">
                    <label for="fromCity">From City</label>
                    <select id="fromCity" name="fromCity" required>
                        <option value="">-- Select From City --</option>
                    </select>
                </div>

                <!-- To Region -->
                <div class="form-group">
                    <label for="toRegion">To Region</label>
                    <select id="toRegion" name="toRegion" onchange="loadCities(this.value, 'toCity')" required>
                        <option value="">-- Select To Region --</option>
                        <?php foreach ($data['regions'] as $region): ?>
                            <option value="<?= htmlspecialchars($region['id']) ?>"><?= htmlspecialchars($region['name']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- To City -->
                <div class="form-group">
                    <label for="toCity">To City</label>
                    <select id="toCity" name="toCity" required>
                        <option value="">-- Select To City --</option>
                    </select>
                </div>

                <!-- Distance -->
                <div class="form-group">
                    <label for="distance">Distance (km)</label>
                    <input type="number" id="distance" name="distance" placeholder="Enter Distance" required>
                </div>

                <!-- Price -->
                <div class="form-group">
                    <label for="price">Price (MMK)</label>
                    <input type="number" id="price" name="price" placeholder="Enter Price" required>
                </div>

                <div class="form-actions">
                    <button type="submit" class="modal-button-primary">Create Route</button>
                    <button type="button" class="modal-button-primary" onclick="history.back()">Cancel</button>
                </div>
            </form>
        </div>

        <!-- ✅ Toast -->
        <div id="successToast" class="success-toast hidden">
            ✅ Route successfully created!
        </div>
    </main>

    <!-- ❗ Notification Modal -->
    <div id="notificationOverlay">
        <div id="notificationBox">
            <h2 class="notification-title">Notification</h2>
            <div class="notification-content">
                <p id="notificationMessage"></p>
            </div>
            <div class="notification-footer">
                <button onclick="closeNotificationBox()" class="modal-button-primary">OK</button>
            </div>
        </div>
    </div>

    <script>
        function validateForm(event) {
            event.preventDefault();

            const fromCity = document.getElementById("fromCity").value.trim();
            const toCity = document.getElementById("toCity").value.trim();
            const distance = document.getElementById("distance").value.trim();
            const price = document.getElementById("price").value.trim();

            if (!fromCity || !toCity || !distance || !price) {
                showNotificationBox("All fields are required. Please complete the form.");
                return false;
            }

            if (fromCity === toCity) {
                showNotificationBox("From City and To City cannot be the same.");
                return false;
            }

            document.getElementById("routeForm").submit();
            return true;
        }

        function showNotificationBox(message) {
            document.getElementById("notificationMessage").textContent = message;
            document.getElementById("notificationOverlay").classList.add("show");
        }

        function closeNotificationBox() {
            document.getElementById("notificationOverlay").classList.remove("show");
        }

        function loadCities(regionId, targetId) {
            if (!regionId) return;

            fetch(`<?= URLROOT ?>/routepage/getCities?region_id=${regionId}`)
                .then(response => response.json())
                .then(cities => {
                    const citySelect = document.getElementById(targetId);
                    citySelect.innerHTML = '<option value="">-- Select City --</option>';
                    cities.forEach(city => {
                        const option = document.createElement('option');
                        option.value = city.name;
                        option.textContent = city.name;
                        citySelect.appendChild(option);
                    });
                })
                .catch(error => console.error("Error loading cities:", error));
        }

        window.onload = function() {
            const urlParams = new URLSearchParams(window.location.search);
            const isSuccess = urlParams.get('success');

            if (isSuccess === '1') {
                // Show toast notification
                const toast = document.getElementById('successToast');
                toast.classList.remove('hidden');

                // Also show alert if you want
                alert("✅ Route successfully created!");

                // Hide toast after 3 seconds
                setTimeout(() => {
                    toast.classList.add('hidden');

                    // Optional: Remove the query parameter from URL without reloading
                    window.history.replaceState({}, document.title, window.location.pathname);
                }, 3000);
            }
        };
    </script>
</body>

</html>