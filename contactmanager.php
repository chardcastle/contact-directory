<?php

ini_set("display_errors", "on");
error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);

require_once getcwd()."/ContactDirectory.php";
$directory = new ContactDirectory();