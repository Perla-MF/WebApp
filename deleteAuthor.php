<?php
$conn = pg_connect("host=localhost dbname=goodreads user=postgres password=5102");
if (!$conn) {
    die("Conexión fallida: " . pg_last_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $authorId = $_POST["id"];
    $sql = "SELECT SP_DeleteAuthor($authorId)";
    
    $result = pg_query($conn, $sql);
    if ($result) {
        echo "Autor eliminado exitosamente.";
    } else {
        $error = pg_last_error($conn);
        if (strpos($error, 'violates foreign key constraint') !== false) {
            echo "Error: Este autor no puede ser eliminado porque hay libros asociados a él.";
        } else {
            echo "Error al eliminar el autor: " . $error;
        }
    }
}
pg_close($conn);
?>