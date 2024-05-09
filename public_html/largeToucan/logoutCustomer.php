<!-- code from alex. this stresses me out if i hadn't put so many hours into this already i'd make it work in the userpage file -->
<?php session_start();
 
// Unset all of the session variables
$_SESSION = array();
 
// Destroy the session.
session_destroy();
 
// Redirect to login page
header("location: loginCustomer.php");
exit; ?>