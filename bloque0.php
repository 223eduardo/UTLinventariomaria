<html lang="en"><head>
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
    <div class="w-64 bg-gray-200 p-4">
    <div class="flex items-center mb-8">
     <i class="fas fa-warehouse text-2xl text-blue-800">
     </i>
     <span class="ml-2 text-xl font-semibold text-gray-700">
      Almacen
     </span>
    </div>
    <nav class="space-y-4">
     <a class="flex items-center text-gray-700 hover:text-blue-800">
      <i class="fas fa-boxes text-lg">
      </i>
      <span class="ml-2" onclick=(cambiarParametrom("c"))>
       Inventario
      </span>
     </a>

     <a class="flex items-center text-gray-700 hover:text-blue-800">
      <i class="fas fa-boxes text-lg">
      </i>
      <span class="ml-2" onclick=(cambiarParametrom("c"))>
       Producto
      </span>
     </a>
     
     <a class="flex items-center text-gray-700 hover:text-blue-800">
      <i class="fas fa-tags text-lg">
      </i>
      <span class="ml-2">
       Categoria
      </span>
     </a>
     <a class="flex items-center text-gray-700 hover:text-blue-800">
      <i class="fas fa-hand-holding-usd text-lg">
      </i>
      <span class="ml-2">
       Prestamos
      </span>
     </a>
     <a class="flex items-center bg-gray-300 text-gray-700 rounded-lg p-2">
      <i class="fas fa-user text-lg">
      </i>
      <span class="ml-2" onclick=(cambiarParametrom("p"))>
       Perfil
      </span>
     </a>
    </nav>
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
   <!-- Main Content -->
        <div class="flex-1">
            <div class="bg-blue-800 text-white p-4">
                <h1 class="text-xl font-semibold">Perfil</h1>
            </div>
            <div class="p-8">
                <div class="bg-white rounded-lg shadow-lg p-6">
                    <div class="flex items-center mb-6">
                        <img alt="Foto de perfil" class="w-24 h-24 rounded-full" src="https://replicate.delivery/xezq/vKWSDNFq7PK3NNv1G4CtffYchNlcKdnQ396tesmC2fY0WwJRB/out-0.webp">
                        <div class="ml-4">
                            <h2 class="text-xl font-semibold text-gray-700">Usuario</h2>
                            <p class="text-gray-500">Administrador</p>
                        </div>
                    </div>
                    <div class="border-b border-gray-300 mb-6">
                        <nav class="flex space-x-6">
                            <a class="text-gray-700 hover:text-blue-800" onclick=(cambiarParametroN("p"))>Perfil</a>
                            <a class="text-blue-800 border-b-2 border-blue-800 pb-1" onclick=(cambiarParametroN("c"))>Contraseña</a>
                        </nav>
                    </div>
                    <form>
                        <div class="space-y-6">
                            <div class="w-full md:w-3/4 mx-auto">
                                <label class="block text-gray-700 text-sm font-semibold mb-2" for="old-password">
                                    Antigua contraseña
                                </label>
                                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline bg-gray-50" id="old-password" type="password" placeholder="Ingrese su contraseña actual">
                            </div>
                            <div class="w-full md:w-3/4 mx-auto">
                                <label class="block text-gray-700 text-sm font-semibold mb-2" for="new-password">
                                    Nueva contraseña
                                </label>
                                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline bg-gray-50" id="new-password" type="password" placeholder="Ingrese su nueva contraseña">
                            </div>
                            <div class="w-full md:w-3/4 mx-auto">
                                <label class="block text-gray-700 text-sm font-semibold mb-2" for="confirm-password">
                                    Confirmar contraseña
                                </label>
                                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline bg-gray-50" id="confirm-password" type="password" placeholder="Confirme su contraseña">
                            </div>
                        </div>
                        <div class="flex justify-center space-x-4 mt-6">
                            <button class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="button">
                                Cancelar
                            </button>
                            <button class="bg-blue-800 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                                Cambiar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
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

        function ser(){
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
</body></html>
