<?php require_once APPROOT . '/views/inc/agentsidebar.php'; ?>


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
                    <p class="text-lg font-medium text-gray-800">John Doe</p>
                    <p class="text-sm text-gray-500">Agent ID: #007</p>
                </div>
            </div>
            <a href="#"
                class="px-4 py-2 bg-[#1F265B] text-white rounded-lg hover:bg-[#2A346C] transition-colors duration-200">Back
                to Dashboard</a>
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
                                Status</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Earnings</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider rounded-tr-lg">
                                Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200" id="deliveryTableBody">
                        <!-- Sample Data - Statuses updated to match filter options -->
                        <tr data-status="Delivered">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">#ORD0998</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Michael Scott</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">2024-07-24</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full status-delivered">
                                    Delivered
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">$15.00</td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <button onclick="viewDeliveryDetails('ORD0998')"
                                    class="px-4 py-2 bg-[#1F265B] text-white rounded-lg hover:bg-[#2A346C] transition-colors duration-200">
                                    View
                                </button>
                            </td>
                        </tr>
                        <tr data-status="In Transit">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">#ORD0997</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Pam Beesly</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">2024-07-23</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full status-intransit">
                                    In Transit
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">$12.50</td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <button onclick="viewDeliveryDetails('ORD0997')"
                                    class="px-4 py-2 bg-[#1F265B] text-white rounded-lg hover:bg-[#2A346C] transition-colors duration-200">
                                    View
                                </button>
                            </td>
                        </tr>
                        <tr data-status="Pending">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">#ORD0996</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Dwight Schrute</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">2024-07-22</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full status-pending">
                                    Pending
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">$20.00</td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <button onclick="viewDeliveryDetails('ORD0996')"
                                    class="px-4 py-2 bg-[#1F265B] text-white rounded-lg hover:bg-[#2A346C] transition-colors duration-200">
                                    View
                                </button>
                            </td>
                        </tr>
                        <tr data-status="Delivered">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">#ORD0995</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Jim Halpert</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">2024-07-21</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full status-delivered">
                                    Delivered
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">$18.75</td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <button onclick="viewDeliveryDetails('ORD0995')"
                                    class="px-4 py-2 bg-[#1F265B] text-white rounded-lg hover:bg-[#2A346C] transition-colors duration-200">
                                    View
                                </button>
                            </td>
                        </tr>
                        <tr data-status="Cancelled">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">#ORD0994</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Angela Martin</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">2024-07-20</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full status-cancelled">
                                    Cancelled
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">$10.00</td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <button onclick="viewDeliveryDetails('ORD0994')"
                                    class="px-4 py-2 bg-[#1F265B] text-white rounded-lg hover:bg-[#2A346C] transition-colors duration-200">
                                    View
                                </button>
                            </td>
                        </tr>
                        <tr data-status="Return">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">#ORD0993</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Andy Bernard</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">2024-07-19</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full status-return">
                                    Return
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">$5.00</td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <button onclick="viewDeliveryDetails('ORD0993')"
                                    class="px-4 py-2 bg-[#1F265B] text-white rounded-lg hover:bg-[#2A346C] transition-colors duration-200">
                                    View
                                </button>
                            </td>
                        </tr>
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