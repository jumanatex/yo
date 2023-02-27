<?php 
session_start();
require 'admin/config.php';

require_once 'functions.php';

$conexion = conexion($bd_config);

if (!$conexion) {
    header('Location: error.php');
}   

$pagina_actual = (isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1);

$muro_config = array('post_por_pagina' => 3);

$posts = obtener_post($muro_config['post_por_pagina'], $conexion, 'articulos', $pagina_actual);

if (!$posts) {
    header('Location: error.php');
}

if (isset($_SESSION['usuario'])) {
    require 'views/index.view.php';
} else {
    header('Location: login.php');
}
?>
