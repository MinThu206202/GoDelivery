<?php require_once APPROOT . '/views/inc/agentsidebar.php'; ?>

<script src="https://cdn.tailwindcss.com"></script>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<style>
    body {
        font-family: 'Inter', sans-serif;
        background-color: #f3f4f6;
    }

    /* Enhanced shadow for cards */
    .card-shadow {
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
    }

    /* Custom focus style for inputs */
    .input-focus-ring:focus {
        outline: none;
        border-color: #1F265B;
        /* Primary blue */
        box-shadow: 0 0 0 3px rgba(31, 38, 91, 0.3);
        /* Blue with transparency */
    }

    /* Style for the profile image container to allow overlay button */
    .profile-image-container {
        position: relative;
        width: 150px;
        /* Match image width */
        height: 150px;
        /* Match image height */
        border-radius: 9999px;
        /* Full rounded for circle */
        overflow: hidden;
        /* Ensure content stays within circle */
        margin: 0 auto;
        /* Center the image in its flex item */
        margin-bottom: 1rem;
        /* Space below the image */
    }

    /* Style for the change photo overlay button */
    .change-photo-overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        background-color: rgba(0, 0, 0, 0.5);
        /* Semi-transparent black */
        color: white;
        padding: 0.5rem 0;
        text-align: center;
        font-size: 0.875rem;
        /* text-sm */
        cursor: pointer;
        opacity: 0;
        transition: opacity 0.3s ease-in-out;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.25rem;
    }

    .profile-image-container:hover .change-photo-overlay {
        opacity: 1;
    }

    /* Modal styles */
    .modal-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.6);
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 1000;
        opacity: 0;
        visibility: hidden;
        transition: opacity 0.3s ease-in-out, visibility 0.3s ease-in-out;
    }

    .modal-overlay.show {
        opacity: 1;
        visibility: visible;
    }

    .modal-content {
        background-color: white;
        padding: 2rem;
        border-radius: 0.75rem;
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        width: 90%;
        max-width: 400px;
        text-align: center;
        transform: translateY(-20px);
        transition: transform 0.3s ease-in-out;
    }

    .modal-overlay.show .modal-content {
        transform: translateY(0);
    }

    /* OTP input specific styles */
    .otp-input-group {
        display: flex;
        justify-content: center;
        gap: 0.5rem;
        margin-bottom: 1.5rem;
    }

    .otp-input {
        width: 2.5rem;
        /* Adjust width as needed */
        height: 2.5rem;
        /* Adjust height as needed */
        text-align: center;
        font-size: 1.25rem;
        /* text-xl */
        border: 1px solid #d1d5db;
        /* gray-300 */
        border-radius: 0.375rem;
        /* rounded-md */
        box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
        /* shadow-sm */
        -moz-appearance: textfield;
        /* Hide arrows for Firefox */
    }

    .otp-input::-webkit-outer-spin-button,
    .otp-input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    .otp-input:focus {
        outline: none;
        border-color: #1F265B;
        box-shadow: 0 0 0 3px rgba(31, 38, 91, 0.3);
    }

    /* Custom alert box styling */
    .custom-alert {
        position: fixed;
        top: 20px;
        left: 50%;
        transform: translateX(-50%);
        padding: 1rem 2rem;
        border-radius: 0.5rem;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        z-index: 1000;
        display: flex;
        align-items: center;
        gap: 1rem;
        opacity: 0;
        /* Start hidden for animation */
        transition: opacity 0.3s ease-in-out;
    }

    .custom-alert.show {
        opacity: 1;
        /* Show when 'show' class is added */
    }

    .custom-alert.success {
        background-color: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
    }

    .custom-alert.error {
        background-color: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
    }

    .custom-alert-close {
        cursor: pointer;
        font-weight: bold;
        font-size: 1.2rem;
        margin-left: auto;
    }
</style>


