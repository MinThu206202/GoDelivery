# GoDelivery System 🚚

GoDelivery System is a web-based delivery and pickup management system designed to simplify logistics operations. It provides features for agents, admins, and customers to manage deliveries, pickups, tracking, and notifications efficiently.  

---

## ✨ Features  
- 📦 **Delivery Management** – Create, update, and track delivery requests.  
- 👤 **Agent Management** – Assign, activate/deactivate, and manage delivery agents.  
- 🔑 **Authentication** – Secure login with reCAPTCHA v2 and OTP verification.  
- 📊 **Admin Panel** – Manage users, roles, and delivery statuses.  
- 🔔 **Notifications** – Email alerts for delivery updates (activated, deactivated, returned, etc.).  
- 🌍 **Tracking** – Customers can check real-time delivery status with tracking codes.  

---

## 🛠️ Tech Stack  
- **Backend**: PHP (MVC structure)  
- **Frontend**: HTML, TailwindCSS, JavaScript  
- **Database**: MySQL  
- **Security**: Google reCAPTCHA v2, OTP, password hashing  
- **Email**: PHPMailer  

---

## 📂 Project Structure  
```
GoDelivery-System/
│── app/                 # Core PHP application files (controllers, models, views)
│── public/              # Public assets (index.php, css, js, images)
│── config/              # Database and app configuration
│── logs/                # Log files
│── vendor/              # Composer dependencies
│── README.md            # Project documentation
│── .env.example         # Example environment config
```

---

## 🚀 Installation  

1. Clone the repository:  
   ```bash
   git clone https://github.com/yourusername/GoDelivery-System.git
   cd GoDelivery-System
   ```

2. Install dependencies via Composer:  
   ```bash
   composer install
   ```

3. Create a `.env` file (copy from `.env.example`) and configure:  
   ```ini
   APP_URL=http://localhost/godelivery
   DB_HOST=127.0.0.1
   DB_NAME=godelivery
   DB_USER=root
   DB_PASS=
   MAIL_HOST=smtp.yourmail.com
   MAIL_USER=your_email@example.com
   MAIL_PASS=your_password
   ```

4. Import the database:  
   ```bash
   mysql -u root -p godelivery < database.sql
   ```

5. Start local server:  
   ```bash
   php -S localhost:8000 -t public
   ```

6. Open in browser:  
   ```
   http://localhost:8000
   ```

---

## 🔑 Default Credentials (for demo)  
- **Admin**: admin@example.com / admin123  
- **Agent**: agent@example.com / agent123  

---

## 📸 Screenshots  
(Add screenshots of your login page, dashboard, and tracking page here)  

---

## 🤝 Contributing  
Pull requests are welcome! For major changes, please open an issue first to discuss what you’d like to change.  

---

## 📜 License  
This project is licensed under the **MIT License** – see the [LICENSE](LICENSE) file for details.  
