<?php
include_once("all.php");


//This is the main Rest Server that will handle all http request
$server = new HttpRestServer();
$server->Handle();



