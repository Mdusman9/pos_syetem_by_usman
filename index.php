<?php include('includes/header.php');?>
  
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POS System Landing Page</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <div class="container">
            <h1>Welcome to POS System</h1>
            <p>Your ultimate solution for Point of Sale management.</p>
            <center><a href="login.php" class="login-button">Login</a></center>

        </div>
    </header>
    
    <section class="about-us">
        <div class="container">
            <h2>About Us</h2>
            <center><p>We are dedicated to providing the best POS solutions to streamline your business operations.</p></center>
            <div class="photo-frame">
                <div class="photo">
                    <img src="profile-pic.png" alt="Developer 1">
                    <p>Mohammed Usman K</p>
                </div>
                <div class="photo">
                    <img src="masoom1.jpg" alt="Developer 2">
                    <p>Md Masoom Raza</p>
                </div>
            </div>
        </div>
    </section>

    <section class="features">
        <div class="container">
            <h2>Features</h2>
            <div class="feature-item">
                <img src="">
                <h3>Easy Transactions</h3>
                <p>Handle all your sales transactions seamlessly and efficiently.</p>
            </div>
            <div class="feature-item">
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTfUa3OVB54QW7V-vpMh0U99TCRUEDojBjw5g&s" alt="Real-time Analytics">
                <h3>Real-time Analytics</h3>
                <p>Access real-time data and analytics to make informed decisions.</p>
            </div>
            <div class="feature-item">
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSlJPoOQtqEiNwrnUyWTzGSzQ_Mu9fOSdtIYA&s" alt="Customer Management">
                <h3>Customer Management</h3>
                <p>Manage customer information and sales history effectively.</p>
            </div>
        </div>
    </section>

    <section class="contact-us">
        <div class="container">
            <h2>Contact Us</h2>
            <p>Have questions or need support? Get in touch with our team.</p>
            <form>
                <input type="text" placeholder="Your Name" required>
                <input type="email" placeholder="Your Email" required>
                <textarea placeholder="Your Message" required></textarea>
                <button type="submit">Send Message</button>
            </form>
        </div>
    </section>

    <footer>
        <div class="container">
            <div class="footer-details">
                <div class="footer-section">
                    <h3>Company Info</h3>
                    <p>Osman Software Solution.INC</p>
                    <p>4TH Block, HBR Layout</p>
                    <p>Bengaluru - 560043</p>
                </div>
                <div class="footer-section">
                    <h3>Contact</h3>
                    <p>Phone: (+91) 9945535786</p>
                    <p>Email: os.uxui@gmail.com</p>
                </div>
                <div class="footer-section">
                    <h3>Follow Us</h3>
                    <p>
                        <a href="#" class="social-icon"><i class="fab fa-facebook-f">Instagram</i></a>
                        <a href="#" class="social-icon"><i class="fab fa-twitter"> Facebook</i></a>
                        <a href="#" class="social-icon"><i class="fab fa-linkedin-in">Linked In</i></a>
                    </p>
                </div>
            </div>
            <p>&copy; 2024 POS System Solutions Inc. All Rights Reserved.</p>
        </div>
    </footer>

    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <script src="scripts.js"></script>
</body>
</html>




