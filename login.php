<?php
$SERVER = 'localhost';
$username = 'root';
$password = '';
$database = 'registro';

$conn = new mysqli($SERVER, $username, $password, $database);

if ($conn->connect_error) {
    die("Error en la conexión: " . $conn->connect_error);
}
// Obtener datos del cuerpo de la solicitud
$data = json_decode(file_get_contents('php://input'));
// Verificar si se proporcionaron datos válidos
if (!isset($data->correo) || !isset($data->password)) {
    echo json_encode(['estatus' => 0, 'msg' => 'Datos de entrada incompletos']);
    exit;
}
// Limpiar y escapar los datos
$contra = $conn->real_escape_string($data->password);
$correo = $conn->real_escape_string($data->correo);
// Preparar la consulta SQL
$obtener = $conn->prepare("SELECT id_usuario FROM registros WHERE usuario = ? AND contraseña = ?");
$obtener->bind_param('ss', $correo, $contra);
$obtener->execute();
// Obtener el resultado de la consulta
$resultado = $obtener->get_result();
// Obtener los datos como un array asociativo
$data = $resultado->fetch_assoc();

session_start();
$_SESSION["id_usuario"]= $data["id_usuario"];

if ($data) {
    echo json_encode(['estatus' => 1, 'msg' => 'Usuario válido']);
} else {
    echo json_encode(['estatus' => 0, 'msg' => 'Usuario no válido']);
}

// $sql = "SELECT tarea.* FROM tareas INNER JOIN registros ON tareas.id_usuario = registros.id_usuario WHERE registros.id_usuario = {$_SESSION["id_usuario"]}";
// $resul = $mysqli->prepare($sql);


// // $resul->bind_param("i", $id_usuario);

// // Ejecutar la consulta
// $resul->execute();

// // Obtener el resultado
// $result = $resul->get_result();

// // Obtener las filas de resultado
// $rows = $result->fetch_all(MYSQLI_ASSOC);

// // Hacer algo c



$obtener->close();
$conn->close();
?>
