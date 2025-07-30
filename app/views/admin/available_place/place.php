<?php
require_once APPROOT . '/views/inc/sidebar.php';
?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>/public/deliverycss/admin/place.css">
<style>
    /* Custom styles for the view button */
    .view-button {
        display: inline-block;
        /* Make anchor tag behave like a button */
        background-color: #007bff;
        color: white;
        padding: 8px 12px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        text-decoration: none;
        /* Remove underline */
        font-size: 14px;
        font-weight: 500;
        transition: background-color 0.3s ease;
    }

    .view-button:hover {
        background-color: #0056b3;
    }

    /* Styles for Status spans */
    .status-active {
        background-color: #d4edda;
        /* Light green background */
        color: #155724;
        /* Dark green text */
        padding: 4px 8px;
        border-radius: 12px;
        font-weight: bold;
        text-transform: capitalize;
    }

    .status-inactive {
        background-color: #f8d7da;
        /* Light red background */
        color: #721c24;
        /* Dark red text */
        padding: 4px 8px;
        border-radius: 12px;
        font-weight: bold;
        text-transform: capitalize;
    }

    /* Alert style for missing agent name */
    .agent-missing {
        background-color: #fff3cd;
        /* light yellow */
        color: #856404;
        /* dark yellow/brown */
        font-weight: 600;
        padding: 4px 8px;
        border-radius: 6px;
        text-align: center;
    }

    /* Combined and increased height for the table container with increased specificity */
    .agent-list-panel .table-responsive {
        max-height: 500px;
        overflow-y: auto;
        overflow-x: auto;
    }
</style>

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
                <button class="add-agent-button" onclick="window.location.href='<?= URLROOT ?>/available_place/addplace'">
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
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="placeTableBody">
                    <?php if (!empty($data['availabel_place'])): ?>
                        <?php foreach ($data['availabel_place'] as $place): ?>
                            <?php
                            $status = strtolower($place['name'] ?? '');
                            $statusClass = $status === 'active' ? 'status-active' : 'status-inactive';
                            ?>
                            <tr>
                                <td><?= htmlspecialchars($place['region_name'] ?? 'No') ?></td>
                                <td><?= htmlspecialchars($place['city_name'] ?? 'No') ?></td>
                                <td><?= htmlspecialchars($place['township_name'] ?? 'No Agent Yet') ?></td>
                                <td class="<?= empty($place['agent_name']) ? 'agent-missing' : '' ?>">
                                    <?= !empty($place['agent_name']) ? htmlspecialchars($place['agent_name']) : 'No Agent Yet' ?>
                                </td>
                                <td><span class="<?= $statusClass ?>"><?= htmlspecialchars($place['name'] ?? 'No') ?></span></td>
                                <td>
                                    <a href="<?= URLROOT ?>/available_place/place_detail?id=<?= htmlspecialchars($place['id'] ?? '') ?>" class="view-button">View</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" style="text-align:center;">No places available.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </section>
</main>