<?php
/**
 * This is the entry point for uploads from the Walking Tour
 * creator.
 *
 * It validates whether a request is valid.
 *
 * @file
 */

# we are outputting JSON; change away from defaults
# some browsers will render JSON differently from plain
# text (e.g. render it monospace; preserving new-lines)
header( 'Content-type: application/json; charset=utf-8' );

# this secret is used when verifying hashes as a rudimentary
# authentication system
# TODO: pull this in from a site-wide configuration
$secret = 'swordfish';

# as the output() function always forces the script to stop
# via die(), we can use successive if() statements without
# needing else and elseif

# disallow GETs
if ( $_SERVER['REQUEST_METHOD'] != 'POST' ) {
  header( 'HTTP/1.0 405 Method Not Allowed' );
  output( 2, 'only POST is accepted; received ' . $_SERVER['REQUEST_METHOD'], true );
}

# catch empty POST requests
if ( count( $_POST ) == 0 ) {
  output( 3,  'no POST variables were sent' );
}

# POST needs a to send its data within key-value pairs
# although we aren't using them, we still need one to
# send the JSON body; 'data' has been arbitrarily chosen
if ( !isset( $_POST['data'] ) ) {
  output( 4, 'data was not POSTed correctly' );
}

# attempt to convert the JSON into an object
$json = $_POST['data'];
$data = json_decode( $json );

# check if JSON decode failed; PHP does this by returning
# null on failure, and then has another function to see
# what the error was
if ( !$data ) {
  if ( json_last_error_msg() ) {
    output( 5, 'malformed JSON (' . json_last_error_msg() . ')' );
  } else {
    # fall-through in case PHP couldn't find an error
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
  # hashing is case sensitive; as PHP returns lowercase
  # we need to ensure the user's hash is also lowercase
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
  # the word 'route' is used as there is less ambiguity than
  # 'walk' which is a deverbal noun; however documentation
  # already uses 'walk' in the JSON schema
  output( 11, 'no route found' );
}

$route = $data->walk;

# we are enforcing that no properties are optional
# this does not check whether the properties contain anything
# and instead checks merely whether they exist.
#
# This still allows a client to, for example, not send any
# images, but ensures that the client does so in an
# unambigious fashion

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
  # Latitude is drawn from the equator (0) to the poles at 90 and -90.
  if ( ( $location->latitude > 90 ) || ( $location->latitude < -90 ) ) {
    output( 21, "latitude $index is out of bounds" );
  }
  # longitude is east-west, and is therefore 0 (Greenwich) to
  # +-180, which are equivalent.
  # TODO: this implementation will not accept exactly 180
  if ( ( $location->longitude > 180 ) || ( $location->longitude < -180 ) ) {
    output( 22, "longitude $index is out of bounds" );
  }
  if ( !is_numeric( $location->timestamp ) ) {
    output( 23, "cannot parse timestamp $index" );
  }
  if ( !is_array( $location->descriptions ) ) {
    output( 24, "location $index has bad descriptions" );
  }
  if ( !is_array( $location->images ) ) {
    output( 25, "location $index has bad images" );
  }
}

# all tests passed; output the data as confirmation
output( 0, $data->walk );

function output ( $code, $msg, $suppress = false ) {
  if ( $code == 0 ) { # 0 means a success
    $data['success'] = true;
    # assume that there is no message, as a success is
    # fairly self-explanatory
    $data['data'] = $msg;
  } else {
    # 400 is a sensible default, but some errors may
    # override this; this flag suppresses the function
    # from overwriting the previous header
    if ( !$suppress ) {
      header( 'HTTP/1.0 400 Bad Request' );
    }
    $data['success'] = false;
    $data['error']['message'] = $msg;
    $data['error']['code'] = $code;
    $data['data'] = null;
  }
  # sending current API version will aid troubleshooting
  $data['version'] = '0.1.0';
  die( json_encode( $data, JSON_PRETTY_PRINT ) );
}
