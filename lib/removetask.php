<?php
session_start();
  include("define.php");
  include("db.php");
  if(isset($_GET) &&
  !empty($_GET['id']))
  {
    deletetask($_GET['id']);
    header("Location:../");
  }
    header("Location:../");
 ?>