<div class="flex-1 flex flex-col overflow-hidden">
    <header class="flex items-center justify-between p-6 bg-white shadow-lg rounded-bl-xl">
        <h1 class="text-3xl font-semibold text-gray-800">Agent Profile</h1>
        <div class="flex items-center space-x-4">
            <div class="flex items-center space-x-2">
                <img src="https://placehold.co/40x40/FF6347/FFFFFF?text=JD" alt="Agent Avatar"
                    class="w-10 h-10 rounded-full border-2 border-blue-500 shadow-md">
                <div>
                    <p class="text-lg font-medium text-gray-800">John Doe</p>
                    <p class="text-sm text-gray-500">Agent ID: #007</p>
                </div>
            </div>
            <a href="#"
                class="px-4 py-2 bg-[#1F265B] text-white rounded-lg hover:bg-[#2A346C] transition-colors duration-200 shadow-md hover:shadow-lg">Back
                to Dashboard</a>
        </div>
    </header>

    <main class="flex-1 overflow-y-auto p-6 bg-gray-100">
        <div id="message-box-container"></div>

        <div class="max-w-4xl mx-auto bg-white p-8 rounded-xl shadow-xl border border-gray-200">
            <div
                class="flex flex-col md:flex-row items-center md:items-start space-y-6 md:space-y-0 md:space-x-8 pb-8 mb-8 border-b border-gray-200">
                <div class="flex-shrink-0">
                    <div class="profile-image-container">
                        <img id="profileImage" src="https://placehold.co/150x150/1F265B/FFFFFF?text=JD" alt="Agent Profile Picture"
                            class="w-full h-full object-cover border-4 border-[#1F265B] shadow-lg">
                    </div>
                </div>
                <div class="text-center md:text-left flex-grow">
                    <h2 class="text-4xl font-bold text-gray-900 mb-2">John Doe</h2>
                    <p class="text-xl text-gray-600 mb-4">Delivery Agent</p>
                    <div class="flex items-center justify-center md:justify-start space-x-2 mb-2">
                        <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8m-2 4v7a2 2 0 01-2 2H7a2 2 0 01-2-2v-7"></path>
                        </svg>
                        <p class="text-lg text-gray-700">john.doe@example.com</p>
                    </div>
                    <div class="flex items-center justify-center md:justify-start space-x-2 mb-4">
                        <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                            </path>
                        </svg>
                        <p class="text-lg text-gray-700">+1 (555) 123-4567</p>
                    </div>
                    <span class="px-4 py-2 bg-green-100 text-green-800 rounded-full text-md font-medium shadow-sm">
                        Status: Active
                    </span>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <div>
                    <h3 class="text-2xl font-semibold text-gray-800 mb-4 border-b pb-2">Personal Information</h3>
                    <div class="space-y-3">
                        <p class="text-gray-700"><strong class="font-medium">Agent ID:</strong> #007</p>
                        <p class="text-gray-700"><strong class="font-medium">Date of Birth:</strong> 1990-05-15</p>
                        <p class="text-gray-700"><strong class="font-medium">Address:</strong> 123 Delivery St,
                            Cityville, CA 90210</p>
                        <p class="text-gray-700"><strong class="font-medium">Emergency Contact:</strong> Jane Doe
                            (555) 987-6543</p>
                    </div>
                </div>
            </div>

            <div class="flex justify-start space-x-4 mb-8 border-b pb-4 border-gray-200">
                <button type="button" onclick="toggleProfileForm('edit')"
                    class="px-6 py-2 bg-[#1F265B] text-white rounded-lg hover:bg-[#2A346C] transition-colors duration-200 shadow-md hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-[#1F265B] focus:ring-opacity-50">
                    Edit Profile
                </button>
                <button type="button" onclick="toggleProfileForm('password')"
                    class="px-6 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors duration-200 shadow-md hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-red-600 focus:ring-opacity-50">
                    Change Password
                </button>
            </div>

            <div id="editProfileFormContainer" class="hidden">
                <h3 class="text-2xl font-semibold text-gray-800 mb-4 border-b pb-2">Edit Profile</h3>
                <form class="space-y-6">
                    <div class="flex flex-col items-center mb-6">
                        <div class="profile-image-container">
                            <img id="editProfileImagePreview" src="https://placehold.co/150x150/1F265B/FFFFFF?text=JD" alt="Profile Preview"
                                class="w-full h-full object-cover border-4 border-[#1F265B] shadow-lg">
                            <input type="file" name="image" id="imageUpload" class="hidden" accept="image/*" onchange="previewEditImage(event)" required>
                            <label for="imageUpload" class="change-photo-overlay">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                Change Photo
                            </label>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="fullName" class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                            <input type="text" id="fullName" name="fullName" value="John Doe"
                                class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm input-focus-ring sm:text-sm">
                        </div>
                        <div>
                            <label for="address" class="block text-sm font-medium text-gray-700 mb-1">Address</label>
                            <input type="text" id="address" name="address" value="123 Delivery St, Cityville, CA 90210"
                                class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm input-focus-ring sm:text-sm">
                        </div>
                    </div>
                    <div class="flex justify-end space-x-4">
                        <button type="button" onclick="toggleProfileForm('hide_all')"
                            class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors duration-200 shadow-sm hover:shadow-md">Cancel</button>
                        <button type="submit"
                            class="px-6 py-2 bg-[#1F265B] text-white rounded-lg hover:bg-[#2A346C] transition-colors duration-200 shadow-md hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-[#1F265B] focus:ring-opacity-50">Save
                            Changes</button>
                    </div>
                </form>
            </div>

            <div id="changePasswordFormContainer" class="hidden">
                <h3 class="text-2xl font-semibold text-gray-800 mb-4 border-b pb-2 mt-8">Change Password</h3>
                <form class="space-y-6" action="/agentcontroller/reset_password_submit" method="POST">
                    <div id="currentPasswordInputGroup">
                        <label for="currentPassword" class="block text-sm font-medium text-gray-700 mb-1">Current Password</label>
                        <input type="password" id="currentPassword" name="currentPassword"
                            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm input-focus-ring sm:text-sm">
                    </div>
                    <div id="newPasswordResetMessage" class="hidden text-sm text-gray-600 mb-4">
                        <p class="text-green-700 font-medium">OTP Verified! Please set your new password.</p>
                    </div>
                    <div>
                        <label for="newPassword" class="block text-sm font-medium text-gray-700 mb-1">New Password</label>
                        <input type="password" id="newPassword" name="newPassword"
                            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm input-focus-ring sm:text-sm">
                    </div>
                    <div>
                        <label for="confirmNewPassword" class="block text-sm font-medium text-gray-700 mb-1">Confirm New Password</label>
                        <input type="password" id="confirmNewPassword" name="confirmNewPassword"
                            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm input-focus-ring sm:text-sm">
                    </div>
                    <div class="flex justify-between items-center">
                        <a href="#" onclick="openForgotPasswordModal(event)" class="text-sm text-blue-600 hover:underline">Forgot Password?</a>
                        <button type="submit"
                            class="px-6 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors duration-200 shadow-md hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-red-600 focus:ring-opacity-50">Change Password</button>
                    </div>
                </form>
            </div>
        </div>
    </main>
