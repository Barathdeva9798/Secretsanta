<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "barath_database";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Run a simple query
$sql = "SELECT id, name, email FROM user"; // Assuming there's a 'users' table
$result = mysqli_query($conn, $sql);

// Check if query was successful and if there are results
if (mysqli_num_rows($result) > 0) {
    // Fetch and display each row
    while ($row = mysqli_fetch_assoc($result)) {
        echo "id: " . $row["id"] . " - Name: " . $row["name"] . " - Email: " . $row["email"] . "<br>";
    }
} else {
    echo "0 results";
}

// Close connection
mysqli_close($conn);
?>
