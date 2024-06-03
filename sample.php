<?php
session_start();

include ("db.php");

if ($_SERVER['REQUEST METHOD'] == "POST") {
  $Mobile_no = $_POST['mobile'];
  $Email = $_POST['email'];
  $Name = $_POST['name'];
  $Dob = $_POST['dob'];
  $Password = $_POST['password'];

  if (!empty($Email) && !empty($Password) && !is_numeric($Email)) {


    $query = "insert into form (mobile, email, name, dob, password) values ('$Mobile_no', '$Email', '$Name', '$Dob', '$Password')";

    mysqli_query($con, $query);

    echo "<script type='text/javascript'>  alert('Successfully Register')</script>";
  } else {
    echo "<script type='text/javascript'>  alert('Please Enter Valid Information')</script>";
  }
}

?>
if (isset($_POST['retrieve'])) {

$con = mysqli_connect("localhost", "root", "", "register") or die(mysqli_connect_error());
if ($con) {

$query = "SELECT * FROM details";
$result = mysqli_query($con, $query);
if (mysqli_num_rows($result) > 0) {
echo "<h2>Retrieved all the information:</h2>";
while ($row = mysqli_fetch_assoc($result)) {
echo "Email: " . $row['email'] . "<br>";
}
} else {
echo "No emails found<br>";
}
mysqli_close($con);
} else {
echo "Database connection failed<br>";
}
}

<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "register";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Mobile_no = $_POST['mobile'];
    $Email = $_POST['email'];
    $Name = $_POST['name'];
    $Dob = $_POST['dob'];
    $Password = $_POST['password'];

    // Check if fields are not empty and email is valid
    if (!empty($Email) && !empty($Password) && is_numeric($Mobile_no)) {
        // Correct variable names in escape functions
        $Mobile_no = $conn->real_escape_string($Mobile_no);
        $Email = $conn->real_escape_string($Email);
        $Name = $conn->real_escape_string($Name);
        $Dob = $conn->real_escape_string($Dob);
        $Password = $conn->real_escape_string($Password);
        // Use hashed password in query
        $hashed_password = password_hash($Password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO form (mobile, email, name, dob, password) values ('$Mobile_no', '$Email', '$Name', '$Dob', '$hashed_password')";
        if ($conn->query($sql) === TRUE) {
            header("Location: dashboard.php");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Invalid data provided.";
    }
}

$conn->close();

?>