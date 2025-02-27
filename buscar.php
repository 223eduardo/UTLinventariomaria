<?php
$conexion = new mysqli("localhost", "usuario", "contraseña", "inventario");

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

$query = isset($_GET["q"]) ? $conexion->real_escape_string($_GET["q"]) : "";

$sql = "SELECT id, tipo_producto, nombre, estado, persona_asignada FROM productos WHERE nombre LIKE '%$query%'";

$resultado = $conexion->query($sql);

if ($resultado->num_rows > 0) {
    echo '<table class="w-full text-left border-collapse bg-white shadow-md rounded-md">
            <thead>
                <tr>
                    <th class="border-b py-2 px-4 text-gray-700">ID</th>
                    <th class="border-b py-2 px-4 text-gray-700">Tipo</th>
                    <th class="border-b py-2 px-4 text-gray-700">Nombre</th>
                    <th class="border-b py-2 px-4 text-gray-700">Estado</th>
                    <th class="border-b py-2 px-4 text-gray-700">Asignado a</th>
                </tr>
            </thead>
            <tbody>';

    while ($fila = $resultado->fetch_assoc()) {
        echo "<tr>
                <td class='border-b py-2 px-4'>{$fila['id']}</td>
                <td class='border-b py-2 px-4'>{$fila['tipo_producto']}</td>
                <td class='border-b py-2 px-4'>{$fila['nombre']}</td>
                <td class='border-b py-2 px-4'>{$fila['estado']}</td>
                <td class='border-b py-2 px-4'>{$fila['persona_asignada']}</td>
              </tr>";
    }

    echo '</tbody></table>';
} else {
    echo '<p class="text-gray-500 mt-4">No se encontraron resultados.</p>';
}

$conexion->close();
?>
