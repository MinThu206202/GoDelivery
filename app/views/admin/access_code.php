<?php require_once APPROOT . '/views/inc/sidebar.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>/public/deliverycss/admin/access_code.css">

<style>
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

    .custom-alert-overlay {
        display: none;
        position: fixed;
        top: 10px;
        left: 50%;
        transform: translateX(-50%);
        background: rgba(0, 0, 0, 0.3);
        justify-content: center;
        align-items: flex-start;
        z-index: 9999;
        padding-top: 50px;
    }

    .custom-alert-box {
        background: #ffffff;
        padding: 20px 30px;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        text-align: center;
        animation: slideDownFade 0.3s ease-out;
    }

    @keyframes slideDownFade {
        from {
            transform: translateY(-20px);
            opacity: 0;
        }

        to {
            transform: translateY(0);
            opacity: 1;
        }
    }

    #customAlertCloseButton {
        background-color: #28a745;
        color: white;
        border: none;
        padding: 8px 16px;
        border-radius: 4px;
        cursor: pointer;
    }

    #customAlertCloseButton:hover {
        background-color: #218838;
    }

    .settings-box {
        max-width: 600px;
        width: 90vw;
        background: #fff;
        padding: 20px 30px;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
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

    .status-label {
        padding: 4px 8px;
        border-radius: 6px;
        color: white;
        font-weight: 500;
    }

    .success-box {
        position: fixed;
        top: 20px;
        left: 50%;
        transform: translateX(-50%);
        background-color: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
        padding: 12px 24px;
        border-radius: 8px;
        font-weight: 500;
        z-index: 9999;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
        transition: opacity 0.5s ease;
    }

    .hidden {
        display: none;
    }

    .custom-alert-overlay {
        display: none;
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background: #fff3cd;
        border: 1px solid #ffeeba;
        padding: 20px 30px;
        border-radius: 8px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        z-index: 99999;
        font-weight: 600;
        color: #856404;
        text-align: center;
        min-width: 260px;
    }

    /* Close button */
    #customAlertCloseButton {
        margin-top: 15px;
        background-color: #856404;
        border: none;
        color: white;
        padding: 8px 20px;
        border-radius: 4px;
        cursor: pointer;
        font-weight: 600;
    }

    #customAlertCloseButton:hover {
        background-color: #6b5200;
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
        <div class="panel-header-with-button">
            <h3>Access Code List</h3>
            <div class="button-group">
                <button class="back-to-all-agents-button" id="backToAllAccessCodesButton" style="display: none;">
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
                <tbody id="agentTableBody">
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

<!-- Settings Modal -->
<div class="settings-overlay" id="settingsOverlay" style="text-align:left; display: none;">
    <div class="settings-box">
        <h4>Access Code Details</h4>
        <div id="accessCodeData">
            <p><strong><i class="fas fa-user detail-icon"></i> Name:</strong> <span id="detailName"></span></p>
            <p><strong><i class="fas fa-city detail-icon"></i> City:</strong> <span id="detailCity"></span></p>
            <p><strong><i class="fas fa-envelope detail-icon"></i> Email:</strong> <span id="detailEmail"></span></p>
            <p>
                <strong><i class="fas fa-lock detail-icon"></i> Security Code:</strong>
                <span id="detailSecurityCode"></span>
                <i class="far fa-copy copy-access-code" data-code=""></i>
                <span class="copied-feedback">Copied!</span>
            </p>
            <p><strong><i class="fas fa-info-circle"></i> Status:</strong> <span id="detailStatus"
                    class="status-label"></span></p>
        </div>
        <div class="settings-actions">
            <button class="detail-button" type="button" id="sendEmailButton"><i class="fas fa-envelope"></i> Send
                Email</button>
            <button class="cancel-button" id="cancelButton">Close</button>
        </div>
    </div>
</div>

<div id="successBox" class="success-box hidden"></div>

<button class="back-to-all-agents-button" id="backToAllAccessCodesButton" style="display: none;">
    <i class="fas fa-arrow-left"></i> Back to All
</button>

