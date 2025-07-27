
<?php
session_start();


session_unset();
session_destroy();


header('Location: /DAY6/frontend/pages/login.php');
exit();
?>