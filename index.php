<?php
session_start();
define('CLASSPATH','controllers/');
include(CLASSPATH.'config.local.php');
require_once(CLASSPATH.'mainController.class.php');
require_once(CLASSPATH.'databaseConnection.class.php');
$conn = new DBconnection($pdoconfig);    
$controller = new mainController($conn, $id);
$controller -> handleRequest();
