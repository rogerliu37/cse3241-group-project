<html>

<body>
    <form name="form" method="post">
        <input type="submit" name="button1" value="1 shot" />
        <input type="submit" name="button2" value="fully vaccinated" />
       
    </form>
</body>
<?php

if (isset($_POST['button1'])) {

    $servername = "localhost";
    $username = "root";
    $password = "0307";
    $dbname = "vaccine";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "select count * FROM customer where NumberOfDoses >0";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_array($result)) {
        echo "Tracking ID: " . $row[0]  . "   ";
        echo "Manufacturer: " . $row[1]  . "   ";
        echo "Quantity: " .$row[2]  . "   ";
        echo "Expiration Date: " . $row[3]  . "   ";
        echo "<br";
    }
    if (mysqli_num_rows($result) == 0) {
        echo "Nobody get at least 1 shot.";
    }
} //if isset

if (isset($_POST['button2'])) {

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

    $sql = 'select count * FROM customer where Manufacturer = "Pfizer"';
    
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_array($result)) {
        echo "Tracking ID: " . $row[0]  . "   ";
        echo "Manufacturer: " . $row[1]  . "   ";
        echo "Quantity: " .$row[2]  . "   ";
        echo "Expiration Date: " . $row[3]  . "   ";
        echo "<br";
    }
    if (mysqli_num_rows($result) == 0) {
        echo "Nobody are fully vaccinated";
    }
} //if isset


?>

</html>