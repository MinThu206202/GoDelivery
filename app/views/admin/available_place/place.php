<?php require_once APPROOT . '/views/inc/sidebar.php';
?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>/public/deliverycss/admin/route.css">

<style>
    /* ---------------- Button Styles ---------------- */
    .view-button {
        display: inline-block;
        background-color: #007bff;
        color: white;
        padding: 8px 12px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        text-decoration: none;
        font-size: 14px;
        font-weight: 500;
        transition: background-color 0.3s ease;
    }

    .view-button:hover {
        background-color: #0056b3;
    }

    /* ---------------- Status Labels ---------------- */
    .status-active {
        background-color: #d4edda;
        color: #155724;
        padding: 4px 8px;
        border-radius: 12px;
        font-weight: bold;
        text-transform: capitalize;
    }

    .status-inactive {
        background-color: #f8d7da;
        color: #721c24;
        padding: 4px 8px;
        border-radius: 12px;
        font-weight: bold;
        text-transform: capitalize;
    }

    /* ---------------- Alert for Missing Agent ---------------- */
    .agent-missing {
        background-color: #fff3cd;
        color: #856404;
        font-weight: 600;
        padding: 4px 8px;
        border-radius: 6px;
        text-align: center;
    }

    /* ---------------- Table Container ---------------- */
    .agent-list-panel .table-responsive {
        max-height: 500px;
        overflow-y: auto;
        overflow-x: auto;
    }

    /* ---------------- Notification Overlay ---------------- */
    #notificationOverlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100vw;
        height: 100vh;
        background: rgba(0, 0, 0, 0.5);
        display: none;
        align-items: center;
        justify-content: center;
        z-index: 9999;
    }

    #notificationBox {
        background: #fff;
        padding: 20px 30px;
        border-radius: 8px;
        text-align: center;
        width: 300px;
        max-width: 90%;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
    }

    .modal-button-primary {
        padding: 8px 16px;
        border: none;
        border-radius: 6px;
        background: #1F265B;
        color: #fff;
        font-weight: 500;
        cursor: pointer;
        transition: background 0.2s ease;
    }

    .modal-button-primary:hover {
        background: #161c45;
    }
</style>

<main class="main-content">
    <header class="dashboard-header">
        <div class="header-left">
            <h2 class="page-title"><i class="fas fa-map-marker-alt"></i> Available Places</h2>
            <div class="dashboard-search-with-filters agent-filters">
                <div class="filter-group">
                    <label for="filterPlace">City Name</label>
                    <input type="text" id="filterPlace" placeholder="Enter City">
                </div>
                <button id="searchPlaceBtn" class="search-button"><i class="fas fa-search"></i> Search</button>
            </div>
        </div>
        <div class="header-right">
            <div class="admin-profile">
                <div class="profile-icon"><i class="fas fa-user-circle"></i></div>
                <span><?= htmlspecialchars($data['user']['name']) ?></span>
            </div>
        </div>
    </header>

    <section class="agent-list-panel panel">
        <div class="panel-header-with-button">
            <h3>Place List</h3>
            <div class="button-group">
                <button id="backButton" class="back-to-all-agents-button " style="display:none;"><i
                        class="fas fa-arrow-left"></i>
                    Back</button>
                <button class="add-agent-button"
                    onclick="window.location.href='<?= URLROOT ?>/available_place/addplace'">
                    <i class="fas fa-plus"></i> Add Place
                </button>
            </div>
        </div>

        <div class="table-responsive">
            <table id="placeTable">
                <thead>
                    <tr>
                        <th>Region</th>
                        <th>City</th>
                        <th>Township</th>
                        <th>Agent Name</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="placeTableBody">
                    <?php if (!empty($data['availabel_place'])): ?>
                        <?php foreach ($data['availabel_place'] as $place):
                            $status = strtolower($place['status_location_name'] ?? '');
                            $statusClass = $status === 'active' ? 'status-active' : 'status-inactive';
                        ?>
                            <tr>
                                <td><?= htmlspecialchars($place['region_name'] ?? 'No') ?></td>
                                <td><?= htmlspecialchars($place['city_name'] ?? 'No') ?></td>
                                <td><?= htmlspecialchars($place['township_name'] ?? 'No Agent Yet') ?></td>
                                <td class="<?= empty($place['agent_name']) ? 'agent-missing' : '' ?>">
                                    <?= !empty($place['agent_name']) ? htmlspecialchars($place['agent_name']) : 'No Agent Yet' ?>
                                </td>
                                <td><span
                                        class="<?= $statusClass ?>"><?= htmlspecialchars($place['status_location_name'] ?? 'No') ?></span>
                                </td>
                                <td>
                                    <a href="<?= URLROOT ?>/available_place/place_detail?id=<?= htmlspecialchars($place['id'] ?? '') ?>"
                                        class="view-button">View</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" style="text-align:center;">No places available.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </section>
</main>

<!-- Notification Overlay -->
<div id="notificationOverlay">
    <div id="notificationBox">
        <h2>Notification</h2>
        <p id="notificationMessage"></p>
        <button class="modal-button-primary" onclick="closeNotificationBox()">OK</button>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const filterInput = document.getElementById('filterPlace');
        const searchBtn = document.getElementById('searchPlaceBtn');
        const backBtn = document.getElementById('backButton');
        const tableBody = document.getElementById('placeTableBody');

        const notificationOverlay = document.getElementById('notificationOverlay');
        const notificationMessage = document.getElementById('notificationMessage');

        function showNotification(msg) {
            notificationMessage.textContent = msg;
            notificationOverlay.style.display = 'flex';
        }

        window.closeNotificationBox = function() {
            notificationOverlay.style.display = 'none';
            filterInput.focus();
        }

        function filterTable() {
            const filterValue = filterInput.value.trim().toLowerCase();

            // Remove previous "no data" row
            const prevNoDataRow = document.getElementById('noDataRow');
            if (prevNoDataRow) prevNoDataRow.remove();

            let visibleCount = 0;
            tableBody.querySelectorAll('tr').forEach(row => {
                const city = row.cells[1]?.textContent.toLowerCase() || '';
                const match = city.includes(filterValue);
                row.style.display = match ? '' : 'none';
                if (match) visibleCount++;
            });

            // Show message if no matches
            if (visibleCount === 0) {
                const noDataTr = document.createElement('tr');
                noDataTr.id = 'noDataRow';
                noDataTr.innerHTML =
                    `<td colspan="6" style="text-align:center; font-weight:bold;">No matching places found.</td>`;
                tableBody.appendChild(noDataTr);
            }

            // Show Back button if searched
            backBtn.style.display = filterValue ? 'inline-block' : 'none';
        }

        searchBtn.addEventListener('click', () => {
            if (!filterInput.value.trim()) {
                showNotification('You need to type a city name!');
                return;
            }
            filterTable();
        });

        filterInput.addEventListener('keyup', e => {
            if (e.key === 'Enter') searchBtn.click();
        });

        backBtn.addEventListener('click', () => {
            filterInput.value = '';
            tableBody.querySelectorAll('tr').forEach(row => row.style.display = '');
            const prevNoDataRow = document.getElementById('noDataRow');
            if (prevNoDataRow) prevNoDataRow.remove();
            backBtn.style.display = 'none';
        });
    });
</script>