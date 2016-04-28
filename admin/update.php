<?php

include '../function.php';

if(isset($_GET["next"])){
    $s_id= $_GET["s_id"];


    $a_id= 1;// updating a_id later, assigning a_id to the next person in line
    $result = user_update_by_service($s_id,$a_id);

    header("Location: service.php?s_id=".$s_id);
}
