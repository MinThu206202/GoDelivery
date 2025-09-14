<?php require_once APPROOT . '/views/inc/sidebar.php';
?>
<script src="https://cdn.tailwindcss.com"></script>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<style>
body {
    font-family: 'Inter', sans-serif;
    background-color: #f3f4f6;
}

.sidebar a {
    position: relative;
    transition: all 0.3s ease;
}

.sidebar a.active-sidebar-link {
    background-color: #fff;
    color: #1F265B;
    font-weight: 600;
}

.sidebar a.active-sidebar-link::before,
.sidebar a:not(.active-sidebar-link):hover::before {
    content: '';
    position: absolute;
    left: 0;
    top: 0;
    height: 100%;
    width: 8px;
    background-color: #FBBF24;
    border-top-left-radius: 4px;
    border-bottom-left-radius: 4px;
}

.sidebar a:not(.active-sidebar-link):hover {
    background-color: #fef3c7;
    color: #1F265B;
}
</style>


<!-- Main Content -->
<main class="flex-1 p-8 md:ml-64">
    <!-- Top Header -->
    <header class="bg-white rounded-xl shadow-lg p-4 flex justify-between items-center mb-6">
        <h1 class="text-xl font-semibold text-gray-800">Profile</h1>
        <div class="flex items-center">
            <span class="mr-2 text-gray-700">Min Thu</span>
            <div class="w-10 h-10 rounded-full bg-gray-200 flex items-center justify-center text-gray-500">
                <i class="fas fa-user"></i>
            </div>
        </div>
    </header>

    <!-- Profile Summary Section -->
    <div class="bg-white rounded-xl shadow-lg p-6 mb-6">
        <div class="flex items-center">
            <!-- Profile Avatar -->
            <div
                class="w-16 h-16 rounded-full bg-blue-700 text-white flex items-center justify-center text-2xl font-bold mr-6">
                A
            </div>

            <!-- Profile Info -->
            <div class="flex-1 grid grid-cols-1 md:grid-cols-2 gap-6 items-center">
                <!-- Name -->
                <div>
                    <p class="text-gray-500 text-sm">Name</p>
                    <p class="font-medium text-gray-800">Min Thu</p>
                </div>

                <!-- Phone -->
                <div>
                    <p class="text-gray-500 text-sm">Phone</p>
                    <p class="font-medium text-gray-800">09441386930</p>
                </div>

                <!-- Code -->
                <div>
                    <p class="text-gray-500 text-sm">Code</p>
                    <p class="font-medium text-gray-800">mint206202@gmail.com</p>
                </div>

                <!-- Role -->
                <div>
                    <p class="text-gray-500 text-sm">Role</p>
                    <p class="font-medium text-gray-800">Agent</p>
                </div>
            </div>

            <!-- Update Button -->
            <button
                class="bg-blue-600 text-white py-2 px-4 rounded-lg shadow-md hover:bg-blue-700 transition-colors ml-6">
                Update Info
            </button>
        </div>
    </div>


    <!-- Tabs Section -->
    <div class="bg-white rounded-xl shadow-lg p-6">
        <div class="flex border-b border-gray-200 mb-6">
            <button id="personal-info-tab" data-tab-target="personal-info"
                class="tab-button py-2 px-4 text-sm font-medium border-b-2 border-blue-600 text-blue-600 -mb-px">
                Personal Information
            </button>
            <button id="change-password-tab" data-tab-target="change-password"
                class="tab-button py-2 px-4 text-sm font-medium text-gray-500 hover:text-gray-700 -mb-px">
                Change Password
            </button>
        </div>

        <!-- Tab Content Sections -->
        <div id="personal-info-content" class="tab-content">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Full Name -->
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2">Full Name</label>
                    <input type="text" value="Aung Aung"
                        class="shadow appearance-none border rounded-lg w-full py-2 px-3 text-gray-700 bg-gray-100"
                        readonly>
                </div>
                <!-- Phone Number -->
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2">Phone Number</label>
                    <input type="text" value="09123456789"
                        class="shadow appearance-none border rounded-lg w-full py-2 px-3 text-gray-700 bg-gray-100"
                        readonly>
                </div>
                <!-- Code -->
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2">Code</label>
                    <input type="text" value="GDAGENT007"
                        class="shadow appearance-none border rounded-lg w-full py-2 px-3 text-gray-700 bg-gray-100"
                        readonly>
                </div>
                <!-- Region -->
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2">Region</label>
                    <input type="text" value="Yangon"
                        class="shadow appearance-none border rounded-lg w-full py-2 px-3 text-gray-700 bg-gray-100"
                        readonly>
                </div>
                <!-- Address -->
                <div class="md:col-span-2">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Address</label>
                    <textarea
                        class="shadow appearance-none border rounded-lg w-full py-2 px-3 text-gray-700 bg-gray-100"
                        readonly>No. 123, Main Street, Yangon, Myanmar</textarea>
                </div>
            </div>
        </div>

        <div id="change-password-content" class="tab-content hidden">
            <div>
                <h2 class="text-xl font-bold mb-4">Change Password</h2>
                <p class="text-gray-600 mb-6">Create a strong password to protect your account.</p>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="current-password">
                        Current Password
                    </label>
                    <input
                        class="shadow appearance-none border rounded-lg w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="current-password" type="password" placeholder="Enter your current password">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="new-password">
                        New Password
                    </label>
                    <input
                        class="shadow appearance-none border rounded-lg w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="new-password" type="password" placeholder="Enter your new password">
                </div>
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="confirm-password">
                        Confirm New Password
                    </label>
                    <input
                        class="shadow appearance-none border rounded-lg w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="confirm-password" type="password" placeholder="Confirm your new password">
                </div>
                <button
                    class="bg-blue-600 text-white py-2 px-4 rounded-lg shadow-md hover:bg-blue-700 w-full transition-colors">
                    Change Password
                </button>
            </div>
        </div>
    </div>
</main>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const tabs = document.querySelectorAll('.tab-button');
    const contents = document.querySelectorAll('.tab-content');

    tabs.forEach(tab => {
        tab.addEventListener('click', () => {
            const targetId = tab.getAttribute('data-tab-target');

            // Deactivate all tabs and content
            tabs.forEach(t => {
                t.classList.remove('border-blue-600', 'text-blue-600');
                t.classList.add('text-gray-500', 'hover:text-gray-700');
            });
            contents.forEach(c => c.classList.add('hidden'));

            // Activate the clicked tab and its corresponding content
            tab.classList.remove('text-gray-500', 'hover:text-gray-700');
            tab.classList.add('border-blue-600', 'text-blue-600');
            document.getElementById(targetId + '-content').classList.remove('hidden');
        });
    });
});
</script>
</body>

</html>