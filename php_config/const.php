<?php
define("P_ROOT", $_SERVER['DOCUMENT_ROOT']);
define("DEFAULT_PAGE", "index");

define("TO", empty($_SESSION['user']['to']['id']) ? false : $_SESSION['user']['to']['id']);
define("AUTHOR", empty($_SESSION['user']['author']['id']) ? false : $_SESSION['user']['author']['id']);