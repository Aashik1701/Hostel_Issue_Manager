<?php
$username = $_POST["username"];
$username = strtolower($username);
echo $username;
$password = $_POST["password"];
$conn = new mysqli('localhost', 'root', '', 'solve');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT Uid, password FROM user WHERE Uid = ? LIMIT 1";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$stmt->bind_result($dbUsername, $dbPassword);

if ($stmt->fetch()) {
    if ($password == $dbPassword) {
        echo '<script>alert("Success Login");</script>';
        echo '<script>window.location.href = "HostelManager.html";</script>';
    } else {
        echo '<script>alert("Wrong password");</script>';
        echo '<script>window.location.href = "user-login.html";</script>';
    }
} else {
    echo '<script>alert("Username not found");</script>';
    echo '<script>window.location.href = "user-login.html";</script>';
}

$stmt->close();
$conn->close();
?>
