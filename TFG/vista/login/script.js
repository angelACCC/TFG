document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('login-form').addEventListener('submit', function(event) {
        event.preventDefault();
        loginUser();
    });
});

function loginUser() {
    const username = document.getElementById('username').value;
    const password = document.getElementById('password').value;

    // Aquí deberías hacer una petición AJAX para enviar los datos de inicio de sesión a PHP para verificarlos
    // Por simplicidad, asumiremos que el usuario es "admin" y la contraseña es "password"
    if (username === 'admin' && password === 'password') {
        // Si las credenciales son correctas, redirige a la página de inicio
        window.location.href = 'inicio.html';
    } else {
        // Si las credenciales son incorrectas, muestra un mensaje de error
        document.getElementById('error-message').innerText = 'Nombre de usuario o contraseña incorrectos.';
    }
}
