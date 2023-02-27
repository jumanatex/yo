<?php 
session_start();
require 'config.php';
require '../functions.php';

comprobarSession();



$conexion = conexion($bd_config);

if (!$conexion){
    header('Location: views/error.php');
    exit;
}



// Comprobamos si los datos han sido enviados
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$titulo = limpiarDatos($_POST['titulo']);
	$extracto = limpiarDatos($_POST['extracto']);
	// Con la funcion nl2br podemos transformar los saltos de linea en etiquetas <br>
	$texto = $_POST['texto'];
	$thumb = $_FILES['thumb'];

if ($thumb['error'] === UPLOAD_ERR_OK) {
    $temp_path = $thumb['tmp_name'];
    $file_name = basename($thumb['name']);
    $upload_dir = "uploads/";
    $target_path = $upload_dir . $file_name;

    if (move_uploaded_file($temp_path, $target_path)) {
        // El archivo se cargó correctamente
    } else {
        $errores['thumb'] = "Error al subir la imagen. Verifique que el archivo no supere el tamaño máximo permitido.";
    }
} else {
    $errores['thumb'] = "Error al subir la imagen. Verifique que el archivo no supere el tamaño máximo permitido.";
}



    $tipo_archivo = "*";

    if (empty($titulo)) {
        $errores['titulo'] = "El título no puede estar vacío";
    }

    if (empty($extracto)) {
        $errores['extracto'] = "El extracto no puede estar vacío";
    }

    if (empty($texto)) {
        $errores['texto'] = "El texto no puede estar vacío";
    }

 
        $tipos_permitidos = array("jpg", "jpeg", "png", "gif", "mp4");
        $partes_nombre_archivo = explode(".", $thumb['name']);
        $extension = strtolower(end($partes_nombre_archivo));

        if (!in_array($extension, $tipos_permitidos)) {
            // El archivo no es permitido, no se puede subir
            $errores['thumb'] = "El tipo de archivo no es permitido";
        }
    

    $ruta_carpeta_imagenes = $_SERVER['DOCUMENT_ROOT'] . $muro_config['carpeta_imagenes']['ruta'];

	$archivo_subido = '../' . $blog_config['carpeta_imagenes'] . $_FILES['thumb']['name'];

    if (empty($errores)) {
        $archivo_subido = $ruta_carpeta_imagenes . $thumb['name'];
        move_uploaded_file($_FILES['thumb']['tmp_name'], $ruta_carpeta_imagenes . $nombre_carpeta_imagenes . $thumb['name']);

        $statement = $conexion->prepare(
            'INSERT INTO articulos (id, titulo, extracto, texto, thumb)
            VALUES (null, :titulo, :extracto, :texto, :thumb)'
        );
		$statement->execute(array(
			':titulo' => $titulo,
			':extracto' => $extracto,
			':texto' => $texto,
			':thumb' => $_FILES['thumb']['name']
		));
	
		header('Location: '. RUTA . '/admin');

      
    }

    require '../views/nuevo.view.php';
}