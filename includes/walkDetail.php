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

require 'includes/templates.php';
header( 'HTTP/1.1 501 Not Implemented' );
render( 'message', ['Walk details', 'This functionality has not been implemented yet.'] );
?>
