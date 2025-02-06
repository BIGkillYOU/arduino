<?php
$servername = "localhost";  
$username = "root";        
$password = "";            
$dbname = "water_web_data";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $slave_name = $_POST['slave_name'];
    $status = $_POST['status'];

    $sql = "INSERT INTO slave_status (slave_name, status) 
            VALUES ('$slave_name', '$status')
            ON DUPLICATE KEY UPDATE 
            status='$status', last_updated=NOW()";

    if ($conn->query($sql) === TRUE) {
        echo "Status updated successfully";
    } else {
        echo "Error: " . $conn->error;
    }
}

$conn->close();
?>
