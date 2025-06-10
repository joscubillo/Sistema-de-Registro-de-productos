<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Formulario de Producto</title>

  <link rel="stylesheet" href="css/estilos.css">
</head>
<body>


  <?php
    require './configuracion/database.php';
    $db = conectarDb();
?>
    <div class="form-container">
        <h1>Formulario de Producto</h1>
  <form id="formProducto">
    <div class="form-row">
      <div class="form-col">
        <div class="form-group">
          <label for="codigo">Código:</label>
          <input type="text" id="codigo" name="codigo" class="form-control" value="">
        </div>
      </div>
      <div class="form-col">
        <div class="form-group">
          <label for="nombre">Nombre:</label>
          <input type="text" id="nombre" name="nombre" class="form-control" value="">
        </div>
      </div>
    </div>

    <div class="form-row">
      <div class="form-col">
        <div class="form-group">
          <label for="bodega">Bodega:</label>

        <?php
          $querybodega = "select id,nombre from bodegas";
          $resultadoBodega = mysqli_query($db,$querybodega);
        ?>
          <select id="bodega" name="bodega" class="form-control">
          <option value="" disabled selected></option>
            <?php

       
         
               if (mysqli_num_rows($resultadoBodega) > 0) {
                    while ($fila = mysqli_fetch_assoc($resultadoBodega)) {
         
                        echo "<option value='{$fila["id"]}' > {$fila["nombre"]}</option>";
                    }
                }
                 
            ?>

          </select>
        </div>
      </div>
      <div class="form-col">
        <div class="form-group">
              <label for="sucursal">Sucursal:</label>
        <select id="sucursal" name="sucursal" class="form-control">
           
          </select>

          <script>
            
            const todasLasSucursales = <?php
              $sucursales = [];
              $querysucursal = "SELECT id, nombre, id_bodega FROM sucursales";
              $resultadosucursal = mysqli_query($db, $querysucursal);
              while ($fila = mysqli_fetch_assoc($resultadosucursal)) {
                  $sucursales[] = $fila;
              }
              echo json_encode($sucursales);
            ?>;
          </script>
        </div>
      </div>
    </div>

    <div class="form-row">
      <div class="form-col">
        <div class="form-group">
          <label for="moneda">Moneda:</label>
            <?php
              $querymoneda = "select id,codigo,nombre from monedas";
              $resultadomoneda = mysqli_query($db,$querymoneda);
            ?>
          <select id="moneda" name="moneda" class="form-control">
              <option value="" disabled selected> </option>
                <?php

          
            
                  if (mysqli_num_rows($resultadomoneda) > 0) {
                        while ($fila = mysqli_fetch_assoc($resultadomoneda)) {
            
                            echo "<option value='{$fila["id"]}' > {$fila["nombre"]}</option>";
                        }
                    }
                    
            ?>
          </select>
        </div>
      </div>
      <div class="form-col">
        <div class="form-group">
          <label for="precio">Precio:</label>
          <input type="text" id="precio" name="precio" class="form-control" value="">
        </div>
      </div>
    </div>

    <div class="form-group">
      <label>Material del Producto:</label>
      <div class="checkbox-group">
        <label><input type="checkbox" name="material[]" value="Plástico" checked> Plástico</label>
        <label><input type="checkbox" name="material[]" value="Metal"> Metal</label>
        <label><input type="checkbox" name="material[]" value="Madera" checked> Madera</label>
        <label><input type="checkbox" name="material[]" value="Vidrio"> Vidrio</label>
        <label><input type="checkbox" name="material[]" value="Textil"> Textil</label>
      </div>
    </div>

    <div class="form-group">
      <label for="descripcion">Descripción:</label>
      <textarea id="descripcion" name="descripcion" class="form-control"> </textarea>
    </div>

    <button type="button" id="guardar">Guardar Producto</button>
  </form>
  </div>

 

    <script src="js/validaciones.js"></script>
</body>

</html>