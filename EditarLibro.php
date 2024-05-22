<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    echo "No estás logueado.";
    exit();
}
$user_id = $_SESSION['user_id'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Libro</title>
    <link rel="stylesheet" href="stylesUdtBook.css">
</head>
<header>
    <?php
    $conexion = pg_connect("host=localhost dbname=goodreads user=postgres password=5102");
    if (!$conexion) {
        die("Error en la conexión a la base de datos.");
    }
    $query_autores = "SELECT DISTINCT \"Autor\" FROM VW_BooksAndRatings ORDER BY \"Autor\" ASC";
    $result_autores = pg_query($conexion, $query_autores);
    ?>
    <select id="authorSelect">
        <option value="">Seleccionar Autor</option>
        <?php
        while ($row_autor = pg_fetch_assoc($result_autores)) {
            echo "<option value='" . $row_autor['Autor'] . "'>" . $row_autor['Autor'] . "</option>";
        }
        pg_free_result($result_autores);
        pg_close($conexion);
        ?>
    </select>
    <button onclick="searchBooks()">Buscar</button>
</header>
<body>
    <div class="container">
        <div class="left-column">
            <div class="form-container">
                <form id="bookForm" action="updateBook.php" method="post">
                    <h2>Editar Libro</h2>
                    <div class="form-group">
                        <label for="bookId">ID:</label>
                        <input type="text" id="bookId" name="bookId" placeholder="BookId">
                    </div>
                    <div class="form-group">
                        <label for="name">Título:</label>
                        <input type="text" id="name" name="name" placeholder="Name">
                    </div>
                    <div class="form-group">
                        <label for="noPaginas">No. de páginas:</label>
                        <input type="text" id="noPaginas" name="noPaginas" placeholder="pagesNumber">
                    </div>
                    <div class="form-group">
                        <label for="mes_publicacion">Mes de publicación:</label>
                        <input type="text" id="mes_publicacion" name="mes_publicacion" placeholder="publishMonth">
                    </div>
                    <div class="form-group">
                        <label for="dia_publicacion">Día de publicación:</label>
                        <input type="text" id="dia_publicacion" name="dia_publicacion" placeholder="publishDay">
                    </div>
                    <div class="form-group">
                        <label for="ano_publicacion">Año de publicación:</label>
                        <input type="text" id="ano_publicacion" name="ano_publicacion" placeholder="publishYear">
                    </div>
                    <div class="form-group">
                        <label for="editorial">Editorial:</label>
                        <input type="text" id="editorial" name="editorial" placeholder="publisher">
                    </div>
                    <div class="form-group">
                        <label for="ISBN">ISBN:</label>
                        <input type="text" id="ISBN" name="ISBN" placeholder="ISBN">
                    </div>
                    <div class="form-group">
                        <label for="idioma">Idioma:</label>
                        <input type="text" id="idioma" name="idioma" placeholder="Language">
                    </div>
                    <div class="form-group">
                        <label for="rating">Rating:</label>
                        <input type="text" id="rating" name="rating" placeholder="Rating">                        
                    </div>
                    <div class="form-group">
                        <label for="counts_of_review">No. total de reseñas:</label>
                        <input type="text" id="counts_of_review" name="counts_of_review" placeholder="countsOfReview">
                    </div>
                    <div class="form-group">
                        <label for="authorName">Autor:</label>
                        <input type="text" id="authorName" name="authorName" placeholder="AuthorId">
                    </div>
                    <div class="form-group">
                        <label for="idUser">ID Usuario:</label>
                        <input type="text" id="idUser" name="idUser" value="<?php echo htmlspecialchars($user_id); ?>" disabled>
                    </div>
                    <div class="form-group">
                        <label for="fecha">Fecha:</label>
                        <input type="date" id="fecha" name="fecha" placeholder="fechaMod">
                    </div>
                    <div class="form-group">
                        <label for="rating1">Rating 1:</label>
                        <input type="text" id="rating1" name="rating1" placeholder="RatingD1">
                    </div>
                    <div class="form-group">
                        <label for="rating2">Rating 2:</label>
                        <input type="text" id="rating2" name="rating2" placeholder="RatingD2">
                    </div>
                    <div class="form-group">
                        <label for="rating3">Rating 3:</label>
                        <input type="text" id="rating3" name="rating3" placeholder="RatingD3">
                    </div>
                    <div class="form-group">
                        <label for="rating4">Rating 4:</label>
                        <input type="text" id="rating4" name="rating4" placeholder="RatingD4">
                    </div>
                    <div class="form-group">
                        <label for="rating5">Rating 5:</label>
                        <input type="text" id="rating5" name="rating5" placeholder="RatingD5">
                    </div>
                    <div class="form-group">
                        <label for="ratingTotal">Rating Total:</label>
                        <input type="text" id="ratingTotal" name="ratingTotal" placeholder="RatingDTotal">
                    </div>
                    <div class="form-group">
                        <button type="submit">Guardar</button>
                        <button type="button" onclick="limpiar()" class="btn">Limpiar</button>
                    </div>
                    </form>
            </div>
        </div>

                    <div class="right-column">
        <div class="table-container">
    <table>
        <thead>
        <tr>
            <th>id</th>
            <th>Título</th>
            <th>No. de páginas</th>
            <th>Mes de publicación</th>
            <th>Día de publicación</th>
            <th>Año de publicación</th>
            <th>Editorial</th>
            <th>ISBN</th>
            <th>Idioma</th>
            <th>Rating</th>
            <th>No. total de reseñas</th>
            <th>Autor</th>
            <th>Rating 1</th>
            <th>Rating 2</th>
            <th>Rating 3</th>
            <th>Rating 4</th>
            <th>Rating 5</th>
            <th>Rating Total</th>
        </tr>
        </thead>
        <tbody id="tablaLibros">
        <?php
        // Aquí se incluirán las filas de la tabla desde PHP
        ?>
        </tbody>
    </table>
</div>
        </div>

    <script>
    function searchBooks() {
        var authorSelect = document.getElementById('authorSelect');
        var selectedAuthor = authorSelect.value;

        if (selectedAuthor !== '') {
            fetch('searchBooknAuthor.php?autor=' + encodeURIComponent(selectedAuthor))
                .then(response => response.text())
                .then(data => {
                    document.getElementById('tablaLibros').innerHTML = data;
                })
                .catch(error => {
                    console.error('Error al buscar autor:', error);
                });
        } else {
            alert('Por favor, selecciona un autor.');
        }
    }
    const table = document.getElementById('tablaLibros');

function limpiar() {
            document.getElementById("bookId").value = "";
            document.getElementById("name").value = "";
            document.getElementById("noPaginas").value = "";
            document.getElementById("mes_publicacion").value = "";
            document.getElementById("dia_publicacion").value = "";
            document.getElementById("ano_publicacion").value = "";
            document.getElementById("editorial").value = "";
            document.getElementById("ISBN").value = "";
            document.getElementById("idioma").value = "";
            document.getElementById("rating").value = "";
            document.getElementById("counts_of_review").value = "";
            document.getElementById("authorName").value = "";
            document.getElementById("idUser").value = "";
            document.getElementById("fecha").value = "";
            document.getElementById("rating1").value = "";
            document.getElementById("rating2").value = "";
            document.getElementById("rating3").value = "";
            document.getElementById("rating4").value = "";
            document.getElementById("rating5").value = "";
            document.getElementById("ratingTotal").value = "";
        }

        table.addEventListener('click', function(event) {
  if (event.target.tagName === 'TR') {
    const previouslySelectedRow = document.querySelector('.selected');
    if (previouslySelectedRow) {
      previouslySelectedRow.classList.remove('selected');
    }

    const clickedRow = event.target;
    clickedRow.classList.add('selected');

    const rowData = clickedRow.querySelectorAll('td');
    document.getElementById('bookId').value = rowData[0].textContent;
    document.getElementById('name').value = rowData[1].textContent;
    document.getElementById('noPaginas').value = rowData[2].textContent;
    document.getElementById('mes_publicacion').value = rowData[3].textContent;
    document.getElementById('dia_publicacion').value = rowData[4].textContent;
    document.getElementById('ano_publicacion').value = rowData[5].textContent;
    document.getElementById('editorial').value = rowData[6].textContent;
    document.getElementById('ISBN').value = rowData[7].textContent;
    document.getElementById('idioma').value = rowData[8].textContent;
    document.getElementById('rating').value = rowData[9].textContent;
    document.getElementById('counts_of_review').value = rowData[10].textContent;
    document.getElementById('authorName').value = rowData[11].textContent;
    document.getElementById('rating1').value = rowData[12].textContent;
    document.getElementById('rating2').value = rowData[13].textContent;
    document.getElementById('rating3').value = rowData[14].textContent;
    document.getElementById('rating4').value = rowData[15].textContent;
    document.getElementById('rating5').value = rowData[16].textContent;
    document.getElementById('ratingTotal').value = rowData[17].textContent;
}
});
    </script>
</body>
</html>
