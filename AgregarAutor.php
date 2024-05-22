<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Autor</title>
    <link rel="stylesheet" href="stylesAddAuthor.css">
</head>
<body>
<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    echo "No estás logueado.";
    exit();
}
$user_id = $_SESSION['user_id'];
?>
    <div class="container">
            <div class="form-container">
                <h1>Agregar autor</h1>
                <form action="createAuthor.php" method="post">
                    <label for="nombre">Autor:</label>
                    <input type="text" id="nombre" name="nombre" required>

                    <label for="idUserCrea">ID Usuario:</label>
                    <input type="text" id="idUserCrea" name="idUserCrea" value="<?php echo htmlspecialchars($user_id); ?>" disabled>

                    <label for="fecha">Fecha:</label>
                    <input type="date" id="fecha" name="fecha" required>

                    <div class="buttons">
                        <button type="submit">Guardar</button>
                        <button type="button" onclick="limpiar()" class="btn">Limpiar</button>
                    </div>
                </form>
            </div>
    </div>
    <div class="table-container">
    <table>
        <thead>
        <tr>
            <th>id</th>
            <th>Nombre</th>
        </tr>
        </thead>
        <tbody id="tablaAutores">
        </tbody>
    </table>

    <script>
    function limpiar() {
        document.getElementById("nombre").value = "";
        document.getElementById("idUserCrea").value = "";
        document.getElementById("fecha").value = "";
    }

    fetch('searchAuthor.php')
            .then(response => response.json())
            .then(data => {
                const tbody = document.getElementById('tablaAutores');
                data.forEach(author => {
                    const tr = document.createElement('tr');
                    tr.innerHTML = `<td>${author.id}</td><td>${author.Name}</td>`;
                    tbody.appendChild(tr);
                });
            })
            .catch(error => console.error('Error:', error));

</script>
</body>
</html>