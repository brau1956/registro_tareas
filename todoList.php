
<?php

session_start();
error_reporting(0);

$validar = $_SESSION['id_usuario'];

if ($validar == null || $validar == '') {
    echo "Usuario no validado";
     die();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>lista</title>
    <link rel="stylesheet" href="src/stylesheet/estilo.css">
    <link rel="manifest" href="manifest.json">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<!-- Incluir esta sección en el head de tu archivo index.php -->
<!-- Incluir esta sección en el head de tu archivo index.php -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Verificar si hay un usuario logeado
        var idUsuario = <?php
session_start();
         echo isset($_SESSION["id_usuario"]) ? $_SESSION["id_usuario"] : 'null';  ?>;

        if (idUsuario !== null) {
            // Obtener el JSON de tareas del servidor (asumiendo que es una variable PHP llamada $json_tareas)
            var jsonTareas = <?php echo $json_tareas; ?>;
            
            // Almacenar el JSON en localStorage con la clave única del usuario
            localStorage.setItem('tareas_' + idUsuario, JSON.stringify(jsonTareas));

            // Obtener y trabajar con las tareas del localStorage
            var jsonTareasLocalStorage = localStorage.getItem('tareas_' + idUsuario);
            if (jsonTareasLocalStorage !== null) {
                var tareasLocalStorage = JSON.parse(jsonTareasLocalStorage);
                console.log(tareasLocalStorage);
                // Haz lo que necesites con las tareas del localStorage
            }
        }
    });
</script>


  </head>
<body>
<a href="cerrar_session.php">cerrar session</a>
<h5>bienvenido: <?php echo $_SESSION["id_usuario"]; ?></h5>

    <div class="titulo">
        <h1>lista de agreagados</h1>
    </div>
    
    <div class="centrar" id="data">

        <input type="text" class="clase" id="datos" placeholder="ingresa alguna tarea" name="tareas">
        <button class="estilo" id="btn1" onclick="presionar()" >agregar</button>
    </div>
    <div id="dv" style="text-align: center;  align-items: center;">

    </div>
    <div id="contenedor-lista-tareas">
        <ul id="lista-tareas">
        </ul>
    </div>
    
    <script src="todo.js?v=4"></script>
    
    
    <script>
         
  if ('serviceWorker' in navigator) {
    navigator.serviceWorker.register('./servi_worker.js')
      .then(function(registration) {
        console.log('Service Worker registrado con éxito:', registration);
      })
      .catch(function(error) {
        console.log('Error al registrar el Service Worker:', error);
      });
  }
</script>
    
<script src="./servi_worker.js"></script>


</body>

</html>