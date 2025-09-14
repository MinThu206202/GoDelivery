   <?php require_once APPROOT . '/views/inc/sidebar.php'; ?>
   <script src="https://cdn.tailwindcss.com"></script>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
   <style>
@import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');

body {
    font-family: 'Inter', sans-serif;
    background-color: #f1f5f9;
}

.bg-custom-blue {
    background-color: #1F265B;
}
   </style>

   <!-- Main Content -->
   <main class="flex-1 p-6 space-y-6 md:ml-64">
       <!-- Top Nav -->
       <header class="bg-white p-4 rounded-lg shadow-md flex items-center justify-between">
           <div class="flex items-center space-x-2">
               <i class="fas fa-user-tie text-2xl text-gray-600"></i>
               <h2 class="text-xl font-semibold text-gray-800">Agent</h2>
           </div>
           <div class="flex items-center space-x-2">
               <i class="fas fa-user-circle text-2xl text-gray-600"></i>
               <span class="hidden md:inline-block font-medium"> <?= htmlspecialchars($_SESSION['user']['name']) ?>
               </span>
           </div>
       </header>

       <!-- Agent List Table -->
       <div class="bg-white p-6 rounded-lg shadow-md">
           <div class="flex justify-between items-center mb-4">
               <h3 class="text-xl font-semibold text-gray-800">Agent List</h3>
               <button onclick="window.location='<?= URLROOT; ?>/admin/pickupagentlist';"
                   class="bg-indigo-600 text-white font-semibold py-2 px-4 rounded-lg hover:bg-indigo-700 transition-colors duration-200">
                   View Pickup Agent
               </button>

           </div>

           <!-- Scrollable container -->
           <div class="overflow-x-auto">
               <div class="max-h-[500px] overflow-y-auto">
                   <table class="w-full text-left table-auto border-collapse">
                       <thead class="sticky top-0 z-10 bg-custom-blue">
                           <tr>
                               <th class="px-4 py-3 font-medium text-white text-sm">NAME</th>
                               <th class="px-4 py-3 font-medium text-white text-sm">EMAIL</th>
                               <th class="px-4 py-3 font-medium text-white text-sm">CITY</th>
                               <th class="px-4 py-3 font-medium text-white text-sm">ACCESS CODE</th>
                               <th class="px-4 py-3 font-medium text-white text-sm">STATUS</th>
                               <th class="px-4 py-3 font-medium text-white text-sm">VIEW</th>
                           </tr>
                       </thead>
                       <tbody class="divide-y divide-gray-200">
                           <?php if (!empty($data['allUserData'])): ?>
                           <?php foreach ($data['allUserData'] as $agent): ?>
                           <tr class="hover:bg-gray-50">
                               <td class="px-4 py-3 text-sm text-gray-800"><?= htmlspecialchars($agent['name']) ?></td>
                               <td class="px-4 py-3 text-sm text-gray-800"><?= htmlspecialchars($agent['email']) ?>
                               </td>
                               <td class="px-4 py-3 text-sm text-gray-800"><?= htmlspecialchars($agent['city_name']) ?>
                               </td>
                               <td class="px-4 py-3 text-sm text-gray-800">
                                   <?= htmlspecialchars($agent['security_code'] ?? 'N/A') ?></td>
                               <td class="px-4 py-3 text-sm">
                                   <?php
                                            $statusClass = ($agent['status_name'] === 'Active')
                                                ? 'bg-green-100 text-green-700'
                                                : 'bg-red-100 text-red-700';
                                            ?>

                                   <span class="px-2 py-1 rounded-full text-xs font-semibold <?= $statusClass ?>">
                                       <?= htmlspecialchars($agent['status_name']) ?>
                                   </span>

                               </td>
                               <td class="px-4 py-3 text-sm">
                                   <a href="<?php echo URLROOT; ?>/admincontroller/agent_profile?id=<?php echo $agent['id']; ?>"
                                       class="inline-block bg-blue-500 text-white px-3 py-1 rounded-lg text-xs font-bold hover:bg-blue-600 transition">
                                       View
                                   </a>
                               </td>
                           </tr>
                           <?php endforeach; ?>
                           <?php else: ?>
                           <tr>
                               <td colspan="6" class="px-5 py-4 text-center text-sm text-gray-500">No agent data
                                   available.</td>
                           </tr>
                           <?php endif; ?>
                       </tbody>
                   </table>
               </div>
           </div>
       </div>

   </main>
   </body>

   </html>