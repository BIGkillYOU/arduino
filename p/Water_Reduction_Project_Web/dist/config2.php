<?php
// ข้อมูลการเชื่อมต่อฐานข้อมูล
$servername = "localhost";  
$username = "root";        
$password = "";            
$dbname = "water_web_data";  

// สร้างการเชื่อมต่อกับฐานข้อมูล
$conn = new mysqli($servername, $username, $password, $dbname);

// ตรวจสอบการเชื่อมต่อ
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// ตรวจสอบว่ามีการส่งตัวแปร soil_moisture ผ่าน URL หรือไม่
if (isset($_GET["soil_moisture"])) {
    // รับค่าตัวแปรจาก URL
    $soil_moisture = $conn->real_escape_string($_GET["soil_moisture"]); // ป้องกัน SQL Injection

    // SQL สำหรับเพิ่มข้อมูลลงในฐานข้อมูล
    $sql = "INSERT INTO dataon (soil_moisture) VALUES ('$soil_moisture')";

    // ตรวจสอบว่าการเพิ่มข้อมูลสำเร็จหรือไม่
    if ($conn->query($sql) === TRUE) {
        echo "Data inserted successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    //echo "Error: soil_moisture data not received!";
}

?>