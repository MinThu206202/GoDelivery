<?php require_once APPROOT . '/views/inc/nav.php'; ?>
<?php require_once APPROOT . '/views/inc/header.php'; ?>

<section class="page-header">
    <div class="container">
        <h1>Our Network</h1>
        <p>Home <i class="fas fa-arrow-right"></i> Our Network</p>
    </div>
</section>

<section class="network-filter-section">
    <div class="container">
        <div class="filter-row">
            <div class="filter-group">
                <label for="country">Country</label>
                <select id="country">
                    <option value="Myanmar" selected>Myanmar</option>
                    <option value="Thailand">Thailand</option>
                    <option value="Singapore">Singapore</option>
                </select>
            </div>
            <div class="filter-group">
                <label for="selectRegion">Select Region</label>
                <select id="selectRegion">
                    <!-- Options will be populated by JavaScript -->
                </select>
            </div>
            <div class="filter-group">
                <label for="selectTownshipCity">Select Township/City</label>
                <select id="selectTownshipCity">
                    <!-- Options will be populated by JavaScript -->
                </select>
            </div>
        </div>
    </div>
</section>

<section class="network-content-section">
    <div class="container">
        <div class="network-info-wrapper">
            <div class="network-locations" id="networkLocations">
                <!-- Location cards will be dynamically loaded here by JavaScript -->
            </div>
            <div class="network-map-placeholder">
                <div class="map-overlay">
                    <i class="fas fa-map-marker-alt"></i>
                    <p>Explore Nearby Places</p>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require_once APPROOT . '/views/inc/footer.php'; ?>

