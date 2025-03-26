<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Sistema web de inventario</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>

    <style>
        #tablaxd {
    width: 100%; /* Ancho completo */
    border-collapse: collapse; /* Elimina el espacio entre celdas */
    font-family: Arial, sans-serif; /* Fuente */
    margin: 20px 0; /* Margen exterior */
}

#tablaxd th, #tablaxd td {
    border: 1px solid #ddd; /* Borde de celdas */
    padding: 12px; /* Espaciado interno */
    text-align: left; /* Alineación del texto */
}

#tablaxd th {
    background-color: #4CAF50; /* Color de fondo para encabezados */
    color: white; /* Color del texto */
    font-weight: bold; /* Texto en negrita */
}

#tablaxd tr:nth-child(even) {
    background-color: #f2f2f2; /* Color de fondo para filas pares */
}

#tablaxd tr:hover {
    background-color: #ddd; /* Color de fondo al pasar el mouse */
}
    </style>
    
</head>
<body class="bg-gray-100 font-sans">
    <div class="flex h-screen">
        <div class="flex-1 p-6">
            <h1 class="text-2xl font-bold text-gray-800">Sistema web de inventario</h1>
            <div class="mt-4">
                <div class="relative">
                    <input id="buscador" class="w-full max-w-md px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Buscar productos..." type="text"/>
                    <i class="fas fa-search absolute top-3 right-4 text-gray-500"></i>

                    <table id="tablaxd">

                    </table>
                    
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

fetch("php/buscar.php")
    .then(response => response.json()) // Convertir la respuesta a JSON
    .then(data => {
        // Obtener la tabla por su ID
        const tabla = document.getElementById("tablaxd");

        // Limpiar la tabla antes de agregar nuevos datos (opcional)
        tabla.innerHTML = "";

        // Crear la fila de encabezados (si no existe)
        if (tabla.rows.length === 0) {
            const headerRow = tabla.insertRow();
            const headers = ["ID", "Tipo de Producto", "Nombre", "Estado", "Persona Asignada", "Número de Serie", "Estante"];
            headers.forEach(headerText => {
                const header = document.createElement("th");
                header.textContent = headerText;
                headerRow.appendChild(header);
            });
        }

        // Recorrer los datos y agregar filas a la tabla
        data.forEach(item => {
            const row = tabla.insertRow();
            row.insertCell().textContent = item.id;
            row.insertCell().textContent = item.tipo_producto;
            row.insertCell().textContent = item.nombre;
            row.insertCell().textContent = item.estado;
            row.insertCell().textContent = item.persona_asignada;
            row.insertCell().textContent = item.numero_de_serie;
            row.insertCell().textContent = item.estante;
        });
    })
    .catch(error => console.error("Error:", error));

        
        function cambiarParametrom(nuevoValor) {
            let url = new URL(window.location.href);
            url.searchParams.set("m", nuevoValor);
            window.location.href = url.toString();
        }

        function ser() {
            fetch("php/salir.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "Token": "123456"
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.message === "completo") {
                    window.location.href = "../index.php?m=p";
                } else {
                    alert(data.message || "Error desconocido");
                }
            })
            .catch(error => {
                console.error("Error:", error);
                alert("Error en la solicitud");
            });
        }

        document.getElementById("buscador").addEventListener("keyup", function() {
            let query = this.value;
            const filas = document.querySelectorAll('#tablaxd tr');
            buscarEnTabla(filas, query);
        });

        function buscarDisponibles(termino) {
            const filas = document.querySelectorAll('#tablaxd tr');
            buscarEnTabla(filas, termino);
        }

        function buscarEnTabla(filas, termino) {
            const busqueda = termino.toLowerCase();

            filas.forEach(fila => {
                const textoFila = fila.cells[1].textContent.toLowerCase();
                fila.style.display = textoFila.includes(busqueda) ? '' : 'none';
            });
        }
        
    </script>

</body>
</html>';
