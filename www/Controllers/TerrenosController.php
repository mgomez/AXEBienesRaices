<?php
header("Access-Control-Allow-Origin: *");
require("../Models/General.php");

$action = $_REQUEST["action"];
$result = Array();

switch($action){
	case "getTerrenos":
		$result["Terrenos"] = getTerrenos($db);		
		$result["Success"] = true;
		break;

	case "getTerrenos_Galeria":
		$result["Terrenos_Galeria"] = getTerrenos_Galeria($db, $_POST["iFTerrenoId"]);
		break;

	case "getNuevoTerreno":
		$result["Asesores"] = getAsesores($db);
		$result["Estados"] = getEstados($db);
		$result["Success"] = true;
		break;

	case "setTerreno":
		$result["Terreno"] = setTerreno($db, $_POST);
		$result["Success"] = true;
		break;

	case "updateTerreno":
		$result["Terreno"] = updateTerreno($db, $_POST);
		$result["Success"] = true;
		break;

	case "deleteTerreno":
		$result["Terreno"] = deleteTerreno($db, $_POST);
		$result["Success"] = $result["Terreno"];
		break;

	case "nuevoSupersizedImage":
        $id                = nuevoSupersizedImage($_POST, $db, $_FILES);
        $result["id"]      = $id;
        $result["Success"] = (is_numeric($id)) ? true : false;
        break;
}

echo json_encode($result);

function setTerreno($db, $data){
    $data   = array(
		"vcTitulo"                 => $data["vcTitulo"],
		"vcDescripcion"            => $data["vcDescripcion"],
		"decPrecio"                => $data["decPrecio"],
		"vcNumeroInventario"       => $data["vcNumeroInventario"],
		"iFEstado"                 => $data["iFEstado"],
		"iFMunicipio"              => $data["iFMunicipio"],
		"iFLocalidad"              => $data["iFLocalidad"],
		"vcDireccion"              => $data["vcDireccion"],
		"iFAsesor"                 => $data["iFAsesor"],
		"iActivo"                  => $data["iActivo"],
		"vcSuperficieTerreno"      => $data["vcSuperficieTerreno"],
		"vcSuperficieConstruccion" => $data["vcSuperficieConstruccion"],
		"vcFrente"                 => $data["vcFrente"],
		"vcOperacion"              => $data["vcOperacion"],
		"iFTipo"                   => $data["iFTipo"],
		"vcFondo"                  => $data["vcFondo"]
    );

	$id = $db->insert('terrenos', $data);
	return ($id) ? $id : $db->getLastError();
}

function updateTerreno($db, $data){
		$update                    = array(
		"vcTitulo"                 => $data["vcTitulo"],
		"vcDescripcion"            => $data["vcDescripcion"],
		"decPrecio"                => $data["decPrecio"],
		"vcNumeroInventario"       => $data["vcNumeroInventario"],
		"iFEstado"                 => $data["iFEstado"],
		"iFMunicipio"              => $data["iFMunicipio"],
		"iFLocalidad"              => $data["iFLocalidad"],
		"vcDireccion"              => $data["vcDireccion"],
		"iFAsesor"                 => $data["iFAsesor"],
		"iActivo"                  => $data["iActivo"],
		"vcSuperficieTerreno"      => $data["vcSuperficieTerreno"],
		"vcSuperficieConstruccion" => $data["vcSuperficieConstruccion"],
		"vcFrente"                 => $data["vcFrente"],
		"vcOperacion"              => $data["vcOperacion"],
		"iFTipo"                   => $data["iFTipo"],
		"vcFondo"                  => $data["vcFondo"]
    );

    $db->where('iTerrenoId', $data["iTerrenoId"]);

    if ($db->update('terrenos', $update)) {
        return $db->count;
    } else {
        return $db->getLastError();
    }
}

function nuevoSupersizedImage($d, $db, $file){
    $vcPath = Upload("../img/terrenos", $file);
    if ($vcPath) {
        $vcPath = "img/terrenos/" . $vcPath;
        $data   = array(
            'vcPath'        => $vcPath,
            'iFTerrenoId' => $d["iFTerrenoId"]
        );

        $id = $db->insert('terrenos_galeria', $data);
        return ($id) ? $id : $db->getLastError();
    } else {
        return false;
    }
}

function deleteTerreno($db, $data){
	$db->where('iTerrenoGaleriaId', $data["iTerrenoGaleriaId"]);
	if($db->delete('terrenos_galeria')){
		return true;	
	}else{
		return false;	
	}
}
