<?php

include '../function.php';

  if(isset($_GET["next"]))
  {
    $s_id= $_GET["s_id"];
    $result = user_update_by_service($s_id);
    header("Location: service.php?s_id=".$s_id);
  }

  if(isset($_GET["skip"]))
  {
    $s_id= $_GET["s_id"];
    user_update_state();
    user_update_by_service($s_id);
    header("Location: service.php?s_id=".$s_id);
  }
