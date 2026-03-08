<?php
// Redirect to main site
session_start();
session_destroy();
session_unset();

header("Location: Login.php");
exit;
?>
