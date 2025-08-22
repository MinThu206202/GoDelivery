<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();

    $email = $_SESSION['post_email'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>GoDelivery - OTP Sent</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/deliverycss/otp.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo URLROOT; ?>/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo URLROOT; ?>/vendor/bootstrap/css/bootstrap.min.css">



    <style>
        .otp-input-container input {
            width: 40px;
            text-align: center;
            font-size: 24px;
            margin-right: 20px;
        }

        .otp-input-container input:nth-child(3) {
            margin-right: 30px;
        }
    </style>
</head>

<body>
    <div class="left-panel">
        <div class="left-content">
            <div class="logo">GO<span style="color: #FFA500; font-weight: 800;"> | </span>DELIVERY</div>
            <div class="otp-sent-title">OTP SENT</div>
            <div class="instruction-text">
                We've sent a code to
                <strong><?= isset($_SESSION['post_email']) ? htmlspecialchars($email) : 'your email' ?></strong>.<br />
                Enter the OTP below to continue.
            </div>

            <!-- OTP Form -->
            <form method="POST" action="<?php echo URLROOT; ?>/auth/otp">
                <?php require APPROOT . '/views/components/auth_message.php'; ?>
                <div class="otp-input-container">
                    <?php for ($i = 0; $i < 6; $i++): ?>
                        <input type="text" name="otp[]" maxlength="1" pattern="[0-9]" inputmode="numeric"
                            autocomplete="one-time-code" required />
                    <?php endfor; ?>
                </div>

                <!-- Timer and resend code container -->
                <div id="timerContainer"
                    style="margin: 15px 0; font-family: 'Poppins', sans-serif; font-size: 14px; color: #555;">
                    <span id="codeMessage"><span id="timer"></span></span>
                </div>



                <button class="submit-button" type="submit">SUBMIT</button>
            </form>

            <div class="back-to-login">
                <a href="<?php echo URLROOT; ?>/pages/login"><i class="fas fa-arrow-left"></i> Back To Login</a>
            </div>
        </div>

        <div class="bottom-navigation">
            <a href="<?php echo URLROOT; ?>/pages/forgetpassword" class="back-link"><i class="fas fa-arrow-left"></i>
                BACK</a>
            <div class="dots-navigation">
                <div class="dot"></div>
                <div class="dot active"></div>
                <div class="dot"></div>
                <!-- <div class="dot"></div> -->
            </div>
        </div>
    </div>

    <div class="right-panel">
        <div class="welcome-title">WELCOME TO GODELIVERY</div>
        <div class="tagline">YOUR TRUSTED PARTNER<br />IN FAST & RELIABLE DELIVERIES</div>
        <div class="delivery-image">
            <img src="<?php echo URLROOT; ?>/public/images/otp.png" alt="Delivery Van with Driver" />
        </div>
    </div>

    <!-- Pass error presence to JS -->
    <?php if (!empty($error)): ?>
        <script>
            window.hasOtpError = true;
        </script>
    <?php else: ?>
        <script>
            window.hasOtpError = false;
        </script>
    <?php endif; ?>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // OTP input behavior
            const inputs = document.querySelectorAll('.otp-input-container input');

            inputs.forEach((input, index) => {
                input.addEventListener('keydown', (e) => {
                    if (
                        (e.key >= '0' && e.key <= '9') ||
                        e.key === 'Backspace' ||
                        e.key === 'Tab' ||
                        e.key === 'ArrowLeft' ||
                        e.key === 'ArrowRight' ||
                        e.key === 'Delete'
                    ) {
                        if (e.key === 'Backspace') {
                            if (input.value === '') {
                                if (index > 0) {
                                    inputs[index - 1].focus();
                                    inputs[index - 1].value = '';
                                    e.preventDefault();
                                }
                            } else {
                                input.value = '';
                                e.preventDefault();
                            }
                        }
                    } else {
                        e.preventDefault();
                    }
                });

                input.addEventListener('input', () => {
                    if (input.value.match(/^[0-9]$/)) {
                        if (index < inputs.length - 1) {
                            inputs[index + 1].focus();
                        }
                    } else {
                        input.value = '';
                    }
                });

                input.addEventListener('paste', (e) => {
                    e.preventDefault();
                    const paste = (e.clipboardData || window.clipboardData).getData('text');
                    if (!/^\d+$/.test(paste)) return;
                    for (let i = 0; i < inputs.length; i++) {
                        inputs[i].value = paste[i] || '';
                    }
                    const lastFilledIndex = Math.min(paste.length, inputs.length) - 1;
                    inputs[lastFilledIndex].focus();
                });
            });

            // Timer logic
            const timerDuration = 60; // seconds
            let countdown;

            function startTimer() {
                const codeMessage = document.getElementById('codeMessage');
                codeMessage.innerHTML = `<span id="timer"></span>`;
                const timerSpan = document.getElementById('timer');
                let timeLeft = timerDuration;
                timerSpan.textContent = `(${timeLeft}s)`;

                countdown = setInterval(() => {
                    timeLeft--;
                    if (timeLeft <= 0) {
                        clearInterval(countdown);
                        timerSpan.textContent = '';
                        codeMessage.innerHTML = `
                            DIDN'T GET CODE? 
                            <a href="<?php echo URLROOT ?>/auth/for" id="requestAgainLink" style="color:#FFA500; font-weight:600; text-decoration:none;">
                                REQUEST AGAIN
                            </a>
                        `;
                        document.getElementById('requestAgainLink').addEventListener('click', function(e) {
                            e.preventDefault();
                            resendCodeAndStartTimer();
                        });
                    } else {
                        timerSpan.textContent = `(${timeLeft}s)`;
                    }
                }, 1000);
            }

            function resendCodeAndStartTimer() {
                const codeMessage = document.getElementById('codeMessage');
                codeMessage.innerHTML = `<span id="timer"></span>`;

                // TODO: Add AJAX or backend call here to resend OTP

                startTimer();
            }

            // Show or hide timer container based on error presence
            const timerContainer = document.getElementById('timerContainer');

            if (window.hasOtpError) {
                // Hide timer and resend link if error exists
                timerContainer.style.display = 'none';
            } else {
                // Show timer container and start timer if no error
                timerContainer.style.display = 'block';
                startTimer();
            }
        });
    </script>
</body>

</html>