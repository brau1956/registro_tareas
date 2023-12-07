<?php
$SERVER = 'localhost';
$username = 'root';
$password = '';
$database = 'registro';

$conn = new mysqli($SERVER, $username, $password, $database);

if ($conn->connect_error) {
    die("Error en la conexión: " . $conn->connect_error);
}

session_start();
$id_usuario= $_SESSION["id_usuario"];    
$data = json_decode(file_get_contents("php://input"));

if ($data === null) {
    echo "No se recibieron datos válidos en la solicitud.";
} else {
    $date= "SELECT tareas,id_usuario FROM tareas WHERE id_usuario=$id_usuario";
    if (property_exists($data, 'datos')) {
        $dato = trim($data->datos);
                      
        if ($dato !== "") {
            $sql = "INSERT INTO tareas (tarea,id_usuario) VALUES ('$dato',$id_usuario)";
                        
            if ($conn->query($sql)) {
                echo "Los datos se insertaron con éxito";
            } else {
                echo "Error al insertar datos: " . $conn->error;
            }
        } else {
            echo "No pueden existir datos vacíos.";
        }
    } else {
        echo "La propiedad 'datos' no se encontró en los datos recibidos.";
    }
}

$conn->close();
?>
