<?php
require_once(ROOT_PATH . "/Models/General.php");
$terreno_param = isset($_GET['terreno']) ? $_GET['terreno'] : 0;
$terreno = getTerreno($db, $terreno_param);
?>
