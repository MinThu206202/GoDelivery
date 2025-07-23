<?php require_once APPROOT . '/views/inc/sidebar.php';
session_start();
$name = $_SESSION['user'];
?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>/public/deliverycss/admin/route.css">
<style>
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
        height: 450px;
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
</style>

<main class="main-content">
    <header class="dashboard-header">
        <div class="header-left">
            <h2 class="page-title">Route</h2>
            <div class="dashboard-search-with-filters agent-filters">
                <div class="filter-group">
                    <label for="filterAccessCode">From City</label>
                    <input type="text" id="filterAccessCode" placeholder="Enter From City">
                </div>
                <div class="filter-group">
                    <label for="filterCity">To City</label>
                    <input type="text" id="filterCity" placeholder="Enter To City">
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
                <button class="add-agent-button" id="backButton" style="display: none;"><i class="fas fa-arrow-left"></i> Back</button>
                <button class="add-agent-button"><i class="fas fa-plus"></i> Add Route</button>
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
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="agentTableBody">
                    <?php foreach ($data['allroutedata'] as $route): ?>
                        <?php
                        $status = strtolower($route['status']);
                        $statusClass = $status === 'active' ? 'status-active' : 'status-inactive';
                        ?>
                        <tr data-status="<?= $status ?>">
                            <td><?= htmlspecialchars($route['from_city_name']) ?></td>
                            <td><?= htmlspecialchars($route['to_city_name']) ?></td>
                            <td><?= htmlspecialchars($route['distance']) ?></td>
                            <td><?= htmlspecialchars($route['price']) ?></td>
                            <td><span class="<?= $statusClass ?>"><?= htmlspecialchars($route['status']) ?></span></td>
                            <td><button class="view-button">View</button></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </section>
</main>

<scrip>
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

            if (matchFrom && matchTo && matchStatus) {
                row.style.display = "";
            } else {
                row.style.display = "none";
            }
        });

        // Show back button if any filter is applied
        backButton.style.display = anyFilterApplied ? "inline-block" : "none";
    }

    // Listen for status button clicks
    filterButtons.forEach(button => {
        button.addEventListener("click", () => {
            selectedStatus = button.getAttribute("data-status");

            // Highlight selected button
            filterButtons.forEach(btn => btn.classList.remove("active"));
            button.classList.add("active");

            filterTable();
        });
    });

    // Listen for city search
    applyFilterButton.addEventListener("click", () => {
        filterTable();
    });

    // Back button clears filters and shows all rows
    backButton.addEventListener("click", () => {
        document.getElementById("filterAccessCode").value = "";
        document.getElementById("filterCity").value = "";
        selectedStatus = "all";

        // Reset status filter button UI
        filterButtons.forEach(btn => btn.classList.remove("active"));
        document.querySelector('[data-status="all"]').classList.add("active");

        filterTable();
    });
</scrip