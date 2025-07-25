<?php require_once APPROOT . '/views/inc/agentsidebar.php'; ?>

<!-- Main Content Area -->
<div class="flex-1 flex flex-col overflow-hidden">
    <!-- Header -->
    <header class="flex items-center justify-between p-6 bg-white shadow-md rounded-bl-lg">
        <h1 class="text-3xl font-semibold text-gray-800">Agent Profile</h1>
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

    <!-- Profile Content -->
    <main class="flex-1 overflow-y-auto p-6 bg-gray-100">
        <div class="max-w-4xl mx-auto bg-white p-8 rounded-xl shadow-md">
            <div
                class="flex flex-col md:flex-row items-center md:items-start space-y-6 md:space-y-0 md:space-x-8 mb-8">
                <div class="flex-shrink-0">
                    <!-- Profile image with fixed size -->
                    <img src="https://placehold.co/150x150/1F265B/FFFFFF?text=JD" alt="Agent Profile Picture"
                        class="w-36 h-36 rounded-full border-4 border-[#1F265B] shadow-lg object-cover">
                </div>
                <div class="text-center md:text-left flex-grow">
                    <h2 class="text-4xl font-bold text-gray-900 mb-2">John Doe</h2>
                    <p class="text-xl text-gray-600 mb-4">Delivery Agent</p>
                    <div class="flex items-center justify-center md:justify-start space-x-2 mb-2">
                        <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8m-2 4v7a2 2 0 01-2 2H7a2 2 0 01-2-2v-7"></path>
                        </svg>
                        <p class="text-lg text-gray-700">john.doe@example.com</p>
                    </div>
                    <div class="flex items-center justify-center md:justify-start space-x-2 mb-4">
                        <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                            </path>
                        </svg>
                        <p class="text-lg text-gray-700">+1 (555) 123-4567</p>
                    </div>
                    <span class="px-4 py-2 bg-green-100 text-green-800 rounded-full text-md font-medium">
                        Status: Active
                    </span>
                </div>
            </div>

            <!-- Profile Details Section -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <div>
                    <h3 class="text-2xl font-semibold text-gray-800 mb-4 border-b pb-2">Personal Information</h3>
                    <div class="space-y-3">
                        <p class="text-gray-700"><strong class="font-medium">Agent ID:</strong> #007</p>
                        <p class="text-gray-700"><strong class="font-medium">Date of Birth:</strong> 1990-05-15</p>
                        <p class="text-gray-700"><strong class="font-medium">Address:</strong> 123 Delivery St,
                            Cityville, CA 90210</p>
                        <p class="text-gray-700"><strong class="font-medium">Emergency Contact:</strong> Jane Doe
                            (555) 987-6543</p>
                    </div>
                </div>
                <div>
                    <h3 class="text-2xl font-semibold text-gray-800 mb-4 border-b pb-2">Vehicle Information</h3>
                    <div class="space-y-3">
                        <p class="text-gray-700"><strong class="font-medium">Vehicle Type:</strong> Motorcycle</p>
                        <p class="text-gray-700"><strong class="font-medium">License Plate:</strong> ABC-123</p>
                        <p class="text-700"><strong class="font-medium">Vehicle Model:</strong> Honda CBR500R</p>
                        <p class="text-gray-700"><strong class="font-medium">Insurance Policy:</strong> INS-987654
                        </p>
                    </div>
                </div>
            </div>

            <!-- Edit Profile Form -->
            <h3 class="text-2xl font-semibold text-gray-800 mb-4 border-b pb-2">Edit Profile</h3>
            <form class="space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="fullName" class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                        <input type="text" id="fullName" name="fullName" value="John Doe"
                            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-[#1F265B] focus:border-[#1F265B] sm:text-sm">
                    </div>
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email
                            Address</label>
                        <input type="email" id="email" name="email" value="john.doe@example.com"
                            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-[#1F265B] focus:border-[#1F265B] sm:text-sm">
                    </div>
                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Phone Number</label>
                        <input type="tel" id="phone" name="phone" value="+1 (555) 123-4567"
                            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-[#1F265B] focus:border-[#1F265B] sm:text-sm">
                    </div>
                    <div>
                        <label for="address" class="block text-sm font-medium text-gray-700 mb-1">Address</label>
                        <input type="text" id="address" name="address" value="123 Delivery St, Cityville, CA 90210"
                            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-[#1F265B] focus:border-[#1F265B] sm:text-sm">
                    </div>
                    <div>
                        <label for="vehicleType" class="block text-sm font-medium text-gray-700 mb-1">Vehicle
                            Type</label>
                        <select id="vehicleType" name="vehicleType"
                            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-[#1F265B] focus:border-[#1F265B] sm:text-sm">
                            <option value="Motorcycle" selected>Motorcycle</option>
                            <option value="Car">Car</option>
                            <option value="Van">Van</option>
                        </select>
                    </div>
                    <div>
                        <label for="licensePlate" class="block text-sm font-medium text-gray-700 mb-1">License
                            Plate</label>
                        <input type="text" id="licensePlate" name="licensePlate" value="ABC-123"
                            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-[#1F265B] focus:border-[#1F265B] sm:text-sm">
                    </div>
                </div>
                <div class="flex justify-end space-x-4">
                    <button type="button"
                        class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors duration-200">Cancel</button>
                    <button type="submit"
                        class="px-6 py-2 bg-[#1F265B] text-white rounded-lg hover:bg-[#2A346C] transition-colors duration-200">Save
                        Changes</button>
                </div>
            </form>
        </div>
    </main>
</div>

</body>

</html>