<?php
session_start(); // ✅ Must be before any HTML output

$name = isset($_SESSION['user']) ? $_SESSION['user'] : ['name' => 'Admin']; // fallback name
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assign Agent</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Custom styles for the message box */
        .message-box {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: white;
            padding: 2rem;
            border-radius: 0.75rem;
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
            z-index: 1000;
            display: none;
            /* Hidden by default */
            text-align: center;
            max-width: 400px;
            width: 90%;
        }

        .message-box-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 999;
            display: none;
            /* Hidden by default */
        }
    </style>
</head>

<body class="bg-gray-100 p-6 font-sans antialiased flex items-center justify-center min-h-screen">
    <div class="max-w-5xl mx-auto bg-white p-8 rounded-xl shadow-lg w-full">
        <h2 class="text-3xl font-extrabold mb-6 text-center text-[#1F265B]">Assign Agent to Available Place</h2>

        <!-- Upper Panel -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
            <!-- Left: Selected Location -->
            <div class="bg-blue-50 border border-blue-200 rounded-lg p-5 shadow-sm">
                <h3 class="text-xl font-semibold text-[#1F265B] mb-3">Selected Location</h3>
                <p class="text-gray-700 text-base mb-2"><strong>Region:</strong> <span id="regionName"
                        class="font-medium text-gray-800">
                        <?= htmlspecialchars($data['location']['region_name']) ?>
                    </span></p>
                <p class="text-gray-700 text-base mb-2"><strong>City:</strong> <span id="cityName"
                        class="font-medium text-gray-800">
                        <?= htmlspecialchars($data['location']['city_name']) ?>
                    </span></p>
                <p class="text-gray-700 text-base"><strong>Township:</strong> <span id="townshipName"
                        class="font-medium text-gray-800">
                        <?= htmlspecialchars($data['location']['township_name']) ?>
                    </span></p>
                <p class="text-gray-700 text-base mb-4"><strong>Location Status:</strong> <span id="locationStatus"
                        class="font-medium text-gray-800">
                        <?= htmlspecialchars($data['location']['status_location_name']) ?>
                    </span></p>

                <?php if (strtolower($data['location']['status_location_name']) === 'active'): ?>
                    <button id="deactivate-location-button"
                        class="px-6 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition duration-300 font-bold shadow-md transform hover:scale-105">
                        Deactivate Location
                    </button>
                <?php else: ?>
                    <button id="activate-location-button"
                        class="px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition duration-300 font-bold shadow-md transform hover:scale-105">
                        Activate Location
                    </button>
                <?php endif; ?>
            </div>

            <?php if (!empty($data['location']['agent_name'])): ?>
                <?php
                // Get status and decide bg color
                $status = strtolower($data['location']['agent_status_name'] ?? '');
                switch ($status) {
                    case 'active':
                        $bgColor = 'bg-green-50 border-green-200';
                        break;
                    case 'suspended':
                        $bgColor = 'bg-yellow-50 border-yellow-200';
                        break;
                    case 'inactive':
                        $bgColor = 'bg-red-50 border-red-200';
                        break;
                    default:
                        $bgColor = 'bg-gray-50 border-gray-200';
                        break;
                }
                ?>
                <!-- Right: Assigned Agent -->
                <div class="<?= $bgColor ?> border rounded-lg p-5 shadow-sm">
                    <h3 class="text-xl font-semibold text-[#1F265B] mb-3">Assigned Agent</h3>
                    <p class="text-gray-700 text-base"><strong>Name:</strong> <span class="text font-semibold">
                            <?= htmlspecialchars($data['location']['agent_name']) ?>
                        </span></p>
                    <p class="text-gray-700 text-base"><strong>Phone:</strong> <span class="text font-semibold">
                            <?= htmlspecialchars($data['location']['agent_phone']) ?>
                        </span></p>
                    <p class="text-gray-700 text-base"><strong>Email:</strong> <span class="text font-semibold">
                            <?= htmlspecialchars($data['location']['agent_email']) ?>
                        </span></p>
                    <p class="text-gray-700 text-base"><strong>Status:</strong> <span class="text font-semibold">
                            <?= htmlspecialchars($data['location']['agent_status_name']) ?>
                        </span></p>
                </div>
            <?php else: ?>
                <p class="text-gray-500 text-sm">No agent assigned yet.</p>
            <?php endif; ?>
        </div>

        <!-- Pending Agents -->
        <div class="bg-gray-50 border border-gray-200 rounded-lg p-6 mb-6 shadow-md">
            <h3 class="text-xl font-semibold text-[#1F265B] mb-4">Pending Agents</h3>

            <?php if (!empty($data['pendingagent'])): ?>
                <div id="pendingAgents" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
                    <?php foreach ($data['pendingagent'] as $agent): ?>
                        <div class="agent-card border border-gray-200 p-4 rounded-lg shadow-sm bg-white cursor-pointer hover:bg-blue-50 hover:shadow-md mb-3"
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

        <div class="mt-8 border-t border-gray-200 pt-6 flex flex-col sm:flex-row justify-between items-center gap-5">
            <div>
                <p><strong>Selected Location:</strong>
                    <span id="summaryLocation">
                        <?= htmlspecialchars($data['location']['region_name']) ?> /
                        <?= htmlspecialchars($data['location']['city_name']) ?> /
                        <?= htmlspecialchars($data['location']['township_name']) ?>
                    </span>
                </p>
                <p><strong>Selected Agent:</strong> <span id="summaryAgent">-</span></p>
            </div>

            <button onclick="history.back()"
                class="px-8 py-4 bg-[#1F265B] text-white rounded-xl hover:bg-blue-800 transition duration-300 font-bold shadow-lg transform hover:scale-105">
                ← Back
            </button>
            <button id="deploy-agent-button"
                class="px-8 py-4 bg-[#1F265B] text-white rounded-xl hover:bg-blue-800 transition duration-300 font-bold shadow-lg transform hover:scale-105 disabled:bg-gray-300 disabled:cursor-not-allowed"
                disabled>
                Deploy Agent
            </button>
        </div>
    </div>

    <div id="locationWrapper" data-location-id="<?= htmlspecialchars($data['location']['id']) ?>">
        <!-- Hidden Form for Agent Deployment -->
        <form id="deployForm" method="POST" action="<?= URLROOT ?>/availablecontroller/deployresult" style="display: none;">
            <input type="hidden" name="agent_id" id="formAgentID">
            <input type="hidden" name="agent_name" id="formAgentName">
            <input type="hidden" name="agent_email" id="formAgentEmail">
            <input type="hidden" name="agent_status" id="formAgentStatus">
            <input type="hidden" name="location_id" id="formLocationID">
            <input type="hidden" name="location" id="formLocation">
        </form>

        <!-- Hidden Form for Location Status Update -->
        <form id="locationStatusForm" method="POST" action="<?= URLROOT ?>/availablecontroller/updateLocationStatus" style="display: none;">
            <input type="hidden" name="location_id" id="formLocationStatusID">
            <input type="hidden" name="new_status" id="formLocationNewStatus">
            <input type="hidden" name="current_status" id="formCurrentStatusName">
        </form>
    </div>

    <div id="alertBox" class="hidden fixed top-5 left-1/2 transform -translate-x-1/2 z-50 max-w-xl w-full px-4">
        <div id="alertContent" class="flex items-center justify-between gap-4 p-4 rounded-md shadow-md text-white bg-green-600 transition-all duration-300">
            <span id="alertMessage" class="text-sm font-medium"></span>
            <button onclick="document.getElementById('alertBox').classList.add('hidden')" class="text-white hover:text-gray-200 focus:outline-none text-lg">&times;</button>
        </div>
    </div>

    <?php if (!empty($data['message'])): ?>
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const alertBox = document.getElementById('alertBox');
                const alertContent = document.getElementById('alertContent');
                const alertMessage = document.getElementById('alertMessage');

                // Set message content
                alertMessage.textContent = "<?= htmlspecialchars($data['message'], ENT_QUOTES) ?>";

                // Color based on message type
                alertContent.classList.remove('bg-green-600', 'bg-red-600', 'bg-yellow-500');
                <?php if ($data['message_type'] == 'error'): ?>
                    alertContent.classList.add('bg-red-600');
                <?php elseif ($data['message_type'] == 'warning'): ?>
                    alertContent.classList.add('bg-yellow-500');
                <?php else: ?>
                    alertContent.classList.add('bg-green-600');
                <?php endif; ?>

                // Show the alert
                alertBox.classList.remove('hidden');

                // Auto-hide after 4 seconds
                setTimeout(() => {
                    alertBox.classList.add('hidden');
                }, 4000);
            });
        </script>
    <?php endif; ?>

    <script>
        // Function to show a custom message box (kept for other potential uses, but not used for status change)
        function showMessageBox(message) {
            const messageBox = document.getElementById('messageBox');
            const messageBoxOverlay = document.getElementById('messageBoxOverlay');
            const messageBoxText = document.getElementById('messageBoxText');

            messageBoxText.textContent = message;
            messageBox.style.display = 'block';
            messageBoxOverlay.style.display = 'block';
        }

        // Function to hide the custom message box
        function hideMessageBox() {
            const messageBox = document.getElementById('messageBox');
            const messageBoxOverlay = document.getElementById('messageBoxOverlay');

            messageBox.style.display = 'none';
            messageBoxOverlay.style.display = 'none';
        }

        document.addEventListener('DOMContentLoaded', () => {
            const agentCards = document.querySelectorAll('.agent-card');
            const summaryAgentSpan = document.getElementById('summaryAgent');
            const deployButton = document.getElementById('deploy-agent-button');
            const messageBoxCloseButton = document.getElementById('messageBoxClose');

            // Get references to the activate/deactivate buttons and location status span
            const activateLocationButton = document.getElementById('activate-location-button');
            const deactivateLocationButton = document.getElementById('deactivate-location-button');
            const locationStatusSpan = document.getElementById('locationStatus');

            // Get references to the location status update form elements
            const locationStatusForm = document.getElementById('locationStatusForm');
            const formLocationCurrentStatus = document.getElementById('formCurrentStatusName');
            const formLocationStatusID = document.getElementById('formLocationStatusID');
            const formLocationNewStatus = document.getElementById('formLocationNewStatus');

            let selectedAgent = null; // To store the currently selected agent's data

            // Add click event listener to each agent card
            agentCards.forEach(card => {
                card.addEventListener('click', () => {
                    // Remove 'selected' class from previously selected card
                    if (selectedAgent) {
                        const previouslySelectedCard = document.querySelector('.agent-card.bg-blue-100.ring');
                        if (previouslySelectedCard) {
                            previouslySelectedCard.classList.remove('ring', 'ring-blue-400', 'bg-blue-100');
                            previouslySelectedCard.classList.add('bg-white', 'border-gray-200');
                        }
                    }

                    // Add 'selected' class to the clicked card
                    card.classList.remove('bg-white', 'border-gray-200');
                    card.classList.add('ring', 'ring-blue-400', 'bg-blue-100');

                    // Get agent data from data attributes
                    selectedAgent = {
                        id: card.dataset.agentId,
                        name: card.dataset.agentName,
                        email: card.dataset.agentEmail,
                        status: card.dataset.agentStatus
                    };

                    // Update the summary section
                    summaryAgentSpan.textContent = `${selectedAgent.name} (${selectedAgent.email})`;

                    // Enable the Deploy Agent button
                    deployButton.disabled = false;
                });
            });

            // Set location ID for the agent deployment form
            const locationId = document.getElementById('locationWrapper').dataset.locationId;
            document.getElementById('formLocationID').value = locationId;

            // Add click event listener to the Deploy Agent button
            deployButton.addEventListener('click', () => {
                if (selectedAgent) {
                    // Populate hidden form fields for agent deployment
                    document.getElementById('formAgentID').value = selectedAgent.id;
                    document.getElementById('formAgentName').value = selectedAgent.name;
                    document.getElementById('formAgentEmail').value = selectedAgent.email;
                    document.getElementById('formAgentStatus').value = selectedAgent.status;
                    document.getElementById('formLocation').value = document.getElementById('summaryLocation').textContent;

                    // Submit the form (this would typically trigger a server-side action)
                    document.getElementById('deployForm').submit();

                    // Show a message box for client-side feedback (optional, as form submission will navigate away)
                    const location = document.getElementById('summaryLocation').textContent;
                    showMessageBox(`Agent "${selectedAgent.name}" is being deployed to "${location}".`);

                } else {
                    showMessageBox('Please select an agent first.');
                }
            });

            // Function to handle location status update
            function handleLocationStatusChange(newStatus) {
                formLocationStatusID.value = locationId; // Set the location ID
                formLocationNewStatus.value = newStatus; // Set the new status ('active' or 'inactive')
                formLocationCurrentStatus.value = locationStatusSpan.textContent.trim();
                locationStatusForm.submit(); // Submit the form to update status on the backend

                // The page will navigate after form submission, so no need for client-side message box here.
                // If you want to see the status update before navigation (e.g., if backend redirects slowly),
                // you can uncomment the line below, but it might be fleeting.
                // locationStatusSpan.textContent = newStatus.charAt(0).toUpperCase() + newStatus.slice(1);
            }

            // Add click event listeners for the activate/deactivate buttons
            if (activateLocationButton) {
                activateLocationButton.addEventListener('click', () => handleLocationStatusChange('active'));
            }

            if (deactivateLocationButton) {
                deactivateLocationButton.addEventListener('click', () => handleLocationStatusChange('inactive'));
            }

            // Add event listener to the message box close button
            messageBoxCloseButton.addEventListener('click', hideMessageBox);
        });
    </script>
</body>

</html>