<?php require_once APPROOT . '/views/inc/nav.php' ?>
<!-- Font Awesome for icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<!-- Google Font -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
<style>
/* Define custom colors and fonts */
body {
    font-family: 'Poppins', sans-serif;
}

.hero-bg {
    background-color: #f0f4f7;
}

.text-primary-blue {
    color: #1F265B;
}

.bg-primary-blue {
    background-color: #1F265B;
}

.text-primary-orange {
    color: #FFA500;
}

.search-box-shadow {
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
}

/* Custom styles for tab animation and indicator */
.tab-button.active {
    border-bottom-color: #1F265B;
    color: #1F265B;
    font-weight: 600;
}

/* Custom animation for the circular button */
.animated-btn {
    transition: all 0.3s ease-in-out;
}

.animated-btn:hover {
    transform: scale(1.1) rotate(45deg);
    box-shadow: 0 5px 15px rgba(31, 38, 91, 0.3);
}

/* Styles for the custom message box (not an alert) */
.message-box {
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    z-index: 1000;
}

/* Accordion transition for a smoother effect */
.accordion-answer {
    max-height: 0;
    overflow: hidden;
    transition: max-height 0.3s ease-in-out, padding-top 0.3s ease-in-out;
}

.accordion-answer.open {
    max-height: 500px;
    /* Adjust as needed for content height */
    padding-top: 1rem;
}

