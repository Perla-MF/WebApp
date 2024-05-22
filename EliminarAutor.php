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
    <title>Eliminar Autor</title>
    <link rel="stylesheet" href="stylesUdtBook.css">
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
    <button onclick="searchAuthor()">Buscar</button>
</header>
<body>
    <div class="container">
    <div class="left-column">
      <div class="form-container">
            <h2>Eliminar Autor</h2>
            <form id="authorForm" action="deleteAuthor.php" method="post">
            <div class="form-group">
                <label for="id">ID:</label>
                <input type="text" id="id" name="id" placeholder= "id">
            </div>
            <div class="form-group">
                <label for="nombre">Autor:</label>
                <input type="text" id="nombre" name="nombre" placeholder= "Name">
            </div>
            <div class="form-group">
                <label for="author_id">ID Autor:</label>
                <input type="text" id="author_id" name="author_id" placeholder= "AuthorId">
            </div>
            <div class="form-group">
                 <label for="usuario_id">ID Usuario:</label>
                 <input type="text" id="id_usuario" name="id_usuario" value="<?php echo htmlspecialchars($user_id); ?>" disabled>
            </div>
            <div class="form-group">
                 <label for="fecha">Fecha:</label>
                 <input type="date" id="fecha" name="fecha" placeholder= "fechaMod">
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
            <th>ID</th>
            <th>Autor</th>
            <th>ID Autor</th>
            <th>ID Usuario</th>
            <th>Fecha</th>
        </tr>
        </thead>
        <tbody id="tablaAutores">
        </tbody>
    </table>
</div>
        </table>
    </div>
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
    function searchAuthor() {
        var authorSelect = document.getElementById('authorSelect');
        var selectedAuthor = authorSelect.value;

        if (selectedAuthor !== '') {
            fetch('readAuthor.php?autor=' + encodeURIComponent(selectedAuthor))
                .then(response => response.text())
                .then(data => {
                    document.getElementById('tablaAutores').innerHTML = data;
                })
                .catch(error => {
                    console.error('Error al buscar autor:', error);
                });
        } else {
            alert('Por favor, selecciona un autor.');
        }
    }
    const table = document.getElementById('tablaAutor');


    function limpiar() {
        document.getElementById("id").value = "";
        document.getElementById("nombre").value = "";
        document.getElementById("author_id").value = "";
        document.getElementById("id_usuario").value = "";
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
    document.getElementById('id').value = rowData[0].textContent;
    document.getElementById('nombre').value = rowData[1].textContent;
    document.getElementById('author_id').value = rowData[2].textContent;
    document.getElementById('id_usuario').value = rowData[4].textContent;
    document.getElementById('fecha').value = rowData[5].textContent;
  }
});
</script>
</body>
</html>