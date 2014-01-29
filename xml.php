<?php
//code borrowed from Google https://developers.google.com/maps/articles/phpsqlajax_v3
function parseToXML($htmlStr) 
{ 
$xmlStr=str_replace('<','&lt;',$htmlStr); 
$xmlStr=str_replace('>','&gt;',$xmlStr); 
$xmlStr=str_replace('"','&quot;',$xmlStr); 
$xmlStr=str_replace("'",'&#39;',$xmlStr); 
$xmlStr=str_replace("&",'&amp;',$xmlStr); 
return $xmlStr; 
}

$con=mysqli_connect("database","user","pass","database");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

  $query = "SELECT * FROM tbl_places";
  $result = mysqli_query($con, $query);
  if(!$result){
  die('Invalid query: ' . mysql_error());
  }
  $i = 0;
  while( $row = mysqli_fetch_assoc($result)){
  $name[$i] = $row['name'];
  $description[$i] = $row['description'];
  $i = $i + 1;
  }
  
  $query = "SELECT * FROM tbl_images";
  $result = mysqli_query($con, $query);
  if(!$result){
  die('Invalid query: ' . mysql_error());
  }
  $i = 0;
  while( $row = mysqli_fetch_assoc($result)){
  $image[$i] = $row['photoName'];
  $i = $i + 1;
  }
  
  
// Select all the rows in the markers table
$query = "SELECT * FROM tbl_locations";
$result = mysqli_query($con, $query);
if (!$result) {
  die('Invalid query: ' . mysql_error());
}

header("Content-type: text/xml");



// Start XML file, echo parent node
echo '<markers>';

// Iterate through the rows, printing XML nodes for each
$i = 0;
while ($row = mysqli_fetch_assoc($result)){
  // ADD TO XML DOCUMENT NODE
  echo '<marker ';
  echo 'id="' . $row['id'] . '" ';
  echo 'walkId="' . $row['walkId'] . '" ';
  echo 'latitude="' . $row['latitude'] . '" ';
  echo 'longitude="' . $row['longitude'] . '" ';
  echo 'name="' . $name[$i] . '" ';
  echo 'description="' . $description[$i] . '" ';
  echo 'image="' . $image[$i] . '" ';
  echo '/>';
  $i = $i + 1;
}

// End XML file
echo '</markers>';

?>
