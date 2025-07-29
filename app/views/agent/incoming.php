<?php require_once APPROOT . '/views/inc/agentsidebar.php'; ?>

<script src="https://cdn.tailwindcss.com"></script>
<!-- Inter Font -->
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<style>
    body {
        font-family: 'Inter', sans-serif;
        background-color: #f3f4f6;
    }
</style>

<!-- Main Content Area -->
<div class="flex-1 flex flex-col overflow-hidden">
    <!-- Header -->
    <header class="flex items-center justify-between p-6 bg-white shadow-md rounded-bl-lg">
        <h1 class="text-3xl font-semibold text-gray-800">Deliveries</h1>
        <div class="flex items-center space-x-4">
            <div class="flex items-center space-x-2">
                <img src="https://placehold.co/40x40/FF6347/FFFFFF?text=JD" alt="Agent Avatar"
                    class="w-10 h-10 rounded-full border-2 border-blue-500">
                <div>
                    <p class="text-lg font-medium text-gray-800"><?= htmlspecialchars($agent['name']) ?></p>
                    <p class="text-sm text-gray-500">Agent ID: #007</p>
                </div>
            </div>

        </div>
    </header>

    <!-- Delivery History Content -->
    <main class="flex-1 overflow-y-auto p-6 bg-gray-100">
        <div class="max-w-6xl mx-auto bg-white p-8 rounded-xl shadow-md">
            <h2 class="text-2xl font-semibold text-gray-800 mb-6">All Deliveries</h2>

            <!-- Filter Links -->
            <div class="mb-6 flex flex-wrap gap-3">
                <a href="#" onclick="filterDeliveries(event, 'All')"
                    class="filter-link px-5 py-2 rounded-lg text-sm font-medium border border-gray-300 bg-gray-100 hover:bg-gray-200 transition-colors duration-200 active">
                    All
                </a>
                <a href="#" onclick="filterDeliveries(event, 'Delivered')"
                    class="filter-link px-5 py-2 rounded-lg text-sm font-medium border border-gray-300 bg-gray-100 hover:bg-gray-200 transition-colors duration-200">
                    Delivered
                </a>
                <a href="#" onclick="filterDeliveries(event, 'In Transit')"
                    class="filter-link px-5 py-2 rounded-lg text-sm font-medium border border-gray-300 bg-gray-100 hover:bg-gray-200 transition-colors duration-200">
                    In Transit
                </a>
                <a href="#" onclick="filterDeliveries(event, 'Pending')"
                    class="filter-link px-5 py-2 rounded-lg text-sm font-medium border border-gray-300 bg-gray-100 hover:bg-gray-200 transition-colors duration-200">
                    Pending
                </a>
                <a href="#" onclick="filterDeliveries(event, 'Cancelled')"
                    class="filter-link px-5 py-2 rounded-lg text-sm font-medium border border-gray-300 bg-gray-100 hover:bg-gray-200 transition-colors duration-200">
                    Cancelled
                </a>
                <a href="#" onclick="filterDeliveries(event, 'Return')"
                    class="filter-link px-5 py-2 rounded-lg text-sm font-medium border border-gray-300 bg-gray-100 hover:bg-gray-200 transition-colors duration-200">
                    Return
                </a>
            </div>

            <div class="overflow-x-auto overflow-y-auto max-h-[calc(100vh-280px)]">
                <!-- Adjusted max-height for filter buttons -->
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50 sticky top-0">
                        <tr>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider rounded-tl-lg">
                                Order ID</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Customer</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Delivery Date</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                From City</th> <!-- New Column Header -->
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Destination City</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider rounded-tr-lg">
                                Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200" id="deliveryTableBody">
                        <?php foreach ($data['delivery'] as $delivery):
                            $statusClass = '';
                            switch ($delivery['delivery_status']) {
                                case 'Delivered':
                                    $statusClass = 'bg-green-100 text-green-800';
                                    break;
                                case 'Pending':
                                    $statusClass = 'bg-yellow-100 text-yellow-800';
                                    break;
                                case 'In Transit':
                                    $statusClass = 'bg-blue-100 text-blue-800';
                                    break;
                                case 'Cancelled':
                                    $statusClass = 'bg-red-100 text-red-800';
                                    break;
                                case 'Return':
                                    $statusClass = 'bg-purple-100 text-purple-800';
                                    break;
                                default:
                                    $statusClass = 'bg-gray-100 text-gray-800'; // Default neutral color
                                    break;
                            }
                        ?>
                            <tr data-status="<?= htmlspecialchars($delivery['delivery_status']) ?>">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><span><?= htmlspecialchars($delivery['tracking_code']) ?></span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><span><?= htmlspecialchars($delivery['sender_customer_name']) ?></span></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><span><?= htmlspecialchars($delivery['created_at']) ?></span></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><span><?= htmlspecialchars($delivery['sender_agent_city'] ?? 'N/A') ?></span></td> <!-- New Column Data -->
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><span><?= htmlspecialchars($delivery['receiver_agent_city'] ?? 'N/A') ?></span></td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full <?= $statusClass ?>">
                                        <?= htmlspecialchars($delivery['delivery_status']) ?>
                                    </span>
                                </td>
                                <td class="px-4 py-3 whitespace-nowrap">
                                    <a href="<?= URLROOT ?>/agentcontroller/delivery_detail/<?= $delivery['tracking_code'] ?>"
                                        class="text-white bg-[#1F265B] px-4 py-2 rounded hover:bg-[#2A346C] mr-2">
                                        View
                                    </a>
                                    <!-- Edit Button Added Here -->
                                    <a href="<?= URLROOT ?>/agentcontroller/edit_incomedelivery/<?= $delivery['tracking_code'] ?>"
                                        class="text-white bg-blue-500 px-4 py-2 rounded hover:bg-blue-600">
                                        Edit
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
    function viewDeliveryDetails(orderId) {
        console.log("Viewing details for Order ID: " + orderId);
        alert("Viewing details for Order ID: " + orderId);
    }

    function filterDeliveries(event, status) {
        event.preventDefault(); // Prevent default link behavior

        const tableBody = document.getElementById('deliveryTableBody');
        const rows = tableBody.getElementsByTagName('tr');
        const filterLinks = document.querySelectorAll('.filter-link');

        // Remove 'active' class from all links
        filterLinks.forEach(link => {
            link.classList.remove('active');
            link.classList.remove('bg-[#1F265B]', 'text-white');
            link.classList.add('bg-gray-100', 'text-gray-700');
        });

        // Add 'active' class to the clicked link
        event.currentTarget.classList.add('active');
        event.currentTarget.classList.remove('bg-gray-100', 'text-gray-700');
        event.currentTarget.classList.add('bg-[#1F265B]', 'text-white');


        for (let i = 0; i < rows.length; i++) {
            const row = rows[i];
            const rowStatus = row.getAttribute('data-status');

            if (status === 'All' || rowStatus === status) {
                row.style.display = ''; // Show the row
            } else {
                row.style.display = 'none'; // Hide the row
            }
        }
    }

    // Initialize with 'All' deliveries displayed and 'All' button active
    document.addEventListener('DOMContentLoaded', () => {
        const allLink = document.querySelector('.filter-link.active');
        if (allLink) {
            filterDeliveries({
                currentTarget: allLink,
                preventDefault: () => {}
            }, 'All'); // Pass a mock event object
        }
    });
</script>

</body>

</html>