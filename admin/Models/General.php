<?php
define('ROOT_PATH', getcwd());

require("MysqliDb.php");
require('Upload.php');

$db = new MysqliDb (Array (
                'host' => 'localhost',
                'username' => 'axe_admin', 
                'password' => 'ljc7R3&8',
                'db'=> 'axe',
                'port' => 3306,
                'charset' => 'utf8'));

function valid_session(){
	session_start();
	if(!isset($_SESSION['iUsuarioId'])) {
	    header("Location: login.php");
	}
}

function logOff(){
	session_destroy();
}

function getTerrenos($db){
	$data = $db->get('v_terrenos');
	return $data;
}

function getTerrenos_Galeria($db, $iFTerrenoId){
	$db->where("iFTerrenoId", $iFTerrenoId);
	$data = $db->get('terrenos_galeria');
	return $data;
}

function getAsesores($db){
	$data = $db->get('asesores');
	return $data;
}

function getEstados($db){
	$data = $db->get('estados');
	return $data;
}

function getMunicipios($db, $estado){
	$db->where("clave_estado", $estado);
	$data = $db->get('municipios');
	return $data;
}

function getLocalidades($db, $estado, $municipio){
	$db->where("clave_municipio", $municipio);
	$db->where("clave_estado", $estado);
	$data = $db->get('localidades');
	return $data;
}
