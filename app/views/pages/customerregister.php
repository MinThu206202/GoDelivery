<!--  -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GoDelivery - Register</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap');

    html,
    body {
        height: 100%;
        margin: 0;
    }

    body {
        font-family: 'Poppins', sans-serif;
        /* overflow-y: auto; -- Removed this as it's no longer needed on the body */
    }

    /* Custom styles to hide the number input arrows */
    input[type="number"]::-webkit-outer-spin-button,
    input[type="number"]::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    input[type="number"] {
        -moz-appearance: textfield;
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

    <!-- Main Registration Container -->
    <div class="flex flex-col md:flex-row min-h-screen">

        <!-- Left Panel (Registration Form) -->
        <!-- Added overflow-y-auto to this container to make it scrollable -->
        <div class="relative flex flex-1 p-8 md:p-12 lg:p-16 bg-white overflow-y-auto">

            <!-- Back Button -->
            <a href="<?php echo URLROOT; ?>/pages/customerlogin"
                class="absolute top-4 left-4 p-2 text-gray-500 hover:text-gray-700 transition-colors duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </a>

            <div class="w-full max-w-lg p-6 lg:p-8 bg-white mx-auto">
                <!-- Logo -->
                <div class="text-center mb-6">
                    <div class="text-3xl font-extrabold text-[#1F265B]">GO<span class="text-[#FFA500]"> |
                        </span>DELIVERY</div>
                </div>

                <h2 class="text-2xl font-bold text-center text-gray-800 mb-2">Create a Customer Account</h2>
                <p class="text-center text-sm text-gray-600 mb-8">Join our community for seamless and efficient delivery
                    solutions.</p>

                <!-- Registration Form -->
                <form class="space-y-4" id="registerForm" method="POST"
                    action="<?php echo URLROOT; ?>/auth/customerregister">
                    <?php require APPROOT . '/views/components/auth_message.php'; ?>

                    <!-- Two-column grid for inputs -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="name" class="block text-base font-medium text-gray-700 mb-2">Full Name</label>
                            <input type="text" id="name" name="name" placeholder="Enter your full name"
                                class="w-full px-4 py-3 rounded-lg border-2 border-gray-300 focus:border-[#1F265B] focus:ring focus:ring-[#1F265B]/20 transition-all duration-200">
                        </div>
                        <div>
                            <label for="phone" class="block text-base font-medium text-gray-700 mb-2">Phone
                                Number</label>
                            <input type="number" id="phone" name="phone" placeholder="Enter your phone number"
                                class="w-full px-4 py-3 rounded-lg border-2 border-gray-300 focus:border-[#1F265B] focus:ring focus:ring-[#1F265B]/20 transition-all duration-200">
                        </div>
                        <div class="md:col-span-2">
                            <label for="email" class="block text-base font-medium text-gray-700 mb-2">Email
                                email</label>
                            <input type="email" id="email" name="email" placeholder="you@example.com"
                                class="w-full px-4 py-3 rounded-lg border-2 border-gray-300 focus:border-[#1F265B] focus:ring focus:ring-[#1F265B]/20 transition-all duration-200">
                        </div>
                        <!-- Updated address input, now a single field -->

                        <div>
                            <label for="password"
                                class="block text-base font-medium text-gray-700 mb-2">Password</label>
                            <div class="relative">
                                <input type="password" id="password" name="password" placeholder="Create a password"
                                    class="w-full px-4 py-3 pr-10 rounded-lg border-2 border-gray-300 focus:border-[#1F265B] focus:ring focus:ring-[#1F265B]/20 transition-all duration-200">
                                <button type="button" id="togglePassword"
                                    class="absolute inset-y-0 right-0 pr-3 flex items-center text-sm leading-5 text-gray-500">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>
                        <div>
                            <label for="confirm_password" class="block text-base font-medium text-gray-700 mb-2">Confirm
                                Password</label>
                            <div class="relative">
                                <input type="password" id="confirm_password" name="confirm_password"
                                    placeholder="Confirm your password"
                                    class="w-full px-4 py-3 pr-10 rounded-lg border-2 border-gray-300 focus:border-[#1F265B] focus:ring focus:ring-[#1F265B]/20 transition-all duration-200">
                                <button type="button" id="toggleConfirmPassword"
                                    class="absolute inset-y-0 right-0 pr-3 flex items-center text-sm leading-5 text-gray-500">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center space-x-2 mt-4">
                        <input type="checkbox" id="terms" name="terms" required
                            class="rounded text-[#1F265B] focus:ring-[#1F265B] h-4 w-4">
                        <label for="terms" class="text-base font-medium text-gray-600">
                            I agree to the <a href="#" class="text-[#1F265B] hover:text-[#1a237e] underline">Terms and
                                Conditions</a>
                        </label>
                    </div>

                    <button type="submit"
                        class="w-full mt-6 py-3 px-6 text-white font-semibold rounded-lg bg-[#1a237e] hover:bg-[#303f9f] transition-colors duration-200 shadow-md">
                        SIGN UP
                    </button>
                </form>

                <!-- Sign in section -->
                <div class="mt-8 text-center text-base text-gray-600">
                    <p>Already have an account?
                        <a href="<?php echo URLROOT; ?>/pages/customerlogin"
                            class="font-semibold text-[#1F265B] hover:text-[#1a237e]">Log In</a>
                    </p>
                </div>
            </div>
        </div>

        <!-- Right Panel (Welcome Message & Image) -->
        <div class="hidden md:flex flex-1 flex-col items-center justify-center p-8 lg:p-16 text-center text-white
                    bg-gradient-to-br from-[#1F265B] to-[#1a237e]">
            <div class="max-w-md">
                <h1 class="text-3xl lg:text-4xl font-extrabold mb-4 leading-tight">JOIN GODELIVERY TODAY</h1>
                <p class="text-lg lg:text-xl font-light mb-8 opacity-90">Experience fast, reliable, and seamless
                    delivery services for all your needs.</p>

                <!-- Delivery Illustration Image -->
                <img src="<?php echo URLROOT; ?>/public/images/login.png" alt="Customer App Illustration"
                    class="w-full h-auto rounded-lg shadow-xl">
            </div>
        </div>
    </div>

    <!-- JavaScript to handle password visibility -->
    <script>
    // Password visibility toggling logic
    const passwordInput = document.getElementById('password');
    const confirmPasswordInput = document.getElementById('confirm_password');
    const togglePassword = document.getElementById('togglePassword');
    const toggleConfirmPassword = document.getElementById('toggleConfirmPassword');

    togglePassword.addEventListener('click', () => {
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        togglePassword.querySelector('i').classList.toggle('fa-eye');
        togglePassword.querySelector('i').classList.toggle('fa-eye-slash');
    });

    toggleConfirmPassword.addEventListener('click', () => {
        const type = confirmPasswordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        confirmPasswordInput.setAttribute('type', type);
        toggleConfirmPassword.querySelector('i').classList.toggle('fa-eye');
        toggleConfirmPassword.querySelector('i').classList.toggle('fa-eye-slash');
    });
    </script>
</body>

</html>