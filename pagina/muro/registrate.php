<?php 
session_start();
if (isset($_SESSION['usuario'])) {
    header('Location: index.php');
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario = strtolower(htmlspecialchars($_POST['usuario'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8', true));
    $password = $_POST['password'];
    $password2 = $_POST['password2'];

  
    $errores = '';

    if (empty($usuario) or empty($password) or empty($password2)) {
        $errores .= '<li>Porfavor rellena todos los datos correctamente</li>';
    } else {
      try {
        $conexion = new PDO('mysql:host=localhost;dbname=login','jumanates', 'b3e9449d1');
      } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
      }
     $statement = $conexion->prepare('SELECT * FROM usuarios WHERE usuario = :usuario LIMIT 1');
     $statement->execute(array(':usuario' => $usuario));
     $resultado = $statement->fetch();

     if ($resultado != false) {
        $errores .= 'El nombre de usuario ya existe';
     }


     $password = hash('sha512', $password);
     $password2 = hash('sha512', $password2);
     
     if ($password != $password2) {
        $errores .= '<li>Las contraseñas no son iguales</li>';
     }

    }
    if ($errores =='') {
        $statement = $conexion->prepare('INSERT INTO usuarios (id, usuario, pass) VALUES (NULL,:usuarios,:pass)');
        $statement->execute(array(
            ':usuarios' => $usuario, 
            ':pass' => $password
        ));

        header('Location: login.php');
    }

}


require 'views/registrate.view.php';

?>