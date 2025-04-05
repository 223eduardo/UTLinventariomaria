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
                    <svg class="w-8 h-8" viewBox="0 0 24 24">
                        <image href="icons_login/Imagen0.png" width="20" height="20"/>
                        </svg>
                    <span class="ml-3 text-xl font-semibold text-gray-700">
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
    <script>
        function cambiarParametroN(nuevoValor) {
            let url = window.location.href;
            let urlObj = new URL(url);
            urlObj.searchParams.set("n", nuevoValor);
            window.location.href = urlObj.toString();
        }

        function cambiarParametrom(nuevoValor) {
            let url = window.location.href;
            let urlObj = new URL(url);
            urlObj.searchParams.set("m", nuevoValor);
            window.location.href = urlObj.toString();
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
                        console.error("Error:", data.message);
                    }
                })
                .catch(error => {
                    console.error("Error:", error);
                });
        };
    </script>
</body>

</html>
