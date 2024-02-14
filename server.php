<?php
$SERVER = 'localhost';
$username = 'root';
$password = '';
$database = 'registro';

$conn = new mysqli($SERVER, $username, $password, $database);
if ($conn->connect_error) {
    die("Error en la conexión: " . $conn->connect_error);
}

// Decodificar los datos JSON enviados desde el cliente
$data = json_decode(file_get_contents('php://input'));

// Verificar si la sesión está iniciada
session_start();

// Obtener el id del usuario de la sesión
$id_usuario = $_SESSION["id_usuario"];

// Verificar si la variable $data->datos está definida
if (isset($data->datos)) {
    $tarea = $data->datos;

    // Insertar la nueva tarea en la base de datos
    $sql = "INSERT INTO tareas (tarea, id_usuario) VALUES ('$tarea', $id_usuario)";
    
    if ($conn->query($sql)) {
       // echo "Los datos se insertaron con éxito";
    } else {
       /// echo "Los datos no se insertaron con éxito";
    }
}

// Obtener todas las tareas del usuario después de la inserción
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
}

// Añadir el id del usuario al JSON
$tareas_con_id_usuario = array('id_usuario' => $id_usuario, 'tareas' => $tareas);

// Convertir el array a formato JSON y enviarlo al cliente
echo json_encode($tareas_con_id_usuario);

?>
