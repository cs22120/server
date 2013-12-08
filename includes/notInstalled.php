<?php
/**
 * This file is run if no configuration file can be found.
 * It should redirect users to the installation wizard.
 *
 * @file
 */

# set a 301 redirect
header('HTTP/1.1 301 Moved permanently');

# redirect to installation directory
header('Location: ' . $config["baseURL"] . '/install');

?>
