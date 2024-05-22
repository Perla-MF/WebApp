<!doctype html>
<html lang="en">
    <head>
        <title>Menu</title>
        <meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
        />
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous"
        />
        <link rel="stylesheet" href="stylesFormP.css">
    </head>
    <header>
    <?php
    $conexion = pg_connect("host=localhost dbname=goodreads user=postgres password=5102");
    if (!$conexion) {
        die("Error en la conexión a la base de datos.");
    }
    $query_autores = "SELECT DISTINCT \"Autor\" FROM VW_FichaBibliografica ORDER BY \"Autor\" ASC";
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
      <h1>Bienvenido</h1>
        <p>¿En qué puedo ayudarte hoy?</p>
        <div>
            <button onclick="location.href='AgregarLibro.php';">Agregar Libro</button>
            <button onclick="location.href='EditarLibro.php';">Editar Libro</button>
            <button onclick="location.href='EliminarLibro.php';">Eliminar Libro</button>
            <button onclick="location.href='AgregarAutor.php';">Agregar Autor</button>
            <button onclick="location.href='EditarAutor.php';">Editar Autor</button>
            <button onclick="location.href='EliminarAutor.php';">Eliminar Autor</button>
        </div>
        </form>
     </div>
     </div>

     <div class="right-column">
     <div class="container">
    <table>
        <thead>
        <tr>
            <th>id</th>
            <th>Título</th>
            <th>Año de publicación</th>
            <th>Editorial</th>
            <th>Autor</th>
        </tr>
        </thead>
        <tbody id="tablaFichas">
        </tbody>
    </table>
</div>
        <main></main>
        <footer>

        </footer>

        <script
            src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
            integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
            crossorigin="anonymous"
        ></script>

        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
            integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
            crossorigin="anonymous"
        ></script>
        <script>
    function searchBooks() {
        var authorSelect = document.getElementById('authorSelect');
        var selectedAuthor = authorSelect.value;

        if (selectedAuthor !== '') {

            fetch('searchBook.php?autor=' + encodeURIComponent(selectedAuthor))
                .then(response => response.text())
                .then(data => {

                    document.getElementById('tablaFichas').innerHTML = data;
                })
                .catch(error => {
                    console.error('Error al buscar libros:', error);
                });
        } else {
            alert('Por favor, selecciona un autor.');
        }
    }
</script>
    </body>
</html>