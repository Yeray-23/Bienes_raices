<?php

//Importar la conexion 

require '../includes/config/database.php';
$db = conectarDB();

//Escribir el query

$query = "SELECT * FROM propiedades";

//consultar la BD

$resultadoConsulta = mysqli_query($db, $query);


//Muestra mensaje condicional
$resultado = $_GET['resultado'] ?? null;


//incluye un template
require '../includes/funciones.php';
incluirTemplate('header');


?>
    <main class="contenedor">
        <h1>Administrador de Bienes Raices</h1>

        <?php if( intval($resultado) == 1): ?>
            <p class="alerta exito">Anuncio creado correctamente</p>


        <?php endif; ?>

        <a href="/bienesraices/admin/propiedades/crear.php" class="boton boton-verde">Nueva Propiedad</a>

        <table class="propiedades">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Titulo</th>
                    <th>Imagen</th>
                    <th>Precio</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody> <!-- Mostrar los resultados -->

                 <?php while($propiedad = mysqli_fetch_assoc($resultadoConsulta)): ?>
                <tr>
                    <td> <?php echo $propiedad['id']; ?> </td>
                    <td><?php echo $propiedad['titulo']; ?></td>
                    <td><img src="/bienesraices/imagenes/<?php echo $propiedad['imagen']; ?>" class="imagen-tabla"></td>
                    <td>$ <?php echo $propiedad['precio']; ?></td>
                    <td>
                        <a href="#" class="boton-rojo-block">Eliminar</a>
                        <a href="/bienesraices/admin/propiedades/actualizar.php?id=<?php echo $propiedad['id']; ?>" class="boton-amarillo-block">Actualizar</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>

        </table>
    </main>

    <?php

    //cerrar la conexion
    mysqli_close($db);

     incluirTemplate('footer');


?>
