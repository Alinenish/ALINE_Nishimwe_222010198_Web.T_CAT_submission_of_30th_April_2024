<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Contact Us - Customer Feedback Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            font-family: "New Times Roman", Times, serif;
            margin: 0;
            padding: 0;
            background-color: #f7f7f7; /* Light gray background */
            color: #333;
            line-height: 1.6;
        }
        
        header {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 20px;
            margin-bottom: 20px;
            position: relative;
        }
        
        header h1 {
            margin: 0;
            font-size: 36px;
        }
        
        .back-home-btn {
            position: absolute;
            top: 20px;
            left: 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 8px 16px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
            text-decoration: none;
        }
        
        .back-home-btn:hover {
            background-color: #0056b3;
        }
        
        .contact-form {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.1);
        }
        
        .contact-form h2 {
            font-size: 24px;
            margin-bottom: 20px;
        }
        
        .contact-form label {
            font-weight: bold;
        }
        
        .contact-form input[type="text"],
        .contact-form input[type="email"],
        .contact-form textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        
        .contact-form textarea {
            height: 150px;
            resize: none;
        }
        
        .contact-form input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 12px 20px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }
        
        .contact-form input[type="submit"]:hover {
            background-color: #0056b3;
        }
        
        .contact-info {
            max-width: 600px;
            margin: 20px auto;
            text-align: center;
        }
        
        .contact-info li {
            margin-bottom: 10px;
            font-size: 18px;
            list-style: none;
        }
        
        .social-links {
            max-width: 300px;
            margin: 20px auto;
            text-align: center;
        }
        
        .social-links a {
            display: inline-block;
            margin: 0 10px;
            font-size: 24px;
            color: #007bff;
            text-decoration: none;
            transition: color 0.3s;
        }
        
        .social-links a:hover {
            color: #0056b3;
        }
        
        footer {
            background-color:none;
            color: #fff;
            text-align: down;
            padding: 20px 0;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>

<body>
    <header>
        <h1>Contact Us</h1>
        <a href="index.html" class="back-home-btn">Back Home</a>
    </header>
    <div class="contact-form">
        <h2>Send us a Message</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" id="contact-form">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            <label for="message">Message:</label>
            <textarea id="message" name="message" required></textarea>
            <input type="submit" value="Send Message">
        </form>
    </div>
    <div class="contact-info">
        <h2>Contact Information</h2>
        <ul>
            <li>Email: customerfm@gmail.com</li>
            <li>Phone: +250780821669</li>
        </ul>
    </div>
    <div class="social-links">
        <h2>Follow Us</h2>
        <li>
        <a href="https://www.facebook.com" target="_blank">Facebook</a></li>
        <li><a href="https://www.x.com" target="_blank">Twitter (X)</a></li>
       <li> <a href="https://www.instagram.com" target="_blank">Instagram</a>
    </li>
    </div>
    
    <script>
        // Client-side form validation
        document.getElementById("contact-form").addEventListener("submit", function(event) {
            var name = document.getElementById("name").value;
            var email = document.getElementById("email").value;
            var message = document.getElementById("message").value;

            if (!name || !email || !message) {
                alert("All fields are required");
                event.preventDefault();
            }
        });
    </script>

    <?php
    // Database connection parameters
    $servername = "localhost"; // Change this to your server name
    $username = "root"; // Change this to your database username
    $password = ""; // Change this to your database password
    $dbname = "customer_feedback_management"; // Change this to your database name

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Process form submission
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Prepare and bind parameters
        $name = $_POST["name"];
        $email = $_POST["email"];
        $message = $_POST["message"];

        // Insert data into database
        $sql = "INSERT INTO contactmessages (name, email, message) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $name, $email, $message);

        if ($stmt->execute()) {
            echo "<p>Message submitted successfully</p>";
        } else {
            echo "<p>Error: " . $sql . "<br>" . $conn->error . "</p>";
        }

        $stmt->close();
    }

    $conn->close();
    ?>
</body>

</html>
