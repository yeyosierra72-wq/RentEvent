<?php
// incluir la conexion de la base de datos
include "conexion.php";

// recibir los datos del formulario
$nombre = trim($_POST['nombre']);
$telefono = trim($_POST['telefono']);
$correo = trim($_POST['correo']);

// preparamos la sentencia para evitar inyección SQL
$sql = $conn->prepare("INSERT INTO cliente (nombre, telefono, correo) VALUES (?, ?, ?)");
$sql->bind_param("sss", $nombre, $telefono, $correo);

if ($sql->execute()) {
    // Éxito: redirigimos con un parámetro que activa el toast de éxito
    header("Location: formulario_cliente.php?status=ok");
} else {
    // Error: redirigimos con el mensaje de error codificado en la URL
    $msg = urlencode($sql->error);
    header("Location: formulario_cliente.php?status=error&msg=$msg");
}

$sql->close();
$conn->close(); // Cerramos la conexión
exit;
?>