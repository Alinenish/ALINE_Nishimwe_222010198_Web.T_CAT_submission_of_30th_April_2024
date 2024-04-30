<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Feedback Form</title>
<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
    }
    .container {
        max-width: 800px;
        margin: 20px auto;
        padding: 20px;
        position: relative;
    }
    form {
        max-width: 400px;
        margin: 0 auto;
    }
    label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
    }
    input[type="text"],
    textarea {
        width: 100%;
        padding: 8px;
        box-sizing: border-box;
        margin-bottom: 10px;
    }
    input[type="submit"] {
        background-color: #007bff;
        color: #fff;
        border: none;
        padding: 10px 20px;
        cursor: pointer;
    }
    input[type="submit"]:hover {
        background-color: #0056b3;
    }
    .back-btn {
        position: absolute;
        top: 20px;
        left: 20px;
        background-color: #0995ed;
        color: #fff;
        border: none;
        padding: 10px 20px;
        cursor: pointer;
    }
</style>
</head>
<body>

<a href="index.html" class="back-btn" onclick="goBack()">Back to Home</a>

<div class="container">
    <h2>Feedback Form</h2>

    <form id="feedbackForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="customerId">Customer ID:</label>
        <input type="text" id="customerId" name="customerId" placeholder="Enter Customer ID">
        
        <label for="reply">Reply:</label>
        <input type="text" id="reply" name="reply" placeholder="Enter Reply">
        
        <label for="replyManager">Reply Manager:</label>
        <input type="text" id="replyManager" name="replyManager" placeholder="Enter Reply Manager">
        
        <label for="feedbackText">Feedback Text:</label>
        <textarea id="feedbackText" name="feedbackText" placeholder="Enter Feedback Text"></textarea>
        
        <input type="submit" value="Submit Feedback">
    </form>
</div>

<script>
function goBack() {
    window.history.back();
}
</script>

<?php
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
    $customerId = mysqli_real_escape_string($conn, $_POST['customerId']);
    $reply = mysqli_real_escape_string($conn, $_POST['reply']);
    $replyManager = mysqli_real_escape_string($conn, $_POST['replyManager']);
    $feedbackText = mysqli_real_escape_string($conn, $_POST['feedbackText']);

    // Insert feedback into database
    $sql = "INSERT INTO feedback (customer_id, reply, reply_manager, feedback_text) VALUES ('$customerId', '$reply', '$replyManager', '$feedbackText')";

    if ($conn->query($sql) === TRUE) {
        echo "Feedback submitted successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close connection
    $conn->close();
}
?>

</body>
</html>
