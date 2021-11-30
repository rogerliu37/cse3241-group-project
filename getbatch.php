<!DOCTYPE HTML>
<html>

<head>
    <style>
        .error {
            color: #FF0000;
        }
    </style>
</head>


<body>

    <?php
    /**
     * Check if the value is a valid date
     *
     * @param mixed $value
     *
     * @return boolean
     */
    function isDate($value)
    {
        if (!$value) {
            return false;
        }

        try {
            new \DateTime($value);
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
    // define variables and set to empty values
    $doseErr = $manufacturerErr = $dateErr = "";
    $manufacturer = "";
    $dose = 0;
    $trackingid = 1000;
    $status = "incomplete";
    $date = "";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        if (empty($_POST["dose"])) {
            $doseErr = "Dose is required";
        } else {
            $dose = test_input($_POST["dose"]);

            if (!preg_match("/^[0-9]{1,3}$/", $dose)) {
                $doseErr = "Invalid Dose";
            }
        }

        if (empty($_POST["manufacturer"])) {
            $manufacturerErr = "Manufacturer is required";
        } else {
            $manufacturer = test_input($_POST["manufacturer"]);

            if (strcmp($manufacturer, "Johnson and Johnson") !== 0 and strcmp($manufacturer, "Moderna") !== 0 and strcmp($manufacturer, "Pfizer") !== 0) {
                $manufacturerErr = "Invalid Manufacturer";
            }
        }
        if (empty($_POST["date"])) {
            $dateErr = "Date is required";
        } else {
            $date = test_input($_POST["date"]);

            if (!isDate($_POST["date"])) {
                $dateErr = "Invalid Date";
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

    <h2>Request Batch</h2>
    <p><span class="error">* required field</span></p>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        dose: <input type="number" name="dose" value="<?php echo $dose; ?>">
        <span class="error"><?php echo $doseErr; ?></span>
        <br><br>
        manufacturer: <input type="text" name="manufacturer" value="<?php echo $manufacturer; ?>">
        <span class="error"><?php echo $manufacturerErr; ?></span>
        <br><br>
        expiration date: <input type="text" name="date" value="<?php echo $date; ?>">
        <span class="error"><?php echo $dateErr; ?></span>
        <br><br>
        <input type="submit" name="submit" value="Submit">
    </form>

    <?php
    echo "<h2>Your Input:</h2>";
    echo $trackingid;
    echo "<br>";
    echo $dose;
    echo "<br>";
    echo $manufacturer;
    echo "<br>";
    echo $date;
    echo "<br>";
    ?>
    <?php
    if (strlen($doseErr) == 0 and strlen($manufacturerErr) == 0 and strlen($dateErr) == 0) {
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
        $check_num_row='select count(*) FROM VaccineBatch';
        $num_of_row=mysqli_query($conn, $check_num_row);
        if($num_of_row!=0){
            $max_tracking_id='select MAX(TrackingNumber) FROM VaccineBatch';
            $trackingid=1+ mysqli_query($conn, $max_tracking_id);
        }

        $sql = "INSERT INTO VaccineBatch(TrackingNumber, Manufacturer, Quantity, ExpirationDate) 
            VALUES('$trackingid', '$manufacturer', '$dose', '$date')";

        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        $conn->close();
    } else {
        echo "No table entry made";
    }

    ?>

</body>

</html>