<?php require_once APPROOT . '/views/inc/agentsidebar.php'; ?>


<body class="flex flex-col min-h-screen">
    <!-- Main Content Area -->
    <div class="flex-1 flex flex-col overflow-hidden">
        <!-- Header -->
        <header class="flex items-center justify-between p-6 bg-white shadow-md rounded-bl-lg">
            <h1 class="text-3xl font-semibold text-gray-800">Pickup Agents</h1>
            <div x-data="{ open: false }" class="relative">
                <!-- Button-like Trigger -->
                <button
                    @click="open = !open"
                    class="flex items-center space-x-2 bg-white border border-gray-300 px-4 py-2 rounded-lg shadow-sm hover:bg-gray-100 transition">
                    <img src="/Delivery/<?= htmlspecialchars($agent['profile_image']) ?>"
                        alt="Agent Avatar"
                        class="w-10 h-10 rounded-full border-2 border-blue-500">
                    <div class="text-left">
                        <p class="text-lg font-medium text-gray-800">
                            <?= htmlspecialchars($agent['name']) ?>
                        </p>
                        <p class="text-sm text-gray-500">
                            Agent ID: <?= htmlspecialchars($agent['access_code']) ?>
                        </p>
                    </div>
                </button>

                <!-- Dropdown -->
                <div
                    x-show="open"
                    @click.away="open = false"
                    x-transition
                    class="absolute right-0 mt-2 w-48 bg-white border border-gray-200 rounded-lg shadow-lg py-2 z-50">
                    <!-- Profile -->
                    <a href="<?= URLROOT; ?>/agent/profile"
                        class="block px-4 py-2 text-gray-700 hover:bg-gray-100 transition">
                        Profile
                    </a>

                    <!-- Divider -->
                    <div class="border-t my-1"></div>

                    <!-- Logout -->
                    <a href="<?= URLROOT; ?>/agent/logout"
                        class="block px-4 py-2 text-gray-700 hover:bg-gray-100 transition">
                        Logout
                    </a>
                </div>
            </div>

            <!-- Alpine.js -->
            <script src="//unpkg.com/alpinejs" defer></script>

        </header>

        <!-- Agent List Content -->
        <main class="flex-1 overflow-y-auto p-6 bg-gray-100">
            <div class="max-w-6xl mx-auto bg-white p-8 rounded-xl shadow-md">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-semibold text-gray-800">All Agents</h2>
                    <a href="<?php echo URLROOT; ?>/agent/addpickupagent"
                        class="text-white bg-[#1F265B] px-4 py-2 rounded-lg text-sm font-medium hover:bg-[#2A346C] transition-colors duration-200">
                        Add New Pickup Agent
                    </a>
                </div>

                <!-- Fixed Table Height -->
                <div class="overflow-x-auto h-[450px] flex">
                    <table class="min-w-full divide-y divide-gray-200 self-start w-full">
                        <thead class="bg-gray-50 sticky top-0 z-10">
                            <tr>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Agent ID</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Name</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Contact</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Assigned Pickups</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Status</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Actions</th>
                            </tr>
                        </thead>
                        <tbody id="agentsTableBody" class="bg-white divide-y divide-gray-200">
                            <!-- Agent Data is now directly in the HTML -->
                            <?php foreach ($data['pickupAgents'] as $res): ?>
                                <tr data-status="Active">
                                    <td class="px-6 py-4 text-sm font-medium text-gray-900 break-words max-w-[120px]">
                                        <?= htmlspecialchars($res['access_code'] ?? 'N/A') ?></td>
                                    <td class="px-6 py-4 text-sm text-gray-500 break-words max-w-[150px]">
                                        <?= htmlspecialchars($res['name']) ?></td>
                                    <td class="px-6 py-4 text-sm text-gray-500 break-words max-w-[120px]">
                                        <?= htmlspecialchars($res['phone']) ?></td>
                                    <td class="px-6 py-4 text-sm text-gray-500 break-words max-w-[120px]">
                                        <?= htmlspecialchars($res['vehicle_type_name']) ?></td>
                                    <td class="px-6 py-4 text-sm">
                                        <?php
                                        $statusClass = '';
                                        switch (strtolower($res['status_name'])) {
                                            case 'active':
                                                $statusClass = 'bg-green-100 text-green-800';
                                                break;
                                            case 'inactive':
                                                $statusClass = 'bg-red-100 text-red-800';
                                                break;
                                            case 'suspended':
                                                $statusClass = 'bg-yellow-100 text-yellow-800';
                                                break;
                                            default:
                                                $statusClass = 'bg-gray-100 text-gray-800'; // fallback
                                                break;
                                        }
                                        ?>
                                        <span
                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full <?= $statusClass ?> break-words max-w-[120px] text-center">
                                            <?= ucfirst(htmlspecialchars($res['status_name'])) ?>
                                        </span>
                                    </td>
                                    <td class="px-4 py-3 flex flex-wrap gap-2">
                                        <a href="<?php echo URLROOT; ?>/agent/pickupagentdetail?access_code=<?= urlencode($res['access_code']) ?>"
                                            class="text-white bg-[#1F265B] px-3 py-2 rounded hover:bg-[#2A346C] text-sm break-words text-center w-[60px]">
                                            View
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>

    <script>
        // No JavaScript is needed for rendering, as the data is now in the HTML.
    </script>
</body>

</html>