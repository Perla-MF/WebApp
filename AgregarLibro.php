<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Agregar Libros</title>
  <link rel="stylesheet" href="stylesAddBook.css">
</head>
<body>
  <div class="container">
    <h1>Agregar Libros</h1>
    <form action="createBook.php" method="post">
      <div class="form-column">
        <label for="titulo">Título:</label>
        <input type="text" id="titulo" name="titulo">
        <label for="num_paginas">No. Páginas:</label>
        <input type="text" id="num_paginas" name="num_paginas">
        <label for="mes_publicacion">Mes de publicación:</label>
        <input type="text" id="mes_publicacion" name="mes_publicacion">
        <label for="dia_publicacion">Día de publicación:</label>
        <input type="text" id="dia_publicacion" name="dia_publicacion">
        <label for="ano_publicacion">Año de publicación:</label>
        <input type="text" id="ano_publicacion" name="ano_publicacion">
        <label for="editorial">Editorial:</label>
        <input type="text" id="editorial" name="editorial">
        <label for="isbn">ISBN:</label>
        <input type="text" id="isbn" name="isbn">
        <label for="idioma">Idioma:</label>
        <input type="text" id="idioma" name="idioma">
        <label for="rating">Rating:</label>
        <input type="text" id="rating" name="rating">
      </div>
      <div class="form-column">
        <label for="num_resenas">No. Total de Reseñas:</label>
        <input type="text" id="num_resenas" name="num_resenas">
        <label for="autor">Autor:</label>
        <input type="text" id="autor" name="autor">
        <label for="fecha">Fecha:</label>
        <input type="date" id="fecha" name="fecha">
        <label for="rating_1">Rating 1:</label>
        <input type="text" id="rating_1" name="rating_1">
        <label for="rating_2">Rating 2:</label>
        <input type="text" id="rating_2" name="rating_2">
        <label for="rating_3">Rating 3:</label>
        <input type="text" id="rating_3" name="rating_3">
        <label for="rating_4">Rating 4:</label>
        <input type="text" id="rating_4" name="rating_4">
        <label for="rating_5">Rating 5:</label>
        <input type="text" id="rating_5" name="rating_5">
        <label for="rating_total">Rating Total:</label>
        <input type="text" id="rating_total" name="rating_total">
      </div>
      <div class="buttons">
        <button type="submit">Agregar</button>
        <button type="button" onclick="limpiarFormulario()">Limpiar</button>
      </div>
      
    </form>
  </div>
  <script>
    function limpiarFormulario() {
      document.querySelector('form').reset();
    }
  </script>
</body>
</html>