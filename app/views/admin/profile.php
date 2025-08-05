<?php require_once APPROOT . '/views/inc/sidebar.php';

?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>/public/deliverycss/admin/profile.css">

<!-- Main Content Area -->
<main class="main-content">
    <!-- Header for the main content -->
    <header class="main-header">
        <h2 class="page-title">Profile</h2>
        <div class="admin-profile">
            <div class="profile-icon"><i class="fas fa-user-circle"></i></div>
            <span><?= htmlspecialchars($_SESSION['user']['name']) ?></span>
        </div>
    </header>

    <!-- Profile Overview Section -->
    <section class="profile-overview">
        <div class="profile-avatar">
            <!-- Added ID to profile avatar for JS manipulation -->
            <img id="mainProfilePhoto" src="https://placehold.co/120x120/1F265B/FFFFFF?text=A"
                alt="Agent Profile Photo">
        </div>
        <div class="profile-details">
            <div class="detail-group">
                <span class="detail-label">Name</span>
                <span class="detail-value" id="profileName"><?= htmlspecialchars($_SESSION['user']['name']) ?></span>
            </div>
            <div class="detail-group">
                <span class="detail-label">Phone:</span>
                <span class="detail-value" id="profilePhone"><?= htmlspecialchars($_SESSION['user']['phone']) ?></span>
            </div>
            <div class="detail-group">
                <span class="detail-label">Role:</span>
                <span class="detail-value">Agent</span>
            </div>
            <div class="detail-group">
                <span class="detail-label">Code:</span>
                <span class="detail-value"><?= htmlspecialchars($_SESSION['user']['email']) ?></span>
            </div>
        </div>
        <button class="update-info-button" id="openUpdateModalButton">Update Info</button>
    </section>

    <!-- Tabbed Content Section -->
    <section class="tabbed-content">
        <div class="tabs">
            <button class="tab-button active" data-tab="personal-info">Personal Information</button>
            <button class="tab-button" data-tab="change-phone">Change Phone</button>
            <button class="tab-button" data-tab="change-password">Change Password</button>
        </div>

        <div id="personal-info" class="tab-panel active">
            <div class="form-grid">
                <div class="form-group">
                    <label for="fullName">Full Name</label>
                    <input type="text" id="fullName" class="form-input" value="Aung Aung"
                        placeholder="Enter full name">
                </div>
                <div class="form-group">
                    <label for="phoneNumber">Phone Number</label>
                    <input type="tel" id="phoneNumber" class="form-input" value="09123456789"
                        placeholder="Enter phone number">
                </div>
                <div class="form-group">
                    <label for="code">Code</label>
                    <input type="text" id="code" class="form-input" value="GDAGENT007" placeholder="Enter code">
                </div>
                <div class="form-group">
                    <label for="region">Region</label>
                    <input type="text" id="region" class="form-input" value="Yangon" placeholder="Enter region">
                </div>
                <div class="form-group full-width">
                    <label for="address">Address</label>
                    <textarea id="address" class="form-input" rows="3"
                        placeholder="Enter address">No. 123, Main Street, Yangon, Myanmar</textarea>
                </div>
            </div>
        </div>

        <form method="POST" action="<?php echo URLROOT; ?>/admincontroller/changephone">
            <div id="change-phone" class="tab-panel hidden">
                <!-- Content for Change Phone tab -->
                <p>This is the Change Phone section.</p>
                <div class="form-grid">
                    <div class="form-group">
                        <label for="oldPhone">Current Phone Number</label>
                        <label for="oldPhone"><?= htmlspecialchars($_SESSION['user']['phone']) ?></label>
                    </div>
                    <div class="form-group">
                        <label for="newPhone">New Phone Number</label>
                        <input type="tel" id="newPhone" name="new_phone" class="form-input" placeholder="Enter new phone number">
                    </div>
                    <div class="form-group">
                        <label for="confirmNewPhone">Enter Password</label>
                        <input type="tel" id="confirmNewPhone" class="form-input" name="password"
                            placeholder="Enter Your Password">
                    </div>
                </div>
                <button class="save-changes-button" id="savePhoneChangesButton">Save Phone Changes</button>
            </div>
        </form>

        <form method="POST" action="<?php echo URLROOT; ?>/admincontroller/changepassword">
            <div id="change-password" class="tab-panel hidden">
                <!-- Content for Change Password tab -->
                <p>This is the Change Password section.</p>
                <div class="form-grid">
                    <div class="form-group">
                        <label for="currentPassword">Current Password</label>
                        <input type="password" id="currentPassword" class="form-input" name="current_password"
                            placeholder="Enter current password">
                    </div>
                    <div class="form-group">
                        <label for="newPassword">New Password</label>
                        <input type="password" id="newPassword" class="form-input" name="new_password" placeholder="Enter new password">
                    </div>
                    <div class="form-group">
                        <label for="confirmNewPassword">Confirm New Password</label>
                        <input type="password" id="confirmNewPassword" class="form-input" name="confirm_password"
                            placeholder="Confirm new password">
                    </div>
                </div>
                <button class="save-changes-button" id="savePasswordChangesButton">Save Password Changes</button>
            </div>
        </form>
    </section>