<div class="custom-alert-overlay" id="customAlertOverlay" style="display:none;">
    <div>
        <p>You need to type something!</p>
        <button id="customAlertCloseButton">OK</button>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const settingsOverlay = document.getElementById('settingsOverlay');
        const detailName = document.getElementById('detailName');
        const detailCity = document.getElementById('detailCity');
        const detailEmail = document.getElementById('detailEmail');
        const detailSecurityCode = document.getElementById('detailSecurityCode');
        const detailStatus = document.getElementById('detailStatus');
        const copyCodeIcon = document.querySelector('.copy-access-code');
        const cancelButton = document.getElementById('cancelButton');
        const sendEmailBtn = document.getElementById('sendEmailButton');
        const successBox = document.getElementById('successBox');
        const baseUrl = "<?= URLROOT ?>/admincontroller/sendmail";

        const backButton = document.getElementById('backToAllAccessCodesButton');
        const filterNameInput = document.getElementById('filterName');
        const filterCityInput = document.getElementById('filterCity');
        const applyFilterButton = document.getElementById('applyFilterButton');
        const tableBody = document.getElementById('agentTableBody');

        const alertOverlay = document.getElementById('customAlertOverlay');
        const alertCloseBtn = document.getElementById('customAlertCloseButton');

        // Populate Modal with agent data when edit clicked
        document.querySelectorAll('.open-settings').forEach(button => {
            button.addEventListener('click', () => {
                const data = JSON.parse(button.getAttribute('data-agent') || '{}');

                detailName.textContent = data.name || '';
                detailCity.textContent = data.city_name || '';
                detailEmail.textContent = data.email || '';
                detailSecurityCode.textContent = data.security_code || '';

                let statusClass = 'bg-gray';
                if (data.status_name?.toLowerCase() === 'active') statusClass = 'bg-green';
                else if (data.status_name?.toLowerCase() === 'inactive') statusClass = 'bg-red';
                else if (data.status_name?.toLowerCase() === 'suspended') statusClass = 'bg-yellow';

                detailStatus.className = `status-label ${statusClass}`;
                detailStatus.textContent = data.status_name || '';

                copyCodeIcon.setAttribute('data-code', data.security_code || '');
                settingsOverlay.style.display = 'flex';

                sendEmailBtn.onclick = () => {
                    if (data.id) {
                        window.location.href = `${baseUrl}?id=${data.id}`;
                    }
                };
            });
        });

        // Copy Access Code to clipboard
        copyCodeIcon.addEventListener('click', (e) => {
            const code = e.target.getAttribute('data-code');
            if (!code) return;
            navigator.clipboard.writeText(code).then(() => {
                const feedback = e.target.nextElementSibling;
                feedback.classList.add('show');
                setTimeout(() => feedback.classList.remove('show'), 1500);
            });
        });

        // Close Modal
        cancelButton.addEventListener('click', () => {
            settingsOverlay.style.display = 'none';
        });

        // Show success/error alert from URL query
        const urlParams = new URLSearchParams(window.location.search);
        const success = urlParams.get('success');

        if (success === '1') {
            showSuccess(' Agent status changed. Email sent!');
        } else if (success === '0') {
            showSuccess(' Something went wrong. Email not sent.', true);
        }

        function showSuccess(message, isError = false) {
            successBox.textContent = message;
            if (isError) {
                successBox.style.backgroundColor = '#f8d7da';
                successBox.style.color = '#721c24';
                successBox.style.borderColor = '#f5c6cb';
            } else {
                successBox.style.backgroundColor = '#d4edda';
                successBox.style.color = '#155724';
                successBox.style.borderColor = '#c3e6cb';
            }
            successBox.classList.remove('hidden');
            setTimeout(() => {
                successBox.classList.add('hidden');
                const cleanUrl = window.location.origin + window.location.pathname;
                window.history.replaceState({}, document.title, cleanUrl);
            }, 3000);
        }

        // Filter Table function and Back button show/hide logic
        function filterTable() {
            const nameFilter = filterNameInput.value.trim().toLowerCase();
            const cityFilter = filterCityInput.value.trim().toLowerCase();

            // Remove any previous no data row
            const noDataRow = document.getElementById('noDataRow');
            if (noDataRow) noDataRow.remove();

            let visibleCount = 0;

            tableBody.querySelectorAll('tr').forEach(row => {
                if (row.id === 'noDataRow') return;

                const name = row.cells[0].textContent.toLowerCase();
                const city = row.cells[1].textContent.toLowerCase();

                const nameMatch = !nameFilter || name.includes(nameFilter);
                const cityMatch = !cityFilter || city.includes(cityFilter);

                if (nameMatch && cityMatch) {
                    row.style.display = '';
                    visibleCount++;
                } else {
                    row.style.display = 'none';
                }
            });

            if (visibleCount === 0) {
                const noDataTr = document.createElement('tr');
                noDataTr.id = 'noDataRow';
                noDataTr.innerHTML =
                    `<td colspan="7" style="text-align:center; font-weight:bold;">Data is not available</td>`;
                tableBody.appendChild(noDataTr);
            }

            // Show or hide Back button
            if (nameFilter !== '' || cityFilter !== '') {
                backButton.style.display = 'inline-block';
            } else {
                backButton.style.display = 'none';
            }
        }

        // Alert overlay close button event
        alertCloseBtn.addEventListener('click', () => {
            alertOverlay.style.display = 'none';
            filterNameInput.focus();
        });

        // Search button click event
        applyFilterButton.addEventListener('click', () => {
            const nameVal = filterNameInput.value.trim();
            const cityVal = filterCityInput.value.trim();

            if (nameVal === '' && cityVal === '') {
                alertOverlay.style.display = 'block';
                return;
            }

            filterTable();
        });

        // Back button resets filters and shows all
        backButton.addEventListener('click', () => {
            filterNameInput.value = '';
            filterCityInput.value = '';
            filterTable();
            backButton.style.display = 'none';
        });

        // Support Enter key on inputs to trigger search
        filterNameInput.addEventListener('keyup', (e) => {
            if (e.key === 'Enter') applyFilterButton.click();
        });
        filterCityInput.addEventListener('keyup', (e) => {
            if (e.key === 'Enter') applyFilterButton.click();
        });

        // Initialize: hide back button and show all data
        backButton.style.display = 'none';
        filterTable();
    });
</script>