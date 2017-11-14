<?php
  include('./templates/head.php');
  include("./lib/define.php");
  if(isset($_COOKIE['login']))
  {
    $user_cookie = json_decode($_COOKIE['login'],true);
    $_SESSION['user']['email'] = $user_cookie['email'];
    $_SESSION['user']['id'] = $user_cookie['id'];

  }
  if(empty($_SESSION['user']['id']))
  {
    ?>
    <div class="form">
      <form class="" id="validation"  method="post">
          <p>Introduce tu email</p>
          <input type="text" name="email" id="email" value="">
          <p><input type="button" id="next" name="" value="Continuar"></p>
      </form>
    </div>

    <?php
  }
  else {
    header("Location:lista.php");
  }

  include('./templates/footer.php');
 ?>
