<?php session_start();

if (isset($_SESSION['usuario'])) {
    header('Location: index.php');
}
$errores = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario = strtolower(htmlspecialchars($_POST['usuario'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8', true));
    $password = $_POST['password'];
    $password = hash('sha512', $password);

   try {
    $conexion = new PDO('mysql:host=localhost;dbname=login','jumanates', 'b3e9449d1');
   } catch (PDOException $e) {
       echo "Error:" . $e->getMessage();;
   }

   $statement = $conexion->prepare('
   SELECT * FROM usuarios WHERE usuario = :usuario AND pass = :password'
);

$statement->execute(array(
    ':usuario' => $usuario,
    ':password' => $password
));

$resultado = $statement->fetch();

if ($resultado !== false) {
    $_SESSION['usuario'] = $usuario;
    header('Location: index.php');  
} else {
    $errores .= '<li>Datos Incorrectos</li>';
}

}

require 'views/login.view.php';
require 'muro/config.php';
?>