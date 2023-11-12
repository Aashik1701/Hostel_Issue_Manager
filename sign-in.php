<?php
$username = $_POST["username"];
$password = $_POST["password"];
$conn = new mysqli('localhost', 'root', '', 'solve');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT Aid, password FROM admin WHERE Aid = ? LIMIT 1";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$stmt->bind_result($dbUsername, $dbPassword);

if ($stmt->fetch()) {
    if ($password == $dbPassword) {
        echo '<script>alert("Success Login");</script>';
        echo '<script>window.location.href = "Admin-HostelManager.html";</script>';
    } else {
        echo '<script>alert("Wrong password");</script>';
        echo '<script>window.location.href = "sign-in.html";</script>';
    }
} else {
    echo '<script>alert("Username not found");</script>';
    echo '<script>window.location.href = "sign-in.html";</script>';
}

$stmt->close();
$conn->close();
?>
