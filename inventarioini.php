<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos - Almacén</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        /* Estilos CSS anteriores */
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f8f8f8;
            margin: 0;
        }
        .sidebar {
            width: 250px;
            background-color: #e3e6eb;
            padding: 20px;
            height: 100vh;
        }
        .sidebar h2 {
            font-size: 22px;
            text-align: center;
            margin-bottom: 30px;
            color: #333;
            font-weight: 500;
        }
        .sidebar a {
            display: block;
            padding: 10px;
            color: #333;
            text-decoration: none;
            margin-top: 10px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        .sidebar a:hover,
        .selected {
            background-color: #bfc4cc;
        }
        .content {
            flex-grow: 1;
            padding: 30px;
            background-color: white;
            margin: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .header {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 30px;
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ccc;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        input[type="text"] {
            padding: 8px;
            width: 300px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        button {
            padding: 8px 15px;
            border: none;
            border-radius: 5px;
            background-color: #12263a;
            color: white;
            cursor: pointer;
        }
        button:hover {
            opacity: 0.9;
        }
    </style>
</head>

<body>
    <div class="sidebar">
        <h2>Almacén</h2>
        <a href="#" class="selected">Producto</a>
        <a href="#">Inventario</a>
        <a href="#">Préstamos</a>
        <a href="#">Reportes</a>
        <a href="#">Perfil</a>
        <a href="#">Cerrar sesión</a>
    </div>
    <div class="content">
        <div class="header">Productos</div>

        <!-- Formulario de búsqueda -->
        <input type="text" id="searchInput" placeholder="Buscar por nombre..." oninput="filterProducts()">

        <!-- Tabla de productos -->
        <table id="productTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tipo</th>
                    <th>Nombre</th>
                    <th>Estado</th>
                    <th>Número de Serie</th>
                    <th>Estante</th>
                    <th>Asignado a</th>
                </tr>
            </thead>
            <tbody id="tableBody">
                <!-- Los datos se cargarán aquí dinámicamente -->
            </tbody>
        </table>
    </div>

    <script>
        // Variable global para almacenar los productos
        let products = [];

        // Función para cargar los datos desde el servidor al iniciar la página
        async function loadProducts() {
            try {
                const response = await fetch('index.php');
                const data = await response.json();
                if (data.error) {
                    console.error(data.error);
                    return;
                }
                // Almacenar los datos en la variable global
                products = data;
                // Mostrar los datos en la tabla
                renderTable(products);
            } catch (error) {
                console.error('Error al cargar los productos:', error);
            }
        }

        // Función para renderizar la tabla con los datos
        function renderTable(data) {
            const tableBody = document.getElementById('tableBody');
            tableBody.innerHTML = ''; // Limpiar la tabla

            data.forEach(product => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${product.id}</td>
                    <td>${product.tipo_producto}</td>
                    <td>${product.nombre}</td>
                    <td>${product.estado}</td>
                    <td>${product.numero_de_serie}</td>
                    <td>${product.estante}</td>
                    <td>${product.persona_asignada}</td>
                `;
                tableBody.appendChild(row);
            });
        }

        // Función para filtrar los productos por nombre
        function filterProducts() {
            const searchTerm = document.getElementById('searchInput').value.toLowerCase();
            const filteredProducts = products.filter(product =>
                product.nombre.toLowerCase().includes(searchTerm)
            );
            renderTable(filteredProducts);
        }

        // Cargar los productos al cargar la página
        window.onload = loadProducts;
    </script>
</body>

</html>';
