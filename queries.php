<html>

<body>
    <form name="form" method="post">
        <input type="submit" name="button1" value="Total" />
        <input type="submit" name="button2" value="Pfizer" />
        <input type="submit" name="button3" value="J&J" />
        <input type="submit" name="button4" value="Moderna" />

    </form>
</body>
<?php

if (isset($_POST['button1'])) {

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

    $sql = "select * FROM VaccineBatch";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_array($result)) {
        echo "Tracking ID: " . $row[0]  . "   ";
        echo "Manufacturer: " . $row[1]  . "   ";
        echo "Quantity: " .$row[2]  . "   ";
        echo "Expiration Date: " . $row[3]  . "   ";
        echo "<br";
    }
    if (mysqli_num_rows($result) == 0) {
        echo "No vaccination information found.";
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

    $sql = 'select * FROM VaccineBatch where Manufacturer = "Pfizer"';
    
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_array($result)) {
        echo "Tracking ID: " . $row[0]  . "   ";
        echo "Manufacturer: " . $row[1]  . "   ";
        echo "Quantity: " .$row[2]  . "   ";
        echo "Expiration Date: " . $row[3]  . "   ";
        echo "<br";
    }
    if (mysqli_num_rows($result) == 0) {
        echo "No vaccination information found.";
    }
} //if isset

if (isset($_POST['button3'])) {

    echo ("You clicked button three!");
} //if isset

if (isset($_POST['button4'])) {

    echo ("You clicked button four!");
} //if isset

?>

</html>