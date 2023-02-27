<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@1,600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@1,600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">  
    <link rel="stylesheet" href="<?php echo RUTA; ?>/css/styles.css?v=<?php echo rand(111, 999); ?>">

    <link rel="stylesheet" href="<?php echo RUTA; ?>/css/kiba.css">
        <title>proJiMox</title>
        
        

       
    <body id="headery" > 
       
        <header> 
        
           
            <div class ="contenedor"> 
                <div class="logo izquierda">
                
                <p><a class="pro" href="<?php echo RUTA; ?>">proJiMox</a></p>
                    
                    <?php if (strpos($_SERVER['REQUEST_URI'], 'admin') !== false) {
                     include_once ('../admin/admin_index.php');
                     } ?>



<form class="formul">   
    
            <div id="validaciones" class="encabezado">
                                <p>menu
                                    <i class="fa fa-bars" aria-hidden="true"></i>

                                </p>
            </div>
        <div id="seccion1" class="componentes">
          <a class="ok" href="<?php echo RUTA; ?>/admin/admin_index.php" target="_blank">Perfil</a>
          <a class="ok" href="#">configuracion</a>
          <a class="ok" href="#">blug</a>
          <a class="ok" href="#">fotos</a>
          <a class="ok luz" href="#">fondo col <i class="fa fa-adjust" aria-hidden="true"></i>r </a>
          <a href="cerrar.php" class="ok"  id="exit" class="cerrarsesion">Cerrar Sesion</a> 
        </div> 

</form>

                    
                </div>
                

                <div class="derecha">
                    <form name="busqueda"class="buscar" action="<?php echo RUTA; ?>/buscar.php" method="get">
                    <input type="text" name="busqueda" placeholder="buscar">
                    <button type="submit" class="icono fa fa-search"></button>
                </form>

                <nav class="menu">
                    <ul>
                        <li><a href="https://twitter.com/proJiMox"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="https://www.instagram.com/projimox/"><i class="fa fa-instagram"></i></a></li>
                        <li><a href="https://www.facebook.com/profile.php?id=100089831531854"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="mailto:projimox@gmail.com">Contact<i class="icono fa fa-envelope"></i></a></li>
                    </ul>
                </nav>
                </div>
                


            </div>

    
      
            <script src="java-script/click.js"></script>
            <script src="java-script/code.js"></script>
    </header>     

</body>


