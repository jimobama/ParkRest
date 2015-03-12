<?php

include_once("all.php");

Session::init();
//This is the main Rest Server that will handle all http request
$server = new HttpRestServer();
$server->Handle();



