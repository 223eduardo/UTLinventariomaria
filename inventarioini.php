<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Sistema web de inventario</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>

    <style>
        #tablaxd {
            width: 100%;
            border-collapse: collapse;
            font-family: Arial, sans-serif;
            margin: 20px 0;
        }

        #tablaxd th, #tablaxd td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
            cursor: pointer;
        }

        #tablaxd th {
            background-color: #4CAF50;
            color: white;
            font-weight: bold;
        }

        #tablaxd tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        #tablaxd tr:hover {
            background-color: #ddd;
        }

        /* Estilos para el modal */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.4);
        }

        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 60%;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }

        .close:hover {
            color: black;
        }

        .modal-footer {
            padding: 15px 0;
            text-align: right;
            border-top: 1px solid #eee;
            margin-top: 20px;
        }

        .btn {
            padding: 8px 16px;
            margin-left: 10px;
            border-radius: 4px;
            cursor: pointer;
            font-weight: 500;
        }

        .btn-danger {
            background-color: #f44336;
            color: white;
            border: none;
        }

        .btn-primary {
            background-color: #4CAF50;
            color: white;
            border: none;
        }

        .btn-secondary {
            background-color: #e7e7e7;
            color: black;
            border: none;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: 500;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .form-group textarea {
            min-height: 80px;
        }
    </style>
</head>
<body class="bg-gray-100 font-sans">
    <!-- Modal para mostrar detalles del producto -->
    <div id="productModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2 class="text-xl font-bold mb-4" id="modalTitle">Detalles del Producto</h2>
            <div id="modalContent">
                <!-- Contenido dinámico se cargará aquí -->
            </div>
            <div class="modal-footer">
                <button id="updateBtn" class="btn btn-primary">Actualizar</button>
                <button id="deleteBtn" class="btn btn-danger">Eliminar</button>
                <button id="closeBtn" class="btn btn-secondary">Cerrar</button>
            </div>
        </div>
    </div>

    <div class="flex h-screen">
        <div class="flex-1 p-6">
            <h1 class="text-2xl font-bold text-gray-800">Sistema web de inventario</h1>
            <div class="mt-4">
                <div class="relative">
                    <input id="buscador" class="w-full max-w-md px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Buscar productos..." type="text"/>
                    <i class="fas fa-search absolute top-3 right-4 text-gray-500"></i>

                    <table id="tablaxd"></table>
                </div>
            </div>
            <!-- Resultados de la búsqueda -->
            <div id="resultado" class="mt-6"></div>

            <div class="grid grid-cols-2 gap-6 mt-6">
                <!-- Bajo en stock -->
                <div>
                    <div class="bg-blue-900 text-white px-4 py-2 rounded-t-md flex items-center">
                        <i class="fas fa-th mr-2"></i>
                        <span>Bajo en stock</span>
                    </div>
                    <div class="bg-white shadow-md rounded-b-md p-4">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr>
                                    <th class="border-b py-2 text-gray-700">Nombre</th>
                                    <th class="border-b py-2 text-gray-700">Stock</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="border-b py-2 text-gray-600">Cable RJ-45</td>
                                    <td class="border-b py-2 text-gray-600">3</td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2 text-gray-600">Leds</td>
                                    <td class="border-b py-2 text-gray-600">7</td>
                                </tr>
                                <tr>
                                    <td class="py-2 text-gray-600">Arduino</td>
                                    <td class="py-2 text-gray-600">2</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- Añadidos recientemente -->
                <div>
                    <div class="bg-blue-900 text-white px-4 py-2 rounded-t-md flex items-center">
                        <i class="fas fa-th mr-2"></i>
                        <span>Añadidos recientemente</span>
                    </div>
                    <div class="bg-white shadow-md rounded-b-md p-4">
                        <div class="flex items-center">
                            <img alt="Imagen de una tarjeta Arduino Uno" class="w-16 h-16 mr-4" src="https://placehold.co/64x64"/>
                            <div>
                                <p class="text-gray-700">Tarjeta Arduino Uno</p>
                                <button class="text-blue-500 text-sm">Detalles</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Variable para almacenar el producto seleccionado
        let selectedProduct = null;
        let isEditMode = false;

        // Cargar datos al iniciar la página
        document.addEventListener('DOMContentLoaded', function() {
            loadTableData();
            setupModalEvents();
            setupSearch();
        });

        // Cargar datos de la tabla
        function loadTableData() {
            fetch("php/buscar.php")
                .then(response => response.json())
                .then(data => {
                    renderTable(data);
                })
                .catch(error => {
                    console.error("Error al cargar datos:", error);
                    alert("Error al cargar los datos de productos");
                });
        }

        // Renderizar la tabla con datos
        function renderTable(data) {
            const tabla = document.getElementById("tablaxd");
            tabla.innerHTML = "";

            // Crear encabezados
            const headerRow = tabla.insertRow();
            const headers = ["ID", "Tipo de Producto", "Nombre", "Estado", "Persona Asignada", "Número de Serie", "Estante"];
            headers.forEach(headerText => {
                const header = document.createElement("th");
                header.textContent = headerText;
                headerRow.appendChild(header);
            });

            // Agregar filas con datos
            data.forEach(item => {
                const row = tabla.insertRow();
                row.insertCell().textContent = item.id;
                row.insertCell().textContent = item.tipo_producto;
                row.insertCell().textContent = item.nombre;
                row.insertCell().textContent = item.estado;
                row.insertCell().textContent = item.persona_asignada;
                row.insertCell().textContent = item.numero_de_serie;
                row.insertCell().textContent = item.estante;
                
                // Almacenar datos completos del producto en la fila
                row.dataset.product = JSON.stringify(item);
                
                // Agregar evento click a la fila
                row.addEventListener('click', function() {
                    selectedProduct = JSON.parse(this.dataset.product);
                    showProductDetails(selectedProduct);
                });
            });
        }

        // Configurar eventos del modal
        function setupModalEvents() {
            const modal = document.getElementById("productModal");
            const closeBtn = document.querySelector(".close");
            const closeModalBtn = document.getElementById("closeBtn");
            const updateBtn = document.getElementById("updateBtn");
            const deleteBtn = document.getElementById("deleteBtn");

            // Cerrar modal al hacer clic en la X
            closeBtn.addEventListener('click', closeModal);

            // Cerrar modal al hacer clic en el botón Cerrar
            closeModalBtn.addEventListener('click', closeModal);

            // Cerrar modal al hacer clic fuera del contenido
            window.addEventListener('click', function(event) {
                if (event.target === modal) {
                    closeModal();
                }
            });

            // Configurar botón de actualización
            updateBtn.addEventListener('click', function() {
                if (isEditMode) {
                    submitUpdateForm();
                } else {
                    showEditForm(selectedProduct);
                }
            });

            // Configurar botón de eliminación
            deleteBtn.addEventListener('click', confirmDeleteProduct);
        }

        // Mostrar detalles del producto
        function showProductDetails(product) {
            const modal = document.getElementById("productModal");
            const modalTitle = document.getElementById("modalTitle");
            const modalContent = document.getElementById("modalContent");
            
            modalTitle.textContent = "Detalles del Producto";
            isEditMode = false;
            
            // Crear HTML con los detalles del producto
            modalContent.innerHTML = `
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p><strong>ID:</strong> ${product.id}</p>
                        <p><strong>Tipo de Producto:</strong> ${product.tipo_producto}</p>
                        <p><strong>Nombre:</strong> ${product.nombre}</p>
                        <p><strong>Estado:</strong> ${product.estado}</p>
                    </div>
                    <div>
                        <p><strong>Persona Asignada:</strong> ${product.persona_asignada}</p>
                        <p><strong>Número de Serie:</strong> ${product.numero_de_serie}</p>
                        <p><strong>Estante:</strong> ${product.estante}</p>
                        <p><strong>Fecha de Registro:</strong> ${product.fecha_registro || 'N/A'}</p>
                    </div>
                </div>
                <div class="mt-4">
                    <p><strong>Descripción:</strong></p>
                    <p>${product.descripcion || 'No hay descripción disponible.'}</p>
                </div>
            `;
            
            // Configurar botones
            document.getElementById('updateBtn').textContent = 'Actualizar';
            document.getElementById('updateBtn').style.display = 'inline-block';
            document.getElementById('deleteBtn').style.display = 'inline-block';
            
            modal.style.display = "block";
        }

        // Mostrar formulario de edición
        function showEditForm(product) {
            const modalContent = document.getElementById("modalContent");
            const modalTitle = document.getElementById("modalTitle");
            
            modalTitle.textContent = "Editar Producto";
            isEditMode = true;
            
            modalContent.innerHTML = `
                <form id="editForm">
                    <div class="grid grid-cols-2 gap-4">
                        <div class="form-group">
                            <label>Nombre</label>
                            <input type="text" name="nombre" value="${product.nombre}" required>
                        </div>
                        <div class="form-group">
                            <label>Tipo de Producto</label>
                            <input type="text" name="tipo_producto" value="${product.tipo_producto}" required>
                        </div>
                        <div class="form-group">
                            <label>Estado</label>
                            <select name="estado" required>
                                <option value="Disponible" ${product.estado === 'Disponible' ? 'selected' : ''}>Disponible</option>
                                <option value="En uso" ${product.estado === 'En uso' ? 'selected' : ''}>En uso</option>
                                <option value="Mantenimiento" ${product.estado === 'Mantenimiento' ? 'selected' : ''}>Mantenimiento</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Persona Asignada</label>
                            <input type="text" name="persona_asignada" value="${product.persona_asignada}">
                        </div>
                        <div class="form-group">
                            <label>Número de Serie</label>
                            <input type="text" name="numero_de_serie" value="${product.numero_de_serie}">
                        </div>
                        <div class="form-group">
                            <label>Estante</label>
                            <input type="text" name="estante" value="${product.estante}">
                        </div>
                        <div class="form-group col-span-2">
                            <label>Descripción</label>
                            <textarea name="descripcion">${product.descripcion || ''}</textarea>
                        </div>
                    </div>
                    <input type="hidden" name="id" value="${product.id}">
                </form>
            `;
            
            // Configurar botones
            document.getElementById('updateBtn').textContent = 'Guardar Cambios';
        }

        // Enviar formulario de actualización
        function submitUpdateForm() {
            const form = document.getElementById('editForm');
            const formData = new FormData(form);
            const jsonData = {};
            
            formData.forEach((value, key) => {
                jsonData[key] = value;
            });

            fetch("php/actualizar_producto.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                },
                body: JSON.stringify(jsonData)
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert("Producto actualizado correctamente");
                    closeModal();
                    loadTableData();
                } else {
                    alert("Error al actualizar: " + (data.message || 'Error desconocido'));
                }
            })
            .catch(error => {
                console.error("Error:", error);
                alert("Error en la conexión");
            });
        }

        // Confirmar eliminación de producto
        function confirmDeleteProduct() {
            if (!selectedProduct) return;
            
            if (confirm(`¿Estás seguro de que deseas eliminar el producto "${selectedProduct.nombre}"? Esta acción no se puede deshacer.`)) {
                deleteProduct(selectedProduct.id);
            }
        }

        // Eliminar producto
        function deleteProduct(productId) {
            fetch("php/eliminar_producto.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                },
                body: JSON.stringify({ id: productId })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert("Producto eliminado correctamente");
                    closeModal();
                    loadTableData();
                } else {
                    alert("Error al eliminar: " + (data.message || 'Error desconocido'));
                }
            })
            .catch(error => {
                console.error("Error:", error);
                alert("Error en la conexión");
            });
        }

        // Cerrar modal
        function closeModal() {
            document.getElementById('productModal').style.display = 'none';
            isEditMode = false;
        }

        // Configurar búsqueda
        function setupSearch() {
            document.getElementById("buscador").addEventListener("keyup", function() {
                const query = this.value.toLowerCase();
                const rows = document.querySelectorAll('#tablaxd tr');
                
                rows.forEach((row, index) => {
                    // Saltar la fila de encabezados
                    if (index === 0) return;
                    
                    const rowText = row.textContent.toLowerCase();
                    row.style.display = rowText.includes(query) ? '' : 'none';
                });
            });
        }
    </script>
</body>
</html>
