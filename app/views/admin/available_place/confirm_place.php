<?php
require_once APPROOT . '/views/inc/sidebar.php';
$name = isset($_SESSION['user']) ? $_SESSION['user'] : ['name' => 'Admin'];
?>
<script src="https://cdn.tailwindcss.com"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<style>
    body {
        font-family: 'Inter', sans-serif;
        background-color: #f1f5f9;
    }

    .bg-custom-blue {
        background-color: #1F265B;
    }

    .main-content {
        margin-left: 0;
    }

    @media(min-width: 768px) {
        .main-content {
            margin-left: 16rem;
        }
    }
</style>


<!-- Main Content -->
<div class="main-content flex-1 p-6 md:p-8">
    <div class="max-w-5xl mx-auto bg-white p-8 rounded-xl shadow-lg w-full">
        <h2 class="text-3xl font-extrabold mb-6 text-center text-[#1F265B]">Assign Agent to Available Place</h2>

        <!-- Upper Panel -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
            <!-- Left: Selected Location -->
            <div class="bg-blue-50 border border-blue-200 rounded-lg p-5 shadow-sm">
                <h3 class="text-xl font-semibold text-[#1F265B] mb-3">Selected Location</h3>
                <p><strong>Region:</strong> <?= htmlspecialchars($data['location']['region_name']) ?></p>
                <p><strong>City:</strong> <?= htmlspecialchars($data['location']['city_name']) ?></p>
                <p><strong>Township:</strong> <span
                        id="summaryLocation"><?= htmlspecialchars($data['location']['township_name']) ?></span></p>
                <p class="mb-4"><strong>Status:</strong>
                    <span id="locationStatus"><?= htmlspecialchars($data['location']['status_location_name']) ?></span>
                </p>

                <?php if (strtolower($data['location']['status_location_name']) === 'active'): ?>
                    <button id="deactivate-location-button"
                        class="px-6 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition duration-300 font-bold shadow-md">
                        Deactivate Location
                    </button>
                <?php else: ?>
                    <button id="activate-location-button"
                        class="px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition duration-300 font-bold shadow-md">
                        Activate Location
                    </button>
                <?php endif; ?>
            </div>

            <!-- Right: Assigned Agent -->
            <?php if (!empty($data['location']['agent_name'])): ?>
                <div class="bg-gray-50 border rounded-lg p-5 shadow-sm">
                    <h3 class="text-xl font-semibold text-[#1F265B] mb-3">Assigned Agent</h3>
                    <p><strong>Name:</strong> <?= htmlspecialchars($data['location']['agent_name']) ?></p>
                    <p><strong>Phone:</strong> <?= htmlspecialchars($data['location']['agent_phone']) ?></p>
                    <p><strong>Email:</strong> <?= htmlspecialchars($data['location']['agent_email']) ?></p>
                    <p><strong>Status:</strong> <?= htmlspecialchars($data['location']['agent_status_name']) ?></p>
                </div>
            <?php else: ?>
                <p class="text-gray-500 text-sm">No agent assigned yet.</p>
            <?php endif; ?>
        </div>

        <!-- Pending Agents Section -->
        <div class="bg-gray-50 border border-gray-200 rounded-lg p-6 mb-6 shadow-md">
            <h3 class="text-xl font-semibold text-[#1F265B] mb-4">Pending Agents</h3>
            <?php if (!empty($data['pendingagent'])): ?>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
                    <?php foreach ($data['pendingagent'] as $agent): ?>
                        <div class="agent-card border border-gray-200 p-4 rounded-lg shadow-sm bg-white cursor-pointer hover:bg-blue-50 hover:shadow-md"
                            data-agent-id="<?= htmlspecialchars($agent['id']) ?>"
                            data-agent-name="<?= htmlspecialchars($agent['name']) ?>"
                            data-agent-email="<?= htmlspecialchars($agent['email']) ?>"
                            data-agent-status="<?= htmlspecialchars($agent['status_name']) ?>">
                            <p class="font-semibold text-[#1F265B] text-lg"><?= htmlspecialchars($agent['name']) ?></p>
                            <p class="text-sm text-gray-600">Email: <?= htmlspecialchars($agent['email']) ?></p>
                            <p class="text-sm text-gray-600">Status: <?= htmlspecialchars($agent['status_name']) ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <p class="text-red-500 text-sm">No pending agents yet.</p>
            <?php endif; ?>
        </div>

        <!-- Summary Section -->
        <div class="bg-white border border-gray-200 rounded-lg p-6 mb-6 shadow-md">
            <h3 class="text-lg font-semibold text-[#1F265B] mb-2">Summary</h3>
            <p><strong>Selected Agent:</strong> <span id="summaryAgent" class="text-gray-500">None</span></p>
        </div>

        <!-- Action Buttons -->
        <div class="mt-8 flex flex-col sm:flex-row justify-between items-center gap-5">
            <button onclick="window.location.href='<?= URLROOT ?>/available_place/available'"
                class="px-8 py-4 bg-[#1F265B] text-white rounded-xl hover:bg-blue-800 transition duration-300 font-bold">←
                Back</button>
            <button id="deploy-agent-button"
                class="px-8 py-4 bg-[#1F265B] text-white rounded-xl hover:bg-blue-800 transition duration-300 font-bold disabled:bg-gray-300 disabled:cursor-not-allowed"
                disabled>Deploy Agent</button>
        </div>
    </div>
