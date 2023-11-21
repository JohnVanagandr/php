const url = "http://localhost:81/php";

function ocultarMostrarElemento() {
    var elemento = document.getElementById("filtros");
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

const cbox1 = document.getElementById("cbox1");
const cbox2 = document.getElementById("cbox2");
const cbox3 = document.getElementById("cbox3");
const buscar = document.getElementById("buscar");

buscar.addEventListener("input", function () {
    var valorBuscar = buscar.value;
    var filters = document.querySelector("#filtros input[type=radio]:checked");
    var valorFiltro = filters.value;
    console.log(valorFiltro);
    fetch(url + "/roles/search", {
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
            var resultsContainer = document.getElementById("resultados");
            resultsContainer.innerHTML = "";
            data.datax.forEach((item) => {
                var itemElement = document.createElement("tr");

                itemElement.innerHTML = `
                <td>
                ${item.name_role}
              </td>
              <td>
              ${item.created_at}
              </td>
              <td>
              ${item.updated_at}
              </td>
              <td>
              `;

                resultsContainer.appendChild(itemElement);
            });
        })
        .catch((error) => {
            console.error("Error:", error);
        });
});
