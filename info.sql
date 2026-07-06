# Problemática: Sistema de Renta de Mobiliario para Eventos

Una empresa dedicada a la renta de mobiliario y equipo para eventos desea desarrollar un sistema web que le permita mostrar su catálogo de productos y facilitar a los clientes la solicitud de cotizaciones.

La empresa ofrece artículos como mesas, sillas, manteles, carpas, vajillas y decoración para diferentes tipos de eventos. Cada producto pertenece a una categoría y cuenta con una descripción, precio de renta, cantidad disponible e imagen representativa.

Los clientes podrán ingresar al sitio web sin necesidad de crear una cuenta o iniciar sesión. Desde el catálogo podrán consultar los productos disponibles, seleccionar los artículos de su interés y solicitar una cotización proporcionando únicamente sus datos de contacto.

Cada solicitud de cotización podrá incluir uno o varios productos, indicando la cantidad requerida de cada uno. El sistema almacenará la información del cliente, la fecha de la solicitud y el estado de la cotización, el cual podrá ser Pendiente, Cotizada, Aceptada o Cancelada.

Además, el sistema contará con un acceso exclusivo para los administradores, quienes podrán iniciar sesión para administrar las categorías, los productos disponibles y revisar las cotizaciones enviadas por los clientes, actualizando su estado conforme avance el proceso de atención.

Con este sistema se busca agilizar el proceso de solicitud de cotizaciones, mejorar el control del inventario disponible para renta y facilitar la administración de la información tanto de los productos como de las solicitudes realizadas por los clientes.





CREATE DATABASE rentevent;
USE rentevent;

-- ==========================
-- TABLA: CATEGORIA
-- ==========================
CREATE TABLE categoria (
    pk_categoria INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL
);

INSERT INTO categoria (nombre) VALUES
('Mesas'),
('Sillas'),
('Manteles'),
('Carpas'),
('Vajillas'),
('Decoración');

-- ==========================
-- TABLA: PRODUCTO
-- ==========================
CREATE TABLE producto (
    pk_producto INT AUTO_INCREMENT PRIMARY KEY,
    fk_categoria INT NOT NULL,
    nombre VARCHAR(150) NOT NULL,
    descripcion TEXT,
    precio_renta DECIMAL(10,2) NOT NULL,
    existencia INT NOT NULL,
    imagen VARCHAR(255),
    FOREIGN KEY (fk_categoria) REFERENCES categoria(pk_categoria)
);

INSERT INTO producto (fk_categoria,nombre,descripcion,precio_renta,existencia,imagen) VALUES
(1,'Mesa Redonda 1.80 m','Mesa para 10 personas',250.00,20,'mesa_redonda.jpg'),
(1,'Mesa Rectangular','Mesa para banquetes',220.00,15,'mesa_rectangular.jpg'),
(2,'Silla Tiffany Blanca','Silla elegante',35.00,200,'tiffany.jpg'),
(2,'Silla Plegable','Silla metálica',20.00,300,'plegable.jpg'),
(3,'Mantel Blanco','Mantel redondo color blanco',45.00,80,'mantel_blanco.jpg'),
(3,'Mantel Negro','Mantel redondo color negro',50.00,70,'mantel_negro.jpg'),
(4,'Carpa 6x6','Carpa para eventos',1200.00,8,'carpa6x6.jpg'),
(5,'Vajilla para 50 personas','Juego completo de vajilla',900.00,5,'vajilla.jpg'),
(6,'Arco de Globos','Decoración para eventos',700.00,10,'globos.jpg');

-- ==========================
-- TABLA: CLIENTE
-- ==========================
CREATE TABLE cliente (
    pk_cliente INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(120) NOT NULL,
    telefono VARCHAR(20),
    correo VARCHAR(120)
);

INSERT INTO cliente (nombre,telefono,correo) VALUES
('Juan Pérez','3111234567','juan@gmail.com'),
('María López','3119876543','maria@gmail.com');

-- ==========================
-- TABLA: COTIZACION
-- ==========================
CREATE TABLE cotizacion (
    pk_cotizacion INT AUTO_INCREMENT PRIMARY KEY,
    fk_cliente INT NOT NULL,
    fecha DATE NOT NULL,
    estado ENUM('Pendiente','Cotizada','Aceptada','Cancelada') DEFAULT 'Pendiente',
    comentarios TEXT,
    FOREIGN KEY (fk_cliente) REFERENCES cliente(pk_cliente)
);

INSERT INTO cotizacion (fk_cliente,fecha,estado,comentarios) VALUES
(1,'2026-07-06','Pendiente','Evento para 100 personas'),
(2,'2026-07-05','Cotizada','Boda');

-- ==========================
-- TABLA: DETALLE_COTIZACION
-- ==========================
CREATE TABLE detalle_cotizacion (
    pk_detalle_cotizacion INT AUTO_INCREMENT PRIMARY KEY,
    fk_cotizacion INT NOT NULL,
    fk_producto INT NOT NULL,
    cantidad INT NOT NULL,
    precio DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (fk_cotizacion) REFERENCES cotizacion(pk_cotizacion),
    FOREIGN KEY (fk_producto) REFERENCES producto(pk_producto)
);

INSERT INTO detalle_cotizacion (fk_cotizacion,fk_producto,cantidad,precio) VALUES
(1,1,10,250.00),
(1,3,100,35.00),
(1,5,10,45.00),
(2,7,1,1200.00),
(2,9,1,700.00);

-- ==========================
-- TABLA: USUARIO
-- ==========================
CREATE TABLE usuario (
    pk_usuario INT AUTO_INCREMENT PRIMARY KEY,
    usuario VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(100) NOT NULL,
    nombre VARCHAR(100) NOT NULL
);

INSERT INTO usuario (usuario,password,nombre) VALUES
('admin','123456','Administrador'),
('empleado','123456','Empleado');