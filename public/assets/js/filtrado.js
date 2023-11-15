function ocultarMostrarElemento() {
  var elemento = document.getElementById("miElemento");
  console.log("ocular/mostrar");
  // Verificar el estado actual del elemento
  if (elemento.style.display === "none") {
    // Si está oculto, mostrarlo
    elemento.style.display = "block";
  } else {
    // Si está visible, ocultarlo
    elemento.style.display = "none";
  }
}
console.log("/cargon");
