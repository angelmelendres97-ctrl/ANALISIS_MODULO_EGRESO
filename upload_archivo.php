<?php
include_once('../../Include/config.inc.php');

try{
	session_start();

	unset($_SESSION["archivos"]);
	
	if(count($_FILES) > 0){

		$target_dir = path(DIR_INCLUDE).'Clases/Formulario/Plugins/reloj/';
		$carpeta=$target_dir;
	
		if (!file_exists($carpeta)) {
				mkdir($carpeta, 0777, true);
		}

		$uploadOk = 0;
		$errorCount = 0;
	
		for($i=0;$i<count($_FILES);$i++){
	
			$nombre_archivo = $_FILES[$i]["name"];
		
			$target_file = $carpeta . basename($_FILES[$i]["name"]);
		
			$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
	
			if (file_exists($target_file)) {
				$errors[$errorCount] = "Archivo ".$nombre_archivo. " no subido, ya existe.";
				$errorCount++; 
			}else{				
				if ($_FILES[$i]["size"] > 2097152) {
					$errors[$errorCount] = "Lo sentimos, el archivo ".$nombre_archivo. " es demasiado grande.  Tamaño máximo admitido: 2MB";
					$errorCount++; 
				}else{
					if($imageFileType != "xl") {

						if (move_uploaded_file($_FILES[$i]["tmp_name"], $target_file)) {

							$messages[$uploadOk]= "El archivo ".$nombre_archivo. " ha sido subido correctamente.";
							$archivos[$uploadOk]= $nombre_archivo;

							$uploadOk++; 
						} else {
							$errors[$errorCount] = "Lo sentimos, hubo un error subiendo el archivo ".$nombre_archivo. ".";
							$errorCount++; 
						}
					}else{
						$errors[$errorCount] = "El archivo ".$nombre_archivo. " no es permitido, solo puede subir archivos en los siguientes formatos: PDF, PNG, JPG, JPEG";
						$errorCount++; 
					}
				}
			} 
		}

		if (isset($errors)){

			?>
			<table class="table table-condensed table-striped table-bordered table-hover" style="width: 98%;">
							<thead><tr style="background-color:red; color:white">
							<td colspan="2" style="bg-red">Reporte de archivos con errores</td>
							</tr>
							<tr>
							<td>No.</td>
							<td>Error</td>
							</tr></thead><tbody>
			<?php
				for($j=0;$j<=count($errors);$j++){
					if(!empty($errors[$j])){
						?>
						<tr>
							<td><?php echo $j+1?></td>
							<td><?php echo $errors[$j]?></td>
						</tr>
						<?php
					}
				}
			?>
			</tbody></table>
			<?php
		}
	
		if (isset($messages)){

			?>
			<table class="table table-condensed table-striped table-bordered table-hover" style="width: 98%;">
							<thead><tr style="background-color:green; color:white">
							<td colspan="2" style="bg-green">Reporte de archivos subidos</td>
							</tr>
							<tr>
							<td>No.</td>
							<td>Mensaje</td>
							</tr></thead><tbody>
			<?php
				for($j=0;$j<=count($messages);$j++){
					if(!empty($messages[$j])){
						?>
						<tr>
							<td><?php echo $j+1?></td>
							<td><?php echo $messages[$j]?></td>
						</tr>
						<?php
					}
				}
			?>
			</tbody></table>
			<?php
		}

		if (isset($archivos)){

			$_SESSION["archivos"] = $archivos;

			?>
				<script>
					guardarAjuntospg()
				</script>
			<?php
		}

	}
} catch (Exception $e) {
	return $e;
}

?>