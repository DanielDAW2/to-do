<?php
include("db.php");
include("define.php");
if(isset($_POST) &&
  !empty($_POST['email']))
  {
    if(!empty($_POST['recordar']))
    {
       $_SESSION['user']['recordar'] = $_POST['recordar'];
    }
    if(exists_email($_POST['email'])!=0)
    {
      $res = "
      <form id='validation' action='./lib/singin.php' method='post'>
        <p>Introduce tu contraseña</p>
        <input type='password' name='pwd' value=''>
        <p>¿Recordarte?</p>
        <input type='checkbox' name='recordar' value='1'>
        <p><input type='submit' value='Entrar'></p>
        <input name='email' hidden value='".$_POST['email']."'>
        <a href='exit.php'><em>¿No eres ".$_POST['email']."? Volver</em></a>
      </form>"
      ;
    }
    else {
      $res = "
        <a href='".path."' class='error'><em>Email no reconocido. ¿Volver?</em></a>
        <h2 class='new-account'>Crea tu cuenta</h2>
        <form id='validation' action='./lib/singup.php' method='post'>
          <p>Elige una contraseña para tu cuenta <em></p><p>(Registraremos el mail introducido)</em></p>
          <p><input type='password' name='pwd' id='pwd' value=''></p>
          <input name='email' hidden value='".$_POST['email']."'
          <p>Confirma la contraseña</p>
          <input type='password' name='pwd2' id='pwd2' value=''>
          <p><input type='submit' name='' value='Registrarse'></p>
        </form>";
    }
    echo $res;
  }

 ?>
