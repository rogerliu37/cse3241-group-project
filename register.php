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
    // define variables and set to empty values
    $nameErr = $ageErr = $phoneErr = $doseErr = $manufacturerErr = "";
    $name = $phone = $manufacturer = "";
    $dose = $age = 0;
    $status = "incomplete";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["name"])) {
            $nameErr = "Name is required";
        } else {
            $name = test_input($_POST["name"]);
            // check if name only contains letters and whitespace
            if (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
                $nameErr = "Only letters and white space allowed";
            }
        }

        if (empty($_POST["age"])) {
            $ageErr = "Age is required";
        } else {
            $age = test_input($_POST["age"]);
            if (!preg_match("/^[0-9]{1,3}$/", $age)) {
                $ageErr = "Invalid Age";
            }
        }

        if (empty($_POST["phone"])) {
            $phoneErr = "Phone is required";
        } else {
            $phone = test_input($_POST["phone"]);
            if (!preg_match("/^[0-9]{10,10}$/", $phone)) {
                $phoneErr = "Invalid Phone";
            }
        }

        if (empty($_POST["dose"])) {
            $doseErr = "Dose is required";
        } else {
            $dose = test_input($_POST["dose"]);

            if (!preg_match("/^[1-2]{1,1}$/", $dose)) {
                $doseErr = "Invalid Dose";
            }
        }

        if (empty($_POST["manufacturer"])) {
            $manufacturerErr = "Manufacturer is required";
        } else {
            $manufacturer = test_input($_POST["manufacturer"]);

            if (strcmp($manufacturer, "J&J") !== 0 and strcmp($manufacturer, "Moderna") !== 0 and strcmp($manufacturer, "Pfizer") !== 0) {
                $manufacturerErr = "Invalid Manufacturer";
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

    <h2>COVID Register</h2>
    <p><span class="error">* required field</span></p>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        Name: <input type="text" name="name" value="<?php echo $name; ?>">
        <span class="error">* <?php echo $nameErr; ?></span>
        <br><br>
        Age: <input type="number" name="age" value="<?php echo $age; ?>">
        <span class="error">* <?php echo $ageErr; ?></span>
        <br><br>
        phone: <input type="text" name="phone" value="<?php echo $phone; ?>">
        <span class="error"><?php echo $phoneErr; ?></span>
        <br><br>
        dose: <input type="number" name="dose" value="<?php echo $dose; ?>">
        <span class="error"><?php echo $doseErr; ?></span>
        <br><br>
        manufacturer: <input type="text" name="manufacturer" value="<?php echo $manufacturer; ?>">
        <span class="error"><?php echo $manufacturerErr; ?></span>
        <br><br>
        <input type="submit" name="submit" value="Submit">
    </form>

    <?php
    echo "<h2>Your Input:</h2>";
    echo $name;
    echo "<br>";
    echo $age;
    echo "<br>";
    echo $phone;
    echo "<br>";
    echo $dose;
    echo "<br>";
    echo $manufacturer;
    echo "<br>";
    ?>
    <?php
    if (strlen($nameErr) == 0 and strlen($ageErr) == 0 and strlen($phoneErr) == 0 and strlen($doseErr) == 0 and strlen($manufacturerErr) == 0) {
        $servername = "localhost";
        $username = "root";
        $password = "Ruijie0307!";
        $dbname = "vaccine";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "INSERT INTO Customer(Cell_num, NumberOfDoses, Customer_name, Manufacturer, Status, Age) 
            VALUES('$phone', '$dose', '$name', '$manufacturer', '$status', '$age')";

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