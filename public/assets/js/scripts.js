let form = document.getElementById("form");
let usuario = document.getElementById("user");
let contrasena = document.getElementById("password");
let btnEnviar = document.getElementById("btnValidarLogin");

const cantidadDatos = 12;

const paginaActual = 1;

const enviarFormulario = (form) => {
  form.submit();
};

const validacion = (e) => {
  e.preventDefault();

  if (
    usuario.value == "" ||
    usuario.value == null ||
    usuario.value.lenght > 50
  ) {
    return false;
  }
  if (
    contrasena.value == "" ||
    contrasena.value == null ||
    usuario.value.lenght > 50
  ) {
    return false;
  }

  enviarFormulario(form);
};

btnEnviar.addEventListener("click", validacion);