</main>
</div>

<!-- Update Profile Modal Structure -->
<div id="updateProfileModal" class="modal-overlay hidden">
    <div class="modal-content">
        <h3>Update Profile</h3>
        <button class="modal-close-button" id="closeModalButton">&times;</button>

        <div class="modal-photo-upload-section">
            <img id="modalProfilePhotoPreview" class="modal-photo-preview"
                src="https://placehold.co/100x100/CCCCCC/333333?text=Preview" alt="Profile Photo Preview">
            <div class="modal-file-input-wrapper">
                Upload Photo
                <input type="file" id="newProfilePhotoInput" class="modal-file-input" accept="image/*">
            </div>
        </div>

        <div class="modal-form-group">
            <label>Current Name:</label>
            <span id="currentNameDisplay" class="current-value"></span>
        </div>
        <div class="modal-form-group">
            <label for="modalNewNameInput">New Name:</label>
            <input type="text" id="modalNewNameInput" class="modal-form-input" placeholder="Enter new full name">
        </div>

        <div class="modal-form-group">
            <label>Current Phone:</label>
            <span id="currentPhoneDisplay" class="current-value"></span>
        </div>
        <div class="modal-form-group">
            <label for="modalNewPhoneInput">New Phone Number:</label>
            <input type="tel" id="modalNewPhoneInput" class="modal-form-input" placeholder="Enter new phone number">
        </div>

        <div class="modal-form-group">
            <label for="modalPasswordInput">Password:</label>
            <input type="password" id="modalPasswordInput" class="modal-form-input" placeholder="Enter password">
        </div>

        <div class="modal-actions">
            <button id="modalSaveButton" class="modal-save-button">Save Changes</button>
            <button id="modalCancelButton" class="modal-cancel-button">Cancel</button>
        </div>
    </div>
</div>

<!-- Custom Alert Box HTML Structure -->
<div id="customAlertOverlay" class="custom-alert-overlay">
    <div class="custom-alert-box">
        <h4 class="alert-title">Notification</h4>
        <p class="alert-message" id="customAlertMessage"></p>
        <button class="alert-ok-button" id="customAlertOkButton">OK</button>
    </div>
