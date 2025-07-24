<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

?>
<?php require_once APPROOT . '/views/inc/sidebar.php'; ?>

<main class="main-content">
    <header class="dashboard-header">
        <!-- Restructured header to allow flexible centering -->
        <h2 class="page-title">Agent</h2>
        <form method="POST" action="<?php echo URLROOT; ?>/admincontroller/search">
            <div class="search-bar">
                <input type="text" name="tracking_code" id="searchInput" placeholder="Enter Customer WayBill Number">
                <button id="searchButton"><i class="fas fa-search"></i></button>
            </div>
        </form>
        <div class="admin-profile">
            <div class="profile-icon"><i class="fas fa-user-circle"></i></div>
            <span><?= htmlspecialchars($_SESSION['user']['name']) ?></span>
        </div>
    </header>

    <section class="summary-cards">
        <div class="card">
            <p class="card-title">Total Deliveries</p>
            <p class="card-value">100</p>
        </div>
        <div class="card">
            <p class="card-title">Completed Deliveries</p>
            <p class="card-value">50</p>
        </div>
        <div class="card">
            <p class="card-title">Pending Delivery</p>
            <p class="card-value">20</p>
        </div>
        <div class="card">
            <p class="card-title">Total Agent</p>
            <p class="card-value">75</p>
        </div>
    </section>

    <section class="recent-deliveries-process panel">
        <h3>Delivery List</h3>
        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>Tracking Code</th>
                        <th>From</th>
                        <th>To</th>
                        <th>Date & Time</th>
                        <th>Amount</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <?php foreach ($data['allDeliveryData'] as $user): ?>
                    <tbody>
                        <tr>

                            <td><?= htmlspecialchars($user['tracking_code']); ?></td>
                            <td><?= htmlspecialchars($user['from_region_name']); ?></td>
                            <td><?= htmlspecialchars($user['to_region_name']); ?></td>
                            <td><?= htmlspecialchars($user['created_at']); ?></td>
                            <td><?= htmlspecialchars($user['total_amount']); ?></td>
                            <td><?= htmlspecialchars($user['delivery_status_name']); ?></td>

                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                    </tbody>
            </table>
        </div>
    </section>

    <section class="agent-panel panel">
        <h3>Agent</h3>
        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>Agent Code</th>
                        <th>Agent Name</th>
                        <th>City</th>
                        <th>Address</th>
                        <th>Created Date</th>
                    </tr>
                </thead>
                <?php foreach ($data['allUserData'] as $user): ?>
                    <tbody>
                        <tr>
                            <td>Code</td>
                            <td><?= htmlspecialchars($user['name']); ?></td>
                            <td><?= htmlspecialchars($user['city_name']); ?></td>
                            <td><?= htmlspecialchars($user['address']); ?></td>
                            <td><?= htmlspecialchars($user['created_at']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
            </table>
        </div>
    </section>
</main>
</div>

<!-- Custom Alert Box -->
<div class="custom-alert-overlay" id="customAlertOverlay">
    <div class="custom-alert-box">
        <h4>Notification</h4>
        <p id="customAlertMessage"></p>
        <button id="customAlertCloseButton">OK</button>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const searchInput = document.getElementById('searchInput');
        const searchButton = document.getElementById('searchButton');
        const customAlertOverlay = document.getElementById('customAlertOverlay');
        const customAlertMessage = document.getElementById('customAlertMessage');
        const customAlertCloseButton = document.getElementById('customAlertCloseButton');

        /**
         * Shows the custom alert box with a given message.
         * @param {string} message - The message to display in the alert box.
         */
        function showAlert(message) {
            customAlertMessage.textContent = message;
            customAlertOverlay.style.display = 'flex';
        }

        /**
         * Hides the custom alert box.
         */
        function hideAlert() {
            customAlertOverlay.style.display = 'none';
        }

        // Event listener for the search button
        searchButton.addEventListener('click', () => {
            const searchTerm = searchInput.value.trim();
            if (searchTerm === '') {
                showAlert("Please enter a tracking code to search.");
            } else {
                // Redirect to delivery_details.html with the search term as a URL parameter
                window.location.href = `../html/search.html?trackingCode=${encodeURIComponent(searchTerm)}`;
            }
        });

        // Event listener for the custom alert close button
        customAlertCloseButton.addEventListener('click', hideAlert);

        // Event listener to close alert when clicking outside the box
        customAlertOverlay.addEventListener('click', (event) => {
            if (event.target === customAlertOverlay) {
                hideAlert();
            }
        });
    });
</script>
</body>

</html>