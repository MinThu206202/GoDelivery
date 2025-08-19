<?php require_once APPROOT . '/views/inc/sidebar.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>/public/deliverycss/admin/access_code.css">

<style>
    /* -------------------- Status Labels -------------------- */
    .bg-green {
        background-color: #d4edda;
        color: #155724;
        padding: 4px 8px;
        border-radius: 4px;
        display: inline-block;
    }

    .bg-red {
        background-color: #f8d7da;
        color: #721c24;
        padding: 4px 8px;
        border-radius: 4px;
        display: inline-block;
    }

    .bg-yellow {
        background-color: #fff3cd;
        color: #856404;
        padding: 4px 8px;
        border-radius: 4px;
        display: inline-block;
    }

    .bg-gray {
        background-color: #e2e3e5;
        color: #6c757d;
        padding: 4px 8px;
        border-radius: 4px;
        display: inline-block;
    }

    /* -------------------- Notification -------------------- */
    #notificationOverlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100vw;
        height: 100vh;
        display: none;
        align-items: center;
        justify-content: center;
        background: rgba(0, 0, 0, 0.6);
        z-index: 9999;
    }

    #notificationBox {
        background: #fff;
        padding: 25px 30px;
        border-radius: 10px;
        width: 360px;
        max-width: 90%;
        text-align: center;
        box-shadow: 0 5px 15px rgba(31, 38, 91, 0.8);
        animation: fadeIn 0.3s ease-in-out;
    }

    .notification-title {
        font-size: 20px;
        color: #1F265B;
        margin-bottom: 15px;
    }

    .notification-content p {
        font-size: 15px;
        color: #1F265B;
    }

    .notification-footer {
        margin-top: 20px;
    }

    .modal-button-primary {
        padding: 8px 16px;
        border: none;
        border-radius: 6px;
        background: #1F265B;
        color: #fff;
        font-weight: 500;
        cursor: pointer;
        transition: 0.2s ease;
    }

    .modal-button-primary:hover {
        background: #161c45;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(-15px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* -------------------- Table & Modal -------------------- */
    .status-label {
        padding: 4px 8px;
        border-radius: 6px;
        font-weight: 500;
        display: inline-block;
    }

    .copy-access-code {
        cursor: pointer;
        margin-left: 5px;
    }

    .copied-feedback {
        opacity: 0;
        transition: opacity 0.3s ease;
        color: #28a745;
        font-weight: 600;
        margin-left: 8px;
    }

    .copied-feedback.show {
        opacity: 1;
    }

    /* -------------------- Success Box -------------------- */
    .success-box {
        position: fixed;
        top: 20px;
        left: 50%;
        transform: translateX(-50%);
        padding: 12px 24px;
        border-radius: 8px;
        font-weight: 500;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
        z-index: 9999;
        display: none;
    }
</style>

<main class="main-content">
    <header class="dashboard-header">
        <div class="header-left">
            <h2 class="page-title">Access Code</h2>
            <div class="dashboard-search-with-filters agent-filters">
                <div class="filter-group">
                    <label for="filterName">Name:</label>
                    <input type="text" id="filterName" placeholder="e.g., John Doe">
                </div>
                <div class="filter-group">
                    <label for="filterCity">City:</label>
                    <input type="text" id="filterCity" placeholder="e.g., Yangon">
                </div>
                <button id="applyFilterButton" class="search-button"><i class="fas fa-search"></i> Search</button>
            </div>
        </div>
        <div class="header-right">
            <div class="admin-profile">
                <div class="profile-icon"><i class="fas fa-user-circle"></i></div>
                <span>Admin</span>
            </div>
        </div>
    </header>

    <section class="agent-list-panel panel">
        <div class="panel-header-with-button">
            <h3>Access Code List</h3>
            <div class="button-group">
                <button class="back-to-all-agents-button" id="backButton" style="display:none;">
                    <i class="fas fa-arrow-left"></i> Back to All
                </button>
            </div>
        </div>

        <div class="table-responsive">
            <table id="accessCodeTable">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>City</th>
                        <th>Security Code</th>
                        <th>Email</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Edit</th>
                    </tr>
                </thead>
                <tbody id="tableBody">
                    <?php foreach ($data['allUserData'] as $agent): ?>
                        <?php
                        $statusClass = 'bg-gray';
                        if ($agent['status_name'] === 'Active') $statusClass = 'bg-green';
                        elseif ($agent['status_name'] === 'Inactive') $statusClass = 'bg-red';
                        elseif ($agent['status_name'] === 'Suspended') $statusClass = 'bg-yellow';
                        ?>
                        <tr>
                            <td><?= htmlspecialchars($agent['name']) ?></td>
                            <td><?= htmlspecialchars($agent['city_name']) ?></td>
                            <td><?= htmlspecialchars($agent['security_code'] ?? '') ?></td>
                            <td><?= htmlspecialchars($agent['email']) ?></td>
                            <td><?= htmlspecialchars($agent['created_at'] ?? '') ?></td>
                            <td><span class="<?= $statusClass ?>"><?= htmlspecialchars($agent['status_name']) ?></span></td>
                            <td>
                                <button class="open-settings"
                                    data-agent='<?= htmlspecialchars(json_encode($agent), ENT_QUOTES, 'UTF-8') ?>'
                                    title="Edit Access Code">
                                    <i class="fas fa-edit"></i>
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </section>
</main>

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

<div id="successBox" class="success-box"></div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        // ---------------- Elements ----------------
        const filterNameInput = document.getElementById('filterName');
        const filterCityInput = document.getElementById('filterCity');
        const applyFilterButton = document.getElementById('applyFilterButton');
        const backButton = document.getElementById('backButton');
        const tableBody = document.getElementById('tableBody');

        const notificationOverlay = document.getElementById('notificationOverlay');
        const notificationMessage = document.getElementById('notificationMessage');
        const successBox = document.getElementById('successBox');

        // ---------------- Notification ----------------
        function showNotification(message) {
            notificationMessage.textContent = message;
            notificationOverlay.style.display = 'flex';
        }
        window.closeNotificationBox = () => {
            notificationOverlay.style.display = 'none';
            filterNameInput.focus();
        };

        // ---------------- Filter Table ----------------
        function filterTable() {
            const nameFilter = filterNameInput.value.trim().toLowerCase();
            const cityFilter = filterCityInput.value.trim().toLowerCase();

            // Remove previous "no data" row
            const prevNoDataRow = document.getElementById('noDataRow');
            if (prevNoDataRow) prevNoDataRow.remove();

            let visibleCount = 0;
            tableBody.querySelectorAll('tr').forEach(row => {
                const name = row.cells[0]?.textContent.toLowerCase() || '';
                const city = row.cells[1]?.textContent.toLowerCase() || '';

                const match = (!nameFilter || name.includes(nameFilter)) &&
                    (!cityFilter || city.includes(cityFilter));

                row.style.display = match ? '' : 'none';
                if (match) visibleCount++;
            });

            if (visibleCount === 0) {
                const noDataTr = document.createElement('tr');
                noDataTr.id = 'noDataRow';
                noDataTr.innerHTML =
                    `<td colspan="7" style="text-align:center; font-weight:bold;">Data is not available</td>`;
                tableBody.appendChild(noDataTr);
            }

            backButton.style.display = (nameFilter || cityFilter) ? 'inline-block' : 'none';
        }

        // ---------------- Event Listeners ----------------
        applyFilterButton.addEventListener('click', () => {
            if (!filterNameInput.value.trim() && !filterCityInput.value.trim()) {
                showNotification('You need to type something!');
                return;
            }
            filterTable();
        });

        [filterNameInput, filterCityInput].forEach(input => {
            input.addEventListener('keyup', e => {
                if (e.key === 'Enter') applyFilterButton.click();
            });
        });

        backButton.addEventListener('click', () => {
            filterNameInput.value = '';
            filterCityInput.value = '';
            filterTable();
            backButton.style.display = 'none';
        });

        // ---------------- Success Box Example ----------------
        function showSuccess(message, isError = false) {
            successBox.textContent = message;
            successBox.style.backgroundColor = isError ? '#f8d7da' : '#d4edda';
            successBox.style.color = isError ? '#721c24' : '#155724';
            successBox.style.border = isError ? '1px solid #f5c6cb' : '1px solid #c3e6cb';
            successBox.style.display = 'block';
            setTimeout(() => successBox.style.display = 'none', 3000);
        }

        // ---------------- Initialize ----------------
        backButton.style.display = 'none';
        filterTable();
    });
</script>