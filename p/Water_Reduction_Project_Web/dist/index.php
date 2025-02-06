<?php
// Include the database configuration file
require_once __DIR__ . '/../dist/config.php';

// Initialize default variables
$soil_moisture = 0;
$soil_moisture1 = 0;
$inputnum = '';
$inputnum1 = '';
$message = '';

// Retrieve data for soil moisture and input numbers
$sql = "SELECT dataon.Soil_moisture AS Soil_moisture, dataon1.Soil_moisture AS Soil_moisture1 
        FROM dataon, dataon1 
        ORDER BY dataon.timestamp DESC 
        LIMIT 1";
$result = $conn->query($sql);
if ($result && $row = $result->fetch_assoc()) {
    $soil_moisture = $row["Soil_moisture"];
    $soil_moisture1 = $row["Soil_moisture1"];
}

$sql = "SELECT dataon.inputnum AS inputnum, dataon1.inputnum AS inputnum1 
        FROM dataon, dataon1 
        ORDER BY dataon.timestamp DESC 
        LIMIT 1";
$result = $conn->query($sql);
if ($result && $row = $result->fetch_assoc()) {
    $inputnum = $row["inputnum"];
    $inputnum1 = $row["inputnum1"];
}

// Handle form submission for the first input
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['input1'])) {
    $input_value = $conn->real_escape_string($_POST['input1']);
    $sql_insert = "INSERT INTO dataon (inputnum, timestamp) VALUES ('$input_value', NOW())";
    if ($conn->query($sql_insert) === TRUE) {
        $message = "ข้อมูลใหม่ใน dataon ได้รับการเพิ่มสำเร็จ!";
        // Update $inputnum after inserting
        $sql = "SELECT inputnum FROM dataon ORDER BY id DESC LIMIT 1";
        $result = $conn->query($sql);
        if ($result && $row = $result->fetch_assoc()) {
            $inputnum = $row["inputnum"];
        }
    } else {
        $message = "เกิดข้อผิดพลาด: " . $conn->error;
    }
}

// Handle form submission for the second input
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['input2'])) {
    $input_value = $conn->real_escape_string($_POST['input2']);
    $sql_insert = "INSERT INTO dataon1 (inputnum, timestamp) VALUES ('$input_value', NOW())";
    if ($conn->query($sql_insert) === TRUE) {
        $message = "ข้อมูลใหม่ใน dataon1 ได้รับการเพิ่มสำเร็จ!";
        // Update $inputnum1 after inserting
        $sql = "SELECT inputnum FROM dataon1 ORDER BY id DESC LIMIT 1";
        $result = $conn->query($sql);
        if ($result && $row = $result->fetch_assoc()) {
            $inputnum1 = $row["inputnum"];
        }
    } else {
        $message = "เกิดข้อผิดพลาด: " . $conn->error;
    }
}

// Close the connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Soil moisture project</title>
    <link rel="stylesheet" href="H.css">

    <link href="https://fonts.googleapis.com/css?family=Poppins:400,600,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://kit.fontawesome.com/f0601b0fb2.js" crossorigin="anonymous"></script>
    <script type='module' src='https://unpkg.com/ionicons@5.0.0/dist/ionicons/ionicons.esm.js'></script>
    <script nomodule='' src='https://unpkg.com/ionicons@5.0.0/dist/ionicons/ionicons.js'></script>
    <meta name="viewport" content="width=device-width, initial-scale=1"><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
</head>
<body>
    <div class="container2">
        <div class="cat">
            <div class="ear ear--left"></div>
            <div class="ear ear--right"></div>
            <div class="face">
                <div class="eye eye--left">
                    <div class="eye-pupil"></div>
                </div>
                <div class="eye eye--right">
                    <div class="eye-pupil"></div>
                </div>
                <div class="muzzle"></div>
            </div>
        </div>
    </div>
    <div class="button-container">
        <button class="btn btn__secondary" id="theme-toggle">Toggle Theme</button>
    </div>
    <div class="container">
        <div class="componentss">
<!-- |||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||| -->
            <div class="chip" style="grid-column: 1; grid-row: 1;">
                <div class="chip__icon">
                <img src="../dist/image/iot.png" alt="Icon 2" style="width: 100%; height: 100%; border-radius: 1rem;"></div>
                <div class="chip__close"><p>เครื่องแม่</p></div>
            </div>
            <div class="icon" style="grid-column: 2; grid-row: 1;">
            <div class="icon__home">
            </div>
            </div>
            
