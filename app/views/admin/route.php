<?php
require_once APPROOT . '/views/inc/sidebar.php';
$name = $_SESSION['user'];
?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>/public/deliverycss/admin/route.css">

<style>
    /* Existing styles remain */
    .view-button {
        background-color: #1F265B;
        color: white;
        border: none;
        padding: 6px 12px;
        border-radius: 5px;
        cursor: pointer;
        font-size: 14px;
        transition: background-color 0.3s ease;
    }

    .view-button:hover {
        background-color: #151b40;
    }

    .table-responsive {
        overflow-x: auto;
        height: 400px;
        overflow-y: auto;
    }

    .status-active {
        background-color: #d4edda;
        color: #155724;
        padding: 4px 8px;
        border-radius: 4px;
        display: inline-block;
        font-weight: bold;
    }

    .status-inactive {
        background-color: #f8d7da;
        color: #721c24;
        padding: 4px 8px;
        border-radius: 4px;
        display: inline-block;
        font-weight: bold;
    }

    .filter-button {
        background-color: #ccc;
        color: #000;
        padding: 6px 12px;
        margin-right: 10px;
        border: none;
        border-radius: 5px;
        font-weight: bold;
        cursor: pointer;
    }

    .filter-button.active {
        color: #fff;
    }

    /* Centered Modal */
    /* Modal Overlay */
    #routeOverlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 999;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    #routeOverlay.show {
        display: block;
        opacity: 1;
    }

    /* Centered Modal Box */
    #routeDetailBox {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%) scale(0.95);
        background: #fff;
        padding: 30px 35px;
        border-radius: 12px;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
        width: 90%;
        max-width: 420px;
        font-family: 'Poppins', sans-serif;
        color: #222;
        box-sizing: border-box;
        opacity: 0;
        transition: opacity 0.3s ease, transform 0.3s ease;
        position: relative;
        /* Added for positioning the close button */
    }

    #routeOverlay.show #routeDetailBox {
        opacity: 1;
        transform: translate(-50%, -50%) scale(1);
    }

    /* Modal Close Button */
    .close-button {
        position: absolute;
        top: 15px;
        right: 20px;
        font-size: 26px;
        color: #888;
        cursor: pointer;
        transition: color 0.3s ease;
        font-weight: bold;
        user-select: none;
    }

    .close-button:hover {
        color: #444;
    }

    /* Modal Title */
    .modal-title {
        font-weight: 700;
        font-size: 22px;
        text-align: center;
        color: #1F265B;
        margin-bottom: 25px;
        letter-spacing: 0.05em;
    }

    /* Modal Content Rows */
    .modal-content {
        display: flex;
        flex-direction: column;
        gap: 16px;
    }

    .modal-row {
        display: flex;
        justify-content: space-between;
        /* Changed to space-between for left/right alignment */
        align-items: center;
        font-size: 16px;
        border-bottom: 1px solid #eee;
        padding-bottom: 8px;
    }

    .label {
        font-weight: 600;
        color: #444;
        /* width: 110px; Removed fixed width for more natural flow */
        text-align: left;
        flex-basis: 40%;
        /* Give label a flexible basis */
        min-width: 100px;
        /* Ensure label has a minimum width */
    }

    .value {
        color: #555;
        flex-grow: 1;
        padding-left: 15px;
        text-align: right;
        font-weight: 500;
    }

    /* Unit text styling next to value */
    .modal-row span.value+span {
        color: #888;
        font-weight: 400;
        padding-left: 4px;
    }

    /* Status styling */
    .status-active {
        color: #155724;
        background-color: #d4edda;
        padding: 4px 12px;
        border-radius: 20px;
        font-weight: 600;
        font-size: 14px;
        text-transform: capitalize;
    }

    .status-inactive {
        color: #721c24;
        background-color: #f8d7da;
        padding: 4px 12px;
        border-radius: 20px;
        font-weight: 600;
        font-size: 14px;
        text-transform: capitalize;
    }

    /* Modal Footer buttons */
    .modal-footer {
        display: flex;
        justify-content: center;
        /* Changed to center for button alignment */
        gap: 20px;
        margin-top: 30px;
    }

    .modal-button-secondary {
        background-color: #f0f0f0;
        color: #444;
        border: 1px solid #ccc;
        padding: 12px 28px;
        border-radius: 8px;
        cursor: pointer;
        font-size: 16px;
        font-weight: 600;
        transition: background-color 0.3s ease, border-color 0.3s ease;
    }

    .modal-button-secondary:hover {
        background-color: #e0e0e0;
        border-color: #aaa;
    }

    .modal-button-primary {
        background-color: #1F265B;
        color: white;
        border: none;
        padding: 12px 28px;
        border-radius: 8px;
        cursor: pointer;
        font-size: 16px;
        font-weight: 600;
        transition: background-color 0.3s ease;
    }

    .modal-button-primary:hover {
        background-color: #151b40;
    }

    /* --- New Notification Box Styles --- */
    #notificationOverlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 10000;
        /* Higher than routeOverlay */
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    #notificationOverlay.show {
        display: block;
        opacity: 1;
    }

    #notificationBox {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%) scale(0.95);
        background: #fff;
        padding: 30px 35px;
        border-radius: 12px;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
        width: 90%;
        max-width: 420px;
        font-family: 'Poppins', sans-serif;
        color: #222;
        box-sizing: border-box;
        opacity: 0;
        transition: opacity 0.3s ease, transform 0.3s ease;
    }

    #notificationOverlay.show #notificationBox {
        opacity: 1;
        transform: translate(-50%, -50%) scale(1);
    }

    .notification-title {
        font-weight: 700;
        font-size: 22px;
        text-align: center;
        color: #1F265B;
        margin-bottom: 25px;
        letter-spacing: 0.05em;
    }

    .notification-content p {
        text-align: center;
        margin-bottom: 20px;
        font-size: 16px;
        color: #555;
    }

    .notification-footer {
        display: flex;
        justify-content: center;
        margin-top: 20px;
    }
