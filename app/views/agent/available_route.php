<?php
// This section is for PHP integration.
// It's assumed that $agent and $data['available_routes'] will be passed from the backend.
// Dummy data is provided for demonstration if PHP variables are not set.

$agent = $_SESSION['user'] ?? ['name' => 'Agent Name', 'id' => 'AGENT001'];

// Example dummy data for available routes
$available_routes = $data['available_routes'] ?? [
    [
        'id' => 1,
        'from_city_name' => 'Yangon',
        'from_township_name' => 'Insein Township',
        'to_city_name' => 'Mandalay',
        'to_township_name' => 'Chanayethazan',
        'distance' => '600.50 km',
        'price' => '50,000 MMK',
        'status' => 'active'
    ],
    [
        'id' => 2,
        'from_city_name' => 'Yangon',
        'from_township_name' => 'South Okkalapa',
        'to_city_name' => 'Yangon',
        'to_township_name' => 'North Okkalapa',
        'distance' => '10.20 km',
        'price' => '2,500 MMK',
        'status' => 'active'
    ],
    [
        'id' => 3,
        'from_city_name' => 'Mandalay',
        'from_township_name' => 'Pyin Oo Lwin Township',
        'to_city_name' => 'Sagaing',
        'to_township_name' => 'Myingyan Township',
        'distance' => '150.75 km',
        'price' => '15,000 MMK',
        'status' => 'inactive'
    ],
    [
        'id' => 4,
        'from_city_name' => 'Yangon',
        'from_township_name' => 'Thanlyin Township',
        'to_city_name' => 'Yangon',
        'to_township_name' => 'Thaketa Township',
        'distance' => '25.00 km',
        'price' => '3,500 MMK',
        'status' => 'active'
    ]
];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agent Available Routes</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Inter Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f3f4f6;
            /* Light gray background */
            margin: 0;
            padding: 0;
            display: flex;
            min-height: 100vh;
        }

        /* Main content area styling */
        .main-content {
            background-color: #ffffff;
            /* White background for the content area */
            padding: 2rem;
            /* Default padding */
            border-radius: 0.75rem;
            /* Rounded corners */
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            /* Soft shadow */
            margin: 2rem auto;
            /* Center horizontally and add vertical margin */
            max-width: 1200px;
            /* Max width for better readability */
            width: 100%;
            /* Ensure it takes full width up to its max-width */
            flex-grow: 1;
            /* Allow it to grow and fill space */
        }

        /* Responsive padding for main content */
        @media (min-width: 640px) {
            .main-content {
                padding: 2.5rem;
            }
        }

        @media (min-width: 768px) {
            .main-content {
                padding: 3rem;
            }
        }

        @media (min-width: 1024px) {
            .main-content {
                padding: 3.5rem;
            }
        }

        /* Table specific styles */
        .table-container {
            overflow-x: auto;
            /* Allows horizontal scrolling for tables on small screens */
            border-radius: 0.5rem;
            border: 1px solid #e2e8f0;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        table {
            width: 100%;
            border-collapse: separate;
            /* Use separate to allow border-radius on cells */
            border-spacing: 0;
        }

        th,
        td {
            padding: 1rem 1.5rem;
            /* Consistent padding for table cells */
            text-align: left;
            border-bottom: 1px solid #e2e8f0;
            /* Light border between rows */
        }

        th {
            background-color: #f8fafc;
            /* Light background for table headers */
            font-weight: 600;
            color: #475569;
            text-transform: uppercase;
            font-size: 0.875rem;
            letter-spacing: 0.05em;
        }

        tr:last-child td {
            border-bottom: none;
            /* No border for the last row */
        }

        tbody tr:hover {
            background-color: #f1f5f9;
            /* Subtle hover effect for rows */
        }

        /* Status badge styling */
        .status-active {
            background-color: #dcfce7;
            /* Light green */
            color: #166534;
            /* Dark green */
            padding: 0.35rem 0.8rem;
            border-radius: 9999px;
            /* Pill shape */
            font-weight: 500;
            font-size: 0.8rem;
            text-transform: uppercase;
        }

        .status-inactive {
            background-color: #fee2e2;
            /* Light red */
            color: #b91c1c;
            /* Dark red */
            padding: 0.35rem 0.8rem;
            border-radius: 9999px;
            font-weight: 500;
            font-size: 0.8rem;
            text-transform: uppercase;
        }

        /* Action button styling */
        .action-button {
            background-color: #4f46e5;
            /* Indigo */
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            font-weight: 500;
            font-size: 0.9rem;
            transition: background-color 0.2s ease, transform 0.1s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .action-button:hover {
            background-color: #4338ca;
            /* Darker indigo */
            transform: translateY(-1px);
        }

        .action-button:active {
            transform: translateY(0);
        }

        /* Styles from the "Deliveries" example for a consistent look */
        .header {
            background-color: #ffffff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border-bottom-left-radius: 0.5rem;
        }

        .main-content-deliveries {
            background-color: #f3f4f6;
            padding: 1.5rem;
        }

        .max-w-6xl {
            max-width: 80rem;
            /* Equivalent to max-w-6xl in Tailwind */
        }

        .mx-auto {
            margin-left: auto;
            margin-right: auto;
        }

        .rounded-xl {
            border-radius: 0.75rem;
        }

        .shadow-md {
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }

        .table-sticky-header thead {
            position: sticky;
            top: 0;
            z-index: 10;
        }

        .table-wrapper {
            overflow-x: auto;
            overflow-y: auto;
            max-height: calc(100vh - 280px);
            /* Adjusted for the header and other elements */
        }

        /* Specific button styling to match the example */
        .delivery-action-button {
            background-color: #1F265B;
            /* Dark blue */
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 0.25rem;
            /* Slightly less rounded */
            transition: background-color 0.2s ease;
        }

        .delivery-action-button:hover {
            background-color: #2A346C;
            /* Darker blue on hover */
        }

        .delivery-edit-button {
            background-color: #3b82f6;
            /* Blue */
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 0.25rem;
            transition: background-color 0.2s ease;
        }

        .delivery-edit-button:hover {
            background-color: #2563eb;
            /* Darker blue on hover */
        }
    </style>
</head>

<body>
    <?php require_once APPROOT . '/views/inc/agentsidebar.php'; ?>

    <div class="flex-1 flex flex-col">
        <!-- Header -->
        <header class="flex items-center justify-between p-6 bg-white shadow-md rounded-bl-lg header">
            <h1 class="text-3xl font-semibold text-gray-800">Available Routes</h1>
            <div class="flex items-center space-x-4">
                <div class="flex items-center space-x-2">
                    <img src="https://placehold.co/40x40/FF6347/FFFFFF?text=JD" alt="Agent Avatar"
                        class="w-10 h-10 rounded-full border-2 border-blue-500">
                    <div>
                        <p class="text-lg font-medium text-gray-800"><?= htmlspecialchars($agent['name']) ?></p>
                        <p class="text-sm text-gray-500">Agent ID: <?= htmlspecialchars($agent['access_code']) ?></p>
                    </div>
                </div>
            </div>
        </header>

        <!-- Main Content Area -->
        <main class="flex-1 overflow-y-auto p-6 bg-gray-100 main-content-deliveries">
            <div class="max-w-6xl mx-auto bg-white p-8 rounded-xl shadow-md">
                <div class="flex flex-col sm:flex-row justify-between items-center mb-8 gap-4">
                    <h2 class="text-2xl font-bold text-gray-800">Route List</h2>
                    <div class="flex flex-col sm:flex-row gap-3 w-full sm:w-auto">
                        <input type="text" id="routeSearchInput" placeholder="Search by city or township..."
                            class="p-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500 w-full sm:w-64">
                        <button id="searchRouteBtn" class="delivery-action-button">
                            <i class="fas fa-search"></i> Search
                        </button>
                    </div>
                </div>

                <div class="table-wrapper">
                    <table class="min-w-full divide-y divide-gray-200 table-sticky-header" id="routeTable">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider rounded-tl-lg">From City</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">From Township</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">To City</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">To Township</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Distance</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider rounded-tr-lg">Status</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200" id="routeTableBody">
                            <?php if (!empty($available_routes)): ?>
                                <?php foreach ($available_routes as $route): ?>
                                    <?php
                                    $statusClass = ($route['status'] === 'active') ? 'status-active' : 'status-inactive';
                                    ?>
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><?= htmlspecialchars($route['from_city'] ?? 'N/A') ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= htmlspecialchars($route['from_township'] ?? 'N/A') ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= htmlspecialchars($route['to_city'] ?? 'N/A') ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= htmlspecialchars($route['to_township'] ?? 'N/A') ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= htmlspecialchars($route['distance'] ?? 'N/A') ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= htmlspecialchars($route['price'] ?? 'N/A') ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full <?= $statusClass ?>">
                                                <?= htmlspecialchars($route['status'] ?? 'N/A') ?>
                                            </span>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="7" class="text-center py-6 text-gray-500">No routes available.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('routeSearchInput');
            const searchButton = document.getElementById('searchRouteBtn');
            const tableBody = document.getElementById('routeTableBody');
            const rows = tableBody.getElementsByTagName('tr');

            function filterTable() {
                const filter = searchInput.value.toLowerCase();
                for (let i = 0; i < rows.length; i++) {
                    let row = rows[i];
                    // Get all cells in the current row
                    let cells = row.getElementsByTagName('td');
                    let rowText = '';
                    // Concatenate text content of relevant cells for searching
                    if (cells.length > 0) {
                        rowText += cells[0].textContent.toLowerCase(); // From City
                        rowText += cells[1].textContent.toLowerCase(); // From Township
                        rowText += cells[2].textContent.toLowerCase(); // To City
                        rowText += cells[3].textContent.toLowerCase(); // To Township
                    }

                    if (rowText.includes(filter)) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                }
            }

            // Attach event listener to the search button
            searchButton.addEventListener('click', filterTable);

            // Optional: Add event listener for live search as user types
            searchInput.addEventListener('keyup', filterTable);
        });
    </script>
</body>

</html>