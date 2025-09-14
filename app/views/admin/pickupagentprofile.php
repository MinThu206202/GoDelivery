   <?php require_once APPROOT . '/views/inc/sidebar.php';
    $pickupagent = $data['fullinfo'];
    ?>
   <link rel="preconnect" href="https://fonts.googleapis.com">
   <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
   <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
   <script src="https://cdn.tailwindcss.com"></script>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
   <style>
body {
    font-family: 'Inter', sans-serif;
    background-color: #f1f5f9;
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
    /* Increased from 4px to 8px */
    background-color: #FBBF24;
    /* Yellow bar */
    border-top-left-radius: 4px;
    border-bottom-left-radius: 4px;
}


.sidebar a:not(.active-sidebar-link):hover {
    background-color: #fef3c7;
    /* Light yellow hover */
    color: #1F265B;
}

.sidebar a:not(.active-sidebar-link):hover::before {
    content: '';
    position: absolute;
    left: 0;
    top: 0;
    height: 100%;
    width: 8px;
    /* Increased from 4px to 8px */
    background-color: #FBBF24;
    /* Yellow bar */
    border-top-left-radius: 4px;
    border-bottom-left-radius: 4px;
}
   </style>

   <!-- Main Content -->
   <div class="flex-1 p-8 md:ml-64">
       <!-- Topbar -->
       <header class="flex justify-between items-center pb-8 border-b border-gray-300">
           <h1 class="text-3xl font-bold text-gray-800">Agent Approval</h1>
           <div class="flex items-center space-x-4">
               <i class="fas fa-user-circle text-gray-500 text-3xl"></i>
               <div class="flex flex-col">
                   <span class="text-gray-800 font-semibold">Min Thu</span>
               </div>
           </div>
       </header>

       <!-- Main Panel -->
       <main class="mt-8 bg-white p-6 rounded-3xl shadow-lg border border-gray-200">
           <h2 class="text-xl font-semibold mb-6 text-gray-800">Review Agent Application</h2>

           <div class="space-y-6">
               <!-- Agent Details Card -->
               <!-- Agent Details Card -->
               <div class="bg-gray-50 p-6 rounded-2xl border border-gray-200 shadow-sm">
                   <div class="flex items-center justify-between mb-4">
                       <div class="flex items-center space-x-4">
                           <img src="https://placehold.co/64x64/E2E8F0/1F2937?text=PJ" alt="Profile Picture"
                               class="w-16 h-16 rounded-full border-2 border-gray-300">
                           <div>
                               <h3 class="text-2xl font-bold text-gray-800">
                                   <?= htmlspecialchars($pickupagent['name']) ?>
                               </h3>
                               <p class="text-sm text-gray-500">Agent ID:
                                   <?= htmlspecialchars($pickupagent['access_code']) ?></p>
                           </div>
                       </div>

                       <!-- Action Buttons beside name -->
                       <div class="flex space-x-3">
                           <a href="<?= URLROOT; ?>/admincontroller/rejectpickupagent?id=<?= urlencode($pickupagent['id']) ?>"
                               class="px-6 py-2 bg-red-600 text-white font-semibold rounded-lg shadow hover:bg-red-700 transition-colors">
                               Reject
                           </a>

                           <a href="<?= URLROOT; ?>/admincontroller/acceptpickupagent?id=<?= urlencode($pickupagent['id']) ?>"
                               class="px-6 py-2 bg-green-600 text-white font-semibold rounded-lg shadow hover:bg-green-700 transition-colors">
                               Accept
                           </a>
                       </div>

                   </div>

                   <!-- Agent Info Grid -->
                   <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                       <div>
                           <p class="text-sm font-semibold text-gray-600">Email Address</p>
                           <p class="text-gray-800"><?= htmlspecialchars($pickupagent['email']) ?></p>
                       </div>
                       <div>
                           <p class="text-sm font-semibold text-gray-600">Phone Number</p>
                           <p class="text-gray-800"><?= htmlspecialchars($pickupagent['phone']) ?></p>
                       </div>
                       <div>
                           <p class="text-sm font-semibold text-gray-600">Applied Date</p>
                           <p class="text-gray-800"><?= htmlspecialchars($pickupagent['created_at']) ?></p>
                       </div>
                       <div>
                           <p class="text-sm font-semibold text-gray-600">Status</p>
                           <span
                               class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800"><?= htmlspecialchars($pickupagent['status_name']) ?></span>
                       </div>
                       <div>
                           <p class="text-sm font-semibold text-gray-600">
                               Create by Agent Name
                           </p>
                           <p class="text-gray-800"><?= htmlspecialchars($pickupagent['created_by_agent_name']) ?></p>
                       </div>
                       <div>
                           <p class="text-sm font-semibold text-gray-600">Location</p>
                           <div class="flex items-center text-gray-800 space-x-2">
                               <span class="font-medium"><?= htmlspecialchars($pickupagent['region_name']) ?></span>
                               <span class="text-gray-500">›</span>
                               <span class="font-medium"><?= htmlspecialchars($pickupagent['city_name']) ?></span>
                               <span class="text-gray-500">›</span>
                               <span class="font-medium"><?= htmlspecialchars($pickupagent['township_name']) ?></span>
                           </div>
                       </div>
                   </div>
               </div>

               <!-- Back Button (below everything) -->
               <div class="mt-6">
                   <a href="<?= URLROOT; ?>/admin/pickupagentlist"
                       class="inline-block px-6 py-3 bg-gray-600 text-white font-semibold rounded-lg shadow hover:bg-gray-700 transition-colors">
                       ← Back
                   </a>
               </div>


           </div>
       </main>
   </div>

   </body>

   </html>