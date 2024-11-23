# Home Service Application

A web-based home service application designed to provide safe and reliable services during the pandemic. Users can explore a wide range of services, view detailed descriptions, prices, and client reviews, and book services securely. The app also includes a feedback mechanism and an admin panel for managing booking requests.

---

## Features

### 1. **User Authentication Flow**
- **Registration**:
  - Users fill out a form with details such as name, age, email, mobile number, country of citizenship, preferred language, vaccination history, and occupation.
  - Data is validated on both the client and server before being securely stored in the database.
- **Secure Password Storage**:
  - Passwords are hashed using a secure hashing algorithm (e.g., bcrypt) to ensure user credentials remain protected.
- **Google Authentication**:
  - Users can log in using their Google accounts via the OAuth2.0 protocol for enhanced convenience and security.

---

### 2. **Service Booking System**
- **Service Exploration**:
  - Users can view a detailed list of available services, including:
    - Service descriptions
    - Prices
    - Service photos
    - Estimated service times
    - Customer reviews
- **Booking Process**:
  - Users can book services by providing booking details (e.g., name, contact information, service type, and chosen dates).
  - Booking details are securely stored in the MySQL database.
- **Booking Summary**:
  - Users receive a summary of their booking, which they can confirm or cancel.

---

### 3. **Feedback Mechanism**
- **User Reviews**:
  - After a service is completed, users are encouraged to leave feedback, including their name, comments, and ratings.
- **Feedback Display**:
  - Feedback is displayed on the service details page to promote transparency and trust for future clients.

---

### 4. **Admin Panel**
- **Manage Booking Requests**:
  - Admins can log in to view and manage service booking requests.
  - Features include:
    - Viewing a list of pending requests
    - Accepting or rejecting requests
    - Viewing a list of approved requests

---

## Technologies Used

- **Backend**: PHP
- **Database**: MySQL
- **Frontend**: HTML, CSS, JavaScript (Bootstrap for responsiveness)
- **Authentication**: Google OAuth2.0, Secure password hashing
- **Additional Features**:
  - Server-side validation for secure data handling
  - Client-side form validation for better user experience

---

## Installation and Setup

### Prerequisites
- [PHP](https://www.php.net/) (v7.4 or above)
- [MySQL](https://www.mysql.com/) (v8.0 or above)
- A web server like [Apache](https://httpd.apache.org/) or [Nginx](https://nginx.org/)
- [Composer](https://getcomposer.org/) for PHP dependency management
- [Google Cloud Console](https://console.cloud.google.com/) account for OAuth2.0 setup

### Steps
1. **Clone the Repository**:
   ```bash
   git clone (https://github.com/Indranisarker/home-services.git)
   cd home-service-app

2. **Set Up the Database**:
   - Import the provided SQL file into your MySQL database:
     
     ```bash
     mysql -u username -p database_name < database.sql
     
   - Update database credentials in the DBconnect.php file
     ```bash
     define('DB_HOST', 'localhost');
     define('DB_USER', 'your_username');
     define('DB_PASS', 'your_password');
     define('DB_NAME', 'your_database');
  
 3. **Set Up Google OAuth**:
    - Obtain CLIENT_ID and CLIENT_SECRET from the Google Cloud Console.
    - Add them to the login.php file:
      ```bash
      define('GOOGLE_CLIENT_ID', 'your_google_client_id');
      define('GOOGLE_CLIENT_SECRET', 'your_google_client_secret');

 4. **Install Dependencies**:
    ```bash
    composer install

To know more, please visit the repository (https://github.com/Indranisarker/home-services.git)
   




