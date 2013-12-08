<?php
/**
 * This is the entry point for the installation wizard for the Walking Tour
 * Displayer.
 *
 * @file
 */

# valid entry point
define( 'ENTRYPOINT', true );

require ( 'includes/templates.php' );

# check if config file has already been created
if ( file_exists( 'config.php' ) ) {
  # disallow access for security reasons
  header( 'HTTP/1.0 403 Forbidden' );
  die( render( 'message', ['Installation unavailable', 'config.php already exists!'] ) );
}

render( 'installer' );
