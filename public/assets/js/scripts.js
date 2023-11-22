let form = document.getElementById("form");
let usuario = document.getElementById("user");
let contrasena = document.getElementById("password");
let btnEnviar = document.getElementById("btnValidarLogin");
const url = "http://localhost/ADSO/php";

const cantidadDatos = 12;

const paginaActual = 1;

const enviarFormulario = (form) => {
  form.submit();
};

// function getData(pagina) {
//   formData = new FormData();
//   formData.append("pagina", pagina);

//   fetch(url, {
//     method: "POST",
//     body: formData,
//   })
//     .then((response) => response.json())
//     .then((data) => {
//       content.innerHTL = data;
//     });
// }

const paginar = async (e) => {
  const data = {
    pagina: paginaActual,
  };
  //Codificamos los datos
  const request_data = JSON.stringify(data);
  try {
    //Realizamos el envio a la ruta del controlador
    let ajax = await fetch(url + "/permisson/paginarPermisos", {
      method: "POST",
      body: request_data,
    });
    //Respuesta servidor
    let json = await ajax.json();

    //Validamos el codigo de respuesta
    if (json.data) {
    } else {
    }
  } catch (err) {
    let message = err.statusText || "Ocurrio un error";
  } finally {
  }
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
