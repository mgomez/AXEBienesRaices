<?php
require_once '../Models/MysqliDb.php';

$db = new MysqliDb (Array (
                'host' => 'localhost',
                'username' => 'axe_admin', 
                'password' => 'ljc7R3&8',
                'db'=> 'axe',
                'port' => 3306,
                'charset' => 'utf8'));

$db->where('vcCorreo', $_POST["vcCorreo"]);

$results = $db->getOne('usuarios');

if ($db->count > 0) {
    $valid = password_verify($_POST["vcPassword"], $results["vcPassword"]);
    if ($valid) {
        session_start();
        $data = array(
            'dtUltimaConexion' => $db->now(),
        );

        $db->where('iUsuarioId', $results["iUsuarioId"]);
        $db->update('usuarios', $data);

        $_SESSION["iUsuarioId"]        = $results["iUsuarioId"];
        $_SESSION["vcNombres"]         = $results["vcNombres"];
        $_SESSION["vcApellidoPaterno"] = $results["vcApellidoPaterno"];
        $_SESSION["vcApellidoMaterno"] = $results["vcApellidoMaterno"];
        $_SESSION["UserName"]          = $results["vcNombres"] . " " . $results["vcApellidoPaterno"] . " " . $results["vcApellidoMaterno"];
        $_SESSION["vcTelefono"]        = $results["vcTelefono"];
        $_SESSION["vcCorreo"]          = $results["vcCorreo"];
        $_SESSION["iPerfil"]           = $results["iPerfil"];
        $_SESSION["dtUltimaConexion"]  = $results["dtUltimaConexion"];
        
        header("Location: ../index.php");
    } else {
        header("Location: ../login.php?err=1");
    }
} else {
    header("Location: ../login.php?err=0");
}
