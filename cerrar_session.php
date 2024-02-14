<?php 
session_start();
error_reporting(0);

$validar = $_SESSION["id_usuario"];
if ($validar == null || $validar == '') {
    echo "Usuario no validado";
    die();
}

// Limpiar localStorage al cerrar sesión
echo '<script>
        document.addEventListener("DOMContentLoaded", function () {
            localStorage.clear();
        });
      </script>';

session_destroy();
header("location: index.php");
?>


