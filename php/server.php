<?php
$host = 'g5postgres.postgres.database.azure.com';
$dbname = 'RegistroSesion';
$username = 'adminEspe';
$password = 'Espe2025';

try {
    $conn = pg_connect("host=$host dbname=$dbname user=$username password=$password");
} catch (PDOException $e) {
    echo "Error al conectar: " . $e->getMessage();
}

function registro(){
    global $conn;
    $json = file_get_contents('php://input');
    $data = json_decode($json, true);
    $query="INSERT INTO usuarios (nombres,correo,contraseña) values ('".$data['nombre']."','".$data['correo']."','".$data['contraseña']."')";
    pg_query($conn, $query);
}

function mostrar(){
    global $conn;
    $query = "SELECT * FROM usuarios";
    $result = pg_query($conn, $query);
    $datos = [];
    while ($fila = pg_fetch_assoc($result)) {
        $datos[] = $fila;
    }
    echo json_encode($datos);
    pg_close($conn);
}

if($_SERVER['REQUEST_METHOD']==='POST'){
    switch($_GET['funcion']){
        case 'registro':
            registro();
            break;
        case 'mostrar':
            mostrar();
            break;
    }
}
?>