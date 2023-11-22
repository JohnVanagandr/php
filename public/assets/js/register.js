// //Url base del proyecto
const url = "http://citas.test";
//Atributos del formulario
const email = document.getElementById("email");
let usuario = document.getElementById("user_name");

let form = document.getElementById("form");
let btn = document.getElementById("btnRegistrar");

//Función validar correo electronico
const validarEmail = (email) => {
  // Validamos que el campo tenga solo un @  y un punto
  // el @ no puede ser el primer caracter del correo
  // y el punto debe ir posicionando al menos un carácter después de la @
  return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
};

const enviarFormulario = (form) => {
  form.submit();
};

//Función para solicitar datos al servidor
const validacionCorreo = async (e) => {
  //Validamos que el campo correo este lleno
  
  if (email.value != "") {
    //Validamos que el formato del correo sea valido
    if (validarEmail(email.value)) {
      //Los datos que enviaremos al controlador
      const data = {
        email: email.value,
      };
      //Codificamos los datos
      const request_data = JSON.stringify(data);
      try {
        //Realizamos el envio a la ruta del controlador
        let ajax = await fetch(url + "/register/email", {
          method: "POST",
          body: request_data,
        });
        //Respuesta servidor
        let json = await ajax.json();

        //Validamos el codigo de respuesta
        if (json.data) {
          Swal.fire({
            title: "Error!",
            text: "El correo ya esta registrado",
            icon: "error",
            confirmButtonText: "Cerrar",
          });
          //   btn.style.
        } else {
        }
      } catch (err) {
        let message = err.statusText || "Ocurrio un error";
      } finally {
      }
    } else {
      Swal.fire({
        title: "Advertencia",
        text: "Correo no valido",
        icon: "warning",
        confirmButtonText: "Cerrar",
      });
    }
  }
};

const validacionRegister = async (e) => {
  //Validamos que el campo correo este lleno
  if (usuario.value != "") {
    //Validamos que el formato del correo sea valido

    //Los datos que enviaremos al controlador
    const data = {
      usuario: usuario.value,
    };
    //Codificamos los datos
    const request_data = JSON.stringify(data);
    try {
      //Realizamos el envio a la ruta del controlador
      let ajax = await fetch(url + "/register/user", {
        method: "POST",
        body: request_data,
      });
      //Respuesta servidor
      let json = await ajax.json();
      console.log(json);
      //Validamos el codigo de respuesta
      if (json.data) {
        Swal.fire({
          title: "Error!",
          text: "El nombre de usuario ya existe",
          icon: "error",
          confirmButtonText: "Cerrar",
        });
      } else {
      }
    } catch (err) {
      let message = err.statusText || "Ocurrio un error";
    } finally {
    }
  } else {
    // Swal.fire({
    //   title: "Advertencia",
    //   text: "El campo nombre esta vacio",
    //   icon: "warning",
    //   confirmButtonText: "Cerrar",
    // });
  }
};

//Eventos del formulario
email.addEventListener("blur", validacionCorreo);
usuario.addEventListener("blur", validacionRegister);
btn.addEventListener("click", enviarFormulario);
