let formValid = document.getElementById('login');

let nombre = document.getElementById("first_name").value;
console.log(nombre);
let apellido = document.getElementById("last_name").value;
let telefono = document.getElementById("phone").value;
let password = document.getElementById("password").value;
let password_confirm = document.getElementById("password_confirm").value;

let btnValid = document.getElementById("btnRegistrar");


const enviarFormularioValid = (formValid) => {
    formValid.submit()
    
}

let validar = (e) => {
  
  e.preventDefault();

  if (nombre == "" || nombre == null || nombre.lenght > 50) {
        console.log(nombre);
        return false;
    }
  if (apellido == "" || apellido == null || apellido.lenght > 50) {
        console.log("Llega validaar");

        return false;
    }
  if (telefono == "" || telefono == null || telefono.lenght > 15) {
        console.log("Llega validaar");

        return false;
    }
  if (password == "" || password == null || password.lenght > 50) {
        console.log("Llega validaar");

        return false;
    }
  console.log("Llega validaar");
    enviarFormularioValid(formValid);

}

btnValid.addEventListener("click", validar);