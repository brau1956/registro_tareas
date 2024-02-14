
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

$response = []; // Inicializa el array de respuesta

if ($dat !== null) {
    $correo = isset($dat->correo) ? $dat->correo : null;
    $contra = isset($dat->password) ? $dat->password : null;
    $confi = isset($dat->confirm_password) ? $dat->confirm_password : null;

    $sql = "SELECT id_usuario FROM registros WHERE usuario='$correo'";
    
    $result = $conn->query($sql);

    if ($result) {
        if ($result->num_rows > 0) {
            $response = ['estatus' => 0, 'msg' => 'Este correo ya está registrado.'];
        } else {
            $sql = "INSERT INTO registros (usuario, contraseña, confirmar_contraseña) VALUES ('$correo', '$contra', '$confi')";
            if ($conn->query($sql)) {
                $response = ['estatus' => 1, 'msg' => 'Los datos se insertaron con éxito.'];
                session_start();
                $_SESSION["id_usuario"] = $conn->insert_id;
                header("location: http://localhost/registro_tareas/login1.php");
                exit(); // Es importante salir del script después de redirigir con header
            } else {
                $response = ['estatus' => 0, 'msg' => 'Los datos no se insertaron: ' . $conn->error];
            }
        }
    } else {
        $response = ['estatus' => 0, 'msg' => 'Error en la consulta: ' . $conn->error];
    }

} else {
    $response = ['estatus' => 0, 'msg' => 'Datos del formulario no recibidos correctamente'];
}

echo json_encode($response);

$conn->close();


?>


