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
 * @return FALSE if success, else an error code
 *  1 = file already exists, will not clobber
 *  2 = bad base64 encoding
 *  3 = file-put failed
 */
function processImage( $name, $string ) {
  if ( file_exists ( 'uploads/' . $name ) ) {
    return 1;
  }
  # the latter argument forces strict decoding
  $image = base64_decode( $string, TRUE );
  if ( !$image ) {
    return 2;
  }
  if ( file_put_contents( $image, 'uploads/' . $name ) ) {
    return FALSE;
  } else {
    return 3;
  }
}