</div>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Function to show custom alert box
        function showCustomAlert(message) {
            const customAlertOverlay = document.getElementById('customAlertOverlay');
            const customAlertMessage = document.getElementById('customAlertMessage');
            const customAlertOkButton = document.getElementById('customAlertOkButton');

            customAlertMessage.textContent = message;
            customAlertOverlay.classList.add('visible'); // Changed: Add 'visible' class

            customAlertOkButton.onclick = () => {
                customAlertOverlay.classList.remove('visible'); // Changed: Remove 'visible' class
            };
        }

        // Tab functionality
        const tabButtons = document.querySelectorAll('.tab-button');
        const tabPanels = document.querySelectorAll('.tab-panel');

        tabButtons.forEach(button => {
            button.addEventListener('click', () => {
                const targetTab = button.dataset.tab;

                // Deactivate all buttons and hide all panels
                tabButtons.forEach(btn => btn.classList.remove('active'));
                tabPanels.forEach(panel => panel.classList.add('hidden'));

                // Activate the clicked button and show its corresponding panel
                button.classList.add('active');
                document.getElementById(targetTab).classList.remove('hidden');
            });
        });

        // Profile Update Modal functionality
        const openUpdateModalButton = document.getElementById('openUpdateModalButton');
        const updateProfileModal = document.getElementById('updateProfileModal');
        const closeModalButton = document.getElementById('closeModalButton');
        const modalSaveButton = document.getElementById('modalSaveButton');
        const modalCancelButton = document.getElementById('modalCancelButton');

        const profileName = document.getElementById('profileName');
        const profilePhone = document.getElementById('profilePhone');
        const mainProfilePhoto = document.getElementById('mainProfilePhoto'); // Main profile photo

        const currentNameDisplay = document.getElementById('currentNameDisplay');
        const currentPhoneDisplay = document.getElementById('currentPhoneDisplay');
        const modalNewNameInput = document.getElementById('modalNewNameInput');
        const modalNewPhoneInput = document.getElementById('modalNewPhoneInput');
        const modalPasswordInput = document.getElementById('modalPasswordInput'); // New password input
        const newProfilePhotoInput = document.getElementById('newProfilePhotoInput'); // File input for photo
        const modalProfilePhotoPreview = document.getElementById('modalProfilePhotoPreview'); // Photo preview in modal

        // Event listener to open the modal
        openUpdateModalButton.addEventListener('click', () => {
            // Populate current values in the modal
            currentNameDisplay.textContent = profileName.textContent;
            currentPhoneDisplay.textContent = profilePhone.textContent;

            // Pre-fill input fields with current values
            modalNewNameInput.value = profileName.textContent;
            modalNewPhoneInput.value = profilePhone.textContent;
            modalPasswordInput.value = ''; // Password field should typically be empty for security

            // Set modal preview image to current profile image
            modalProfilePhotoPreview.src = mainProfilePhoto.src;

            updateProfileModal.classList.remove('hidden');
        });

        // Event listener to close the modal
        closeModalButton.addEventListener('click', () => {
            updateProfileModal.classList.add('hidden');
        });

        // Event listener for cancel button
        modalCancelButton.addEventListener('click', () => {
            updateProfileModal.classList.add('hidden');
        });

        // Event listener for photo input change (preview)
        newProfilePhotoInput.addEventListener('change', (event) => {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    modalProfilePhotoPreview.src = e.target.result; // Update preview
                };
                reader.readAsDataURL(file); // Read file as Data URL (Base64)
            } else {
                // If no file selected, reset to current main profile photo or a placeholder
                modalProfilePhotoPreview.src = mainProfilePhoto.src;
            }
        });

        // Event listener for save button in Update Profile Modal
        modalSaveButton.addEventListener('click', () => {
            const newName = modalNewNameInput.value.trim();
            const newPhone = modalNewPhoneInput.value.trim();
            const newPassword = modalPasswordInput.value.trim(); // Get new password
            const newPhotoSrc = modalProfilePhotoPreview.src; // Get the base64 or URL from preview

            // Update main profile elements
            if (newName) {
                profileName.textContent = newName;
            }
            if (newPhone) {
                profilePhone.textContent = newPhone;
            }
            // Password won't be displayed directly on the profile summary, but would be sent to backend
            if (newPassword) {
                console.log('New password entered:', newPassword); // For demonstration
                // In a real app, send newPassword to a secure backend API
            }
            // Only update the main photo if a new one was selected or if it's different from the initial placeholder
            if (newPhotoSrc && newPhotoSrc !== "https://placehold.co/100x100/CCCCCC/333333?text=Preview") {
                mainProfilePhoto.src = newPhotoSrc;
            } else if (newPhotoSrc === "https://placehold.co/100x100/CCCCCC/333333?text=Preview") {
                // If the user selected an image but then cancelled, or didn't select, keep the original
                mainProfilePhoto.src = "https://placehold.co/120x120/1F265B/FFFFFF?text=A"; // Reset to default if no new photo
            }

            updateProfileModal.classList.add('hidden'); // Hide the modal
            showCustomAlert('Profile updated successfully!'); // Use custom alert
        });

        // Event listener for Save Phone Changes button
        const savePhoneChangesButton = document.getElementById('savePhoneChangesButton');
        if (savePhoneChangesButton) {
            savePhoneChangesButton.addEventListener('click', () => {
                // Add logic here to save phone changes
                showCustomAlert('Phone number updated successfully!'); // Use custom alert
            });
        }

        // Event listener for Save Password Changes button
        const savePasswordChangesButton = document.getElementById('savePasswordChangesButton');
        if (savePasswordChangesButton) {
            savePasswordChangesButton.addEventListener('click', () => {
                // Add logic here to save password changes
                showCustomAlert('Password updated successfully!'); // Use custom alert
            });
        }
    });
</script>
</body>

</html>