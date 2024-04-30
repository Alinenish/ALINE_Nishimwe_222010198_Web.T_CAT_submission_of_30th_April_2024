<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Services</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        header {
            background-color: #333;
            color: #fff;
            padding: 20px;
            text-align: center;
        }

        .container {
            width: 80%;
            max-width: 600px;
            background-color: #fff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        form {
            margin-top: 30px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        label {
            font-weight: bold;
            margin-bottom: 10px;
            color: #333;
            display: inline-block;
            width: 100px;
            text-align: left;
        }

        input[type="text"],
        input[type="date"],
        select {
            width: calc(100% - 120px);
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            transition: border-color 0.3s;
        }

        input[type="text"]:focus,
        input[type="date"]:focus,
        select:focus {
            border-color: #1bf481;
        }

        input[type="submit"] {
            width: auto;
            padding: 10px 20px;
            background-color: #333;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #555;
        }

        .home-button {
            position: absolute;
            top: 20px;
            left: 20px;
            background-color: #0b0b0b;
            color: #1bf481;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            transition: background-color 0.3s;
        }

        .home-button:hover {
            background-color: #656262;
        }

        .error {
            border-color: red;
        }
    </style>
</head>
<body>
    <header>
        <h1>Services</h1>
    </header>
    <a href="index.html" class="home-button">Back Home</a>
    <div class="container">
        <form id="serviceForm" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label for="service-id">Service ID:</label>
            <input type="text" id="service-id" name="service-id" required>

            <label for="date">Date:</label>
            <input type="date" id="date" name="date" required>

            <label for="duration">Duration:</label>
            <input type="text" id="duration" name="duration" required>

            <label for="service-type">Type of Service:</label>
            <input type="text" id="service-type" name="service-type" required>

            <label for="availability">Availability:</label>
            <select id="availability" name="availability" required>
                <option value="" disabled selected>Select availability</option>
                <option value="Available">Available</option>
                <option value="Not Available">Not Available</option>
            </select>

            <input type="submit" value="Submit">
        </form>
    </div>

<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection parameters
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "customer_feedback_management";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Escape user inputs for security
    $serviceId = mysqli_real_escape_string($conn, $_POST['service-id']);
    $date = mysqli_real_escape_string($conn, $_POST['date']);
    $duration = mysqli_real_escape_string($conn, $_POST['duration']);
    $type = mysqli_real_escape_string($conn, $_POST['service-type']);
    $availability = mysqli_real_escape_string($conn, $_POST['availability']);

    // Insert service into database
    $sql = "INSERT INTO services (service_id, date, duration, type, availability) VALUES ('$serviceId', '$date', '$duration', '$type', '$availability')";

    if ($conn->query($sql) === TRUE) {
        echo "<p>Service submitted successfully</p>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close connection
    $conn->close();
}
?>
<script>
    document.getElementById("serviceForm").addEventListener("submit", function(event) {
        var form = event.target;
        var isValid = true;

        // Check if fields are filled
        var inputs = form.querySelectorAll("input[required], select[required]");
        for (var i = 0; i < inputs.length; i++) {
            if (!inputs[i].value) {
                isValid = false;
                inputs[i].classList.add("error");
            } else {
                inputs[i].classList.remove("error");
            }
        }

        if (!isValid) {
            event.preventDefault();
        }
    });
</script>
</body>
</html>
