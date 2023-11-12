<?php

$conn = new mysqli('localhost', 'root', '', 'solve');
// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Define a SQL query to retrieve data from your table
$sql = "SELECT * FROM issue where req=0";  // Change 'your_table' to the name of your table

// Execute the SQL query
$result = $conn->query($sql);

// Check if there are rows in the result
if ($result->num_rows > 0) {
    echo "<style>
            table {
                border-collapse: collapse;
                width: 100%;
            }
            th, td {
                border: 1px solid #000;
                padding: 8px;
                text-align: left;
            }
            th {
                background-color: #0074cc;
                color: #fff;
            }
            </style>";
    echo "<h2>Pending Requests</h2>";
    echo "<table border='1'>
            <tr>
                <th>ISSUE_ID</th>
                <th>Name</th>
                <th>REGISTR_ID</th>
                <th>HOSTEL</th>
                <th>ROOM_NO</th>
                <th>PROBLEM</th>
                <th>Explain</th>

            </tr>";

    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row["Issue_Id"] . "</td>
                <td>" . $row["name"] . "</td>
                <td>" . $row["registration_id"] . "</td>
                <td>" . $row["hostel"] . "</td>
                <td>" . $row["room_no"] . "</td>
                <td>" . $row["problem"] . "</td>
                <td>" . $row["explain"] . "</td>
              </tr>";
    }

    echo "</table>";
} else {
    echo "No data found.";
}

// Close the database connection
$conn->close();
?>
