<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GoDelivery - Login</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap');

    body {
        font-family: 'Poppins', sans-serif;
    }

    .auth-message {
        padding: 0.75rem 1rem;
        border-radius: 12px;
        font-weight: 600;
        margin-bottom: 1rem;
        text-align: center;
    }

    .auth-message.error {
        background: #fee2e2;
        /* light red background */
        color: #dc2626;
        /* red text */
        border: 1px solid #fecaca;
    }

    .auth-message.success {
        background: #d1fae5;
        /* light green background */
        color: #065f46;
        /* green text */
        border: 1px solid #a7f3d0;
    }
    </style>
</head>

<body class="bg-gray-100 font-poppins antialiased">

    <!-- Main Login Container -->
    <div class="flex flex-col md:flex-row min-h-screen">

        <!-- Left Panel (Login Form) -->
        <div class="relative flex flex-1 items-center justify-center p-8 md:p-12 lg:p-16 bg-white">

            <!-- Back Button -->
            <a href="<?php echo URLROOT; ?>/pages/index"
                class="absolute top-4 left-4 p-2 text-gray-500 hover:text-gray-700 transition-colors duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </a>

            <div class="w-full max-w-sm lg:max-w-md p-6 lg:p-8 bg-white">
                <!-- Logo -->
                <div class="text-center mb-10">
                    <div class="text-3xl font-extrabold text-[#1F265B]">GO<span class="text-[#FFA500]"> |
                        </span>DELIVERY</div>
                </div>

                <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Login to your account</h2>

                <!-- Login Form -->
                <form class="space-y-6" id="loginForm" method="POST" action="<?php echo URLROOT; ?>/auth/customerlogin">
                    <?php require APPROOT . '/views/components/auth_message.php'; ?>

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email address</label>
                        <input type="email" id="email" name="email" placeholder="you@example.com" required
                            class="w-full px-4 py-3 rounded-lg border-2 border-gray-300 focus:border-[#1F265B] focus:ring focus:ring-[#1F265B]/20 transition-all duration-200">
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                        <div class="relative">
                            <input type="password" id="password" name="password" placeholder="Enter your password"
                                required
                                class="w-full px-4 py-3 pr-10 rounded-lg border-2 border-gray-300 focus:border-[#1F265B] focus:ring focus:ring-[#1F265B]/20 transition-all duration-200">
                            <button type="button" id="togglePassword"
                                class="absolute inset-y-0 right-0 pr-3 flex items-center text-sm leading-5 text-gray-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <div class="flex justify-end">
                        <a href="#" class="text-sm font-medium text-[#1F265B] hover:text-[#1a237e]">Forgot Password?</a>
                    </div>

                    <button type="submit"
                        class="w-full py-3 px-6 text-white font-semibold rounded-lg bg-[#1a237e] hover:bg-[#303f9f] transition-colors duration-200 shadow-md">
                        LOGIN
                    </button>
                </form>

                <!-- Sign up section -->
                <div class="mt-8 text-center text-sm text-gray-600">
                    <p>Don't have an account?
                        <a href="<?php echo URLROOT; ?>/pages/customerregister"
                            class="font-semibold text-[#1F265B] hover:text-[#1a237e]">Sign Up</a>
                    </p>
                    <p>Login as a staff member?
                        <a href="<?php echo URLROOT; ?>/pages/login"
                            class="font-semibold text-[#1F265B] hover:text-[#1a237e]">Staff</a>
                    </p>
                </div>

            </div>
        </div>

        <!-- Right Panel (Welcome Message & Image) -->
        <div class="hidden md:flex flex-1 flex-col items-center justify-center p-8 lg:p-16 text-center text-white
                    bg-gradient-to-br from-[#1F265B] to-[#1a237e]">
            <div class="max-w-md">
                <h1 class="text-3xl lg:text-4xl font-extrabold mb-4 leading-tight">WELCOME TO GODELIVERY</h1>
                <p class="text-lg lg:text-xl font-light mb-8 opacity-90">YOUR TRUSTED PARTNER IN FAST & RELIABLE
                    DELIVERIES</p>

                <!-- Delivery Illustration Image -->
                <img src="<?php echo URLROOT; ?>/public/images/login.png" alt="Delivery Illustration"
                    class="w-full h-auto rounded-lg shadow-xl">
            </div>
        </div>
    </div>

    <!-- JavaScript to toggle password visibility -->
    <script>
    const passwordInput = document.getElementById('password');
    const toggleButton = document.getElementById('togglePassword');

    toggleButton.addEventListener('click', () => {
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            // You could change the SVG icon here to an 'eye-off' icon
        } else {
            passwordInput.type = 'password';
            // You could change the SVG icon here to an 'eye' icon
        }
    });
    </script>
</body>

</html>