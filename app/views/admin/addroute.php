<body class="flex">

    <?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    session_start();
    require_once APPROOT . '/views/inc/sidebar.php';


    $name = isset($_SESSION['user']) ? $_SESSION['user'] : ['name' => 'Admin', 'id' => '1']; // fallback name with ID


    // This data is for the initial load of regions. Cities and townships will be fetched via AJAX.
    // For demonstration, let's include some dummy data if $data['regions'] is not set by the PHP backend
    if (!isset($data['regions'])) {
        $data['regions'] = [
            ['id' => 1, 'name' => 'Yangon Region'],
            ['id' => 2, 'name' => 'Mandalay Region'],
            ['id' => 3, 'name' => 'Naypyidaw Union Territory'],
            ['id' => 4, 'name' => 'Sagaing Region'],
        ];
    }
    ?>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
    body {
        font-family: 'Inter', sans-serif;
        background-color: #f3f4f6;
    }
    </style>


    <!-- Main Content -->
    <div class="flex-1 p-8 md:ml-64">
        <!-- Topbar -->
        <header class="flex justify-between items-center pb-8 border-b border-gray-300">
            <h1 class="text-3xl font-bold text-gray-800">Create New Route</h1>
            <div class="flex items-center space-x-4">
                <svg class="w-8 h-8 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M5.121 17.804A11.966 11.966 0 0112 15c2.722 0 5.244.975 7.121 2.804M15 11a3 3 0 11-6 0 3 3 0 016 0z">
                    </path>
                </svg>
                <div class="flex flex-col">
                    <span class="text-gray-800 font-semibold"><?= htmlspecialchars($name['name']) ?></span>
                </div>
            </div>
        </header>

        <!-- Form Area -->
        <main class="mt-8 bg-white p-6 rounded-3xl shadow-lg border border-gray-200">
            <div class="space-y-6">

                <form id="routeForm" action="<?= URLROOT; ?>/routepage/createRoute" method="POST">
                    <div class="pb-6 border-b border-gray-300">
                        <h2 class="text-xl font-semibold mb-4 text-gray-800">Define Route</h2>
                        <div class="grid md:grid-cols-2 gap-6">
                            <!-- From Location -->
                            <div class="space-y-4">
                                <h3 class="text-lg font-medium text-gray-700">From Location</h3>
                                <div>
                                    <label for="from-region"
                                        class="block text-sm font-medium text-gray-600 mb-1">Region</label>
                                    <select id="from-region" name="from_region_id"
                                        class="w-full px-4 py-3 rounded-lg border border-gray-300">
                                        <option value="">-- Select Region --</option>
                                        <?php foreach ($data['regions'] as $region): ?>
                                        <option value="<?= $region['id'] ?>"><?= htmlspecialchars($region['name']) ?>
                                        </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div>
                                    <label for="from-city"
                                        class="block text-sm font-medium text-gray-600 mb-1">City</label>
                                    <select id="from-city" name="from_city_id"
                                        class="w-full px-4 py-3 rounded-lg border border-gray-300">
                                        <option value="">-- Select City --</option>
                                    </select>
                                </div>
                                <div>
                                    <label for="from-township"
                                        class="block text-sm font-medium text-gray-600 mb-1">Township</label>
                                    <select id="from-township" name="from_township_id"
                                        class="w-full px-4 py-3 rounded-lg border border-gray-300">
                                        <option value="">-- Select Township --</option>
                                    </select>
                                </div>
                            </div>

                            <!-- To Location -->
                            <div class="space-y-4">
                                <h3 class="text-lg font-medium text-gray-700">To Location</h3>
                                <div>
                                    <label for="to-region"
                                        class="block text-sm font-medium text-gray-600 mb-1">Region</label>

                                    <select id="to-region" name="to_region_id"
                                        class="w-full px-4 py-3 rounded-lg border border-gray-300">
                                        <option value="">-- Select Region --</option>
                                        <?php foreach ($data['regions'] as $region): ?>
                                        <option value="<?= $region['id'] ?>"><?= htmlspecialchars($region['name']) ?>
                                        </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div>
                                    <label for="to-city"
                                        class="block text-sm font-medium text-gray-600 mb-1">City</label>
                                    <select id="to-city" name="to_city_id"
                                        class="w-full px-4 py-3 rounded-lg border border-gray-300">
                                        <option value="">-- Select City --</option>
                                    </select>
                                </div>
                                <div>
                                    <label for="to-township"
                                        class="block text-sm font-medium text-gray-600 mb-1">Township</label>
                                    <select id="to-township" name="to_township_id"
                                        class="w-full px-4 py-3 rounded-lg border border-gray-300">
                                        <option value="">-- Select Township --</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Route Details -->
                    <div class="pt-6">
                        <h2 class="text-xl font-semibold mb-4 text-gray-800">Route Details</h2>
                        <div class="grid md:grid-cols-2 gap-6">
                            <div>
                                <label for="distance" class="block text-sm font-medium text-gray-600 mb-1">Distance
                                    (km)</label>
                                <input type="text" id="distance" name="distance" placeholder="Enter distance in km"
                                    class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-colors">
                            </div>
                            <div>
                                <label for="estimated-time"
                                    class="block text-sm font-medium text-gray-600 mb-1">Estimated
                                    Time (hours)</label>
                                <input type="text" id="estimated-time" name="time"
                                    placeholder="Enter estimated time in hours"
                                    class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-colors">
                            </div>
                        </div>
                    </div>

                    <input type="hidden" name="user_id" value="<?= htmlspecialchars($name['id']) ?>">

                    <?php require APPROOT . '/views/components/auth_message.php'; ?>

                    <!-- Form Actions -->
                    <div class="pt-8 flex justify-end space-x-4">
                        <!-- Cancel Button -->
                        <a href="<?= URLROOT; ?>/routepage"
                            class="px-6 py-3 rounded-xl border border-gray-300 text-gray-700 bg-gray-100 hover:bg-gray-200 transition">
                            Cancel
                        </a>

                        <!-- Create Button -->
                        <button type="submit"
                            class="px-6 py-3 rounded-xl bg-blue-600 text-white font-semibold hover:bg-blue-700 transition">
                            Create
                        </button>
                    </div>
            </div>
            </form>
        </main>
    </div>
    <script>
    document.addEventListener("DOMContentLoaded", () => {
        function fetchData(url, targetSelect, placeholder) {
            fetch(url)
                .then(res => res.json())
                .then(data => {
                    targetSelect.innerHTML = `<option value="">-- Select ${placeholder} --</option>`;
                    data.forEach(item => {
                        targetSelect.innerHTML +=
                            `<option value="${item.id}">${item.name}</option>`;
                    });
                })
                .catch(err => console.error(err));
        }

        function setupCascading(regionId, cityId, townshipId) {
            const region = document.getElementById(regionId);
            const city = document.getElementById(cityId);
            const township = document.getElementById(townshipId);

            region.addEventListener("change", () => {
                let regionValue = region.value;
                if (regionValue) {
                    fetchData("<?= URLROOT; ?>/routepage/getCities?region_id=" + regionValue, city,
                        "City");
                    township.innerHTML = `<option value="">-- Select Township --</option>`;
                }
            });

            city.addEventListener("change", () => {
                let cityValue = city.value;
                if (cityValue) {
                    fetchData("<?= URLROOT; ?>/routepage/getTownships?city_id=" + cityValue, township,
                        "Township");
                }
            });
        }

        // Apply to both From and To
        setupCascading("from-region", "from-city", "from-township");
        setupCascading("to-region", "to-city", "to-township");
    });
    </script>
</body>

</html>