<?php
$conn = pg_connect("host=localhost dbname=goodreads user=postgres password=5102");
if (!$conn) {
    die("Conexión fallida: " . pg_last_error());
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $authorId = $_POST["id"];
    $name = $_POST["nombre"];
    $idUserMod = $_POST["id_usuario"];
    $fechaMod = $_POST["fecha"];
    $sql = "SELECT SP_UpdateAuthor($authorId, '$name', $idUserMod, '$fechaMod')";
    
    $result = pg_query($conn, $sql);
    if ($result) {
        echo "Autor actualizado exitosamente.";
    } else {
        echo "Error al actualizar el autor: " . pg_last_error($conn);
    }
}
pg_close($conn);
?>