<?php
require_once(ROOT_PATH . "/Models/General.php");

$terrenos = getTerrenos($db);
$direccion = isset($_GET['direccion']) ? $_GET['direccion'] :  "";
?>
