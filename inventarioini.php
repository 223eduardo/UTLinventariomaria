<?php
echo ' 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Sistema web de inventario</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
</head>
<body class="bg-gray-100 font-sans">
    <div class="flex h-screen">
       <!-- Sidebar -->
 <div class="w-1/5 bg-white shadow-md">
            <div class="p-4 text-center">
                <h1 class="text-xl font-bold text-blue-900">Almacén</h1>
            </div>
            <nav class="mt-4">
                <ul>
                    <li class="flex items-center px-4 py-2 bg-gray-200">
                        <i class="fas fa-box text-blue-900 mr-2"></i>
                        <span class="text-gray-700" onclick=(cambiarParametrom("c"))>Inventario</span>
                    </li>
                    <li class="flex items-center px-4 py-2">
                        <i class="fas fa-list text-gray-500 mr-2"></i>
                        <span class="text-gray-500">Categoría</span>
                    </li>
                    <li class="flex items-center px-4 py-2">
                        <i class="fas fa-hand-holding text-gray-500 mr-2"></i>
                        <span class="text-gray-500">Préstamos</span>
                    </li>
                    <li class="flex items-center px-4 py-2">
                        <i class="fas fa-user text-gray-500 mr-2"></i>
                        <span class="text-gray-500" onclick=(cam0())>Perfil</span>
                    </li>
                </ul>
            </nav>
            <div class="absolute bottom-4 w-full">
                <button class="flex items-center px-4 py-2 w-full text-gray-500">
                    <i class="fas fa-sign-out-alt text-gray-500 mr-2"></i>
                    <span onclick="ser()">Cerrar sesión</span>
                </button>
            </div>
        </div>
        <!-- Contenido Principal -->
        <div class="flex-1 p-6">
            <h1 class="text-2xl font-bold text-gray-800">Sistema web de inventario</h1>
            <div class="mt-4">
                <div class="relative">
                    <input id="buscador" class="w-full max-w-md px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Buscar productos..." type="text"/>
                    <i class="fas fa-search absolute top-3 right-4 text-gray-500"></i>
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
function cam0() {
cambiarParametromdd("p","p");
}

function cambiarParametroN(nuevoValor) {
  let url = window.location.href;
  let urlObj = new URL(url);
  urlObj.searchParams.set("n", nuevoValor);
  let nuevaUrl = urlObj.toString();
  window.location.href = nuevaUrl;
}

        function cambiarParametromdd(nuevoValor,valor2) {
            let url = new URL(window.location.href);
            url.searchParams.set("m", nuevoValor);
            url.searchParams.set("n", valor2);
            window.location.href = url.toString();
        }
    
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
                    window.location.href = "../index.php?m=p&n=s";
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
            
            fetch("php/buscar.php?q=" + query)
            .then(response => response.text())
            .then(data => {
                document.getElementById("resultado").innerHTML = data;
            })
            .catch(error => console.error("Error:", error));
        });
    </script>

</body>
</html>';
?>
