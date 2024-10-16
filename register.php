<?php
include 'portalberita/config/koneksi.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve and sanitize form data
    $fullname = $mysqli->real_escape_string($_POST['fullname']);
    $email = $mysqli->real_escape_string($_POST['email']);
    $phone = $mysqli->real_escape_string($_POST['phone']);
    $belt_rank = $mysqli->real_escape_string($_POST['belt_rank']);
    $password = $mysqli->real_escape_string($_POST['password']);

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    // SQL query to insert data into the register table
    $sql = "INSERT INTO register (nama_lengkap, email, phone, belt_rank, password) VALUES ('$fullname', '$email', '$phone', '$belt_rank', '$hashed_password')";

    // Execute query and check for success
    if ($mysqli->query($sql) === TRUE) {
        echo "Pendaftaran berhasil!";
    } else {
        echo "Error: " . $sql . "<br>" . $mysqli->error;
    }

    // Close the connection
    $mysqli->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Pelatih Silat</title>
    <link rel="stylesheet" href="styles.css">
</head>
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
.register-container {
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100%;
    padding: 20px;
}

/* Styling the register box with transparency */
.register-box {
    width: 360px;
    padding: 40px;
    background: rgba(255, 255, 255, 0.85); /* Slightly less transparent */
    border-radius: 10px;
    box-shadow: 0 15px 25px rgba(0, 0, 0, 0.3);
    border: 1px solid rgba(255, 255, 255, 0.3); /* Subtle border */
}

/* Header styling */
.register-box h2 {
    margin-bottom: 20px;
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

</style>
<body>
    <div class="register-container">
        <div class="register-box">
            <h2>Daftar Pelatih Silat</h2>
            <form action="register.php" method="post">
                <div class="textbox">
                    <input type="text" placeholder="Nama Lengkap" name="fullname" required>
                </div>
                <div class="textbox">
                    <input type="email" placeholder="Email" name="email" required>
                </div>
                <div class="textbox">
                    <input type="tel" placeholder="Nomor Telepon" name="phone" required>
                </div>
                <div class="textbox">
                    <input type="text" placeholder="Tingkatan Sabuk" name="belt_rank" required>
                </div>
                <div class="textbox">
                    <input type="password" placeholder="Password" name="password" required>
                </div>
                <input type="submit" class="btn" value="Daftar">
            </form>
        </div>
    </div>
</body>
</html>
