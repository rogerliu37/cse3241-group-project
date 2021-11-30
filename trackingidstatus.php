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
    $trackingidErr = "";
    $trackingid = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["trackingid"])) {
            $trackingidErr = "trackingid is required";
        } else {
            $trackingid = test_input($_POST["trackingid"]);
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

    <h2>COVID Status Checker</h2>
    <p><span class="error">* required field</span></p>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        trackingid: <input type="text" name="trackingid" value="<?php echo $trackingid; ?>">
        <span class="error"><?php echo $trackingidErr; ?></span>
        <br><br>
        <input type="submit" name="submit" value="Submit">
    </form>

    <?php
    echo "<h2>Your Input:</h2>";
    echo $trackingid;
    echo "<br>";
    ?>
    <?php
    if (strlen($trackingidErr) == 0) {
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

        $sql = "select * FROM Customer where TrackingNumber = '$trackingid'";
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_array($result)) {
            echo $row['Status'] . "<br>";
        }
        if (mysqli_num_rows($result) == 0) {
            echo "No vaccination information found.";
        }
    }

    ?>

</body>

</html>