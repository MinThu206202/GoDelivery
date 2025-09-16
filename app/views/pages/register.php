<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>
        GoDelivery
        -
        Create
        Account
    </title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/deliverycss/register.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo URLROOT; ?>/vendor/bootstrap/css/bootstrap.min.css">

</head>

<body>
    <div class="create-account-container">
        <div class="left-panel">
            <div class="form-wrapper">
                <div class="logo">
                    GO<span style="color: #FFA500;">
                        |
                    </span>DELIVERY
                </div>
                <h2>Create
                    an
                    account
                    for
                    Agent
                </h2>
                <p class="subtitle">
                    Join
                    our
                    community
                    for
                    seamless
                    and
                    efficient
                    delivery
                    solutions.
                </p>

                <form action="<?php echo URLROOT; ?>/auth/register" method="POST" class="create-account-form"
                    id="createAccountForm">

                    <input type="text" name="name" placeholder="Full Name" required />
                    <input type="text" name="phonenumber" placeholder="Phone Number" required />
                    <input type="email" name="email" placeholder="Email" required />

                    <select id="region" name="region_id" required>
                        <option value="">
                            Select
                            Region
                        </option>
                        <option value="1">
                            Yangon
                        </option>
                        <option value="2">
                            Mandalay
                        </option>
                        <option value="3">
                            Sagaing
                        </option>
                    </select>

                    <select id="city" name="city_id" required>
                        <option value="">
                            Select
                            City
                        </option>
                    </select>

                    <select id="township" name="township_id" required>
                        <option value="">
                            Select
                            Township
                        </option>
                    </select>

                    <select id="ward" name="ward_id" required>
                        <option value="">
                            Select
                            Ward
                        </option>
                    </select>

                    <input type="text" name="address" placeholder="Detail Address" required />

                    <input type="password" name="password" id="password" placeholder="Password" required />
                    <input type="password" name="confirm_password" id="confirmPassword" placeholder="Confirm Password"
                        required />

                    <div class="terms-checkbox">
                        <input type="checkbox" id="terms" required />
                        <label for="terms">I
                            agree
                            with
                            the
                            terms
                            and
                            conditions</label>
                    </div>
                    <?php require APPROOT . '/views/components/auth_mess.php'; ?>

                    <button type="submit" class="register-button">REGISTER</button>
                </form>

                <div class="signin-section">
                    <p>Already
                        Have
                        An
                        Account?
                        <a href="<?php echo URLROOT; ?>/pages/login">Sign
                            In</a>
                    </p>
                </div>
            </div>
        </div>

        <div class="right-panel">
            <div>
                <h1>PARTNER
                    WITH
                    GODELIVERY
                </h1>
                <p>A TRUSTED
                    NETWORK
                    OF
                    VERIFIED
                    DELIVERY
                </p>
                <p>PROFESSIONALS
                    SERVING
                    CUSTOMERS
                    NATIONWIDE.
                </p>
                <img src="<?php echo URLROOT; ?>/public/images/login.png" alt="Delivery Network Illustration" />
            </div>
        </div>
    </div>

    <script>
    document
        .getElementById(
            'region'
        )
        .addEventListener(
            'change',
            function() {
                const
                    regionId =
                    this
                    .value;
                fetch
                    (
                        `<?= URLROOT ?>/auth/getCities?region_id=${regionId}`
                    )
                    .then(
                        res =>
                        res
                        .json()
                    )
                    .then(
                        data => {
                            const
                                citySelect =
                                document
                                .getElementById(
                                    'city'
                                );
                            citySelect
                                .innerHTML =
                                '<option value="">Select City</option>';
                            data.forEach(
                                city => {
                                    citySelect
                                        .innerHTML +=
                                        `<option value="${city.id}">${city.name}</option>`;
                                }
                            );
                            document
                                .getElementById(
                                    'township'
                                )
                                .innerHTML =
                                '<option value="">Select Township</option>';
                            document
                                .getElementById(
                                    'ward'
                                )
                                .innerHTML =
                                '<option value="">Select Ward</option>';
                        }
                    );
            }
        );

    document
        .getElementById(
            'city'
        )
        .addEventListener(
            'change',
            function() {
                const
                    cityId =
                    this
                    .value;
                fetch
                    (
                        `<?= URLROOT ?>/auth/getTownships?city_id=${cityId}`
                    )
                    .then(
                        res =>
                        res
                        .json()
                    )
                    .then(
                        data => {
                            const
                                townshipSelect =
                                document
                                .getElementById(
                                    'township'
                                );
                            townshipSelect
                                .innerHTML =
                                '<option value="">Select Township</option>';
                            data.forEach(
                                township => {
                                    townshipSelect
                                        .innerHTML +=
                                        `<option value="${township.id}">${township.name}</option>`;
                                }
                            );
                            document
                                .getElementById(
                                    'ward'
                                )
                                .innerHTML =
                                '<option value="">Select Ward</option>';
                        }
                    );
            }
        );

    document
        .getElementById(
            'township'
        )
        .addEventListener(
            'change',
            function() {
                const
                    townshipId =
                    this
                    .value;
                fetch
                    (
                        `<?= URLROOT ?>/auth/getWards?township_id=${townshipId}`
                    )
                    .then(
                        res =>
                        res
                        .json()
                    )
                    .then(
                        data => {
                            const
                                wardSelect =
                                document
                                .getElementById(
                                    'ward'
                                );
                            wardSelect
                                .innerHTML =
                                '<option value="">Select Ward</option>';
                            data.forEach(
                                ward => {
                                    wardSelect
                                        .innerHTML +=
                                        `<option value="${ward.id}">${ward.name}</option>`;
                                }
                            );
                        }
                    );
            }
        );
    </script>
</body>

</html>