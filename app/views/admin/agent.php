<?php require_once APPROOT . '/views/inc/sidebar.php'; ?>

<style>
    .detail-modal {
        position: fixed;
        top: 0;
        left: 0;
        width: 100vw;
        height: 100vh;
        background: rgba(0, 0, 0, 0.6);
        display: none;
        align-items: center;
        justify-content: center;
        z-index: 999;
    }

    .detail-modal.show {
        display: flex;
    }

    .detail-modal .modal-box {
        background: #fff;
        color: #1F265B;
        padding: 25px 30px;
        border-radius: 10px;
        width: 360px;
        position: relative;
        box-shadow: 0 5px 15px rgba(31, 38, 91, 0.8);
        animation: fadeIn 0.3s ease-in-out;
    }

    .modal-box h4 {
        margin-bottom: 15px;
        font-size: 20px;
        color: #1F265B;
        text-align: center;
    }

    .modal-box p {
        margin-bottom: 10px;
        font-size: 15px;
    }

    .modal-box p {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 12px;
        font-size: 15px;
        line-height: 1.4;
        color: #1F265B;
    }

    .modal-box p span:first-child {
        font-weight: 600;
        min-width: 110px;
        margin-right: 10px;
    }

    .modal-box p span:last-child {
        text-align: right;
        font-weight: 500;
    }

    .bg-green {
        background-color: #28a745;
        color: white;
        padding: 3px 8px;
        border-radius: 5px;
        font-size: 13px;
    }

    .bg-red {
        background-color: #dc3545;
        color: white;
        padding: 3px 8px;
        border-radius: 5px;
        font-size: 13px;
    }

    .bg-yellow {
        background-color: #ffc107;
        color: #1F265B;
        padding: 3px 8px;
        border-radius: 5px;
        font-size: 13px;
    }

    .bg-gray {
        background-color: #6c757d;
        color: white;
        padding: 3px 8px;
        border-radius: 5px;
        font-size: 13px;
    }

    .modal-actions {
        display: flex;
        justify-content: space-between;
        margin-top: 20px;
    }

    .detail-button,
    .cancel-button {
        background-color: #1F265B;
        color: white;
        border: none;
        padding: 8px 16px;
        border-radius: 6px;
        cursor: pointer;
        transition: 0.2s ease;
    }

    .detail-button:hover,
    .cancel-button:hover {
        background-color: #151b40;
    }

    .close-button {
        position: absolute;
        right: 10px;
        top: 10px;
        background: transparent;
        color: #1F265B;
        border: none;
        font-size: 20px;
        cursor: pointer;
    }

    .modal-buttons {
        display: flex;
        justify-content: flex-end;
        gap: 10px;
        /* spacing between buttons */
        margin-top: 20px;
    }

    .modal-buttons button {
        padding: 8px 16px;
        font-size: 14px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        background-color: #1F265B;
        color: white;
        transition: background-color 0.2s ease;
    }

    .modal-buttons button:hover {
        background-color: #161c45;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: scale(0.9);
        }

        to {
            opacity: 1;
            transform: scale(1);
        }
    }
</style>

<main class="main-content">
    <header class="dashboard-header">
        <div class="header-left">
            <h2 class="page-title">Agent</h2>
            <div class="dashboard-search-with-filters agent-filters">
                <div class="filter-group">
                    <label for="filterAccessCode">Access Code:</label>
                    <input type="text" id="filterAccessCode" placeholder="Enter Access Code">
                </div>
                <div class="filter-group">
                    <label for="filterEmail">Email:</label>
                    <input type="email" id="filterEmail" placeholder="Enter Email">
                </div>
                <div class="filter-group">
                    <label for="filterCity">City:</label>
                    <input type="text" id="filterCity" placeholder="Enter City">
                </div>
                <button id="applyFilterButton" class="search-button">
                    <i class="fas fa-search"></i> Search
                </button>
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
        <div class="status-filter-buttons">
            <button class="filter-button active" data-status="all">All Agents</button>
            <button class="filter-button" data-status="active">Active Agents</button>
            <button class="filter-button" data-status="not active">Not Active Agents</button>
        </div>
        <div class="panel-header-with-button">
            <h3>Agent List</h3>
            <div class="button-group">
                <button class="add-agent-button" id="backButton"><i class="fas fa-arrow-left"></i> Back</button>
                <button class="add-agent-button"><i class="fas fa-plus"></i> Add Agent</button>
            </div>
        </div>

        <div class="table-responsive">
            <table id="agentTable">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>City</th>
                        <th>Access Code</th>
                        <th>Status</th>
                        <th>Setting</th>
                    </tr>
                </thead>
                <tbody id="agentTableBody">
                    <?php foreach ($data['code'] as $agent): ?>
                        <?php
                        $statusClass = 'bg-gray';
                        if ($agent['status_name'] === 'Active') {
                            $statusClass = 'bg-green';
                        } elseif ($agent['status_name'] === 'Inactive') {
                            $statusClass = 'bg-red';
                        } elseif ($agent['status_name'] === 'Suspended') {
                            $statusClass = 'bg-yellow';
                        }
                        ?>
                        <tr>
                            <td><?= htmlspecialchars($agent['name']) ?></td>
                            <td><?= htmlspecialchars($agent['email']) ?></td>
                            <td><?= htmlspecialchars($agent['city_name']) ?></td>
                            <td><?= htmlspecialchars($agent['phone']) ?></td>
                            <td><span class="<?= $statusClass ?>"><?= htmlspecialchars($agent['status_name']) ?></span></td>
                            <td><button class="open-settings" data-agent='<?= htmlspecialchars(json_encode($agent), ENT_QUOTES, 'UTF-8') ?>'>⚙️</button></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </section>
