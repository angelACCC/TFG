<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Frutas</title>
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="../style.css" />
    <link rel="stylesheet" href="stbuscador.css" />
    <script type="text/javascript" src="js/scriptFru.js" defer></script>
</head>

<body>
    <main>
        <div class="bg_img">
            <header>
                <div class="logo">
                    <a href="../index.php"><img src="../img/Site-logo.png" alt="logo"></a>
                </div>
            </header>

            <!-- Aquí está el contenedor del buscador -->
            <div id="buscador">
                <!-- Campo de entrada de texto para la búsqueda -->
                <input type="text" id="input-busqueda" placeholder="Buscar personaje..." oninput="buscarPersonaje()">
                <!-- Botón de búsqueda -->
            </div>

            <div class="content-wrapper">
                <div class="container">
                    <!-- Aquí se mostrarán los resultados de la búsqueda -->
                    <div id="resultados-busqueda">
                        <!-- Los resultados de la búsqueda se mostrarán aquí -->
                    </div>
                </div>
                <br>
            </div>
        </div>

        <section id="comment-section">
            <form id="comment-form" method="post">
                <textarea name="text" id="comment-text" placeholder="Escribe tu comentario..." required></textarea>
                <input type="hidden" name="categoria" value="frutas">
                <button type="submit">Comentar</button>
            </form>
            <div class="comentarios" id="comments-list">
                <?php
                mostrarComentarios($conn, 'frutas');
                ?>
            </div>
        </section>
    </main>

</body>

</html>