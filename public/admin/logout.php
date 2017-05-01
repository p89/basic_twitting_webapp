<?php
require_once('../bootstrap.php');
$_SESSION['logged'] = false;
echo '<div align="center"><h1>Logged out.</h1></div>';
header( "refresh:1;url=../index.php");

?>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
</html>
