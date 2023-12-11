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
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $eliminar = $_POST["tareas"];

    $sql_select = "SELECT tareaID FROM tareas WHERE tareaID = $eliminar";

    $resultado = $conn->query($sql_select);

    if ($resultado->num_rows > 0) {
        $sql_delete = "DELETE FROM tareas WHERE tareaID = $eliminar";

        if ($conn->query($sql_delete) === TRUE) {
            echo "Tarea eliminada correctamente.";
        } else {
            echo "Error al eliminar la tarea: " . $conn->error;
        }
    } else {
        echo "La tarea con el ID $eliminar no existe.";
    }
} else {
    echo "La solicitud no es de tipo POST. Los elementos no se eliminaron.";
}

?>
