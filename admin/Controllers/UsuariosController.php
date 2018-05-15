<?php 
require_once ('../Models/13bodas.php');

$result = Array();

switch($_POST["accion"]){
	case "getUsuarios":
		$result["Usuarios"] = getUsuarios($db);
		$result["TotalUsuarios"] = count($result["Usuarios"]);
		$result["Success"] = true;
	break;
	case "nuevoUsuario":
		$id = nuevoUsuario($_POST, $db);
		$result["id"] = $id;
		$result["Success"] = (is_numeric($id)) ? true : false;
	break;
	case "editarUsuario":
		$count = editarUsuario($_POST, $db);
		$result["Modificados"] = $count;
		$result["Success"] = (is_numeric($count)) ? true : false;
	break;
	case "eliminarUsuario":
		$result["Success"] = eliminarUsuario($_POST, $db);
	break;
	default:
		$result["Success"] = false;
	break;
}
echo json_encode($result);

function getUsuarios($db){
	$usuarios = $db->get('usuarios');
	return $usuarios;
}

function nuevoUsuario($d, $db){
	//password_verify
	$data = Array (
	    'vcNombres' => $d["vcNombres"],
	    'vcApellidoPaterno' => $d["vcApellidoPaterno"],
	    'vcApellidoMaterno' => $d["vcApellidoMaterno"],
	    'vcPassword' => password_hash($d["vcPassword"], PASSWORD_DEFAULT),
	    'vcTelefono' => $d["vcTelefono"],
	    'vcCorreo' => $d["vcCorreo"],
	    'iPerfil' => $d["iPerfil"]
	);

	$id = $db->insert ('usuarios', $data);
	if($id && $d["iPerfil"] == 2){
		$iEventoId = $db->insert ('eventos', Array(
			'iUsuarioId' => $id
		));
		if($iEventoId){
			$db->where ('iUsuarioId', $id);
			$db->update ('usuarios', Array(
				'iEventoId' => $iEventoId
			));
		}
	}
	return  ($id) ? $id : $db->getLastError();
}

function editarUsuario($d, $db){
	$data = Array (
	    'vcNombres' => $d["vcNombres"],
	    'vcApellidoPaterno' => $d["vcApellidoPaterno"],
	    'vcApellidoMaterno' => $d["vcApellidoMaterno"],
	    'vcTelefono' => $d["vcTelefono"],
	    'vcCorreo' => $d["vcCorreo"]
	);
	$db->where ('iUsuarioId', $d["iUsuarioId"]);

	if ($db->update ('usuarios', $data))
	    return $db->count;
	else
	    return $db->getLastError();
}

function eliminarUsuario($d, $db){
	$db->where('iUsuarioId', $d["iUsuarioId"]);
	if($db->delete('usuarios')) return true;
}

?>
