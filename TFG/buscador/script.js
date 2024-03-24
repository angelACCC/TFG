


// Datos de ejemplo (puedes cargar los datos desde una fuente externa)
const data = [
    "Resultado 1",
    "Resultado 2",
    "Resultado 3",
    // Añadir más resultados si es necesario
];

const searchInput = document.getElementById("searchInput");
const resultsList = document.getElementById("results");

function search() {
    const query = searchInput.value.toLowerCase();
    const filteredResults = data.filter(item => item.toLowerCase().includes(query));

    displayResults(filteredResults);
}

function displayResults(results) {
    resultsList.innerHTML = "";

    results.forEach(result => {
        const li = document.createElement("li");
        li.textContent = result;
        resultsList.appendChild(li);
    });
}

searchInput.addEventListener("input", search);
