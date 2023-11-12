<?php
// Retrieve the data from the request
$data = json_decode(file_get_contents('php://input'), true);

// Access the data
$name = $data['name'];
$registrationId = $data['registrationId'];
$roomNum = $data['roomNum'];
$category = $data['category'];
$hostelName = $data['hostelName'];
$comments = $data['comments'];
$req = 0;
$conn = new mysqli('localhost', 'root', '', 'solve');
if ($conn->connect_error) {
    die('Connection Failed: ' . $conn->connect_error);
}
$insertSql = "INSERT INTO issue (name, registration_id, hostel, room_no, problem, `explain`, req) VALUES (?, ?, ?, ?, ?, ?, ?)";


if ($stmt = $conn->prepare($insertSql)) {
    $stmt->bind_param("sssissi", $name, $registrationId, $hostelName, $roomNum, $category, $comments,$req);
    if ($stmt->execute()) {
        $sql = "SELECT Issue_Id FROM issue WHERE Issue_Id = (SELECT MAX(Issue_Id) FROM issue)";
        $result = $conn->query($sql); // Execute the SQL query
        $row = $result->fetch_assoc();
        $x = htmlspecialchars($row['Issue_Id']);

    echo "Success Your request id is: " . $x;
    }
    else{
        echo "Failed";
    }
}

// Close the database connection
$conn->close();
?>
