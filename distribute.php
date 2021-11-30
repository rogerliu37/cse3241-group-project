<html>

<body>
    <?php
    // define variables and set to empty values
    $nameErr = $ageErr = $phoneErr = $trackingidErr = $manufacturerErr = "";
    $name = $phone = $manufacturer = "";
    $trackingid = $age = 0;
    $status = "incomplete";
    $dosetrackingid = rand(0, 100000);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {


        if (empty($_POST["phone"])) {
            $phoneErr = "Phone is required";
        } else {
            $phone = test_input($_POST["phone"]);
            if (!preg_match("/^[0-9]{10,10}$/", $phone)) {
                $phoneErr = "Invalid Phone";
            }
        }

        if (empty($_POST["trackingid"])) {
            $trackingidErr = "trackingid is required";
        } else {
            $trackingid = test_input($_POST["trackingid"]);

            if (!preg_match("/^[0-9]{1,10}$/", $trackingid)) {
                $trackingidErr = "Invalid Phone";
            }
        }
    }

    function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    ?>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">

        <br><br>
        phone: <input type="text" name="phone" value="<?php echo $phone; ?>">

        <br><br>
        trackingid: <input type="number" name="trackingid" value="<?php echo $trackingid; ?>">
        <br><br>
        dose <input type="text" name="dose" value="<?php echo $dose; ?>">
        <br><br>
        <input type="submit" name="submit" value="Distribute">
    </form>
</body>
<?php
$servername = "localhost";
$username = "root";
$password = "mysql";
$dbname = "vaccine";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

echo "Available Pfizer Vaccines" . "<br>";
$sql = 'select * FROM VaccineBatch where Manufacturer = "Pfizer" and ExpirationDate >= CURDATE();';

$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_array($result)) {
    echo "Tracking ID: " . $row[0]  . "   ";
    echo "Manufacturer: " . $row[1]  . "   ";
    echo "Quantity: " . $row[2]  . "   ";
    echo "Expiration Date: " . $row[3]  . "   ";
    echo "<br>";
}
if (mysqli_num_rows($result) == 0) {
    echo "No vaccination information found.";
}

echo "<br>";
echo "<br>";
echo "Available J&J Vaccines" . "<br>";
$sql = 'select * FROM VaccineBatch where Manufacturer = "Johnson and Johnson" and ExpirationDate >= CURDATE();';

$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_array($result)) {
    echo "Tracking ID: " . $row[0]  . "   ";
    echo "Manufacturer: " . $row[1]  . "   ";
    echo "Quantity: " . $row[2]  . "   ";
    echo "Expiration Date: " . $row[3]  . "   ";
    echo "<br>";
}
if (mysqli_num_rows($result) == 0) {
    echo "No vaccination information found.";
}
echo "<br>";
echo "<br>";
echo "Available Moderna Vaccines" . "<br>";
$sql = 'select * FROM VaccineBatch where Manufacturer = "Moderna" and ExpirationDate >= CURDATE();';
echo "<br>";
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_array($result)) {
    echo "Tracking ID: " . $row[0]  . "   ";
    echo "Manufacturer: " . $row[1]  . "   ";
    echo "Quantity: " . $row[2]  . "   ";
    echo "Expiration Date: " . $row[3]  . "   ";
    echo "<br>";
}
if (mysqli_num_rows($result) == 0) {
    echo "No vaccination information found.";
}

echo "<br>";
echo "<br>";
echo "<br>";
$sql = 'select * FROM Customer where status = "incomplete";';
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_array($result)) {
    // echo $row[0] . " ";
    echo "Phone Number: " . $row[0]  . "   ";
    echo "Tracking Number: " . $row[1]  . "   ";
    echo "Dose: " . $row[2]  . "   ";
    echo "Name: " . $row[3]  . "   ";
    echo "Manufacturer: " . $row[4]  . "   ";
    echo "Status: " . $row[5]  . "   ";
    echo "Age: " . $row[6]  . "   ";
    echo "<br>";
}
if (mysqli_num_rows($result) == 0) {
    echo "No vaccination information found.";
}
?>

<?php

if (isset($_POST['submit'])) {

    $servername = "localhost";
    $username = "root";
    $password = "mysql";
    $dbname = "vaccine";


    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    echo "<br>";
    echo "<br>";
    $sql = "UPDATE Customer Set status = 'complete' where Cell_num = '$phone';";
    if ($conn->query($sql) == TRUE) {
        echo "Updated successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    echo "<br>";
    echo "<br>";
    $sql = "UPDATE Customer Set NumberOfDoses = NumberOfDoses + 1 where Cell_num = '$phone';";
    if ($conn->query($sql) === TRUE) {
        echo "Customer Doses";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    echo "<br>";
    echo "<br>";
    $sql = "UPDATE VaccineBatch Set Quantity = Quantity - 1 where TrackingNumber = '$trackingid';";
    if ($conn->query($sql) === TRUE) {
        echo "Updated Inventory Successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }echo $dosetrackingid;
echo "<br>";
    echo "<br>";
    echo "<br>";
    $sql = "UPDATE Customer Set TrackingNumber = '$dosetrackingid' where Cell_num = '$phone';";
    if ($conn->query($sql) === TRUE) {
        echo "Tracking Number Updated successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
} //if isset




?>

</html>