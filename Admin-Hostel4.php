<?php
$data = json_decode(file_get_contents('php://input'), true);
$ReqNo = $data['ReqNo'];
$FacTyp = $data['FacTyp'];
$FacTyp = intval($FacTyp);
$conn = new mysqli('localhost', 'root', '', 'solve');
if ($conn->connect_error) {
    die('Connection Failed: ' . $conn->connect_error);
}
$sql = "UPDATE issue SET req = ? WHERE Issue_Id = ?";
if ($stmt = $conn->prepare($sql)) {
    $stmt->bind_param("ii", $ReqNo,$FacTyp);
    if ($stmt->execute()) {
        echo "Data updated successfully.";
    } else {
        echo "Error updating data: " . $conn->error;
    }

    // Close the statement
    $stmt->close();
} else {
    echo "Error preparing the SQL statement: " . $conn->error;
}
$conn->close();
?>
