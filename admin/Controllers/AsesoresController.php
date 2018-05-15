<?php
require("../Models/General.php");

$action = $_REQUEST["action"];
$result = Array();

switch($action){
    case "getAsesores":
        $result["Asesores"] = getAsesores($db);
        $result["Success"] = true;
        break;

    case "setAsesores":
        $result["Asesor"] = setAsesor($db, $_POST, $_FILES);
        $result["Success"] = true;
        break;

    case "eliminarAsesor":
        $result["Asesor"] = eliminarAsesor($db, $_POST);
        $result["Success"] = true;
        break;
}

echo json_encode($result);

function setAsesor($db, $data, $file){
    $vcPath = Upload("../Files", $file);
    if ($vcPath) {
        $vcPath = "Files/" . $vcPath;
        $data   = array(
            'vcFoto'        => $vcPath,
            'vcNombre' => $data["vcNombre"],
            'vcTelefono' => $data["vcTelefono"]
        );

        $id = $db->insert('asesores', $data);
        return ($id) ? $id : $db->getLastError();
    } else {
        return false;
    }
}

function eliminarAsesor($db, $data){
    $db->where('iAsesorId', $data["iAsesorId"]);
    $data = $db->getOne('asesores');
    if($db->delete('asesores')){
        unlink("../".$data["vcFoto"]);
        return true;    
    }else{
        return false;   
    }
}
