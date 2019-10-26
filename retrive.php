<html>
<head>
<title> </title>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.4/dist/leaflet.css"/>
<script src='https://unpkg.com/leaflet@1.3.4/dist/leaflet.js'></script>
<style>#map{position:absolute;top:0;bottom:0;left:0;right:0;}</style>

<?php
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

$sql = "SELECT REGION,DISTRICT,STATE FROM POWERDB GROUP BY REGION HAVING COUNT(*) >= 1";
//$sql = "SELECT REGION,DISTRICT,STATE FROM POWERDB WHERE REGION = 'LB Nagar'";
$rows = mysqli_query($conn,$sql);

$latis = array();
$longis = array();
$areas = array();

while($row = mysqli_fetch_assoc($rows))
{
    $str = "{$row['REGION']}, {$row['DISTRICT']}, {$row['STATE']}, India";
    $box = geocode($str);
    array_push($latis,$box[0]);
    array_push($longis,$box[1]);
    array_push($areas,$row['REGION']);
    $val=$val+1;
}

$val1 = 0;
$sql = "SELECT REGION,DISTRICT,STATE FROM SEWAGEDB GROUP BY REGION HAVING COUNT(*) >= 1";
//$sql = "SELECT REGION,DISTRICT,STATE FROM POWERDB WHERE REGION = 'LB Nagar'";
$rows = mysqli_query($conn,$sql);

$latis1 = array();
$longis1 = array();
$areas1 = array();

while($row = mysqli_fetch_assoc($rows))
{
    $str = "{$row['REGION']}, {$row['DISTRICT']}, {$row['STATE']}, India";
    $box = geocode($str);
    array_push($latis1,$box[0]);
    array_push($longis1,$box[1]);
    array_push($areas1,$row['REGION']);
    $val1=$val1+1;
}

//print_r();
//print_r();
//print_r();

// function to geocode address, it will return false if unable to geocode address
function geocode($address){
 
    // url encode the address
    $address = urlencode($address);
     
    // google map geocode api url
    $url = "https://maps.googleapis.com/maps/api/geocode/json?address={$address}&key=AIzaSyBNwUWSiCFthbptHkAXd9lBPESiDrJa08I";
 
    // get the json response
    $resp_json = file_get_contents($url);
     
    // decode the json
    $resp = json_decode($resp_json, true);
 
    // response status will be 'OK', if able to geocode given address 
    if($resp['status']=='OK'){
 
        // get the important data
        $lati = isset($resp['results'][0]['geometry']['location']['lat']) ? $resp['results'][0]['geometry']['location']['lat'] : "";
        $longi = isset($resp['results'][0]['geometry']['location']['lng']) ? $resp['results'][0]['geometry']['location']['lng'] : "";
        $formatted_address = isset($resp['results'][0]['formatted_address']) ? $resp['results'][0]['formatted_address'] : "";
        //echo $lati," ",$longi;
        // verify if data is complete
        if($lati && $longi && $formatted_address){
         
            // put the data in the array
            $data_arr = array();            
             
            array_push(
                $data_arr, 
                    $lati, 
                    $longi, 
                    $formatted_address
                );
             
            return $data_arr;
             
        }else{
            return false;
        }
         
    }
 
    else{
        echo "<strong>ERROR: {$resp['status']}</strong>";
        return false;
    }
}
?>

<script>
function markArea(){

var i=0;
var n=<?php echo $val; ?>;
var lat=[<?php echo '"'.implode('","', $latis).'"' ?>];
var lng=[<?php echo '"'.implode('","', $longis).'"' ?>];
var area=[<?php echo '"'.implode('","', $areas).'"' ?>];
var map=L.map('map').setView([17.132,79.208],1);
map.setZoom(8);
mapLink = '<a href="http://openstreetmap.org">OpenStreetMap</a>';
        L.tileLayer(
            'http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; ' + mapLink + ' Contributors',
            maxZoom: 18,
            }).addTo(map);

var marker=new Array(n);
var circle=new Array(n);

for(i=0;i<n;i++)
{
marker[i]= new L.marker([lat[i],lng[i]]).addTo(map)
	.bindPopup(area[i])
	.addTo(map);
circle = L.circle([lat[i],lng[i]],600,{
color: 'red',
fillcolor : '#f00',
fillOpacity : 0.25,
}).addTo(map);
}

var i=0;
var n1=<?php echo $val1; ?>;
var lat1=[<?php echo '"'.implode('","', $latis1).'"' ?>];
var lng1=[<?php echo '"'.implode('","', $longis1).'"' ?>];
var area1=[<?php echo '"'.implode('","', $areas1).'"' ?>];
var marker1=new Array(n);
var circle1=new Array(n);
for(i=0;i<n;i++)
{
marker1[i]= new L.marker([lat1[i],lng1[i]]).addTo(map)
	.bindPopup(area1[i])
	.addTo(map);
circle1 = L.circle([lat1[i],lng1[i]],600,{
color: 'blue',
fillcolor : '#f00',
fillOpacity : 0.25,
}).addTo(map);
}
}

</script>
</head>
<body onload="markArea()">
<div id="map"></div>
<p><a href="https://www.maptiler.com/license/maps/" target="_blank"> &copy;MapTiler</a> <a href=" https://www.openstreetmap.org/copyright" target="_blank"> &copy;OpenStreetMap contributors</a></p>
</form>
</body>
</html>