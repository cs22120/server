<?php
/*
 * includes/bootstrap.php
 *
 * This initalises things and gets things rolling.
 *
 */

# set a variable to the working directory for convenience
$ROOT = dirname( __DIR__ );

# load default settings
require_once "$ROOT/includes/defaultSettings.php";

# load custom settings
# require will crash on failure, include merely produces a warning
if ( file_exists( "$ROOT/config.php" ) ) {
  include_once "$ROOT/config.php";
} else {
  # no config means no install
  require_once "$ROOT/includes/notInstalled.php";
}

# load useful files
require_once "$ROOT/includes/localization.php";

# load main class
require_once "$ROOT/includes/walkingTourCreator.php";

?>
