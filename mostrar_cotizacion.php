<?php

include 'conexion.php';

$sql = "SELECT  fecha, estado, comentarios, nombre , telefono
FROM  cotizacion c
join cliente cl on c.fk_cliente = cl.pk_cliente";

$resultado = $conn->query($sql);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categoria</title>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

</head>
<body>
     <?php include 'menu.php'; ?>

    <h1 class="alert alert-primary text-center container text-dark mt-4">Mostrar productos</h1>

    <table class="table container table-hover table-striped table-bordered">

     <tr>
        <th>fecha</th>
        <th>estado</th>
        <th>comentarios</th>
        <th>nombre</th>
        <th>telefono</th>
        
     </tr>

    <?php  
        while ($fila = $resultado->fetch_assoc()){
            ?>
            <tr>
                <td><?php echo $fila['fecha']; ?></td>
                <td><?php echo $fila['estado']; ?></td>
                <td><?php echo $fila['comentarios']; ?></td>
                <td><?php echo $fila['nombre']; ?></td>
                <td><?php echo $fila['telefono']; ?></td>
            <?php
        }
        ?>
    </table>
    
</body>
</html>