</div>

<!-- Hidden Forms -->
<div id="locationWrapper" data-location-id="<?= htmlspecialchars($data['location']['id']) ?>">
    <form id="deployForm" method="POST" action="<?= URLROOT ?>/availablecontroller/deployresult" style="display: none;">
        <input type="hidden" name="agent_id" id="formAgentID">
        <input type="hidden" name="agent_name" id="formAgentName">
        <input type="hidden" name="agent_email" id="formAgentEmail">
        <input type="hidden" name="agent_status" id="formAgentStatus">
        <input type="hidden" name="location_id" id="formLocationID">
        <input type="hidden" name="location" id="formLocation">
    </form>
    <form id="locationStatusForm" method="POST" action="<?= URLROOT ?>/availablecontroller/updateLocationStatus"
        style="display: none;">
        <input type="hidden" name="location_id" id="formLocationStatusID">
        <input type="hidden" name="new_status" id="formLocationNewStatus">
        <input type="hidden" name="current_status" id="formCurrentStatusName">
    </form>
</div>

<!-- Message Box -->
<div id="messageBoxOverlay" class="hidden fixed inset-0 bg-black bg-opacity-40 z-40"></div>
<div id="messageBox" class="hidden fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 
                bg-white p-6 rounded-lg shadow-lg z-50 max-w-md w-full">
    <p id="messageBoxText" class="text-gray-700 mb-4"></p>
    <button id="messageBoxClose" class="bg-[#1F265B] text-white px-4 py-2 rounded hover:bg-blue-800">Close</button>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const agentCards = document.querySelectorAll('.agent-card');
        const summaryAgentSpan = document.getElementById('summaryAgent');
        const deployButton = document.getElementById('deploy-agent-button');
        const locationId = document.getElementById('locationWrapper').dataset.locationId;

        let selectedAgent = null;

        // Select agent
        agentCards.forEach(card => {
            card.addEventListener('click', () => {
                agentCards.forEach(c => c.classList.remove('ring', 'ring-blue-400',
                    'bg-blue-100'));
                card.classList.add('ring', 'ring-blue-400', 'bg-blue-100');

                selectedAgent = {
                    id: card.dataset.agentId,
                    name: card.dataset.agentName,
                    email: card.dataset.agentEmail,
                    status: card.dataset.agentStatus
                };

                summaryAgentSpan.textContent = `${selectedAgent.name} (${selectedAgent.email})`;
                deployButton.disabled = false;
            });
        });

        // Deploy agent
        deployButton.addEventListener('click', () => {
            if (selectedAgent) {
                document.getElementById('formAgentID').value = selectedAgent.id;
                document.getElementById('formAgentName').value = selectedAgent.name;
                document.getElementById('formAgentEmail').value = selectedAgent.email;
                document.getElementById('formAgentStatus').value = selectedAgent.status;
                document.getElementById('formLocationID').value = locationId;
                document.getElementById('formLocation').value = document.getElementById(
                    'summaryLocation').textContent;
                document.getElementById('deployForm').submit();
            }
        });

        // Handle location status change
        const locationStatusForm = document.getElementById('locationStatusForm');
        const locationStatusSpan = document.getElementById('locationStatus');

        function handleLocationStatusChange(newStatus) {
            document.getElementById('formLocationStatusID').value = locationId;
            document.getElementById('formLocationNewStatus').value = newStatus;
            document.getElementById('formCurrentStatusName').value = locationStatusSpan.textContent.trim();
            locationStatusForm.submit();
        }

        const activateBtn = document.getElementById('activate-location-button');
        const deactivateBtn = document.getElementById('deactivate-location-button');
        if (activateBtn) activateBtn.addEventListener('click', () => handleLocationStatusChange('active'));
        if (deactivateBtn) deactivateBtn.addEventListener('click', () => handleLocationStatusChange(
            'inactive'));

        // Message box logic
        const messageBox = document.getElementById('messageBox');
        const overlay = document.getElementById('messageBoxOverlay');
        const messageText = document.getElementById('messageBoxText');
        const closeBtn = document.getElementById('messageBoxClose');

        function showMessage(msg) {
            messageText.textContent = msg;
            messageBox.classList.remove('hidden');
            overlay.classList.remove('hidden');
        }

        function hideMessage() {
            messageBox.classList.add('hidden');
            overlay.classList.add('hidden');
        }

        closeBtn.addEventListener('click', hideMessage);
        overlay.addEventListener('click', hideMessage);
    });
</script>
</body>

</html>