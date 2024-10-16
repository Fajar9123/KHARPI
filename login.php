<!-- <?php
include 'koneksi.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve and sanitize form data
    $fullname = $mysqli->real_escape_string($_POST['fullname']);
    $username = $mysqli->real_escape_string($_POST['username']);
    $password = $mysqli->real_escape_string($_POST['password']);
    $belt_rank = $mysqli->real_escape_string($_POST['belt_rank']);

    // Prepare SQL query to find user
    $sql = "SELECT * FROM login WHERE username = ? AND full_name = ? AND belt_rank = ?";

    if ($stmt = $mysqli->prepare($sql)) {
        $stmt->bind_param('sss', $username, $fullname, $belt_rank);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();
            // Verify the password
            if (password_verify($password, $user['password'])) {
                echo "Login successful!";
                // Redirect to a dashboard or another page
                // header("Location: dashboard.php");
            } else {
                echo "Invalid password.";
            }
        } else {
            echo "No user found.";
        }

        $stmt->close();
    } else {
        echo "Error: " . $mysqli->error;
    }

    // Close the connection
    $mysqli->close();
} else {
    echo "Invalid request method.";
}
?> -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        /* Basic reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Fullscreen background with image */
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            background: url('img/kharpi1.jpg') no-repeat center center fixed;
            background-size: cover;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        /* Centering container */
        .login-container {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100%;
            padding: 20px;
        }

        /* Styling the login box with transparency */
        .login-box {
            width: 360px;
            padding: 40px;
            background: rgba(255, 255, 255, 0.2); /* More transparent */
            border-radius: 10px;
            box-shadow: 0 15px 25px rgba(0, 0, 0, 0.25);
            border: 1px solid rgba(255, 255, 255, 0.2); /* Lighter border */
            display: flex;
            flex-direction: column;
            justify-content: flex-start; /* Align items to the top */
        }

        /* Header styling */
        .login-box h2 {
            margin: 0 0 20px 0; /* Remove top margin and keep bottom margin */
            color: #333;
            font-size: 28px;
            text-align: center;
        }

        /* Textbox styling */
        .textbox {
            margin-bottom: 20px;
        }

        .textbox input {
            width: 100%;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
            transition: border-color 0.3s ease;
        }

        .textbox input:focus {
            border-color: #6e8efb;
            outline: none;
        }

        /* Button styling */
        .btn {
            width: 100%;
            background: #e63946; /* Red color */
            border: none;
            padding: 15px;
            border-radius: 5px;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
            transition: background 0.3s ease, transform 0.3s ease;
        }

        .btn:hover {
            background: #d62839; /* Darker red */
            transform: scale(1.05);
        }

        /* Register link styling */
        .register-link {
            margin-top: 20px;
            text-align: center;
        }

        .register-link p {
            margin: 0;
            color: #333;
        }

        .register-link a {
            color: #6e8efb;
            text-decoration: none;
            font-weight: bold;
        }

        .register-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-box">
            <h2>Login</h2>
            <form id="loginForm">
                <div class="textbox">
                    <input type="text" placeholder="Fullname" name="fullname" required>
                </div>
                <div class="textbox">
                    <input type="text" placeholder="Username" name="username" required>
                </div>
                <div class="textbox">
                    <input type="password" placeholder="Password" name="password" required>
                </div>
                <div class="textbox">
                    <input type="text" placeholder="Tingkatan Sabuk" name="belt_rank" required>
                </div>
                <input type="submit" class="btn" value="Login">
                <div id="responseMessage" style="color: red; margin-top: 20px; text-align: center;"></div>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('loginForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent the default form submission
            
            var formData = new FormData(this);

            fetch('process_login.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                var responseMessage = document.getElementById('responseMessage');
                if (data.success) {
                    responseMessage.style.color = 'green';
                    responseMessage.textContent = data.message;
                    // Optionally, redirect to another page
                    // window.location.href = 'dashboard.php';
                } else {
                    responseMessage.style.color = 'red';
                    responseMessage.textContent = data.message;
                }
            })
            .catch(error => {
                console.error('Error:', error);
                document.getElementById('responseMessage').textContent = 'An error occurred.';
            });
        });
    </script>
</body>
</html>
