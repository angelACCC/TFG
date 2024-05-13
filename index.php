<?php
session_start();
// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['username'])) {
    $loginButton = "<form action='login/login.php' method='post'><button type='submit'>Iniciar sesión</button></form>"; 
    $userInfo = "";
} else {
    $username = $_SESSION['username'];
    $loginButton = "<form action='login/logout.php' method='post'><button type='submit'>Cerrar sesión</button></form>"; 
    $userInfo = "<span><p>Bienvenido, $username</p></span>";
}
?>

<!DOCTYPE php>
<php lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WikiOnePiece</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="bg_img">
        <header>

            <div class="logo">
                <img src="img/Site-logo.png" alt="logo">
            </div>
            <!-- Muestra el nombre del usuario registrado -->
            <?php echo $userInfo; ?>
            <form action="tienda/other/tienda.php" method="post">
                <button type="submit">Tienda</button>
            </form>
                <!-- Login -->
                <?php echo $loginButton; ?>
        </header>

        <div class="wrapper" id="wrapper">
            <div class="container">
                <input type="radio" name="slide" id="c1" checked>
                <label for="c1" class="card">
                    <div class="row">
                        <!-- <div class="icon">1</div> -->
                        <div class="description">
                            <h4>PERSONAJES</h4>
                            <a href="vista/personajes.php">SEE MORE</a>
                        </div>
                    </div>
                </label>
                <input type="radio" name="slide" id="c2">
                <label for="c2" class="card">
                    <div class="row">
                        <!-- <div class="icon">2</div> -->
                        <div class="description">
                            <h4>LUGARES</h4>
                            <a href="vista/localizaciones.php">SEE MORE</a>
                        </div>
                    </div>
                </label>
                <input type="radio" name="slide" id="c3">
                <label for="c3" class="card">
                    <div class="row">
                        <!-- <div class="icon">3</div> -->
                        <div class="description">
                            <h4>CREWS</h4>
                            <a href="vista/crews.php">SEE MORE</a>
                        </div>
                    </div>
                </label>
                <input type="radio" name="slide" id="c4">
                <label for="c4" class="card">
                    <div class="row">
                        <!-- <div class="icon">4</div> -->
                        <div class="description">
                            <h4>BARCOS</h4>
                            <a href="vista/barcos.php">SEE MORE</a>
                        </div>
                    </div>
                </label>
                <input type="radio" name="slide" id="c5" checked>
                <label for="c5" class="card">
                    <div class="row">
                        <!-- <div class="icon">5</div> -->
                        <div class="description">
                            <h4>ARMAS</h4>
                            <a href="vista/armas.php">SEE MORE</a>
                        </div>
                    </div>
                </label>
                <input type="radio" name="slide" id="c6" checked>
                <label for="c6" class="card">
                    <div class="row">
                        <!-- <div class="icon">6</div> -->
                        <div class="description">
                            <h4>FRUTAS</h4>
                            <a href="vista/frutas.php">SEE MORE</a>
                        </div>
                    </div>
                </label>
                <input type="radio" name="slide" id="c7" checked>
                <label for="c7" class="card">
                    <div class="row">
                        <!-- <div class="icon">7</div> -->
                        <div class="description">
                            <h4>DIALS</h4>
                            <a href="vista/dials.php">SEE MORE</a>
                        </div>
                    </div>
                </label>
                <input type="radio" name="slide" id="c8" checked>
                <label for="c8" class="card">
                    <div class="row">
                        <!-- <div class="icon">8</div> -->
                        <div class="description">
                            <h4>HAKIS</h4>
                            <a href="vista/hakis.php">SEE MORE</a>
                        </div>
                    </div>
                </label>
                <!-- <input type="radio" name="slide" id="c9" checked>
                <label for="c9" class="card">
                    <div class="row">
                        <div class="icon">9</div>
                        <div class="description">
                            <h4>Eventos</h4>
                            <a href="#">SEE MORE</a>
                        </div>
                    </div>
                </label> -->
            </div>
        </div>


    </div>


    <footer>
        <div class="olas">
            <div class="ola" id="ola1"></div>
            <div class="ola" id="ola2"></div>
            <div class="ola" id="ola3"></div>
            <div class="ola" id="ola4"></div>
        </div>
    </footer>
</body>

</php>