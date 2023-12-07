<?php


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>lista</title>
    <link rel="stylesheet" href="estilo.css">
    <link rel="manifest" href="manifest.json">

</head>
<body>
    <div class="titulo">
        <h1>lista de agreagados</h1>
    </div>
    
    <div class="centrar" id="data">

        <input type="text" class="clase" id="datos" placeholder="ingresa alguna tarea" name="tareas">
        <button class="estilo" id="btn1" onclick="presionar()">agrega</button>
    </div>
    <div id="dv" style="text-align: center;  align-items: center;">

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