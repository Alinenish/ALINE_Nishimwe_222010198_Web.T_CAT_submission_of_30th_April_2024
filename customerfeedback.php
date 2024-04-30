<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Feedback Registration</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color:gray; /* Light gray background */
        }

        .container {
            width: 50%;
            margin: 50px auto;
            background-color: #fff; /* White background for the form */
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1); /* Shadow effect */
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="password"],
        input[type="email"],
        select {
            width: calc(100% - 24px);
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
            box-sizing: border-box;
        }

        input[type="submit"],
        input[type="button"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        input[type="submit"]:hover,
        input[type="button"]:hover {
            background-color: #45a049;
        }

        .back-to-home {
            position: fixed;
            top: 20px;
            left: 20px;
            background-color: #007bff; /* Blue color for the button */
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 3px;
            text-decoration: none; /* Remove default link underline */
        }

        .back-to-home:hover {
            background-color: #0056b3; /* Darker blue on hover */
        }

        input[type="button"].cancel {
            background-color: #ff0000; /* Red color for the button */
        }
    </style>
</head>
<body>
    <a href="home_page.html" class="back-to-home">Back to Home</a>
    <div class="container">
        <h2>Customer Feedback Registration</h2>
        <form action="register.php" method="post">
            <div class="form-group">
                <label for="customer_id">Customer ID:</label>
                <input type="text" id="customer_id" name="customer_id" required>
            </div>
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="country">Country:</label>
                <select id="country" name="country" required>
                    <option value="">Select Country</option>
                    <!-- Add options for countries -->
                    <option value="USA">USA</option>
                    <option value="UK">UK</option>
                    <option value="Canada">Canada</option>
                    <option value="Rwanda">Rwanda</option>
                    <!-- Add more options as needed -->
                </select>
            </div>
            <div class="form-group">
                <label for="district">District:</label>
                <input type="text" id="district" name="district" required>
            </div>
            <div class="form-group">
                <label for="age">Age:</label>
                <input type="text" id="age" name="age" required>
            </div>
            <div class="form-group">
                <label for="gender">Gender:</label>
                <select id="gender" name="gender" required>
                    <option value="">Select Gender</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <!-- Add more options as needed -->
                </select>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <input type="submit" value="Register">
                <input type="button" class="cancel" value="Cancel">
            </div>
        </form>
    </div>

    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "customer_feedback_management";

    $conn = new mysqli($servername, $username, $password, $database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $customerId = $_POST['customer_id'];
        $name = $_POST['name'];
        $country = $_POST['country'];
        $district = $_POST['district'];
        $age = $_POST['age'];
        $gender = $_POST['gender'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        $stmt = $conn->prepare("INSERT INTO customerfeedback (customer_id, name, country, district, age, gender, email, password) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("isssiss", $customerId, $name, $country, $district, $age, $gender, $email, $password);

        if ($stmt->execute() === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    }

    $conn->close();
    ?>
</body>
</html>
