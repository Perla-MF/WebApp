<?php
$conn = pg_connect("host=localhost dbname=goodreads user=postgres password=5102");
if (!$conn) {
    die("Conexión fallida: " . pg_last_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre"];
    $idUserCrea = $_POST["idUserCrea"];
    $fecha = $_POST["fecha"];

    $sql = "SELECT SP_InsertAuthor('$nombre', $idUserCrea, '$fecha')";
    
    $result = pg_query($conn, $sql);
    if ($result) {
        echo "success";
    } else {
        echo "error";
    }
}

pg_close($conn);
?>
