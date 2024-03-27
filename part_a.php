<?php
$servername = "DA PMA Signon"; 
$username = "khosak"; 
$password = "password123"; 
$dbname = "khosak_db"; 


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$userTypes = [];
$query = "SELECT user_code, user_description FROM User_codes";
$result = $conn->query($query);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $userTypes[$row["user_code"]] = $row["user_description"];
    }
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $conn->real_escape_string($_POST['first_name']);
    $last_name = $conn->real_escape_string($_POST['last_name']);
    $user_type = $conn->real_escape_string($_POST['user_type']);
    $email = $conn->real_escape_string($_POST['email']);
    $password = $conn->real_escape_string($_POST['password']);

    
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO user_profiles (first_name, last_name, usercode, email, password) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $first_name, $last_name, $user_type, $email, $hashed_password);
    if ($stmt->execute()) {
        echo "Record inserted successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $stmt->close();
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Profile Form</title>
</head>
<body>
<form action="part_a.php" method="post">
    <label for="first_name">First name:</label><br>
    <input type="text" id="first_name" name="first_name" required><br>
    <label for="last_name">Last name:</label><br>
    <input type="text" id="last_name" name="last_name" required><br>
    <label for="user_type">User Type:</label><br>
    <select id="user_type" name="user_type">
        <?php foreach($userTypes as $code => $description): ?>
            <option value="<?= $code ?>"><?= $description ?></option>
        <?php endforeach; ?>
    </select><br>
    <label for="email">E-mail:</label><br>
    <input type="email" id="email" name="email" required><br>
    <label for="password">Password:</label><br>
    <input type="password" id="password" name="password" required><br><br>
    <input type="submit" value="Submit">
</form>
</body>
</html>
