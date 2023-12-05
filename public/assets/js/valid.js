let form = document.getElementById('form');

let nombre = document.getElementById("first_name").value;
let apellido = document.getElementById("last_name").value;
let telefono = document.getElementById("phone").value;
let password = document.getElementById("password").value;
let password_confirm = document.getElementById("password_confirm").value;

let btn = document.getElementById("btnRegistrar");


const enviarFormulario = (form) => {
    form.submit()
    
}

let validar = (e) =>{
    e.preventDefault();
    if (nombre == "" || nombre == null || nombre.lenght > 50) {
        return false;
    }
    if (apellido == "" || apellido == null || apellido.lenght > 50) {
        return false;
    }
    if (telefono == "" || telefono == null || telefono.lenght > 15) {
        return false;
    }
    if (password == "" || password == null || password.lenght > 50) {
        return false;
    }

    enviarFormulario(form);

}


btn.addEventListener("click", validar);