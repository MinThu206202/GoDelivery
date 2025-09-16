<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GoDelivery - Forgot Password</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/deliverycss/forgetpassword.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo URLROOT; ?>/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo URLROOT; ?>/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css"
        href="<?php echo URLROOT; ?>/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo URLROOT; ?>/vendor/animate/animate.css">
    <link rel="stylesheet" type="text/css" href="<?php echo URLROOT; ?>/vendor/css-hamburgers/hamburgers.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo URLROOT; ?>/vendor/select2/select2.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo URLROOT; ?>/css/util.css">
    <link rel="stylesheet" type="text/css" href="<?php echo URLROOT; ?>/css/main.css">


</head>

<body>
    <div class="left-panel">
        <div class="left-content">
            <div class="logo">GO<span style="color: #FFA500; font-weight: 800;"> | </span>DELIVERY</div>
            <div class="forgot-password-title">Forgot Password?</div>
            <div class="instruction-text">
                Enter your registered mobile number and we'll send you an OTP.
            </div>
            <div style="color: red;">
                <?php require APPROOT . '/views/components/auth_mess.php'; ?>
            </div>

            </style>
            <?php if (!empty($email_err = $data['email-err'] ?? '')) : ?>
            <p class="error"><?= $email_err ?></p>
            <?php endif; ?>

            <!-- ✅ FORM START -->
            <form method="POST" action="<?php echo URLROOT; ?>/auth/forgetpassword">
                <div class="input-container">
                    <i class="fas fa-mobile-alt icon"></i>
                    <input type="text" placeholder="Enter Email Address" name="email" required>
                </div>



                <button type="submit" class="submit-button">SUBMIT</button>
            </form>
            <!-- ✅ FORM END -->

            <div class="back-to-login">
                <a href="<?php echo URLROOT; ?>/pages/login"><i class="fas fa-arrow-left"></i> Back To Login</a>
            </div>
        </div>

        <div class="dots-navigation">
            <div class="dot active"></div>
            <div class="dot"></div>
            <div class="dot"></div>
            <!-- <div class="dot"></div> -->
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