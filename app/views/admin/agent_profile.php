<?php require_once APPROOT . '/views/inc/sidebar.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


$status = $data['agent']['status_name'];
$statusLower = strtolower($status);

if ($statusLower === 'active') {
    $statusClass = 'status-active';
    $buttonText = 'Deactivate Agent';
    $buttonClass = 'btn-red';
} else {
    $statusClass = 'status-inactive';
    $buttonText = 'Activate Agent';
    $buttonClass = 'btn-green';
}
?>
<?php if (!empty($data['success'])): ?>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const successBox = document.getElementById('successBox');
            successBox.textContent = '✅ Agent status changed. Email sent!';
            successBox.classList.remove('hidden');
            setTimeout(() => successBox.classList.add('hidden'), 3000);
        });
    </script>
<?php endif; ?>
<style>
    /* Unified button styling */
    .agent-action-buttons button {
        font-size: 16px;
        padding: 12px 24px;
        border-radius: 6px;
        font-weight: 600;
        min-width: 160px;
        border: none;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .status-inactive {
        background-color: #dc3545;
        color: white;
    }

    .status-active {
        background-color: #28a745;
        color: white;
    }

    .btn-red {
        background-color: #dc3545;
        color: white;
    }

    .btn-red:hover {
        background-color: #c82333;
    }

    .btn-green {
        background-color: #28a745;
        color: white;
    }

    .btn-green:hover {
        background-color: #218838;
    }

    .update-info-button {
        background-color: #1F265B;
        color: white;
    }

    .update-info-button:hover {
        background-color: #151a3b;
    }

    /* Confirm Modal Overlay */
    .modal-overlay {
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.45);
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 1000;
    }

    .modal {
        background: white;
        padding: 24px 30px;
        border-radius: 12px;
        width: 90%;
        max-width: 420px;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
        animation: fadeIn 0.3s ease-in-out;
    }

    .modal h3 {
        font-size: 20px;
        font-weight: 600;
        margin-bottom: 10px;
        color: #1F265B;
    }

    .modal p {
        font-size: 16px;
        color: #333;
        margin-bottom: 20px;
    }

    .modal-buttons {
        display: flex;
        justify-content: flex-end;
        gap: 12px;
    }

    .btn-primary {
        background-color: #1F265B;
        color: white;
        padding: 10px 20px;
        border-radius: 6px;
        font-weight: 600;
        border: none;
        cursor: pointer;
    }

    .btn-primary:hover {
        background-color: #151a3b;
    }

    .btn-secondary {
        background-color: #e0e0e0;
        color: #333;
        padding: 10px 20px;
        border-radius: 6px;
        font-weight: 600;
        border: none;
        cursor: pointer;
    }

    .btn-secondary:hover {
        background-color: #d0d0d0;
    }

    .success-box {
        position: fixed;
        top: 20px;
        left: 50%;
        transform: translateX(-50%);
        background: #28a745;
        color: white;
        padding: 12px 20px;
        border-radius: 6px;
        font-size: 16px;
        z-index: 1001;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .hidden {
        display: none;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>

<main class="main-content">
    <header class="dashboard-header">
        <div class="header-left">
            <h2 class="value" > <a href=""> Agent</a>/</h2>
                        <h2 class="page-title">Agent View</h2>
        </div>
        <div class="header-right">
            <div class="admin-profile">
                <div class="profile-icon"><i class="fas fa-user-circle"></i></div>
                <span>Admin</span>
            </div>
        </div>
    </header>

    <section class="agent-view-panel panel">
        <div class="agent-profile-section">
            <div class="agent-avatar">
                <img id="agentProfilePhoto" src="https://placehold.co/100x100/F0F4F7/1F265B?text=Agent" alt="Agent Profile Photo">
            </div>
            <div class="agent-details">
                <div class="detail-row">
                    <span class="label">Name</span>
                    <span class="value" id="currentAgentName"><?= htmlspecialchars($data['agent']['name']) ?></span>
                    <span class="value status-tag <?= $statusClass ?>" id="currentAgentStatus"><?= htmlspecialchars($status) ?></span>
                </div>
                <div class="detail-row">
                    <span class="label">Phone:</span>
                    <span class="value" id="currentAgentPhone"><?= htmlspecialchars($data['agent']['phone']) ?></span>
                </div>
                <div class="detail-row">
                    <span class="label">Email:</span>
                    <span class="value" id="currentAgentEmail"><?= htmlspecialchars($data['agent']['email']) ?></span>
                </div>
                <div class="detail-row">
                    <span class="label">Code:</span>
                    <span class="value" id="currentAgentCode"><?= htmlspecialchars($data['agent']['email']) ?></span>
                </div>
                <div class="detail-row">
                    <span class="label">Password:</span>
                    <span class="value">********</span>
                </div>
                <div class="detail-row">
                    <span class="label">Address:</span>
                    <span class="value"><?= htmlspecialchars($data['agent']['address']) ?></span>
                </div>
            </div>
        </div>

        <div class=" agent-summary-cards">
            <div class="card"><span class="label">Assigned Deliveries</span><span class="value">10</span></div>
            <div class="card"><span class="label">Pending Deliveries</span><span class="value">10</span></div>
            <div class="card"><span class="label">Complete Deliveries</span><span class="value">10</span></div>
        </div>

        <div class="agent-action-buttons">
            <button class="<?= $buttonClass ?>" id="deactivateAccountButton"><?= $buttonText ?></button>
            <button id="updateProfileButton" class="update-info-button">Update Info</button>
        </div>

        <h3 class="assigned-deliveries-heading">Assigned Deliveries</h3>
        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>Delivery ID</th>
                        <th>Customer</th>
                        <th>Status</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($data['delivery'])): ?>
                        <?php foreach ($data['delivery'] as $delivery): ?>
                            <tr>
                                <td><?= htmlspecialchars($delivery['customer_sender_name']) ?></td>
                                <td><?= htmlspecialchars($delivery['customer_sender_email']) ?></td>
                                <td><?= htmlspecialchars($delivery['delivery_status_name']) ?></td>
                                <td><?= htmlspecialchars($delivery['created_at']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4" style="text-align:center;">No deliveries found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </section>
</main>

<input type="hidden" id="agentId" value="<?= htmlspecialchars($data['agent']['id']) ?>">

<!-- ✅ Confirmation Modal -->
<div id="customConfirmBox" class="modal-overlay hidden">
    <div class="modal">
        <h3 id="confirmTitle">Confirm Action</h3>
        <p id="confirmText">Are you sure you want to deactivate this agent?</p>
        <div class="modal-buttons">
            <button id="confirmYes" class="btn-primary">Confirm</button>
            <button id="confirmNo" class="btn-secondary">Cancel</button>
        </div>
    </div>
</div>

<!-- ✅ Success Toast -->
<div id="successBox" class="success-box hidden"></div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const statusText = document.getElementById('currentAgentStatus');
        const actionBtn = document.getElementById('deactivateAccountButton');
        const confirmBox = document.getElementById('customConfirmBox');
        const confirmText = document.getElementById('confirmText');
        const successBox = document.getElementById('successBox');
        const confirmYes = document.getElementById('confirmYes');
        const confirmNo = document.getElementById('confirmNo');
        const agentId = document.getElementById('agentId').value;

        // When action button is clicked, show confirmation
        actionBtn.addEventListener('click', () => {
            const isActive = statusText.textContent.trim().toLowerCase() === 'active';
            confirmText.textContent = isActive ?
                'Are you sure you want to deactivate this agent?' :
                'Are you sure you want to activate this agent?';
            confirmBox.classList.remove('hidden');
        });

        // When confirm YES is clicked
        confirmYes.addEventListener('click', () => {
            // Submit POST form
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = '<?= URLROOT ?>/admincontroller/changestatus';

            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'id';
            input.value = agentId;

            form.appendChild(input);
            document.body.appendChild(form);
            form.submit();
        });

        // When NO is clicked
        confirmNo.addEventListener('click', () => {
            confirmBox.classList.add('hidden');
        });

        // ✅ Show success message if redirected with ?success=1
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.get('success') === '1') {
            successBox.textContent = '✅ Agent status changed. Email sent!';
            successBox.classList.remove('hidden');
            setTimeout(() => successBox.classList.add('hidden'), 3000);
        }
    });
</script>