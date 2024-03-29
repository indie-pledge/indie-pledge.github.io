<?php
$servername = "DA PMA Signon";
$username = "khosak_hospital";
$password = "UjsgKXnXm95GFKLAyawK";
$dbname = "khosak_hospital";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$email = $_POST['email'];
$password = $_POST['password']; // Remember to use password hashing in real applications.

$sql = "SELECT id FROM Users WHERE email = '$email' AND password = '$password'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "Login successful.";
    // Handle session or redirection here
} else {
    echo "Invalid login credentials.";
}

$conn->close();
?>
