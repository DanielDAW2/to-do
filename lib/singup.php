<?php
  session_start();
  include("db.php");
  include("define.php");
  if(isset($_POST) &&
    !empty($_POST['pwd']) &&
    !empty($_POST['pwd2']))
    {
      singup($_POST['email'],md5($_POST['pwd']),md5($_POST['pwd2']));
      header("Location:".path."lista.php");
    }
 ?>
