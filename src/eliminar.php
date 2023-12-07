<?php
$SERVER = 'localhost';
$username = 'root';
$password = '';
$data_base = 'registro';

$conn = new mysqli($SERVER, $username, $password, $data_base);

if ($conn->connect_error) {
    echo "Error en la conexión: " . $conn->connect_error;
    exit;
}

// Obtener el ID de la tarea a eliminar desde la solicitud POST
$eliminar = isset($_POST['id']) ? $_POST['id'] : null;

if ($eliminar !== null) {
    $sql = "DELETE FROM tareas WHERE tareaID = '$eliminar'";

    if ($conn->query($sql) === true) {
        echo "Eliminación exitosa";
    } else {
        echo "Error al eliminar: " . $conn->error;
    }
} else {
    echo "ID de tarea no proporcionado";
}

$conn->close();
?>