</div>



<div id="forgotPasswordModal" class="modal-overlay">
    <form action="<?= URLROOT ?>/agentcontroller/send_otp" method="POST" class="modal-content" onsubmit="sendOTP(event)">
        <h3 class="text-xl font-semibold text-gray-800 mb-4">Send OTP Code?</h3>
        <p class="text-gray-700 mb-6">Are you sure you want to send an OTP code to your registered email/phone for password reset?</p>
        <input type="hidden" name="user_id" value="<?= $agent['id'] ?? '' ?>">
        <input type="hidden" name="email" value="<?= htmlspecialchars($agent['email'] ?? '') ?>">

        <div class="flex justify-center space-x-4">
            <button type="submit"
                class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200 shadow-md focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-opacity-50">
                Confirm
            </button>
            <button type="button" onclick="closeModal('forgotPasswordModal')"
                class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors duration-200 shadow-sm">
                Cancel
            </button>
        </div>
    </form>
</div>

<div id="otpVerificationModal" class="modal-overlay">
    <div class="modal-content">
        <h3 class="text-xl font-semibold text-gray-800 mb-4">Enter OTP Code</h3>
        <p class="text-gray-700 mb-6">A 6-digit OTP code has been sent to your registered email/phone.</p>
        <form id="otpVerificationForm" action="/agentcontroller/verify_otp_submit" method="POST">
            <div class="otp-input-group">
                <input type="number" class="otp-input" id="otp1" name="otp[]" maxlength="1" onkeyup="moveToNext(this, 'otp2')" onkeydown="handleBackspace(event, this, null)" required>
                <input type="number" class="otp-input" id="otp2" name="otp[]" maxlength="1" onkeyup="moveToNext(this, 'otp3')" onkeydown="handleBackspace(event, this, 'otp1')" required>
                <input type="number" class="otp-input" id="otp3" name="otp[]" maxlength="1" onkeyup="moveToNext(this, 'otp4')" onkeydown="handleBackspace(event, this, 'otp2')" required>
                <input type="number" class="otp-input" id="otp4" name="otp[]" maxlength="1" onkeyup="moveToNext(this, 'otp5')" onkeydown="handleBackspace(event, this, 'otp3')" required>
                <input type="number" class="otp-input" id="otp5" name="otp[]" maxlength="1" onkeyup="moveToNext(this, 'otp6')" onkeydown="handleBackspace(event, this, 'otp4')" required>
                <input type="number" class="otp-input" id="otp6" name="otp[]" maxlength="1" onkeyup="moveToNext(this, null)" onkeydown="handleBackspace(event, this, 'otp5')" required>
            </div>
            <input type="hidden" name="user_identifier" value="<?= htmlspecialchars($_GET['identifier'] ?? '') ?>">

            <div class="flex justify-between items-center mt-4">
                <a href="/agentcontroller/resend_otp_request?identifier=<?= htmlspecialchars($_GET['identifier'] ?? '') ?>" class="text-sm text-blue-600 hover:underline">Resend OTP</a>
                <button type="submit"
                    class="px-6 py-2 bg-[#1F265B] text-white rounded-lg hover:bg-[#2A346C] transition-colors duration-200 shadow-md focus:outline-none focus:ring-2 focus:ring-[#1F265B] focus:ring-opacity-50">
                    Verify OTP
                </button>
            </div>
        </form>
        <button type="button" onclick="closeModal('otpVerificationModal')" class="absolute top-3 right-3 text-gray-500 hover:text-gray-700 text-xl font-bold">&times;</button>
    </div>
