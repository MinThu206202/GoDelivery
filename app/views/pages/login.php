<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>GoDelivery - Login</title>

	<script src="https://cdn.tailwindcss.com"></script>
	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />

	<style>
		/* Custom CSS variables from the original file */
		@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap');

		:root {
			--primary-color: #1F265B;
			--secondary-color: #333;
			--text-color: #555;
			--heading-color: #333;
			--light-grey: #f8f8f8;
			--dark-blue-footer: #1a237e;
			--white: #fff;
			--border-color: #ddd;
			--form-bg-color: #e6f0ff;
			--section-bg-color: #f0f4f7;
			--orange-accent: #FFA500;
		}

		body {
			font-family: 'Poppins', sans-serif;
			color: var(--text-color);
			background-color: var(--light-grey);
		}

		.login-container {
			display: flex;
			min-height: 100vh;
			overflow: hidden;
		}

		.login-left {
			flex: 1;
			display: flex;
			align-items: center;
			justify-content: center;
			padding: 2rem;
			background-color: var(--white);
			position: relative;
		}

		.login-right {
			flex: 1;
			display: flex;
			align-items: center;
			justify-content: center;
			padding: 2rem;
			background-color: var(--primary-color);
			color: var(--white);
		}

		.login-form-wrapper {
			width: 100%;
			max-width: 400px;
		}

		.login-logo {
			text-align: center;
			margin-bottom: 2rem;
		}

		.login-logo .logo {
			font-size: 2.5em;
			font-weight: 800;
			color: var(--primary-color);
		}

		.login-form h2 {
			font-size: 1.8em;
			font-weight: 600;
			margin-bottom: 1.5rem;
			text-align: center;
			color: var(--heading-color);
		}

		.login-form label {
			display: block;
			margin-bottom: 0.5rem;
			font-weight: 500;
			color: var(--secondary-color);
		}

		.login-form input {
			width: 100%;
			padding: 0.75rem 1rem;
			margin-bottom: 1rem;
			border: 1px solid var(--border-color);
			border-radius: 0.5rem;
			font-size: 1em;
			background-color: var(--light-grey);
			color: var(--primary-color);
			outline: none;
			transition: border-color 0.2s ease;
		}

		.login-form input:focus {
			border-color: var(--primary-color);
		}

		.forgot-password {
			display: block;
			text-align: right;
			margin-bottom: 1.5rem;
			font-size: 0.9em;
			color: var(--primary-color);
			text-decoration: none;
		}

		.login-button {
			width: 100%;
			padding: 0.75rem;
			background-color: var(--primary-color);
			color: var(--white);
			font-weight: 600;
			border-radius: 0.5rem;
			cursor: pointer;
			transition: background-color 0.2s ease;
			border: none;
		}

		.login-button:hover {
			background-color: #0c1a4b;
		}

		.signup-section {
			text-align: center;
			margin-top: 1.5rem;
			font-size: 0.9em;
		}

		.signup-section p {
			display: inline;
		}

		.signup-section a {
			font-weight: 600;
			color: var(--primary-color);
			text-decoration: none;
			margin-left: 0.25rem;
		}

		.login-right .welcome-content {
			text-align: center;
			max-width: 500px;
		}

		.login-right h1 {
			font-size: 3em;
			font-weight: 800;
			line-height: 1.2;
			margin-bottom: 1rem;
		}

		.login-right p {
			font-size: 1.2em;
			font-weight: 400;
			margin-bottom: 0.5rem;
		}

		.welcome-content img {
			max-width: 100%;
			height: auto;
			margin-top: 2rem;
		}

		@media (max-width: 768px) {
			.login-container {
				flex-direction: column;
			}

			.login-right {
				display: none;
			}

			.login-left {
				width: 100%;
			}
		}

		.otp-input-container {
			display: flex;
			justify-content: center;
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
				<a href="javascript:history.back()"
					class="absolute top-4 left-4 p-2 text-gray-500 hover:text-gray-700 transition-colors duration-200">
					<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M15 18L9 12L15 6" stroke="#1F265B" stroke-width="2" stroke-linecap="round"
							stroke-linejoin="round" />
					</svg>
				</a>
				<div class="login-logo">
					<div class="logo">GO<span style="color: #FFA500;"> | </span>DELIVERY</div>
				</div>

				<h2>Login GoDelivery Business</h2>

				<form class="login-form" id="loginForm" method="POST" action="<?php echo URLROOT; ?>/auth/login">
					<!-- Placeholder for PHP include. In a real environment, you would use this. -->
					<?php require APPROOT . '/views/components/auth_message.php'; ?>

					<label for="securityCode">Security Code</label>
					<div class="otp-input-container">
						<?php for ($i = 0; $i < 6; $i++): ?>
							<input type="text" name="security_code[]" maxlength="1" pattern="[0-9]" inputmode="numeric"
								autocomplete="one-time-code" required />
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

				<img src="https://placehold.co/400x250/E0E0E0/666?text=Delivery+Illustration"
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
					if ((e.key >= '0' && e.key <= '9') || ['Backspace', 'Tab', 'ArrowLeft',
							'ArrowRight', 'Delete'
						].includes(e.key)) {
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
					const paste = (e.clipboardData || window.clipboardData).getData('text').replace(
						/\D/g, '');
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