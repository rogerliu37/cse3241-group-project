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
    $password = "mysql";
    $dbname = "vaccine";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "select * FROM VaccineBatch;";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_array($result)) {
        // echo $row[0] . " ";
        echo "Tracking ID: " . $row[0]  . "   ";
        echo "Manufacturer: " . $row[1]  . "   ";
        echo "Quantity: " .$row[2]  . "   ";
        echo "Expiration Date: " . $row[3]  . "   ";
        echo "<br>";
    }
    if (mysqli_num_rows($result) == 0) {
        echo "No vaccination information found.";
    }
} //if isset

if (isset($_POST['button2'])) {

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
    echo "Available Vaccines" . "<br>";
    $sql = 'select * FROM VaccineBatch where Manufacturer = "Pfizer" and ExpirationDate >= CURDATE();';

    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_array($result)) {
        echo "Tracking ID: " . $row[0]  . "   ";
        echo "Manufacturer: " . $row[1]  . "   ";
        echo "Quantity: " .$row[2]  . "   ";
        echo "Expiration Date: " . $row[3]  . "   ";
        echo "<br>";
    }
    if (mysqli_num_rows($result) == 0) {
        echo "No vaccination information found.";
    }
    echo "<br>";
    echo "Expired Vaccines" . "<br>";
    $sql = 'select * FROM VaccineBatch where Manufacturer = "Pfizer" and ExpirationDate < CURDATE();';

    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_array($result)) {
        echo "Tracking ID: " . $row[0]  . "   ";
        echo "Manufacturer: " . $row[1]  . "   ";
        echo "Quantity: " .$row[2]  . "   ";
        echo "Expiration Date: " . $row[3]  . "   ";
        echo "<br>";
    }
    if (mysqli_num_rows($result) == 0) {
        echo "No vaccination information found.";
    }
    echo "<br>";
    echo "Used Vaccines" . "<br>";
    $sql = 'select count(Customer_name) FROM Customer where Manufacturer = "Pfizer" and status = "complete";';

    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_array($result)) {
        echo "Number of used vaccines from Pfizer: " . $row[0]  . "   ";
    }
    if (mysqli_num_rows($result) == 0) {
        echo "No vaccination information found.";
    }
} //if isset

if (isset($_POST['button3'])) {

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

    echo "Available Vaccines" . "<br>";
    $sql = 'select * FROM VaccineBatch where Manufacturer = "Johnson and Johnson" and ExpirationDate >= CURDATE();';

    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_array($result)) {
        echo "Tracking ID: " . $row[0]  . "   ";
        echo "Manufacturer: " . $row[1]  . "   ";
        echo "Quantity: " .$row[2]  . "   ";
        echo "Expiration Date: " . $row[3]  . "   ";
        echo "<br>";
    }
    if (mysqli_num_rows($result) == 0) {
        echo "No vaccination information found.";
    }
    echo "<br>";
    echo "<br>";
    echo "Expired Vaccines" . "<br>";
    $sql = 'select * FROM VaccineBatch where Manufacturer = "Johnson and Johnson" and ExpirationDate < CURDATE();';

    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_array($result)) {
        echo "Tracking ID: " . $row[0]  . "   ";
        echo "Manufacturer: " . $row[1]  . "   ";
        echo "Quantity: " .$row[2]  . "   ";
        echo "Expiration Date: " . $row[3]  . "   ";
        echo "<br>";
    }
    
    if (mysqli_num_rows($result) == 0) {
        echo "No vaccination information found.";
    }

    echo "Used Vaccines" . "<br>";
    $sql = 'select count(Customer_name) FROM Customer where Manufacturer = "Johnson and Johnson" and status = "complete";';

    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_array($result)) {
        echo "Number of used vaccines from Johnson and Johnson: " . $row[0]  . "   ";
    }
    if (mysqli_num_rows($result) == 0) {
        echo "No vaccination information found.";
    }
} //if isset

if (isset($_POST['button4'])) {

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

    echo "Available Vaccines" . "<br>";
    $sql = 'select * FROM VaccineBatch where Manufacturer = "Moderna" and ExpirationDate >= CURDATE();';

    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_array($result)) {
        echo "Tracking ID: " . $row[0]  . "   ";
        echo "Manufacturer: " . $row[1]  . "   ";
        echo "Quantity: " .$row[2]  . "   ";
        echo "Expiration Date: " . $row[3]  . "   ";
        echo "<br>";
    }
    if (mysqli_num_rows($result) == 0) {
        echo "No vaccination information found.";
    }
    echo "<br>";
    echo "Expired Vaccines" . "<br>";
    $sql = 'select * FROM VaccineBatch where Manufacturer = "Moderna" and ExpirationDate < CURDATE();';
    
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_array($result)) {
        echo "Tracking ID: " . $row[0]  . "   ";
        echo "Manufacturer: " . $row[1]  . "   ";
        echo "Quantity: " .$row[2]  . "   ";
        echo "Expiration Date: " . $row[3]  . "   ";
        echo "<br>";
    }

    if (mysqli_num_rows($result) == 0) {
        echo "No vaccination information found.";
    }
    echo "<br>";
    echo "Used Vaccines" . "<br>";
    $sql = 'select count(Customer_name) FROM Customer where Manufacturer = "Pfizer" and status = "complete";';

    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_array($result)) {
        echo "Number of used vaccines from Pfizer: " . $row[0]  . "   ";
    }
    if (mysqli_num_rows($result) == 0) {
        echo "No vaccination information found.";
    }
    
} //if isset

?>

</html>