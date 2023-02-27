<?php
session_start();

if (isset($_SESSION['usuario'])) {
    header('Location: contenido.php');
    exit();
} else {
    header('Location: registrate.php');
    exit();
}

require 'functions.php';
require '../admin/config.php';

$conexion = conexion($bd_config);

if (!$conexion) {
    header('Location: ../views/error.php');
    exit();
}

$pagina_actual = pagina_actual();
$posts_por_pagina = $muro_config['post_por_pagina'];
$inicio = ($pagina_actual > 1) ? ($pagina_actual * $posts_por_pagina - $posts_por_pagina) : 0;

$posts = obtener_post($posts_por_pagina, $conexion, 'articulos', $inicio);

if (!$posts) {
    header('Location: ../views/error.php');
    exit();
}

require '../views/index.view.php';
