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

if ( $_SERVER['REQUEST_METHOD'] == 'GET' ) {
  # user wants wizard
  render( 'installer' );
} else if ( $_SERVER['REQUEST_METHOD'] != 'POST' ) {
  header( 'HTTP/1.0 405 Method Not Allowed' );
  die( render( 'message', ['HTTP 405: Method Not Allowed', 'Please use POST or GET.'] ) );
} else {
  # installation is a go! (hopefully)
  die( render( 'message', ['Post successful', . var_dump( $_POST )] ) );

  if ( $_POST['createtables'] ) {
    #  user wants the tables to be populated
  }
}
