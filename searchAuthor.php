<?php
$conexion = pg_connect("host=localhost dbname=goodreads user=postgres password=5102");
if (!$conexion) {
    die("Error en la conexión a la base de datos.");
}
$query_autores = "SELECT id, \"Name\" FROM Author ORDER BY id ASC";
$result_autores = pg_query($conexion, $query_autores);
$autores = pg_fetch_all($result_autores);
echo json_encode($autores);
?>
