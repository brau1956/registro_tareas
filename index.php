

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" href="src/stylesheet/login.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<style>
body{
    background-color: black;
}
h1{
color: aliceblue;
}
</style>


</head>

<body>

    <h1 class="regi">Registro de Sistema</h1>

    <form id="registros" method="post" action="./login.php">
      
     <input type="text" name="correo" placeholder="Ingresa tu correo" required>
     
     <input type="password" name="password" placeholder="Ingresa tu contraseña" required>

        <div class="centrar">
        <button class="btn1" type="submit">Registrar</button>
        </div>

    </form>
    <div class="login">
<a href="signub.html">si aun no te registras, precina aqui :3</a>
</div>
    <script src="src/js/login.js"></script>
</body>

</html>
