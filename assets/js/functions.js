$(document).ready(function()
{
  $("#next").on("click",function()
  {

    $email = $("#email").val();
    $.ajax
    ({
      type:"POST",
      url:"/to-do/lib/login.php",
      data:{email:$email},
      success:function(data)
      {
        $(".form").html(data);
      }
    });
  })

  $("#new").on("click",function()
  {
    $(".task").hide();
    $(".form-task").css('display','flex');
  })

  $("#add").on("click",function()
  {
    $(".form-task").hide();
    $tarea = $("#tarea").val();
    $fi = $("#fi").val();
    $.ajax
    ({
      type:"POST",
      url:"/to-do/lib/newtask.php",
      data:{tarea:$tarea,fi:$fi},
      success:function(data)
      {
        $(".task").css('display','flex');
        $(".list").html(data);

      }
    });
  })
  /*
  $("#update").on("click",".list a",function()
  {
    $id = $(this).attr("name");

    $.ajax
    ({
      type:"POST",
      url:"/to-do/lib/updatetask.php",
      data:{id:$id},
      success:function(data)
      {
        $(".list").html(data);
      }
    });
  })
  */
});
