<?php
$SERVER = 'localhost';
$username = 'root';
$password = '';
$data_base = 'registro';

$conn = new mysqli($SERVER, $username, $password, $data_base);

if ($conn->connect_error) {
    echo json_encode(array('error' => 'Error en la conexión a la base de datos'));
    exit;
}
$data = json_decode(file_get_contents('php://input'));
 
$tareas= $data->tarea;
  $sql = "DELETE FROM tareas WHERE tarea ='$tareas'";
 if($conn->query($sql) === TRUE){
    echo json_encode(array('mensaje' => 'Tarea eliminada correctamente'));
} else {
    // Error al eliminar la tarea
    echo json_encode(array('error' => 'Error al eliminar la tarea: ' . $conn->error));
}
$conn->close();
 





?>
