<?php require_once( 'templates/header.php' ); ?>
<h1><?php echo $data['title']; ?></h1>
<p class="lead"><?php echo $data['longDesc']; ?></p>
<div id="map" onload="load();"></div>
<?php require_once( 'templates/footer.php' ); ?>
