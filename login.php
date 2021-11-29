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
    $idErr = "";
    $id = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["id"])) {
            $idErr = "id is required";
        } else {
            $id = test_input($_POST["id"]);
            if (!preg_match("/^[0-9]{1,20}$/", $id)) {
                $idErr = "Invalid id";
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

    <h2>Adniministrator Login</h2>
    <p><span class="error">* required field</span></p>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        id: <input type="text" name="id" value="<?php echo $id; ?>">
        <span class="error"><?php echo $idErr; ?></span>
        <br><br>
        <input type="submit" name="submit" value="Submit">
    </form>

    <?php
    echo "<h2>Your Input:</h2>";
    echo $id;
    echo "<br>";
    ?>
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

    $sql = "select * FROM Administrator where Admini_id = '$id'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) != 0) {
        echo "Admin account found.";
        echo '<br>
        <a href="admin.php">Administrator View</a>';

    } else {
        echo "No Admin account found.";
    }
    ?>

</body>

</html>