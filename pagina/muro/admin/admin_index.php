<?php
session_start();

require_once('../admin/config.php');
require_once ('../functions.php');


$conexion = conexion($bd_config);

if (!$conexion) {
    header('Location: ../views/error.php');
    exit();
}

$pagina_actual = pagina_actual();
$posts_por_pagina = $muro_config['post_por_pagina'];
$inicio = ($pagina_actual > 1) ? ($pagina_actual * $posts_por_pagina - $posts_por_pagina) : 0;

$posts = obtener_post($posts_por_pagina, $conexion, 'articulos', $inicio);

require '../admin/vistas/admin_index.view.php';

?>


