<?php
include 'conexion.php';

$sql = "SELECT p.*, c.nombre AS nombre_categoria
        FROM producto p
        LEFT JOIN categoria c ON p.fk_categoria = c.pk_categoria
        ORDER BY p.existencia DESC, p.nombre ASC";

$resultado = $conn->query($sql);
$productos = [];
if ($resultado) {
    while ($fila = $resultado->fetch_assoc()) {
        $productos[] = $fila;
    }
}
$totalProductos = count($productos);

// Categorías únicas para el filtro
$categoriasUnicas = [];
foreach ($productos as $p) {
    $cat = $p['nombre_categoria'] ?? 'Sin categoría';
    $categoriasUnicas[$cat] = true;
}
$categoriasUnicas = array_keys($categoriasUnicas);
sort($categoriasUnicas);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos | Panel de Pedidos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

    <style>
        :root {
            --brand-pink: #ff4d94;
            --brand-purple: #7b2ff7;
            --brand-orange: #ffb703;
        }

        body {
            font-family: 'Poppins', sans-serif;
            min-height: 100vh;
            background-image:
                linear-gradient(180deg, rgba(30, 10, 40, 0.88), rgba(30, 10, 40, 0.94)),
                url('https://images.unsplash.com/photo-1770805001834-f9ccd734c6fb?fm=jpg&q=80&w=1920&auto=format&fit=crop');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            padding-bottom: 90px;
        }

        .page-header {
            padding: 2.5rem 1rem 1rem;
            text-align: center;
            color: #fff;
        }

        .page-header h1 {
            font-weight: 800;
            text-shadow: 0 4px 16px rgba(0,0,0,.4);
        }

        .page-header p {
            color: #e6d6f7;
        }

        .toolbar {
            background: #fff;
            border-radius: 16px;
            padding: 1.1rem 1.4rem;
            box-shadow: 0 12px 30px rgba(0,0,0,.25);
            margin-bottom: 1.75rem;
            position: sticky;
            top: 10px;
            z-index: 20;
        }

        .toolbar input,
        .toolbar select {
            border-radius: 12px;
            font-weight: 500;
        }

        .badge-count {
            background: linear-gradient(135deg, var(--brand-pink), var(--brand-purple));
            color: #fff;
            font-weight: 700;
            border-radius: 50px;
            padding: .5rem 1.1rem;
            font-size: .95rem;
            white-space: nowrap;
        }

        .btn-brand {
            background: linear-gradient(135deg, var(--brand-pink), var(--brand-purple));
            border: none;
            color: #fff;
            font-weight: 600;
            border-radius: 50px;
            transition: transform .2s ease, box-shadow .2s ease;
        }

        .btn-brand:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(123, 47, 247, 0.35);
            color: #fff;
        }

        .product-card {
            background: #fff;
            border-radius: 18px;
            overflow: hidden;
            box-shadow: 0 10px 28px rgba(0,0,0,.22);
            transition: transform .15s ease, box-shadow .15s ease;
            height: 100%;
            border: 3px solid transparent;
        }

        .product-card.agotado {
            opacity: .6;
        }

        .product-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 16px 34px rgba(0,0,0,.3);
        }

        .product-img {
            width: 100%;
            height: 170px;
            object-fit: cover;
            background: linear-gradient(135deg, #f3e6ff, #ffe1ec);
        }

        .product-img.no-image {
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.8rem;
        }

        .product-body {
            padding: 1.15rem;
        }

        .product-cat {
            display: inline-block;
            background: #f3e6ff;
            color: var(--brand-purple);
            font-size: .72rem;
            font-weight: 700;
            padding: .28rem .75rem;
            border-radius: 50px;
            margin-bottom: .55rem;
            text-transform: uppercase;
            letter-spacing: .03em;
        }

        .product-title {
            font-weight: 700;
            color: #2c1a3d;
            margin-bottom: .3rem;
            font-size: 1.08rem;
        }

        .product-desc {
            color: #777;
            font-size: .85rem;
            min-height: 2.4em;
        }

        .stock-line {
            display: flex;
            align-items: center;
            gap: .5rem;
            margin: .85rem 0;
            padding: .55rem .8rem;
            border-radius: 12px;
            font-weight: 700;
            font-size: .95rem;
        }

        .stock-ok { background: #e2f7e9; color: #1e7e42; }
        .stock-low { background: #fff2e0; color: #b56d00; }
        .stock-none { background: #fde3e3; color: #c0392b; }

        .product-price {
            font-weight: 800;
            font-size: 1.3rem;
            color: var(--brand-pink);
        }

        .qty-controls {
            display: flex;
            align-items: center;
            gap: .4rem;
        }

        .qty-controls button {
            width: 34px;
            height: 34px;
            border-radius: 50%;
            border: 2px solid var(--brand-purple);
            background: #fff;
            color: var(--brand-purple);
            font-weight: 800;
            font-size: 1.1rem;
            line-height: 1;
        }

        .qty-controls input {
            width: 46px;
            text-align: center;
            border: 2px solid #eee;
            border-radius: 8px;
            font-weight: 700;
        }

        .btn-agregar {
            width: 100%;
            margin-top: .8rem;
            padding: .6rem;
            font-size: .95rem;
        }

        .btn-agregar:disabled {
            background: #ccc;
            color: #888;
            box-shadow: none;
            cursor: not-allowed;
        }

        .empty-state, .no-results {
            background: #fff;
            border-radius: 18px;
            padding: 3rem 2rem;
            text-align: center;
            box-shadow: 0 12px 30px rgba(0,0,0,.22);
        }

        .no-results { display: none; }

        .pedido-bar {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background: #1e0a28;
            color: #fff;
            padding: .9rem 1.2rem;
            box-shadow: 0 -8px 24px rgba(0,0,0,.35);
            z-index: 40;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .pedido-bar .resumen {
            font-weight: 600;
            font-size: .95rem;
        }

        .pedido-bar .resumen strong {
            color: var(--brand-orange);
        }

        .offcanvas-header, .offcanvas-body {
            font-family: 'Poppins', sans-serif;
        }

        .pedido-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: .7rem 0;
            border-bottom: 1px solid #eee;
        }

        .pedido-item .nombre {
            font-weight: 600;
            color: #2c1a3d;
        }

        .pedido-item .sub {
            font-size: .8rem;
            color: #888;
        }

        .btn-quitar {
            background: none;
            border: none;
            color: #c0392b;
            font-weight: 700;
            font-size: .95rem;
        }

        footer {
            background: #1e0a28;
            color: #eee2f5;
            padding: 1.2rem 0;
            text-align: center;
            font-size: .85rem;
            margin-top: 3rem;
        }

        @media (max-width: 576px) {
            .toolbar { position: static; }
        }
    </style>
</head>
<body>
    <?php if (file_exists('menu.php')) { include 'menu.php'; } ?>

    <div class="page-header">
        <h1>🎪 Panel de Pedidos</h1>
        <p class="mb-0">Selecciona los artículos y arma el pedido del cliente</p>
    </div>

    <div class="container">

        <div class="toolbar d-flex flex-wrap align-items-center gap-2">
            <div class="flex-grow-1" style="min-width:220px;">
                <input type="text" id="buscador" class="form-control" placeholder="🔍 Buscar producto por nombre...">
            </div>
            <div style="min-width:180px;">
                <select id="filtroCategoria" class="form-select">
                    <option value="">Todas las categorías</option>
                    <?php foreach ($categoriasUnicas as $cat): ?>
                        <option value="<?= htmlspecialchars($cat) ?>"><?= htmlspecialchars($cat) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <span class="badge-count" id="contadorVisible"><?= (int) $totalProductos ?> productos</span>
            <a href="formulario_producto.php" class="btn btn-brand px-3">+ Nuevo</a>
        </div>

        <?php if ($totalProductos > 0): ?>
            <div class="row g-4" id="contenedorProductos">
                <?php foreach ($productos as $fila):
                    $stock = (int) $fila['existencia'];
                    $categoria = $fila['nombre_categoria'] ?? 'Sin categoría';

                    if ($stock <= 0) {
                        $stockClass = 'stock-none';
                        $stockLabel = '🚫 Sin existencia';
                    } elseif ($stock <= 3) {
                        $stockClass = 'stock-low';
                        $stockLabel = '⚠️ Quedan ' . $stock;
                    } else {
                        $stockClass = 'stock-ok';
                        $stockLabel = '✅ Disponibles: ' . $stock;
                    }
                ?>
                    <div class="col-sm-6 col-lg-4 col-xl-3 producto-item"
                         data-nombre="<?= htmlspecialchars(mb_strtolower($fila['nombre'])) ?>"
                         data-categoria="<?= htmlspecialchars($categoria) ?>">
                        <div class="product-card <?= $stock <= 0 ? 'agotado' : '' ?>"
                             data-id="<?= (int) $fila['pk_producto'] ?>"
                             data-nombre-real="<?= htmlspecialchars($fila['nombre']) ?>"
                             data-precio="<?= (float) $fila['precio_renta'] ?>"
                             data-stock="<?= $stock ?>">

                            <?php if (!empty($fila['imagen'])): ?>
                                <img src="uploads/productos/<?= htmlspecialchars($fila['imagen']) ?>" class="product-img" alt="<?= htmlspecialchars($fila['nombre']) ?>">
                            <?php else: ?>
                                <div class="product-img no-image">🎈</div>
                            <?php endif; ?>

                            <div class="product-body">
                                <span class="product-cat"><?= htmlspecialchars($categoria) ?></span>
                                <h5 class="product-title"><?= htmlspecialchars($fila['nombre']) ?></h5>
                                <p class="product-desc"><?= htmlspecialchars($fila['descripcion'] ?: 'Sin descripción disponible.') ?></p>

                                <div class="stock-line <?= $stockClass ?>"><?= $stockLabel ?></div>

                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="product-price">$<?= number_format((float) $fila['precio_renta'], 2) ?></span>

                                    <?php if ($stock > 0): ?>
                                    <div class="qty-controls">
                                        <button type="button" class="btn-menos">−</button>
                                        <input type="number" class="input-cantidad" value="1" min="1" max="<?= $stock ?>">
                                        <button type="button" class="btn-mas">+</button>
                                    </div>
                                    <?php endif; ?>
                                </div>

                                <?php if ($stock > 0): ?>
                                    <button type="button" class="btn btn-brand btn-agregar">Agregar al pedido</button>
                                <?php else: ?>
                                    <button type="button" class="btn btn-agregar" disabled>Sin existencia</button>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="no-results" id="sinResultados">
                <h5 class="fw-bold mb-1">No se encontraron productos</h5>
                <p class="text-muted mb-0">Intenta con otro nombre o categoría.</p>
            </div>

        <?php else: ?>
            <div class="empty-state">
                <h4 class="fw-bold mb-2">Aún no hay productos registrados</h4>
                <p class="text-muted mb-4">Comienza agregando el primer artículo a tu catálogo de rentas.</p>
                <a href="formulario_producto.php" class="btn btn-brand px-4 py-2">Registrar producto</a>
            </div>
        <?php endif; ?>

    </div>

    <footer>
        &copy; <?php echo date('Y'); ?> Sistema de Rentas para Fiestas. Todos los derechos reservados.
    </footer>

    <div class="pedido-bar">
        <div class="resumen">
            🛒 <span id="totalArticulos">0</span> artículo(s) — Total: $<strong id="totalPedido">0.00</strong>
        </div>
        <button class="btn btn-brand px-4" data-bs-toggle="offcanvas" data-bs-target="#offcanvasPedido">
            Ver pedido
        </button>
    </div>

    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasPedido">
        <div class="offcanvas-header">
            <h5 class="fw-bold mb-0">Pedido actual</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
        </div>
        <div class="offcanvas-body d-flex flex-column">
            <div id="listaPedido" class="flex-grow-1"></div>

            <div class="border-top pt-3 mt-2">
                <div class="d-flex justify-content-between fw-bold fs-5 mb-3">
                    <span>Total</span>
                    <span>$<span id="totalOffcanvas">0.00</span></span>
                </div>
                <button class="btn btn-brand w-100 mb-2" id="btnConfirmarPedido">Confirmar pedido</button>
                <button class="btn btn-outline-danger w-100" id="btnVaciarPedido">Vaciar pedido</button>
            </div>
        </div>
    </div>

    <script>
        const buscador = document.getElementById('buscador');
        const filtroCategoria = document.getElementById('filtroCategoria');
        const items = document.querySelectorAll('.producto-item');
        const sinResultados = document.getElementById('sinResultados');
        const contadorVisible = document.getElementById('contadorVisible');

        function filtrarProductos() {
            const texto = buscador.value.trim().toLowerCase();
            const cat = filtroCategoria.value;
            let visibles = 0;

            items.forEach(item => {
                const coincideTexto = item.dataset.nombre.includes(texto);
                const coincideCategoria = !cat || item.dataset.categoria === cat;
                const mostrar = coincideTexto && coincideCategoria;
                item.style.display = mostrar ? '' : 'none';
                if (mostrar) visibles++;
            });

            contadorVisible.textContent = visibles + (visibles === 1 ? ' producto' : ' productos');
            sinResultados.style.display = visibles === 0 ? 'block' : 'none';
        }

        buscador.addEventListener('input', filtrarProductos);
        filtroCategoria.addEventListener('change', filtrarProductos);

        document.querySelectorAll('.product-card').forEach(card => {
            const inputCantidad = card.querySelector('.input-cantidad');
            const btnMas = card.querySelector('.btn-mas');
            const btnMenos = card.querySelector('.btn-menos');
            const maxStock = parseInt(card.dataset.stock);

            if (btnMas) {
                btnMas.addEventListener('click', () => {
                    let val = parseInt(inputCantidad.value) || 1;
                    if (val < maxStock) inputCantidad.value = val + 1;
                });
            }
            if (btnMenos) {
                btnMenos.addEventListener('click', () => {
                    let val = parseInt(inputCantidad.value) || 1;
                    if (val > 1) inputCantidad.value = val - 1;
                });
            }
        });

        let pedido = {};

        function actualizarResumen() {
            let totalArticulos = 0;
            let totalPedido = 0;

            Object.values(pedido).forEach(item => {
                totalArticulos += item.cantidad;
                totalPedido += item.cantidad * item.precio;
            });

            document.getElementById('totalArticulos').textContent = totalArticulos;
            document.getElementById('totalPedido').textContent = totalPedido.toFixed(2);
            document.getElementById('totalOffcanvas').textContent = totalPedido.toFixed(2);

            renderizarListaPedido();
        }

        function renderizarListaPedido() {
            const contenedor = document.getElementById('listaPedido');
            contenedor.innerHTML = '';

            const ids = Object.keys(pedido);
            if (ids.length === 0) {
                contenedor.innerHTML = '<p class="text-muted text-center mt-4">Aún no has agregado productos.</p>';
                return;
            }

            ids.forEach(id => {
                const item = pedido[id];
                const div = document.createElement('div');
                div.className = 'pedido-item';
                div.innerHTML = `
                    <div>
                        <div class="nombre">${item.nombre}</div>
                        <div class="sub">${item.cantidad} x $${item.precio.toFixed(2)} = $${(item.cantidad * item.precio).toFixed(2)}</div>
                    </div>
                    <button class="btn-quitar" data-id="${id}">✕</button>
                `;
                contenedor.appendChild(div);
            });

            contenedor.querySelectorAll('.btn-quitar').forEach(btn => {
                btn.addEventListener('click', (e) => {
                    const id = e.target.dataset.id;
                    delete pedido[id];
                    actualizarResumen();
                });
            });
        }

        document.querySelectorAll('.btn-agregar').forEach(btn => {
            btn.addEventListener('click', (e) => {
                const card = e.target.closest('.product-card');
                const id = card.dataset.id;
                const nombre = card.dataset.nombreReal;
                const precio = parseFloat(card.dataset.precio);
                const cantidadInput = card.querySelector('.input-cantidad');
                const cantidad = parseInt(cantidadInput.value) || 1;

                if (pedido[id]) {
                    pedido[id].cantidad += cantidad;
                } else {
                    pedido[id] = { nombre, precio, cantidad };
                }

                const original = btn.textContent;
                btn.textContent = '✓ Agregado';
                setTimeout(() => { btn.textContent = original; }, 900);

                actualizarResumen();
            });
        });

        document.getElementById('btnVaciarPedido').addEventListener('click', () => {
            if (confirm('¿Vaciar todo el pedido actual?')) {
                pedido = {};
                actualizarResumen();
            }
        });

        document.getElementById('btnConfirmarPedido').addEventListener('click', () => {
            if (Object.keys(pedido).length === 0) {
                alert('El pedido está vacío.');
                return;
            }
            // Aquí puedes enviar `pedido` a un archivo PHP (ej. guardar_pedido.php)
            // mediante fetch() para registrar la renta en la base de datos.
            alert('Pedido listo para procesar. (Conecta este botón a tu backend de pedidos)');
            console.log('Pedido a enviar:', pedido);
        });
    </script>
</body>
</html>