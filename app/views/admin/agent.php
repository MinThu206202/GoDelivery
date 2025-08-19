<?php require_once APPROOT . '/views/inc/sidebar.php';
$name = $_SESSION['user'];
?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>/public/deliverycss/admin/agent.css">

<style>
    /* ------------------ Modal & Table Styling ------------------ */
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

    .modal-box {
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
        text-align: center;
        margin-bottom: 15px;
        font-size: 20px;
    }

    .modal-box p {
        display: flex;
        justify-content: space-between;
        margin-bottom: 12px;
        font-size: 15px;
    }

    .modal-box p span:first-child {
        font-weight: 600;
        min-width: 110px;
        margin-right: 10px;
    }

    .bg-green {
        background: #28a745;
        color: #fff;
        padding: 3px 8px;
        border-radius: 5px;
        font-size: 13px;
    }

    .bg-red {
        background: #dc3545;
        color: #fff;
        padding: 3px 8px;
        border-radius: 5px;
        font-size: 13px;
    }

    .bg-yellow {
        background: #ffc107;
        color: #1F265B;
        padding: 3px 8px;
        border-radius: 5px;
        font-size: 13px;
    }

    .bg-gray {
        background: #6c757d;
        color: #fff;
        padding: 3px 8px;
        border-radius: 5px;
        font-size: 13px;
    }

    .modal-buttons {
        display: flex;
        justify-content: flex-end;
        gap: 10px;
        margin-top: 20px;
    }

    .modal-buttons button,
    .detail-button,
    .cancel-button {
        padding: 8px 16px;
        font-size: 14px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        background: #1F265B;
        color: white;
        transition: 0.2s ease;
    }

    .modal-buttons button:hover,
    .detail-button:hover,
    .cancel-button:hover {
        background: #161c45;
    }

    .close-button {
        position: absolute;
        right: 10px;
        top: 10px;
        background: transparent;
        border: none;
        font-size: 20px;
        color: #1F265B;
        cursor: pointer;
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

    /* ------------------ Notification Overlay ------------------ */
    #notificationOverlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100vw;
        height: 100vh;
        background: rgba(0, 0, 0, 0.6);
        display: none;
        align-items: center;
        justify-content: center;
        z-index: 9999;
    }

    #notificationBox {
        background: #fff;
        padding: 25px 30px;
        border-radius: 10px;
        width: 360px;
        box-shadow: 0 5px 15px rgba(31, 38, 91, 0.8);
        text-align: center;
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
        color: white;
        cursor: pointer;
        transition: 0.2s ease;
    }

    .modal-button-primary:hover {
        background: #161c45;
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
                <button id="applyFilterButton" class="search-button"><i class="fas fa-search"></i> Search</button>
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
            <button class="filter-button active" data-status="all">All Agents</button>
            <button class="filter-button" data-status="active">Active Agents</button>
            <button class="filter-button" data-status="not active">Not Active Agents</button>
        </div>
        <div class="panel-header-with-button">
            <h3>Agent List</h3>
            <div class="button-group">
                <button class="add-agent-button" id="backButton" style="display:none;"><i class="fas fa-arrow-left"></i>
                    Back</button>
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
                    <?php foreach ($data['allUserData'] as $agent): ?>
                        <?php $statusClass = $agent['status_name'] === 'Active' ? 'bg-green' : ($agent['status_name'] === 'Inactive' ? 'bg-red' : ($agent['status_name'] === 'Suspended' ? 'bg-yellow' : 'bg-gray')); ?>
                        <tr>
                            <td><?= htmlspecialchars($agent['name']) ?></td>
                            <td><?= htmlspecialchars($agent['email']) ?></td>
                            <td><?= htmlspecialchars($agent['city_name']) ?></td>
                            <td><?= htmlspecialchars($agent['security_code']) ?></td>
                            <td><span class="<?= $statusClass ?>"><?= htmlspecialchars($agent['status_name']) ?></span></td>
                            <td><button class="open-settings"
                                    data-agent='<?= htmlspecialchars(json_encode($agent), ENT_QUOTES, 'UTF-8') ?>'>⚙️</button>
                            </td>
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
        <p><span>Security Code:</span> <span id="detailAccessCode"></span></p>
        <p><span>Status:</span> <span id="detailStatus" class="status-label"></span></p>
        <div class="modal-buttons">
            <button id="detailViewBtn" data-id="">View Full Detail</button>
            <button id="closeModalBottom">Cancel</button>
        </div>
    </div>
</div>

<!-- Notification Overlay -->
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
    const allAgents = <?= json_encode($data['allUserData']) ?>;
    const backButton = document.getElementById('backButton');
    const detailViewBtn = document.getElementById('detailViewBtn');

    // Render Table
    function renderTable(agents, emptyMessage = 'No agents found matching your criteria.') {
        const tbody = document.getElementById('agentTableBody');
        tbody.innerHTML = '';
        if (!agents.length) {
            const tr = document.createElement('tr');
            const td = document.createElement('td');
            td.colSpan = 6;
            td.style.textAlign = 'center';
            td.style.padding = '20px';
            td.style.fontStyle = 'italic';
            td.textContent = emptyMessage;
            tr.appendChild(td);
            tbody.appendChild(tr);
            return;
        }
        agents.forEach(agent => {
            let statusClass = agent.status_name === 'Active' ? 'bg-green' : (agent.status_name === 'Inactive' ?
                'bg-red' : (agent.status_name === 'Suspended' ? 'bg-yellow' : 'bg-gray'));
            const row = document.createElement('tr');
            row.innerHTML = `
            <td>${agent.name}</td>
            <td>${agent.email}</td>
            <td>${agent.city_name}</td>
            <td>${agent.security_code}</td>
            <td><span class="${statusClass}">${agent.status_name}</span></td>
            <td><button class="open-settings" data-agent='${JSON.stringify(agent)}'>⚙️</button></td>
        `;
            tbody.appendChild(row);
        });
    }

    // Notification
    function showNotification(message) {
        document.getElementById('notificationMessage').textContent = message;
        document.getElementById('notificationOverlay').style.display = 'flex';
    }

    function closeNotificationBox() {
        document.getElementById('notificationOverlay').style.display = 'none';
    }

    // Show/Hide Back Button
    function showBackButton() {
        backButton.style.display = 'inline-flex';
    }

    function hideBackButton() {
        backButton.style.display = 'none';
    }

    // Apply Search
    function applySearch() {
        const accessCode = document.getElementById('filterAccessCode').value.trim().toLowerCase();
        const email = document.getElementById('filterEmail').value.trim().toLowerCase();
        const city = document.getElementById('filterCity').value.trim().toLowerCase();

        if (!accessCode && !email && !city) {
            showNotification("Please enter at least one search value.");
            return;
        }

        const filtered = allAgents.filter(agent => {
            const codeMatch = accessCode ? (agent.security_code || '').toString().toLowerCase().includes(
                accessCode) : true;
            const emailMatch = email ? (agent.email || '').toLowerCase().includes(email) : true;
            const cityMatch = city ? (agent.city_name || '').toLowerCase().includes(city) : true;
            return codeMatch && emailMatch && cityMatch;
        });

        if (filtered.length === 0) {
            renderTable([], "Your input data is not have.");
        } else {
            renderTable(filtered);
        }

        showBackButton();
    }


    // Event Listeners
    document.getElementById('applyFilterButton').addEventListener('click', applySearch);
    ['filterAccessCode', 'filterEmail', 'filterCity'].forEach(id => {
        document.getElementById(id).addEventListener('keypress', e => {
            if (e.key === 'Enter') applySearch();
        });
    });

    // Back Button
    backButton.addEventListener('click', () => {
        document.getElementById('filterAccessCode').value = '';
        document.getElementById('filterEmail').value = '';
        document.getElementById('filterCity').value = '';
        document.querySelectorAll('.filter-button').forEach(b => b.classList.remove('active'));
        const allBtn = document.querySelector('.filter-button[data-status="all"]');
        if (allBtn) allBtn.classList.add('active');
        renderTable(allAgents);
        hideBackButton();
    });

    // Filter Buttons
    document.querySelectorAll('.filter-button').forEach(btn => {
        btn.addEventListener('click', () => {
            document.querySelectorAll('.filter-button').forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
            const filter = btn.getAttribute('data-status');
            const filtered = allAgents.filter(agent => {
                if (filter === 'all') return true;
                return filter === 'active' ? agent.status_name.toLowerCase() === 'active' : agent
                    .status_name.toLowerCase() !== 'active';
            });
            renderTable(filtered);
            showBackButton();
        });
    });

    // Modal open/close
    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('open-settings')) {
            const agent = JSON.parse(e.target.getAttribute('data-agent'));
            document.getElementById('detailName').textContent = agent.name;
            document.getElementById('detailEmail').textContent = agent.email;
            document.getElementById('detailCity').textContent = agent.city_name;
            document.getElementById('detailAccessCode').textContent = agent.security_code;
            const detailStatus = document.getElementById('detailStatus');
            detailStatus.textContent = agent.status_name;
            detailStatus.className = 'status-label';
            if (agent.status_name === 'Active') detailStatus.classList.add('bg-green');
            else if (agent.status_name === 'Inactive') detailStatus.classList.add('bg-red');
            else if (agent.status_name === 'Suspended') detailStatus.classList.add('bg-yellow');
            else detailStatus.classList.add('bg-gray');
            detailViewBtn.dataset.id = agent.id;
            document.getElementById('agentDetailBox').classList.add('show');
        }
        if (e.target.id === 'closeModal' || e.target.id === 'closeModalBottom') document.getElementById(
            'agentDetailBox').classList.remove('show');
    });
    document.getElementById('agentDetailBox').addEventListener('click', e => {
        if (e.target.id === 'agentDetailBox') e.target.classList.remove('show');
    });

    // Detail button redirect
    detailViewBtn.addEventListener('click', () => {
        const agentId = detailViewBtn.dataset.id;
        if (agentId) window.location.href = `<?php echo URLROOT; ?>/admincontroller/agent_profile?id=${agentId}`;
        else showNotification("Please select an agent.");
    });

    // Initial render
    hideBackButton();
    renderTable(allAgents);
</script>