<script>
    // Get references to the HTML select elements and the div for displaying locations
    const countrySelect = document.getElementById('country');
    const regionSelect = document.getElementById('selectRegion');
    const townshipCitySelect = document.getElementById('selectTownshipCity');
    const networkLocationsDiv = document.getElementById('networkLocations');

    // Sample data for demonstration. In a real application, this would typically come from an API or a larger data source.
    // This object structures the data by Country -> Region -> Array of Township/City objects.
    const networkData = {
        "Myanmar": {
            "Mandalay": [{
                    name: "Mandalay",
                    address: "No(116)/Main Road/Mandalay Township",
                    region: "Mandalay Region",
                    phone: "09123456789"
                },
                {
                    name: "Pyin Oo Lwin",
                    address: "No(22)/Hill Road/Pyin Oo Lwin Township",
                    region: "Mandalay Region",
                    phone: "09987654321"
                },
                {
                    name: "Meiktila",
                    address: "No(33)/Lake Road/Meiktila Township",
                    region: "Mandalay Region",
                    phone: "09112233445"
                },
                {
                    name: "Myingyan",
                    address: "No(44)/River Road/Myingyan Township",
                    region: "Mandalay Region",
                    phone: "09554433221"
                },
                {
                    name: "Nyaung-U",
                    address: "No(55)/Pagoda Road/Nyaung-U Township",
                    region: "Mandalay Region",
                    phone: "09778899001"
                }
            ],
            "Yangon": [{
                    name: "Bahan Township",
                    address: "No(116)/U Chit Maung Road/Bahan Township",
                    region: "Yangon Region",
                    phone: "09789123456"
                },
                {
                    name: "Hlaing Township",
                    address: "No(22)/Bayintnaung Road/Hlaing Township",
                    region: "Yangon Region",
                    phone: "09123123123"
                },
                {
                    name: "Mayangone Township",
                    address: "No(33)/Parami Road/Mayangone Township",
                    region: "Yangon Region",
                    phone: "09456456456"
                }
            ],
            "Naypyidaw": [{
                    name: "Dekkhinathiri Township",
                    address: "No(1)/Union Road/Dekkhinathiri Township",
                    region: "Naypyidaw Region",
                    phone: "09121212121"
                },
                {
                    name: "Zabuthiri Township",
                    address: "No(2)/Government Road/Zabuthiri Township",
                    region: "Naypyidaw Region",
                    phone: "09343434343"
                }
            ]
        },
        "Thailand": {
            "Bangkok": [{
                    name: "Pathum Wan",
                    address: "123 Siam Square, Bangkok",
                    region: "Bangkok",
                    phone: "0812345678"
                },
                {
                    name: "Chatuchak",
                    address: "456 Phahonyothin Rd, Bangkok",
                    region: "Bangkok",
                    phone: "0898765432"
                }
            ],
            "Chiang Mai": [{
                name: "Mueang Chiang Mai",
                address: "789 Old City Rd, Chiang Mai",
                region: "Chiang Mai",
                phone: "0901234567"
            }]
        },
        "Singapore": {
            "Central Region": [{
                    name: "Downtown Core",
                    address: "1 Fullerton Rd, Singapore",
                    region: "Central Region",
                    phone: "6512345678"
                },
                {
                    name: "Orchard",
                    address: "2 Orchard Rd, Singapore",
                    region: "Central Region",
                    phone: "6598765432"
                }
            ]
        }
    };

    /**
     * Populates the 'Select Region' dropdown based on the currently selected country.
     * It also triggers the population of townships for the newly selected region.
     */
    function populateRegions() {
        const selectedCountry = countrySelect.value; // Get the value of the selected country
        // Get the list of regions for the selected country from networkData, or an empty object if none found
        const regions = Object.keys(networkData[selectedCountry] || {});

        regionSelect.innerHTML = ''; // Clear all existing options in the region dropdown

        // Create and append a default "Select a Region" option
        const defaultRegionOption = document.createElement('option');
        defaultRegionOption.value = '';
        defaultRegionOption.textContent = 'Select a Region';
        regionSelect.appendChild(defaultRegionOption);

        // Populate the region dropdown with options based on the selected country
        regions.forEach(region => {
            const option = document.createElement('option');
            option.value = region; // Set the option's value to the region name
            option.textContent = region; // Set the visible text of the option
            regionSelect.appendChild(option); // Add the option to the region dropdown
        });

        // Set Mandalay as the default selected region if Myanmar is selected
        if (selectedCountry === 'Myanmar') {
            regionSelect.value = 'Mandalay';
        } else {
            // If not Myanmar, select the first available region or the default "Select a Region"
            regionSelect.value = regions.length > 0 ? regions[0] : '';
        }

        populateTownships(); // Call populateTownships to update the next dropdown based on the (newly) selected region
    }

    /**
     * Populates the 'Select Township/City' dropdown based on the currently selected country and region.
     * It also triggers the display of locations for the newly selected township/city.
     */
    function populateTownships() {
        const selectedCountry = countrySelect.value; // Get the selected country
        const selectedRegion = regionSelect.value; // Get the selected region
        // Get the array of townships for the selected country and region, or an empty array if none found
        const townships = networkData[selectedCountry]?.[selectedRegion] || [];

        townshipCitySelect.innerHTML = ''; // Clear all existing options in the township/city dropdown

        // Create and append a default "Select a Township/City" option
        const defaultTownshipOption = document.createElement('option');
        defaultTownshipOption.value = '';
        defaultTownshipOption.textContent = 'Select a Township/City';
        townshipCitySelect.appendChild(defaultTownshipOption);


        // Populate the township/city dropdown with options
        if (townships.length === 0) {
            // If no townships are available for the selected region
            const option = document.createElement('option');
            option.value = '';
            option.textContent = 'No townships/cities available';
            townshipCitySelect.appendChild(option);
        } else {
            // Add an "All Townships/Cities" option for the selected region
            const allOption = document.createElement('option');
            allOption.value = 'all';
            allOption.textContent = `All Townships/Cities in ${selectedRegion}`;
            townshipCitySelect.appendChild(allOption);

            // Add individual township/city options
            townships.forEach(township => {
                const option = document.createElement('option');
                option.value = township.name;
                option.textContent = township.name;
                townshipCitySelect.appendChild(option);
            });
        }

        // By default, select "All Townships/Cities" or the first available township if 'all' is not an option
        if (townshipCitySelect.querySelector('option[value="all"]')) {
            townshipCitySelect.value = 'all';
        } else if (townships.length > 0) {
            townshipCitySelect.value = townships[0].name; // Select the first township if 'all' is not available
        } else {
            townshipCitySelect.value = ''; // Select the default empty option
        }

        displayLocations(); // Call displayLocations to update the displayed network cards
    }

    /**
     * Displays the network locations based on the currently selected country, region, and township/city.
     * It clears existing cards and generates new ones based on the filtered data.
     */
    function displayLocations() {
        const selectedCountry = countrySelect.value; // Get selected country
        const selectedRegion = regionSelect.value; // Get selected region
        const selectedTownshipCity = townshipCitySelect.value; // Get selected township/city

        networkLocationsDiv.innerHTML = ''; // Clear existing location cards

        let filteredLocations = []; // Initialize an array to hold locations that match the criteria

        // Check if both country and region are selected before filtering
        if (selectedCountry && selectedRegion) {
            // Get all locations for the selected region
            const locationsInRegion = networkData[selectedCountry][selectedRegion] || [];

            // Apply further filtering based on selected township/city
            if (selectedTownshipCity && selectedTownshipCity !== '' && selectedTownshipCity !== 'No townships/cities available') {
                if (selectedTownshipCity === 'all') {
                    // If 'All Townships/Cities' is selected, show all locations in the region
                    filteredLocations = locationsInRegion;
                } else {
                    // If a specific township/city is selected, filter to show only that one
                    filteredLocations = locationsInRegion.filter(location => location.name === selectedTownshipCity);
                }
            } else {
                // If no specific township/city is selected (e.g., initial load or empty selection),
                // show all locations for the selected region
                filteredLocations = locationsInRegion;
            }
        }

        // Render the filtered locations
        if (filteredLocations.length > 0) {
            filteredLocations.forEach(location => {
                const card = document.createElement('div'); // Create a new div element for the card
                card.classList.add('location-card'); // Add the 'location-card' class to it
                card.innerHTML = `
                        <h3>${location.name}</h3>
                        <p>${location.address}</p>
                        <p>${location.region}</p>
                        <p>${location.phone}</p>
                    `; // Set the inner HTML of the card with location details
                networkLocationsDiv.appendChild(card); // Add the card to the networkLocationsDiv
            });
        } else {
            // If no locations are found after filtering, display a message
            networkLocationsDiv.innerHTML = '<p style="text-align: center; color: #666;">No locations found for the selected criteria.</p>';
        }
    }

    // Add Event Listeners:
    // Listen for changes in the country dropdown to update regions
    countrySelect.addEventListener('change', populateRegions);
    // Listen for changes in the region dropdown to update townships
    regionSelect.addEventListener('change', populateTownships);
    // Listen for changes in the township/city dropdown to update displayed locations
    townshipCitySelect.addEventListener('change', displayLocations);

    // Initial population when the page loads:
    // This ensures the dropdowns and location cards are correctly initialized
    // with the default selections (Myanmar, Mandalay, and then the corresponding townships/cities).
    document.addEventListener('DOMContentLoaded', () => {
        populateRegions(); // This will trigger a chain reaction: populateRegions -> populateTownships -> displayLocations
    });
</script>
</body>

</html>