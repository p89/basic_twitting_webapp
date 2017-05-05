<?php
require_once ('../autoload.php');
SessionChecker::checkSession();
Tweet::writeAllTweets($connection);




