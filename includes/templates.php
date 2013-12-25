<?php
/**
 * This file contains helper functions to generate pages from templates.
 *
 * @file
 */

# not a valid entry point
if ( !defined( 'ENTRYPOINT' ) ) {
  render( 'message' , ['Invalid entry point', 'Unable to render.'] );
  exit( 1 );
}

function render ( $templateName, $data = FALSE ) {
  require( "templates/$templateName.php" );
}