<!-- |||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||| -->
            <div class="chip" style="grid-column: 1; grid-row: 2;">
                <div class="chip__icon">
                <img src="../dist/image/iot.png" alt="Icon 2" style="width: 100%; height: 100%; border-radius: 1rem;"></div>
                <div class="chip__close"><p>เครื่องลูก เครื่องที่ 1</p></div>
            </div>
            <div class="icon" style="grid-column: 2; grid-row: 2;">
            <div class="icon__home">
            </div>
            </div>
<!-- |||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||| -->
            <div class="chip" style="grid-column: 1; grid-row: 3;">
                <div class="chip__icon">
                <img src="../dist/image/iot.png" alt="Icon 2" style="width: 100%; height: 100%; border-radius: 1rem;"></div>
                <div class="chip__close"><p>เครื่องลูก เครื่องที่ 2</p></div>
            </div>
            <div class="icon" style="grid-column: 2; grid-row: 3;">
            <div class="icon__home">
            </div>
            </div>
<!-- |||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||| -->
            <div class="chip2" style="grid-column: 3; grid-row: 2;">
                <div class="chip__icon">
                <img src="../dist/image/humidity.png" alt="Icon 2" style="width: 100%; height: 100%; border-radius: 1rem;"></div>
                <!--div class="chip__close"><p>000/wfv</p></div-->
                <div class="chip__close">
                <p><?php echo htmlspecialchars($soil_moisture); ?>/wfv</p>
                </div>
            </div>
<!-- |||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||| -->
            <div class="chip2" style="grid-column: 3; grid-row: 3;">
                <div class="chip__icon">
                <img src="../dist/image/humidity.png" alt="Icon 2" style="width: 100%; height: 100%; border-radius: 1rem;"></div>
                <div class="chip__close">
                <p><?php echo htmlspecialchars($soil_moisture1); ?>/wfv</p>
                </div>
            </div>
<!-- |||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||| -->
                <!--div class="form" style="grid-column: 4; grid-row: 2;">
                <input type="text" name="input_value" class="form__input" placeholder="<!?php echo $placeholder; ?>" required>
                </div-->
                <form method="POST" style="display: flex; align-items: center; grid-column: 4; grid-row: 2;" action="">
                    <div class="form" class="form__input" style="flex: 1; margin-right: 10px;">
                        <input type="text" name="input1" class="form__input" placeholder="<?php echo htmlspecialchars($inputnum); ?>" required>
                    </div>
                    <button type="submit" class="btn btn__primary chip__icon" style="flex-shrink: 0; width: 40px; height: 40px;">
                        <img src="../dist/image/diskette.png" alt="Save" style="height: 100%;">
                    </button>
                </form>

                <form method="POST" style="display: flex; align-items: center; grid-column: 4; grid-row: 3;" action="">
                    <div class="form" class="form__input" style="flex: 1; margin-right: 10px;">
                        <input type="text" name="input2" class="form__input" placeholder="<?php echo htmlspecialchars($inputnum1); ?>" required>
                    </div>
                    <button type="submit" class="btn btn__primary chip__icon" style="flex-shrink: 0; width: 40px; height: 40px;">
                        <img src="../dist/image/diskette.png" alt="Save" style="height: 100%;">
                    </button>
                </form>
<!-- |||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||| -->
                <!--div class="form" style="grid-column: 4; grid-row: 3;">
                    <input type="text" name="input_value" class="form__input" placeholder="input" required>
                </div-->
<!-- |||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||| -->
                <!--div type="submit" class="btn btn__primary chip__icon" style="grid-column: 5; grid-row: 2;"><img src="../dist/image/diskette.png" alt="Icon 2" style="width: 65%; height: 65%;"></div-->
<!-- |||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||| -->
                <!--div class="btn btn__primary chip__icon" style="grid-column: 5; grid-row: 3;"><img src="../dist/image/diskette.png" alt="Icon 2" style="width: 65%; height: 65%;"></div-->
<!-- |||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||| -->
            <?php if (isset($message)): ?>
                <p style="color: green;"> <?php echo $message; ?> </p>
            <?php endif; ?>
        </div>
        </div>
    </div>
    <script src="H.js"></script>
</body>
</html>

                <!--span class="circle__btn" onclick="location.href='indexG1.html'">
                    <div class="icon">
                        <div class="game__controller">
                        <ion-icon name="game-controller"></ion-icon>
                        </div>
                    </div>
                </span-->