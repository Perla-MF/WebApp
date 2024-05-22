<?php
$conexion = pg_connect("host=localhost dbname=goodreads user=postgres password=5102");
if (!$conexion) {
    die("Error en la conexión a la base de datos.");
}

$selectedAuthor = $_GET['autor'];
$query = "SELECT * FROM VW_FichaBibliografica WHERE \"Autor\" = '" . pg_escape_string($selectedAuthor) . "' ORDER BY id ASC";
$result = pg_query($conexion, $query);

$tableRows = '';
while ($row = pg_fetch_assoc($result)) {
    $tableRows .= "<tr>";
    $tableRows .= "<td>" . $row['id'] . "</td>";
    $tableRows .= "<td>" . $row['Título'] . "</td>";
    $tableRows .= "<td>" . $row['Año de publicación'] . "</td>";
    $tableRows .= "<td>" . $row['Editorial'] . "</td>";
    $tableRows .= "<td>" . $row['Autor'] . "</td>";
    $tableRows .= "</tr>";
}

pg_free_result($result);
pg_close($conexion);
echo $tableRows;
?>