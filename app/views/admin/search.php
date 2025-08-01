<?php require_once APPROOT . '/views/inc/sidebar.php' ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>/public/deliverycss/admin/search.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<style>
    /* Add some spacing for icons next to text in labels and values */
    .status-badge i,
    .label i,
    .section-label i,
    .value i {
        margin-right: 8px;
        /* Space between icon and text */
    }

    /* Ensure values align well with their icons */
    .value {
        display: flex;
        align-items: center;
    }

    /* New styles for delivery info section */
    .delivery-info-section {
        grid-column: span 4;
        /* Spans all 4 columns */
        display: none;
        /* Hidden by default, shown by JS if status is Delivered */
        flex-direction: column;
        gap: 10px;
        padding: 20px 25px;
        border-top: 1px solid #e0e0e0;
        /* Separator from the status row */
        border-left: 1px solid #dcdcdc;
        /* Match grid left border */
        border-right: 1px solid #dcdcdc;
        /* Match grid right border */
        border-bottom: 1px solid #dcdcdc;
        /* Match grid bottom border */
        border-radius: 0 0 8px 8px;
        /* Rounded bottom corners if it's the last section before button */
        background-color: var(--white);
        /* Match grid background */
        margin-bottom: 20px;
        /* Space before back button */
    }

    .delivery-info-item {
        display: flex;
        align-items: center;
        font-size: 15px;
        color: #333;
    }

    .delivery-info-item .label {
        font-weight: 600;
        color: var(--heading-color);
        min-width: 120px;
        /* Adjust as needed for alignment */
    }

    .status-badge {
        padding: 6px 12px;
        border-radius: 5px;
        font-weight: bold;
        display: inline-block;
        color: #fff;
    }

    /* Status-specific styles */
    .status-delivered {
        background-color: #28a745;
        /* Green */
    }

    .status-pending {
        background-color: #ffc107;
        /* Yellow */
        color: #333;
    }

    .status-cancelled {
        background-color: #dc3545;
        /* Red */
    }

    .status-returned {
        background-color: #6c757d;
        /* Gray */
    }

    .status-default {
        background-color: #007bff;
        /* Blue */
    }
</style>

