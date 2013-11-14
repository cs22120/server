<?php
/**
 * The main class for the application.
 */

class WalkingTourCreator {

  /**
   * Renders a file to the end user.
   *
   * @param $templateName string
   * @return void
   */
  public function render( $templateName ) {
    $ROOT = '/home/zuzak/git/group-project/server';
    $page = file_get_contents( "$ROOT/views/$templateName" );
    echo $page;
  }

  /**
   * Starts the process up.
   * @return void
   */
  function run() {
    $this->render("home.html");
  }

}
    
