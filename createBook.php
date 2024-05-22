<?php
$conn = pg_connect("host=localhost dbname=goodreads user=postgres password=5102");
if (!$conn) {
    die("Conexión fallida: " . pg_last_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titulo = $_POST["titulo"];
    $num_paginas = $_POST["num_paginas"];
    $mes_publicacion = $_POST["mes_publicacion"];
    $dia_publicacion = $_POST["dia_publicacion"];
    $ano_publicacion = $_POST["ano_publicacion"];
    $editorial = $_POST["editorial"];
    $isbn = $_POST["isbn"];
    $idioma = $_POST["idioma"];
    $rating = $_POST["rating"];
    $num_resenas = $_POST["num_resenas"];
    $autor = $_POST["autor"];
    $fecha = $_POST["fecha"];
    $rating_1 = $_POST["rating_1"];
    $rating_2 = $_POST["rating_2"];
    $rating_3 = $_POST["rating_3"];
    $rating_4 = $_POST["rating_4"];
    $rating_5 = $_POST["rating_5"];
    $rating_total = $_POST["rating_total"];
    $sql = "SELECT SP_InsertBookWithRating('$titulo', $num_paginas, $mes_publicacion, $dia_publicacion, $ano_publicacion, '$editorial', '$isbn', '$idioma', $rating, $num_resenas, '$autor', '$fecha', '$rating_1', '$rating_2', '$rating_3', '$rating_4', '$rating_5', '$rating_total')";
    
    $result = pg_query($conn, $sql);
    if ($result) {
        echo "Libro agregado exitosamente.";
    } else {
        echo "Error al agregar el libro: " . pg_last_error($conn);
    }
}

pg_close($conn);
?>