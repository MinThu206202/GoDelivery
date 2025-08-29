<?php require_once APPROOT . '/views/inc/sidebar.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>/public/deliverycss/admin/deliveryhistory.css">

<style>
.bg-green {
    background-color: #d4edda;
    color: #155724;
    padding: 4px 8px;
    border-radius: 4px;
    display: inline-block;
    font-weight: bold;
}

.bg-red {
    background-color: #ffcc80;
    /* changed to amber/orange */
    color: #7a4f01;
    /* dark amber */
    padding: 4px 8px;
    border-radius: 4px;
    display: inline-block;
    font-weight: bold;
}

.bg-yellow {
    background-color: #fff3cd;
    color: #856404;
    padding: 4px 8px;
    border-radius: 4px;
    display: inline-block;
    font-weight: bold;
}

.bg-gray {
    background-color: #e2e3e5;
    color: #383d41;
    padding: 4px 8px;
    border-radius: 4px;
    display: inline-block;
    font-weight: bold;
}

/* Cancelled stays the same */
.bg-cancelled {
    background-color: #f5c6cb;
    color: #721c24;
    padding: 4px 8px;
    border-radius: 4px;
    display: inline-block;
    font-weight: bold;
}

.bg-returned {
    background-color: #cce5ff;
    color: #004085;
    padding: 4px 8px;
    border-radius: 4px;
    display: inline-block;
    font-weight: bold;
}

.view-button {
    background-color: #28a745;
    /* Bootstrap green */
    color: white;
    border: none;
    padding: 6px 12px;
    border-radius: 4px;
    font-size: 14px;
    cursor: pointer;
    transition: background-color 0.2s ease;
}

.view-button:hover {
    background-color: #218838;
}

/* Modal Overlay Background */
.modal-overlay {
    display: none;
    position: fixed;
    z-index: 999;
    top: 0;
    left: 0;
    height: 100vh;
    width: 100vw;
    background-color: rgba(0, 0, 0, 0.7);
    /* Slightly darker overlay */
    justify-content: center;
    /* Center horizontally */
    align-items: center;
    /* Center vertically */
}

/* Centered Modal Box */
.modal-box {
    background: #ffffff;
    border-radius: 12px;
    /* More prominent rounded corners */
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.25);
    /* Stronger shadow */
    min-width: 350px;
    /* Slightly wider */
    max-width: 90%;
    overflow: hidden;
    /* Ensures rounded corners apply to children */
    display: flex;
    /* Use flexbox for internal layout */
    flex-direction: column;
    /* Stack header, body, footer vertically */
}

.modal-header {
    background-color: rgb(255, 255, 255);
    /* Dark blue from image */
    color: #1F265B;
    padding: 15px 20px;
    font-size: 1.2em;
    font-weight: bold;
    border-top-left-radius: 12px;
    /* Match parent */
    border-top-right-radius: 12px;
    /* Match parent */
    position: relative;
    text-align: center;
    /* Center the title */
}

.modal-header h3 {
    margin: 0;
    /* Remove default margin from h3 */
    color: #1F265B;
    /* Ensure title color is white */
}

.modal-body {
    padding: 30px 25px;
    /* More padding for the message */
    text-align: center;
    color: #333;
    /* Darker text for message */
    font-size: 1.1em;
    line-height: 1.5;
}

.modal-footer {
    padding: 15px 20px;
    background-color: #f0f0f0;
    /* Light gray footer background */
    text-align: center;
    border-bottom-left-radius: 12px;
    border-bottom-right-radius: 12px;
}

.modal-ok-button {
    background-color: #1F265B;
    /* Dark blue from image */
    color: white;
    border: none;
    padding: 12px 30px;
    /* Larger padding for button */
    border-radius: 8px;
    /* Rounded button */
    font-size: 1.1em;
    cursor: pointer;
    transition: background-color 0.3s ease;
    font-weight: bold;
}

.modal-ok-button:hover {
    background-color: #34495e;
    /* Slightly lighter on hover */
}

