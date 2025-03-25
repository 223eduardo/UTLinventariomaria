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
     <a class="flex items-center text-gray-700 hover:text-blue-800">
      <i class="fas fa-hand-holding-usd text-lg">
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
