<?php require_once APPROOT . '/views/inc/agentsidebar.php';
$pickup = $data['pickupagent'];
?>
<style>
    body {
        font-family: 'Inter', sans-serif;
        background-color: #f3f4f6;
    }

    .status-badge {
        padding: 0.25rem 0.75rem;
        font-size: 0.75rem;
        font-weight: 600;
        border-radius: 9999px;
        text-align: center;
    }

    .status-active {
        background-color: #d1fae5;
        color: #065f46;
    }

    .status-inactive {
        background-color: #fee2e2;
        color: #991b1b;
    }

    .modal {
        position: fixed;
        z-index: 1000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        display: none;
        justify-content: center;
        align-items: center;
    }

    .modal-content {
        background-color: #fff;
        padding: 2rem;
        border-radius: 0.75rem;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        max-width: 400px;
        text-align: center;
    }

    #flashMessage {
        transition: all 0.5s ease;
    }

    #flashMessage.hide {
        opacity: 0;
        transform: translateY(-20px);
    }
</style>


<body class="flex flex-col min-h-screen">
    <!-- Main Content Area -->
    <div class="flex-1 flex flex-col overflow-hidden">
        <!-- Header -->
        <header class="flex items-center justify-between p-6 bg-white shadow-md rounded-bl-lg">
            <h1 class="text-3xl font-semibold text-gray-800">Agent Details</h1>
            <div x-data="{ open: false }" class="relative">
                <!-- Button-like Trigger -->
                <button @click="open = !open"
                    class="flex items-center space-x-2 bg-white border border-gray-300 px-4 py-2 rounded-lg shadow-sm hover:bg-gray-100 transition">
                    <img src="/Delivery/<?= htmlspecialchars($agent['profile_image']) ?>" alt="Agent Avatar"
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
                <div x-show="open" @click.away="open = false" x-transition
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

        <?php
        // session_start();
        if (isset($_SESSION['flash_message'])):
            $flash = $_SESSION['flash_message'];
            unset($_SESSION['flash_message']);
        ?>
            <div id="flashMessage" class="fixed top-4 left-1/2 transform -translate-x-1/2 
            px-6 py-3 rounded shadow-md text-white font-medium 
            <?= $flash['type'] === 'success' ? 'bg-green-500' : 'bg-red-500' ?>">
                <?= htmlspecialchars($flash['message']) ?>
            </div>

            <script>
                setTimeout(() => {
                    const flash = document.getElementById('flashMessage');
                    if (flash) flash.style.display = 'none';
                }, 4000); // Hide after 4 seconds
            </script>
        <?php endif; ?>


        <!-- Agent Details Content -->
        <main class="flex-1 overflow-y-auto p-6 bg-gray-100">
            <div class="max-w-4xl mx-auto bg-white p-8 rounded-xl shadow-md">
                <div class="flex justify-between items-center mb-6">
                    <h2 id="agentNameHeader" class="text-2xl font-semibold text-gray-800">
                        <?= htmlspecialchars($pickup['name']) ?>'s Details</h2>
                    <div class="flex space-x-2">
                        <?php
                        $status = strtolower($pickup['status_name']);
                        if ($status === 'active') {
                            $buttonText = 'Deactivate';
                            $buttonClass = 'bg-red-500 hover:bg-red-600';
                        } else {
                            $buttonText = 'Activate';
                            $buttonClass = 'bg-green-500 hover:bg-green-600';
                        }
                        ?>
                        <button id="activateButton"
                            class="px-4 py-2 <?= $buttonClass ?> text-white rounded-lg text-sm font-medium transition-colors duration-200">
                            <?= $buttonText ?>
                        </button>
                        <a href="<?php echo URLROOT; ?>/agent/pickupagentlist"
                            class="px-4 py-2 bg-[#1F265B] text-white rounded-lg text-sm font-medium hover:bg-[#2A346C] transition-colors duration-200">
                            Back to List
                        </a>
                    </div>
                </div>

                <!-- Profile and Basic Information -->
                <div class="border-b border-gray-200 pb-6 mb-6">
                    <h3 class="text-xl font-semibold text-gray-700 mb-4">Basic Information</h3>
                    <div
                        class="flex flex-col md:flex-row items-center md:items-start space-y-4 md:space-y-0 md:space-x-8">
                        <div class="flex-shrink-0">
                            <img id="profileImage" src="https://placehold.co/120x120/4f46e5/ffffff?text=JD"
                                alt="Agent Profile" class="w-24 h-24 rounded-full border-2 border-gray-300">
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-8 gap-y-4 w-full">
                            <div>
                                <p class="text-sm font-medium text-gray-500">Full Name</p>
                                <p id="fullName" class="text-gray-900 font-semibold text-lg">
                                    <?= htmlspecialchars($pickup['name']) ?></p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Phone Number</p>
                                <p id="phoneNumber" class="text-gray-900 font-semibold">
                                    <?= htmlspecialchars($pickup['phone']) ?></p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Email</p>
                                <p id="email" class="text-gray-900"><?= htmlspecialchars($pickup['email']) ?></p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Security Code / Username</p>
                                <p id="securityCode" class="text-gray-900">
                                    <?= htmlspecialchars($pickup['access_code']) ?></p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Status</p>
                                <?php
                                $status = strtolower($pickup['status_name']);
                                switch ($status) {
                                    case 'active':
                                        $statusClass = 'bg-green-100 text-green-800';
                                        break;
                                    case 'inactive':
                                        $statusClass = 'bg-red-100 text-red-800';
                                        break;
                                    default:
                                        $statusClass = 'bg-gray-100 text-gray-800'; // fallback
                                }
                                ?>
                                <span id="status"
                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full <?= $statusClass ?>">
                                    <?= htmlspecialchars($pickup['status_name']) ?>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Work Information -->
                <div class="border-b border-gray-200 pb-6 mb-6">
                    <h3 class="text-xl font-semibold text-gray-700 mb-4">Work Information</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Assigned Vehicle</p>
                            <div class="text-gray-900 font-medium">
                                <p><strong>Type:</strong> <?= htmlspecialchars($pickup['make']) ?></p>
                                <p><strong>Color:</strong> <?= htmlspecialchars($pickup['color']) ?></p>
                                <p><strong>Plate:</strong> <?= htmlspecialchars($pickup['plate_number']) ?></p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Performance / Activity -->
                <div>
                    <h3 class="text-xl font-semibold text-gray-700 mb-4">Performance / Activity</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <!-- Total Pickups -->
                        <div
                            class="bg-white p-6 rounded-xl shadow-md transition-shadow duration-300 hover:shadow-lg cursor-pointer">
                            <p class="text-sm font-medium text-gray-500">Total Pickups Assigned</p>
                            <p id="totalPickups" class="text-gray-900 font-bold text-3xl mt-2">25</p>
                        </div>
                        <!-- Completed Pickups -->
                        <div
                            class="bg-white p-6 rounded-xl shadow-md transition-shadow duration-300 hover:shadow-lg cursor-pointer">
                            <p class="text-sm font-medium text-gray-500">Completed Pickups</p>
                            <p id="completedPickups" class="text-gray-900 font-bold text-3xl mt-2">23</p>
                        </div>
                        <!-- Pending Pickups -->
                        <div
                            class="bg-white p-6 rounded-xl shadow-md transition-shadow duration-300 hover:shadow-lg cursor-pointer">
                            <p class="text-sm font-medium text-gray-500">Pending Pickups</p>
                            <p id="pendingPickups" class="text-gray-900 font-bold text-3xl mt-2">2</p>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- Confirmation Modal -->
    <script>
        const activateButton = document.getElementById('activateButton');
        const statusElement = document.getElementById('status');
        // flash.classList.add('hide');


        activateButton.addEventListener('click', () => {
            let newStatus = statusElement.textContent.trim() === 'Active' ? 'Inactive' : 'Active';
            statusElement.textContent = newStatus;

            statusElement.classList.toggle('status-active', newStatus === 'Active');
            statusElement.classList.toggle('status-inactive', newStatus === 'Inactive');

            // Redirect immediately with access_code + new status
            window.location.href =
                "<?php echo URLROOT; ?>/agentcontroller/updatestatuspickupagent?access_code=<?= $pickup['access_code'] ?>&status=" +
                newStatus;
        });
    </script>



</body>

</html>