<?php
require("_Ajax.comun.php");
session_start();

$id = $_REQUEST['ruta'];

$enlace = DIR_FACTELEC . 'Include/Clases/Formulario/Plugins/reloj/' . $id;

header ("Content-Disposition: attachment; filename=".$id." ");
header ("Content-Type: application/octet-stream");
header ("Content-Length: ".filesize($enlace));
readfile($enlace);

?>
