<?php
$servername = "DA PMA Signon";
$username = "khosak_hospital";
$password = "UjsgKXnXm95GFKLAyawK";
$dbname = "khosak_hospital";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$stmt = $conn->prepare("INSERT INTO Appointments (department, doctor, date, time, patient_id) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("ssssi", $department, $doctor, $date, $time, $patient_id);

$department = $_POST['department'];
$doctor = $_POST['doctor'];
$date = $_POST['date'];
$time = $_POST['time'];
$patient_id = $_POST['patient_id']; // You'll need to handle patient identification.
$stmt->execute();

echo "Appointment booked successfully.";

$stmt->close();
$conn->close();
?>
