<?php
$servername = "localhost";
$username = "root";
$password = "";

// Create connection
$conn = mysqli_connect($servername, $username, $password,"test");

// Check connection
if (!$conn) {
    die("Connection failed: " .mysqli_connect_error());
}
//echo "Connected successfully";

if($_POST['type']=='elec')
{
    $sql="SELECT * FROM POWERDB";
    $rows = mysqli_query($conn,$sql);
    $num = mysqli_num_rows($rows);

    $sql="INSERT into POWERDB values($num,'$_POST[name]','$_POST[aadhar]','$_POST[region]','$_POST[district]','$_POST[state]','$_POST[des]')";
    mysqli_query($conn,$sql);
}
else
{
    $sql="SELECT * FROM SEWAGEDB";
    $rows = mysqli_query($conn,$sql);
    $num = mysqli_num_rows($rows);

    $sql="INSERT into SEWAGEDB values($num,'$_POST[name]','$_POST[aadhar]','$_POST[region]','$_POST[district]','$_POST[state]','$_POST[des]')";
    mysqli_query($conn,$sql);
}
include('success.html');
?>
