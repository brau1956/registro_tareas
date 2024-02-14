<?php
$SERVER = 'localhost';
$username = 'root';
$password = '';
$database = 'registro';

$conn = new mysqli($SERVER, $username, $password, $database);
if ($conn->connect_error) {
    die("Error en la conexión: " . $conn->connect_error);
}


// Verificar si la clave de sesión está definida
// if (!isset($_SESSION['id_usuario'])) {
//     echo "La clave de sesión 'id_usuario' no está definida.";
//     exit();
// }
session_start();

$id_usuario = $_SESSION["id_usuario"];
$sql = "SELECT * FROM tareas WHERE id_usuario = $id_usuario";
$result = mysqli_query($conn, $sql) or die('Consulta fallida: ' . mysqli_error($conn));

// Inicializar un array para almacenar las tareas
$tareas = array();

// Verificar si hay resultados
if (mysqli_num_rows($result) > 0) {
    // Iterar sobre los resultados y agregarlos al array de tareas
    while ($row = mysqli_fetch_assoc($result)) {
        $tareas[] = $row;
    }

 echo json_encode($tareas);


} else {
 echo "No hay tareas para el usuario actual.";
}

?>
