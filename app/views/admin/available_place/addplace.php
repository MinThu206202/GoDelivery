<?php
session_start(); // Start session before any output
require_once APPROOT . '/views/inc/sidebar.php';

$name = isset($_SESSION['user']) ? $_SESSION['user'] : ['name' => 'Admin', 'id' => 0];

// Dummy data for regions if not provided by backend
if (!isset($data['regions'])) {
    $data['regions'] = [
        ['id' => 1, 'name' => 'Yangon'],
        ['id' => 2, 'name' => 'Mandalay'],
    ];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create New Places</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Apply Inter font globally and ensure basic styling */
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f3f4f6;
            /* Light gray background */
        }

        .route-form-container {
            max-width: 500px;
            margin: 30px auto;
            padding: 25px;
            /* Increased padding slightly */
            background: white;
            border-radius: 12px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            /* Adjusted margin */
            font-weight: 600;
            color: #1F265B;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #d1d5db;
            /* Lighter border */
            border-radius: 8px;
            /* More rounded */
            font-size: 16px;
            /* Larger font size */
            box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.05);
            /* Subtle inner shadow */
        }

        .form-group input:focus,
        .form-group select:focus {
            border-color: #3b82f6;
            /* Blue focus ring */
            outline: none;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.25);
        }

        .form-actions {
            display: flex;
            justify-content: flex-end;
            /* Align buttons to the right */
            gap: 15px;
            /* Adjusted gap */
            margin-top: 30px;
            /* Increased margin */
        }

        .modal-button-primary {
            background-color: #1F265B;
            color: white;
            border: none;
            padding: 12px 25px;
            /* Larger buttons */
            border-radius: 8px;
            cursor: pointer;
            font-size: 15px;
            font-weight: 600;
            transition: background-color 0.3s ease, transform 0.2s ease;
            /* Smooth transitions */
        }

        .modal-button-primary:hover {
            background-color: #151b40;
            transform: translateY(-2px);
            /* Slight lift on hover */
        }

        .modal-button-secondary {
            background-color: #6b7280;
            /* Gray for secondary button */
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
                <h2 class="page-title">Create New Places</h2>
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
                <h3>Add Place</h3>
            </div>
            <form id="placeForm" action="<?= URLROOT; ?>/availablecontroller/addplace" method="POST" onsubmit="return validateForm(event)">
                <div class="form-group">
                    <label for="region">Region</label>
                    <select id="region" name="region" class="form-select rounded-md">
                        <option value="">-- Select Region --</option>
                        <?php foreach ($data['regions'] as $region): ?>
                            <option value="<?= htmlspecialchars($region['id']) ?>"><?= htmlspecialchars($region['name']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="city">City</label>
                    <input id="city" type="text" name="city" placeholder="Enter City" class="form-input rounded-md">
                </div>

                <div class="form-group">
                    <label for="township">Township</label>
                    <input id="township" type="text" name="township" placeholder="Enter Township" class="form-input rounded-md">
                </div>

                <input type="hidden" name="user_id" value="<?= htmlspecialchars($name['id']) ?>">

                <div class="form-actions">
                    <button type="button" class="modal-button-secondary" onclick="history.back()">Cancel</button>
                    <button type="submit" class="modal-button-primary">Create Place</button>
                </div>
            </form>
        </div>
    </main>

    <!-- Notification Modal -->
    <div id="notificationOverlay" class="hidden">
        <div id="notificationBox">
            <h2 class="notification-title">Success</h2>
            <p id="notificationMessage">✅ Place successfully created!</p>
            <button onclick="closeNotificationAndGoToPlace()" class="modal-button-primary">OK</button>
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

        // Function to close notification and redirect to the available places page
        function closeNotificationAndGoToPlace() {
            document.getElementById('notificationOverlay').classList.add('hidden');
            // Redirect to the page where available places are listed
            window.location.href = '<?= URLROOT ?>/available_place/available';
        }

        function validateForm(event) {
            // Prevent default form submission initially
            event.preventDefault();

            const city = document.getElementById("city").value.trim();
            const township = document.getElementById("township").value.trim();
            const region = document.getElementById("region").value.trim();

            if (!city || !township || !region) {
                showNotification("All fields are required. Please complete the form.", false);
                return false;
            }

            // If validation passes, submit the form
            document.getElementById("placeForm").submit();
            return true;
        }

        // Check URL parameters on page load for success or error messages
        window.addEventListener('DOMContentLoaded', () => {
            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.get('success') === '1') {
                showNotification("Place successfully created!", true);
                // Clean the URL to remove the success parameter after showing the notification
                window.history.replaceState({}, document.title, window.location.pathname);
            } else if (urlParams.get('error')) {
                // You can also pass an error message from the backend if needed
                showNotification(urlParams.get('error'), false);
                window.history.replaceState({}, document.title, window.location.pathname);
            }
        });
    </script>
</body>

</html>