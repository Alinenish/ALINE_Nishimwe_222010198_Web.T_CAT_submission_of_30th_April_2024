<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Feedback Management Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: gray; /* Light gray background */
        }

        .container {
            width: 300px;
            margin: 50px auto;
            background-color: #fff; /* White background for the form */
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1); /* Shadow effect */
            position: relative; /* Needed for positioning child elements */
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

        input[type="email"],
        input[type="password"],
        select {
            width: calc(100% - 24px);
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            width: 100%;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        .form-group:last-child {
            margin-bottom: 0; /* Remove margin bottom for the last form group */
        }

        .forgot-password {
            text-align: center;
        }

        .forgot-password a {
            color: #007bff; /* Blue color for the link */
            text-decoration: none; /* Remove default link underline */
        }

        .forgot-password a:hover {
            text-decoration: underline; /* Underline on hover */
        }

        .back-to-home {
            position: absolute;
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
    </style>
</head>
<body>
    <a href="home page.html" class="back-to-home">Back to Home</a>
    <div class="container">
        <h2>Login</h2>
        <form id="loginForm" action="#" method="post">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="role">Role:</label>
                <select id="role" name="role" required>
                    <option value="">Select Role</option>
                    <option value="manager">Manager</option>
                    <option value="customer">Customer</option>
                </select>
            </div>
            <div class="form-group">
                <input type="submit" value="Login">
            </div>
        </form>
        <div class="forgot-password">
            <a href="#">Forgot password?</a>
        </div>
    </div>

    <script>
        document.getElementById("loginForm").addEventListener("submit", function(event) {
            event.preventDefault(); // Prevent form submission
            
            // Get the selected role
            var role = document.getElementById("role").value;

            // Redirect based on the selected role
            if (role === "manager") {
                window.location.href = "manager dashboard.html"; // Redirect to manager dashboard
            } else if (role === "customer") {
                window.location.href = "index.html"; // Redirect to customer dashboard
            } else {
                alert("Please select a role."); // Show an alert if no role is selected
            }
        });
    </script>
</body>
</html>
