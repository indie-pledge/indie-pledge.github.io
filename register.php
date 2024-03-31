<?php

$servername = "DA PMA Signon";
$username = "khosak_hospital";
$password = "UjsgKXnXm95GFKLAyawK";
$dbname = "khosak_hospital";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$stmt = $conn->prepare("INSERT INTO Patients (name, dob, gender, contact, email) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("sssss", $name, $dob, $gender, $contact, $email);


$name = $_POST['name'];
$dob = $_POST['dob'];
$gender = $_POST['gender'];
$contact = $_POST['contact'];
$email = $_POST['email'];
$stmt->execute();

echo "Registration successful.";

$stmt->close();
$conn->close();
?>
