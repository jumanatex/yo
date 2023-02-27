<?php 
session_start();
require 'admin/config.php';
require 'functions.php';

$conexion = conexion($bd_config);

if (!$conexion) {
    header('Location: views/error.php');
}

$errores = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $titulo = limpiarDatos($_POST['titulo']);
    $extracto = limpiarDatos($_POST['extracto']);
    $texto = limpiarDatos($_POST['texto']);
    $thumb = $_FILES['thumb']['tmp_name'];

    if (empty($titulo)) {
        $errores['titulo'] = "El título no puede estar vacío";
    }

    if (empty($extracto)) {
        $errores['extracto'] = "El extracto no puede estar vacío";
    }

    if ($_FILES['thumb']['error'] === 4) {
        $errores['thumb'] = "Debes subir una imagen";
    } else {
        $tipos_permitidos = ["jpg", "jpeg", "png", "gif"];
        $partes_nombre_archivo = explode(".", $_FILES['thumb']['name']);
        $extension = end($partes_nombre_archivo);
        
        if (!in_array($extension, $tipos_permitidos)) {
            $errores['thumb'] = "El tipo de archivo no es permitido";
        }
    }

    if (empty($errores)) {
        $ruta_carpeta_imagenes = $_SERVER['DOCUMENT_ROOT'] . $muro_config['carpeta_imagenes']['ruta'];
        $nombre_carpeta_imagenes = $muro_config['carpeta_imagenes']['nombre'];
        $archivo_subido = $ruta_carpeta_imagenes . '/' . $_FILES['thumb']['name'];
        move_uploaded_file($thumb, $archivo_subido);
        
        $statement = $conexion->prepare(
            'INSERT INTO articulos (id, titulo, extracto, texto, thumb) VALUES (null, :titulo, :extracto, :texto, :thumb)'
        );

        $statement->execute(array(
            ':titulo' => $titulo,
            ':extracto' => $extracto,
            ':texto' => $texto,
            ':thumb' => $_FILES['thumb']['name']  
        ));

        header('Location: '. RUTA . '/admin');
    }
}

require 'views/nuevo.view.php';
?>
