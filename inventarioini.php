<!-- Mantén todo el código anterior hasta el script -->
<script>
    // ... (código anterior hasta la función showProductModal)

    // Función para eliminar producto (FUNCIONAL)
    document.getElementById('deleteBtn').addEventListener('click', function() {
        if (!selectedProduct) return;
        
        if (confirm(`¿Estás seguro de que deseas eliminar el producto "${selectedProduct.nombre}"?`)) {
            fetch("php/eliminar_producto.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                },
                body: JSON.stringify({ id: selectedProduct.id })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert("Producto eliminado correctamente");
                    // Cerrar modal y recargar datos
                    document.getElementById('productModal').style.display = 'none';
                    loadTableData();
                } else {
                    alert("Error al eliminar: " + data.message);
                }
            })
            .catch(error => {
                console.error("Error:", error);
                alert("Error en la conexión");
            });
        }
    });

    // Función para actualizar producto (FUNCIONAL)
    document.getElementById('updateBtn').addEventListener('click', function() {
        if (!selectedProduct) return;
        showUpdateForm(selectedProduct);
    });

    // Mostrar formulario de actualización
    function showUpdateForm(product) {
        const modal = document.getElementById("productModal");
        const modalContent = document.getElementById("modalContent");
        
        modalContent.innerHTML = `
            <h3 class="text-lg font-bold mb-4">Editar Producto</h3>
            <form id="updateForm" class="grid grid-cols-2 gap-4">
                <div class="form-group">
                    <label class="block text-gray-700">Nombre</label>
                    <input type="text" name="nombre" value="${product.nombre}" class="w-full px-3 py-2 border rounded">
                </div>
                <div class="form-group">
                    <label class="block text-gray-700">Tipo de Producto</label>
                    <input type="text" name="tipo_producto" value="${product.tipo_producto}" class="w-full px-3 py-2 border rounded">
                </div>
                <div class="form-group">
                    <label class="block text-gray-700">Estado</label>
                    <select name="estado" class="w-full px-3 py-2 border rounded">
                        <option ${product.estado === 'Disponible' ? 'selected' : ''}>Disponible</option>
                        <option ${product.estado === 'En uso' ? 'selected' : ''}>En uso</option>
                        <option ${product.estado === 'Mantenimiento' ? 'selected' : ''}>Mantenimiento</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="block text-gray-700">Persona Asignada</label>
                    <input type="text" name="persona_asignada" value="${product.persona_asignada}" class="w-full px-3 py-2 border rounded">
                </div>
                <div class="form-group">
                    <label class="block text-gray-700">Número de Serie</label>
                    <input type="text" name="numero_de_serie" value="${product.numero_de_serie}" class="w-full px-3 py-2 border rounded">
                </div>
                <div class="form-group">
                    <label class="block text-gray-700">Estante</label>
                    <input type="text" name="estante" value="${product.estante}" class="w-full px-3 py-2 border rounded">
                </div>
                <div class="form-group col-span-2">
                    <label class="block text-gray-700">Descripción</label>
                    <textarea name="descripcion" class="w-full px-3 py-2 border rounded">${product.descripcion || ''}</textarea>
                </div>
                <input type="hidden" name="id" value="${product.id}">
            </form>
        `;
        
        // Cambiar texto de los botones
        document.getElementById('updateBtn').textContent = 'Guardar Cambios';
        document.getElementById('updateBtn').removeEventListener('click', arguments.callee);
        document.getElementById('updateBtn').addEventListener('click', submitUpdateForm);
    }

    // Enviar formulario de actualización
    function submitUpdateForm() {
        const form = document.getElementById('updateForm');
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
                // Cerrar modal y recargar datos
                document.getElementById('productModal').style.display = 'none';
                loadTableData();
            } else {
                alert("Error al actualizar: " + data.message);
            }
        })
        .catch(error => {
            console.error("Error:", error);
            alert("Error en la conexión");
        });
    }

    // Función para cargar datos de la tabla
    function loadTableData() {
        fetch("php/buscar.php")
            .then(response => response.json())
            .then(data => {
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
                    
                    row.dataset.product = JSON.stringify(item);
                    row.addEventListener('click', function() {
                        selectedProduct = JSON.parse(this.dataset.product);
                        showProductModal(selectedProduct);
                        // Restaurar botón de actualización
                        document.getElementById('updateBtn').textContent = 'Actualizar';
                        document.getElementById('updateBtn').removeEventListener('click', submitUpdateForm);
                        document.getElementById('updateBtn').addEventListener('click', function() {
                            if (!selectedProduct) return;
                            showUpdateForm(selectedProduct);
                        });
                    });
                });
            })
            .catch(error => console.error("Error:", error));
    }

    // ... (resto del código anterior)
</script>
