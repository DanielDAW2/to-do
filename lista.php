<?php
  include('./templates/head.php');
  include("./lib/define.php");
  include("./lib/db.php");
  echo tareaspendientes($_SESSION['user']['id']);
  ?>
  <div class="task-container">
    <div class="task title">
      <div class="">
        Tu Tarea
      </div>
      <div class="">
        Creada
      </div>
      <div class="">
        Para
      </div>
      <div>
        Estado
      </div>
    </div>
    <div class="list">
      <?php echo verTareas($_SESSION['user']['id']);?>
    </div>
    <div class="form-task">
      <div class="">
        <input type="text" id="tarea" class="new-task" name="tarea" placeholder="Introduce la tarea" value="">
      </div>
      <div class="">
        <input type="date" id="fi" class="new-task" name="fechafi" value="" placeholder="¿Para cuando és?">
      </div>
      <div class="">
        <input type="button" id="add" name="" value="Guardar">
      </div>
      <div>
      </div>
    </div>
</div>

  <?php
  include('./templates/footer.php');
 ?>
