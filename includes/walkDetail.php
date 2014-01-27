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

if ( !is_numeric( $id ) ) {
  header( 'HTTP/1.1 400 Bad Request' );
  render( 'message', ['Error 400: Bad walk ID', 'The walk ID you requested is invalid.'] );
  die();
}

$query = executeSql( "SELECT * FROM tbl_routes, tbl_places WHERE (tbl_routes.id = $id)" );
if ( is_object( $query ) === FALSE ) {
  render( 'message', ['Database error', 'We were unable to get the details of your walk.', $query] );
  die();
}
if ( $query->num_rows == 0 ) {
  header( 'HTTP/1.1 404 File Not Found' );
  render( 'message', ['Error 404: Walk not found', 'Please check the walk ID and try again.'] );
  die();
}

while ( $walk = $query->fetch_assoc() ) {
  if ( !isset( $body ) ) {
    $body = "";
    $body .= '<h1>' . $walk['title'] . '</h1>';
    $body .= '<p class="lead">' . $walk['longDesc'] . '</p><ol>';
  }
  $body .= '<li>' . $walk['description'] . '</li>';
}
$body .= '</ol>';

render( 'skeleton', $body );

?>