</style>

<main class="main-content">
    <header class="dashboard-header">
        <div class="header-left">
            <h2 class="page-title">Route</h2>
            <div class="dashboard-search-with-filters agent-filters">
                <div class="filter-group">
                    <label for="filterAccessCode">From Township</label>
                    <input type="text" id="filterAccessCode" placeholder="Enter From Township">
                </div>
                <div class="filter-group">
                    <label for="filterCity">To Township</label>
                    <input type="text" id="filterCity" placeholder="Enter To Township">
                </div>
                <button id="applyFilterButton" class="search-button">
                    <i class="fas fa-search"></i> Search
                </button>
            </div>
        </div>
        <div class="header-right">
            <div class="admin-profile">
                <div class="profile-icon"><i class="fas fa-user-circle"></i></div>
                <span><?= htmlspecialchars($name['name']) ?></span>
            </div>
        </div>
    </header>

    <section class="agent-list-panel panel">
        <div class="status-filter-buttons">
            <button class="filter-button active" data-status="all">All Route</button>
            <button class="filter-button" data-status="active">Active Route</button>
            <button class="filter-button" data-status="inactive">Not Active Route</button>
        </div>
        <div class="panel-header-with-button">
            <h3>Route List</h3>
            <div class="button-group">
                <button class="add-agent-button" id="backButton" style="display: none;"><i
                        class="fas fa-arrow-left"></i> Back</button>
                <button class="add-agent-button" onclick="window.location.href='<?= URLROOT ?>/routepage/addroute'">
                    <i class="fas fa-plus"></i> Add Route
                </button>
            </div>
        </div>

        <div class="table-responsive">
            <table id="agentTable">
                <thead>
                    <tr>
                        <th>From</th>
                        <th>To</th>
                        <th>Distance (km)</th>
                        <th>Price</th>
                        <th>Duration Time</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody id="agentTableBody">
                    <?php if (!empty($data['allroutedata'])): ?>
                        <?php foreach ($data['allroutedata'] as $route): ?>
                            <?php
                            $status = strtolower($route['status']);
                            $statusClass = $status === 'active' ? 'status-active' : 'status-inactive';
                            ?>
                            <tr data-status="<?= $status ?>">
                                <td><?= htmlspecialchars($route['from_township']) ?></td>
                                <td><?= htmlspecialchars($route['to_township']) ?></td>
                                <td><?= htmlspecialchars($route['distance']) ?></td>
                                <td><?= htmlspecialchars($route['price']) ?></td>
                                <td><?= htmlspecialchars($route['time']) ?>Hours</td>
                                <td><span class="<?= $statusClass ?>"><?= htmlspecialchars($route['status']) ?></span></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" style="text-align: center;">No routes available.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </section>
</main>

<!-- Modal Overlay for Route Detail -->
<div id="routeOverlay">
    <div id="routeDetailBox">
        <!-- Close button added here -->
        <span class="close-button" onclick="closeDetailBox()">&times;</span>
        <h2 class="modal-title">Route Detail</h2>
        <div class="modal-content">
            <div class="modal-row">
                <span class="label">From:</span>
                <span class="value" id="detailFrom"></span>
            </div>
            <div class="modal-row">
                <span class="label">To:</span>
                <span class="value" id="detailTo"></span>
            </div>
            <div class="modal-row">
                <span class="label">Distance:</span>
                <span class="value" id="detailDistance"></span><span> km</span>
            </div>
            <div class="modal-row">
                <span class="label">Price:</span>
                <span class="value" id="detailPrice"></span><span> MMK</span>
            </div>
            <div class="modal-row">
                <span class="label">Status:</span>
                <span class="value" id="detailStatus"></span>
            </div>
        </div>
        <!-- Inside your modal-footer div -->
        <div class="modal-footer">
            <button onclick="showFullDetail()" class="modal-button-primary">View Full Detail</button>
            <button onclick="closeDetailBox()" class="modal-button-secondary">Cancel</button>
        </div>
    </div>
