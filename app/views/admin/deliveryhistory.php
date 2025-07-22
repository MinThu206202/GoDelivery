<?php require_once APPROOT . '/views/inc/sidebar.php'; ?>


<!-- Main Content Area -->
<main class="main-content">
    <!-- Dashboard Header -->
    <header class="dashboard-header">
        <div class="header-left">
            <h2 class="page-title">Agent</h2>
        </div>
        <!-- Filters and Search are now placed directly in dashboard-header to allow centering -->
        <div class="filter-options">
            <!-- From Date Filter Pill -->
            <div class="filter-item pill-button" id="fromDateFilterPill">
                <label for="fromDateFilter">From Date:</label>
                <input type="date" id="fromDateFilter" title="From Date">
                <i class="fas fa-calendar-alt dropdown-icon"></i>
            </div>
            <!-- To Date Filter Pill -->
            <div class="filter-item pill-button" id="toDateFilterPill">
                <label for="toDateFilter">To Date:</label>
                <input type="date" id="toDateFilter" title="To Date">
                <i class="fas fa-calendar-alt dropdown-icon"></i>
            </div>
            <div class="filter-item pill-button">
                <label for="agentFilter" id="agentLabel">Agent</label>
                <select id="agentFilter" class="filter-input-hidden">
                    <option value="">All Agents</option>
                    <option value="YGN01">YGN01</option>
                    <option value="MDY02">MDY02</option>
                    <option value="BGO03">BGO03</option>
                    <!-- Add more agent options as needed -->
                </select>
                <i class="fas fa-caret-down dropdown-icon"></i>
            </div>
            <!-- Status filter dropdown (hidden, used by JS for internal state) -->
            <div class="filter-item pill-button" style="display: none;">
                <select id="statusFilter" class="filter-input-hidden">
                    <option value="">All Statuses</option>
                    <option value="Delivered">Delivered</option>
                    <option value="In Transit">In Transit</option>
                    <option value="Pending Pickup">Pending Pickup</option>
                    <option value="On Hold">On Hold</option>
                    <option value="Failed Delivery">Failed Delivery</option>
                    <!-- Add more status options as needed -->
                </select>
                <i class="fas fa-caret-down dropdown-icon"></i>
            </div>
            <div class="filter-item search-bar">
                <input type="text" id="searchInput" placeholder="Search">
                <button type="submit" id="searchButton"><i class="fas fa-search"></i></button>
            </div>
        </div>
        <div class="header-right">
            <div class="admin-profile">
                <div class="profile-icon"><i class="fas fa-user-circle"></i></div>
                <span>Admin</span>
            </div>
        </div>
    </header>

    <!-- Manage Delivery Section with Scrollable Table -->
    <div class="manage-delivery-section">
        <!-- New container for the status buttons, placed above the section-header -->
        <div class="status-filter-buttons">
            <a href="#" class="filter-button active" id="allDeliveriesButton">All Deliveries</a>
            <a href="#" class="filter-button" id="deliveredButton">Delivered</a>
            <a href="#" class="filter-button" id="inTransitButton">In Transit</a>
            <a href="#" class="filter-button" id="pendingPickupButton">Pending Pickup</a>
        </div>
        <!-- Combined heading and reset button in a flex container -->
        <div class="section-header">
            <h3 id="tableHeaderTitle">All Deliveries</h3> <!-- Added ID for easier targeting -->
            <div class="filter-item reset-button" id="resetButton">
                <i class="fas fa-sync-alt"></i> <span>Reset</span>
            </div>
        </div>
        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>Tracking ID</th>
                        <th>Customer Info</th>
                        <th>Agent</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th>Paid/Prepaid</th> <!-- Added new table header -->
                        <!-- Removed <th>Setting</th> -->
                        <th>View</th>
                    </tr>
                </thead>
                <tbody id="deliveryTableBody">
                    <!-- Table rows will be populated dynamically by JavaScript -->
                </tbody>
            </table>
        </div>
    </div>
</main>
</div>

<!-- Custom Message Box HTML (for general notifications) -->
<div id="messageBoxOverlay" class="message-box-overlay">
    <div class="message-box">
        <p id="messageBoxText"></p>
        <button class="close-button" id="messageBoxCloseButton">OK</button>
    </div>
</div>

