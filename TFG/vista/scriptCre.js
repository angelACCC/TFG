document.addEventListener('DOMContentLoaded', () => {
    const container = document.querySelector('.container');
    let characters = []; // Almacenar los personajes recuperados de la API
    let offset = 0; // Offset inicial para la paginación
    const limit = 12; // Cantidad de elementos por página
  
    // Función para cargar elementos desde la API
    const loadItems = () => {
      fetch(`https://api.api-onepiece.com/v2/crews/en?offset=${offset}&limit=${limit}`)
        .then(response => response.json())
        .then(data => {
          console.log('Datos recibidos:', data);
  
          // Concatenar los nuevos personajes al arreglo existente
          characters = characters.concat(data);
  
          // Mostrar los personajes
          characters.slice(offset, offset + limit).forEach(character => {
            const box = document.createElement('div');
            box.classList.add('box');
            box.textContent = `${character.name}`;
            container.insertBefore(box, loadMoreButton);
  
            box.addEventListener('click', () => {
              window.location.href = `personaje.html?id=${character.id}`;
            });
          });
  
          // Ajustar el estado del botón según la cantidad de personajes cargados
          if (characters.length <= offset + limit) {
            loadMoreButton.disabled = true;
            loadMoreButton.textContent = "No hay más personajes";
          } else {
            loadMoreButton.disabled = false;
            loadMoreButton.textContent = "Mostrar más";
          }
        })
        .catch(error => console.error('Error fetching data:', error));
    };
  
    // Inicialmente, el botón "Mostrar más" no existe, así que lo creamos aquí
    const loadMoreButton = document.createElement('button');
    loadMoreButton.textContent = "Mostrar más";
    loadMoreButton.classList.add('load-more');
    container.appendChild(loadMoreButton);
  
    loadMoreButton.addEventListener('click', () => {
      offset += limit;
      loadItems();
    });
  
    // Cargar los primeros elementos al cargar la página
    loadItems();
  });
  