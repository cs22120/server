<?php
/**
 * This file generates the index of stored walks.
 *
 * @file
 */

require_once 'includes/database.php';

$result = executeSql( 'SELECT * from `tbl_routes`' );
if ( $result === FALSE ) {
  # something went wrong
  die( 'Unable to fetch walks from database.' );
}
$rows = "";
while ( $walk = $result->fetch_assoc() ) {
  # TODO: this is horrible, needs fixing
  $rows .= '<tr><td>';
  $rows .= '<a href="?walk=';
  $rows .= $walk['id'];
  $rows .= '">';
  $rows .= $walk['title'];
  $rows .= '</a></td><td>';
  $rows .= $walk['shortDesc'];
  $rows .= '</td></tr>';
}
require( 'includes/templates.php' );
render( 'homepage', $rows );
