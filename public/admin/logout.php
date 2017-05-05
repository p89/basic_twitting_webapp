<html>
<head>
    <link rel="stylesheet" type="text/css" href="../../css/style.css">
</head>
</html>
<?php
require_once('../bootstrap.php');
$_SESSION['logged'] = false;
session_unset();
echo '<br><br><br><div align="center"><h1>Wylogowano poprawnie.</h1></div>';
header( "refresh:1;url=../index.php");
?>

