<?php
/**
 * Created by PhpStorm.
 * User: Asus
 * Date: 5/22/2017
 * Time: 12:32 AM
 */

//$str = 'jhun,jhun@example.com';
//$a = explode(',',$str);
//echo $a[0].' '.$a[1];
$user=$_POST['user'];
$email=$_POST['email'];
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "INSERT INTO test (username, email) VALUES ('$user', '$email')";

if ($conn->query($sql) === TRUE) {
    $last_id = $conn->insert_id;
    echo "**New record created successfully. Last inserted ID is: " . $last_id;
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
