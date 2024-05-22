<?php
session_start();
include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $passw = $_POST['passw'];

    $query = "SELECT * FROM Users WHERE username = :username AND estatus = TRUE";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && $passw === $user['passw']) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        echo "Login exitoso. Bienvenido, " . htmlspecialchars($user['username']) . "!";
        header("Location: menu.php");
        exit();
    } else {
        echo "Usuario o contraseña incorrectos.";
    }
}
?>




