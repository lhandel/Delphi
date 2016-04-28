<?php

include '../function.php';

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
