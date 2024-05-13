document.addEventListener('DOMContentLoaded', () => {
  const container = document.querySelector('.container');
  let characters = []; // Almacenar los personajes recuperados de la API
  let offset = 0; // Offset inicial para la paginación
  const limit = 12; // Cantidad de elementos por página

  // Función para cargar elementos desde la API
  const loadItems = () => {
      fetch(`https://api.api-onepiece.com/v2/characters/en?offset=${offset}&limit=${limit}`)
          .then(response => response.json())
          .then(data => {
              console.log('Datos recibidos:', data);

              // Actualizar la lista de personajes
              characters = data;

              // Mostrar los personajes
              mostrarPersonajes();
          })
          .catch(error => console.error('Error fetching data:', error));
  };

  // Función para mostrar los personajes
  const mostrarPersonajes = () => {
      container.innerHTML = ''; // Limpiar el contenedor

      characters.forEach(character => {
          const box = document.createElement('div');
          box.classList.add('box');
          box.textContent = `${character.name}`;
          container.appendChild(box);

          box.addEventListener('click', () => {
              window.location.href = `personaje.html?id=${character.id}`;
          });
      });
  };

  // Función para buscar personajes
  window.buscarPersonaje = () => {
      const searchTerm = document.getElementById('input-busqueda').value.trim().toLowerCase();

      // Filtrar personajes basados en la búsqueda del usuario
      const resultados = characters.filter(personaje => {
          return personaje.name.toLowerCase().includes(searchTerm);
      });

      // Mostrar los resultados de la búsqueda
      container.innerHTML = ''; // Limpiar el contenedor

      resultados.forEach(character => {
          const box = document.createElement('div');
          box.classList.add('box');
          box.textContent = `${character.name}`;
          container.appendChild(box);

          box.addEventListener('click', () => {
              window.location.href = `personaje.html?id=${character.id}`;
          });
      });
  };

  // Cargar los primeros elementos al cargar la página
  loadItems();
});