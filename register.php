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
    $nameErr = $ageErr = $phoneErr = "";
    $name = $age = $phone = "";

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
        } 
        else {
            $age = test_input($_POST["age"]);
            // check if name only contains letters and whitespace
            if (!preg_match("/^[0-9]{1,10}$/", $age)) {
                $ageErr = "Invalid Age";
            }
        }

        if (empty($_POST["phone"])) {
            $phoneErr = "Phone is required";
        } 
        else {
            $phone = test_input($_POST["phone"]);
            // check if name only contains letters and whitespace
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

    <h2>COVID Register</h2>
    <p><span class="error">* required field</span></p>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        Name: <input type="text" name="name" value="<?php echo $name; ?>">
        <span class="error">* <?php echo $nameErr; ?></span>
        <br><br>
        Age: <input type="text" name="age" value="<?php echo $age; ?>">
        <span class="error">* <?php echo $ageErr; ?></span>
        <br><br>
        phone: <input type="text" name="phone" value="<?php echo $phone; ?>">
        <span class="error"><?php echo $phoneErr; ?></span>
        <br><br>

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
    ?>

</body>

</html>