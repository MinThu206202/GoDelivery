<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();

    $email = $_SESSION['post_email'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GoDelivery - New Password Setup</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/deliverycss/changepassword.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo URLROOT; ?>/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo URLROOT; ?>/vendor/bootstrap/css/bootstrap.min.css">

</head>

<body>
    <div class="left-panel">
        <div class="left-content">
            <div class="logo">GO<span style="color: #FFA500; font-weight: 800;"> | </span>DELIVERY</div>
            <div class="password-setup-title">New Password Setup</div>
            <div class="instruction-text">
                Please enter a new password,<br>
                must be at least 8 characters.
            </div>



            <!-- ✅ FORM TAG ADDED -->
            <form method="POST" action="<?php echo URLROOT; ?>/auth/changepassword">
                <?php require APPROOT . '/views/components/auth_message.php'; ?>

                <div class="input-container">
                    <input type="password" name="new_password" placeholder="Enter New Password" required>
                </div>
                <div class="input-container">
                    <input type="password" name="confirm_password" placeholder="Confirm Password" required>
                </div>
                <button class="submit-button" type="submit">SUBMIT</button>
            </form>

            <div class="back-to-login">
                <a href="<?php echo URLROOT; ?>/pages/login"><i class="fas fa-arrow-left"></i> Back To Login</a>
            </div>
        </div>

        <div class="bottom-navigation">
            <a href="<?php echo URLROOT; ?>/pages/otp" class="back-link"><i class="fas fa-arrow-left"></i> BACK</a>
            <div class="dots-navigation">
                <div class="dot"></div>
                <div class="dot"></div>
                <!-- <div class="dot"></div> -->
                <div class="dot active"></div>
            </div>
        </div>
    </div>

    <div class="right-panel">
        <div class="welcome-title">WELCOME TO GODELIVERY</div>
        <div class="tagline">
            YOUR TRUSTED PARTNER<br>
            IN FAST & RELIABLE DELIVERIES
        </div>
        <div class="delivery-image">
            <img src="<?php echo URLROOT; ?>/public/images/otp.png" alt="Delivery Van with Driver">
        </div>
    </div>
</body>

</html>