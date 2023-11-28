const url = "http://localhost/php-main";
const actual = location.href;
function ocultarMostrarElemento() {
  if (actual == url + "/roles") {
    var elemento = document.getElementById("filtros");
  } else if (actual == url + "/permisson") {
    var elemento = document.getElementById("filtrosPer");
  }

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
console.log(actual);
const cbox1 = document.getElementById("cbox1");
const cbox2 = document.getElementById("cbox2");
const cbox3 = document.getElementById("cbox3");
const buscar = document.getElementById("buscar");
const cbox11 = document.getElementById("cbox11");
const cbox22 = document.getElementById("cbox22");
const cbox33 = document.getElementById("cbox33");

buscar.addEventListener("input", function () {
  var valorBuscar = buscar.value;

  if (actual == url + "/roles") {
    var filters = document.querySelector("#filtros input[type=radio]:checked");
    var envio = "/roles/search";
  } else if (actual == url + "/permisson") {
    var filters = document.querySelector(
      "#filtrosPer input[type=radio]:checked"
    );
    var envio = "/permisson/search";
  }
  var valorFiltro = filters.value;
  console.log(valorFiltro);
  fetch(url + envio, {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify({
      buscar: valorBuscar,
      filtros: valorFiltro,
    }),
  })
    .then((response) => response.json())
    .then((data) => {
      console.log(data.datax);
      console.log(data.accion);
      var resultsContainer = document.getElementById("resultados");
      resultsContainer.innerHTML = "";
      data.datax.forEach((item) => {
        var itemElement = document.createElement("tr");

        itemElement.innerHTML = `
                <td>
                ${item.name_role != null ? item.name_role : item.name_permisson}
                
                </td>
                <td>
                ${item.created_at}
                </td>
                <td>
                ${item.updated_at}
                </td>
                <td>
                    <button><a
                            href="${url}/${data.accion}/editar/${
          item.id_permission != null ? item.id_permission : item.id_role
        }">editar</a></button>
                    <button><a
                            href="${url}/${data.accion}/delete/${
          item.id_permission != null ? item.id_permission : item.id_role
        }">eliminar</a></button>
                </td>
                `;

        resultsContainer.appendChild(itemElement);
      });
    })
    .catch((error) => {
      console.error("Error:", error);
    });
});
