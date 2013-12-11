<?php
/**
 * This file contains database related functions.
 *
 * @file
 */

require dirname( __FILE__ ) . '/../config.php';
function createDatabase() {
  $db = openConnection();

  $sql = "" .
" CREATE TABLE tbl_routes (" .
"   id int NOT NULL, title varchar(255), shortDesc varchar(255), longDesc varchar(255)," .
"   hours float(12), distance float(12), PRIMARY KEY (id));" .
" CREATE TABLE tbl_locations (" .
"    id int NOT NULL, walkId int NOT NULL, latitude float(12), longitude float(12), timestamp float(12)," .
"    PRIMARY KEY (id), FOREIGN KEY (WalkId) REFERENCES tbl_routes(id));" .
"  CREATE TABLE tbl_places (" .
"    id int NOT NULL, locationId int NOT NULL, description varchar(255)," .
"    PRIMARY KEY (id), FOREIGN KEY (locationId) REFERENCES tbl_locations(id));" .
" CREATE TABLE tbl_images (" .
"   id int NOT NULL, placeId int NOT NULL, photoName varchar(255)," .
"   PRIMARY KEY (id), FOREIGN KEY (placeId) REFERENCES tbl_places(id));";




  $query = mysqli_query ( $db, $sql );
  closeDatabase( $db );
  echo $query;
  return $query;
}

function openConnection() {
  global $DB_ADDR, $DB_USER, $DB_PASS, $DB_NAME;
  $db = mysqli_connect( $DB_ADDR, $DB_USER, $DB_PASS, $DB_NAME );
  if ( !$db ) {
    # connection failed
    die( 'Could not connect to MySQL' );
  }
  return $db;
}

function closeDatabase( $db ) {
  mysqli_close( $db );
}


