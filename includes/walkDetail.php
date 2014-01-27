<?php
/**
 * This file generates the detailed per-walk page.
 *
 * @file
 */

# not a valid entry point
if ( !defined( 'ENTRYPOINT' ) ) {
  die( 'Not a valid entry point.' );
}
require_once 'includes/database.php';
require_once 'includes/templates.php';
$id = $_GET['walk'];

if ( !is_numeric($id) ) {
  header('HTTP/1.1 400 Bad Request');
  render('message', ['Error 400: Bad walk ID', 'The walk ID you requested is invalid.']);
  die();
}

$query = executeSql("SELECT * FROM tbl_routes WHERE (id = $id)");
if ( is_object($query) === FALSE ) {
  render('message',['Database error', 'We were unable to get the details of your walk.', $query]);
  die();
}
if ( $query->num_rows == 0 ) {
  header('HTTP/1.1 404 File Not Found');
  render('message', ['Error 404: Walk not found', 'Please check the walk ID and try again.']);
  die();
}
$result = $query->fetch_assoc();
render('walkDetail',$result);

?>