/* New gradient style for Our Impact section */
.impact-gradient {
    background: linear-gradient(to right, #1F265B, #4B5563);
}
</style>


<!-- Hero Section -->
<section class="py-24 hero-bg">
    <div class="container mx-auto px-4 flex flex-col md:flex-row items-center justify-between gap-8">
        <div class="md:w-1/2 text-center md:text-left">
            <h1 class="text-3xl md:text-5xl font-bold text-primary-blue leading-tight mb-4">
                JOIN with GoDelivery <br> Your Trusted Partner in Fast & Reliable Deliveries
            </h1>
            <p class="text-sm md:text-base text-gray-600 leading-relaxed">
                Connecting you to a seamless delivery experience. Whether it's a small package or a large shipment,
                our network of dedicated drivers ensures your items arrive safely and on time, every time.
            </p>
        </div>
        <div class="md:w-1/2 text-center">
            <!-- Placeholder Image for Hero Section -->
            <img src="<?php echo URLROOT; ?>/public/images/home.png" alt="Friendly Delivery Driver"
                class="w-full h-auto rounded-lg ">
        </div>
    </div>
</section>

<!-- Live Tracking & Price Calculator Section -->
<section class="py-10 bg-white shadow-md -mt-12 relative z-20 rounded-lg mx-auto max-w-5xl search-box-shadow">
    <div class="container mx-auto px-4">
        <h2 class="text-2xl font-bold text-center text-primary-blue mb-6">Live Tracking & Price Calculator</h2>
        <!-- Tab Buttons -->
        <form action="<?= URLROOT; ?>/pages/user_tracking" method="POST">
            <div class="flex flex-col md:flex-row gap-4">
                <input type="text" name="code" placeholder="Enter your Bolting Code"
                    class="flex-1 p-3 border rounded-md focus:border-[#1F265B] outline-none">
                <button
                    class="bg-[#1F265B] text-white p-3 rounded-md font-semibold hover:bg-gray-800 transition-colors">Search</button>
            </div>
        </form>




    </div>
</section>

<!-- How It Works Section -->
<section class="py-16">
    <div class="container mx-auto px-4 text-center">
        <h2 class="text-3xl md:text-4xl font-bold text-primary-blue mb-12">How It Works</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-12 items-start">
            <div class="flex flex-col items-center">
                <div
                    class="w-24 h-24 rounded-full bg-primary-blue text-white flex items-center justify-center text-4xl mb-4 shadow-lg">
                    <i class="fas fa-box"></i>
                </div>
                <h3 class="text-xl font-semibold text-primary-blue mb-2">1. Book Your Delivery</h3>
                <p class="text-gray-600">Enter your details and schedule a pickup easily through our platform.</p>
            </div>
            <div class="flex flex-col items-center">
                <div
                    class="w-24 h-24 rounded-full bg-primary-blue text-white flex items-center justify-center text-4xl mb-4 shadow-lg">
                    <i class="fas fa-truck"></i>
                </div>
                <h3 class="text-xl font-semibold text-primary-blue mb-2">2. We Pick It Up</h3>
                <p class="text-gray-600">A dedicated driver will arrive at your location to collect your package.</p>
            </div>
            <div class="flex flex-col items-center">
                <div
                    class="w-24 h-24 rounded-full bg-primary-blue text-white flex items-center justify-center text-4xl mb-4 shadow-lg">
                    <i class="fas fa-check-circle"></i>
                </div>
                <h3 class="text-xl font-semibold text-primary-blue mb-2">3. Delivered Safely</h3>
                <p class="text-gray-600">Your package is delivered safely and on time to the recipient.</p>
            </div>
        </div>
    </div>
</section>

<!-- Services Section -->
<section class="py-16 bg-[#f0f4f7]">
    <div class="container mx-auto px-4 text-center">
        <h2 class="text-3xl md:text-4xl font-bold text-primary-blue mb-12">Our Services</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <!-- Service 1: Standard Delivery -->
            <div class="bg-white rounded-lg shadow-md p-6 flex flex-col items-center text-center">
                <div class="text-4xl text-primary-blue mb-4">
                    <i class="fas fa-truck-moving"></i>
                </div>
                <h3 class="text-xl font-semibold text-primary-blue mb-2">Standard Delivery</h3>
                <p class="text-gray-600">Our reliable service for day-to-day shipments.</p>
            </div>
            <!-- Service 2: Express Delivery -->
            <div class="bg-white rounded-lg shadow-md p-6 flex flex-col items-center text-center">
                <div class="text-4xl text-primary-blue mb-4">
                    <i class="fas fa-tachometer-alt"></i>
                </div>
                <h3 class="text-xl font-semibold text-primary-blue mb-2">Express Delivery</h3>
                <p class="text-gray-600">Need it there fast? Our 24-hour service has you covered.</p>
            </div>
            <!-- Service 3: Business Logistics -->
            <div class="bg-white rounded-lg shadow-md p-6 flex flex-col items-center text-center">
                <div class="text-4xl text-primary-blue mb-4">
                    <i class="fas fa-handshake"></i>
                </div>
                <h3 class="text-xl font-semibold text-primary-blue mb-2">Business Logistics</h3>
                <p class="text-gray-600">Tailored solutions for your company's delivery needs.</p>
            </div>
            <!-- Service 4: Cash on Delivery -->
            <div class="bg-white rounded-lg shadow-md p-6 flex flex-col items-center text-center">
                <div class="text-4xl text-primary-blue mb-4">
                    <i class="fas fa-money-bill-wave"></i>
                </div>
                <h3 class="text-xl font-semibold text-primary-blue mb-2">Cash on Delivery</h3>
                <p class="text-gray-600">A secure payment option for your customers upon delivery.</p>
            </div>
        </div>
    </div>
</section>

<!-- Features / Why Choose Us Section -->
<section class="py-16">
    <div class="container mx-auto px-4 text-center">
        <h2 class="text-3xl md:text-4xl font-bold text-primary-blue mb-12">Key Features</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <!-- Feature 1: Fast Delivery -->
            <div class="flex flex-col items-center">
                <div class="text-5xl text-primary-blue mb-4">
                    <i class="fas fa-rocket"></i>
                </div>
                <h3 class="text-xl font-semibold text-primary-blue mb-2">Fast Delivery</h3>
                <p class="text-gray-600">Our 24h Express service gets your package there in record time.</p>
            </div>
            <!-- Feature 2: Secure Packaging -->
            <div class="flex flex-col items-center">
                <div class="text-5xl text-primary-blue mb-4">
                    <i class="fas fa-box-open"></i>
                </div>
                <h3 class="text-xl font-semibold text-primary-blue mb-2">Secure Packaging</h3>
                <p class="text-gray-600">We ensure every item is handled with the utmost care and security.</p>
            </div>
            <!-- Feature 3: Nationwide Coverage -->
            <div class="flex flex-col items-center">
                <div class="text-5xl text-primary-blue mb-4">
                    <i class="fas fa-globe-americas"></i>
                </div>
                <h3 class="text-xl font-semibold text-primary-blue mb-2">Nationwide Coverage</h3>
                <p class="text-gray-600">Our network reaches every corner of the country.</p>
            </div>
            <!-- Feature 4: Affordable Pricing -->
            <div class="flex flex-col items-center">
                <div class="text-5xl text-primary-blue mb-4">
                    <i class="fas fa-tags"></i>
                </div>
                <h3 class="text-xl font-semibold text-primary-blue mb-2">Affordable Pricing</h3>
                <p class="text-gray-600">Competitive rates with no hidden fees.</p>
            </div>
        </div>
    </div>
</section>

<!-- Testimonials Section -->
<section class="py-16 bg-[#f0f4f7]">
    <div class="container mx-auto px-4 text-center">
        <h2 class="text-3xl md:text-4xl font-bold text-primary-blue mb-12">What Our Customers Say</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Testimonial 1 -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <p class="text-gray-700 italic mb-4">"GoDelivery is incredibly fast and reliable. My package arrived a
                    day early, perfectly intact. I'll definitely be using them again!"</p>
                <div class="flex items-center justify-center">
                    <img src="https://placehold.co/64x64/E5E7EB/4B5563?text=User1" alt="Customer"
                        class="w-16 h-16 rounded-full mr-4">
                    <p class="font-semibold text-primary-blue">Jane Doe</p>
                </div>
            </div>
            <!-- Testimonial 2 -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <p class="text-gray-700 italic mb-4">"The real-time tracking is a game-changer. I knew exactly where my
                    delivery was at all times. Great service!"</p>
                <div class="flex items-center justify-center">
                    <img src="https://placehold.co/64x64/E5E7EB/4B5563?text=User2" alt="Customer"
                        class="w-16 h-16 rounded-full mr-4">
                    <p class="font-semibold text-primary-blue">John Smith</p>
                </div>
            </div>
            <!-- Testimonial 3 -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <p class="text-gray-700 italic mb-4">"Affordable, secure, and professional. GoDelivery exceeded my
                    expectations. Highly recommend their services for anyone's needs."</p>
                <div class="flex items-center justify-center">
                    <img src="https://placehold.co/64x64/E5E7EB/4B5563?text=User3" alt="Customer"
                        class="w-16 h-16 rounded-full mr-4">
                    <p class="font-semibold text-primary-blue">Emily Wilson</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- About Us Section -->
<section id="about-us" class="py-16">
    <div class="container mx-auto px-4 flex flex-col md:flex-row items-center gap-12">
        <div class="md:w-1/2 flex justify-center">
            <img src="<?php echo URLROOT; ?>/public/images/Gemini_Generated_Image_ob9h1eob9h1eob9h.png"
                alt="GoDelivery Team" class="rounded-lg shadow-xl max-h-96 w-auto object-cover">
        </div>
        <div class="md:w-1/2">
            <h2 class="text-3xl md:text-4xl font-bold text-primary-blue mb-6">About GoDelivery</h2>
            <p class="text-gray-600 mb-4">
                At GoDelivery, our mission is to simplify logistics and connect people through fast, reliable, and
                secure delivery services. We believe in providing an exceptional experience by leveraging technology and
                a dedicated network of professionals.
            </p>
            <p class="text-gray-600">
                We're committed to transparency, efficiency, and customer satisfaction. Whether it's a personal item or
                a business shipment, we handle every package with the care it deserves. Our vision is to be the most
                trusted delivery service in the nation.
            </p>
        </div>
    </div>
</section>


<!-- Our Impact Section -->
<section id="our-impact" class="py-16 impact-gradient text-white">
    <div class="container mx-auto px-4 text-center">
        <h2 class="text-3xl md:text-4xl font-bold mb-12">Our Impact & Success</h2>
        <div
            class="flex flex-col md:flex-row justify-center items-center divide-y md:divide-y-0 md:divide-x divide-gray-400 gap-8">
            <!-- Metric 1: Total Deliveries -->
            <div class="flex flex-col items-center px-8 py-4 w-full">
                <p class="text-4xl md:text-5xl font-bold mb-2">10M+</p>
                <h3 class="text-lg font-semibold text-gray-200">Total Deliveries</h3>
            </div>
            <!-- Metric 2: Happy Clients -->
            <div class="flex flex-col items-center px-8 py-4 w-full">
                <p class="text-4xl md:text-5xl font-bold mb-2">1M+</p>
                <h3 class="text-lg font-semibold text-gray-200">Happy Clients</h3>
            </div>
            <!-- Metric 3: Miles Driven -->
            <div class="flex flex-col items-center px-8 py-4 w-full">
                <p class="text-4xl md:text-5xl font-bold mb-2">50M+</p>
                <h3 class="text-lg font-semibold text-gray-200">Miles Driven</h3>
            </div>
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section class="py-16">
    <div class="container mx-auto px-4 max-w-3xl">
        <h2 class="text-3xl md:text-4xl font-bold text-primary-blue text-center mb-12">Frequently Asked Questions</h2>
        <div id="faq-accordion" class="space-y-4">
            <!-- FAQ 1 -->
            <div class="bg-white rounded-lg shadow-md p-6 cursor-pointer" data-question>
                <div class="flex justify-between items-center text-primary-blue font-semibold">
                    <p>How long does delivery take?</p>
                    <i class="fas fa-chevron-down transform transition-transform duration-300"></i>
                </div>
                <div class="accordion-answer">
                    <p class="text-gray-600">Standard delivery typically takes 3-5 business days, while our Express
                        service guarantees delivery within 24 hours in most areas.</p>
                </div>
            </div>
            <!-- FAQ 2 -->
            <div class="bg-white rounded-lg shadow-md p-6 cursor-pointer" data-question>
                <div class="flex justify-between items-center text-primary-blue font-semibold">
                    <p>Can I track my order?</p>
                    <i class="fas fa-chevron-down transform transition-transform duration-300"></i>
                </div>
                <div class="accordion-answer">
                    <p class="text-gray-600">Yes, you can track your order in real-time. Simply enter your unique
                        tracking code on our homepage to see the current status and location of your package.</p>
                </div>
            </div>
            <!-- FAQ 3 -->
            <div class="bg-white rounded-lg shadow-md p-6 cursor-pointer" data-question>
                <div class="flex justify-between items-center text-primary-blue font-semibold">
                    <p>What areas do you cover?</p>
                    <i class="fas fa-chevron-down transform transition-transform duration-300"></i>
                </div>
                <div class="accordion-answer">
                    <p class="text-gray-600">We offer nationwide coverage. Our network of drivers and logistics partners
                        ensures we can deliver to all major cities and rural areas.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Footer -->
<footer class="bg-primary-blue text-white py-12">
    <div
        class="container mx-auto px-4 flex flex-col md:flex-row justify-between items-start gap-8 text-center md:text-left">
        <div class="md:w-1/3">
            <h2 class="text-3xl md:text-5xl font-bold mb-4">GoDelivery</h2>
            <p class="text-gray-300">Your most reliable partner in logistics and delivery services, dedicated to
                providing top-notch service with a smile.</p>
            <div class="mt-6 flex justify-center md:justify-start space-x-4">
                <a href="#" class="text-white hover:text-gray-300 transition-colors"><i
                        class="fab fa-facebook-f"></i></a>
                <a href="#" class="text-white hover:text-gray-300 transition-colors"><i class="fab fa-twitter"></i></a>
                <a href="#" class="text-white hover:text-gray-300 transition-colors"><i
                        class="fab fa-instagram"></i></a>
            </div>
        </div>
        <div class="md:w-1/3 text-sm text-gray-300">
            <h3 class="font-bold text-lg mb-2">Quick Links</h3>
            <ul class="space-y-1">
                <li><a href="#" class="hover:text-primary-orange transition-colors">Home</a></li>
                <li><a href="#services" class="hover:text-primary-orange transition-colors">Services</a></li>
                <li><a href="#about-us" class="hover:text-primary-orange transition-colors">About Us</a></li>
                <li><a href="#our-impact" class="hover:text-primary-orange transition-colors">Our Impact</a></li>
                <li><a href="#faq" class="hover:text-primary-orange transition-colors">FAQ</a></li>
                <li><a href="#" class="hover:text-primary-orange transition-colors">Careers</a></li>
            </ul>
        </div>
        <div class="md:w-1/3 text-sm text-gray-300">
            <h3 class="font-bold text-lg mb-2">Contact Us</h3>
            <ul class="space-y-1">
                <li><i class="fas fa-phone-alt mr-2"></i> +1 234 567 8900</li>
                <li><i class="fas fa-envelope mr-2"></i> info@godelivery.com</li>
                <li><i class="fas fa-map-marker-alt mr-2"></i> 123 Delivery St, Suite 400, City, Country</li>
            </ul>
        </div>
    </div>
</footer>

<!-- Custom Message Box -->
<div id="messageBox"
    class="hidden message-box bg-white p-6 rounded-lg shadow-xl border border-primary-blue max-w-sm w-full mx-4">
    <h4 id="messageTitle" class="text-lg font-semibold text-primary-blue mb-2"></h4>
    <p id="messageContent" class="text-gray-700 mb-4"></p>
    <button id="closeMessage"
        class="w-full bg-primary-blue text-white py-2 px-4 rounded-md font-semibold hover:bg-gray-800 transition-colors">OK</button>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const findingTab = document.getElementById('findingTab');
    const calculatorTab = document.getElementById('calculatorTab');
    const findingContent = document.getElementById('findingContent');
    const calculatorContent = document.getElementById('calculatorContent');

    const searchButton = document.getElementById('searchButton');
    const calculateButton = document.getElementById('calculateButton');
    const priceResult = document.getElementById('priceResult');
    const messageBox = document.getElementById('messageBox');
    const messageTitle = document.getElementById('messageTitle');
    const messageContent = document.getElementById('messageContent');
    const closeMessageButton = document.getElementById('closeMessage');

    // Function to show a custom message box (not alert)
    function showMessage(title, message) {
        messageTitle.textContent = title;
        messageContent.textContent = message;
        messageBox.classList.remove('hidden');
        messageBox.classList.add('flex');
    }

    // Function to hide the message box
    function hideMessageBox() {
        messageBox.classList.add('hidden');
        messageBox.classList.remove('flex');
    }

    // Tab functionality
    findingTab.addEventListener('click', () => {
        findingTab.classList.add('active');
        calculatorTab.classList.remove('active');
        findingContent.classList.remove('hidden');
        calculatorContent.classList.add('hidden');
    });

    calculatorTab.addEventListener('click', () => {
        calculatorTab.classList.add('active');
        findingTab.classList.remove('active');
        calculatorContent.classList.remove('hidden');
        findingContent.classList.add('hidden');
    });

    // Search button logic
    searchButton.addEventListener('click', (e) => {
        e.preventDefault();
        const boltingCode = document.getElementById('boltingCode').value;
        if (boltingCode.trim() !== '') {
            showMessage('Searching...', `Searching for order with code: ${boltingCode}`);
        } else {
            showMessage('Warning', 'Please enter a Tracking Code.');
        }
    });

    // Close message box
    closeMessageButton.addEventListener('click', hideMessageBox);

    // Price calculator logic
    calculateButton.addEventListener('click', (e) => {
        e.preventDefault();
        const pickup = document.getElementById('pickupLocation').value;
        const destination = document.getElementById('destination').value;
        const packageType = document.getElementById('packageType').value;
        const weight = parseFloat(document.getElementById('weight').value);

        if (pickup && destination && !isNaN(weight) && weight > 0) {
            let basePrice = 5;
            let typeMultiplier = 1;
            if (packageType === 'medium') {
                typeMultiplier = 1.5;
            } else if (packageType === 'large') {
                typeMultiplier = 2;
            }

            // A very simple, fixed calculation for demonstration
            const calculatedPrice = (basePrice + (weight * 1.5)) * typeMultiplier;
            priceResult.textContent = `Estimated Price: $${calculatedPrice.toFixed(2)}`;
        } else {
            priceResult.textContent = 'Please fill in all fields.';
        }
    });

    // FAQ Accordion functionality
    const faqQuestions = document.querySelectorAll('[data-question]');
    faqQuestions.forEach(question => {
        question.addEventListener('click', () => {
            const answer = question.querySelector('.accordion-answer');
            const icon = question.querySelector('i');
            const isOpen = answer.classList.contains('open');

            // Close all other open answers
            faqQuestions.forEach(item => {
                const otherAnswer = item.querySelector('.accordion-answer');
                const otherIcon = item.querySelector('i');
                if (otherAnswer !== answer) {
                    otherAnswer.classList.remove('open');
                    otherIcon.classList.remove('fa-chevron-up');
                    otherIcon.classList.add('fa-chevron-down');
                }
            });

            // Toggle the clicked answer
            if (!isOpen) {
                answer.classList.add('open');
                icon.classList.remove('fa-chevron-down');
                icon.classList.add('fa-chevron-up');
            } else {
                answer.classList.remove('open');
                icon.classList.remove('fa-chevron-up');
                icon.classList.add('fa-chevron-down');
            }
        });
    });
});
</script>
</body>

</html>