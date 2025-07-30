<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assign Agent</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* No JavaScript-dependent message box styles needed here */
    </style>
</head>

<body class="bg-gray-100 p-6 font-sans antialiased flex items-center justify-center min-h-screen">
    <div class="max-w-5xl mx-auto bg-white p-8 rounded-xl shadow-lg w-full"> <!-- Increased padding, more rounded, stronger shadow -->
        <h2 class="text-3xl font-extrabold mb-6 text-center text-[#1F265B]">Assign Agent to Available Place</h2> <!-- Larger, bolder title -->

        <!-- Upper Panel -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8"> <!-- Increased gap, increased bottom margin -->
            <!-- Left: Selected Location -->
            <div class="bg-blue-50 border border-blue-200 rounded-lg p-5 shadow-sm"> <!-- Lighter blue background, blue border -->
                <h3 class="text-xl font-semibold text-[#1F265B] mb-3">Selected Location</h3> <!-- Larger heading -->
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
            </div>

            <?php if (!empty($data['location']['agent_name'])): ?>
                <!-- Right: Assigned Agent -->
                <div class="bg-green-50 border border-green-200 rounded-lg p-5 shadow-sm">
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
                </div>
            <?php else: ?>
                <!-- No agent assigned yet -->
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-5 shadow-sm">
                    <h3 class="text-xl font-semibold text-[#1F265B] mb-3">Assigned Agent</h3>
                    <p class="text-red-600 font-medium mt-4">No agent assigned yet.</p>
                </div>
            <?php endif; ?>
        </div>

        <!-- Lower Panel: Pending Agents -->
        <div class="bg-gray-50 border border-gray-200 rounded-lg p-6 mb-6 shadow-md"> <!-- Increased padding, stronger shadow -->
            <h3 class="text-xl font-semibold text-[#1F265B] mb-4">Pending Agents</h3> <!-- Larger heading -->
            <div id="pendingAgents" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
                <!-- Agent Cards Container -->

                <?php if (!empty($data['pendingagent'])): ?>
                    <?php foreach ($data['pendingagent'] as $agent): ?>
                        <div class="border border-gray-200 p-4 rounded-lg shadow-sm bg-white cursor-pointer transition-all duration-200 ease-in-out hover:bg-blue-50 hover:shadow-md mb-3">
                            <p class="font-semibold text-[#1F265B] text-lg"><?= htmlspecialchars($agent['name']) ?></p>
                            <p class="text-sm text-gray-600">Status: <span class="font-medium"><?= htmlspecialchars($agent['email']) ?></span></p>
                            <p class="text-sm text-gray-600">Status: <span class="font-medium"><?= htmlspecialchars($agent['status_name']) ?></span></p>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p id="no-agents-message" class="text-gray-500 text-base mt-5 text-center">No agents yet.</p>
                <?php endif; ?>
            </div>

            <!-- Selection Summary & Button -->
            <div class="mt-8 border-t border-gray-200 pt-6 flex flex-col sm:flex-row justify-between items-center gap-5"> <!-- Increased margins and padding -->
                <div>
                    <p class="text-gray-700 text-base mb-2"><strong>Selected Location:</strong> <span id="summaryLocation" class="font-semibold text-gray-800">Yangon / South Okkalapa / Ward 5</span></p>
                    <p class="text-gray-700 text-base"><strong>Selected Agent:</strong> <span id="summaryAgent" class="font-semibold text-gray-800">-</span></p>
                </div>
                <button
                    id="deploy-agent-button"
                    class="px-8 py-4 bg-[#1F265B] text-white rounded-xl hover:bg-blue-800 transition-all duration-300 font-bold shadow-lg transform hover:scale-105
                       disabled:bg-gray-300 disabled:text-gray-600 disabled:cursor-not-allowed disabled:shadow-none disabled:transform-none"
                    disabled>
                    Deploy Agent
                </button>
            </div>
        </div>
</body>

</html>