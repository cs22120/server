<!DOCTYPE html>
<head>
</head>
<body>
<?php
$conn = mysql_connect( 'address', 'username', 'password' ) OR die( mysql_error() );
mysql_select_db( 'database', $conn ) OR die( mysql_error() );

$res = mysql_query( $conn, 'SELECT * FROM table' );
echo '<table>';
 echo '<tr>
    <th> Walk </th>
    <th> Description </th>
    </tr>';

 while ( $a = mysql_fetch_row( $res ) )
 {
 echo '<tr>';

 echo '<td>' . $a[2] . '</td>';
 echo '<td>' . '<b>Short Description: </b>' . $a[3] . '<br />' . '<b>Long Description: </b>' . $a[4] . '</td>';

 echo '</tr>';
 }

 echo '</table>';


?>
</body>
