<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Placeholder for PHP include. In a real environment, you would use this.
require_once APPROOT . '/views/inc/nav.php'
?>

<style>
    /* Custom CSS variables from the original file */
    :root {
        --primary-color: #1F265B;
        --secondary-color: #333;
        --text-color: #555;
        --heading-color: #333;
        --light-grey: #f8f8f8;
        --dark-blue-footer: #1a237e;
        --white: #fff;
        --border-color: #ddd;
        --form-bg-color: #e6f0ff;
        --section-bg-color: #f0f4f7;
    }

    body {
        font-family: 'Poppins', sans-serif;
    }

    .header-bg {
        background-color: var(--primary-color);
    }

    .footer-bg {
        background-color: var(--dark-blue-footer);
    }

    /* Custom scrollbar for better visual on webkit browsers */
    .overflow-x-auto::-webkit-scrollbar {
        height: 8px;
    }

    .overflow-x-auto::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 10px;
    }

    .overflow-x-auto::-webkit-scrollbar-thumb {
        background: var(--primary-color);
        border-radius: 10px;
    }

    .overflow-x-auto::-webkit-scrollbar-thumb:hover {
        background: #0056b3;
    }
</style>


<!-- Main Content -->
<main class="flex-1 p-8 md:p-16 flex flex-col items-center">
    <!-- Breadcrumbs -->
    <div class="mb-8 text-gray-600">
        <a href="#" class="hover:underline">Home</a> &gt; Pickup History
    </div>

    <!-- History Section -->
    <!-- Added overflow-x-auto class to make the table horizontally scrollable -->
    <div class="bg-white p-8 md:p-12 rounded-xl shadow-lg w-full max-w-full overflow-x-auto">
        <h2 class="text-center text-4xl font-semibold text-gray-800 mb-8">Pickup History</h2>

        <div class="w-full">
            <table class="min-w-full divide-y divide-gray-200" id="historyTable">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Tracking ID</th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Requested on</th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Pickup Address</th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Receiver Info</th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Status</th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200" id="historyTableBody">
                    <!-- Static Data for Demonstration -->
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">GD-78901234</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">2023-10-26 10:30 AM</td>
                        <!-- This is the updated Pickup Address column -->
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            <strong>Region:</strong> Myanmar<br>
                            <strong>City:</strong> Yangon<br>
                            <strong>Township:</strong> Bahan Township
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            <strong>Name:</strong> Jane Smith<br>
                            <strong>Phone:</strong> 09-987-654321<br>
                            <strong>Address:</strong> 456 Oak Ave, Somewher, USA
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                            <span
                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Pending</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <button class="text-indigo-600 hover:text-indigo-900">View</button>
                        </td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">GD-12345678</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">2023-10-25 03:00 PM</td>
                        <!-- This is the updated Pickup Address column -->
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            <strong>Region:</strong> Thailand<br>
                            <strong>City:</strong> Bangkok<br>
                            <strong>Township:</strong> Khet Din Daeng
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            <strong>Name:</strong> Bob Johnson<br>
                            <strong>Phone:</strong> 09-345-678901<br>
                            <strong>Address:</strong> 101 Cedar Rd, C-town, USA
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                            <span
                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Completed</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <button class="text-indigo-600 hover:text-indigo-900">View</button>
                        </td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">GD-87654321</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">2023-10-24 11:15 AM</td>
                        <!-- This is the updated Pickup Address column -->
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            <strong>Region:</strong> Vietnam<br>
                            <strong>City:</strong> Hanoi<br>
                            <strong>Township:</strong> Cau Giay
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            <strong>Name:</strong> Diana Prince<br>
                            <strong>Phone:</strong> 09-567-890123<br>
                            <strong>Address:</strong> 202 Birch Blvd, E-city, USA
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                            <span
                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">In
                                Transit</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <button class="text-indigo-600 hover:text-indigo-900">View</button>
                        </td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">GD-54321098</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">2023-10-23 09:00 AM</td>
                        <!-- This is the updated Pickup Address column -->
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            <strong>Region:</strong> Indonesia<br>
                            <strong>City:</strong> Jakarta<br>
                            <strong>Township:</strong> Kebayoran Baru
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            <strong>Name:</strong> Frank White<br>
                            <strong>Phone:</strong> 09-789-012345<br>
                            <strong>Address:</strong> 303 Cherry St, G-town, USA
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                            <span
                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Canceled</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <button class="text-indigo-600 hover:text-indigo-900">View</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</main>

<!-- Footer Section -->
<footer class="footer-bg text-white p-8 md:p-12">
    <div class="container mx-auto">
        <div class="flex flex-col md:flex-row justify-between items-center text-center md:text-left">
            <div class="mb-6 md:mb-0 md:w-1/2">
                <h2 class="text-3xl font-bold mb-2">Contact Us</h2>
                <h3 class="text-5xl font-extrabold mb-4">Fast, Affordable, And Always On Time.</h3>
                <p class="text-sm leading-relaxed mb-4">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Egestas semper sit integer et. At
                    aliquam tortor lectus commodo ut lectus sed fermentum. Cursus in tincidunt cursus viverra diam.
                    Praesent feugiat dolor ipsum pharetra laoreet vulputate pellentesque sed.
                </p>
                <div class="flex justify-center md:justify-start items-center space-x-4">
                    <a href="#"
                        class="flex items-center space-x-2 bg-white text-gray-800 font-semibold py-2 px-4 rounded-full hover:bg-gray-200 transition-colors duration-200">
                        <span>Contact Now</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                                clip-rule="evenodd" />
                        </svg>
                    </a>
                    <a href="#" class="text-white hover:text-gray-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
                            <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                            <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
                        </svg>
                    </a>
                    <a href="#" class="text-white hover:text-gray-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="currentColor">
                            <path
                                d="M19 0H5a5 5 0 0 0-5 5v14a5 5 0 0 0 5 5h14a5 5 0 0 0 5-5V5a5 5 0 0 0-5-5zm-3 7h-2c-1.087 0-1.85.602-1.85 2.056V11h3l-.48 3H12v8h-3v-8H7V11h2.02v-1.487c0-1.876 1.13-2.915 3.17-2.915h3.81V7z" />
                        </svg>
                    </a>
                </div>
            </div>
            <div class="hidden md:block">
                <!-- Placeholder for the image -->
                <svg xmlns="http://www.w3.org/2000/svg" class="h-48 w-48 text-white opacity-25" viewBox="0 0 24 24"
                    fill="currentColor">
                    <path
                        d="M4 3h16a2 2 0 012 2v14a2 2 0 01-2 2H4a2 2 0 01-2-2V5a2 2 0 012-2zM4 5v14h16V5H4zm2 1.5a1.5 1.5 0 100 3 1.5 1.5 0 000-3zM18 17H6l4-4 4 4 4-4v4z" />
                </svg>
            </div>
        </div>
    </div>
</footer>
</body>

</html>