<?php
$con=mysqli_connect("host","user","pass","db");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

// Create table
$sql="CREATE TABLE tbl_routes(id INT, PRIMARY KEY(id), title VARCHAR(255),
 shortDesc VARCHAR(255), longDesc VARCHAR(1024), hours FLOAT, distance FLOAT)";

// Execute query
if (mysqli_query($con,$sql))
  {
  echo "Table tbl_routes created successfully";
  }
else
  {
  echo "Error creating table: " . mysqli_error($con);
  }
  
// Create table
$sql="CREATE TABLE tbl_locations(id INT, PRIMARY KEY(id), walkID INT, FOREIGN KEY(walkId) REFERENCES tbl_routes(id), latitude FLOAT, 
longitude FLOAT, timestamp FLOAT)";

// Execute query
if (mysqli_query($con,$sql))
  {
  echo "Table tbl_locations created successfully";
  }
else
  {
  echo "Error creating table: " . mysqli_error($con);
  }
  
  // Create table
$sql="CREATE TABLE tbl_places(id INT, PRIMARY KEY(id), locationId INT, FOREIGN KEY(locationId) REFERENCES tbl_locations(id),
description VARCHAR(255))";

// Execute query
if (mysqli_query($con,$sql))
  {
  echo "Table tbl_places created successfully";
  }
else
  {
  echo "Error creating table: " . mysqli_error($con);
  }
  
   // Create table
$sql="CREATE TABLE tbl_images(id INT, PRIMARY KEY(id), placeId INT, FOREIGN KEY(placeId) REFERENCES tbl_places(id),
photoName VARCHAR(255))";

// Execute query
if (mysqli_query($con,$sql))
  {
  echo "Table tbl_images created successfully";
  }
else
  {
  echo "Error creating table: " . mysqli_error($con);
  }
  
?> 
