<?php
require("../Models/General.php");

$action = $_REQUEST["action"];
$result = Array();

switch($action){
	case "getAsesores":
		$result["Asesores"] = getAsesores($db);
		$result["Success"] = true;
		break;

	case "getEstados":
		$result["Estados"] = getEstados($db);
		$result["Success"] = true;
		break;

	case "getMunicipios":
		$result["Municipios"] = getMunicipios($db, $_POST["estado"]);
		$result["Success"] = true;
		break;

	case "getLocalidades":
		$result["Localidades"] = getLocalidades($db, $_POST["estado"], $_POST["municipio"]);
		$result["Success"] = true;
		break;
}

echo json_encode($result);
