<?php
include("db_config.php");
if( isset( $_REQUEST[ 'Submit' ] ) ) {
// Get input
$id = $_REQUEST[ 'id' ];

// Check database
$query  = "SELECT username, description FROM users WHERE id = '$id';";

if (!mysqli_query($con,$query))
{
  die('Error: ' . mysqli_error($con));
}
$result = mysqli_query($con,$query );

// Get results
while( $row = mysqli_fetch_assoc( $result ) ) {
  // Get values
  $first = $row["username"];
  $last  = $row["description"];

  // Feedback for end user
  echo "<pre>ID: {$id}<br />Username: {$first}<br />Description: {$last}</pre>";
}
}

?>