</main>

<!-- Detail Modal -->
<div class="detail-modal" id="agentDetailBox">
    <div class="modal-box">
        <button class="close-button" id="closeModal">×</button>
        <h4>Agent Detail</h4>
        <p><span>Name:</span> <span id="detailName"></span></p>
        <p><span>Email:</span> <span id="detailEmail"></span></p>
        <p><span>City:</span> <span id="detailCity"></span></p>
        <p><span>Access Code:</span> <span id="detailAccessCode"></span></p>
        <p><span>Status:</span> <span id="detailStatus" class="status-label"></span></p>
        <div class="modal-buttons">
            <!-- Inside the modal -->
            <button id="detailViewBtn" data-id="">View Full Detail</button>
            <button id="closeModalBottom">Cancel</button>
        </div>
    </div>
</div>

<!-- Custom alert overlay -->
<div class="custom-alert-overlay" id="customAlertOverlay">
    <div class="custom-alert-box">
        <p id="customAlertMessage"></p>
        <div class="settings-actions">
            <button class="cancel-button" id="closeCustomAlert">OK</button>
        </div>
    </div>
</div>

<script>
    const allAgents = <?= json_encode($data['code']) ?>;
    const backButton = document.getElementById('backButton');
    const detailViewBtn = document.getElementById('detailViewBtn'); // Get the button element


    // Render agent table rows
    function renderTable(agents) {
        const tbody = document.getElementById('agentTableBody');
        tbody.innerHTML = '';

        if (agents.length === 0) {
            const tr = document.createElement('tr');
            const td = document.createElement('td');
            td.colSpan = 6;
            td.style.textAlign = 'center';
            td.style.padding = '20px';
            td.style.fontStyle = 'italic';
            td.textContent = 'No agents found matching your criteria.';
            tr.appendChild(td);
            tbody.appendChild(tr);
            return;
        }

        agents.forEach(agent => {
            let statusClass = 'bg-gray';
            let icon = '⏸️';

            if (agent.status_name === 'Active') {
                statusClass = 'bg-green';
                icon = '✅';
            } else if (agent.status_name === 'Inactive') {
                statusClass = 'bg-red';
                icon = '❌';
            } else if (agent.status_name === 'Suspended') {
                statusClass = 'bg-yellow';
                icon = '⚠️';
            }

            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${agent.name}</td>
                <td>${agent.email}</td>
                <td>${agent.city_name}</td>
                <td>${agent.access_code}</td>
                <td><span class="${statusClass}">${icon} ${agent.status_name}</span></td>
                <td><button class="open-settings" data-agent='${JSON.stringify(agent)}'>⚙️</button></td>
            `;

            row.style.opacity = 0;
            tbody.appendChild(row);
            setTimeout(() => row.style.opacity = 1, 100);
        });
    }

    // Show back button when user filters or searches
    function showBackButton() {
        backButton.style.display = 'inline-flex';
    }

    // Hide back button when back clicked or on load
    function hideBackButton() {
        backButton.style.display = 'none';
    }

    // Filter buttons (All, Active, Not Active)
    document.querySelectorAll('.filter-button').forEach(btn => {
        btn.addEventListener('click', () => {
            document.querySelectorAll('.filter-button').forEach(b => b.classList.remove('active'));
            btn.classList.add('active');

            const filter = btn.getAttribute('data-status');
            const filtered = allAgents.filter(agent => {
                if (filter === 'all') return true;
                return filter === 'active' ?
                    agent.status_name.toLowerCase() === 'active' :
                    agent.status_name.toLowerCase() !== 'active';
            });

            renderTable(filtered);
            showBackButton();
        });
    });

    // Search filter with custom alert overlay
    document.getElementById('applyFilterButton').addEventListener('click', () => {
        const code = document.getElementById('filterAccessCode').value.trim().toLowerCase();
        const email = document.getElementById('filterEmail').value.trim().toLowerCase();
        const city = document.getElementById('filterCity').value.trim().toLowerCase();

        if (!code && !email && !city) {
            showCustomAlert("Please enter at least one search value.");
            return;
        }

        const filtered = allAgents.filter(agent => {
            return (!code || agent.access_code.toLowerCase().includes(code)) &&
                (!email || agent.email.toLowerCase().includes(email)) &&
                (!city || agent.city_name.toLowerCase().includes(city));
        });

        renderTable(filtered);
        showBackButton();
    });

    // Back button resets to All Agents + clears filters
    backButton.addEventListener('click', () => {
        document.getElementById('filterAccessCode').value = '';
        document.getElementById('filterEmail').value = '';
        document.getElementById('filterCity').value = '';

        document.querySelectorAll('.filter-button').forEach(b => b.classList.remove('active'));
        const allBtn = document.querySelector('.filter-button[data-status="all"]');
        allBtn.classList.add('active');

        renderTable(allAgents);

        hideBackButton();
    });

    // Modal open/close animation
    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('open-settings')) {
            const agent = JSON.parse(e.target.getAttribute('data-agent'));
            document.getElementById('detailName').textContent = agent.name;
            document.getElementById('detailEmail').textContent = agent.email;
            document.getElementById('detailCity').textContent = agent.city_name;
            document.getElementById('detailAccessCode').textContent = agent.access_code;

            const detailStatus = document.getElementById('detailStatus');
            detailStatus.textContent = agent.status_name;

            // Remove previous classes
            detailStatus.className = 'status-label';

            // Add color class based on status
            if (agent.status_name === 'Active') {
                detailStatus.classList.add('bg-green');
            } else if (agent.status_name === 'Inactive') {
                detailStatus.classList.add('bg-red');
            } else if (agent.status_name === 'Suspended') {
                detailStatus.classList.add('bg-yellow');
            } else {
                detailStatus.classList.add('bg-gray');
            }

            // Set the agent ID to the "View Full Detail" button
            detailViewBtn.dataset.id = agent.id; // This line was added/fixed

            const modal = document.getElementById('agentDetailBox');
            modal.classList.add('show');
        }

        if (e.target.id === 'closeModal' || e.target.id === 'closeModalBottom') {
            const modal = document.getElementById('agentDetailBox');
            modal.classList.remove('show');
        }
    });

    // Close modal when clicking outside modal content
    document.getElementById('agentDetailBox').addEventListener('click', (e) => {
        if (e.target.id === 'agentDetailBox') {
            e.target.classList.remove('show');
        }
    });

    // Friendly custom alert overlay
    function showCustomAlert(message) {
        const alertOverlay = document.getElementById('customAlertOverlay');
        const alertMessage = document.getElementById('customAlertMessage');
        alertMessage.textContent = message;
        alertOverlay.style.display = 'flex';
    }

    // Close custom alert
    document.getElementById('closeCustomAlert').addEventListener('click', () => {
        document.getElementById('customAlertOverlay').style.display = 'none';
    });


    // Detail button click event (now correctly referencing detailViewBtn)
    detailViewBtn.addEventListener('click', () => {
        const agentId = detailViewBtn.dataset.id;
        if (agentId) {
            // Assuming URLROOT is defined in your PHP context and accessible globally
            // Or you might need to pass it as a JS variable from PHP
            window.location.href = `<?php echo URLROOT; ?>/admincontroller/set_agent_session?id=${agentId}`;
        } else {
            showCustomAlert("Agent ID not found for full detail view.");
        }
    });

    // Initial render on page load
    hideBackButton();
    renderTable(allAgents);
</script>

</body>

</html>