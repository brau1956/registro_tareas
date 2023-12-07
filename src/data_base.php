<?php

$SERVER = 'localhost';
$username = 'root';
$password = '';
$data_base = 'registro';

$conn = new mysqli($SERVER, $username, $password, $data_base);

// Verifica la conexión
if ($conn->connect_error) {
    die("Error en la conexión: " . $conn->connect_error);
}

$dat = json_decode(file_get_contents('php://input'));


$correo = $dat->correo;
$contra = $dat->password;
$confi = $dat->confirm_password;

$sql = "SELECT id_usuario FROM registros WHERE usuario='$correo'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "Este correo ya está registrado.";
   
} else {
    $sql = "INSERT INTO registros (usuario, contraseña, confirmar_contraseña) VALUES ('$correo', '$contra', '$confi')";
    if ($conn->query($sql)) {
        echo "Los datos se insertaron con éxito.";
       
    } else {
        echo "Los datos no se insertaron: " . $conn->error;
    }
}


$conn->close();

?>
