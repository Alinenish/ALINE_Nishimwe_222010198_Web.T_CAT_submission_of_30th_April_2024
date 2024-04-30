<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attachments</title>
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

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 10px;
            color: #333;
        }

        input[type="text"],
        input[type="date"] {
            width: calc(100% - 20px);
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            transition: border-color 0.3s;
        }

        input[type="text"]:focus,
        input[type="date"]:focus {
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

        .back-home {
            position: absolute;
            top: 20px;
            left: 20px;
            background-color: #0a0a0a;
            color: #1bf481;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            transition: background-color 0.3s;
        }

        .back-home:hover {
            background-color: #656262;
        }
    </style>
</head>
<body>
    <header>
        <h1>Attachments</h1>
    </header>
    <a href="index.html" class="back-home">Back to Home</a>
    <div class="container">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" id="attachment-form">
            <label for="attachment-id">Attachment ID:</label>
            <input type="text" id="attachment-id" name="attachment-id" required>

            <label for="file-name">File Name:</label>
            <input type="text" id="file-name" name="file-name" required>

            <label for="file-type">File Type:</label>
            <input type="text" id="file-type" name="file-type" required>

            <label for="file-size">File Size:</label>
            <input type="text" id="file-size" name="file-size" required>

            <label for="date-uploaded">Date Uploaded:</label>
            <input type="date" id="date-uploaded" name="date-uploaded" required>

            <input type="submit" value="Submit">
        </form>
    </div>

    <script>
        // Client-side form validation
        document.getElementById("attachment-form").addEventListener("submit", function(event) {
            var attachmentId = document.getElementById("attachment-id").value;
            var fileName = document.getElementById("file-name").value;
            var fileType = document.getElementById("file-type").value;
            var fileSize = document.getElementById("file-size").value;
            var dateUploaded = document.getElementById("date-uploaded").value;

            if (!attachmentId || !fileName || !fileType || !fileSize || !dateUploaded) {
                alert("All fields are required");
                event.preventDefault();
            }

            // Add more validation logic as needed
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
        $attachment_id = $_POST["attachment-id"];
        $file_name = $_POST["file-name"];
        $file_type = $_POST["file-type"];
        $file_size = $_POST["file-size"];
        $date_uploaded = $_POST["date-uploaded"];

        // Insert data into database
        $sql = "INSERT INTO attachments (attachment_id, file_name, file_type, file_size, date_uploaded) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssis", $attachment_id, $file_name, $file_type, $file_size, $date_uploaded);

        if ($stmt->execute()) {
            echo "<p>New record inserted successfully</p>";
        } else {
            echo "<p>Error: " . $sql . "<br>" . $conn->error . "</p>";
        }

        $stmt->close();
    }

    $conn->close();
    ?>
</body>
</html>
