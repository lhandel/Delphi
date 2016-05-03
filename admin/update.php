<?php

include '../function.php';
protect("admin");

  if(isset($_GET["next"]))
  {
    $s_id = $_GET["s_id"];
    $a_id = 1;
    $result = user_update_by_service($s_id,$a_id);
    header("Location: service.php?s_id=".$s_id);
  }

  if(isset($_GET["skip"]))
  {
    $s_id= $_GET["s_id"];
    $a_id = 1;
    user_update_state();
    user_update_by_service($s_id,$a_id);
    header("Location: service.php?s_id=".$s_id);
  }
  if (isset($_POST["name"])) {
      if (strlen($_POST["name"])!= 0) {
        $s_id=new_service($_POST["name"]);
        header("Location: service.php?s_id=".$s_id);
      }
      else {
        header("Location: index.php");
      }
    }
    if(isset($_GET["reset"]))
    {
      $s_id= $_GET["s_id"];
      reset_queue($s_id);
      header("Location: service.php?s_id=".$s_id);
    }
    if(isset($_GET["remove"]))
    {
      $s_id= $_GET["s_id"];
      remove_service($s_id);
      header("Location: index.php");
    }