<?php foreach ($data['detaildelivery'] as $user): ?>
    <?php
    $status = strtolower($user['delivery_status']);
    $statusClass = match ($status) {
        'delivered' => 'status-delivered',
        'pending' => 'status-pending',
        'cancelled' => 'status-cancelled',
        'returned' => 'status-returned',
        default => 'status-default'
    };
    ?>
    <main class="delivery-details-main-content main-content">
        <header class="delivery-details-header dashboard-header">
            <h2 class="page-title">Dashboard/Delivery Detail</h2>
            <div class="admin-profile">
                <div class="profile-icon"><i class="fas fa-user-circle"></i></div>
                <span>Admin</span>
            </div>
        </header>

        <section class="delivery-details-panel panel">
            <div class="delivery-details-grid">
                <!-- Row 1: Tracking Code and Paid/Prepaid Amount -->
                <div class="grid-cell tracking-code-cell">
                    <span class="label"><i class="fas fa-barcode"></i> Tracking Code(<span><?= htmlspecialchars($user['tracking_code']); ?></span>)</span>
                </div>
                <div class="grid-cell paid-amount-cell">
                    <span class="label"><i class="fas fa-money-bill-wave"></i> Paid / PerPaid Amount</span>
                    <span class="value" id="paidAmount"><i class="fas fa-money-bill"></i><?= htmlspecialchars($user['amount']); ?> MMK</span>
                </div>

                <!-- Row 2: From Section and To Section -->
                <div class="grid-cell from-to-section from-section">
                    <span class="section-label"><i class="fas fa-location-dot"></i> From:</span>
                    <span class="value" id="fromName"><i class="fas fa-user-circle"></i><?= htmlspecialchars($user['sender_customer_name']); ?></span>
                    <span class="value" id="fromPhone"><i class="fas fa-phone"></i><?= htmlspecialchars($user['sender_customer_phone']); ?></span>
                    <span class="value" id="fromAddress"><i class="fas fa-map-pin"></i><?= htmlspecialchars($user['sender_customer_address']); ?></span>
                    <span class="value label-small">From City</span>
                    <span class="value" id="fromCity"><i class="fas fa-city"></i><?= htmlspecialchars($user['from_city_name']); ?></span>
                </div>
                <div class="grid-cell from-to-section to-section">
                    <span class="section-label"><i class="fas fa-map-location-dot"></i> To:</span>
                    <span class="value" id="toName"><i class="fas fa-user-circle"></i><?= htmlspecialchars($user['receiver_customer_name']); ?></span>
                    <span class="value" id="toPhone"><i class="fas fa-phone"></i><?= htmlspecialchars($user['receiver_customer_phone']); ?></span>
                    <span class="value" id="toAddress"><i class="fas fa-map-pin"></i><?= htmlspecialchars($user['receiver_customer_address']); ?>
                    </span>
                    <span class="value label-small">To City</span>
                    <span class="value" id="toCity"><i class="fas fa-city"></i><?= htmlspecialchars($user['to_city_name']); ?></span>
                </div>

                <!-- Row 3: Truck icon and associated Address/Phone numbers -->
                <div class="grid-cell truck-row-cell from-address-phone">
                    <i class="fas fa-phone-alt"></i> <span class="value" id="fromAddressPhone">City</span>
                </div>
                <div class="grid-cell truck-row-cell truck-icon-container" style="align-items: center;">
                    <i class="fas fa-truck"></i>
                </div>
                <div class="grid-cell truck-row-cell to-address-phone">
                    <i class="fas fa-phone-alt"></i> <span class="value" id="toAddressPhone">City</span>
                </div>

                <!-- Row 4: Weight, Number of Pieces, Sender/Receiver Pay, Pay/Perpaid pay -->
                <div class="grid-cell bottom-details-cell">
                    <span class="label"><i class="fas fa-weight-hanging"></i> Weight(Kg)</span>
                    <span class="value" id="weight"><i class="fas fa-weight"></i>2 KG</span>
                </div>
                <div class="grid-cell bottom-details-cell">
                    <span class="label"><i class="fas fa-boxes-stacked"></i> Number of Piece</span>
                    <span class="value" id="numPieces"><i class="fas fa-boxes"></i>3</span>
                </div>
                <div class="grid-cell bottom-details-cell">
                    <span class="label"><i class="fas fa-hand-holding-usd"></i> Sender/Receiver Pay</span>
                    <span class="value" id="senderReceiverPay"><i class="fas fa-paper-plane"></i>Sender</span>
                </div>
                <div class="grid-cell bottom-details-cell">
                    <span class="label"><i class="fas fa-wallet"></i> Pay/Perpaid pay</span>
                    <span class="value" id="payPerpaidPay"><i class="fas fa-money-check-alt"></i><?= htmlspecialchars($user['payment_status']); ?></span>
                </div>

                <!-- Row 5: Content Description -->
                <div class="grid-cell content-description-cell">
                    <span class="label"><i class="fas fa-box-open"></i> Content Description</span>
                </div>
                <div class="grid-cell content-description-cell">
                    <span class="value" id="contentDescription"><i class="fas fa-box-open"></i><?= htmlspecialchars($user['product_type']); ?></span>
                </div>

                <!-- Row 6: Status - Icon added here -->
                <div class="grid-cell status-cell">
                    <span class="label">Status</span>
                </div>
                <div class="grid-cell status-cell">
                    <span class="value status-badge <?= $statusClass ?>">
                        <i class="fas fa-circle"></i> <?= htmlspecialchars($user['delivery_status']) ?>
                    </span>
                </div>

                <!-- New: Delivered Info Section (only visible if status is Delivered) -->
                <div class="delivery-info-section" id="deliveredInfoSection">
                    <div class="delivery-info-item">
                        <span class="label"><i class="fas fa-user-check"></i> Delivered By:</span>
                        <span class="value" id="deliveredName"></span>
                    </div>
                    <div class="delivery-info-item">
                        <span class="label"><i class="fas fa-envelope"></i> Delivery Email:</span>
                        <span class="value" id="deliveredEmail"></span>
                    </div>
                    <div class="delivery-info-item">
                        <span class="label"><i class="fas fa-calendar-alt"></i> Date & Time:</span>
                        <span class="value" id="deliveredDateTime"></span>
                    </div>
                </div>
            <?php endforeach; ?>


            <!-- Back Button -->
            <div class="back-button-container">
                <button class="back-button" onclick="history.back()"><i class="fas fa-arrow-left"></i>
                    Back</button>
            </div>
            </div>
        </section>
    </main>
    </div>


    </body>

    </html>