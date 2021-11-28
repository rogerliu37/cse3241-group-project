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
    $phoneErr = "";
    $phone = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["phone"])) {
            $phoneErr = "Phone is required";
        } else {
            $phone = test_input($_POST["phone"]);
            if (!preg_match("/^[0-9]{10,10}$/", $phone)) {
                $phoneErr = "Invalid Phone";
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

    <h2>COVID Status Checker</h2>
    <p><span class="error">* required field</span></p>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        phone: <input type="text" name="phone" value="<?php echo $phone; ?>">
        <span class="error"><?php echo $phoneErr; ?></span>
        <br><br>
        <input type="submit" name="submit" value="Submit">
    </form>

    <?php
    echo "<h2>Your Input:</h2>";
    echo $phone;
    echo "<br>";
    ?>
    <?php
    if (strlen($phoneErr) == 0) {
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

        $sql = "select * FROM Customer where Cell_num = '$phone'";
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