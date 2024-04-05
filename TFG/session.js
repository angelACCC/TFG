function login() {
    // Mostrar el contenedor "container"
    document.getElementById("logCont").style.display = "block";
    document.getElementById("back").style.display = "block";
    // Ocultar el contenedor "wrapper"
    document.getElementById("session").style.display = "none";
    document.getElementById("wrapper").style.display = "none";

    // Establecer estilos para el contenedor de inicio de sesión
    var loginContainer = document.getElementById("login");
    loginContainer.style.height = '70%';
    loginContainer.style.paddingTop = '15%';
    loginContainer.style.paddingBottom = '15%';
    loginContainer.style.display = 'flex';
    loginContainer.style.justifyContent = 'center'; 
    loginContainer.style.alignItems = 'center';
    loginContainer.style.flexDirection = 'column'; 

    return false; // Evitar el envío del formulario
}

function retur() {

    document.getElementById("logCont").style.display = "none";
    document.getElementById("back").style.display = "none";
    document.getElementById("session").style.display = "block";
    var maincon = document.getElementById("wrapper");
    maincon.style.display = "block";
    maincon.style.display = 'flex';

}

// 

function login2() {

    document.getElementById("logCont").style.display = "block";
    document.getElementById("back").style.display = "block";

    document.getElementById("session").style.display = "none";
    document.getElementById("container").style.display = "none";

    // Establecer estilos para el contenedor de inicio de sesión
    var loginContainer = document.getElementById("login");
    loginContainer.style.height = '70%';
    loginContainer.style.paddingTop = '15%';
    loginContainer.style.paddingBottom = '15%';
    loginContainer.style.display = 'flex';
    loginContainer.style.justifyContent = 'center'; 
    loginContainer.style.alignItems = 'center';
    loginContainer.style.flexDirection = 'column'; 

    return false; // Evitar el envío del formulario
}
function retur2() {

    document.getElementById("logCont").style.display = "none";
    document.getElementById("back").style.display = "none";
    document.getElementById("session").style.display = "block";
    var maincon = document.getElementById("container");
    maincon.style.display = "block";
    maincon.style.display = 'flex';

}