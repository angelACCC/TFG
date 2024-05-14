
//Categoria

function cargarCategorias() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            var cats = JSON.parse(this.responseText);
            var lista = document.createElement("ul");
            for (var i = 0; i < cats.length; i++) {
                var elem = document.createElement("li");
                vinculo = crearVinculoCategorias(cats[i].Nombre, cats[i].CodCat);
                elem.appendChild(vinculo);
                lista.appendChild(elem);
            }
            var contenido = document.getElementById("contenido");
            contenido.innerHTML = "";
            var titulo = document.getElementById("titulo");
            titulo.innerHTML = "Categorías";
            contenido.appendChild(lista);
        }
    };
    xhttp.open("GET", "categorias.php", true);
    xhttp.send();
    return false;
}
function crearVinculoCategorias(nom, cod) {
    var vinculo = document.createElement("a");
    var ruta = "productos.php?categoria=" + cod;;
    vinculo.href = ruta;
    vinculo.innerHTML = nom;
    vinculo.onclick = function () { return cargarProductos(this); }
    return vinculo;
}

//Productos

function cargarProductos(destino) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            var prod = document.getElementById("contenido");
            var titulo = document.getElementById("titulo");
            titulo.innerHTML = "Productos";
            try {
                var filas = JSON.parse(this.responseText);
                var tabla = crearTablaProductos(filas);
                prod.innerHTML = "";
                prod.appendChild(tabla);
            } catch (e) {
                var mensaje = document.createElement("p");
                mensaje.innerHTML = "Categoría sin productos";
                prod.innerHTML = "";
                prod.appendChild(mensaje);
            }
        }
    };
    xhttp.open("GET", destino, true);
    xhttp.send();
    return false;
}
function crearTablaProductos(productos) {
    var tabla = document.createElement("table");
    var cabecera = crear_fila(["Código", "Nombre", "Descripción", "Stock", "Comprar"], "th");
    tabla.appendChild(cabecera);
    for (var i = 0; i < productos.length; i++) {
        if (productos[i]['Stock'] > 0) {
            formu = crearFormulario("Añadir", productos[i]['CodProd'], anadirProductos);
            fila = crear_fila([productos[i]['CodProd'], productos[i]['Nombre'], productos[i]['Descripcion'], productos[i]['Stock']], "td");
            celda_form = document.createElement("td");
            celda_form.appendChild(formu);
            fila.appendChild(celda_form);
            tabla.appendChild(fila);
        }
    } return tabla;
}

function crearFormulario(texto, cod, funcion) {
    var formu = document.createElement("form");
    var unidades = document.createElement("input");
    unidades.value = 1;
    unidades.name = "unidades";
    var codigo = document.createElement("input");
    codigo.value = cod;
    codigo.type = "hidden";
    codigo.name = "cod";
    var bsubmit = document.createElement("input");
    bsubmit.type = "submit";
    bsubmit.value = texto;
    formu.onsubmit = function () { return funcion(this); }
    formu.appendChild(unidades);
    formu.appendChild(codigo);
    formu.appendChild(bsubmit);
    return formu;
}
function crear_fila(campos, tipo) {
    var fila = document.createElement("tr");
    for (var i = 0; i < campos.length; i++) {
        var celda = document.createElement(tipo);
        celda.innerHTML = campos[i];
        fila.appendChild(celda);
    }
    return fila;
}


//Carrito

function cargarCarrito() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            var contenido = document.getElementById("carrito"); contenido.innerHTML = "";
            try {
                var filas = JSON.parse(this.responseText);
                tabla = crearTablaCarrito(filas);
                contenido.appendChild(tabla);
                var procesar = document.createElement("a");
                procesar.href = "#";
                procesar.innerHTML = "Realizar pedido";
                procesar.onclick = function () { return procesarPedido(); };
                contenido.appendChild(procesar);

                var space = document.createElement("pre");
                contenido.appendChild(space);

                var delet = document.createElement("a");
                delet.href = "#";
                delet.innerHTML = "Vaciar carrito";
                delet.onclick = function () { return vaciarCarrito(); };
                contenido.appendChild(delet);
            } catch (e) {
                var mensaje = document.createElement("p");
                mensaje.innerHTML = "Todavía no tiene productos";
                contenido.appendChild(mensaje);
            }
        }
    };
    xhttp.open("GET", "carrito.php", true);
    xhttp.send();
    // crearTablaProductos();
    return false;
}

function crearTablaCarrito(productos) {
    var tabla = document.createElement("table");
    var cabecera = crear_fila(["Código", "Nombre", "Descripción", "Unidades", "Eliminar"], "th");
    tabla.appendChild(cabecera);
    for (var i = 0; i < productos.length; i++) {
        var formu = crearFormulario("Eliminar", productos[i]['CodProd'], eliminarProductos);
        var fila = crear_fila([productos[i]['CodProd'], productos[i]['Nombre'],
        productos[i]['Descripcion'], productos[i]['unidades']], "td");
        var celda_form = document.createElement("td");
        celda_form.appendChild(formu);
        fila.appendChild(celda_form);
        tabla.appendChild(fila);
    } return tabla;
}



//Procesar pedido

function procesarPedido() {
    var res = confirm("¿Confirma que quiere realizar el pedido?");
    if (res == false) {
        return false;
    }
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            var contenido = document.getElementById("contenido");
            contenido.innerHTML = "";
            var titulo = document.getElementById("titulo");
            titulo.innerHTML = "Estado del pedido";
            if (this.responseText == "true") {
                contenido.innerHTML = "Pedido realizado";
                cargarCarrito();

            } else {
                contenido.innerHTML = "Error al procesar el pedido";
            }
        }
    };
    xhttp.open("GET", "procesarPedido.php", true);
    xhttp.send();
    return false;
}
// Eliminar carrito

function vaciarCarrito() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            var contenido = document.getElementById("carrito");
            contenido.innerHTML = "";
            alert("El carrito ha sido vaciado correctamente");
        }
    };
    xhttp.open("GET", "eliminarCarrito.php", true);
    xhttp.send();
    return false;
}

// annadir

function anadirProductos(formulario) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            alert("Producto añadido con éxito");
            cargarCarrito();
        }
    };
    var params = "cod=" + formulario.elements['cod'].value +
        "&unidades=" + formulario.elements['unidades'].value;
    xhttp.open("POST", "anadir.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send(params);
    return false;
}

//Eliminar

function eliminarProductos(formulario) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            alert("Producto eliminado con éxito");
            cargarCarrito();
        }
    };
    var params = "cod=" + formulario.elements['cod'].value +
        "&unidades=" + formulario.elements['unidades'].value;
    xhttp.open("POST", "eliminar.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send(params);
    return false;
}

