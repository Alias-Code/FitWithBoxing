<?php

$fwbBDD = new PDO(
    'mysql:host=localhost;
    dbname=fwb',
    'root',
    '',
    array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
    )
);

session_start();

$contenu = "";

require('functions.inc.php');
require('messages.inc.php');

?>