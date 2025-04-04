<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>
        Perfil
    </title>
    <script src="https://cdn.tailwindcss.com">
    </script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100 font-sans">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="w-64 bg-gray-200 p-4 flex flex-col h-full">
            <div>
                <div class="flex items-center mb-8">
                    <div 
        class="w-10 h-10 bg-contain bg-center bg-no-repeat"
        style="
            background-image: url('icons_login/Imagen1.png');
            filter: brightness(0) saturate(100%) invert(24%) sepia(99%) saturate(1035%) hue-rotate(194deg) brightness(89%) contrast(89%);
        "
    ></div>
                    <span class="ml-2 text-xl font-semibold text-gray-700">
                        Almacen
                    </span>
                </div>
                <nav class="space-y-4">
                    <a class="flex items-center text-gray-700 hover:text-blue-800">
                        <i class="fas fa-box-open text-lg">
                        </i>
                        <span class="ml-2" onclick=(cambiarParametrom("c"))>
                            Inventario
                        </span>
                    </a>

                    <a class="flex items-center text-gray-700 hover:text-blue-800">
                        <i class="fas fa-microchip text-lg">
                        </i>
                        <span class="ml-2" onclick=(cambiarParametrom("g"))>
                            Producto
                        </span>
                    </a>
                    <a class="flex items-center text-gray-700 hover:text-blue-800">
                        <i class="fas fa-chart-bar text-lg">
                        </i>
                        <span class="ml-2">
                            Reporte
                        </span>
                    </a>
                    <a class="flex items-center text-gray-700 hover:text-blue-800">
                        <i class="fas fa-user-circle text-lg">
                        </i>
                        <span class="ml-2" onclick=(cambiarParametrom("p"))>
                            Perfil
                        </span>
                    </a>
                </nav>
            </div>
            <div class="mt-auto">
                <a class="flex items-center text-gray-700 hover:text-blue-800">
                    <i class="fas fa-sign-out-alt text-lg">
                    </i>
                    <span class="ml-2" onclick="ser()">
                        Cerrar sesion
                    </span>
                </a>
            </div>
        </div>
        <!--inicio-->

        <!--final-->
    </div>
    <script>function cambiarParametroN(nuevoValor) {
            // Obtener la URL actual
            let url = window.location.href;

            // Crear un objeto URL
            let urlObj = new URL(url);

            // Cambiar el valor del parámetro 
            urlObj.searchParams.set("n", nuevoValor);

            // Obtener la nueva URL como cadena de texto
            let nuevaUrl = urlObj.toString();

            // Redirigir a la nueva URL
            window.location.href = nuevaUrl;
        }

        function cambiarParametrom(nuevoValor) {
            // Obtener la URL actual
            let url = window.location.href;

            // Crear un objeto URL
            let urlObj = new URL(url);

            // Cambiar el valor del parámetro 
            urlObj.searchParams.set("m", nuevoValor);

            // Obtener la nueva URL como cadena de texto
            let nuevaUrl = urlObj.toString();

            // Redirigir a la nueva URL
            window.location.href = nuevaUrl;
        }

        function ser() {
            dtos = "";

            fetch("php/salir.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "Token": "123456"
                }
            })
                .then(response => response.json()) // Cambia a .json() para parsear la respuesta como JSON
                .then(data => {
                    console.log(data);
                    if (data.message === "completo") { // Verifica si el mensaje es "completo"
                        window.location.href = "../index.php?m=p";
                    } else {
                        errorMensaje.innerText = data.message || "Error desconocido";
                        errorMensaje.removeAttribute("hidden");
                    }
                })
                .catch(error => {
                    console.error("Error:", error);
                    errorMensaje.innerText = "Error en la solicitud";
                });
        };

    </script>
</body>

</html>
