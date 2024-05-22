<?php
$conn = pg_connect("host=localhost dbname=goodreads user=postgres password=5102");
if (!$conn) {
    die("Conexión fallida: " . pg_last_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $bookId = $_POST["bookId"];

    $sql = "SELECT SP_DeleteBookAndRatings($bookId)";
    
    $result = pg_query($conn, $sql);
    if ($result) {
        echo "Libro eliminado exitosamente.";
    } else {
        $error = pg_last_error($conn);
        if (strpos($error, 'violates foreign key constraint') !== false) {
            echo "Error: Este libro no puede ser eliminado porque hay registros asociados a él.";
        } else {
            echo "Error al eliminar el libro: " . $error;
        }
    }
}
pg_close($conn);
?>