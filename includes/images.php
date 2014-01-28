<?php
/**
 * Image related functions.
 *
 * @file
 */

/**
 * Processes an image.
 *
 * @param The name of the image.
 * @param The base64 string to store.
 * @return FALSE if error, TRUE if success
 */
function processImage( $name, $string ) {
  if ( file_exists ( 'uploads/' . $name ) ) {
    return FALSE;
  }
  # the latter argument forces strict decoding
  $image = base64_decode( $string, TRUE );
  if ( !$image ) {
    return FALSE;
  }
  return file_put_contents( $image, 'uploads/' . $name );
}

