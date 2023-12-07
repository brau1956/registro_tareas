<?php
define('SERVER', 'localhost');
define('USERNAME', 'root');
define('PASSWORD', '');
define('DATABASE', 'registro');

$conn = new mysqli(SERVER, USERNAME, PASSWORD, DATABASE);

if ($conn->connect_error) {
    echo json_encode(['estatus' => 0, 'msg' => 'Error en la conexión: ' . $conn->connect_error]);
    exit;
}

// Obtener los datos del JSON que provienen del cliente
$data = json_decode(file_get_contents('php://input'));
$correo = $conn->real_escape_string($data->correo); // Evita la inyección de SQL
$contra = $conn->real_escape_string($data->password);

// Consulta SQL con prepared statement
$obtener = $conn->prepare("SELECT id_usuario FROM registros WHERE usuario = ? AND contraseña = ?");
$obtener->bind_param('ss', $correo, $contra);
$obtener->execute();

$resultado = $obtener->get_result();
$data = $resultado->fetch_assoc();

// Asegúrate de iniciar la sesión antes de trabajar con $_SESSION
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($data["id_usuario"])) {
    $_SESSION["id_usuario"] = $data["id_usuario"];
    echo json_encode(['estatus' => 1, 'msg' => 'Usuario válido']);
} else {
    echo json_encode(['estatus' => 0, 'msg' => 'Usuario no válido']);
}

// Cerrar todas las declaraciones y la conexión
$obtener->close();
$conn->close();
?>
