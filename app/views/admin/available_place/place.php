<?php
require_once APPROOT . '/views/inc/sidebar.php';
?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>/public/deliverycss/admin/place.css">

<main class="main-content">
    <header class="dashboard-header">
        <div class="header-left">
            <h2 class="page-title"><i class="fas fa-map-marker-alt"></i> Available Places</h2>
            <div class="dashboard-search-with-filters agent-filters">
                <div class="filter-group">
                    <label for="filterPlace">City Name</label>
                    <input type="text" id="filterPlace" placeholder="Enter City">
                </div>
                <button id="searchPlaceBtn" class="search-button"><i class="fas fa-search"></i> Search</button>
            </div>
        </div>
        <div class="header-right">
            <div class="admin-profile">
                <div class="profile-icon"><i class="fas fa-user-circle"></i></div>
                <span></span>
            </div>
        </div>
    </header>

    <section class="agent-list-panel panel">
        <div class="panel-header-with-button">
            <h3>Place List</h3>
            <div class="button-group">
                <button class="add-agent-button" onclick="window.location.href='<?= URLROOT ?>/availableplace/add'">
                    <i class="fas fa-plus"></i> Add Place
                </button>
            </div>
        </div>

        <div class="table-responsive">
            <table id="placeTable">
                <thead>
                    <tr>
                        <th>Region</th>
                        <th>City</th>
                        <th>Township</th>
                        <th>Agent Name</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody id="placeTableBody">
                    <?php if (!empty($data['places'])): ?>
                        <?php foreach ($data['places'] as $place): ?>
                            <?php
                            $status = strtolower($place['status']);
                            $statusClass = $status === 'active' ? 'status-active' : 'status-inactive';
                            ?>
                            <tr>
                                <td><?= htmlspecialchars($place['city']) ?></td>
                                <td><?= htmlspecialchars($place['region']) ?></td>
                                <td><span class="<?= $statusClass ?>"><?= htmlspecialchars($place['status']) ?></span></td>
                                <td><button class="view-button">View</button></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4" style="text-align:center;">No places available.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </section>
</main>