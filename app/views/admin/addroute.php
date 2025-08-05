<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start(); // ✅ Must be before any HTML output
require_once APPROOT . '/views/inc/sidebar.php';

$name = isset($_SESSION['user']) ? $_SESSION['user'] : ['name' => 'Admin', 'id' => '1']; // fallback name with ID

// This data is for the initial load of regions. Cities and townships will be fetched via AJAX.
// For demonstration, let's include some dummy data if $data['regions'] is not set by the PHP backend
if (!isset($data['regions'])) {
    $data['regions'] = [
        ['id' => 1, 'name' => 'Yangon Region'],
        ['id' => 2, 'name' => 'Mandalay Region'],
        ['id' => 3, 'name' => 'Naypyidaw Union Territory'],
        ['id' => 4, 'name' => 'Sagaing Region'],
    ];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="<?php echo URLROOT; ?>/vendor/bootstrap/css/bootstrap.min.css">
    <title>Create Route</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Apply Inter font globally and ensure basic styling */
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f3f4f6;
            /* Light gray background */
        }

        /* Form container styles */
        .route-form-container {
            max-width: 900px;
            /* Increased max-width to accommodate two columns comfortably */
            margin: 20px auto;
            /* Decreased top/bottom margin */
            padding: 25px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            margin-bottom: 12px;
            /* Decreased margin-bottom */
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #1F265B;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 10px 12px;
            /* Decreased padding */
            border: 1px solid #d1d5db;
            border-radius: 8px;
            font-size: 16px;
            box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.05);
        }

        .form-group input:focus,
        .form-group select:focus {
            border-color: #3b82f6;
            outline: none;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.25);
        }

        .section-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: #1F265B;
            margin-bottom: 15px;
            /* Decreased margin-bottom */
            padding-bottom: 10px;
            border-bottom: 1px solid #e5e7eb;
        }

        .form-actions {
            display: flex;
            justify-content: flex-end;
            gap: 15px;
            margin-top: 30px;
        }

        .modal-button-primary {
            background-color: #1F265B;
            color: white;
            border: none;
            padding: 12px 25px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 15px;
            font-weight: 600;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .modal-button-primary:hover {
            background-color: #151b40;
            transform: translateY(-2px);
        }

        .modal-button-secondary {
            background-color: #6b7280;
            color: white;
            border: none;
            padding: 12px 25px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 15px;
            font-weight: 600;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .modal-button-secondary:hover {
            background-color: #4b5563;
            transform: translateY(-2px);
        }

        /* Centered Notification Modal Styles */
        #notificationOverlay {
            position: fixed;
            inset: 0;
            background-color: rgba(0, 0, 0, 0.6);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 2000;
        }

        #notificationOverlay.hidden {
            display: none;
        }

        #notificationBox {
            background: white;
            padding: 25px 30px;
            border-radius: 12px;
            max-width: 400px;
            width: 90%;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.3);
            text-align: center;
        }

        .notification-title {
            color: #1F265B;
            margin-bottom: 15px;
            font-weight: 700;
            font-size: 22px;
        }

        /* Basic header styling for better appearance */
        .dashboard-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 30px;
            background-color: #ffffff;
            border-bottom: 1px solid #e5e7eb;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        .page-title {
            font-size: 1.8rem;
            font-weight: 700;
            color: #1F265B;
        }

        .admin-profile {
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: 500;
            color: #4b5563;
        }

        .profile-icon {
            font-size: 1.5rem;
            color: #3b82f6;
        }
    </style>
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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
                <h3>Define Route</h3>
            </div>
            <form id="routeForm" action="<?= URLROOT; ?>/routepage/createRoute" method="POST" onsubmit="return validateForm(event)">
                <!-- Two-column layout for From and To Locations -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8">
                    <!-- From Location Section -->
                    <div>
                        <h4 class="section-title">From Location</h4>
                        <div class="form-group">
                            <label for="fromRegion">Region</label>
                            <select id="fromRegion" name="from_region_id" class="form-select rounded-md" onchange="loadCities(this.value, 'fromCity', 'fromTownship')">
                                <option value="">-- Select Region --</option>
                                <?php foreach ($data['regions'] as $region): ?>
                                    <option value="<?= htmlspecialchars($region['id']) ?>"><?= htmlspecialchars($region['name']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="fromCity">City</label>
                            <select id="fromCity" name="from_city_id" class="form-select rounded-md" onchange="loadTownships(this.value, 'fromTownship')">
                                <option value="">-- Select City --</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="fromTownship">From Township</label>
                            <select id="fromTownship" name="from_township_id" class="form-select rounded-md">
                                <option value="">-- Select Township --</option>
                            </select>
                        </div>
                    </div>

                    <!-- To Location Section -->
                    <div>
                        <h4 class="section-title md:mt-0 mt-8">To Location</h4> <!-- Adjust margin for mobile -->
                        <div class="form-group">
                            <label for="toRegion">Region</label>
                            <select id="toRegion" name="to_region_id" class="form-select rounded-md" onchange="loadCities(this.value, 'toCity', 'toTownship')">
                                <option value="">-- Select Region --</option>
                                <?php foreach ($data['regions'] as $region): ?>
                                    <option value="<?= htmlspecialchars($region['id']) ?>"><?= htmlspecialchars($region['name']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="toCity">City</label>
                            <select id="toCity" name="to_city_id" class="form-select rounded-md" onchange="loadTownships(this.value, 'toTownship')">
                                <option value="">-- Select City --</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="toTownship">To Township</label>
                            <select id="toTownship" name="to_township_id" class="form-select rounded-md">
                                <option value="">-- Select Township --</option>
                            </select>
                        </div>
                    </div>
                </div>


                <!-- Route Details (can remain single column or be part of the grid) -->
                <h4 class="section-title mt-8">Route Details</h4>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8">
                    <div class="form-group">
                        <label for="distance">Distance (km)</label>
                        <input type="number" id="distance" name="distance" placeholder="Enter distance in km">
                    </div>

                    <div class="form-group">
                        <label for="time">Estimated Time (hours)</label>
                        <input type="number" id="time" name="time" placeholder="Enter estimated time in hours">
                    </div>
                </div>


                <input type="hidden" name="user_id" value="<?= htmlspecialchars($name['id']) ?>">
                <?php require APPROOT . '/views/components/auth_message.php'; ?>


                <div class="form-actions">
                    <button type="button" class="modal-button-secondary" onclick="history.back()">Cancel</button>
                    <button type="submit" class="modal-button-primary">Create Route</button>
                </div>
            </form>
        </div>
    </main>

    <!-- Notification Modal -->
    <div id="notificationOverlay" class="hidden">
        <div id="notificationBox">
            <h2 class="notification-title">Success</h2>
            <p id="notificationMessage">✅ Route successfully created!</p>
            <button onclick="closeNotificationAndGoToRoute()" class="modal-button-primary">OK</button>
        </div>
    </div>

    <script>
        // Function to show a custom notification modal
        function showNotification(message, isSuccess = true) {
            const notificationOverlay = document.getElementById('notificationOverlay');
            const notificationTitle = document.querySelector('#notificationBox .notification-title');
            const notificationMessage = document.getElementById('notificationMessage');

            notificationTitle.textContent = isSuccess ? 'Success' : 'Error';
            notificationMessage.textContent = isSuccess ? `✅ ${message}` : `❌ ${message}`;
            notificationOverlay.classList.remove('hidden');
        }

        function closeNotificationAndGoToRoute() {
            document.getElementById('notificationOverlay').classList.add('hidden');
            // This assumes your PHP backend redirects after successful route creation.
            // If not, you might want to redirect here, e.g., window.location.href = '<?= URLROOT ?>/admin/route';
        }

        // Function to load cities into a target select element
        function loadCities(regionId, targetCitySelectId, targetTownshipSelectId) {
            const citySelect = document.getElementById(targetCitySelectId);
            const townshipSelect = document.getElementById(targetTownshipSelectId);

            // Clear previous options for both city and township
            citySelect.innerHTML = '<option value="">-- Select City --</option>';
            townshipSelect.innerHTML = '<option value="">-- Select Township --</option>';

            if (!regionId) {
                return;
            }

            // Real application: Fetch cities from backend
            fetch(`<?= URLROOT ?>/routepage/getCities?region_id=${regionId}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(cities => {
                    cities.forEach(city => {
                        const option = document.createElement('option');
                        option.value = city.id; // Use city ID for backend processing
                        option.textContent = city.name;
                        citySelect.appendChild(option);
                    });
                })
                .catch(error => {
                    console.error("Error loading cities:", error);
                    showNotification("Failed to load cities. Please try again.", false);
                });
        }

        // Function to load townships into a target select element
        function loadTownships(cityId, targetTownshipSelectId) {
            const townshipSelect = document.getElementById(targetTownshipSelectId);

            // Clear previous options
            townshipSelect.innerHTML = '<option value="">-- Select Township --</option>';

            if (!cityId) {
                return;
            }

            // Real application: Fetch townships from backend
            fetch(`<?= URLROOT ?>/routepage/getTownships?city_id=${cityId}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(townships => {
                    townships.forEach(township => {
                        const option = document.createElement('option');
                        option.value = township.id; // Use township ID for backend processing
                        option.textContent = township.name;
                        townshipSelect.appendChild(option);
                    });
                })
                .catch(error => {
                    console.error("Error loading townships:", error);
                    showNotification("Failed to load townships. Please try again.", false);
                });
        }

        function validateForm(event) {
            event.preventDefault(); // Prevent default form submission

            const fromRegion = document.getElementById("fromRegion").value;
            const fromCity = document.getElementById("fromCity").value;
            const fromTownship = document.getElementById("fromTownship").value;
            const toRegion = document.getElementById("toRegion").value;
            const toCity = document.getElementById("toCity").value;
            const toTownship = document.getElementById("toTownship").value;
            const distance = document.getElementById("distance").value.trim();
            const time = document.getElementById("time").value.trim();

            if (!fromRegion || !fromCity || !fromTownship || !toRegion || !toCity || !toTownship || !distance || !time) {
                showNotification("All fields are required. Please complete the form.", false);
                return false;
            }

            // Check if 'From' and 'To' locations are identical
            if (fromTownship === toTownship && fromCity === toCity && fromRegion === toRegion) {
                showNotification("From and To locations cannot be the same.", false);
                return false;
            }

            if (parseFloat(distance) <= 0) {
                showNotification("Distance must be a positive number.", false);
                return false;
            }

            if (parseFloat(time) <= 0) {
                showNotification("Estimated Time must be a positive number.", false);
                return false;
            }

            // If validation passes, submit the form
            document.getElementById("routeForm").submit();
            return true;
        }

        window.addEventListener('DOMContentLoaded', () => {
            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.get('success') === '1') {
                showNotification("Route successfully created!", true);
                window.history.replaceState({}, document.title, window.location.pathname); // Clean URL
            } else if (urlParams.get('error')) {
                showNotification(urlParams.get('error'), false);
                window.history.replaceState({}, document.title, window.location.pathname); // Clean URL
            }
        });
    </script>
</body>

</html>