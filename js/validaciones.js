document.addEventListener('DOMContentLoaded', function() {
  const formulario = document.getElementById('formProducto');
  const precio = document.getElementById('precio');
  const codigo = document.getElementById('codigo');
  const regexCodigo = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{5,15}$/;
  const nombre = document.getElementById('nombre');
  const bodega = document.getElementById('bodega');
  const regexPrecio = /^\d+(\.\d{1,2})?$/;
  const descripcion = document.getElementById('descripcion');
      
    const materiales = document.querySelectorAll('input[name="material[]"]:checked');
  
 const bodegaSelect = document.getElementById('bodega');
  const sucursalSelect = document.getElementById('sucursal');

  

 bodegaSelect.addEventListener('change', function () {
    const bodegaSeleccionada = this.value;

    sucursalSelect.innerHTML = '<option value="" disabled selected>Seleccione una sucursal</option>';

    if (!bodegaSeleccionada) return;

   
    const sucursalesFiltradas = todasLasSucursales.filter(
      sucursal => sucursal.id_bodega === bodegaSeleccionada
    );

    sucursalesFiltradas.forEach(sucursal => {
      const option = document.createElement('option');
      option.value = sucursal.id;
      option.textContent = sucursal.nombre;
      sucursalSelect.appendChild(option);
    });
  });




document.getElementById('guardar').addEventListener('click', function () {
  if (validarFormulario()) {
    enviarFormulario(); 
  }
});
  
 
  function validarFormulario(){
     
      if (!codigo.value.trim()) {
        alert('El código del producto no puede estar en blanco.');
        return false;
      } else if (!regexCodigo.test(codigo.value)) {
        alert('El código del producto debe contener letras y números (5-15 caracteres).');
        return false;
      }

      if (!nombre.value.trim()) {
        alert('El nombre del producto no puede estar en blanco.');
        return false;
      } else if (nombre.value.trim().length < 2 || nombre.value.trim().length > 50) {
        alert('El nombre del producto debe tener entre 2 y 50 caracteres.');
        return false;
      }

      if (!bodega.value) {
        alert('Debe seleccionar una bodega.');
        return false;
      }

      if (!sucursalSelect.value) {
        alert("Debe seleccionar una sucursal para la bodega seleccionada.");
        return false;
      }

     
      if (!codigo.value.trim()) {
        alert('El código del producto no puede estar en blanco.');
        return false;
      } else if (!regexCodigo.test(codigo.value)) {
        alert('El código del producto debe contener letras y números (5-15 caracteres).');
        return false;
      }

      if (!nombre.value.trim()) {
        alert('El nombre del producto no puede estar en blanco.');
        return false;
      } else if (nombre.value.trim().length < 2 || nombre.value.trim().length > 50) {
        alert('El nombre del producto debe tener entre 2 y 50 caracteres.');
        return false;
      }

      if (!bodega.value) {
        alert('Debe seleccionar una bodega.');
        return false;
      }

      if (!sucursalSelect.value) {
        alert("Debe seleccionar una sucursal para la bodega seleccionada.");
        return false;
      }

      if (!precio.value.trim()) {
        alert('El precio del producto no puede estar en blanco.');
        return false;
      } else if (!regexPrecio.test(precio.value) || parseFloat(precio.value) <= 0) {
        alert('El precio del producto debe ser un número positivo con hasta dos decimales.');
        return false;
      }

      const materialesSeleccionados = document.querySelectorAll('input[name="material[]"]:checked');
      if (materialesSeleccionados.length < 2) {
        alert('Debe seleccionar al menos dos materiales para el producto.');
        return false;
      }

      if (!descripcion.value.trim()) {
        alert('La descripción del producto no puede estar en blanco.');
        return false;
      } else if (descripcion.value.trim().length < 10 || descripcion.value.trim().length > 1000) {
        alert('La descripción del producto debe tener entre 10 y 1000 caracteres.');
        return false;
      }

      return true; 



        }




    function enviarFormulario(){
          const formData = new FormData(document.getElementById('formProducto'));

       
          fetch('guardar_producto.php', {
            method: 'POST',
            body: formData
          })
          .then(response => response.json()) 
          .then(data => {
            if (data.estado === 'exito') {
              alert('Producto guardado correctamente.');
              document.getElementById('formProducto').reset(); 
            } else {
              alert('Error al guardar el producto: ' + data.mensaje);
            }
          })
          .catch(error => {
            console.error('Error en la solicitud AJAX:', error);
            alert('Ocurrió un error al intentar guardar el producto.');
          });

  }
    

  

});