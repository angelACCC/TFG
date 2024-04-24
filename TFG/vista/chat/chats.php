<?php 
  session_start();
  include_once "config.php";
  if(!isset($_SESSION['unique_id'])){
    header("location: login.php");
  }
?>
<?php 
  $user_id = mysqli_real_escape_string($conn, $_GET['user_id']);
  $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$user_id}");
  if(mysqli_num_rows($sql) > 0){
    $row = mysqli_fetch_assoc($sql);
  }else{
    header("location: users.php");
  }
?>
<?php include_once "header.php"; ?>
<body>
  <div class="wrapper">
    <section class="chat-area">
      <header>
        <a href="users.php" class="back-icon"><i class="fas fa-arrow-left"></i></a>
        <img src="php/images/<?php echo $row['img']; ?>" alt="">
        <div class="details">
          <span><?php echo $row['fname']. " " . $row['lname'] ?></span>
          <p><?php echo $row['status']; ?></p>
        </div>
      </header>
      <div class="chat-box">
        <!-- Aquí se mostrarán los mensajes del chat -->
        <?php
          $outgoing_id = $_SESSION['unique_id'];
          $sql = "SELECT * FROM messages WHERE (incoming_msg_id = {$outgoing_id} AND outgoing_msg_id = {$user_id}) OR (outgoing_msg_id = {$outgoing_id} AND incoming_msg_id = {$user_id}) ORDER BY msg_id ASC";
          $query = mysqli_query($conn, $sql);
          if(mysqli_num_rows($query) > 0){
            while($row = mysqli_fetch_assoc($query)){
              if($row['outgoing_msg_id'] === $outgoing_id){ ?>
                <div class="chat outgoing">
                  <div class="details">
                    <p><?php echo $row['msg']; ?></p>
                  </div>
                </div>
              <?php }else{ ?>
                <div class="chat incoming">
                  <img src="php/images/<?php echo $row['img']; ?>" alt="">
                  <div class="details">
                    <p><?php echo $row['msg']; ?></p>
                  </div>
                </div>
              <?php }
            }
          }else{
            echo '<div class="text">No messages are available. Once you send message they will appear here.</div>';
          }
        ?>
      </div>
      <form action="#" class="typing-area">
        <input type="text" class="incoming_id" name="incoming_id" value="<?php echo $user_id; ?>" hidden>
        <input type="text" name="message" class="input-field" placeholder="Type a message here..." autocomplete="off">
        <button><i class="fab fa-telegram-plane"></i></button>
      </form>
    </section>
  </div>

  <script src="javascript/chat.js"></script>

</body>
</html>
