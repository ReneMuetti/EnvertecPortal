<?php

define('DS', DIRECTORY_SEPARATOR);
define('PS', PATH_SEPARATOR);


include_once "functions" . DS . "coreFunktions.php";
include_once "classes" . DS . "Portal" . DS . "Autoload.php";

Portal_Autoload::register();
Portal::app();