/* Close Button Style - move inside header for better positioning */
.close-btn {
    position: absolute;
    top: 10px;
    /* Adjust as needed */
    right: 15px;
    /* Adjust as needed */
    font-size: 28px;
    /* Larger 'x' */
    color: white;
    /* White 'x' on dark background */
    cursor: pointer;
    line-height: 1;
    /* Ensure it's vertically centered */
}

/* New styles for the Back button */
.back-button {
    background-color: #1F265B;
    /* A neutral gray for the back button */
    color: white;
    border: none;
    padding: 8px 15px;
    border-radius: 14px;
    font-size: 14px;
    cursor: pointer;
    transition: background-color 0.2s ease;
    display: flex;
    /* Use flex to align icon and text */
    align-items: center;
    gap: 5px;
    /* Space between icon and text */
}

.back-button:hover {
    background-color: #5a6268;
}
</style>

<main class="main-content">
    <header class="dashboard-header">
        <div class="header-left">
            <h2 class="page-title">Agent</h2>
        </div>

        <div class="filter-options">
            <div class="filter-item pill-button" id="fromDateFilterPill">
                <label for="fromDateFilter">From Date:</label>
                <input type="date" id="fromDateFilter" title="From Date">
                <i class="fas fa-calendar-alt dropdown-icon"></i>
            </div>
            <div class="filter-item pill-button" id="toDateFilterPill">
                <label for="toDateFilter">To Date:</label>
                <input type="date" id="toDateFilter" title="To Date">
                <i class="fas fa-calendar-alt dropdown-icon"></i>
            </div>

            <div class="filter-item search-bar">
                <input type="text" id="searchInput" placeholder="Search">
                <button type="submit" id="searchButton"><i class="fas fa-search"></i></button>
            </div>
        </div>

        <div class="header-right">
            <div class="admin-profile">
                <div class="profile-icon"><i class="fas fa-user-circle"></i></div>
                <span><?= htmlspecialchars($_SESSION['user']['name']) ?></span>
            </div>
        </div>
    </header>
    <div class="manage-delivery-section">
        <div class="status-filter-buttons">
            <a href="#" class="filter-button active" id="allDeliveriesButton">All Deliveries</a>
            <a href="#" class="filter-button" id="deliveredButton">Delivered</a>
            <a href="#" class="filter-button" id="inTransitButton">In Transit</a>
            <a href="#" class="filter-button" id="pendingButton">Pending</a>
            <a href="#" class="filter-button" id="cancelledButton">Cancelled</a>
            <a href="#" class="filter-button" id="returnedButton">Returned</a>
        </div>

        <div class="section-header">
            <h3 id="tableHeaderTitle">All Deliveries</h3>
            <!-- Back to All Deliveries Button -->
            <button id="backToAllDeliveriesButton" class="filter-item back-button" style="display: none;">
                <i class="fas fa-arrow-left"></i> <span>Back to All Deliveries</span>
            </button>
            <div class="filter-item reset-button" id="resetButton">
                <i class="fas fa-sync-alt"></i> <span>Reset</span>
            </div>
        </div>

        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>Tracking ID</th>
                        <th>Customer Info</th>
                        <th>Agent</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th>Paid/Prepaid</th>
                        <th>View</th>
                    </tr>
                </thead>
                <tbody id="deliveryTableBody">
                    <?php foreach ($data['alldeliverydata'] as $agent): ?>
                    <?php
                        $statusName = $agent['delivery_status'];
                        $statusClass = 'bg-gray';

                        // Normalize status to lowercase for data-status attribute & filtering
                        $statusLower = strtolower($statusName);

                        if ($statusName === 'Delivered') {
                            $statusClass = 'bg-green';
                        } elseif ($statusName === 'In Transit') {
                            $statusClass = 'bg-yellow';
                        } elseif ($statusName === 'Pending') {
                            $statusClass = 'bg-red';
                        } elseif ($statusName === 'Failed Delivery') {
                            $statusClass = 'bg-gray';
                        } elseif ($statusName === 'Cancelled') {
                            $statusClass = 'bg-cancelled';
                        } elseif ($statusName === 'Returned') {
                            $statusClass = 'bg-returned';
                        }
                        ?>
                    <tr class="delivery-row" data-status="<?= $statusLower ?>">
                        <td><?= htmlspecialchars($agent['tracking_code']) ?></td>
                        <td><?= htmlspecialchars($agent['sender_customer_name']) ?></td>
                        <td><?= htmlspecialchars($agent['sender_agent_name']) ?></td>
                        <td><span class="<?= $statusClass ?>"><?= htmlspecialchars($statusName) ?></span></td>
                        <td><?= htmlspecialchars($agent['created_at']) ?></td>
                        <td><?= htmlspecialchars($agent['payment_status']) ?></td>
                        <td>
                            <a href="<?php echo URLROOT; ?>/admincontroller/delivery_detail?tracking_code=<?= urlencode($agent['tracking_code']) ?>"
                                class="view-button">
                                View
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <tr id="noDataRow" style="display: none;">
                        <td colspan="7" style="text-align: center; font-weight: bold; color: #555;">
                            No deliveries found.
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</main>