</div>


<script>
    /**
     * Displays a custom alert message.
     * @param {string} message - The message to display.
     * @param {string} type - The type of message ('success' or 'error').
     */
    function showCustomAlert(message, type) {
        const container = document.getElementById('message-box-container');
        if (!container) return;

        // Create the alert element
        const alertDiv = document.createElement('div');
        alertDiv.className = `custom-alert ${type}`;
        alertDiv.innerHTML = `
            <span>${message}</span>
            <span class="custom-alert-close" onclick="this.parentElement.remove()">&times;</span>
        `;
        container.appendChild(alertDiv);

        // Add 'show' class after a short delay to trigger fade-in animation
        setTimeout(() => alertDiv.classList.add('show'), 10);

        // Removed the automatic dismissal with setTimeout
        // The alert will now persist until the 'X' button is clicked.
    }

    /**
     * Toggles the visibility of the profile forms.
     * Hides all forms first, then shows the specified one.
     * @param {string} formType - 'edit' to show edit profile form, 'password' to show change password form, 'password_reset' to show password form for reset, 'hide_all' to hide both.
     */
    function toggleProfileForm(formType) {
        const editForm = document.getElementById('editProfileFormContainer');
        const passwordForm = document.getElementById('changePasswordFormContainer');
        const currentPasswordInputGroup = document.getElementById('currentPasswordInputGroup');
        const newPasswordResetMessage = document.getElementById('newPasswordResetMessage');
        const newPasswordInput = document.getElementById('newPassword');

        // Hide all forms and reset password form specific elements
        editForm.classList.add('hidden');
        passwordForm.classList.add('hidden');
        currentPasswordInputGroup.classList.remove('hidden'); // Ensure visible by default for regular change
        newPasswordResetMessage.classList.add('hidden'); // Ensure hidden by default

        // Show the requested form
        if (formType === 'edit') {
            editForm.classList.remove('hidden');
            // When opening edit form, ensure the preview image matches the main display image
            const mainProfileImageSrc = document.getElementById('profileImage').src;
            document.getElementById('editProfileImagePreview').src = mainProfileImageSrc;
        } else if (formType === 'password') {
            passwordForm.classList.remove('hidden');
            // For regular password change, current password is required
            currentPasswordInputGroup.classList.remove('hidden');
            newPasswordInput.focus(); // Focus on current password
        } else if (formType === 'password_reset') {
            passwordForm.classList.remove('hidden');
            currentPasswordInputGroup.classList.add('hidden'); // Hide current password for reset flow
            newPasswordResetMessage.classList.remove('hidden'); // Show reset message
            newPasswordInput.focus(); // Focus on new password
        }
        // If formType is 'hide_all' or anything else, both remain hidden.
    }

    /**
     * Handles the image file selection and displays a preview in the main profile image.
     * This function is for the *main* profile image area.
     * @param {Event} event - The change event from the file input.
     */
    function previewImage(event) {
        const profileImage = document.getElementById('profileImage');
        const file = event.target.files[0];

        if (file) {
            const reader = new FileReader();
            reader.onload = (e) => {
                profileImage.src = e.target.result;
                // Also update the preview in the edit form if it's open
                const editProfileImagePreview = document.getElementById('editProfileImagePreview');
                if (editProfileImagePreview) {
                    editProfileImagePreview.src = e.target.result;
                }
            };
            reader.readAsDataURL(file);
        }
    }

    /**
     * Handles the image file selection and displays a preview specifically for the edit profile form.
     * @param {Event} event - The change event from the file input.
     */
    function previewEditImage(event) {
        const editProfileImagePreview = document.getElementById('editProfileImagePreview');
        const mainProfileImage = document.getElementById('profileImage');
        const file = event.target.files[0];

        if (file) {
            const reader = new FileReader();
            reader.onload = (e) => {
                editProfileImagePreview.src = e.target.result;
                mainProfileImage.src = e.target.result; // Update main display too
            };
            reader.readAsDataURL(file);
        }
    }

    /**
     * Opens the "Forgot Password?" confirmation modal.
     * @param {Event} event - The click event from the "Forgot Password?" link.
     */
    function openForgotPasswordModal(event) {
        event.preventDefault(); // Prevent the default link behavior (e.g., navigating to '#')
        document.getElementById('forgotPasswordModal').classList.add('show');
    }

    /**
     * Closes a specified modal.
     * @param {string} modalId - The ID of the modal to close.
     */
    function closeModal(modalId) {
        document.getElementById(modalId).classList.remove('show');
    }

    /**
     * Function to handle the submission of the "Forgot Password" form.
     * It will close the "Forgot Password" modal and open the "OTP Verification" modal.
     * @param {Event} event - The submit event from the form.
     */
    function sendOTP(event) {
        // We prevent the default submission here because we want the modal to show instantly.
        // Your PHP backend will still receive the form submission to send the OTP.
        // If you were using AJAX, you'd make the AJAX call here.
        // For a full page reload scenario, this approach ensures the modals show correctly
        // while the server processes the OTP request and potentially redirects back.
        event.preventDefault();

        closeModal('forgotPasswordModal'); // Close the forgot password modal
        document.getElementById('otpVerificationModal').classList.add('show'); // Show the OTP verification modal
        document.getElementById('otp1').focus(); // Focus on the first OTP input

        // Manually submit the form to your PHP backend after displaying the modal.
        // This simulates the form submission that would have happened normally.
        const form = event.target;
        form.submit();
    }


    /**
     * Moves focus to the next OTP input field automatically.
     * @param {HTMLInputElement} currentInput - The current input element.
     * @param {string|null} nextInputId - The ID of the next input element to focus, or null if it's the last.
     */
    function moveToNext(currentInput, nextInputId) {
        if (currentInput.value.length === currentInput.maxLength) {
            if (nextInputId) {
                document.getElementById(nextInputId).focus();
            }
        }
    }

    /**
     * Handles backspace key press in OTP input fields to move focus to the previous field.
     * @param {Event} event - The keyboard event.
     * @param {HTMLInputElement} currentInput - The current input element.
     * @param {string|null} prevInputId - The ID of the previous input element to focus, or null if it's the first.
     */
    function handleBackspace(event, currentInput, prevInputId) {
        if (event.key === 'Backspace' && currentInput.value === '') {
            if (prevInputId) {
                document.getElementById(prevInputId).focus();
            }
        }
    }

    // Initial setup on page load
    document.addEventListener('DOMContentLoaded', () => {
        toggleProfileForm('hide_all'); // Ensure forms are hidden initially

        const urlParams = new URLSearchParams(window.location.search);
        const action = urlParams.get('action');
        const message = urlParams.get('message');
        const messageType = urlParams.get('message_type');
        const otpSent = urlParams.get('otp_sent'); // Check for otp_sent parameter

        // If OTP was just sent (redirected from send_otp PHP)
        if (otpSent === '1') {
            document.getElementById('otpVerificationModal').classList.add('show');
            document.getElementById('otp1').focus();
            // Optionally show a success message that OTP was sent
            if (message && messageType) {
                showCustomAlert(decodeURIComponent(message), messageType);
            } else {
                showCustomAlert('OTP sent to your registered email/phone.', 'success');
            }
        } else if (action === 'reset_password') {
            // If redirected after successful OTP verification
            toggleProfileForm('password_reset');
            if (message) {
                showCustomAlert(decodeURIComponent(message), 'success');
            }
        } else {
            // Default state: hide both forms
            toggleProfileForm('hide_all');
        }

        // Display any general messages from redirects (e.g., profile update success/error)
        // This will catch messages not related to OTP flow, or error messages from OTP verification
        if (message && messageType && otpSent !== '1' && action !== 'reset_password') {
            showCustomAlert(decodeURIComponent(message), messageType);
        }
    });
</script>
</body>

</html>