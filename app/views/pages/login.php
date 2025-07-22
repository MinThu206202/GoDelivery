<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>GoDelivery - Login</title>

	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
	<link rel="stylesheet" href="<?php echo URLROOT; ?>/public/deliverycss/login.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo URLROOT; ?>/vendor/bootstrap/css/bootstrap.min.css">

	<style>
		.otp-input-container {
			display: flex;
			justify-content: space-between;
			gap: 10px;
			margin: 20px 0;
		}

		.otp-input-container input {
			width: 52px;
			height: 52px;
			text-align: center;
			font-size: 20px;
			font-weight: 600;
			border: 2px solid #ccc;
			border-radius: 12px;
			background-color: #f8f9ff;
			color: #1F265B;
			outline: none;
			transition: 0.2s ease;
			box-shadow: 0 1px 3px rgba(31, 38, 91, 0.2);
		}

		.otp-input-container input:focus {
			border-color: #1F265B;
			background-color: #e6e9ff;
			box-shadow: 0 0 10px rgba(31, 38, 91, 0.4);
			transform: scale(1.05);
		}

		@media (max-width: 480px) {
			.otp-input-container {
				justify-content: center;
				gap: 6px;
			}

			.otp-input-container input {
				width: 44px;
				height: 44px;
				font-size: 18px;
			}
		}
	</style>
</head>

<body>
	<div class="login-container">
		<div class="login-left">
			<div class="login-form-wrapper">
				<div class="login-logo">
					<div class="logo">GO<span style="color: #FFA500;"> | </span>DELIVERY</div>
				</div>

				<h2>Login GoDelivery Business</h2>

				<form class="login-form" id="loginForm" method="POST" action="<?php echo URLROOT; ?>/auth/login">
					<?php require APPROOT . '/views/components/auth_message.php'; ?>

					<label for="securityCode">Security Code</label>
					<div class="otp-input-container">
						<?php for ($i = 0; $i < 6; $i++): ?>
							<input type="text" name="security_code[]" maxlength="1" pattern="[0-9]" inputmode="numeric" autocomplete="one-time-code" required />
						<?php endfor; ?>
					</div>

					<label for="password">Password</label>
					<input type="password" id="password" name="password" placeholder="Enter Password" required />

					<a href="<?php echo URLROOT; ?>/pages/forgetpassword" class="forgot-password">Forgot Password?</a>
					<button type="submit" class="login-button">LOGIN</button>
				</form>

				<div class="signup-section">
					<p>DON'T HAVE AN ACCOUNT?</p>
					<a href="<?php echo URLROOT; ?>/pages/register" class="sign-up-link">SIGN UP</a>
				</div>
			</div>
		</div>

		<div class="login-right">
			<div class="welcome-content">
				<h1>WELCOME TO GODELIVERY</h1>
				<p>YOUR TRUSTED PARTNER</p>
				<p>IN FAST & RELIABLE DELIVERIES</p>

				<img src="/GoDelivery/assets/image/login.png"
					onerror="this.onerror=null; this.src='https://placehold.co/400x250/E0E0E0/666?text=Delivery+Illustration';"
					alt="Delivery Illustration" />
			</div>
		</div>
	</div>

	<!-- JS for OTP auto tab -->
	<script>
		document.addEventListener('DOMContentLoaded', () => {
			const inputs = document.querySelectorAll('.otp-input-container input');

			inputs.forEach((input, index) => {
				input.addEventListener('keydown', (e) => {
					if ((e.key >= '0' && e.key <= '9') || ['Backspace', 'Tab', 'ArrowLeft', 'ArrowRight', 'Delete'].includes(e.key)) {
						if (e.key === 'Backspace') {
							if (input.value === '' && index > 0) {
								inputs[index - 1].focus();
								inputs[index - 1].value = '';
								e.preventDefault();
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
					if (/^[0-9]$/.test(input.value)) {
						if (index < inputs.length - 1) {
							inputs[index + 1].focus();
						}
					} else {
						input.value = '';
					}
				});

				input.addEventListener('paste', (e) => {
					e.preventDefault();
					const paste = (e.clipboardData || window.clipboardData).getData('text').replace(/\D/g, '');
					for (let i = 0; i < inputs.length; i++) {
						inputs[i].value = paste[i] || '';
					}
					if (paste.length > 0) {
						inputs[Math.min(paste.length, inputs.length) - 1].focus();
					}
				});
			});
		});
	</script>
</body>

</html>