<!-- Custom Notification Modal -->
<div id="customNotificationModal" class="modal-overlay">
    <div class="modal-box">
        <div class="modal-header">
            <h3 id="notificationTitle">Notification</h3>
            <span class="close-btn" id="closeNotificationModal">&times;</span>
        </div>
        <div class="modal-body">
            <p id="notificationMessage"></p>
        </div>
        <div class="modal-footer">
            <button id="notificationOkButton" class="modal-ok-button">OK</button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const filterButtons = document.querySelectorAll('.filter-button');
    const rows = document.querySelectorAll('.delivery-row');
    const tableHeader = document.getElementById('tableHeaderTitle');
    const noDataRow = document.getElementById('noDataRow');
    const fromDateInput = document.getElementById('fromDateFilter');
    const toDateInput = document.getElementById('toDateFilter');
    const searchInput = document.getElementById('searchInput'); // Get the search input
    const searchButton = document.getElementById('searchButton'); // Get the search button
    const allDeliveriesButton = document.getElementById(
        'allDeliveriesButton'); // Reference to All Deliveries button

    // New: Back to All Deliveries Button
    const backToAllDeliveriesButton = document.getElementById('backToAllDeliveriesButton');

    // Notification Modal elements
    const customNotificationModal = document.getElementById('customNotificationModal');
    const notificationTitle = document.getElementById('notificationTitle'); // New: Notification title
    const notificationMessage = document.getElementById('notificationMessage');
    const notificationOkButton = document.getElementById('notificationOkButton'); // New: OK button
    const closeNotificationModal = document.getElementById('closeNotificationModal');

    let currentStatusFilter = 'all';

    // Function to show the custom notification modal
    function showNotification(message, title = 'Notification') { // Added title parameter
        notificationTitle.textContent = title; // Set the title
        notificationMessage.textContent = message;
        customNotificationModal.style.display = 'flex'; // Use flex to center
    }

    // Function to hide the custom notification modal
    function hideNotification() {
        customNotificationModal.style.display = 'none';
    }

    // Event listeners for the custom notification modal
    closeNotificationModal.addEventListener('click', hideNotification);
    notificationOkButton.addEventListener('click', hideNotification); // Event listener for OK button
    customNotificationModal.addEventListener('click', function(e) {
        if (e.target === customNotificationModal) { // Hide only if clicking on the overlay
            hideNotification();
        }
    });

    function applyFilters() {
        const fromDateVal = fromDateInput.value;
        const toDateVal = toDateInput.value;
        const fromDate = fromDateVal ? new Date(fromDateVal) : null;
        const toDate = toDateVal ? new Date(toDateVal) : null;
        const searchTerm = searchInput.value.toLowerCase(); // Get search term

        // ✅ Validation for incorrect date range
        if (fromDate && toDate && fromDate > toDate) {
            showNotification('From Date cannot be greater than To Date!', 'Date Error'); // Pass custom title
            return; // Stop function execution if validation fails
        }

        let anyVisible = false;

        rows.forEach(row => {
            const rowStatus = row.getAttribute('data-status');
            const dateText = row.cells[4].textContent.trim(); // 5th column = Date
            const rowDate = new Date(dateText);
            const rowText = row.textContent.toLowerCase(); // Get all text content of the row

            let matchesStatus = (currentStatusFilter === 'all' || rowStatus === currentStatusFilter);
            let matchesDate = true;
            let matchesSearch = true; // Assume true if no search term

            if (searchTerm) {
                matchesSearch = rowText.includes(searchTerm);
            }

            if (fromDate && rowDate < fromDate) matchesDate = false;
            if (toDate && rowDate > toDate) matchesDate = false;

            if (matchesStatus && matchesDate && matchesSearch) { // Combine all conditions
                row.style.display = '';
                anyVisible = true;
            } else {
                row.style.display = 'none';
            }
        });

        noDataRow.style.display = anyVisible ? 'none' : '';

        // Show/hide the "Back to All Deliveries" button based on active filters
        if (currentStatusFilter !== 'all' || fromDateVal || toDateVal || searchTerm) {
            backToAllDeliveriesButton.style.display = 'flex'; // Show it
        } else {
            backToAllDeliveriesButton.style.display = 'none'; // Hide it
        }
    }

    filterButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            filterButtons.forEach(btn => btn.classList.remove('active'));
            this.classList.add('active');

            const id = this.id;
            let displayText = 'All Deliveries';

            switch (id) {
                case 'deliveredButton':
                    currentStatusFilter = 'delivered';
                    displayText = 'Delivered Deliveries';
                    break;
                case 'inTransitButton':
                    currentStatusFilter = 'in transit';
                    displayText = 'In Transit Deliveries';
                    break;
                case 'pendingButton':
                    currentStatusFilter = 'pending';
                    displayText = 'Pending Deliveries';
                    break;
                case 'cancelledButton':
                    currentStatusFilter = 'cancelled';
                    displayText = 'Cancelled Deliveries';
                    break;
                case 'returnedButton':
                    currentStatusFilter = 'returned';
                    displayText = 'Returned Deliveries';
                    break;
                default:
                    currentStatusFilter = 'all';
                    displayText = 'All Deliveries';
            }

            tableHeader.textContent = displayText;
            applyFilters();
        });
    });

    fromDateInput.addEventListener('change', applyFilters);
    toDateInput.addEventListener('change', applyFilters);

    // Add event listener for the search button
    searchButton.addEventListener('click', function(e) {
        e.preventDefault(); // Prevent default form submission if it's inside a form
        if (searchInput.value.trim() === '') {
            showNotification(
                'Please enter a date or a tracking code to search.'
            ); // Use the exact message from the image
        } else {
            applyFilters(); // Apply filters including the search term
        }
    });

    // Optional: Allow pressing Enter in the search input to trigger search
    searchInput.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            if (searchInput.value.trim() === '') {
                showNotification(
                    'Please enter a date or a tracking code to search.'
                ); // Use the exact message from the image
            } else {
                applyFilters();
            }
        }
    });

    // Event listener for the new "Back to All Deliveries" button
    backToAllDeliveriesButton.addEventListener('click', () => {
        // Reset all filters
        filterButtons.forEach(btn => btn.classList.remove('active'));
        allDeliveriesButton.classList.add('active'); // Activate "All Deliveries" button
        tableHeader.textContent = 'All Deliveries';
        currentStatusFilter = 'all';

        fromDateInput.value = '';
        toDateInput.value = '';
        searchInput.value = ''; // Clear the search input as well

        applyFilters(); // Re-apply filters to show all deliveries
        backToAllDeliveriesButton.style.display = 'none'; // Hide itself
    });

    const resetButton = document.getElementById('resetButton');
    resetButton.addEventListener('click', () => {
        filterButtons.forEach(btn => btn.classList.remove('active'));
        allDeliveriesButton.classList.add('active');
        tableHeader.textContent = 'All Deliveries';
        currentStatusFilter = 'all';

        fromDateInput.value = '';
        toDateInput.value = '';
        searchInput.value = ''; // Clear the search input as well

        rows.forEach(row => row.style.display = '');
        noDataRow.style.display = 'none';
        backToAllDeliveriesButton.style.display = 'none'; // Also hide back button on reset
    });

    // Initial call to applyFilters to set button visibility on page load
    applyFilters();
});
</script>