<?php
/**
 * This is the main entry point for the website half of Aberystwyth University's
 * 2013-14 Software Engineering Group Project.
 *
 * If you are reading this in a web browser, chances are the server has not been
 * set up correctly to run PHP applications. See http://php.net.
 *
 * -----------------------------------------------------------------------------
 *
 * THE SOFTWARE IS PROVIDED "AS IS" AND THE AUTHORS DISCLAIM ALL WARRANTIES WITH
 * REGARD TO THIS SOFTWARE INCLUDING ALL IMPLIED WARRANTIES OF MERCHANTABILITY
 * AND FITNESS. IN NO EVENT SHALL THE AUTHORS BE LIABLE FOR ANY SPECIAL, DIRECT,
 * INDIRECT, OR CONSEQUENTIAL DAMAGES OR ANY DAMAGES WHATSOEVER RESULTING FROM
 * LOSS OF USE, DATA OR PROFITS, WHETHER IN AN ACTION OF CONTRACT, NEGLIGENCE OR
 * OTHER TORTIOUS ACTION, ARISING OUT OF OR IN CONNECTION WITH THE USE OR
 * PERFORMANCE OF THIS SOFTWARE.
 *
 * @file
 */

require __DIR__ . '/includes/bootstrap.php';
$walkingTourCreator = new WalkingTourCreator();
$walkingTourCreator -> run();

?>
