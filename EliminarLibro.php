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
    <title>Eliminar Libro</title>
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
                <form id="bookForm" action="deleteBook.php" method="post">
                    <h2>Eliminar Libro</h2>
                    <div class="form-group">
                        <label for="bookId">ID:</label>
                        <input type="text" id="bookId" name="bookId" placeholder="BookId">
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
                        <button type="submit">Eliminar</button>
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
            document.getElementById("idUser").value = "";
            document.getElementById("fecha").value = "";

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
}
});
    </script>
</body>
</html>