<?php
/**
 * This file generates the detailed per-walk page.
 *
 * @file
 */

# TODO: this isn't a valid entry point, prevent people loading it in their
# browser
require 'includes/templates.php';
header('HTTP/1.1 501 Not Implemented');
render( 'message', ['Walk details', 'This functionality has not been implemented yet.'] );
?>
