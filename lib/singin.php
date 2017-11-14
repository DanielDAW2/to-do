<?php
  session_start();
  include("db.php");
  include("define.php");
  if(isset($_POST) &&
    !empty($_POST['pwd']) &&
    !empty($_POST['email']))
    {
      if (login($_POST['email'],md5($_POST['pwd'])) == 1)
      {
        if(isset($_POST['recordar']))
        {
          $json = json_encode($_SESSION['user']);
          setcookie("login", $json, time()+3600,"/");
        }
        header("Location:".path."lista.php");
      }
      header("Location:".path);
    }
 ?>
