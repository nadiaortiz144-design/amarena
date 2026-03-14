<!DOCTYPE html>
<?php include('conexion.php'); ?>
<html lang="es">
	<!-- HEAD -->
<head>
    <meta charset="utf-8">
    <title>Amarena_System</title>
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="estilo.css">
</head>
<body>
    <!-- ENCABEZADO -->
 <header>
        <div class="header-container">
               <h1>Heladería Amarena</h1>
		</div>
            <nav
                <ul class="menu">
                    <li><a href="index.php">Inicio</a></li>
                    <li><a href="mostrarProducto.php">Stock de productos</a></li>
   				 	<li><a href="mostrarCliente.php">Clientes Activos</a></li>
					<li><a href="clientesInactivos.php">Clientes Inactivos</a></li>
					<li><a href="mostrarFactura.php">Facturas (Empezar a vender)</a></li>
                </ul>
            </nav>
    
    </header>

    <!-- SECCIÓN DE PRODUCTOS -->
    <main id="principal">
        <section class="productos">
            <div class="card">
                <img src="imagenes/helado1.jpg" alt="Helado Vainilla">
                <h3>Helado Vainilla</h3>
                <p>Delicioso helado de vainilla con topping de chocolate.</p>
        		<a class="bt" href="mostrarFactura.php">Ordenar</a>
            </div>
            <div class="card">
                <img src="imagenes/helado2.jpg" alt="Helado Fresa">
                <h3>Helado Fresa</h3>
                <p>Fresa natural con un toque de crema.</p>
               <a class="bt" href="mostrarFactura.php">Ordenar</a>
            </div>
            <div class="card">
                <img src="imagenes/helado3.jpg" alt="Helado Chocolate">
                <h3>Helado Chocolate</h3>
                <p>Chocolate intenso con chips crujientes.</p>
              <a class="bt" href="mostrarFactura.php">Ordenar</a>
            </div>
        </section>
    </main>

    <script>
        const toggle = document.getElementById('menu-toggle');
        const menu = document.getElementById('menu');

        toggle.addEventListener('click', () => {
            menu.classList.toggle('active');
        });
    </script>
</body>
</html>