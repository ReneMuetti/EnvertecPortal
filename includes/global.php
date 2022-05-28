<?php

define('DS', DIRECTORY_SEPARATOR);
define('PS', PATH_SEPARATOR);


include_once realpath('.' . DS . 'includes' . DS . 'config.php');
include_once realpath('.' . DS . 'includes' . DS . 'functions' . DS . 'coreFunktions.php');
include_once realpath('.' . DS . 'includes' . DS . 'classes' . DS . 'Portal' . DS . 'Autoload.php');

Portal_Autoload::register();
Portal::app();