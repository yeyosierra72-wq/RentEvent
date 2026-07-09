<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800&display=swap" rel="stylesheet">

<style>
    :root {
        --brand-pink: #ff4d94;
        --brand-purple: #7b2ff7;
        --brand-dark: #1e0a28;
    }

    .navbar-rentevent {
        background: linear-gradient(90deg, var(--brand-dark), #2c1140);
        font-family: 'Poppins', sans-serif;
        padding: .7rem 1.5rem;
        box-shadow: 0 4px 18px rgba(0, 0, 0, .35);
    }

    .navbar-rentevent .navbar-brand {
        font-weight: 800;
        font-size: 1.3rem;
        color: #fff !important;
        display: flex;
        align-items: center;
        gap: .5rem;
    }

    .navbar-rentevent .navbar-brand span.icono {
        font-size: 1.5rem;
    }

    .navbar-rentevent .nav-link,
    .navbar-rentevent .btn-menu {
        color: #e6d6f7 !important;
        font-weight: 600;
        font-size: .95rem;
        padding: .5rem 1rem;
        border-radius: 10px;
        transition: background .2s ease, color .2s ease;
        background: transparent;
        border: none;
    }

    .navbar-rentevent .btn-menu:hover,
    .navbar-rentevent .btn-menu:focus,
    .navbar-rentevent .nav-link:hover {
        background: rgba(255, 255, 255, .08);
        color: #fff !important;
    }

    .navbar-rentevent .btn-menu::after {
        margin-left: .4rem;
    }

    .navbar-rentevent .dropdown-menu {
        background: #2c1140;
        border: 1px solid rgba(255, 255, 255, .08);
        border-radius: 14px;
        padding: .5rem;
        margin-top: .5rem;
        box-shadow: 0 12px 30px rgba(0, 0, 0, .4);
        min-width: 220px;
    }

    .navbar-rentevent .dropdown-item {
        color: #e6d6f7;
        font-weight: 500;
        font-size: .92rem;
        padding: .6rem .9rem;
        border-radius: 10px;
        display: flex;
        align-items: center;
        gap: .55rem;
    }

    .navbar-rentevent .dropdown-item:hover,
    .navbar-rentevent .dropdown-item:focus {
        background: linear-gradient(135deg, var(--brand-pink), var(--brand-purple));
        color: #fff;
    }

    .navbar-rentevent .dropdown-divider {
        border-color: rgba(255, 255, 255, .1);
    }

    .navbar-rentevent .navbar-toggler {
        border: none;
        color: #fff;
    }

    .navbar-rentevent .navbar-toggler:focus {
        box-shadow: none;
    }

    @media (max-width: 991px) {
        .navbar-rentevent .navbar-nav {
            margin-top: .75rem;
            gap: .35rem;
        }
    }
</style>

<nav class="navbar navbar-expand-lg navbar-dark navbar-rentevent">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">
        <span class="icono">🎉</span> RentEvent
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarRentevent" aria-controls="navbarRentevent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarRentevent">
      <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-2">

        <li class="nav-item">
          <a class="nav-link" href="index.php">Inicio</a>
        </li>

        <li class="nav-item dropdown">
          <button class="btn btn-menu dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
            Formularios
          </button>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="formulario_categoria.php">📁 Categoría</a></li>
            <li><a class="dropdown-item" href="formulario_producto.php">📦 Producto</a></li>
            <li><a class="dropdown-item" href="formulario_cliente.php">👤 Cliente</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="formulario_cotizacion.php">🧾 Cotización</a></li>
          </ul>
        </li>

        <li class="nav-item dropdown">
          <button class="btn btn-menu dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
            Consultas
          </button>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="mostrar_categoria.php">📁 Categorías</a></li>
            <li><a class="dropdown-item" href="mostrar_productos.php">📦 Productos</a></li>
            <li><a class="dropdown-item" href="mostrar_cliente.php">👤 Clientes</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="mostrar_cotizacion.php">🧾 Cotizaciones</a></li>
          </ul>
        </li>

      </ul>
    </div>
  </div>
</nav>