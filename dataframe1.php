<?php
echo '<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">';
echo '<center>';
echo '<style> div.card:hover,card-subtitle mb-2 text-muted:hover{background-color: white;color: black;}
div.card,card-subtitle mb-2 text-muted{background-color: black;color: white;}</style>';
$servername = "localhost";
$username = "root";
$password = "";
$val=0;
// Create connection
$conn = mysqli_connect($servername, $username, $password,"test");

// Check connection
if (!$conn) {
    die("Connection failed: " .mysqli_connect_error());
}
//echo "Connected successfully";

$sql = "SELECT REGION,DISTRICT,STATE FROM SEWAGEDB GROUP BY REGION HAVING COUNT(*) >= 1 ORDER BY COUNT(*) DESC";
//$sql = "SELECT REGION,DISTRICT,STATE FROM SEWAGEDB WHERE REGION = 'LB Nagar'";
$rows = mysqli_query($conn,$sql);

while($row = mysqli_fetch_assoc($rows))
{
    echo "<div class='card' style='width: 18rem;'>";
    echo "<div class='card-body'>";
    echo "<h5 class='card-title'>{$row['REGION']}</h5>";
    echo "<h6 class='card-subtitle mb-2 text-muted'>{$row['DISTRICT']}</h6>";
    echo "<p class='card-text'>{$row['STATE']}</p>";
    echo "</div>";
    echo "</div>";  
}
echo '</center>';
?>