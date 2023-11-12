<?php
// Retrieve the data from the request
$data = json_decode(file_get_contents('php://input'), true);

// Access the data
$FacTyp = $data['FacTyp'];
$FacDat = $data['FacDat'];
$conn = new mysqli('localhost', 'root', '', 'personnel');
if ($conn->connect_error) {
    die('Connection Failed: ' . $conn->connect_error);
}

if ($FacTyp === 'A') {
    $FacDat = intval($FacDat);
    $sql = "SELECT CABIN_DETAIL FROM prof_info WHERE EMP_ID = ?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $FacDat);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $x = htmlspecialchars($row['CABIN_DETAIL']);
            echo $x;
        } else {
            echo "No matching records found.";
        }
    } else {
        echo "Error in SQL query: " . $conn->error;
    }
} else if ($FacTyp === 'B') {
    $sql = "SELECT CABIN_DETAIL FROM prof_info WHERE FACULTY_NAME = ?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("s", $FacDat);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $x = htmlspecialchars($row['CABIN_DETAIL']);
            echo $x;
        } else {
            echo "No matching records found.";
        }
    } else {
        echo "Error in SQL query: " . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>
