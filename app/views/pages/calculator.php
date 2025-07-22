<?php require_once APPROOT . '/views/inc/nav.php'; ?>
<?php require_once APPROOT . '/views/inc/header.php'; ?>

<section class="page-header">
    <div class="container">
        <h1>Prcie Calculator</h1>
        <p>Home <i class="fas fa-arrow-right"></i> Price Calculator</p>
    </div>
</section>

<section class="calculator-form-section">
    <div class="container">
        <div class="form-row">
            <div class="form-group">
                <label for="fromCity">From City</label>
                <select id="fromCity">
                    <option>Yangon</option>
                    <option>Mandalay</option>
                    <option>Naypyidaw</option>
                </select>
            </div>
            <div class="form-group">
                <label for="toCity">To City</label>
                <select id="toCity">
                    <option>Mandalay</option>
                    <option>Yangon</option>
                    <option>Naypyidaw</option>
                </select>
            </div>
            <div class="form-group">
                <label for="serviceType">Service Type</label>
                <select id="serviceType">
                    <option>Express</option>
                    <option>Standard</option>
                </select>
            </div>
            <a href="./calculate_result.html">
                <button class="calculate-button">Calculate</button>
            </a>
        </div>
    </div>
</section>

<section class="calculation-guide-section">
    <div class="container">
        <img src="../image/calculate.png" alt="Volume and Irregular Item Calculation Guide"
            style="max-width: 100%; height: auto;">
    </div>
</section>

<?php require_once APPROOT . '/views/inc/footer.php'; ?>