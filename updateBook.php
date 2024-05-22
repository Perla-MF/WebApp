<?php
$conn = pg_connect("host=localhost dbname=goodreads user=postgres password=5102");
if (!$conn) {
    die("Conexión fallida: " . pg_last_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_libro = $_POST["bookId"];
    $titulo = pg_escape_string($_POST["name"]);
    $num_paginas = $_POST["noPaginas"];
    $mes_publicacion = $_POST["mes_publicacion"];
    $dia_publicacion = $_POST["dia_publicacion"];
    $ano_publicacion = $_POST["ano_publicacion"];
    $editorial = pg_escape_string($_POST["editorial"]);
    $isbn = $_POST["ISBN"];
    $idioma = $_POST["idioma"];
    $rating = $_POST["rating"];
    $num_resenas = $_POST["counts_of_review"];
    $autor = pg_escape_string($_POST["authorName"]);
    $idUser = $_POST["idUser"];
    $fecha = $_POST["fecha"];
    $rating_1 = $_POST["rating1"];
    $rating_2 = $_POST["rating2"];
    $rating_3 = $_POST["rating3"];
    $rating_4 = $_POST["rating4"];
    $rating_5 = $_POST["rating5"];
    $rating_total = $_POST["ratingTotal"];
    
    $sql = "SELECT SP_UpdateBookAndRating(
                $id_libro,
                '$titulo',
                $num_paginas,
                $mes_publicacion,
                $dia_publicacion,
                $ano_publicacion,
                '$editorial',
                '$isbn',
                '$idioma',
                $rating,
                $num_resenas,
                '$autor',
                $idUser,
                '$fecha',
                '$rating_1',
                '$rating_2',
                '$rating_3',
                '$rating_4',
                '$rating_5',
                '$rating_total'
            )";
    
    $result = pg_query($conn, $sql);
    if ($result) {
        echo "Libro actualizado exitosamente.";
    } else {
        echo "Error al actualizar el libro: " . pg_last_error($conn);
    }
}

pg_close($conn);
?>
