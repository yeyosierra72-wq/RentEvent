<?php
// incluir la conexion de la base de datos  

include "conexion.php";

//  recibir los datos del Formulario
$nombre = $_POST['nombre'];



// insertar los datos en la bse de datos 
$sql = "INSERT INTO categoria (nombre)
 VALUES ('$nombre')";


if ($conn->query($sql) === TRUE) { 
    // Si se guarda correctamente, mostramos una alerta y redireccionamos al formulario
    echo "<script>
            alert('Registro guardado correctamente.');
            window.location.href = 'formulario_categoria.php';
          </script>";
} else {
    // Si hay un error, mostramos una alerta con el mensaje de error
    echo "<script>
            alert('Error al guardar: " . $conn->error . "');
            window.location.href = 'formulario_categoria.php';
          </script>";
}

$conn->close(); // Cerramos la conexión


?>