</div>

<!-- New Notification Box HTML -->
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
    const filterButtons = document.querySelectorAll(".filter-button");
    const applyFilterButton = document.getElementById("applyFilterButton");
    const backButton = document.getElementById("backButton");
    let selectedStatus = "all";

    function filterTable() {
        const fromCityInput = document.getElementById("filterAccessCode").value.trim().toLowerCase();
        const toCityInput = document.getElementById("filterCity").value.trim().toLowerCase();
        let anyFilterApplied = fromCityInput || toCityInput || selectedStatus !== "all";

        document.querySelectorAll("#agentTableBody tr").forEach(row => {
            const rowFrom = row.children[0].textContent.trim().toLowerCase();
            const rowTo = row.children[1].textContent.trim().toLowerCase();
            const rowStatus = row.getAttribute("data-status");

            const matchFrom = !fromCityInput || rowFrom.includes(fromCityInput);
            const matchTo = !toCityInput || rowTo.includes(toCityInput);
            const matchStatus = selectedStatus === "all" || rowStatus === selectedStatus;

            row.style.display = (matchFrom && matchTo && matchStatus) ? "" : "none";
        });

        backButton.style.display = anyFilterApplied ? "inline-block" : "none";
    }

    filterButtons.forEach(button => {
        button.addEventListener("click", () => {
            selectedStatus = button.getAttribute("data-status");
            filterButtons.forEach(btn => btn.classList.remove("active"));
            button.classList.add("active");
            filterTable();
        });
    });

    applyFilterButton.addEventListener("click", () => {
        const fromCityInput = document.getElementById("filterAccessCode").value.trim();
        const toCityInput = document.getElementById("filterCity").value.trim();

        if (!fromCityInput && !toCityInput) {
            showNotificationBox("Please enter From City or To City before searching.");
            return; // Stop further execution
        }

        filterTable();
    });

    backButton.addEventListener("click", () => {
        document.getElementById("filterAccessCode").value = "";
        document.getElementById("filterCity").value = "";
        selectedStatus = "all";
        filterButtons.forEach(btn => btn.classList.remove("active"));
        document.querySelector('[data-status="all"]').classList.add("active");
        filterTable();
    });

    function showNotificationBox(message) {
        document.getElementById("notificationMessage").textContent = message;
        document.getElementById("notificationOverlay").classList.add("show");
    }

    function closeNotificationBox() {
        document.getElementById("notificationOverlay").classList.remove("show");
    }

    function openDetailBox() {
        document.getElementById("routeOverlay").classList.add("show");
    }

    function closeDetailBox() {
        document.getElementById("routeOverlay").classList.remove("show");
    }

    function showFullDetail() {
        // For example, redirect to a detail page or show more info
        // You can customize this to your need

        // Example: alert with route info (replace with real action)
        const from = document.getElementById("detailFrom").textContent;
        const to = document.getElementById("detailTo").textContent;
        // Using showNotificationBox instead of alert
        showNotificationBox(`Showing full detail for route: ${from} → ${to}`);

        // Or you could do something like:
        // window.location.href = `/route/detail?from=${encodeURIComponent(from)}&to=${encodeURIComponent(to)}`;

        // Close the modal after action
        closeDetailBox();
    }

    document.querySelectorAll(".view-button").forEach((btn) => {
        btn.addEventListener("click", () => {
            const row = btn.closest("tr");

            document.getElementById("detailFrom").textContent = row.children[0].textContent;
            document.getElementById("detailTo").textContent = row.children[1].textContent;
            document.getElementById("detailDistance").textContent = row.children[2].textContent;
            document.getElementById("detailPrice").textContent = row.children[3].textContent;
            document.getElementById("detailStatus").textContent = row.children[4].textContent;

            const statusText = row.children[4].textContent.trim().toLowerCase();
            const detailStatusSpan = document.getElementById("detailStatus");
            detailStatusSpan.className = 'value'; // reset classes
            if (statusText === 'active') {
                detailStatusSpan.classList.add('status-active');
            } else if (statusText === 'inactive') {
                detailStatusSpan.classList.add('status-inactive');
            }

            openDetailBox();
        });
    });
</script>