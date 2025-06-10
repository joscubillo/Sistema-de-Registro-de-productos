"use strict";

document.addEventListener('DOMContentLoaded', function () {
  var formulario = document.getElementById('formProducto');
  var precio = document.getElementById('precio');
  var codigo = document.getElementById('codigo');
  var regexCodigo = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{5,15}$/;
  var nombre = document.getElementById('nombre');
  var bodega = document.getElementById('bodega');
  var regexPrecio = /^\d+(\.\d{1,2})?$/;
  var descripcion = document.getElementById('descripcion');
  var materiales = document.querySelectorAll('input[name="material[]"]:checked');
  formulario.addEventListener('submit', function (e) {
    e.preventDefault();

    if (validarFormulario()) {
      enviarFormulario();
    }
  });

  function validarFormulario() {
    if (!codigo.value.trim()) {
      alert('El código del producto no puede estar en blanco.');
      return;
    } else if (!regexCodigo.test(codigo.value)) {
      alert('El código del producto debe contener letras y números (5-15 caracteres).');
      return;
    }

    if (!nombre.value.trim()) {
      alert('El nombre del producto no puede estar en blanco.');
      return;
    } else if (nombre.value.trim().length < 2 || nombre.value.trim().length > 50) {
      alert('El nombre del producto debe tener entre 2 y 50 caracteres.');
      return;
    }

    if (!bodega.value) {
      alert('Debe seleccionar una bodega.');
      return;
    }

    if (!precio.value.trim()) {
      alert('El precio del producto no puede estar en blanco.');
      return;
    } else if (!regexPrecio.test(precio.value) || parseFloat(precio.value) <= 0) {
      alert('El precio del producto debe ser un número positivo con hasta dos decimales.');
      return;
    }

    if (materiales.length < 2) {
      alert('Debe seleccionar al menos dos materiales para el producto.');
      return;
    }

    if (!descripcion.value.trim()) {
      alert('La descripción del producto no puede estar en blanco.');
      return;
    } else if (descripcion.value.trim().length < 10 || descripcion.value.trim().length > 1000) {
      alert('La descripción del producto debe tener entre 10 y 1000 caracteres.');
      return;
    }

    return valido;
  }

  function enviarFormulario() {}
});
//# sourceMappingURL=validaciones.dev.js.map
