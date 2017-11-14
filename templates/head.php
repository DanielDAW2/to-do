<?php
session_start();
if(!empty($_SESSION['user']['email']) && $_SERVER['SCRIPT_NAME'] != "/to-do/lista.php")
{
   header("Location:./lista.php");
}
include $_SERVER["DOCUMENT_ROOT"]."/to-do/lib/define.php";

 ?>
 <!DOCTYPE html>
 <html>
   <head>
     <meta charset="utf-8">
    <link rel="stylesheet" href="<?= css_path ?>main.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="<?= js_path ?>functions.js"></script>
     <title>To-Do List</title>
   </head>
   <body>
    <div class="container">
       <header>
          <h1>To-do List</h1>
          <?php
            if(!empty($_SESSION['user']['email']))
            {
              include("nav.html");
            }
          ?>
       </header>