<!-- New Details Modal HTML -->
<div id="detailsModalOverlay" class="details-modal-overlay">
    <div class="details-modal-content">
        <div class="modal-header">
            <h4>Delivery Information</h4>
            <!-- Changed title -->
            <button class="modal-close-button" id="detailsModalCloseButton">&times;</button>
        </div>
        <!-- Top section: Tracking Code (left), Paid/Prepaid Amount & Date (right) -->
        <div class="top-info-grid">
            <div class="grid-item">
                <strong>Tracking Code:</strong>
                <span id="detailTrackingId"></span>
            </div>
            <div class="grid-item">
                <strong>Customer Name:</strong>
                <span id="detailCustomerName"></span>
            </div>
            <div class="grid-item">
                <strong>Agent:</strong>
                <span id="detailAgent"></span>
            </div>
            <div class="grid-item">
                <strong>Paid / Prepaid Amount:</strong>
                <span id="detailPaidPrepaidAmount"></span>
            </div>
            <div class="grid-item">
                <strong>Date:</strong>
                <span id="detailDate"></span>
            </div>
        </div>

        <!-- From Section -->
        <div id="fromDetailWrapper">
            <div class="detail-section-title">From:</div>
            <div class="detail-stacked-group">
                <div class="detail-item">
                    <strong>Name:</strong>
                    <span id="detailFromName"></span>
                </div>
                <div class="detail-item">
                    <strong>Phone Number:</strong>
                    <span id="detailFromPhone"></span>
                </div>
                <div class="detail-item">
                    <strong>Address:</strong>
                    <span id="detailFromAddress"></span>
                </div>
            </div>
        </div>

        <!-- To Section -->
        <div id="toDetailWrapper">
            <div class="detail-section-title">To:</div>
            <div class="detail-stacked-group">
                <div class="detail-item">
                    <strong>Name:</strong>
                    <span id="detailToName"></span>
                </div>
                <div class="detail-item">
                    <strong>Phone Number:</strong>
                    <span id="detailToPhone"></span>
                </div>
                <div class="detail-item">
                    <strong>Address:</strong>
                    <span id="detailToAddress"></span>
                </div>
            </div>
        </div>

        <!-- Pickup/Delivery Locations Section -->
        <div id="pickupDeliveryDetailWrapper">
            <div class="detail-section-title">Pickup/Delivery Locations:</div>
            <div class="detail-stacked-group">
                <div class="detail-item">
                    <strong>From Address:</strong>
                    <span id="detailFromPickupAddress"></span>
                </div>
                <div class="detail-item">
                    <strong>From Phone:</strong>
                    <span id="detailFromPickupPhone"></span>
                </div>
                <div class="detail-item">
                    <strong>To Address:</strong>
                    <span id="detailToDeliveryAddress"></span>
                </div>
                <div class="detail-item">
                    <strong>To Phone:</strong>
                    <span id="detailToDeliveryPhone"></span>
                </div>
            </div>
        </div>

        <!-- Item Details Section -->
        <div id="itemDetailWrapper">
            <div class="detail-section-title">Item Details:</div>
            <div class="detail-stacked-group">
                <div class="detail-item">
                    <strong>Weight (Kg):</strong>
                    <span id="detailItemWeight"></span>
                </div>
                <div class="detail-item">
                    <strong>Number of Piece:</strong>
                    <span id="detailItemPieces"></span>
                </div>
                <div class="detail-item">
                    <strong>Sender/Receiver Pay:</strong>
                    <span id="detailSenderReceiverPay"></span>
                </div>
                <div class="detail-item">
                    <strong>Pay/Prepaid:</strong>
                    <span id="detailPayPrepaid"></span>
                </div>
                <div class="detail-item">
                    <strong>Content Description:</strong>
                    <span id="detailContentDescription"></span>
                </div>
            </div>
        </div>

        <!-- Delivery Completion Details for Delivered Status (dynamically added) -->
        <div id="dynamicDeliveryCompletionDetails">
            <!-- This content is added by JS for 'Delivered' status in 'view' mode -->
        </div>

        <!-- Dynamic content for other statuses like In Transit, Pending Pickup (dynamically added) -->
        <div id="dynamicStatusDetails">
            <!-- Content for In Transit, Pending Pickup will be added here by JS for both modes, Delivered content will be added to fullDetailsSection for 'view' mode -->
        </div>

        <!-- Status Update Section (conditionally visible for 'Edit' mode) -->
        <div id="statusUpdateSection" class="status-update-section" style="display: none;">
            <div class="detail-section-title">Update Status:</div>
            <div class="status-input-group">
                <label for="statusUpdateSelect">New Status:</label>
                <select id="statusUpdateSelect"></select>
            </div>
            <!-- Conditional Receiver Details (for Delivered Status in Edit Mode) -->
            <div id="receiverNameInputGroup" class="detail-item" style="display: none;">
                <strong>Receiver Name:</strong>
                <input type="text" id="receiverNameInput" placeholder="Enter Receiver Name">
            </div>
            <div id="receiverEmailInputGroup" class="detail-item" style="display: none;">
                <strong>Receiver Email:</strong>
                <input type="email" id="receiverEmailInput" placeholder="Enter Receiver Email">
            </div>
            <!-- Last Change Time (always visible in edit/view mode when available) -->
            <div id="lastChangeTimeWrapper" class="detail-item" style="display: none;">
                <strong>Last Status Change:</strong>
                <span id="detailLastChangeTime"></span>
            </div>
            <div class="button-group">
                <button id="saveStatusButton" class="save-button">Save Changes</button>
                <button id="cancelStatusChangeButton" class="cancel-button">Cancel</button>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript for Data and Filter/Search Functionality -->
