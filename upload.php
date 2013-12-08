<?php
/**
 * This is the entry point for uploads from the routeing Tour Creator to the
 * Walkinging Tour Displayer.
 *
 * @file
 */

# we are outputting JSON
header( 'Content-type: application/json; charset=utf-8' );
$secret = 'swordfish';

# disallow GETs
if ( $_SERVER['REQUEST_METHOD'] != 'POST' ) {
  header( 'HTTP/1.0 405 Method Not Allowed' );
  output( 2, 'only POST is accepted', true );
}

if ( count( $_POST ) == 0 ) {
  output( 3,  'no POST variables were sent' );
}

if ( !isset( $_POST['data'] ) ) {
  output( 4, 'data was not POSTed correctly' );
}

$json = $_POST['data'];

$data = json_decode( $json );

# check if JSON decode failed
if ( !$data ) {
  if ( json_last_error_msg() ) {
    output( 5, 'malformed JSON (' . json_last_error_msg() . ')' );
  } else {
    output( 5, 'malformed JSON' );
  }
}

# verify authorization
if ( property_exists( $data, 'authorization' ) ) {
  # authorization section exists
  $auth = $data->authorization;
  if ( !property_exists( $auth, 'hash' ) ) {
    output( 7, 'no hash present' );
  }
  if ( !property_exists( $auth, 'salt' ) ) {
    output( 8, 'no salt present' );
  }
  # SHA1 is 40 chars long when expressed in hex
  # this check serves as a quick way to sanity-check
  # whether a string is likely to be a hash or not
  if ( strlen( $auth->hash ) != 40 ) {
    output( 9, 'hash is wrong length' );
  }
  $hash = sha1 ( $secret . $auth->salt );
  if ( $hash != strtolower( $auth->hash ) ) {
    output( 10, 'invalid credentials' );
  }
} else {
  # 401 is not applicable as we are not using authentication
  # headers; see rfc 2616 10.4.2
  output( 6, 'no credentials found' );
}

# check there is actually data
if ( !property_exists( $data, 'walk' ) ) {
  output( 11, 'no route found' );
}

$route = $data->walk;

if ( !property_exists( $route, 'title' ) ) {
  output( 12, 'route has no title' );
}

if ( !property_exists( $route, 'shortDesc' ) ) {
  output( 13, 'route has no subtitle' );
}

if ( !property_exists( $route, 'longDesc' ) ) {
  output( 14, 'route has no description' );
}

if ( !property_exists( $route, 'locations' ) ) {
  output( 15, 'route has no locations' );
}

$index = 0;
foreach ( $route->locations as &$location ) {
  $index++;

  # check that all mandatory properties exist
  if ( !property_exists( $location, 'latitude' ) ) {
    output( 16, "location $index has no latitude" );
  }
  if ( !property_exists( $location, 'longitude' ) ) {
    output( 17, "location $index has no longitude" );
  }
  if ( !property_exists( $location, 'timestamp' ) ) {
    output( 18, "location $index has no timestamp" );
  }
  if ( !property_exists( $location, 'descriptions' ) ) {
    output( 19, "location $index has no descriptions" );
  }
  if ( !property_exists( $location, 'images' ) ) {
    output( 20, "location $index has no images" );
  }

  # sanity check some
  if ( ( $location->latitude > 90 ) || ( $location->latitude < -90 ) ) {
    output( 21, "latitude $index is out of bounds" );
  }
  if ( ( $location->longitude > 180 ) || ( $location->longitude < -180 ) ) {
    output( 22, "longitude $index is out of bounds" );
  }
  if ( !is_numeric( $location->timestamp ) ) {
    output( 23, "cannot parse timestamp $index" );
  }
  if ( !is_array( $location->descriptions ) {
    output( 24, "location $index has bad descriptions" );
  }
  if ( !is_array( $location->images ) {
    output( 25, "location $index has bad images" );
  }
}
output( 0, $data->walk );

function output ( $code, $msg, $suppress = false ) {
  if ( $code == 0 ) {
    $data['success'] = true;
    $data['data'] = $msg;
  } else {
    if ( !$suppress ) {
      header( 'HTTP/1.0 400 Bad Request' );
    }
    $data['success'] = false;
    $data['error']['message'] = $msg;
    $data['error']['code'] = $code;
    $data['data'] = null;
    $data['version'] = '0.0.1';
  }
  die( json_encode( $data, JSON_PRETTY_PRINT ) );
}
