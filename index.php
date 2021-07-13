<?php

require_once "Model/Cliente.php";
require_once "Model/Endereco.php";

require_once "Controller/Controller.php";
require_once "Controller/ClienteController.php";
require_once "Controller/HomeController.php";

require_once "Core/Core.php";

session_start();

$core = new Core();
$core->start(array($_GET, $_POST)); 