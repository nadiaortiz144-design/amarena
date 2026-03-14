<html>
    <head>
	<meta charset="utf-8">
<title>Amarena System</title>
		<link rel="stylesheet" type="text/css" href="estilo.css" media="screen" />
	</head>
<body>
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
                </ul>
            </nav>
    
    </header>
<main class="content">
    <h2>Gestión de Productos</h2>
    <!-- Formulario 1 -->
    <div class="form-container">
        <h3>Agregar Producto</h3>
        <form method="post" action="insertarProducto.php">
            <label>Nombre:</label>
            <input type="text" name="nom_p" required>
            <label>Descripción:</label>
            <textarea name="descrip_p" rows="2"></textarea>
            <label>Precio:</label>
            <input type="number" name="costo" step="0.01" required>
            <label>Stock:</label>
            <input type="number" name="stock" min="0" required><br><br>
            <label>Fecha de Entrega:</label>
            <input type="date" name="fecha_entrega">
            <label>Tamaño:</label>
            <input type="text" name="tam">
            <input type="submit" value="Agregar" class="bt">
        </form>
    </div>

    <!-- Formulario 2 -->
    <div class="form-container">
        <h3>Modificar Producto</h3>
        <form method="post" action="modificarProducto.php">
            <label>ID Producto:</label>
            <input type="number" name="id_producto" required>
            <label>Nombre:</label>
            <input type="text" name="nom_p">

            <label>Descripción:</label>
            <textarea name="descrip_p" rows="2"></textarea>

            <label>Precio:</label>
            <input type="number" name="costo" step="0.01">

            <input type="submit" value="Modificar" class="bt">
        </form>
    </div>

    <!-- Formulario 3 -->
    <div class="form-container">
        <h3>Buscar Producto</h3>
        <form method="post" action="">
            <input type="text" name="buscar" placeholder="Buscar producto...">
            <input type="submit" value="Buscar" class="bt">
        </form>
    </div>
</main>
</body>
</HTML>