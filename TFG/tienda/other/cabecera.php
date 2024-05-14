
<!DOCTYPE html>
<html lang="en">
    
<header>
    <span id="cab_usuario"><?php  if(isset($_SESSION['user_id'])) echo "Usuario: " . $_SESSION['username'];?></span>
    <a href="tienda.php">Home</a>
    <a href="carrito.php">Carrito</a>
    
    <?php
    if (isset($_SESSION['user_id'])) {
        echo '<a href="logout.php" ">Cerrar sesión</a>';
    } else {
        echo '<a href="../../login/login.html">Iniciar session</a>';
    }
    ?>
    <a href="../../index.php">WIKI</a>
</header>
<hr>

</html>