<html>

<body>
    <form name="form" method="post">
        <input type="submit" name="button1" value="1 shot" />
        <input type="submit" name="button2" value="Moderna fully vaccinated" />
        <input type="submit" name="button3" value="Pfizer fully vaccinated" />
        <input type="submit" name="button4" value="J&J fully vaccinated" />
       
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

    $sql = "select count(NumberOfDoses) FROM customer where NumberOfDoses > 0";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_array($result)) {
        echo "Number of people with at least one shot: " . $row[0]  . "   ";
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

    $sql = "select count(NumberOfDoses) FROM customer where NumberOfDoses = 2 and Manufacturer='Moderna'";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_array($result)) {
        echo "Number of people with Moderna fully vaccinated: " . $row[0]  . "   ";
    }
    if (mysqli_num_rows($result) == 0) {
        echo "Nobody get fully vaccinated through Moderna.";
    }
} //if isset

if (isset($_POST['button3'])) {

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

    $sql = "select count(NumberOfDoses) FROM customer where NumberOfDoses = 2 and Manufacturer='Pfizer'";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_array($result)) {
        echo "Number of people with Pfizer fully vaccinated: " . $row[0]  . "   ";
    }
    if (mysqli_num_rows($result) == 0) {
        echo "Nobody get fully vaccinated through Pfizer.";
    }
} //if isset

if (isset($_POST['button4'])) {

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

    $sql = "select count(NumberOfDoses) FROM customer where NumberOfDoses = 1 and Manufacturer='Johnson and Johnson'";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_array($result)) {
        echo "Number of people with J&J fully vaccinated: " . $row[0]  . "   ";
    }
    if (mysqli_num_rows($result) == 0) {
        echo "Nobody get fully vaccinated through J&J.";
    }
} //if isset
?>

</html>