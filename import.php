<html>
<head>
<title>Test PHP Connection Script</title>
</head>
<body>

<h3>Welcome to the PHP Connect Test</h3>

<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$dbname = 'domesticflight';
$dbuser = 'root';
$dbpass = 'thilanka123';
$dbhost = 'localhost';
// Create connection
$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully <br>";


$sql = "SELECT id, name FROM test";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "id: " . $row["id"]. " - Name: " . $row["name"]. "<br>";
    }
} else {
    echo "0 results";
}
$conn->close();
?>

</body>
</html>