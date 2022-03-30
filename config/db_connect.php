<?php

$db = @mysqli_connect('localhost', 'root', '', 'sprint') or die('Database connection error');
if(!$db) die(mysqli_connect_error());

mysqli_set_charset($db, "utf8") or die('Need to set charset');