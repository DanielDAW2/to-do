<?php
session_start();
  include("define.php");
  include("db.php");
  if(isset($_POST) &&
  !empty($_POST['tarea']) &&
  !empty($_POST['fi']) &&
  !empty($_SESSION['user']['id']))
  {
    addtask($_POST['tarea'],$_POST['fi'],$_SESSION['user']['id']);
    echo verTareas($_SESSION['user']['id']);
  }
 ?>
