<?php
// Retrieve the data from the request
$data = json_decode(file_get_contents('php://input'), true);

// Access the data
$RequestId = $data['RequestId'];
$conn = new mysqli('localhost', 'root', '', 'solve');
if ($conn->connect_error) {
    die('Connection Failed: ' . $conn->connect_error);
}
$sql = "SELECT req FROM issue WHERE Issue_ID = $RequestId"; // Use '=' for comparison
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$x = htmlspecialchars($row['req']);
$x = (int)$x;

if($x === 0){
    echo "REQUEST YET TO BE DELIVERED";
}
else if($x === 1){
    echo "REQUEST ACCEPTED";
}
else if($x === 2){
    echo "REQUEST COMPLETED";
}
else{
    echo "Error";
}

// Close the database connection
$conn->close();
?>