<script>
    // Sample data for the delivery history table.
    // This data simulates records you might receive from a backend API or database.
    const deliveryData = [{
            trackingId: "MM001-A1B2C3",
            customerName: "Aung Aung",
            agent: "YGN01",
            status: "Delivered",
            date: "2025-06-10",
            paidPrepaidAmount: "5000 MMK",
            fromName: "Aung Aung",
            fromPhone: "09123456789",
            fromAddress: "No.123, Main St, Mandalay",
            toName: "Su Su",
            toPhone: "09987654321",
            toAddress: "No.456, Oak Ave, Yangon",
            fromPickupAddress: "Mandalay Central Store",
            fromPickupPhone: "09112233445",
            toDeliveryAddress: "Yangon Distribution Center",
            toDeliveryPhone: "09667788990",
            itemWeight: "2 Kg",
            itemPieces: "3",
            senderReceiverPay: "Sender",
            payPrepaid: "Paid",
            contentDescription: "Clothes - This is a description of the clothes shipment, including details about fabric, color, and size.",
            receiverName: "Su Su", // Added for Delivered status
            receiverEmail: "susu@example.com", // Added for Delivered status
            deliveryTime: "2025-06-10 14:30", // This will be formatted
            lastStatusChangeTime: "2025-06-10 02:30 PM" // Initial value for testing
        },
        {
            trackingId: "MM002-D4E5F6",
            customerName: "Su Su (Long Name Example With More Characters)",
            agent: "MDY02",
            status: "In Transit",
            date: "2025-06-11",
            paidPrepaidAmount: "7500 MMK",
            fromName: "Bao Bao",
            fromPhone: "09234567890",
            fromAddress: "456 Pine St, Naypyitaw",
            toName: "Lin Lin",
            toPhone: "09876543210",
            toAddress: "789 Cedar St, Taunggyi",
            fromPickupAddress: "Naypyitaw Main Depot",
            fromPickupPhone: "09223344556",
            toDeliveryAddress: "Taunggyi Sorting Hub",
            toDeliveryPhone: "09778899001",
            itemWeight: "1.5 Kg",
            itemPieces: "1",
            senderReceiverPay: "Receiver",
            payPrepaid: "Prepaid",
            contentDescription: "Books - A collection of educational books for university students.",
            lastStatusChangeTime: "2025-06-11 10:00 AM"
        },
        {
            trackingId: "MM003-G7H8I9",
            customerName: "Kyaw Kyaw",
            agent: "BGO03",
            status: "Pending Pickup",
            date: "2025-06-09",
            paidPrepaidAmount: "3000 MMK",
            fromName: "Hla Hla",
            fromPhone: "09345678901",
            fromAddress: "789 Oak Ave, Bago",
            toName: "Mya Mya",
            toPhone: "09765432109",
            toAddress: "101 Elm St, Pyinmana",
            fromPickupAddress: "Bago City Office",
            fromPickupPhone: "09334455667",
            toDeliveryAddress: "Pyinmana Post Office",
            toDeliveryPhone: "09889900112",
            itemWeight: "0.5 Kg",
            itemPieces: "2",
            senderReceiverPay: "Sender",
            payPrepaid: "N/A",
            contentDescription: "Documents - Important legal documents in a sealed envelope.",
            lastStatusChangeTime: "2025-06-09 09:15 AM"
        },
        {
            trackingId: "MM003-G7H8I9-B",
            customerName: "Kyaw Kyaw 2",
            agent: "BGO03",
            status: "Pending Pickup",
            date: "2025-06-09",
            paidPrepaidAmount: "3000 MMK",
            fromName: "Hla Hla",
            fromPhone: "09345678901",
            fromAddress: "789 Oak Ave, Bago",
            toName: "Mya Mya",
            toPhone: "09765432109",
            toAddress: "101 Elm St, Pyinmana",
            fromPickupAddress: "Bago City Office",
            fromPickupPhone: "09334455667",
            toDeliveryAddress: "Pyinmana Post Office",
            toDeliveryPhone: "09889900112",
            itemWeight: "0.5 Kg",
            itemPieces: "2",
            senderReceiverPay: "Sender",
            payPrepaid: "N/A",
            contentDescription: "Documents - Important legal documents in a sealed envelope.",
            lastStatusChangeTime: "2025-06-09 09:15 AM"
        }, {
            trackingId: "MM003-G7H8I9-C",
            customerName: "Kyaw Kyaw 3",
            agent: "BGO03",
            status: "Delivered",
            date: "2025-06-09",
            paidPrepaidAmount: "3000 MMK",
            fromName: "Hla Hla",
            fromPhone: "09345678901",
            fromAddress: "789 Oak Ave, Bago",
            toName: "Mya Mya",
            toPhone: "09765432109",
            toAddress: "101 Elm St, Pyinmana",
            fromPickupAddress: "Bago City Office",
            fromPickupPhone: "09334455667",
            toDeliveryAddress: "Pyinmana Post Office",
            toDeliveryPhone: "09889900112",
            itemWeight: "0.5 Kg",
            itemPieces: "2",
            senderReceiverPay: "Sender",
            payPrepaid: "N/A",
            contentDescription: "Documents - Important legal documents in a sealed envelope.",
            lastStatusChangeTime: "2025-06-09 09:15 AM"
        },
        {
            trackingId: "MM004-J1K2L3",
            customerName: "Thin Thin",
            agent: "YGN01",
            status: "On Hold",
            date: "2025-06-08",
            paidPrepaidAmount: "12000 MMK",
            fromName: "Zaw Zaw",
            fromPhone: "09456789012",
            fromAddress: "222 Pine St, Yangon",
            toName: "Ei Ei",
            toPhone: "09098765432",
            toAddress: "333 Oak Ave, Mandalay",
            fromPickupAddress: "Yangon Central Hub",
            fromPickupPhone: "09445566778",
            toDeliveryAddress: "Mandalay Collection Point",
            toDeliveryPhone: "09990011223",
            itemWeight: "5 Kg",
            itemPieces: "1",
            senderReceiverPay: "Receiver",
            payPrepaid: "Paid",
            contentDescription: "Electronics - A new laptop with accessories, securely packaged.",
            lastStatusChangeTime: "2025-06-08 03:00 PM"
        },
        {
            trackingId: "MM005-M4N5O6",
            customerName: "Min Min",
            agent: "MDY02",
            status: "Failed Delivery",
            date: "2025-06-07",
            paidPrepaidAmount: "6000 MMK",
            fromName: "Nyein Nyein",
            fromPhone: "09567890123",
            fromAddress: "999 Cedar St, Naypyitaw",
            toName: "Phyo Phyo",
            toPhone: "09109876543",
            toAddress: "888 Birch St, Yangon",
            fromPickupAddress: "Naypyitaw Cargo Terminal",
            fromPickupPhone: "09556677889",
            toDeliveryAddress: "Yangon Residential Area",
            toDeliveryPhone: "09001122334",
            itemWeight: "3 Kg",
            itemPieces: "4",
            senderReceiverPay: "Sender",
            payPrepaid: "Prepaid",
            contentDescription: "Perishables - Fresh fruits and vegetables, temperature-controlled packaging.",
            lastStatusChangeTime: "2025-06-07 01:45 PM"
        },
        {
            trackingId: "MM006-P7Q8R9",
            customerName: "Hnin Hnin",
            agent: "BGO03",
            status: "Delivered",
            date: "2025-06-06",
            paidPrepaidAmount: "4500 MMK",
            fromName: "Ye Yint",
            fromPhone: "09678901234",
            fromAddress: "111 Poplar St, Bago",
            toName: "Zin Zin",
            toPhone: "09210987654",
            toAddress: "444 Willow St, Mandalay",
            fromPickupAddress: "Bago Regional Office",
            fromPickupPhone: "09667788990",
            toDeliveryAddress: "Mandalay Downtown",
            toDeliveryPhone: "09112233445",
            itemWeight: "1 Kg",
            itemPieces: "1",
            senderReceiverPay: "Receiver",
            payPrepaid: "Paid",
            contentDescription: "Artwork - A framed painting, fragile item.",
            receiverName: "Zin Zin",
            receiverEmail: "zinzin@example.com",
            deliveryTime: "2025-06-06 11:00",
            lastStatusChangeTime: "2025-06-06 05:00 AM"
        }
    ];

    // Get DOM elements
    const fromDateFilter = document.getElementById('fromDateFilter');
    const toDateFilter = document.getElementById('toDateFilter');
    const agentFilter = document.getElementById('agentFilter');
    const statusFilter = document.getElementById('statusFilter'); // KEEP THIS: Still used by JS logic
    const searchInput = document.getElementById('searchInput');
    const searchButton = document.getElementById('searchButton');
    const deliveryTableBody = document.getElementById('deliveryTableBody');
    const resetButton = document.getElementById('resetButton');
    const agentLabel = document.getElementById('agentLabel');
    const tableHeaderTitle = document.getElementById('tableHeaderTitle'); // New: Get the table header title element

    const messageBoxOverlay = document.getElementById('messageBoxOverlay');
    const messageBoxText = document.getElementById('messageBoxText');
    const messageBoxCloseButton = document.getElementById('messageBoxCloseButton');

    const detailsModalOverlay = document.getElementById('detailsModalOverlay');
    const detailsModalCloseButton = document.getElementById('detailsModalCloseButton');

    // Detail elements in the modal
    const detailTrackingId = document.getElementById('detailTrackingId');
    const detailCustomerName = document.getElementById('detailCustomerName');
    const detailAgent = document.getElementById('detailAgent');
    const detailPaidPrepaidAmount = document.getElementById('detailPaidPrepaidAmount');
    const detailDate = document.getElementById('detailDate');

    // "From" details
    const fromDetailWrapper = document.getElementById('fromDetailWrapper');
    const detailFromName = document.getElementById('detailFromName');
    const detailFromPhone = document.getElementById('detailFromPhone');
    const detailFromAddress = document.getElementById('detailFromAddress');

    // "To" details
    const toDetailWrapper = document.getElementById('toDetailWrapper');
    const detailToName = document.getElementById('detailToName');
    const detailToPhone = document.getElementById('detailToPhone');
    const detailToAddress = document.getElementById('detailToAddress');

    // Pickup/Delivery Locations details
    const pickupDeliveryDetailWrapper = document.getElementById('pickupDeliveryDetailWrapper');
    const detailFromPickupAddress = document.getElementById('detailFromPickupAddress');
    const detailFromPickupPhone = document.getElementById('detailFromPickupPhone');
    const detailToDeliveryAddress = document.getElementById('detailToDeliveryAddress');
    const detailToDeliveryPhone = document.getElementById('detailToDeliveryPhone');

    // Item details
    const itemDetailWrapper = document.getElementById('itemDetailWrapper');
    const detailItemWeight = document.getElementById('detailItemWeight');
    const detailItemPieces = document.getElementById('detailItemPieces');
    const detailSenderReceiverPay = document.getElementById('detailSenderReceiverPay');
    const detailPayPrepaid = document.getElementById('detailPayPrepaid');
    const detailContentDescription = document.getElementById('detailContentDescription');

    const dynamicDeliveryCompletionDetails = document.getElementById('dynamicDeliveryCompletionDetails');
    const dynamicStatusDetails = document.getElementById('dynamicStatusDetails');
    const statusUpdateSection = document.getElementById('statusUpdateSection');
    const statusUpdateSelect = document.getElementById('statusUpdateSelect');
    const receiverNameInputGroup = document.getElementById('receiverNameInputGroup');
    const receiverNameInput = document.getElementById('receiverNameInput');
    const receiverEmailInputGroup = document.getElementById('receiverEmailInputGroup');
    const receiverEmailInput = document.getElementById('receiverEmailInput');
    const lastChangeTimeWrapper = document.getElementById('lastChangeTimeWrapper');
    const detailLastChangeTime = document.getElementById('detailLastChangeTime');
    const saveStatusButton = document.getElementById('saveStatusButton');
    const cancelStatusChangeButton = document.getElementById('cancelStatusChangeButton');

    // New buttons
    const allDeliveriesButton = document.getElementById('allDeliveriesButton');
    const deliveredButton = document.getElementById('deliveredButton');
    const inTransitButton = document.getElementById('inTransitButton');
    const pendingPickupButton = document.getElementById('pendingPickupButton');
    const statusButtonsContainer = document.querySelector('.status-buttons-container');


    let currentEditTrackingId = null; // To keep track of which delivery is being edited
    let currentViewDelivery = null; // To store the delivery object currently being viewed
    let statusOverride = null; // New variable to store status forced by Complete/Pending buttons


    /**
     * Helper function to format date-time strings to include AM/PM.
     * If the input is just a date, it will format it as date with 12:00 AM.
     * @param {string | Date} dateTimeString - The date or date-time string to format.
     * @returns {string} Formatted date-time string (e.g., "YYYY-MM-DD hh:mm AM/PM").
     */
    function formatDateTime(isoString) {
        if (!isoString) return '';
        const date = new Date(isoString);
        if (isNaN(date.getTime())) { // Check for invalid date
            // Attempt to parse if it's already in "YYYY-MM-DD HH:MM AM/PM" format or similar
            const parts = isoString.match(/(\d{4}-\d{2}-\d{2})\s*(\d{2}:\d{2})\s*(AM|PM)?/i);
            if (parts) {
                let [_, datePart, timePart, ampm] = parts;
                let hours = parseInt(timePart.substring(0, 2));
                let minutes = parseInt(timePart.substring(3, 5));

                if (ampm && ampm.toLowerCase() === 'pm' && hours < 12) {
                    hours += 12;
                } else if (ampm && ampm.toLowerCase() === 'am' && hours === 12) {
                    hours = 0; // Midnight
                }
                const newDate = new Date(`${datePart}T${String(hours).padStart(2, '0')}:${String(minutes).padStart(2, '0')}:00`);
                if (!isNaN(newDate.getTime())) {
                    return newDate.toLocaleString('en-US', {
                        year: 'numeric',
                        month: '2-digit',
                        day: '2-digit',
                        hour: '2-digit',
                        minute: '2-digit',
                        hour12: true
                    });
                }
            }
            return isoString; // Return original if parsing failed
        }
        return date.toLocaleString('en-US', {
            year: 'numeric',
            month: '2-digit',
            day: '2-digit',
            hour: '2-digit',
            minute: '2-digit',
            hour12: true
        });
    }


    /**
     * Renders the table rows based on the provided data array.
     * Clears existing rows and inserts new ones.
     * @param {Array<Object>} data - The array of delivery objects to display.
     */
    function populateTable(data) {
        deliveryTableBody.innerHTML = ''; // Clear existing rows
        if (data.length === 0) {
            const noDataRow = deliveryTableBody.insertRow();
            const noDataCell = noDataRow.insertCell();
            noDataCell.colSpan = 7; // Changed from 8 to 7 as 'Setting' column is removed
            noDataCell.textContent = "No Research";
            noDataCell.style.textAlign = "center";
            noDataCell.style.padding = "20px";
            noDataCell.style.color = "var(--text-color)";
            return;
        }

        data.forEach(delivery => {
            const row = deliveryTableBody.insertRow();
            row.innerHTML = `
                    <td><span class="tracking-id-cell">${delivery.trackingId}</span></td>
                    <td>${delivery.customerName}</td>
                    <td>${delivery.agent}</td>
                    <td><span class="status-badge status-${delivery.status.toLowerCase().replace(/\s/g, '-')}">${delivery.status}</span></td>
                    <td>${delivery.date}</td>
                    <td>${delivery.paidPrepaidAmount}</td>
                    <td>
                        <button class="view-button" data-tracking-id="${delivery.trackingId}">View</button>
                    </td>
                `;
        });
        addEventListenersToTableButtons();
    }

    /**
     * Applies all active filters (date, agent, status, and search term) to the data
     * and re-renders the table. Also controls the visibility of the reset button.
     */
    function applyFilters() {
        let filteredData = [...deliveryData]; // Start with a copy of all data

        const fromDate = fromDateFilter.value;
        const toDate = toDateFilter.value;
        const selectedAgent = agentFilter.value;
        const currentStatusFilter = statusOverride || statusFilter.value;
        const searchTerm = searchInput.value.toLowerCase().trim();

        // Filter by Date Range
        if (fromDate && toDate) {
            // Both fromDate and toDate are set, filter items within this range (inclusive)
            filteredData = filteredData.filter(item => {
                const itemDate = new Date(item.date);
                const start = new Date(fromDate);
                const end = new Date(toDate);
                // Set hours to 00:00:00 for accurate date-only comparison
                itemDate.setHours(0, 0, 0, 0);
                start.setHours(0, 0, 0, 0);
                end.setHours(0, 0, 0, 0);
                return itemDate >= start && itemDate <= end;
            });
        } else if (fromDate && !toDate) {
            // This case should now trigger the message box via the search button click,
            // but if this function is called directly without a valid date range,
            // it will still filter only by fromDate.
            filteredData = filteredData.filter(item => {
                const itemDate = new Date(item.date);
                const start = new Date(fromDate);
                itemDate.setHours(0, 0, 0, 0);
                start.setHours(0, 0, 0, 0);
                return itemDate >= start;
            });
        } else if (!fromDate && toDate) {
            // This case should now trigger the message box via the search button click,
            // but if this function is called directly without a valid date range,
            // it will still filter only by toDate.
            filteredData = filteredData.filter(item => {
                const itemDate = new Date(item.date);
                const end = new Date(toDate);
                itemDate.setHours(0, 0, 0, 0);
                end.setHours(0, 0, 0, 0);
                return itemDate <= end;
            });
        }


        // Filter by Agent
        if (selectedAgent) {
            filteredData = filteredData.filter(item => item.agent === selectedAgent);
        }

        // Filter by Status (using currentStatusFilter, which could be from button or dropdown)
        if (currentStatusFilter) {
            filteredData = filteredData.filter(item => item.status === currentStatusFilter);
        }

        // Filter by Search Term (applies to all visible fields)
        if (searchTerm) {
            filteredData = filteredData.filter(item =>
                Object.values(item).some(value =>
                    String(value).toLowerCase().includes(searchTerm)
                )
            );
        }

        populateTable(filteredData); // Render the table with the filtered data

        // Determine if any filter is active for showing/hiding the reset button
        const isFilterActive = fromDate || toDate || selectedAgent || currentStatusFilter || searchTerm;

        // Show/hide reset button based on filter activity
        if (isFilterActive) {
            resetButton.style.display = 'flex'; // Use 'flex' because it's styled as a flex container
        } else {
            resetButton.style.display = 'none';
        }
    }

    /**
     * Resets all filters and the search input to their default states,
     * then re-renders the table with the original data. Hides the reset button.
     */
    function resetFilters() {
        fromDateFilter.value = ''; // Clear from date filter
        toDateFilter.value = ''; // Clear to date filter
        agentFilter.value = ''; // Clear agent filter
        statusFilter.value = ''; // Clear status filter
        searchInput.value = ''; // Clear search input
        statusOverride = null; // Clear any button-forced status

        // Update labels to reflect cleared filters
        updateAgentLabel();

        // Clear active class from status buttons and reset table header
        document.querySelectorAll('.filter-button').forEach(button => { // Corrected selector
            button.classList.remove('active');
        });
        allDeliveriesButton.classList.add('active'); // Set "All Deliveries" as active
        tableHeaderTitle.textContent = "All Deliveries"; // Reset header to default


        // Render the table with the original, unfiltered data
        populateTable(deliveryData);

        // Hide the reset button after resetting
        resetButton.style.display = 'none';
    }

    /**
     * Updates the text content of the agent label based on the selected agent.
     */
    function updateAgentLabel() {
        // Updated to read directly from the select element's selected option text
        const selectedOptionText = agentFilter.options[agentFilter.selectedIndex].textContent;
        agentLabel.textContent = selectedOptionText;
    }

    /**
     * Shows the custom message box with a given message.
     * @param {string} title - The title for the message box.
     * @param {string} message - The message to display in the box.
     */
    function showMessage(title, message) {
        messageBoxText.innerHTML = `<h4>${title}</h4><p>${message}</p>`;
        messageBoxOverlay.classList.add('visible'); // Show the overlay
    }

    /**
     * Hides the custom message box.
     */
    function hideMessage() {
        messageBoxOverlay.classList.remove('visible'); // Hide the overlay
    }

    /**
     * Shows the delivery details modal with the data of a specific item.
     * @param {Object} delivery - The delivery item object to display.
     * @param {string} mode - 'view' to show all details, 'edit' to show table row data + update options.
     */
    function showDeliveryDetailsModal(delivery, mode = 'view') {
        currentViewDelivery = delivery; // Store the current delivery for potential updates

        // Always populate basic details (top-info-grid)
        detailTrackingId.textContent = delivery.trackingId;
        detailCustomerName.textContent = delivery.customerName;
        detailAgent.textContent = delivery.agent;
        detailPaidPrepaidAmount.textContent = delivery.paidPrepaidAmount;
        detailDate.textContent = delivery.date; // Date from table row

        // Initialize display for all sections (hide by default)
        fromDetailWrapper.style.display = 'none';
        toDetailWrapper.style.display = 'none';
        pickupDeliveryDetailWrapper.style.display = 'none';
        itemDetailWrapper.style.display = 'none';
        dynamicDeliveryCompletionDetails.innerHTML = ''; // Clear content
        dynamicStatusDetails.innerHTML = ''; // Clear content
        dynamicDeliveryCompletionDetails.style.display = 'none'; // Ensure hidden
        dynamicStatusDetails.style.display = 'none'; // Ensure hidden
        statusUpdateSection.style.display = 'none'; // Hide update section initially
        receiverNameInputGroup.style.display = 'none'; // Hide receiver inputs initially
        receiverEmailInputGroup.style.display = 'none'; // Hide receiver inputs initially
        lastChangeTimeWrapper.style.display = 'none'; // Hide last change time initially


        if (mode === 'view') {
            // Show all detailed sections for 'view' mode
            fromDetailWrapper.style.display = 'block';
            toDetailWrapper.style.display = 'block';
            pickupDeliveryDetailWrapper.style.display = 'block';
            itemDetailWrapper.style.display = 'block';

            // Populate full detail values
            detailFromName.textContent = delivery.fromName;
            detailFromPhone.textContent = delivery.fromPhone;
            detailFromAddress.textContent = delivery.fromAddress;

            detailToName.textContent = delivery.toName;
            detailToPhone.textContent = delivery.toPhone;
            detailToAddress.textContent = delivery.toAddress;

            detailFromPickupAddress.textContent = delivery.fromPickupAddress;
            detailFromPickupPhone.textContent = delivery.fromPickupPhone;
            detailToDeliveryAddress.textContent = delivery.toDeliveryAddress;
            detailToDeliveryPhone.textContent = delivery.toDeliveryPhone;

            detailItemWeight.textContent = delivery.itemWeight;
            detailItemPieces.textContent = delivery.itemPieces;
            detailSenderReceiverPay.textContent = delivery.senderReceiverPay;
            detailPayPrepaid.textContent = delivery.payPrepaid;
            detailContentDescription.textContent = delivery.contentDescription;

            // Populate and display dynamic status details for 'view' mode
            if (delivery.status === 'Delivered') {
                dynamicDeliveryCompletionDetails.innerHTML = `
                        <div class="detail-section-title">Delivery Completion Details:</div>
                        <div class="detail-stacked-group">
                            <div class="detail-item">
                                <strong>Receiver Name:</strong>
                                <span>${delivery.receiverName || 'N/A'}</span>
                            </div>
                            <div class="detail-item">
                                <strong>Receiver Email:</strong>
                                <span>${delivery.receiverEmail || 'N/A'}</span>
                            </div>
                            <div class="detail-item">
                                <strong>Delivery Time:</strong>
                                <span>${delivery.deliveryTime ? formatDateTime(delivery.deliveryTime) : 'N/A'}</span>
                            </div>
                        </div>
                    `;
                // Ensure the container is displayed if content is added
                dynamicDeliveryCompletionDetails.style.display = 'block';
            } else if (delivery.status === 'In Transit') {
                dynamicStatusDetails.innerHTML = `
                        <div class="detail-section-title">In Transit Details:</div>
                        <div class="detail-stacked-group">
                            <div class="detail-item">
                                <strong>Updated Time by Agent:</strong>
                                <span>${delivery.updateTimeByAgent ? formatDateTime(delivery.updateTimeByAgent) : 'N/A'}</span>
                            </div>
                            <div class="detail-item">
                                <strong>Estimated Time to Reach Office:</strong>
                                <span>${delivery.estimatedTimeToReachOffice ? formatDateTime(delivery.estimatedTimeToReachOffice) : 'N/A'}</span>
                            </div>
                        </div>
                    `;
                dynamicStatusDetails.style.display = 'block';
            } else if (delivery.status === 'Pending Pickup') {
                dynamicStatusDetails.innerHTML = `
                        <div class="detail-section-title">Pickup Details:</div>
                        <div class="detail-stacked-group">
                            <div class="detail-item">
                                <strong>Arrived Time Update:</strong>
                                <span>${delivery.arrivedTimeUpdate ? formatDateTime(delivery.arrivedTimeUpdate) : 'N/A'}</span>
                            </div>
                        </div>
                    `;
                dynamicStatusDetails.style.display = 'block';
            } else if (delivery.status === 'On Hold') {
                dynamicStatusDetails.innerHTML = `
                        <div class="detail-section-title">On Hold Details:</div>
                        <div class="detail-stacked-group">
                            <div class="detail-item">
                                <strong>Reason for Hold:</strong>
                                <span>${delivery.onHoldReason || 'N/A'}</span>
                            </div>
                            <div class="detail-item">
                                <strong>Resolution Notes:</strong>
                                <span>${delivery.resolutionNotes || 'N/A'}</span>
                            </div>
                        </div>
                    `;
                dynamicStatusDetails.style.display = 'block';
            } else if (delivery.status === 'Failed Delivery') {
                dynamicStatusDetails.innerHTML = `
                        <div class="detail-section-title">Failed Delivery Details:</div>
                        <div class="detail-stacked-group">
                            <div class="detail-item">
                                <strong>Reason for Failure:</strong>
                                <span>${delivery.failReason || 'N/A'}</span>
                            </div>
                            <div class="detail-item">
                                <strong>Attempted At:</strong>
                                <span>${delivery.attemptedAt ? formatDateTime(delivery.attemptedAt) : 'N/A'}</span>
                            </div>
                        </div>
                    `;
                dynamicStatusDetails.style.display = 'block';
            }

            // If lastStatusChangeTime exists, show it in view mode
            if (delivery.lastStatusChangeTime) {
                lastChangeTimeWrapper.style.display = 'flex';
                detailLastChangeTime.textContent = formatDateTime(delivery.lastStatusChangeTime);
            }

        } else if (mode === 'edit') {
            // For 'edit' mode, only the status update section should be visible.
            statusUpdateSection.style.display = 'flex';
            currentEditTrackingId = delivery.trackingId;

            // Set current status as default in dropdown
            statusUpdateSelect.innerHTML = ''; // Clear existing options
            const allPossibleStatuses = ["Delivered", "In Transit", "Pending Pickup", "On Hold", "Failed Delivery"];

            // Add the current status as the default selected option
            const currentOption = document.createElement('option');
            currentOption.value = delivery.status;
            currentOption.textContent = delivery.status;
            statusUpdateSelect.appendChild(currentOption);

            // Add other statuses, excluding the current one, to the dropdown
            allPossibleStatuses.forEach(status => {
                if (status !== delivery.status) {
                    const option = document.createElement('option');
                    option.value = status;
                    option.textContent = status;
                    statusUpdateSelect.appendChild(option);
                }
            });

            // Set selected value and attach event listener for change
            statusUpdateSelect.value = delivery.status;
            // Ensure only one event listener is active to avoid multiple triggers
            statusUpdateSelect.removeEventListener('change', handleStatusChangeForInputs);
            statusUpdateSelect.addEventListener('change', handleStatusChangeForInputs);


            // Show receiver fields if status is Delivered initially in edit mode
            if (delivery.status === 'Delivered') {
                receiverNameInputGroup.style.display = 'flex';
                receiverEmailInputGroup.style.display = 'flex';
                receiverNameInput.value = delivery.receiverName || '';
                receiverEmailInput.value = delivery.receiverEmail || '';
            } else {
                receiverNameInputGroup.style.display = 'none';
                receiverEmailInputGroup.style.display = 'none';
                // Clear input values when hiding, to prevent saving incorrect data
                receiverNameInput.value = '';
                receiverEmailInput.value = '';
            }

            // If lastStatusChangeTime exists, show it in edit mode
            if (delivery.lastStatusChangeTime) {
                lastChangeTimeWrapper.style.display = 'flex';
                detailLastChangeTime.textContent = formatDateTime(delivery.lastStatusChangeTime);
            }
        }

        detailsModalOverlay.classList.add('visible');
    }

    /**
     * Hides the delivery details modal.
     */
    function hideDeliveryDetailsModal() {
        detailsModalOverlay.classList.remove('visible');
        currentEditTrackingId = null; // Clear edit tracking ID on modal close
        currentViewDelivery = null; // Clear viewed delivery on modal close
    }

    /**
     * Handles the change event for the status update dropdown to toggle receiver input visibility.
     * @param {Event} event - The change event object.
     */
    function handleStatusChangeForInputs(event) {
        toggleDeliveredInputs(event.target.value);
    }

    /**
     * Toggles the visibility of receiver name and email input fields.
     * @param {string} selectedStatus - The currently selected status from the dropdown.
     */
    function toggleDeliveredInputs(selectedStatus) {
        if (selectedStatus === 'Delivered') {
            receiverNameInputGroup.style.display = 'flex';
            receiverEmailInputGroup.style.display = 'flex';
        } else {
            receiverNameInputGroup.style.display = 'none';
            receiverEmailInputGroup.style.display = 'none';
            // Clear input values when hiding, to prevent saving incorrect data
            receiverNameInput.value = '';
            receiverEmailInput.value = '';
        }
    }

    /**
     * Handles saving the updated status of a delivery.
     */
    function saveStatus() {
        if (!currentEditTrackingId) {
            showMessage('Error', 'No delivery selected for update.');
            return;
        }

        const newStatus = statusUpdateSelect.value;
        const currentTime = new Date();
        const formattedCurrentTime = formatDateTime(currentTime);

        // Find the item in the original deliveryData and update its status
        const itemIndex = deliveryData.findIndex(item => item.trackingId === currentEditTrackingId);
        if (itemIndex !== -1) {
            deliveryData[itemIndex].status = newStatus;
            // Update last change time
            deliveryData[itemIndex].lastStatusChangeTime = formattedCurrentTime;

            // Handle receiver details for 'Delivered' status
            if (newStatus === 'Delivered') {
                const receiverName = receiverNameInput.value.trim();
                const receiverEmail = receiverEmailInput.value.trim();

                if (!receiverName || !receiverEmail) {
                    showMessage('Error', 'Receiver Name and Email are required for Delivered status.');
                    return;
                }
                deliveryData[itemIndex].receiverName = receiverName;
                deliveryData[itemIndex].receiverEmail = receiverEmail;
                // Also update deliveryTime if status changes to Delivered and it's not already set
                deliveryData[itemIndex].deliveryTime = formattedCurrentTime;

            } else {
                // If status changes from 'Delivered' to something else, clear receiver info
                delete deliveryData[itemIndex].receiverName;
                delete deliveryData[itemIndex].receiverEmail;
                delete deliveryData[itemIndex].deliveryTime;
            }

            // For other statuses, update their respective time fields if needed (optional, based on current UX)
            if (newStatus === 'In Transit') {
                deliveryData[itemIndex].updateTimeByAgent = formattedCurrentTime;
            } else if (newStatus === 'Pending Pickup') {
                deliveryData[itemIndex].arrivedTimeUpdate = formattedCurrentTime;
            }


            applyFilters(); // Re-apply filters to update the table with the new status
            hideDeliveryDetailsModal(); // Close the modal
            showMessage("Success", `Status for Tracking ID ${currentEditTrackingId} updated to "${newStatus}".`);
        } else {
            showMessage("Error", "Could not find the delivery item to update.");
        }
    }

    /**
     * Function to add event listeners to dynamically created table buttons (Edit and View).
     */
    function addEventListenersToTableButtons() {
        // Note: The "Edit" button is effectively removed visually by removing its column.
        // If edit functionality needs to be retained, it would need to be moved to the "View" button's modal,
        // or a separate edit flow. For now, the "Edit" button is removed from the table rows.
        document.querySelectorAll('.view-button').forEach(button => {
            button.onclick = (event) => {
                const trackingId = event.target.dataset.trackingId;
                const delivery = deliveryData.find(d => d.trackingId === trackingId);
                if (delivery) {
                    // In the current setup, "View" mode only displays details, it does not enable editing directly.
                    // If you wish to allow editing from the "View" modal, you would need to add an "Edit" button
                    // inside the modal's content and modify its click handler to call showDeliveryDetailsModal(delivery, 'edit').
                    showDeliveryDetailsModal(delivery, 'view');
                }
            };
        });
    }


    /**
     * Manages the active state of the status buttons and updates the table header.
     * @param {HTMLElement} activeButton - The button that was just clicked and should be active.
     */
    // Inside your <script> tag in deliverypro.html

    function setActiveStatusButton(activeButton) {
        // Get all status filter buttons within the .status-filter-buttons container
        const allStatusButtons = document.querySelectorAll('.status-filter-buttons .filter-button');

        // Remove 'active' class from all status buttons
        allStatusButtons.forEach(button => {
            button.classList.remove('active');
        });

        // Add 'active' class to the clicked button
        if (activeButton) { // Ensure activeButton is not null
            activeButton.classList.add('active');
        }


        // Update the header text based on the active button's text content
        const tableHeaderTitle = document.getElementById('tableHeaderTitle'); // Get the correct element
        if (activeButton) {
            if (activeButton.textContent.includes('All Deliveries')) {
                tableHeaderTitle.textContent = 'All Deliveries';
            } else if (activeButton.textContent.includes('Delivered')) {
                tableHeaderTitle.textContent = 'Delivered Deliveries';
            } else if (activeButton.textContent.includes('In Transit')) {
                tableHeaderTitle.textContent = 'In Transit Deliveries';
            } else if (activeButton.textContent.includes('Pending Pickup')) {
                tableHeaderTitle.textContent = 'Pending Pickup Deliveries';
            }
            // Add more conditions if you have other filter buttons
        } else {
            // Default behavior if no specific status button is active (e.g., when resetting filters)
            tableHeaderTitle.textContent = 'All Deliveries';
        }
    }


    /*
     * Event Listener for DOM Content Loaded:
     * Ensures that the HTML is fully loaded and parsed before executing JavaScript.
     * This prevents errors from trying to access elements that doesn't exist yet.
     */
    document.addEventListener('DOMContentLoaded', () => {
        // Initial render of the table
        // Set initial table header title
        tableHeaderTitle.textContent = "All Deliveries";
        applyFilters(); // This call will initially hide the reset button as no filters are active

        // Initial update of labels based on default/pre-selected values
        updateAgentLabel();

        // Removed `change` event listeners for fromDateFilter and toDateFilter
        // Filtering for dates will now only happen on search button click or Enter key in search input

        agentFilter.addEventListener('change', () => {
            statusOverride = null; // Clear override when other filters are changed
            setActiveStatusButton(null); // Clear active status button, update header
            updateAgentLabel();
            applyFilters(); // Apply filters immediately for agent changes
        });

        // Attach event listeners for search input and button
        searchButton.addEventListener('click', () => {
            statusOverride = null; // Clear override when search is performed
            setActiveStatusButton(null); // Clear active button, update header

            const fromDate = fromDateFilter.value;
            const toDate = toDateFilter.value;

            // Validate date range input
            if ((fromDate && !toDate) || (!fromDate && toDate)) {
                showMessage("Input Error", "Please select both 'From Date' and 'To Date' for date filtering.");
                return; // Stop further processing if dates are incomplete
            }
            applyFilters(); // Apply filters if validation passes
        });

        searchInput.addEventListener('keyup', (event) => {
            if (event.key === 'Enter') {
                statusOverride = null;
                setActiveStatusButton(null);

                const fromDate = fromDateFilter.value;
                const toDate = toDateFilter.value;

                // Validate date range input when Enter is pressed in search
                if ((fromDate && !toDate) || (!fromDate && toDate)) {
                    showMessage("Input Error", "Please select both 'From Date' and 'To Date' for date filtering.");
                    return;
                }
                applyFilters();
            } else if (searchInput.value === '') {
                // If search input is cleared, re-apply filters (without strict date validation alert)
                statusOverride = null;
                setActiveStatusButton(null);
                applyFilters();
            }
        });

        // Attach event listener for the new reset button
        resetButton.addEventListener('click', resetFilters);

        // Add event listener for the general message box close button
        messageBoxCloseButton.addEventListener('click', hideMessage);

        // Add event listeners for the new details modal close button and status update buttons
        detailsModalCloseButton.addEventListener('click', hideDeliveryDetailsModal);
        saveStatusButton.addEventListener('click', saveStatus);
        cancelStatusChangeButton.addEventListener('click', hideDeliveryDetailsModal); // Cancel closes the modal

        // Event listeners for new status filter buttons
        allDeliveriesButton.addEventListener('click', () => {
            statusOverride = null; // No status override, show all
            statusFilter.value = ''; // Reset dropdown
            setActiveStatusButton(allDeliveriesButton); // Pass button element to update header
            applyFilters();
        });

        deliveredButton.addEventListener('click', () => {
            statusOverride = 'Delivered'; // Set override to filter by 'Delivered'
            statusFilter.value = ''; // Reset dropdown to "All Statuses" visually
            setActiveStatusButton(deliveredButton); // Set this button as active and update header
            applyFilters(); // Apply the filters
        });

        inTransitButton.addEventListener('click', () => {
            statusOverride = 'In Transit'; // Set override to filter by 'In Transit'
            statusFilter.value = ''; // Reset dropdown
            setActiveStatusButton(inTransitButton); // Set this button as active and update header
            applyFilters();
        });

        pendingPickupButton.addEventListener('click', () => {
            statusOverride = 'Pending Pickup'; // Set override to filter by 'Pending Pickup'
            statusFilter.value = ''; // Reset dropdown to "All Statuses" visually
            setActiveStatusButton(pendingPickupButton); // Set this button as active and update header
            applyFilters(); // Apply the filters
        });
    });
</script>
</body>

</html>