<?php
$servername = "localhost";
$username = "root";
$password = ""; // Your MySQL root password, if any
$dbname = "snapdeal";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $mobile = $_POST["mobile"];
    $email = $_POST["email"];
    $name = $_POST["name"];
    $dob = $_POST["dob"];
    $password = $_POST["password"];

    $mobile = mysqli_real_escape_string($conn, $mobile);
    $email = mysqli_real_escape_string($conn, $email);
    $name = mysqli_real_escape_string($conn, $name);
    $dob = mysqli_real_escape_string($conn, $dob);
    $password = mysqli_real_escape_string($conn, $password);

    // Check if the user exists
    $sql = "SELECT * FROM users WHERE email = '$email' OR mobile = '$mobile'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // User exists, check password
        $row = $result->fetch_assoc();
        if ($row['password'] == $password) {
            echo "Login successful!";
        } else {
            echo "Invalid password.";
        }
    } else {
        // User doesn't exist, create new user
        $sql = "INSERT INTO form (mobile, email, name, dob, password) VALUES ('$mobile', '$email', '$name', '$dob', '$password')";
        if ($conn->query($sql) === TRUE) {
            echo "Registration successful!";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

$conn->close();
?>