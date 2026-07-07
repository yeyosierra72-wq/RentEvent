<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Categoria</title>
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

</head>
<body>

<?php include 'menu.php'; ?>

  <h1 class="alert alert-primary text-center container mt-4 text-dark">Formulario de Categoria</h1>

    <form action="guardar_categoria.php" method="POST" class="container">


     <div class="mb-3">
        <label for="">Nombre del cliente</label>
        <input type="text" name="nombre" class="form-control" required>
    </div>
    <br>


    <button type="sumbit" class="btn btn-primary form-control" > Registrar</button>

</form>
    
</body>
</html>