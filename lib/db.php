<?php
session_start();
// -----------  Conexión a base de datos con Mysqli -------------- //

 function db_connect()
{
  //Iniciamos la conexión y comprobamos si hubo Error
  try {
     $con = new mysqli('localhost', 'draya_linux', 'linuxlinux', 'draya_to-do');
    // $con = new mysqli('localhost', 'to-do', 'linuxlinux', 'to-do');
    if ($con->connect_error) {
        die('Error de Conexión (' . $mysqli->connect_errno . ') '. $mysqli->connect_error);
    }
  } catch (Exception $e) {
    echo "Error".$e->getMessage();
  }
  //Guardamos la cadena de la consulta en una variable
  return $con;
}

/* ------------ LOGIN CON BASE DE DATOS --------- */
/**
*
* @param $usr contiene el nombre de usuario y $pwd contiene la contraseña
*
*/

 function login($email,$pwd) /* Inicio de sesion con nombre de usuario y contraseña  */
{
  $return = 0;
  $con = db_connect();
  $sql = "SELECT * from users WHERE password ='".$pwd."' AND email='".$email."'";
  // Ejecutamos la consulta en la base de datos

  $res = $con->query($sql);
  if($res->num_rows!=0)
  {
    $row = $res->fetch_assoc();
    //GUARDA EN LA VARIABLE $_SESSION UN VECTOR DE USUARIOS, Y EN ESTE VECTOR EN EL CAMPO NOMBRE GUARDAMOS EL RESULTADO DE NOMBRE EN LA CONSULTA.
    $_SESSION['user']['email'] = $row['email'];
    $_SESSION['user']['id'] = $row['id'];
    $return = 1;
  }
  return $return;
  $con->close();

}
 /* ------------ REGISTRO CON BASE DE DATOS ----------- */

 /**
 *
 * @param $usr es el nombre de usuario, $pwd la contraseña y $mail el correo electronico.
 *
 *
 */
function singup($mail, $pwd, $pwd2)
{
  if($pwd == $pwd2)
  {
    try {
      $con = db_connect();
      $sql = "INSERT INTO `users` (`id`, `email`, `password`) VALUES (NULL, '".$mail."', '".$pwd."')";
      $res = $con->query($sql);
    } catch (Exception $e) {
      echo "Error ". $e->getMessage();
    }
    $_SESSION['user']['email'] = $mail;
    $con->close();
  }

}

function exists_email($email)
{
  $con = db_connect();
  $sql = "SELECT * from users WHERE email ='".$email."'";
  $res = $con->query($sql);
  if($res->num_rows!=0)
  {
    $row = $res->fetch_assoc();
    //GUARDA EN LA VARIABLE $_SESSION UN VECTOR DE USUARIOS, Y EN ESTE VECTOR EN EL CAMPO NOMBRE GUARDAMOS EL RESULTADO DE NOMBRE EN LA CONSULTA
  }
  $con->close();
  return $res->num_rows;
}

function numTareas($usr)
{
  $con = db_connect();

  $con = db_connect();
  $sql = "SELECT * from task WHERE user ='".$usr."'";
  $res = $con->query($sql);
  if($res->num_rows!=0)
  {
    $row = $res->fetch_assoc();
    //GUARDA EN LA VARIABLE $_SESSION UN VECTOR DE USUARIOS, Y EN ESTE VECTOR EN EL CAMPO NOMBRE GUARDAMOS EL RESULTADO DE NOMBRE EN LA CONSULTA
  }
  $con->close();
  return $res->num_rows;
}
function verTareas($usr)
{
  $con = db_connect();
  $sql = "SELECT * from task WHERE id_user =$usr;";
  $res = $con->query($sql);
  if($res->num_rows!=0)
  {
    //GUARDA EN LA VARIABLE $_SESSION UN VECTOR DE USUARIOS, Y EN ESTE VECTOR EN EL CAMPO NOMBRE GUARDAMOS EL RESULTADO DE NOMBRE EN LA CONSULTA
    while ($row = $res->fetch_assoc()) {
      if($row['Completa']==1)
      {
        $tareas = $tareas.'
        <div class="task completa">
          <div class="">
            '.$row['Descripcio'].'
          </div>
          <div class="">
            '.$row['FechaAdd'].'
          </div>
          <div class="">
            '.$row['FechaFi'].'
          </div>
          <div>
            <a href="./lib/removetask.php?id='.$row["id"].'">Eliminar</a>
          </div>
        </div>
        ';
      }
      else {
        $tareas = $tareas.'
        <div class="task">
          <div class="">
            '.$row['Descripcio'].'
          </div>
          <div class="">
            '.$row['FechaAdd'].'
          </div>
          <div class="">
            '.$row['FechaFi'].'
          </div>
          <div>
            <a href="./lib/updatetask.php?id='.$row["id"].'">Completar</a>
          </div>
        </div>
        ';
      }
        ;
    }
  }
  $con->close();
  return $tareas;
}
function addtask($tarea,$fi,$usr)
{
  try {
    $con = db_connect();
    $sql = "INSERT INTO `task` (`id`, `Descripcio`, `FechaAdd`, `FechaFi`, `Completa`, `id_user`) VALUES (NULL, '".$tarea."', now(), '".$fi."', '0', '".$usr."');";
    $res = $con->query($sql);
  } catch (Exception $e) {
    echo "Error ". $e->getMessage();
  }
  $con->close();
}

function complete($id)
{
  try {
    $con = db_connect();
    $sql = "UPDATE `task` SET `Completa` = '1' WHERE `task`.`id` = ".$id.";";
    $res = $con->query($sql);
  } catch (Exception $e) {
    echo "Error ". $e->getMessage();
  }
  $con->close();
}

function deletetask($id)
{
  try {
    $con = db_connect();
    $sql = "DELETE FROM `task` WHERE `task`.`id` = ".$id.";";
    $res = $con->query($sql);
  } catch (Exception $e) {
    echo "Error ". $e->getMessage();
  }
  $con->close();
}

function tareaspendientes($usr)
{
  $con = db_connect();
  $sql = "SELECT count(*) p FROM `task` WHERE completa = 0 AND id_user=$usr ";
  $res = $con->query($sql);
  $row = $res->fetch_assoc();
  return "<em>Tienes ".$row['p']." consultas por completar</em>";
}

?>
